<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package nilos
 */


function nilos_check_header() {
    $nl_header_tabs = function_exists('get_field')? get_field('header') : false;
    $nl_header_style_meta = function_exists('get_field')? get_field('nilos_header_style') : '';
    $elementor_header_template_meta = function_exists('get_field')? get_field('elementor_header_style') : false;


    $nilos_header_option_switch = get_theme_mod('nilos_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod( 'header_layout_custom', 'header_1' );
    $elementor_header_templates_kirki = get_theme_mod( 'nilos_header_templates' );
    
    if($nl_header_tabs == 'default'){
        if($nilos_header_option_switch){
            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }else{ 
            get_template_part( 'template-parts/header/header-1' );
        }
    }elseif($nl_header_tabs == 'elementor'){
        if($elementor_header_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    }else{
        if($nilos_header_option_switch){

            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }else{
            get_template_part( 'template-parts/header/header-1' );
        }
        
    }

}
add_action( 'nilos_header_style', 'nilos_check_header', 10 );


/* nilos offcanvas */

function nilos_check_offcanvas() {
    $nilos_offcanvas_style = function_exists( 'get_field' ) ? get_field( 'nilos_offcanvas_style' ) : NULL;
    $nilos_default_offcanvas_style = get_theme_mod( 'choose_default_offcanvas', 'offcanvas-style-1' );

    if ( $nilos_offcanvas_style == 'offcanvas-style-1' ) {
        get_template_part( 'template-parts/offcanvas/offcanvas-1' );

    }
    elseif($nilos_offcanvas_style == 'offcanvas-style-2' ){
        get_template_part( 'template-parts/offcanvas/offcanvas-2' );
    }

    
    else{
        if ( $nilos_default_offcanvas_style == 'offcanvas-style-2' ) {
            get_template_part( 'template-parts/offcanvas/offcanvas-2' );
        } 

        else {
            get_template_part( 'template-parts/offcanvas/offcanvas-1' );
        }
    }
}

add_action( 'nilos_offcanvas_style', 'nilos_check_offcanvas', 10 );




/**
 * [nilos_header_lang description]
 * @return [type] [description]
 */
function nilos_header_lang_defualt() {
   ?>

    <div class="nl-header-top-menu-item nl-header-lang">
        <span class="nl-header-lang-toggle" id="nl-header-lang-toggle"><?php print esc_html__( 'English', 'nilos' );?></span>
        <?php do_action( 'nilos_language' );?>
    </div>
<?php
}

/**
 * [nilos_language_list description]
 * @return [type] [description]
 */
function _nilos_language( $mar ) {
    return $mar;
}
function nilos_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'nilos' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'nilos' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'nilos' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _nilos_language( $mar );
}
add_action( 'nilos_language', 'nilos_language_list' );





/**
 * [nilos_offcanvas_language description]
 * @return [type] [description]
 */


 /**
 * [nilos_header_lang description]
 * @return [type] [description]
 */
function nilos_offcanvas_lang_defualt() {
    ?>
  
     <div class="offcanvas__select language">
         <div class="offcanvas__lang d-flex align-items-center justify-content-md-end">
             <div class="offcanvas__lang-img mr-15">
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/language-flag.png" alt="<?php echo esc_attr__('language', 'nilos'); ?>">
             </div>
 
             <div class="offcanvas__lang-wrapper">
                 <span class="offcanvas__lang-selected-lang nl-lang-toggle" id="nl-offcanvas-lang-toggle"><?php echo esc_html__('English', 'nilos'); ?></span> 
                 <?php do_action( 'nilos_offcanvas_language' );?>
             </div>
         </div>
     </div>
 <?php
 }
function _nilos_offcanvas_language( $mar ) {
    return $mar;
}
function nilos_offcanvas_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="offcanvas__lang-list nl-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="offcanvas__lang-list nl-lang-list">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'nilos' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'nilos' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'nilos' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _nilos_language( $mar );
}
add_action( 'nilos_offcanvas_language', 'nilos_offcanvas_language_list' );



/**
 * [nilos_language_list description]
 * @return [type] [description]
 */
function _nilos_footer_language( $mar ) {
    return $mar;
}
function nilos_footer_language_list() {
    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="footer__lang-list nl-lang-list-2">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="footer__lang-list nl-lang-list-2">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'nilos' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Spanish', 'nilos' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'nilos' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _nilos_footer_language( $mar );
}
add_action( 'nilos_footer_language', 'nilos_footer_language_list' );



