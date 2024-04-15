<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package nilos
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 'col-xl-9 col-lg-8' : 'col-xl-12 col-lg-12';

?>

<div class="nl-blog-area nl-postbox-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="<?php print esc_attr( $blog_column );?> blog-post-items">
            	<div class="nl-postbox-wrapper pr-50">
	                <?php
						if ( have_posts() ):
					?>
					<div class="result-bar page-header d-none">
						<h1 class="page-title"><?php esc_html_e( 'Search Results For:', 'nilos' );?> <?php print get_search_query();?></h1>
					</div>
					<?php
						while ( have_posts() ): the_post();
							get_template_part( 'template-parts/content', 'search' );
						endwhile;
					?>
					<div class="nl-pagination">
						<?php nilos_pagination( '<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>', '', [ 'class' => '' ] );?>
					</div>
					<?php
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
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
</div>

<?php
get_footer();