<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nilos_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_style_2_switch', true );
    $footer_style_3_switch = get_theme_mod( 'footer_style_3_switch', true );
    $footer_style_4_switch = get_theme_mod( 'footer_style_4_switch', true );
    $footer_style_5_switch = get_theme_mod( 'footer_style_5_switch', true );
    $footer_style_6_switch = get_theme_mod( 'footer_style_6_switch', true );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'nilos' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Set Your Blog Widget', 'nilos' ),
        'before_widget' => '<div id="%1$s" class="nl-sidebar-widget mb-35 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="nl-sidebar-widget-title news-page__sidebar-title">',
        'after_title'   => '</h3>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'nilos' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'nilos' ), $num ),
            'before_widget' => '<div id="%1$s" class="nl-footer-widget mb-50 footer-col-'.$num.' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="nl-footer-widget-title">',
            'after_title'   => '</h4>',
        ] );
    }
}
add_action( 'widgets_init', 'nilos_widgets_init' );