<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  nilos
 */
get_header();

$post_column = is_active_sidebar( 'portfolio-sidebar' ) ? 'col-xxl-9 col-xl-9 col-lg-8' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'portfolio-sidebar' ) ? '' : 'justify-content-center';

?>
    <!--Portfolio Details Start-->
    <section class="portfolio-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="portfolio-details__left">
                        <?php if(has_post_thumbnail()): ?>
                        <div class="portfolio-details__img-one">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <?php endif; ?>
                        <div class="portfolio-details__content-one">
                            <h3 class="portfolio-details__title"><?php the_title(); ?></h3>
                            <p class="portfolio-details__text-1"><?php echo esc_html(get_the_excerpt()); ?></p>
                        </div>
                        <?php echo wp_kses_post(get_the_content()); ?>
                        <ul class="list-unstyled portfolio-details__bottom">
                            <?php
                                $next_post = get_next_post();
                                $prev_post = get_previous_post();
                            ?>
                            <li>
                                <?php if(isset($next_post)): ?>
                                    <div class="portfolio-details__bottom-img">
                                        <?php echo get_the_post_thumbnail($next_post->ID); ?>
                                    </div>
                                    
                                    <div class="portfolio-details__bottom-content">
                                        <h4><a href="<?php echo esc_url(get_the_permalink($next_post->ID)); ?>"><?php echo esc_html(get_the_title($next_post->ID)); ?></a></h4>
                                    </div>
                                <?php endif; ?>
                            </li>
                            <li>
                                <?php if(isset($prev_post)): ?>
                                    <div class="portfolio-details__bottom-content">
                                        <h4><a href="<?php echo esc_url(get_the_permalink($prev_post->ID)); ?>"><?php echo esc_html(get_the_title($prev_post->ID)); ?></a></h4>
                                    </div>
                                    <div class="portfolio-details__bottom-img">
                                        <?php echo get_the_post_thumbnail($prev_post->ID); ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="portfolio-details__sidebar">
                        <div class="portfolio-details__sidebar-single portfolio-details__sidebar-info">
                            <h3 class="portfolio-details__sidebar-title"><?php esc_html_e('Project Details', 'nilos-core'); ?></h3>
                            <?php
                                $client = function_exists('get_field')? get_field('client_name') : '';
                                $project_date = function_exists('get_field')? get_field('date') : '';
                                $categries = get_the_terms(get_the_ID(), 'portfolio-cat');
                                $category_list = join(', ', wp_list_pluck($categries, 'name'));
                            ?>
                            <ul class="list-unstyled portfolio-details__sidebar-info-list">
                                <li>
                                    <p><?php esc_html_e('Client', 'nilos-core'); ?></p>
                                    <span><?php echo esc_html($client); ?></span>
                                </li>
                                <li>
                                    <p><?php esc_html_e('Date', 'nilos-core'); ?></p>
                                    <span><?php echo $project_date; ?></span>
                                </li>
                                <li>
                                    <p><?php esc_html_e('Project', 'nilos-core'); ?></p>
                                    <span><?php echo esc_html($category_list); ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="portfolio-details__sidebar-single portfolio-details__form-box">
                            <h3 class="portfolio-details__sidebar-title"><?php esc_html_e('Get a Free Quote', 'nilos-core'); ?></h3>
                            <?php echo do_shortcode('[contact-form-7 id="07d1ee4" title="Portfolio Form"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Portfolio Details End-->

<?php get_footer();  ?>