// header logo
function nilos_header_logo() { ?>
    <?php
        $nilos_logo_on = function_exists('get_field')? get_field('nilos_en_secondary_logo') : NULL;
        $nilos_logo = get_template_directory_uri() . '/assets/img/logo/logo-4.png';
        $nilos_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-4.png';

        $nilos_site_logo_width = get_theme_mod( 'nilos_logo_width', '135');

        $nilos_site_logo = get_theme_mod( 'header_logo', $nilos_logo );
        $nilos_secondary_logo = get_theme_mod( 'header_secondary_logo', $nilos_logo_white );
    ?>

    <?php if ( $nilos_logo_on == 'on' ) : ?>
    <a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" src="<?php print esc_url( $nilos_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'nilos' );?>" />
    </a>
    <?php else : ?>
    <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" src="<?php print esc_url( $nilos_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'nilos' );?>" />
    </a>
    <?php endif; ?>
<?php
}

// header logo
function nilos_header_double_logo() { ?>
    <?php
        $nilos_logo = get_template_directory_uri() . '/assets/img/logo/logo.svg';
        $nilos_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-white.svg';

        $nilos_site_logo_width = get_theme_mod( 'nilos_logo_width', '135');

        $nilos_site_logo = get_theme_mod( 'header_logo', $nilos_logo );
        $nilos_logo_white = get_theme_mod( 'header_secondary_logo', $nilos_logo_white );

        ?>
    
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $nilos_logo_white ); ?>" alt="<?php print esc_attr__( 'logo', 'nilos' );?>">
            <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $nilos_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'nilos' );?>">
        </a>
<?php
}


// nilos_footer_logo
function nilos_footer_logo() { ?>
      <?php
        $nilos_foooter_logo = function_exists( 'get_field' ) ? get_field( 'nilos_footer_logo' ) : NULL;

        $nilos_logo = get_template_directory_uri() . '/assets/img/logo/logo-2.png';

        $nilos_footer_logo_default = get_theme_mod( 'nilos_footer_logo', $nilos_logo );
        $nilos_site_logo_width = get_theme_mod( 'nilos_logo_width', '120');
      ?>

      <?php if ( !empty( $nilos_foooter_logo ) ) : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" src="<?php print esc_url( $nilos_foooter_logo );?>" alt="<?php print esc_attr__( 'logo', 'nilos' );?>" />
         </a>
      <?php else : ?>
         <a href="<?php print esc_url( home_url( '/' ) );?>">
             <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" src="<?php print esc_url( $nilos_footer_logo_default );?>" alt="<?php print esc_attr__( 'logo', 'nilos' );?>" />
         </a>
      <?php endif; ?>
   <?php
}


// header logo
function nilos_header_sticky_logo() {?>
    <?php
        $nilos_sticky_logo = function_exists( 'get_field' ) ? get_field( 'nilos_sticky_logo' ) : NULL;
        $nilos_logo = get_theme_mod( 'nilos_sticky_logo', get_template_directory_uri() . '/assets/img/logo/logo-black-solid.svg' );
        $nilos_secondary_logo = get_theme_mod( 'seconday_logo',  get_template_directory_uri() . '/assets/img/logo/logo.svg');
        $nilos_site_logo_width = get_theme_mod( 'nilos_logo_width', '120');
    ?>
        <?php if ( !empty( $nilos_sticky_logo ) ) : ?>
        <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $nilos_sticky_logo );?>" alt="logo">
        </a>
        <?php else : ?>
            <a href="<?php print esc_url( home_url( '/' ) );?>">
            <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" class="logo-dark" src="<?php print esc_url( $nilos_logo );?>" alt="logo">
            <img data-width="<?php echo esc_attr($nilos_site_logo_width); ?>" height="auto" class="logo-light" src="<?php print esc_url( $nilos_secondary_logo );?>" alt="logo">
        </a>
        <?php endif; ?>
    <?php
}

function nilos_mobile_logo() {
    // side info
    $nilos_mobile_logo_hide = get_theme_mod( 'nilos_mobile_logo_hide', false );

    $nilos_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $nilos_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $nilos_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'nilos' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }

/**
 * [nilos_header_social_profiles description]
 * @return [type] [description]
 */
function nilos_header_social_profiles() {
    $nilos_topbar_fb_url = get_theme_mod( 'nilos_topbar_fb_url', __( '#', 'nilos' ) );
    $nilos_topbar_twitter_url = get_theme_mod( 'nilos_topbar_twitter_url', __( '#', 'nilos' ) );
    $nilos_topbar_instagram_url = get_theme_mod( 'nilos_topbar_instagram_url', __( '#', 'nilos' ) );
    $nilos_topbar_linkedin_url = get_theme_mod( 'nilos_topbar_linkedin_url', __( '#', 'nilos' ) );
    $nilos_topbar_youtube_url = get_theme_mod( 'nilos_topbar_youtube_url', __( '#', 'nilos' ) );
    ?>
        <ul>
        <?php if ( !empty( $nilos_topbar_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $nilos_topbar_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $nilos_topbar_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $nilos_topbar_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $nilos_topbar_instagram_url ) ): ?>
            <li><a href="<?php print esc_url( $nilos_topbar_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $nilos_topbar_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $nilos_topbar_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $nilos_topbar_youtube_url ) ): ?>
            <li><a href="<?php print esc_url( $nilos_topbar_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a></li>
        <?php endif;?>
        </ul>

<?php
}

