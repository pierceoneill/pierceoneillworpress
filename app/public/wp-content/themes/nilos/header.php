<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nilos
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open();?>


    <?php
        $nilos_preloader       = get_theme_mod( 'nilos_preloader_switch', 'off' );
        $nilos_oofcanvas       = get_theme_mod( 'nilos_offcanvas_enable', 'off' );
        $nilos_preloader_logo  = get_theme_mod( 'nilos_preloader_logo', get_template_directory_uri() . '/assets/img/loader.png' );
        $nilos_sidebar_logo  = get_theme_mod( 'nilos_sidebar_logo', get_parent_theme_file_uri('assets/img/logo/logo-2.png') );
        $nilos_backtotop = get_theme_mod( 'nilos_backtotop', false );
    ?>

    <?php if($nilos_preloader == 'on') :?>
        <div class="preloader">
            <div class="preloader__image" style="background-image: url(<?php echo esc_url($nilos_preloader_logo); ?>);"></div>
        </div>
        <!-- /.preloader -->
    <?php endif; ?>

    <?php if($nilos_oofcanvas == 'on') :?>
    <?php
        $offcanvas_logo = get_theme_mod('nilos_offcanvas_logo', get_template_directory_uri() . '/assets/img/logo/logo-2.png');
        $offcanvas_title = get_theme_mod('nilos_offcanvas_title', 'About Us');
        $offcanvas_desc = get_theme_mod('nilos_offcanvas_desc', '');
        $offcanvas_form_title = get_theme_mod('nilos_offcanvas_form_title', '');
    ?>
    <!-- Start sidebar widget content -->
    <div class="xs-sidebar-group info-group info-sidebar">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">X</a>
                </div>
                <div class="sidebar-textwidget">
                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($offcanvas_logo); ?>" alt="<?php bloginfo('name'); ?>"></a>
                            </div>
                            <div class="content-box">
                                <h4><?php echo esc_html($offcanvas_title); ?></h4>
                                <p><?php echo wp_kses_post($offcanvas_desc); ?></p>
                            </div>
                            <div class="form-inner">
                                <h4><?php echo esc_html($offcanvas_form_title); ?></h4>
                                <?php echo do_shortcode(get_theme_mod('nilos_offcanvas_form')); ?>
                                <!-- <form class="contact-form-validated"
                                    novalidate="novalidate">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message..."></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="thm-btn form-inner__btn">Submit Now</button>
                                    </div>
                                </form> -->
                                <div class="result"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($nilos_backtotop)) :?>
        <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fas fa-arrow-up"></i></a>
    <?php endif; ?>

    <!-- header start -->
    <?php do_action( 'nilos_header_style' );?>
    <!-- header end -->
    
    <!-- wrapper-box start -->
    <?php do_action( 'nilos_before_main_content' );?>
