<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nilos
 */

$nilos_blog_btn = get_theme_mod( 'nilos_blog_btn', 'Read More' );
$nilos_blog_btn_switch = get_theme_mod( 'nilos_blog_btn_switch', true );

?>

<?php if ( !empty( $nilos_blog_btn_switch ) ): ?>
<div class="postbox__read-more">
    <a href="<?php the_permalink();?>" class="nl-btn">
    <?php print esc_html( $nilos_blog_btn );?>
        <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 6.97559L1 6.97559" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.95312 0.951L16.0031 6.975L9.95312 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
</div>
<?php endif;?>