/**
 * [nilos_offcanvas_social_profiles description]
 * @return [type] [description]
 */
function nilos_offcanvas_social_profiles() {

    $nilos_offcanvas_fb_url = get_theme_mod( 'nilos_offcanvas_fb_url', __( '#', 'nilos' ) );
    $nilos_offcanvas_twitter_url = get_theme_mod( 'nilos_offcanvas_twitter_url', __( '#', 'nilos' ) );
    $nilos_offcanvas_instagram_url = get_theme_mod( 'nilos_offcanvas_instagram_url', __( '#', 'nilos' ) );
    $nilos_offcanvas_linkedin_url = get_theme_mod( 'nilos_offcanvas_linkedin_url', __( '#', 'nilos' ) );
    $nilos_offcanvas_youtube_url = get_theme_mod( 'nilos_offcanvas_youtube_url', __( '#', 'nilos' ) );
    ?>
        <?php if ( !empty( $nilos_offcanvas_fb_url ) ): ?>
            <a href="<?php print esc_url( $nilos_offcanvas_fb_url );?>"><span><i class="fab fa-facebook-f"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $nilos_offcanvas_twitter_url ) ): ?>
            <a href="<?php print esc_url( $nilos_offcanvas_twitter_url );?>"><span><i class="fab fa-twitter"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $nilos_offcanvas_instagram_url ) ): ?>
            <a href="<?php print esc_url( $nilos_offcanvas_instagram_url );?>"><span><i class="fab fa-instagram"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $nilos_offcanvas_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $nilos_offcanvas_linkedin_url );?>"><span><i class="fab fa-linkedin"></i></span></a>
        <?php endif;?>

        <?php if ( !empty( $nilos_offcanvas_youtube_url ) ): ?>
            <a href="<?php print esc_url( $nilos_offcanvas_youtube_url );?>"><span><i class="fab fa-youtube"></i></span></a>
        <?php endif;?>
<?php
}

function nilos_footer_social_profiles() {
    $nilos_footer_fb_url = get_theme_mod( 'nilos_footer_fb_url', __( '#', 'nilos' ) );
    $nilos_footer_twitter_url = get_theme_mod( 'nilos_footer_twitter_url', __( '#', 'nilos' ) );
    $nilos_footer_instagram_url = get_theme_mod( 'nilos_footer_instagram_url', __( '#', 'nilos' ) );
    $nilos_footer_linkedin_url = get_theme_mod( 'nilos_footer_linkedin_url', __( '#', 'nilos' ) );
    $nilos_footer_youtube_url = get_theme_mod( 'nilos_footer_youtube_url', __( '#', 'nilos' ) );
    ?>

        <?php if ( !empty( $nilos_footer_fb_url ) ): ?>
            <a href="<?php print esc_url( $nilos_footer_fb_url );?>">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $nilos_footer_twitter_url ) ): ?>
            <a href="<?php print esc_url( $nilos_footer_twitter_url );?>">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $nilos_footer_instagram_url ) ): ?>
            <a href="<?php print esc_url( $nilos_footer_instagram_url );?>">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $nilos_footer_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $nilos_footer_linkedin_url );?>">
                <i class="fab fa-linkedin"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $nilos_footer_youtube_url ) ): ?>
            <a href="<?php print esc_url( $nilos_footer_youtube_url );?>">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif;?>
<?php
}


/**
 * [nilos_header_menu description]
 * @return [type] [description]
 */
function nilos_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'main-menu__list',
            'container'      => '',
            'fallback_cb'    => 'Nilos_Navwalker_Class::fallback',
            'walker'         => new \TPCore\Widgets\Nilos_Navwalker_Class,
        ] );
    ?>
    <?php
}



/**
 * [nilos_footer_menu description]
 * @return [type] [description]
 */
function nilos_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0 footer-list-inline-3',
        'container'      => '',
        'fallback_cb'    => 'Nilos_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Nilos_Navwalker_Class,
    ] );
}

/**
 * [nilos_offcanvas_default_menu description]
 * @return [type] [description]
 */
function nilos_offcanvas_default_menu() {
    wp_nav_menu( [
        'theme_location' => 'offcanvas-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Nilos_Navwalker_Class::fallback',
        'walker'         => new \TPCore\Widgets\Nilos_Navwalker_Class,
    ] );
}

