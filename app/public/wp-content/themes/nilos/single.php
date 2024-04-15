<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package nilos
 */

get_header();

$blog_column 		= is_active_sidebar( 'blog-sidebar' ) ? 'col-xl-9 col-lg-8' : 'col-xl-12 col-lg-12';
?>
<!-- breadcrumb area start -->
<section class="nl-postbox-details-area nl-blog-area pb-120 pt-95">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr($blog_column); ?>">
                <div class="nl-postbox-details-main-wrapper">
                    <div class="nl-postbox-details-content postbox__text">
                        <?php
							while ( have_posts() ):
							the_post();

							get_template_part( 'template-parts/content', get_post_format() );
						?>
						
                        <?php 
							if ( get_previous_post_link() && get_next_post_link() ): 
							$prev_post = get_adjacent_post(false, '', true);
							$next_post = get_adjacent_post(false, '', false);
						?>
						<div class="news-details__pagination-box">
							<ul class="news-details__pagination list-unstyled clearfix">
								<?php if ( get_previous_post_link() ): ?>
								<li class="next">
									<a href="<?php echo get_permalink($prev_post->ID) ?>" aria-label="Previous"><i class="fas fa-long-arrow-alt-left"></i><?php esc_html_e('Prev Post', 'nilos'); ?></a>
								</li>
								<?php endif; ?>
								<li class="count"><a href="#"></a></li>
								<li class="count"><a href="#"></a></li>
								<li class="count"><a href="#"></a></li>
								<li class="count"><a href="#"></a></li>
								<?php if ( get_next_post_link() ): ?>
								<li class="previous">
									<a href="<?php echo get_permalink($next_post->ID) ?>" aria-label="Next"><?php esc_html_e('Next Post', 'nilos'); ?><i class="fas fa-long-arrow-alt-right"></i></a>
								</li>
								<?php endif; ?>
							</ul>
						</div>
                        <?php endif;?>
                        <!-- navigation end -->

                        <?php
							get_template_part( 'template-parts/biography', get_post_format() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ):
								comments_template();
							endif;

							endwhile; // End of the loop.
						?>
                    </div>
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
<!-- breadcrumb area end -->
<?php
get_footer();
