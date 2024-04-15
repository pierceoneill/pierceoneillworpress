<?php

/**
 * nilos_scripts description
 * @return [type] [description]
 */
function nilos_scripts()
{

    /**
     * all css files
     */

    wp_enqueue_style('nilos-fonts', nilos_fonts_url(), array(), time());
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', NILOS_THEME_CSS_DIR . 'bootstrap-rtl.css', array());
    } else {
        wp_enqueue_style('bootstrap', NILOS_THEME_CSS_DIR . 'bootstrap.css', array());
    }
    wp_enqueue_style('animate', NILOS_THEME_CSS_DIR . 'animate.css', []);
    wp_enqueue_style('custom-animate', NILOS_THEME_CSS_DIR . 'custom-animate.css', []);
    wp_enqueue_style('fontawesome', NILOS_THEME_CSS_DIR . 'fontawesome.min.css', []);
    wp_enqueue_style('fontawesome-pro', NILOS_THEME_CSS_DIR . 'font-awesome-pro.css', []);
    wp_enqueue_style('jarallax', NILOS_THEME_CSS_DIR . 'jarallax.css', []);
    wp_enqueue_style('magnific-popup', NILOS_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('odometer', NILOS_THEME_CSS_DIR . 'odometer.min.css', []);
    wp_enqueue_style('swiper-bundle', NILOS_THEME_CSS_DIR . 'swiper-bundle.css', []);
    wp_enqueue_style('slick', NILOS_THEME_CSS_DIR . 'slick.css', []);
    wp_enqueue_style('nilos-icons', NILOS_THEME_CSS_DIR . 'nilos-icons.css', []);
    wp_enqueue_style('owl-crousel', NILOS_THEME_CSS_DIR . 'owl.carousel.min.css', []);
    wp_enqueue_style('owl-crousel-theme', NILOS_THEME_CSS_DIR . 'owl.theme.default.min.css', []);
    wp_enqueue_style('spacing', NILOS_THEME_CSS_DIR . 'spacing.css', []);
    wp_enqueue_style('monument', NILOS_THEME_CSS_DIR . 'monument.css', []);
    wp_enqueue_style('pera-font', NILOS_THEME_CSS_DIR . 'pera-font.css', []);

    wp_enqueue_style('nilos', NILOS_THEME_CSS_DIR . 'nilos.css', [], time());
    wp_enqueue_style('color-2', NILOS_THEME_CSS_DIR . 'color-2.css', [], time());
    wp_enqueue_style('color-3', NILOS_THEME_CSS_DIR . 'color-3.css', [], time());
    wp_enqueue_style('color-4', NILOS_THEME_CSS_DIR . 'color-4.css', [], time());
    wp_enqueue_style('nilos-unit', NILOS_THEME_CSS_DIR . 'nilos-unit.css', [], time());
    wp_enqueue_style('nilos-responsive', NILOS_THEME_CSS_DIR . 'nilos-responsive.css', []);
    wp_enqueue_style('nilos-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle', NILOS_THEME_JS_DIR . 'bootstrap-bundle.js', ['jquery'], '', true);
    wp_enqueue_script('jarallax', NILOS_THEME_JS_DIR . 'jarallax.min.js', ['jquery'], '', true);
    wp_enqueue_script('ajaxchimp', NILOS_THEME_JS_DIR . 'jquery.ajaxchimp.min.js', ['jquery'], '', true);
    wp_enqueue_script('apear', NILOS_THEME_JS_DIR . 'jquery.appear.min.js', ['jquery'], '', true);
    wp_enqueue_script('circle-progress', NILOS_THEME_JS_DIR . 'jquery.circle-progress.min.js', ['jquery'], '', true);
    wp_enqueue_script('swiper-bundle', NILOS_THEME_JS_DIR . 'swiper-bundle.js', ['jquery'], false, true);
    wp_enqueue_script('wnumb', NILOS_THEME_JS_DIR . 'wNumb.min.js', ['jquery'], false, true);
    wp_enqueue_script('magnific-popup', NILOS_THEME_JS_DIR . 'magnific-popup.js', ['jquery'], '', true);
    wp_enqueue_script('marquee', NILOS_THEME_JS_DIR . 'marquee.min.js', ['jquery'], '', true);
    wp_enqueue_script('slick', NILOS_THEME_JS_DIR . 'slick.js', ['jquery'], '', true);
    wp_enqueue_script('validate', NILOS_THEME_JS_DIR . 'jquery.validate.min.js', ['jquery'], '', true);
    wp_enqueue_script('odometer', NILOS_THEME_JS_DIR . 'odometer.min.js', ['jquery'], '', true);
    wp_enqueue_script('nice-select', NILOS_THEME_JS_DIR . 'nice-select.js', ['jquery'], '', true);
    wp_enqueue_script('wow', NILOS_THEME_JS_DIR . 'wow.js', ['jquery'], false, true);
    wp_enqueue_script('isotope-pkgd', NILOS_THEME_JS_DIR . 'isotope-pkgd.js', ['imagesloaded'], false, true);
    wp_enqueue_script('owl-carousel', NILOS_THEME_JS_DIR . 'owl.carousel.min.js', ['jquery'], false, true);
    wp_enqueue_script('bootstrap-select', NILOS_THEME_JS_DIR . 'bootstrap-select.min.js', ['jquery'], false, true);
    wp_enqueue_script('circle-type', NILOS_THEME_JS_DIR . 'jquery.circleType.js', ['jquery'], false, true);
    wp_enqueue_script('lettering', NILOS_THEME_JS_DIR . 'jquery.lettering.min.js', ['jquery'], false, true);
    wp_enqueue_script('sidebar-content', NILOS_THEME_JS_DIR . 'jquery-sidebar-content.js', ['jquery'], false, true);
    wp_enqueue_script('nilos-main', NILOS_THEME_JS_DIR . 'nilos.js', ['jquery'], time(), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('nilos-main', 'nilos', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        '_nonce'    => wp_create_nonce('portfolio')
    ));
}
add_action('wp_enqueue_scripts', 'nilos_scripts');

/*
Register Fonts
 */
function nilos_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'nilos')) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap&family=Prata&display=swap');
    }
    return $font_url;
}
