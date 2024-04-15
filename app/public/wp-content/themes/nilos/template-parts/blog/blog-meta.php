<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nilos
 */

$categories = get_the_terms( $post->ID, 'category' );

$nilos_blog_date = get_theme_mod( 'nilos_blog_date', true );
$nilos_blog_comments = get_theme_mod( 'nilos_blog_comments', true );
$nilos_blog_author = get_theme_mod( 'nilos_blog_author', true );
$nilos_blog_cat = get_theme_mod( 'nilos_blog_cat', false );
$nilos_blog_view_count = get_theme_mod( 'nilos_blog_view_count', false );

?>
<div class="news-page__date-and-comment">
    <div class="news-page__date-box">
        <p class="news-page__date-sub-title"><a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a></p>
        <p class="news-page__date"><span class="icon-calendar"></span><?php the_time( get_option('date_format') ); ?></p>
    </div>
    <ul class="news-page__comment list-unstyled">
        <li>
            <p><span class="icon-chat"></span><?php comments_number();?></p>
        </li>
        <?php if($nilos_blog_view_count): ?>
        <li>
            <p><span class="icon-open-eye"></span>2000+ View</p>
        </li>
        <?php endif; ?>
    </ul>
</div>
