<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_Blog_Post extends Widget_Base {

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
		return 'blogpost';
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
		return __( 'Blog Post', 'nilos-core' );
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
		return 'eicon-elementor-circle';
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
		$this->start_controls_section(
            '_layout',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_blog_style',
            [
                'label' => esc_html__('Blog Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'layout-1',
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nilos-core'),
                    'layout-2' => esc_html__('Layout 2', 'nilos-core'),
                    'layout-3' => esc_html__('Layout 3', 'nilos-core'),
                    'layout-4' => esc_html__('Layout 4', 'nilos-core'),
                    'layout-5' => esc_html__('Layout 5', 'nilos-core'),
                ]
            ]
        );
		$this->add_control(
            'tag',
            [
                'label' => esc_html__('Tag', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Our Blog', 'nilos-core'),
                'placeholder' => esc_html__('Type your tag here', 'nilos-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Company Insights', 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
            ]
        );
		$this->end_controls_section();

        // $this->nilos_section_title_render_controls('blog', 'Section - Title', ['layout-1', 'layout-2'], 'Blog', 'Blog & Insights', '', 'h2', 'text-left', true, 'yes');
        
        // Blog Query
		$this->nilos_query_controls('blog', 'Blog');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->nilos_section_style_controls('blog_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('blog_subtitle', 'Blog - Subtitle', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('blog_title', 'Blog - Title', '.nilos-el-title');
        $this->nilos_basic_style_controls('blog_description', 'Blog - Description', '.nilos-el-content p');
        $this->nilos_link_controls_style('blog_box_btn', 'Blog - Button', '.nilos-el-btn');


        $this->nilos_basic_style_controls('blog_box_title', 'Box - Title', '.nilos-el-box-title');
        $this->nilos_basic_style_controls('blog_box_desc', 'Box - Description', '.nilos-el-box-desc');
        $this->nilos_link_controls_style('blog_box_tag', 'Box - Tag', '.nilos-el-box-tag');
        $this->nilos_basic_style_controls('blog_box_meta', 'Box - Meta', '.nilos-el-box-meta span');
        $this->nilos_link_controls_style('blog_box_btn_2', 'Box - Button', '.nilos-el-box-btn');
        $this->nilos_link_controls_style('blog_box_author', 'Box - Author', '.nilos-el-author-title');
        $this->nilos_link_controls_style('blog_box_arrow', 'Box - Author', '.nilos-el-box-arrow');
        
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

        // The Query
        $query = new \WP_Query($query_args);
        ?>

        <?php if ( $settings['_blog_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'section-title-two__title');
        ?>
        <!--News One Start-->
        <section class="news-one">
            <div class="container">
               <?php if ( !empty($settings['tag']) ) : ?>
                <div class="section-title-two text-center">
                     <?php if(!empty($settings['tag'])) : ?>
                    <div class="section-title-two__tagline-box">
                        <p class="section-title-two__tagline"><span class="icon-photo-camera"></span> <?php echo nilos_kses( $settings['tag'] ); ?></p>
                    </div>
                    <?php endif; ?>
                    <h2 class="section-title-two__title"><?php echo esc_html($settings['title' ]); ?></h2>
                </div>
                <?php endif; ?>
                <div class="row">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : 
                    $query->the_post();
                    global $post;

                    $categories = get_the_category($post->ID);

                ?>
                    <!--News One Single Start-->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                        <div class="news-one__single">
                            <div class="news-one__tag-and-date">
                                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="news-one__tag"><?php echo esc_html($categories[0]->name); ?></a>
                                <p class="news-one__date"><?php the_time( get_option('date_format') ); ?></p>
                            </div>
                            <?php if ( has_post_thumbnail() ): ?> 
                            <div class="news-one__img">
                              <?php the_post_thumbnail( 'full' );?>
                            </div>
                            <?php endif; ?>
                            <h3 class="news-one__title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['nilos_blog_title_word'], ''); ?></a></h3>
                            <a href="<?php the_permalink(); ?>" class="news-one__read-more"><?php esc_html_e('Read More', 'nilos-core'); ?></a>
                        </div>
                    </div>
                    <!--News One Single End-->
                <?php endwhile; wp_reset_query(); ?>
                <?php endif; ?>
                </div>
            </div>
        </section>
        <!--News One End-->
		<?php elseif ( $settings['_blog_style']  == 'layout-3' ): ?>
		<!-- News Three Start -->
		<section class="news-three">
            <div class="container">
                <div class="section-title-three text-center">
                    <div class="section-title-three__tagline-box">
                        <span class="section-title-three__tagline"><?php echo nilos_kses( $settings['tag'] ); ?></span>
                    </div>
                    <h2 class="section-title-three__title">
					<?php
                        echo esc_html($settings['title' ])
                     ?>
					</h2>
                </div>
				<div class="row">
				<?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : 
                    $query->the_post();
                    global $post;

                    $categories = get_the_category($post->ID);

                ?>
                
                    <!-- News Three Single Start -->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp">
                        <div class="news-three__single">
                            <div class="news-three__img">
								<?php if ( has_post_thumbnail() ): ?> 
									<?php the_post_thumbnail( 'full' );?>
								<?php endif; ?>
                                <div class="news-three__content">
                                    <p class="news-three__date"><?php the_time( 'M d, Y' ); ?></p>
                                    <h3 class="news-three__title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['nilos_blog_title_word'], ''); ?></a></h3>
                                </div>
                                <div class="news-three__user-img">
									<?php
										$author_id = get_the_author_meta('ID');
										$avatar = get_avatar($author_id, 96); // Change 96 to your desired avatar size
										echo $avatar;
									?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- News Three Single End -->
                
				<?php endwhile; wp_reset_query(); ?>
                <?php endif; ?>
				</div>
            </div>
        </section>
        <!-- News Three End -->
    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new NILOS_Blog_Post() );