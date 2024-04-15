<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package nilos
	*/
   // topbar settings
   $nilos_fb_link    = get_theme_mod( 'nilos_fb_link', __( 'info@nilos.com', 'nilos' ) );
   $nilos_fb_text    = get_theme_mod( 'nilos_fb_text', __( '7500k Followers ', 'nilos' ) );

   // main header settings
   $nilos_header_search      = get_theme_mod( 'nilos_header_search', false );
   $nilos_header_hamburger   = get_theme_mod( 'nilos_header_hamburger', false );
   $header_right_switch      = get_theme_mod( 'header_right_switch', false );
   $sticky_header            = get_theme_mod( 'sticky_header', 'off' );
   $nilos_menu_col           = $header_right_switch ? 'col-xl-5 d-none d-xl-block' : 'col-xl-10 col-lg-7 col-md-7 col-sm-8 col-6 d-none d-xl-block';
   $nilos_menu_align         = $header_right_switch ? '' : 'justify-content-end';
?>
<header class="main-header-six">
    <nav class="main-menu main-menu-six">
        <div class="main-menu-six__wrapper">
            <div class="container">
                <div class="main-menu-six__wrapper-inner">
                    <div class="main-menu-six__logo">
                        <?php nilos_header_logo(); ?>
                    </div>
                    <div class="main-menu-six__main-menu-box">
                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                        <?php nilos_header_menu();?>
                    </div>
                    <?php if($header_right_switch): ?>
                    <div class="main-menu-six__right">
                        <?php
                            $header_socials = get_theme_mod('header_socials', '');
                            $cv_link = get_theme_mod('download_cv', '');
                            if(!empty($header_socials)):
                        ?>
                        <div class="main-menu-six__social">
                            <?php foreach($header_socials as $social): ?>
                            <a href="<?php echo esc_url($social['link_url']); ?>"><?php echo esc_html($social['link_text']); ?></a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <div class="main-menu-six__btn">
                            <a href="<?php echo esc_url($cv_link); ?>" download><?php esc_html_e('Download CV', 'nilos'); ?> <span></span> </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
<?php if($sticky_header == 'on'): ?>
<div class="stricky-header stricked-menu main-menu main-menu-six">
    <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
</div><!-- /.stricky-header -->
<?php endif; ?>