/**
 *
 * nilos footer
 */
add_action( 'nilos_footer_style', 'nilos_check_footer', 10 );

function nilos_check_footer() {
    $page_footer = function_exists('get_field')? get_field('footer') : false;
    $page_elementor_footer_style = function_exists('get_field')? get_field('element_footer_styles') : false;
    $nilos_footer_option_switch = get_theme_mod('nilos_footer_elementor_switch', false);
    $elementor_footer_templates_kirki = get_theme_mod( 'nilos_footer_templates' );
    
    if($page_footer == 'default'){
        if($nilos_footer_option_switch){
            if($elementor_footer_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }
        }else{ 
            get_template_part( 'template-parts/footer/footer-1' );
        }
    }elseif($page_footer == 'elementor'){
        if($page_elementor_footer_style){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($page_elementor_footer_style);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }
    }else{
        if($elementor_footer_templates_kirki){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        }else{
            get_template_part( 'template-parts/footer/footer-1' );
        }
    }

}

// nilos_copyright_text
function nilos_copyright_text() {
   print get_theme_mod( 'nilos_copyright', wp_kses_post( 'Copyright & Design By <a href="#">@NilosDesign</a> - 2023' ) );
}

/**
 *
 * pagination
 */
if ( !function_exists( 'nilos_pagination' ) ) {

    function _nilos_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function nilos_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
            'before_page_number'    => '0'
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];

            
        }     

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul class="'.$args['class'].'">';
            foreach ( $paginations as $key => $pg ) {
                if(strpos($pg, 'current') !== false){
                    $pagi .= '<li><a href="#" class="active">' . $pg . '</a></li>';
                }elseif(strpos($pg, 'dots') !== false){
                    $pagi .= '<li><a href="#">---</a></li>';
                }else{
                    $pagi .= '<li>'.$pg.'</li>';
                }
            }
            $pagi .= '</ul>';
        }

        print _nilos_pagi_callback( $pagi );
    }
}

function nilos_paginate_links_dots( $args ) {
    // Replace '...' with your custom dots HTML.
    $args['dots'] = '<a href="#">---</a>';
    return $args;
}

add_filter('wp_link_pages_args', 'nilos_paginate_links_dots');


// header top bg color
function nilos_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'nilos_breadcrumb_bg_color', '#e1e1e1' );
    wp_enqueue_style( 'nilos-custom', NILOS_THEME_CSS_DIR . 'nilos-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'nilos-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nilos_breadcrumb_bg_color' );

// breadcrumb-spacing top
function nilos_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'nilos_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'nilos-custom', NILOS_THEME_CSS_DIR . 'nilos-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'nilos-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nilos_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function nilos_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'nilos_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'nilos-custom', NILOS_THEME_CSS_DIR . 'nilos-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'nilos-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nilos_breadcrumb_bottom_spacing' );

// scrollup
function nilos_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'nilos_scrollup_switch', false );
    wp_enqueue_style( 'nilos-custom', NILOS_THEME_CSS_DIR . 'nilos-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'nilos-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nilos_scrollup_switch' );

// theme color
function nilos_custom_color() {
    $color_code = get_theme_mod( 'nilos_color_option', '#F50963' );
    wp_enqueue_style( 'nilos-custom', NILOS_THEME_CSS_DIR . 'nilos-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --nl-theme-1 : " . $color_code . "}";

        wp_add_inline_style( 'nilos-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nilos_custom_color' );


// theme color secondary
function nilos_custom_color_secondary() {
    $color_code = get_theme_mod( 'nilos_color_option_2', '#008080' );
    wp_enqueue_style( 'nilos-custom', NILOS_THEME_CSS_DIR . 'nilos-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --nl-theme-2 : " . $color_code . "}";

        wp_add_inline_style( 'nilos-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nilos_custom_color_secondary' );

// scroll to top color
function nilos_custom_color_scrollup() {
    $color_code = get_theme_mod( 'nilos_color_scrollup', '#03041C' );
    wp_enqueue_style( 'nilos-custom', NILOS_THEME_CSS_DIR . 'nilos-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html .back-to-top-btn { background-color: " . $color_code . "}";
        wp_add_inline_style( 'nilos-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'nilos_custom_color_scrollup' );

/**
 * Move the textarea field to the bottom
 */
function nilos_move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'nilos_move_comment_field' );

// nilos_kses_intermediate
function nilos_kses_intermediate( $string = '' ) {
    return wp_kses( $string, nilos_get_allowed_html_tags( 'intermediate' ) );
}

function nilos_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function nilos_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'nilos_archive_count_span' );
function nilos_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'nilos_cat_count_span');
function nilos_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}