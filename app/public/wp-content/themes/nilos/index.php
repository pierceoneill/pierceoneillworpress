<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nilos
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-xl-9 col-lg-8' : 'col-xl-12 col-lg-12';

?>

<section class="nl-blog-area nl-postbox-area pt-120 pb-120 news-page">
    <div class="container">
        <div class="row">
			<div class="<?php print esc_attr( $blog_column );?>">
				<div class="nl-postbox-wrapper pr-50">
					<?php
						if ( have_posts() ){
    					if ( is_home() && !is_front_page() ):
    				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
					</header>
					<?php endif; ?>
						<?php
						/* Start the Loop */
						while ( have_posts() ): the_post();
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content' );
						endwhile;
						?>
						<div class="news-page__pagination">
							<?php nilos_pagination( '<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>', '', ['class' => 'pg-pagination list-unstyled'] );?>
						</div>
					<?php
						}else{
							get_template_part( 'template-parts/content', 'none' );
						}
					?>

				</div>
			</div>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-xl-3 col-lg-4">
		        	<div class="nl-sidebar-wrapper nl-sidebar-ml--24">
						<?php get_sidebar();?>
	            	</div>
	            </div>
			<?php endif;?>
        </div>
    </div>
</section>

<?php
get_footer();
