<?php
/**
 * Breadcrumbs for nilos theme.
 *
 * @package     nilos
 * @author      themedox
 * @copyright   Copyright (c) 2023, themedox
 * @link        https://www.wphix.com
 * @since       nilos 1.0.0
 */

function nilos_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;
    $title = '';
    if ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog & Insights','nilos'));
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
        $title = 'Single Blog';
    }
    elseif ( is_single() && 'services' == get_post_type() ) {
        $title = 'Single Service';
    }
    elseif ( is_single() && 'portfolio' == get_post_type() ) {
        $title = 'Single Portfolio';
    }
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'nilos' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'nilos' );
        $breadcrumb_show = 0;
    } 
    elseif ( is_archive() ) {
        
        $title = get_the_archive_title();
    } 
    else {
        $title = get_the_title();
    }
 

    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    }
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog & Insights','nilos'));
    }

    $is_breadcrumb = function_exists('get_field')? get_field('is_it_invisible_breadcrumb', $_id) : false;

    $con1 = $breadcrumb_show == 1;
    
    if (  $con1 && !$is_breadcrumb) {
        $bg_img_from_page = function_exists('get_field')? get_field('breadcrumb_background_image') : '';
        $hide_bg_img = function_exists('get_field')? get_field('hide_breadcrumb_background_image') : false;

        // get_theme_mod
        $bg_img = get_theme_mod( 'breadcrumb_image' );

        if ( $hide_bg_img == 'off' ) {
            $bg_main_img = '';
        }else{  
            $bg_main_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }   
    ?>

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__shape-1 float-bob-y">
            <img src="<?php print esc_attr($bg_main_img);?>" alt="">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <?php if(is_front_page() || is_home()): ?>
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'nilos'); ?></a></li>
                        <li><span>/</span></li>
                        <li><?php esc_html_e('News', 'nilos'); ?></li>
                    </ul>
                <?php else: ?>
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'nilos'); ?></a></li>
                        <li><span>/</span></li>
                        <li><?php single_post_title(); ?></li>
                    </ul>
                <?php endif; ?>
                <h2><?php echo nilos_kses( $title ); ?></h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

<?php
    }
}

add_action( 'nilos_before_main_content', 'nilos_breadcrumb_func' );

