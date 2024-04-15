<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nilos
*/

use TPCore\Widgets\Nilos_Navwalker_Class;

$nilos_footer_logo  = get_theme_mod( 'footer_logo' );
$nilos_footer_links = get_theme_mod( 'nilos_footer_links' );
$nilos_footer_description = get_theme_mod( 'nilos_footer_description' );
$menu  = get_theme_mod( 'footer_navs' );
$whatsapp  = get_theme_mod( 'footer_whatsapp' );

// Default values for 'my_repeater_setting' theme mod.
$footer_socials_links = [
	[
		'link_text' => '<i class="fab fa-facebook-f"></i>',
		'link_url'  => 'https://facebook.com/',
	],
    [
		'link_text' => '<i class="fab fa-twitter"></i>',
		'link_url'  => 'https://twitter.com/',
	],
    [
		'link_text' => '<i class="fab fa-behance"></i>',
		'link_url'  => 'https://behance.com/',
	],
    [
		'link_text' => '<i class="fab fa-youtube"></i>',
		'link_url'  => 'https://youtube.com/',
	],
];

// Theme_mod settings to check.
$footer_socials = get_theme_mod( 'my_repeater_setting', $footer_socials_links );

// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-' . $num ) ) {
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    $footer_class[2] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    $footer_class[3] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    $footer_class[4] = 'col-xl-3 col-lg-3 col-md-4 col-sm-6';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>

<!--Site Footer Start-->
<footer class="site-footer-five">
    <div class="container">
        <?php if( $nilos_footer_logo ): ?>
        <div class="site-footer-five__top">
            <div class="site-footer-five__logo">
                <?php nilos_footer_logo(); ?>
            </div>
            <?php if($nilos_footer_description): ?>
            <p class="site-footer-five__text-1"><?php echo wp_kses_post($nilos_footer_description); ?></p>
            <?php endif; ?>
            <?php if(!empty($footer_socials)): ?>
            <ul class="footer-widget-five__social-box list-unstyled">
                <?php foreach($footer_socials as $link): ?>
                <li>
                    <a href="<?php echo esc_url($link['link_url']); ?>"><?php echo wp_kses_post($link['link_text']); ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if(is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4')): ?>
        <div class="footer-widget-five__menu-box row">
            <?php
                if ( $footer_columns < 5 ) {
                    print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-1' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-2' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-3' );
                    print '</div>';

                    print '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">';
                    dynamic_sidebar( 'footer-4' );
                    print '</div>';
                } else {
                    for ( $num = 1; $num <= $footer_columns; $num++ ) {
                        if ( !is_active_sidebar( 'footer-col-' . $num ) ) {
                            continue;
                        }
                        print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                        dynamic_sidebar( 'footer-col-' . $num );
                        print '</div>';
                    }
                }
            ?>
        </div>
        <?php endif; ?>
        <?php
        $args = [
            'echo'        => false,
            'menu'        => $menu,
            'menu_class'  => 'list-unstyled footer-widget-five__menu',
            'fallback_cb' => 'Nilos_Navwalker_Class::fallback',
            'container'   => '',
            'walker'      => new Nilos_Navwalker_Class,
        ];

        $menu_html = wp_nav_menu( $args );
        ?>
        <?php if($menu && $whatsapp): ?>
        <div class="footer-widget-five__menu-box">
            <?php echo wp_kses_post($menu_html); ?>
            <p class="footer-widget-five__number"><?php esc_html_e('WhatsApp:', 'nilos'); ?><a href="tel:<?php echo esc_url($whatsapp); ?>"><?php echo esc_html($whatsapp); ?></a></p>
        </div>
        <?php endif; ?>
        <div class="site-footer-five__bottom">
            <p class="site-footer-five__bottom-text"><?php print nilos_copyright_text(); ?></p>
        </div>
    </div>
</footer>
<!--Site Footer End-->
