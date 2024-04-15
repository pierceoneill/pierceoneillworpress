<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  nilos
 */
get_header();

$post_column = is_active_sidebar( 'services-sidebar' ) ? 'col-lg-8 order-first order-lg-last' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'services-sidebar' ) ? '' : 'justify-content-center';

?>
<!--Services Details Start-->
<section class="services-details">
    <div class="container">
         <?php 
            if( have_posts() ) : 
            while( have_posts() ) : 
            the_post();
         ?>
         <?php if(has_post_thumbnail()): ?>
        <div class="services-details__img">
            <?php the_post_thumbnail(); ?>
        </div>
        <?php endif; ?>
        <h3 class="services-details__title-1"><?php the_title(); ?></h3>
        <?php echo wp_kses_post(get_the_content()); ?>
        <?php
            endwhile; 
            wp_reset_query();
            endif;
         ?>
    </div>
</section>
<!--Services Details End-->


<?php get_footer();  ?>
