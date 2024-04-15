<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_Testimonial extends Widget_Base
{

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
    public function get_name()
    {
        return 'nilos-testimonial';
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
    public function get_title()
    {
        return __('Nilos Testimonial', 'nilos-core');
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
    public function get_icon()
    {
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
    public function get_categories()
    {
        return ['nilos-core'];
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
    public function get_script_depends()
    {
        return ['nilos-core'];
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

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }


    protected function register_controls_section()
    {

        $this->start_controls_section(
            '_nilos_accordion',
            [
                'label' => esc_html__('Testimonial Accordion', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_testimonial_style',
            [
                'label' => esc_html__('Testimonial Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'testimonial-1',
                'options' => [
                    'testimonial-1' => esc_html__('Testimonial 1', 'nilos-core'),
                    'testimonial-2' => esc_html__('Testimonial 2', 'nilos-core'),
                    'testimonial-3' => esc_html__('Testimonial 3', 'nilos-core'),
                    'testimonial-4' => esc_html__('Testimonial 4', 'nilos-core'),
                    'testimonial-5' => esc_html__('Testimonial 5', 'nilos-core'),
                ]
            ]
        );
        $this->add_control(
			'tag',
			[
				'label' => esc_html__( 'Subtitle', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Testimonals', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your subtitle here', 'nilos-core' ),
			]
		);
        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Happy users feedback', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);

        $this->add_control(
            '_testimonials',
            [
                'label' => esc_html__('Testimonial List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default'   => '“ Photography services may also include photo editing and retouching, image processing, printing, and framing. The scope of services offered may vary depending... “'
                    ],
                    [
                        'name' => 'author_name',
                        'label' => esc_html__('Author Name', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('ALONSO D. DOWSON', 'nilos-core')
                    ],
                    [
                        'name' => 'author_designation',
                        'label' => esc_html__('Author Designation', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Head Of Idea', 'nilos-core')
                    ],
                    [
                        'name' => 'author_image',
                        'label' => esc_html__('Author Image', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => \Elementor\Utils::get_placeholder_image_src()
                        ]
                    ]
                ],
                'condition' => [
                    '_testimonial_style'  => ['testimonial-2', 'testimonial-3']
                ]
            ]
        );
      

        $this->end_controls_section();

        $this->start_controls_section(
            '_testimonial_four',
            [
                'label' => esc_html__('Testimonial four', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'testimonial_item',
			[
				'label' => esc_html__( 'Repeater List', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
                    [
                        'name'  => 'testimonial_image',
                        'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
    
					[
						'name' => 'testimonial_desc',
						'label' => esc_html__( 'Testimonial Descpription', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'Type your descprition' , 'nilos-core' ),
						'label_block' => true,
					],
                    [
						'name' => 'list_title',
						'label' => esc_html__( 'Title', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Type your title' , 'nilos-core' ),
						'label_block' => true,
					],
                    [
                        'name'  => 'client_image',
                        'label' => esc_html__( 'Client  Image', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
						'name' => 'client_name',
						'label' => esc_html__( 'Client Name', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Type client name' , 'nilos-core' ),
						'label_block' => true,
					],
                    [
						'name' => 'client_designation ',
						'label' => esc_html__( 'Client Designation ', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Type your designation' , 'nilos-core' ),
						'label_block' => true,
					],
				],
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'nilos-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'nilos-core' ),
					],

				],
				'title_field' => '{{{ list_title }}}',
			]
		);

        $this->end_controls_section();

    }

    protected function style_tab_content()
    {
        $this->start_controls_section(
            '_accordion_title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
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
                'label' => esc_html__('Categories', 'nilos-core'),
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
                'label' => esc_html__('Tags', 'nilos-core'),
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
                'label' => esc_html__('Details Button', 'nilos-core'),
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
                'label' => esc_html__('Content', 'nilos-core'),
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <?php if ($settings['_testimonial_style'] == 'testimonial-1') : ?>
            <div class="testimonial-one__right">
                <div class="single-vertical-carousel">

                    <div class="slide">
                        <div class="testimonial-one__single">
                            <div class="testimonial-one__tag">
                                <h4>design quality</h4>
                            </div>
                            <div class="testimonial-one__star">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                            </div>
                            <h4 class="testimonial-one__text">“ Look for review that provide
                                specific
                                details about the agency's work, such as their responsiveness. “
                            </h4>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="<?php echo get_parent_theme_file_uri(); ?>/assets/img/testimonial/testimonial-1-1.jpg" alt="">
                                </div>
                                <div class="testimonial-one__client-content">
                                    <h4>Alonso D. <span>/ head Of Idea</span> </h4>
                                </div>
                            </div>
                            <div class="testimonial-one__quote">
                                <span class="icon-straight-quotes"></span>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial-one__single">
                            <div class="testimonial-one__tag">
                                <h4>design quality</h4>
                            </div>
                            <div class="testimonial-one__star">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                            </div>
                            <h4 class="testimonial-one__text">“ Look for review that provide
                                specific
                                details about the agency's work, such as their responsiveness. “
                            </h4>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="<?php echo get_parent_theme_file_uri(); ?>/assets/img/testimonial/testimonial-1-1.jpg" alt="">
                                </div>
                                <div class="testimonial-one__client-content">
                                    <h4>Alonso D. <span>/ head Of Idea</span> </h4>
                                </div>
                            </div>
                            <div class="testimonial-one__quote">
                                <span class="icon-straight-quotes"></span>
                            </div>
                        </div>
                    </div>

                    <div class="slide">
                        <div class="testimonial-one__single">
                            <div class="testimonial-one__tag">
                                <h4>design quality</h4>
                            </div>
                            <div class="testimonial-one__star">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                            </div>
                            <h4 class="testimonial-one__text">“ Look for review that provide
                                specific
                                details about the agency's work, such as their responsiveness. “
                            </h4>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="<?php echo get_parent_theme_file_uri(); ?>/assets/img/testimonial/testimonial-1-1.jpg" alt="">
                                </div>
                                <div class="testimonial-one__client-content">
                                    <h4>Alonso D. <span>/ head Of Idea</span> </h4>
                                </div>
                            </div>
                            <div class="testimonial-one__quote">
                                <span class="icon-straight-quotes"></span>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <div class="testimonial-one__single">
                            <div class="testimonial-one__tag">
                                <h4>design quality</h4>
                            </div>
                            <div class="testimonial-one__star">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                            </div>
                            <h4 class="testimonial-one__text">“ Look for review that provide
                                specific
                                details about the agency's work, such as their responsiveness. “
                            </h4>
                            <div class="testimonial-one__client-info">
                                <div class="testimonial-one__client-img">
                                    <img src="<?php echo get_parent_theme_file_uri(); ?>/assets/img/testimonial/testimonial-1-1.jpg" alt="">
                                </div>
                                <div class="testimonial-one__client-content">
                                    <h4>Alonso D. <span>/ head Of Idea</span> </h4>
                                </div>
                            </div>
                            <div class="testimonial-one__quote">
                                <span class="icon-straight-quotes"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php elseif ($settings['_testimonial_style'] == 'testimonial-2') : ?>
            <!--Testimonial Two Start-->
            <section class="testimonial-two">
                <div class="container">
                    <div class="testimonial-two__inner">
                        <?php if($settings['_testimonials']): ?>
                        <div class="swiper-container testimonial-two-slider">
                            <div class="swiper-wrapper">
                                <?php foreach($settings['_testimonials'] as $item): ?>
                                <!-- Slide Item -->
                                <div class="swiper-slide">
                                    <div class="testimonial-two__inner-content">
                                        <div class="testimonial-two__quote">
                                            <span class="icon-straight-quotes"></span>
                                        </div>
                                        <p class="testimonial-two__text"><?php echo wp_kses_post($item['text']); ?></p>
                                        <div class="testimonial-two__client-info">
                                            <div class="testimonial-two__client-img">
                                                <img src="<?php echo esc_url($item['author_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                            </div>
                                            <div class="testimonial-two__content">
                                                <h4 class="testimonial-two__name"><?php echo esc_html($item['author_name']); ?></h4>
                                                <p class="testimonial-two__sub-title"><?php echo esc_html($item['author_designation']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Slide Item -->
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="scroll-pagination">
                            <div class="swiper-pagination"></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!--Testimonial Two End-->
        <?php elseif ($settings['_testimonial_style'] == 'testimonial-3') : ?>
            <!-- Testimonial Three Start -->
            <section class="testimonial-three">
                <div class="container">
                    <div class="section-title-three text-left">
                        <div class="section-title-three__tagline-box">
                            <span class="section-title-three__tagline"><?php echo esc_html($settings['tag']); ?></span>
                        </div>
                        <h2 class="section-title-three__title"><?php echo esc_html($settings['title']); ?></h2>
                    </div>
                    <?php if($settings['_testimonials']): ?>
                    <div class="testimonial-three__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                            "loop": true,
                            "autoplay": true,
                            "margin": 115,
                            "nav": true,
                            "dots": false,
                            "smartSpeed": 500,
                            "autoplayTimeout": 10000,
                            "navText": ["<span class=\"fa fa-arrow-left\"></span>","<span class=\"fa fa-arrow-right\"></span>"],
                            "responsive": {
                                "0": {
                                    "items": 1
                                },
                                "768": {
                                    "items": 1
                                },
                                "992": {
                                    "items": 2
                                },
                                "1290": {
                                    "items": 2
                                }
                            }
                        }'>
                        <?php foreach($settings['_testimonials'] as $item): ?>
                        <!-- Testimonial Three Single Start -->
                        <div class="item">
                            <div class="testimonial-three__single">
                                <div class="testimonial-three__quote-icon-box-one">
                                    <div class="testimonial-three__quote-icon-one">
                                        <img src="<?php echo get_parent_theme_file_uri('/assets/img/icon/testimonial-three-quote-icon-3.png'); ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                    <div class="testimonial-three__quote-icon-hover-one">
                                        <img src="<?php echo get_parent_theme_file_uri('/assets/img/icon/testimonial-three-quote-icon-1.png'); ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                </div>
                                <div class="testimonial-three__content-box">
                                    <h4 class="testimonial-three__text"><?php echo esc_html($item['text']); ?></h4>
                                    <div class="testimonial-three__client-info">
                                        <div class="testimonial-three__client-img">
                                            <img src="<?php echo esc_html($item['author_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                        </div>
                                        <div class="testimonial-three__client">
                                            <h4 class="testimonial-three__client-name"><?php echo esc_html($item['author_name']); ?></h4>
                                            <p class="testimonial-three__client-sub-title"><?php echo esc_html($item['author_designation']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial-three__quote-icon-box-two">
                                    <div class="testimonial-three__quote-icon-two">
                                        <img src="<?php echo get_parent_theme_file_uri('/assets/img/icon/testimonial-three-quote-icon-4.png'); ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                    <div class="testimonial-three__quote-icon-hover-two">
                                        <img src="<?php echo get_parent_theme_file_uri('/assets/img/icon/testimonial-three-quote-icon-2.png'); ?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Three Single End -->
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <!-- Testimonial Three End -->
            <?php if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ): ?>
            <script>
                ;(function($){
                    if ($(".thm-owl__carousel").length) {
                        $(".thm-owl__carousel").each(function () {
                            let elm = $(this);
                            let options = elm.data('owl-options');
                            let thmOwlCarousel = elm.owlCarousel(options);
                        });
                        }

                        if ($(".thm-owl__carousel--custom-nav").length) {
                        $(".thm-owl__carousel--custom-nav").each(function () {
                            let elm = $(this);
                            let owlNavPrev = elm.data('owl-nav-prev');
                            let owlNavNext = elm.data('owl-nav-next');
                            $(owlNavPrev).on("click", function (e) {
                            elm.trigger('prev.owl.carousel');
                            e.preventDefault();
                            })

                            $(owlNavNext).on("click", function (e) {
                            elm.trigger('next.owl.carousel');
                            e.preventDefault();
                            })
                        });
                    }
                })(jQuery)
            </script>
            <?php endif; ?>
        <?php elseif ($settings['_testimonial_style'] == 'testimonial-4') : ?>
            <!--Testimonial Four Start-->
            <section class="testimonial-four">
                <div class="container">
                    <div class="section-title-four text-center">
                        <div class="section-title-four__tagline-box">
                            <span class="section-title-four__tagline"><?php echo $settings['tag']; ?></span>
                        </div>
                        <h2 class="section-title-four__title"><?php echo $settings['title']; ?></h2>
                    </div>
                    <div class="testimonial-four__bottom">
                        <div class="testimonial-four__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                                "loop": true,
                                "autoplay": true,
                                "margin": 30,
                                "nav": false,
                                "dots": false,
                                "smartSpeed": 500,
                                "autoplayTimeout": 10000,
                                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                "responsive": {
                                    "0": {
                                        "items": 1
                                    },
                                    "768": {
                                        "items": 1
                                    },
                                    "992": {
                                        "items": 1
                                    },
                                    "1290": {
                                        "items": 1
                                    }
                                }
                            }'>
                            <!--Testimonial Four Single Start-->
                            <?php foreach($settings['testimonial_item'] as $testimonial ) : ?>
                                <div class="item">
                                    <div class="testimonial-four__single">
                                        <div class="testimonial-four__img-box">
                                            <div class="testimonial-four__img">
                                                <img src="<?php echo esc_attr($testimonial['testimonial_image']['url']); ?>" alt="">
                                            </div>
                                            <div class="testimonial-four__quote">
                                                <span class="icon-straight-quotes"></span>
                                            </div>
                                        </div>
                                        <div class="testimonial-four__content">
                                            <p class="testimonial-four__text"> <?php echo esc_html($testimonial['testimonial_desc']);?></p>
                                            <div class="testimonial-four__client-info">
                                                <div class="testimonial-four__client-img">
                                                    <img src="<?php echo esc_attr($testimonial['client_image']['url']); ?>"
                                                        alt="">
                                                </div>
                                                <div class="testimonial-four__client-name">
                                                    <h3><?php echo esc_html($testimonial['client_name']);?> </h3>
                                                    <p><?php echo esc_html($testimonial['client_designation ']);?> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!--Testimonial Four Single End-->
                        </div>
                    </div>
                </div>
            </section>
            <!--Testimonial Four End-->
            <?php if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ): ?>
            <script>
                ;(function($){
                    if ($(".thm-owl__carousel").length) {
                        $(".thm-owl__carousel").each(function () {
                            let elm = $(this);
                            let options = elm.data('owl-options');
                            let thmOwlCarousel = elm.owlCarousel(options);
                        });
                        }

                        if ($(".thm-owl__carousel--custom-nav").length) {
                        $(".thm-owl__carousel--custom-nav").each(function () {
                            let elm = $(this);
                            let owlNavPrev = elm.data('owl-nav-prev');
                            let owlNavNext = elm.data('owl-nav-next');
                            $(owlNavPrev).on("click", function (e) {
                            elm.trigger('prev.owl.carousel');
                            e.preventDefault();
                            })

                            $(owlNavNext).on("click", function (e) {
                            elm.trigger('next.owl.carousel');
                            e.preventDefault();
                            })
                        });
                    }
                })(jQuery)
            </script>
            <?php endif; ?>
        <?php elseif ($settings['_testimonial_style'] == 'testimonial-5') : ?>

<?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Testimonial());
