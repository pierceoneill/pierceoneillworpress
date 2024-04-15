<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_Hero extends Widget_Base
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
        return 'nilos-hero';
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
        return __('Nilos Hero', 'nilos-core');
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


        // Content 
        $this->start_controls_section(
            '_hero',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_hero_style',
            [
                'label' => esc_html__('Hero Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'hero-1',
                'options' => [
                    'hero-1' => esc_html__('Hero 1', 'nilos-core'),
                    'hero-2' => esc_html__('Hero 2', 'nilos-core'),
                    'hero-3' => esc_html__('Hero 3', 'nilos-core'),
                    'hero-4' => esc_html__('Hero 4', 'nilos-core'),
                    'hero-5' => esc_html__('Hero 5', 'nilos-core'),
                ]
            ]
        );
        $this->add_control(
            'widget_title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Default title', 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
            ]
        );
        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Nilos Hilisxon', 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
                'condition' => [
                    '_hero_style'   => ['hero-2']
                ]
            ]
        );
        $this->add_control(
            'bottom_text',
            [
                'label' => esc_html__('Bottom Text', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Why You Need the Top Lawyers in Nilo', 'nilos-core'),
                'placeholder' => esc_html__('Type your text here', 'nilos-core'),
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'bottom_link_text',
            [
                'label' => esc_html__('Bottom Link Text', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Let’s Talk", 'nilos-core'),
                'placeholder' => esc_html__('Type your text here', 'nilos-core'),
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'bottom_link',
            [
                'label' => esc_html__('Link', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );



        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'bg_image',
						'label' => esc_html__( 'Backgroud Image', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
					],
                    [
						'name' => 'hero_title',
						'label' => esc_html__( 'Hero Title', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => 'I Am Nilos <br> Fashion Designer',
						'label_block' => true,
					],
                    [
						'name' => 'hero_desc',
						'label' => esc_html__( 'Hero Description', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => 'A versatile actress known for her incredible range and ability
                        to inhabit a wide <br>  variety of characters costume design.',
						'label_block' => true,
					],

                    [
                        'name' => 'hero_btn_1',
                        'label' => esc_html__( 'Button 1', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Hire Me Now', 'nilos-core' ),
                        'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
                    ],
                    [
                        'name' => 'hero_btn_2',
                        'label' => esc_html__( 'Button 2', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Hire Me Now', 'nilos-core' ),
                        'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
                    ]


                ]
			]
		);

        $this->add_control(
			'contact_info',
			[
				'label' => esc_html__( 'Repeater List', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
                    [
                        'name' => 'info_text',
                        'label' => esc_html__( 'info text', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Hire Me Now', 'nilos-core' ),
                        'placeholder' => esc_html__( 'Type your info here', 'nilos-core' ),
                    ],
                    [
                        'name' => 'info_url',
                        'label' => esc_html__( 'info url', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'https/info.com', 'nilos-core' ),
                        'placeholder' => esc_html__( 'place your info url', 'nilos-core' ),
                    ],

                ]
			]
		);


        $this->add_control(
			'social_title',
			[
				'label' => esc_html__( 'Contact', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact Us', 'nilos-core' ),
				'placeholder' => esc_html__( 'Contact Us', 'nilos-core' ),
			]
		);


        $this->add_control(
			'socials_icon',
			[
				'label' => esc_html__( 'Social Media Icon', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [

                    [
                        'name' => 'social_icon',
                        'label' => esc_html__( 'icon', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( '', 'nilos-core' ),
                        'placeholder' => esc_html__( 'Social Media Icon', 'nilos-core' ),
                    ],
                    [
                        'name' => 'icon_url',
                        'label' => esc_html__( 'icon url', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( '', 'nilos-core' ),
                        'placeholder' => esc_html__( 'icon url', 'nilos-core' ),
                    ],

                ]
			]
		);

        $this->end_controls_section();

        // Image 
        $this->start_controls_section(
            '_hero_image',
            [
                'label' => esc_html__('Image', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => ['hero-2']
                ]
            ]
        );
        $this->add_control(
            'hero_image',
            [
                'label' => esc_html__('Choose Image', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_parent_theme_file_uri() .'/assets/img/resources/banner-two-img-1.png',
                ]
            ]
        );
        $this->end_controls_section();

        // Banner Logos
        $this->start_controls_section(
            '_logos',
            [
                'label' => esc_html__('Logos', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'logos',
            [
                'label' => esc_html__('Repeater List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'logo',
                        'label' => esc_html__('Choose Image', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                ],
                'default' => [
                    [
                        'logo' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->end_controls_section();


        // Buttons
        $this->start_controls_section(
            '_button',
            [
                'label' => esc_html__('Buttons', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'list_2',
            [
                'label' => esc_html__('Repeater List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'list_title',
                        'label' => esc_html__('Title', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('List Title', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'url',
                        'label' => esc_html__('URL', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => '#',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'list_title' => esc_html__('Title #1', 'nilos-core'),
                        'url' => [
                            'url' => '#',
                            'is_external' => true,
                            'nofollow' => true,
                        ]
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button text', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Download CV", 'nilos-core'),
                'placeholder' => esc_html__('Type your text here', 'nilos-core'),
                'condition' => [
                    '_hero_style'   => 'hero-2'
                ]
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button link', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    '_hero_style'   => 'hero-2'
                ]
            ]
        );
        $this->end_controls_section();

        // Shape
        $this->start_controls_section(
            '_shape',
            [
                'label' => esc_html__('Shape', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_hero_style'   => 'hero-3'
                ]
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
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
        $settings = $this->get_settings_for_display(); ?>
        <?php if ($settings['_hero_style'] == 'hero-1') : ?>

        <?php elseif ($settings['_hero_style'] == 'hero-2') : ?>
            <!--Banner Two Start-->
            <section class="banner-two">
                <div class="container">
                    <div class="banner-two__inner">
                        <p class="banner-two__sub-title"><?php echo esc_html($settings['subtitle']); ?></p>
                        <div class="banner-two__title-box">
                            <h2 class="banner-two__title-one"><?php echo esc_html($settings['widget_title']); ?></h2>
                            <h2 class="banner-two__title-two"><?php echo esc_html($settings['widget_title']); ?></h2>
                        </div>
                        <div class="banner-two__btn-box">
                            <a href="<?php echo esc_html($settings['btn_link']['url']); ?>"><?php echo esc_html($settings['btn_text']); ?> <span class="icon-up"></span></a>
                        </div>
                        <div class="banner-two__img-1 img-bounce-2">
                            <img src="<?php echo esc_url($settings['hero_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                        </div>
                    </div>
                </div>
            </section>
            <!--Banner Two End-->
        <?php elseif ($settings['_hero_style'] == 'hero-3') : ?>
            <section class="header-three-and-banner">
                <div class="banner-three__shape-1 float-bob-y">
                    <img src="<?php echo $settings['image']['url']; ?>" alt="">
                </div>
                <!--Banner Two Start-->
                <section class="banner-three">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-7">
                                <div class="banner-three__left">
                                    <ul class="banner-three__logo-box list-unstyled">
                                        <?php foreach ($settings['logos'] as $item) : ?>
                                            <li>
                                                <div class="banner-three__logo">
                                                    <img src="<?php echo $item['logo']['url']; ?>" alt="">
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <h2 class="banner-three__title"><?php echo $settings['widget_title']; ?></h2>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-5">
                                <div class="banner-three__right">
                                    <?php if ($settings['list_2']) : ?>
                                        <ul class="list-unstyled banner-three__social">
                                            <?php foreach ($settings['list_2'] as $item) : ?>
                                                <li class="mb-2">
                                                    <a href="<?php echo $item['url']['url'] ?>">
                                                        <?php echo $item['list_title']; ?> <span></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="banner-three__bottom">
                                    <p class="banner-three__bottom-text"><?php echo $settings['bottom_text']; ?></p>
                                    <div class="banner-three__btn-box">
                                        <a href="<?php echo $settings['bottom_link']['url']; ?>" class="banner-three__btn">
                                            <?php echo $settings['bottom_link_text']; ?>
                                            <span class="icon-up"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Banner Two End-->
            </section>
        <?php elseif ($settings['_hero_style'] == 'hero-4') : ?>
            <!-- Main Sllider Start -->
            <section class="main-slider">
                <div class="main-slider__social-box">
                    <h4 class="main-slider__social-title"><?php echo esc_html($settings['social_title']); ?></h4>
                    <div class="main-slider__social">
                        <?php foreach($settings['socials_icon'] as $social) : ?>
                            <a href="<?php $social['icon_url'] ?>"> <?php echo $social['social_icon']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <ul class="list-unstyled main-slider__contact-info">
                <?php foreach($settings['contact_info'] as $info) : ?>
                    <li>
                        <a  href="<?php $info['info_url'] ?>"> <?php echo $info['info_text']; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="main-slider__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{"loop": true, "items": 1, "navText": ["<span class=\"fas fa-long-arrow-alt-right\"></span>","<span class=\"fas fa-long-arrow-alt-left\"></span>"], "margin": 0, "dots": false, "dotsData": false, "nav": true, "animateOut": "slideOutDown", "animateIn": "fadeIn", "active": true, "smartSpeed": 1000, "autoplay": true, "autoplayTimeout": 7000, "autoplayHoverPause": false}'>
                    <?php foreach( $settings['list'] as $item ): ?>
                    <div class="item main-slider__slide-1">
                        <div class="main-slider__bg" style="background-image: url(<?php echo esc_url($item['bg_image']['url']); ?>"></div>
                        <!-- /.slider-one__bg -->
                        <div class="container">
                            <div class="main-slider__content">
                                <h2 class="main-slider__title"><?php echo wp_kses_post($item['hero_title']); ?></h2>
                                <p class="main-slider__text"><?php echo wp_kses_post($item['hero_desc']); ?></p>
                                <div class="main-slider__btn-box">
                                    <a href="contact.html" class="main-slider__btn-1 thm-btn"><?php echo wp_kses_post($item['hero_btn_1']); ?></a>
                                    <a href="about.html" class="main-slider__btn-2 thm-btn"><?php echo wp_kses_post($item['hero_btn_2']); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <!--Main Sllider Start -->
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
        <?php elseif ($settings['_hero_style'] == 'hero-5') : ?>
            <!--Banner Five Start-->
            <section class="banner-five full-height">
                <div class="banner-five__wrap" style="background-image: url(<?php echo get_parent_theme_file_uri(); ?>/assets/img/resources/banner-five-img-1.jpg);">
                </div>
            </section>
            <!--Banner Five End-->
        <?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Hero());
