<?php
/**
 * 
 * Demo Imports
 */

function nilos_ocdi_import_files() {
    
    return array(
      array(
        'import_file_name'           => 'Home Portfolio',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-1.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://themedox.com/nilos/',
      ),
      array(
        'import_file_name'           => 'Home Photography',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-2.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://themedox.com/nilos/home-2/',
      ),
      array(
        'import_file_name'           => 'Home Lawers',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-3.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://themedox.com/nilos/home-3/',
      ),
      array(
        'import_file_name'           => 'Home Fashion',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-4.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://themedox.com/nilos/home-4/',
      ),
      array(
        'import_file_name'           => 'Home Personal',
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/demo-5.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://themedox.com/nilos/home-5/',
      ),
    );
}
add_filter( 'ocdi/import_files', 'nilos_ocdi_import_files' );


function nilos_ocdi_page($nilos_page_name = 'Home'){
    $posts = get_posts(
        array(
            'post_type'              => 'page',
            'title'                  => $nilos_page_name,
            'post_status'            => 'all',
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'orderby'                => 'post_date ID',
            'order'                  => 'ASC',
        )
    );

    if ( ! empty( $posts ) ) {
        $page_got_by_title = $posts[0];
    } else {
        $page_got_by_title = null;
    }

    return $page_got_by_title;

}


// after demo imports
function nilos_ocdi_after_import_setup( $demo ) {
    $front_page_id = "";
    $blog_page_id = "";
    if( "Home Portfolio" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = nilos_ocdi_page( 'Home 1' );
        $blog_page_id  = nilos_ocdi_page( 'Blogs & News' );
    }else if( "Home Photography" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = nilos_ocdi_page( 'Home 2' );
        $blog_page_id  = nilos_ocdi_page( 'Blogs & News' );
    }
    else if( "Home Lawers" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = nilos_ocdi_page( 'Home 3' );
        $blog_page_id  = nilos_ocdi_page( 'Blogs & News' );
    }
    else if( "Home Fashion" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = nilos_ocdi_page( 'Home 4' );
        $blog_page_id  = nilos_ocdi_page( 'Blogs & News' );
    }
    else if( "Home Personal" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = nilos_ocdi_page( 'Home 5' );
        $blog_page_id  = nilos_ocdi_page( 'Blogs & News' );
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );


    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
 
    set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
        ]
    );
 
}
add_action( 'ocdi/after_import', 'nilos_ocdi_after_import_setup' );



function nilos_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'one-click-demo-import' );
    $default_settings['menu_title']  = esc_html__( 'Import Theme Demos' , 'one-click-demo-import' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'nilos_ocdi_plugin_page_setup' );