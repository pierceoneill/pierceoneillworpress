<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_Blog_Post_Grid extends Widget_Base {

    use \NilosCore\Widgets\NilosCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'blogpost-grid';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Blog Post Grid', 'nilos-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'nilos-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'nilos-core' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'nilos-core' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   

	protected function register_controls_section() {

        $this->nilos_section_title_render_controls('blog', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
         
        // Blog Query
		$this->nilos_query_controls('blog', 'Blog');

        // layout Panel
        $this->nilos_post_layout_2('post', 'Blog');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->nilos_section_style_controls('blog_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('blog_subtitle', 'Section - Subtitle', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('blog_title', 'Section - Title', '.nilos-el-title');
        $this->nilos_basic_style_controls('blog_description', 'Section - Description', '.nilos-el-content p');

        $this->nilos_basic_style_controls('blog_box_title', 'Blog - Box - Title', '.nilos-el-box-title');
        $this->nilos_basic_style_controls('blog_box_desc', 'Blog - Box - Description', '.nilos-el-box-desc');
        $this->nilos_link_controls_style('blog_box_tag', 'Blog - Box - Tag', '.nilos-el-box-tag');
        $this->nilos_link_controls_style('blog_box_meta', 'Blog - Box - Meta', '.nilos-el-box-meta span');
        $this->nilos_link_controls_style('blog_box_btn', 'Blog - Box - Button', '.nilos-el-box-btn');
    }



	/**
	 * Render the widget ounilosut on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();


        /**
         * Setup the post arguments.
        */
        $query_args = NILOS_Helper::get_query_args('post', 'category', $this->get_settings());

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($query_args);


        ?>

        <?php if ( $settings['nilos_design_style']  == 'layout-2' ): ?>
            


        <?php else:
            if(is_active_sidebar( 'blog-sidebar' ) && ($settings['enable_sidebar'] == 'yes')){
                $blog_column = "col-xl-9 col-lg-8";
                $blog_column_align = '';
            }else{
                $blog_column = "col-xl-12 col-lg-12";
                $blog_column_align = 'justify-content-center';
            }
            
        ?>

      <!-- blog grid area start -->
         <section class="nilos-blog-grid-area pb-120">
            <div class="container">
               <div class="row">
                  <div class="<?php echo esc_attr(($blog_column)); ?> <?php echo esc_attr(($$blog_column_align)); ?>">
                     <div class="nilos-blog-grid-wrapper">
                        <div class="nilos-blog-grid-top d-flex justify-content-between mb-40">
                           <div class="nilos-blog-grid-result">
                              <p><?php $this->nilos_post_result_count($query, $settings) ?></p>
                           </div>
                           <div class="nilos-blog-grid-tab nilos-tab">
                              <nav>
                                 <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                   <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid" aria-selected="true">
                                       <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                          <path d="M16.3328 6.01317V2.9865C16.3328 2.0465 15.9061 1.6665 14.8461 1.6665H12.1528C11.0928 1.6665 10.6661 2.0465 10.6661 2.9865V6.0065C10.6661 6.95317 11.0928 7.3265 12.1528 7.3265H14.8461C15.9061 7.33317 16.3328 6.95317 16.3328 6.01317Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M16.3328 15.18V12.4867C16.3328 11.4267 15.9061 11 14.8461 11H12.1528C11.0928 11 10.6661 11.4267 10.6661 12.4867V15.18C10.6661 16.24 11.0928 16.6667 12.1528 16.6667H14.8461C15.9061 16.6667 16.3328 16.24 16.3328 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M7.33281 6.01317V2.9865C7.33281 2.0465 6.90614 1.6665 5.84614 1.6665H3.1528C2.0928 1.6665 1.66614 2.0465 1.66614 2.9865V6.0065C1.66614 6.95317 2.0928 7.3265 3.1528 7.3265H5.84614C6.90614 7.33317 7.33281 6.95317 7.33281 6.01317Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M7.33281 15.18V12.4867C7.33281 11.4267 6.90614 11 5.84614 11H3.1528C2.0928 11 1.66614 11.4267 1.66614 12.4867V15.18C1.66614 16.24 2.0928 16.6667 3.1528 16.6667H5.84614C6.90614 16.6667 7.33281 16.24 7.33281 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                   </button>
                                   <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false">
                                       <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                          <path d="M15 7.11133H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M15 1H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M15 13.2222H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                   </button>
                                 </div>
                               </nav>                               
                           </div>
                        </div> <!-- top end -->

                        <?php if ($query->have_posts()) : ?>
                        <div class="tab-content" id="nav-tabContent">
                           <div class="tab-pane fade show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab" tabindex="0">
                              <!-- blog grid item wrapper -->
                              <div class="nilos-blog-grid-item-wrapper">
                                 <div class="row nilos-gx-30 grid">
                                 
                                    <?php if ($query->have_posts()) : 
                                        while ($query->have_posts()) : 
                                        $query->the_post();
                                        global $post;

                                        $categories = get_the_category($post->ID);
                                        $author_bio_avatar_size = 180;

                                        $has_thumbnail = has_post_thumbnail() ? "" : "nilos-no-thumbnail";
                                    ?>
                                     
                                    <div class="col-lg-6 col-md-6 grid-item">
                                       <div class="nilos-blog-grid-item p-relative mb-30 <?php echo esc_attr($has_thumbnail); ?>">
                                        <?php if ( has_post_thumbnail() ): ?> 
                                        <div class="nilos-blog-grid-thumb w-img fix mb-30">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                            </a>
                                        </div>
                                        <?php endif;?>
                                          <div class="nilos-blog-grid-content">
                                             <div class="nilos-blog-grid-meta">
                                                <span>
                                                   <span>
                                                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                         <path d="M15 8.5C15 12.364 11.864 15.5 8 15.5C4.136 15.5 1 12.364 1 8.5C1 4.636 4.136 1.5 8 1.5C11.864 1.5 15 4.636 15 8.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                         <path d="M10.5972 10.7259L8.42715 9.43093C8.04915 9.20693 7.74115 8.66793 7.74115 8.22693V5.35693" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </svg>
                                                   </span>
                                                   <?php the_time( 'd M, Y' ); ?>
                                                </span>
                                                <span>
                                                   <span>
                                                      <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                         <path d="M12.5289 11.881L12.8019 14.093C12.8719 14.674 12.2489 15.08 11.7519 14.779L8.81888 13.036C8.49688 13.036 8.18189 13.015 7.87389 12.973C8.39189 12.364 8.69988 11.594 8.69988 10.761C8.69988 8.77299 6.97788 7.16302 4.84988 7.16302C4.03788 7.16302 3.28888 7.394 2.66588 7.8C2.64488 7.625 2.63788 7.44999 2.63788 7.26799C2.63788 4.08299 5.40288 1.5 8.81888 1.5C12.2349 1.5 14.9999 4.08299 14.9999 7.26799C14.9999 9.15799 14.0269 10.831 12.5289 11.881Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                         <path d="M8.7 10.7611C8.7 11.5941 8.39201 12.3641 7.87401 12.9731C7.18101 13.8131 6.082 14.3521 4.85 14.3521L3.023 15.437C2.715 15.626 2.323 15.3671 2.365 15.0101L2.54 13.6311C1.602 12.9801 1 11.9371 1 10.7611C1 9.52905 1.658 8.44407 2.666 7.80007C3.289 7.39407 4.038 7.16309 4.85 7.16309C6.978 7.16309 8.7 8.77305 8.7 10.7611Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </svg>
                                                   </span>
                                                    <?php echo esc_html__('Comments ', 'nilos-core'); echo "(" . get_comments_number($post->ID) . ")";?>
                                                </span>
                                             </div>
                                             <h3 class="nilos-blog-grid-title">
                                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['nilos_blog_title_word'], ''); ?></a>
                                             </h3>

                                            <?php if (!empty($settings['nilos_post_content'])):
                                                $nilos_post_content_limit = (!empty($settings['nilos_post_content_limit'])) ? $settings['nilos_post_content_limit'] : '';
                                            ?>
                                            <?php if(get_the_excerpt(get_the_ID())): ?>
                                            <p class="nilos-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $nilos_post_content_limit, ''); ?></p>
                                            <?php  endif; endif; ?>

                                            <?php if(!empty($settings['nilos_post_button'])) :?>
                                             <div class="nilos-blog-grid-btn">
                                                <a href="<?php the_permalink(); ?>" class="nilos-link-btn-3">
                                                <?php echo nilos_kses($settings['nilos_post_button']); ?>
                                                   <span>
                                                      <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                         <path d="M16 7.5L1 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                         <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </svg>
                                                   </span>
                                                </a>
                                             </div>
                                             <?php endif; ?>
                                                                                 
                                          </div>
                                       </div>
                                    </div>
                                    <?php 
                                        endwhile; 
                                        wp_reset_query(); 
                                        endif;
                                    ?>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab" tabindex="0">
                              <!-- blog list wrapper -->
                              <div class="nilos-blog-list-item-wrapper">
                                <?php if ($query->have_posts()) : 
                                    while ($query->have_posts()) : 
                                    $query->the_post();
                                    global $post;

                                    $categories = get_the_category($post->ID);
                                    $author_bio_avatar_size = 180;

                                    $has_thumbnail = has_post_thumbnail() ? "" : "nilos-no-thumbnail";
                                ?>
                                 <div class="nilos-blog-list-item d-md-flex d-lg-block d-xl-flex">
                                    <?php if ( has_post_thumbnail() ): ?> 
                                    <div class="nilos-blog-list-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( $post->ID, $settings['thumbnail_size'] );?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="nilos-blog-list-content">
                                       <div class="nilos-blog-grid-content">
                                          <div class="nilos-blog-grid-meta">
                                             <span>
                                                <span>
                                                   <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                      <path d="M15 8.5C15 12.364 11.864 15.5 8 15.5C4.136 15.5 1 12.364 1 8.5C1 4.636 4.136 1.5 8 1.5C11.864 1.5 15 4.636 15 8.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      <path d="M10.5972 10.7259L8.42715 9.43093C8.04915 9.20693 7.74115 8.66793 7.74115 8.22693V5.35693" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   </svg>
                                                </span>
                                                <?php the_time( 'd M, Y' ); ?>
                                             </span>
                                             <span>
                                                <span>
                                                   <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                      <path d="M12.5289 11.881L12.8019 14.093C12.8719 14.674 12.2489 15.08 11.7519 14.779L8.81888 13.036C8.49688 13.036 8.18189 13.015 7.87389 12.973C8.39189 12.364 8.69988 11.594 8.69988 10.761C8.69988 8.77299 6.97788 7.16302 4.84988 7.16302C4.03788 7.16302 3.28888 7.394 2.66588 7.8C2.64488 7.625 2.63788 7.44999 2.63788 7.26799C2.63788 4.08299 5.40288 1.5 8.81888 1.5C12.2349 1.5 14.9999 4.08299 14.9999 7.26799C14.9999 9.15799 14.0269 10.831 12.5289 11.881Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      <path d="M8.7 10.7611C8.7 11.5941 8.39201 12.3641 7.87401 12.9731C7.18101 13.8131 6.082 14.3521 4.85 14.3521L3.023 15.437C2.715 15.626 2.323 15.3671 2.365 15.0101L2.54 13.6311C1.602 12.9801 1 11.9371 1 10.7611C1 9.52905 1.658 8.44407 2.666 7.80007C3.289 7.39407 4.038 7.16309 4.85 7.16309C6.978 7.16309 8.7 8.77305 8.7 10.7611Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   </svg>
                                                </span>
                                                <?php echo esc_html__('Comments ', 'nilos-core'); echo "(" . get_comments_number($post->ID) . ")";?>
                                             </span>
                                          </div>
                                          <h3 class="nilos-blog-grid-title">
                                            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['nilos_blog_title_word'], ''); ?></a>
                                          </h3>

                                            <?php if (!empty($settings['nilos_post_content'])):
                                                $nilos_post_content_limit = (!empty($settings['nilos_post_content_limit'])) ? $settings['nilos_post_content_limit'] : '';
                                            ?>
                                            <?php if(get_the_excerpt(get_the_ID())): ?>
                                            <p class="nilos-el-box-desc"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $nilos_post_content_limit, ''); ?></p>
                                            <?php  endif; endif; ?>

                                            <?php if(!empty($settings['nilos_post_button'])) :?>
                                          <div class="nilos-blog-grid-btn">
                                             <a href="<?php the_permalink(); ?>" class="nilos-link-btn-3">
                                             <?php echo nilos_kses($settings['nilos_post_button']); ?>
                                                <span>
                                                   <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                      <path d="M16 7.5L1 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                   </svg>
                                                </span>
                                             </a>
                                          </div>
                                          <?php endif; ?>
                                                                                       
                                       </div>
                                    </div>
                                 </div>
                                 <?php 
                                    endwhile; 
                                    wp_reset_query(); 
                                    endif;
                                    ?>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-xl-12">
                                 <div class="nilos-blog-pagination mt-30">
                                    <div class="nilos-pagination">
                                    <?php if( ($settings['nilos_post__pagination'] == 'yes') && ('-1' != $settings['posts_per_page'])) :?>
                                        <?php
                                            $big = 999999999;

                                            if (get_query_var('paged')) {
                                                $paged = get_query_var('paged');
                                            } else if (get_query_var('page')) {
                                                $paged = get_query_var('page');
                                            } else {
                                                $paged = 1;
                                            }

                                            echo paginate_links( array(
                                                'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                                'format'     => '?paged=%#%',
                                                'current'    => $paged,
                                                'total'      => $query->max_num_pages,
                                                'type'       =>'list',
                                                'prev_text'  =>'<svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                                    <path d="M1.00017 6.77879L14 6.77879" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>',
                                                'next_text'  =>'<svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                                                    <path d="M13.9998 6.77883L1 6.77883" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M8.75684 1.55767L14.0001 6.7784L8.75684 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                </svg>',
                                                'show_all'   => false,
                                                'end_size'   => 1,
                                                'mid_size'   => 4,
                                            ) );
                                        ?>

                                    <?php endif;?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                         </div>  
                         <?php endif;?>                       
                     </div>
                  </div>
                  
                  <?php if ( is_active_sidebar( 'blog-sidebar' ) && ($settings['enable_sidebar'] == 'yes')) :?>
                    <div class="col-xl-3 col-lg-4">
                            <div class="nilos-sidebar-wrapper nilos-sidebar-ml--24 ">
                                <?php get_sidebar();?>
                            </div>
                    </div>
                  <?php endif;?>
               </div>
            </div>
         </section>
         <!-- blog grid area end -->

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new NILOS_Blog_Post_Grid() );