<?php


new \Kirki\Panel(
    'panel_id',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'Nilos Customizer', 'nilos' ),
        'description' => esc_html__( 'Nilos Customizer Description.', 'nilos' ),
    ]
);


function header_main_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_main_section',
        [
            'title'       => esc_html__( 'Header Main Settings', 'nilos' ),
            'description' => esc_html__( 'Header Main Controls.', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 30,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'nilos_header_elementor_switch',
            'label'       => esc_html__( 'Header Custom/Elementor Switch', 'nilos' ),
            'description' => esc_html__( 'Header Custom/Elementor On/Off', 'nilos' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'nilos' ),
                'off' => esc_html__( 'Disable', 'nilos' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'header_layout_custom',
            'label'       => esc_html__( 'Chose Header Style', 'nilos' ),
            'section'     => 'header_main_section',
            'priority'    => 10,
            'choices'     => [
                'header_1'  => get_template_directory_uri() . '/inc/img/header/header-1.png',
            ],
            'default'     => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'nilos_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_posttype = array(
        'post_type'      => 'nl-header',
        'posts_per_page' => -1,
    );
    $header_posttype_loop = get_posts($header_posttype);

    $header_post_obj_arr = array();
    foreach($header_posttype_loop as $post){
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }


    wp_reset_query();


    new \Kirki\Field\Select(
        [
            'settings'    => 'nilos_header_templates',
            'label'       => esc_html__( 'Elementor Header Template', 'nilos' ),
            'section'     => 'header_main_section',
            'placeholder' => esc_html__( 'Choose an option', 'nilos' ),
            'choices'     => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'nilos_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
   
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__( 'Header Right Switch', 'nilos' ),
            'description' => esc_html__( 'Header Right On/Off', 'nilos' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'nilos' ),
                'off' => esc_html__( 'Disable', 'nilos' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'sticky_header',
            'label'       => esc_html__( 'Sticky Header', 'nilos' ),
            'description' => esc_html__( 'Sticky Header On/Off', 'nilos' ),
            'section'     => 'header_main_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'nilos' ),
                'off' => esc_html__( 'Disable', 'nilos' ),
            ],
        ]
    );

    new \Kirki\Field\Repeater(
        [
            'settings' => 'header_socials',
            'label'    => esc_html__( 'Header socials links', 'nilos' ),
            'section'  => 'header_main_section',
            'priority' => 10,
            'row_label'    => [
                'type'  => 'field',
                'value' => esc_html__( 'link', 'nilos' ),
                'field' => 'link_text',
            ],
            'active_callback' => [
                [
                    'setting'  => 'header_right_switch',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
            'default'  => [
                [
                    'link_text'   => esc_html__( 'Fb.', 'nilos' ),
                    'link_url'    => 'https://facebook.com/',
                    'link_target' => '_self',
                    'checkbox'    => false,
                ]
            ],
            'fields'   => [
                'link_text'   => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link Text', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '',
                ],
                'link_url'    => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link URL', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '',
                ],
                'link_target' => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Link Target', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '_self',
                    'choices'     => [
                        '_blank' => esc_html__( 'New Window', 'nilos' ),
                        '_self'  => esc_html__( 'Same Frame', 'nilos' ),
                    ],
                ]
            ],
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'download_cv',
            'label'    => esc_html__( 'CV link', 'nilos' ),
            'section'  => 'header_main_section',
            'default'  => 'https://yoururl.com/',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'header_right_switch',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
 
}
header_main_section();

function preloader_section(){

    new \Kirki\Section(
        'preloader_section',
        [
            'title'       => esc_html__( 'Preloader Settings', 'nilos' ),
            'description' => esc_html__( 'Preloader Controls.', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'nilos_preloader_switch',
            'label'       => esc_html__( 'Preloader Switch', 'nilos' ),
            'description' => esc_html__( 'Preloader On/Off', 'nilos' ),
            'section'     => 'preloader_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'nilos' ),
                'off' => esc_html__( 'Disable', 'nilos' ),
            ],
        ]
    ); 

    new \Kirki\Field\Image(
        [
            'settings'    => 'nilos_preloader_logo',
            'label'       => esc_html__( 'Preloader Logo Icon', 'nilos' ),
            'description' => esc_html__( 'Preloader Logo Here', 'nilos' ),
            'section'     => 'preloader_section',
            'default'     => get_template_directory_uri() . '/assets/img/loader.png',
        ]
    );   
}

preloader_section();


// offcanvas_side_section
function offcanvas_side_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'offcanvas_side_section',
        [
            'title'       => esc_html__( 'Offcanvas Info', 'nilos' ),
            'description' => esc_html__( 'Offcanvas Information.', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 110,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'nilos_offcanvas_enable',
            'label'       => esc_html__( 'Enable/Disable Offcanvas', 'nilos' ),
            'description' => esc_html__( 'Enable/Disable Offcanvas', 'nilos' ),
            'section'     => 'offcanvas_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'nilos' ),
                'off' => esc_html__( 'Disable', 'nilos' ),
            ],
        ]
    ); 

    new \Kirki\Field\Image(
        [
            'settings'    => 'nilos_offcanvas_logo',
            'label'       => esc_html__( 'Offcanvas Logo', 'nilos' ),
            'description' => esc_html__( 'Offcanvas Logo Here', 'nilos' ),
            'section'     => 'offcanvas_side_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo-2.png',
            'active_callback' => [
                [
                    'setting'  => 'nilos_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'nilos_offcanvas_title',
            'label'    => esc_html__( 'Give a title', 'nilos' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'About US', 'nilos' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'nilos_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'nilos_offcanvas_desc',
            'label'    => esc_html__( 'Write a short description', 'nilos' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut
            labore et magna aliqua. Ut enim ad minim veniam laboris.', 'nilos' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'nilos_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );

    

    new \Kirki\Field\Text(
        [
            'settings' => 'nilos_offcanvas_form_title',
            'label'    => esc_html__( 'Give a form title', 'nilos' ),
            'section'  => 'offcanvas_side_section',
            'default'  => esc_html__( 'Get a free quote', 'nilos' ),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting'  => 'nilos_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings'    => 'nilos_offcanvas_form',
            'label'       => esc_html__( 'Form Shortcode', 'nilos' ),
            'section'     => 'offcanvas_side_section',
            'default'     => '',
            'placeholder' => esc_html__( 'Paste a shortcode here', 'nilos' ),
            'active_callback' => [
                [
                    'setting'  => 'nilos_offcanvas_enable',
                    'operator' => '==',
                    'value'    => true,
                ]
            ],
        ]
    );
}
offcanvas_side_section();


// header_logo_section
function header_logo_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title'       => esc_html__( 'Header Logo', 'nilos' ),
            'description' => esc_html__( 'Header Logo Settings.', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 40,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo',
            'label'       => esc_html__( 'Header Logo', 'nilos' ),
            'description' => esc_html__( 'Theme Default/Primary Logo Here', 'nilos' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.svg',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_secondary_logo',
            'label'       => esc_html__( 'Header Secondary Logo', 'nilos' ),
            'description' => esc_html__( 'Theme Secondary Logo Here', 'nilos' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo-white.svg',
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'nilos_logo_width',
            'label'    => esc_html__( 'Logo Width', 'nilos' ),
            'section'  => 'header_logo_section',
            'default'  => esc_html__( '135', 'nilos' ),
            'priority' => 10,
        ]
    );
}
header_logo_section();


// header_breadcrumb_section
function header_breadcrumb_section(){
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title'       => esc_html__( 'Breadcrumb', 'nilos' ),
            'description' => esc_html__( 'Breadcrumb Settings.', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'breadcrumb_blog_title',
            'label'    => esc_html__( 'Breadcrumb Blog Title', 'nilos' ),
            'section'  => 'header_breadcrumb_section',
            'default'  => __('Blogs & Insights', 'nilos'),
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_image',
            'label'       => esc_html__( 'Breadcrumb Image', 'nilos' ),
            'description' => esc_html__( 'Breadcrumb Image add/remove', 'nilos' ),
            'section'     => 'header_breadcrumb_section',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'breadcrumb_bg_color',
            'label'       => __( 'Breadcrumb BG Color', 'nilos' ),
            'description' => esc_html__( 'You can change breadcrumb bg color from here.', 'nilos' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => '#f3fbfe',
        ]
    );


}
header_breadcrumb_section();

// Mobile nav section
function mobile_nav_section(){
    new \Kirki\Section(
        'mobile_nav_drawer',
        [
            'title'       => esc_html__( 'Mobile Nav Drawer', 'nilos' ),
            'description' => esc_html__( 'Mobile nav settings', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'mobile_nav_logo',
            'label'       => esc_html__( 'Drawer Logo', 'nilos' ),
            'description' => esc_html__( 'Mobile nav drawer logo', 'nilos' ),
            'section'     => 'mobile_nav_drawer',
            'default'     => get_template_directory_uri() ."/assets/img/logo/logo-2.png",
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'mobile_nav_email',
            'label'    => esc_html__( 'Email', 'nilos' ),
            'section'  => 'mobile_nav_drawer',
            'default'  => 'needhelp@nilos.com',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'mobile_nav_tel',
            'label'    => esc_html__( 'Phone', 'nilos' ),
            'section'  => 'mobile_nav_drawer',
            'default'  => '666 888 0000',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Repeater(
        [
            'settings' => 'mobile_nav_socials',
            'label'    => esc_html__( 'Mobile Nav socials', 'nilos' ),
            'section'  => 'mobile_nav_drawer',
            'priority' => 10,
            'row_label'    => [
                'type'  => 'field',
                'value' => esc_html__( 'link', 'nilos' ),
                'field' => 'link_text',
            ],
            'default'  => [
                [
                    'link_text'   => esc_html__( 'fab fa-facebook-square', 'nilos' ),
                    'link_url'    => 'https://facebook.com/',
                    'link_target' => '_self',
                    'checkbox'    => false,
                ]
            ],
            'fields'   => [
                'link_text'   => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link Text', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '',
                ],
                'link_url'    => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link URL', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '',
                ],
                'link_target' => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Link Target', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '_self',
                    'choices'     => [
                        '_blank' => esc_html__( 'New Window', 'nilos' ),
                        '_self'  => esc_html__( 'Same Frame', 'nilos' ),
                    ],
                ]
            ],
        ]
    );

}
mobile_nav_section();

// footer layout
function footer_layout_section(){

    new \Kirki\Section(
        'footer_layout_section',
        [
            'title'       => esc_html__( 'Footer', 'nilos' ),
            'description' => esc_html__( 'Footer Settings.', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_widget_number',
            'label'       => esc_html__( 'Footer Widget Number', 'nilos' ),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__( 'Choose an option', 'nilos' ),
            'choices'     => [
                '1' => esc_html__( '1', 'nilos' ),
                '2' => esc_html__( '2', 'nilos' ),
                '3' => esc_html__( '3', 'nilos' ),
                '4' => esc_html__( '4', 'nilos' ),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'nilos_footer_elementor_switch',
            'label'       => esc_html__( 'Footer Custom/Elementor Switch', 'nilos' ),
            'description' => esc_html__( 'Footer Custom/Elementor On/Off', 'nilos' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'nilos' ),
                'off' => esc_html__( 'Disable', 'nilos' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'footer_layout_custom',
            'label'       => esc_html__( 'Footer Layout Control', 'nilos' ),
            'section'     => 'footer_layout_section',
            'priority'    => 10,
            'choices'     => [
                'footer_1' => get_template_directory_uri() . '/inc/img/footer/footer-1.png'
            ],
            'default'     => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'nilos_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_posttype = array(
        'post_type'      => 'nl-footer',
        'posts_per_page' => -1,
    );
    $footer_posttype_loop = get_posts($footer_posttype);
    $footer_post_obj_arr = array();
    foreach($footer_posttype_loop as $post){
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings'    => 'nilos_footer_templates',
            'label'       => esc_html__( 'Elementor Footer Template', 'nilos' ),
            'section'     => 'footer_layout_section',
            'placeholder' => esc_html__( 'Choose an option', 'nilos' ),
            'choices'     => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'nilos_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );



    // footer_layout_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_logo',
            'label'       => esc_html__( 'Footer logo', 'nilos' ),
            'description' => esc_html__( 'Footer logo add/remove', 'nilos' ),
            'section'     => 'footer_layout_section',
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'nilos_footer_description',
            'label'    => esc_html__( 'Footer descriptions', 'nilos' ),
            'section'  => 'footer_layout_section',
            'default'  => wp_kses_post( 'Nilo was born in San Francisco, California and grew up in a wealthy family. He <br> developed an early interest in music & photography.' ),
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Repeater(
        [
            'settings' => 'footer_socials',
            'label'    => esc_html__( 'Footer socials links', 'nilos' ),
            'section'  => 'footer_layout_section',
            'priority' => 10,
            'row_label'    => [
                'type'  => 'field',
                'value' => esc_html__( 'link', 'nilos' ),
                'field' => 'link_url',
            ],
            'default'  => [
                [
                    'link_text'   => esc_html__( 'Facebook', 'nilos' ),
                    'link_url'    => 'https://facebook.com/',
                    'link_target' => '_self',
                    'checkbox'    => false,
                ]
            ],
            'fields'   => [
                'link_text'   => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link Text', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '',
                ],
                'link_url'    => [
                    'type'        => 'text',
                    'label'       => esc_html__( 'Link URL', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '',
                ],
                'link_target' => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Link Target', 'nilos' ),
                    'description' => esc_html__( 'Description', 'nilos' ),
                    'default'     => '_self',
                    'choices'     => [
                        '_blank' => esc_html__( 'New Window', 'nilos' ),
                        '_self'  => esc_html__( 'Same Frame', 'nilos' ),
                    ],
                ]
            ],
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings'    => 'nilos_footer_bg_color',
            'label'       => __( 'Footer BG Color', 'nilos' ),
            'description' => esc_html__( 'You can change footer bg color from here.', 'nilos' ),
            'section'     => 'footer_layout_section',
            'default'     => '#F4F7F9',
        ]
    );    

    new \Kirki\Field\Text(
        [
            'settings' => 'nilos_copyright',
            'label'    => esc_html__( 'Footer Copyright', 'nilos' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( 'Copyright & Design By @NilosDesign - 2023', 'nilos' ),
            'priority' => 10,
        ]
    );

    $menus = wp_get_nav_menus();

    $options = [];

    foreach ( $menus as $menu ) {
        $options[ $menu->slug ] = $menu->name;
    }

    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_navs',
            'label'       => esc_html__( 'Footer Navs', 'nilos' ),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__( 'Choose a menu', 'nilos' ),
            'choices'     => $options,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'footer_whatsapp',
            'label'    => esc_html__( 'Footer Whatsapp', 'nilos' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( '+999 888 777 00', 'nilos' ),
            'priority' => 10,
        ]
    );
}
footer_layout_section();


// 404 section
function error_404_section(){
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title'       => esc_html__( '404 Page', 'nilos' ),
            'description' => esc_html__( '404 Page Settings.', 'nilos' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'nilos_error_thumb',
            'label'       => esc_html__( 'Error Image', 'nilos' ),
            'description' => esc_html__( 'Error Image Here', 'nilos' ),
            'section'     => 'error_404_section',
            'default'     => get_template_directory_uri() . '/assets/img/error/error.png',
        ]
    );  

    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'nilos_error_title',
            'label'    => esc_html__( 'Not Found Title', 'nilos' ),
            'section'  => 'error_404_section',
            'default'  => "Oops! Page not found",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Textarea(
        [
            'settings' => 'nilos_error_desc',
            'label'    => esc_html__( 'Not Found description', 'nilos' ),
            'section'  => 'error_404_section',
            'default'  => "Whoops, this is embarassing. Looks like the page you were looking for was not found.",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'nilos_error_link_text',
            'label'    => esc_html__( 'Error Link Text', 'nilos' ),
            'section'  => 'error_404_section',
            'default'  => "Back To Home",
            'priority' => 10,
        ]
    );
}
error_404_section();