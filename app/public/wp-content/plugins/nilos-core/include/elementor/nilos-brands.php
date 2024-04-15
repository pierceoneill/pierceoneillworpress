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
class Nilos_Brands extends Widget_Base
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
        return 'nilos-brands';
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
        return __('Nilos Brands', 'nilos-core');
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
            '_brands',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_brand_style',
            [
                'label' => esc_html__('Brand Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'brand-1',
                'options' => [
                    'brand-1' => esc_html__('Brand 1', 'nilos-core'),
                    'brand-2' => esc_html__('Brand 2', 'nilos-core'),
                    'brand-3' => esc_html__('Brand 3', 'nilos-core'),
                    'brand-4' => esc_html__('Brand 4', 'nilos-core'),
                    'brand-5' => esc_html__('Brand 5', 'nilos-core'),
                ]
            ]
        );
        $this->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Background Image', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    '_brand_style'  => ['brand-3']
                ]
			]
		);
         

        $this->add_control(
            'brands_logo',
            [
                'label' => esc_html__('Logo List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'logo',
                        'label' => esc_html__('Logo', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => \Elementor\Utils::get_placeholder_image_src()
                        ]
                    ]
                ],
                'condition' => [
                    '_brand_style'  => ['brand-2', 'brand-5']
                ]
            ]
        );
        $this->end_controls_section();
        // Repeater
        $this->start_controls_section(
            '_brands_logo',
            [
                'label' => __('Brands Logo', 'nilos-core'),
                'condition' => [
                    '_brand_style'  => ['brand-3']
                ]
            ]
        );

        $repeater = new Repeater();
        $repeater->start_controls_tabs(
			'style_tabs'
		);
        // Tab 1
        $repeater->start_controls_tab(
            'normal',
            [
                'label' => __('Normal', 'nilos-core'),
            ]
        );

        $repeater->add_control(
            'logo',
            [
                'label' => esc_html__('Logo', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => \Elementor\Utils::get_placeholder_image_src()
                ]
            ]
        );

        // Add more controls for Tab 1

        $repeater->end_controls_tab();
        

        // Tab 2
        $repeater->start_controls_tab(
            'hover',
            [
                'label' => __('Hover', 'nilos-core'),
            ]
        );

        $repeater->add_control(
            'hover_logo',
            [
                'label' => esc_html__('Hover Logo', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => \Elementor\Utils::get_placeholder_image_src()
                ]
            ]
        );

        // Add more controls for Tab 2

        $repeater->end_controls_tab();
        $repeater->end_controls_tab();

        $this->add_control(
            'brands3_logo',
            [
                'label' => __('Logos', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section();

        // Link Content
        $this->start_controls_section(
            'link_contents',
            [
                'label' => __('Link Contents', 'nilos-core'),
                'condition' => [
                    '_brand_style'  => ['brand-5']
                ]
            ]
        );

        $this->add_control(
			'tagline',
			[
				'label' => esc_html__( 'Tagline', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'NEXT CLIENT WILL BE YOU.', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your tagline here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'link_text',
			[
				'label' => esc_html__( 'Link text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get In Touch', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your text here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'link_url',
			[
				'label' => esc_html__( 'Link url', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
                    'url'           => '#',
                    'is_external'   => true,
                    'nofollow'      => true,
                ]
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
        $settings = $this->get_settings_for_display();

?>
        <?php if ($settings['_brand_style'] == 'brand-1') : ?>

        <?php elseif ($settings['_brand_style'] == 'brand-2') : ?>
            <!--Brand Two Start-->
            <section class="brand-two">
                <div class="brand-two__border-top"></div><!-- /.brand-two__border-top -->
                <?php if($settings['brands_logo']): ?>
                <div class="container">
                    <div class="brand-two__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                    "loop": true,
                    "autoplay": true,
                    "margin": 0,
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
                            "items": 2
                        },
                        "992": {
                            "items": 4
                        },
                        "1290": {
                            "items": 5
                        }
                    }
                }'>
                        <?php foreach($settings['brands_logo'] as $item): ?>
                        <!--Brand Two Single Start-->
                        <div class="brand-two__single">
                            <div class="brand-two__img">
                                <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                            </div>
                        </div>
                        <!--Brand Two Single End-->
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </section>
            <!--Brand Two End-->
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
        <?php elseif ($settings['_brand_style'] == 'brand-3') : ?>
            <!-- Brand Three Start -->
            <section class="brand-three">
                <div class="brand-three__map">
                    <img src="<?php echo esc_url($settings['bg_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                </div>
                <div class="brand-three__top">
                    <?php if($settings['brands3_logo']): ?>
                    <div class="container">
                        <div class="brand-three__carousel-one owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                        "loop": true,
                        "autoplay": true,
                        "margin": 50,
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
                                "items": 3
                            },
                            "992": {
                                "items": 4
                            },
                            "1290": {
                                "items": 6
                            }
                        }
                    }'>
                                <?php foreach($settings['brands3_logo'] as $item): ?>
                                <!-- Brand Three Single Start -->
                                <div class="item">
                                    <div class="brand-three__single">
                                        <div class="brand-three__img">
                                            <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                        </div>
                                        <div class="brand-three__img-hover">
                                            <img src="<?php echo esc_url($item['hover_logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- Brand Three Single End -->
                                <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if($settings['brands3_logo']): ?>
                <div class="brand-three__bottom">
                    <div class="container">
                        <div class="brand-three__carousel-two owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                                "loop": true,
                                "autoplay": true,
                                "margin": 50,
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
                                        "items": 3
                                    },
                                    "992": {
                                        "items": 4
                                    },
                                    "1290": {
                                        "items": 5
                                    }
                                }
                            }'>
                            <!-- Brand Three Single Start -->
                            <?php foreach($settings['brands3_logo'] as $item): ?>
                                <div class="item">
                                    <div class="brand-three__single">
                                        <div class="brand-three__img">
                                            <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                        </div>
                                        <div class="brand-three__img-hover">
                                            <img src="<?php echo esc_url($item['hover_logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                        </div>
                                    </div>
                                </div>
                            <!-- Brand Three Single End -->
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </section>
            <!-- Brand Three End -->
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
        <?php elseif ($settings['_brand_style'] == 'brand-4') : ?>
        
        <?php elseif ($settings['_brand_style'] == 'brand-5') : ?>
            <!--Brand One Start-->
        <section class="brand-five">
            <div class="container">
                <?php if($settings['brands_logo']): ?>
                <div class="brand-five__carousel thm-owl__carousel owl-theme owl-carousel" data-owl-options='{
                    "items": 3,
                    "margin": 0,
                    "smartSpeed": 700,
                    "loop":true,
                    "autoplay": 6000,
                    "nav":false,
                    "dots":false,
                    "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                    "responsive":{
                        "0":{
                            "items":1
                        },
                        "768":{
                            "items":3
                        },
                        "992":{
                            "items": 5
                        }
                    }
                }'>
                    <?php foreach($settings['brands_logo'] as $item): ?>
                    <!--Brand One Single-->
                    <div class="brand-five__single">
                        <div class="brand-five__img">
                            <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- If we need navigation buttons -->
                <?php endif; ?>
            </div>
            <div class="brand-five__title">
                <p><?php echo esc_html($settings['tagline']); ?> <a href="<?php echo esc_url($settings['link_url']['url']); ?>"><?php echo esc_html($settings['link_text']); ?></a></p>
            </div>
        </section>
        <!--Brand One End-->
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
<?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Brands());
