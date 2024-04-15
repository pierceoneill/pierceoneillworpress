<?php
    $mobile_nav_logo    = get_theme_mod('mobile_nav_logo', get_template_directory_uri() ."/assets/img/logo/logo-2.png");
    $mobile_nav_email   = get_theme_mod('mobile_nav_email', 'needhelp@nilos.com');
    $mobile_nav_tel     = get_theme_mod('mobile_nav_tel', '666 888 0000');
?>

<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

        <div class="logo-box">
            <a href="<?php echo home_url(); ?>" aria-label="logo image"><img src="<?php echo esc_url($mobile_nav_logo); ?>" width="140" alt="" /></a>
        </div>
        <!-- /.logo-box -->
        <div class="mobile-nav__container"></div>
        <!-- /.mobile-nav__container -->

        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:<?php echo esc_html($mobile_nav_email); ?>"><?php echo esc_html($mobile_nav_email); ?></a>
            </li>
            <li>
                <i class="fa fa-phone-alt"></i>
                <a href="tel:<?php echo esc_html($mobile_nav_tel); ?>"><?php echo esc_html($mobile_nav_tel); ?></a>
            </li>
        </ul><!-- /.mobile-nav__contact -->
        <?php
            $mobile_nav_social = get_theme_mod('mobile_nav_socials', '');
            if(!empty($mobile_nav_social)):
        ?>
        <div class="mobile-nav__top">
            <div class="mobile-nav__social">
                <?php foreach($mobile_nav_social as $social): ?>
                    <a href="<?php echo esc_url($social['link_url']); ?>" class="<?php echo esc_attr($social['link_text']); ?>"></a>
                <?php endforeach; ?>
            </div><!-- /.mobile-nav__social -->
        </div><!-- /.mobile-nav__top -->
        <?php endif; ?>
    </div>
    <!-- /.mobile-nav__content -->
</div>
<!-- /.mobile-nav__wrapper -->

<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fas fa-arrow-up"></i></a>

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nilos
 */

do_action( 'nilos_footer_style' );

wp_footer();?>
</body>

</html>
