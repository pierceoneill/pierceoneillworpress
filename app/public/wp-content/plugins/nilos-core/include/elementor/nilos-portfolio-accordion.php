<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_Portfolo_Accordion extends Widget_Base {

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
        return 'nilos-portfolio-accordion';
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
        return __( 'Nilos Portfolio Accordion', 'nilos-core' );
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
            '_nilos_accordion',
            [
                'label' => esc_html__('Portfolio Accordion', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_accordion_portfolio',
            [
                'label' => esc_html__('Select a post', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => $this->get_all_posts('portfolio'),
				'default' => [],
            ]
        );

        $this->add_control(
            '_accordion_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_accordion_portfolio'  => []
                    ]
                ]
            ]
        );
        $this->add_control(
			'more_works',
			[
				'label' => esc_html__( 'More works link', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $this->add_control(
			'more_works_text',
			[
				'label' => esc_html__( 'Button Text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'More <br> Works',
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);
        

        $this->end_controls_section();
    }

    protected function style_tab_content() {
        $this->start_controls_section(
			'_accordion_title',
			[
				'label' => esc_html__( 'Title', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title',
				'selector' => '{{WRAPPER}} .accrodion-title h4',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'_accordion_categories',
			[
				'label' => esc_html__( 'Categories', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'categories',
				'selector' => '{{WRAPPER}} .accrodion-title p',
			]
		);
        $this->end_controls_section();
    
        $this->start_controls_section(
			'_accordion_tags',
			[
				'label' => esc_html__( 'Tags', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tags',
				'selector' => '{{WRAPPER}} .portfolio-one__tag a',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'_accordion_button',
			[
				'label' => esc_html__( 'Details Button', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button',
				'selector' => '{{WRAPPER}} .portfolio-one__btn-box a',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'_accordion_content',
			[
				'label' => esc_html__( 'Content', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content',
				'selector' => '{{WRAPPER}} .portfolio-one__text',
			]
		);
        $this->end_controls_section();

        $this->nilos_basic_style_controls('_accordion', 'Accordion', '.accrodion');
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
        ?>
        <div class="portfolio-one__inner">
            <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion">
            <?php if(!empty($settings['_accordion_list'])): ?>
                <?php $count = 0; foreach($settings['_accordion_list'] as $key => $item): $count++;?>
                <?php
                    $categories = 'categories';
                    $tags = 'tags';
                    $title = 'Your Post Title';
                    $link = '#';
                    $excrpt = 'The goal of website design is to create an
                    aesthetically pleasing and functional website that effectively with
                    communicate the desired message.';
                    $thumbnail = get_parent_theme_file_uri('assets/img/placeholder.png');
                    $post  = new WP_Query(['p'  => $item['_accordion_portfolio'], 'post_type'    => 'portfolio']);
                    if($post->have_posts()){
                    while($post->have_posts()){
                        $post->the_post();
                        $title = get_the_title();
                        $excrpt = get_the_excerpt();
                        $link = get_permalink(get_the_ID());
                        $thumbnail = has_post_thumbnail()? get_the_post_thumbnail_url(get_the_ID()) : $thumbnail;
                        $categories = get_categories(['taxonomy' => 'portfolio-cat', 'order' => 'DESC']);
                        $tags = get_tags(['taxonomy' => 'portfolio-tag', 'order' => 'DESC']);
                ?>
                <div class="accrodion <?php echo esc_attr($count == 1? 'active' : ''); ?>">
                    <div class="accrodion-title">
                        <p><?php 
                            if(!empty($categories)){
                                $categories_html = '';
                                $categories_html .= '<a href="'.get_category_link($categories[0]->term_id).'">'.$categories[0]->name.'</a>,';
                                if(isset($categories[1])){
                                    $categories_html .= '<a href="'.get_category_link($categories[1]->term_id).'">'.$categories[1]->name.'</a>';
                                }
                                echo rtrim($categories_html, ',');
                            }
                        ?></p>
                        <h4><?php echo esc_html($title); ?></h4>
                    </div>
                    <div class="accrodion-content">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7">
                                <div class="portfolio-one__left">
                                    <div class="portfolio-one__img">
                                        <img src="<?php echo esc_url($thumbnail); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5">
                                <div class="portfolio-one__right">
                                    <div class="portfolio-one__tag">
                                    <?php 
                                        if(!empty($tags)){
                                            echo '<a href="'.get_tag_link($tags[0]->term_id).'">'.$tags[0]->name.'</a>';
                                            if(isset($tags[1])){
                                                echo '<a href="'.get_tag_link($tags[1]->term_id).'">'.$tags[1]->name.'</a>';
                                            }
                                            if(isset($tags[2])){
                                                echo '<a href="'.get_tag_link($tags[2]->term_id).'">'.$tags[2]->name.'</a>';
                                            }
                                        }
                                    ?>
                                    </div>
                                    <p class="portfolio-one__text"><?php echo wp_kses_post($excrpt); ?></p>
                                    <div class="portfolio-one__btn-box">
                                        <a href="<?php echo esc_url($link); ?>" class="portfolio-one__btn thm-btn"><?php echo esc_html__('Project details', 'nilos-core'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }wp_reset_query(); }else{ ?>
                <div class="accrodion <?php echo esc_attr($count == 1? 'active' : ''); ?>">
                    <div class="accrodion-title">
                        <p><?php echo esc_html($categories); ?></p>
                        <h4><?php echo esc_html($title); ?></h4>
                    </div>
                    <div class="accrodion-content">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7">
                                <div class="portfolio-one__left">
                                    <div class="portfolio-one__img">
                                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5">
                                <div class="portfolio-one__right">
                                    <div class="portfolio-one__tag">
                                        <a href="#">figma</a>
                                        <a href="#">wordpress</a>
                                        <a href="#">ux</a>
                                    </div>
                                    <p class="portfolio-one__text"><?php echo wp_kses_post($excrpt); ?></p>
                                    <div class="portfolio-one__btn-box">
                                        <a href="<?php echo esc_url($link); ?>" class="portfolio-one__btn thm-btn"><?php echo esc_html__('Project details', 'nilos-core'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
        <div class="portfolio-one__more-works">
            <?php
            if ( ! empty( $settings['more_works']['url'] ) ) {
                $this->add_link_attributes( 'more_works', $settings['more_works'] );
            }
            ?>
            <a <?php echo $this->get_render_attribute_string( 'more_works' ); ?>><?php echo wp_kses_post($settings['more_works_text']); ?></a>
        </div>
        <?php
    }
}

$widgets_manager->register( new Nilos_Portfolo_Accordion() );
