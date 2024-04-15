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
class Nilos_About extends Widget_Base
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
        return 'nilos-about';
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
        return __('Nilos About', 'nilos-core');
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
            'nilos_layout',
            [
                'label' => esc_html__('Choose Layout', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_about_style',
            [
                'label' => esc_html__('About Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'about-1',
                'options' => [
                    'about-1' => esc_html__('About 1', 'nilos-core'),
                    'about-2' => esc_html__('About 2', 'nilos-core'),
                    'about-3' => esc_html__('About 3', 'nilos-core'),
                    'about-4' => esc_html__('About 4', 'nilos-core'),
                    'about-5' => esc_html__('About 5', 'nilos-core'),
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_about',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            '_about_tab',
            [
                'label' => esc_html__('Tab Contents', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'tab_name',
                        'label' => esc_html__('Tab Name', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Tab 1', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'tab_subtitle',
                        'label' => esc_html__('Subtitle', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Service', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'tab_title',
                        'label' => esc_html__('Title', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'that will <br> captures worlds.',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'tab_desc',
                        'label' => esc_html__('Description', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'Photographer and a famous author, based in UK. I am on online platform where designer can share their work.',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'tab_callme',
                        'label' => esc_html__('Call Me', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('+888 999 777 00', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'tab_email',
                        'label' => esc_html__('Email', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('info@webmail.com', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name'  => 'tab_image',
                        'label' => esc_html__('Tab Image', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                ],
                'default' => [
                    [
                        'tab_name' => esc_html__('Tab #1', 'nilos-core'),
                    ],
                ],
                'title_field' => '{{{ tab_name }}}',
                'condition' => [
                    '_about_style' => ['about-2']
                ]
            ]
        );
        $this->add_control(
            'tag',
            [
                'label' => esc_html__('Tag', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Since From 1990', 'nilos-core'),
                'placeholder' => esc_html__('Type your tag here', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We always ready for take an challenge.', 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'counters',
            [
                'label' => esc_html__('Counters', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'counter_title',
                        'label' => esc_html__('Title', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Successfull Projects', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'counter_value',
                        'label' => esc_html__('Number', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'default' => '5000',
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'counter_title' => esc_html__('Successfull Projects', 'nilos-core'),
                        'counter_value' => '5000',
                    ],
                ],
                'title_field' => '{{{ counter_title }}}',
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'bottom_text',
            [
                'label' => esc_html__('Bottom Text', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("We're motivated by the desire to achieve.", 'nilos-core'),
                'placeholder' => esc_html__('Type your text here', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'bottom_text_link',
            [
                'name' => 'url',
                'label' => esc_html__('Bottom text URL', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'youtube_link',
            [
                'name' => 'url',
                'label' => esc_html__('Youtube Link', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => 'https://www.youtube.com/watch?v=Get7rqXYrbQ',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'about_image_1',
            [
                'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );
        $this->add_control(
            'about_image_2',
            [
                'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );

        $this->end_controls_section();

        // Home 3 About Banner Image
        $this->start_controls_section(
            'banner',
            [
                'label' => esc_html__('Right Image', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'banner_image',
            [
                'label' => esc_html__('Choose Image', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();

        // Home 3 About Background Image
        $this->start_controls_section(
            'background',
            [
                'label' => esc_html__('Background Shape', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-3']
                ]
            ]
        );
        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Choose Image', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'about_right',
            [
                'label' => esc_html__('Right Content', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );
        $this->add_control(
            'about_four_tagline',
            [
                'label' => esc_html__( 'Tagline', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'About Me', 'nilos-core' ),
                'placeholder' => esc_html__( 'About Me', 'nilos-core' ),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );

        $this->add_control(
            'about_four_title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("We're motivated by the desire to achieve."),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );

        $this->add_control(
            'about_four_desc',
            [
                'label' => esc_html__('Descprition', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("The goal of website design is to create an aesthetically leasing and functional website that effectively with communicate the desired message. Here we go again."),
                'placeholder' => esc_html__('Type your descprition here', 'nilos-core'),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );

        $this->add_control(
            'about_four_title_2',
            [
                'label' => esc_html__( 'Title', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'My Awards', 'nilos-core' ),
                'placeholder' => esc_html__( 'My Awards', 'nilos-core' ),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );
        $this->add_control(
            'aword_list_1',
            [
                'label' => esc_html__( 'Aword 1', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'The Type Direction Club 60', 'nilos-core' ),
                'placeholder' => esc_html__( 'Type your aword name', 'nilos-core' ),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );
        $this->add_control(
            'aword_list_2',
            [
                'label' => esc_html__( 'Aword 2', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'ClassiCon-Brochure 2017', 'nilos-core' ),
                'placeholder' => esc_html__( 'Type your aword name', 'nilos-core' ),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );
        $this->add_control(
            'aword_list_3',
            [
                'label' => esc_html__( 'Aword 3', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'CFor Print Only-Under 2023', 'nilos-core' ),
                'placeholder' => esc_html__( 'For Print Only-Under 2023', 'nilos-core' ),
                'condition' => [
                    '_about_style' => ['about-4']
                ]
            ]
        );
        $this->add_control(
            'aword_list_4',
            [
                'label' => esc_html__( 'Aword 4', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'CI Magazin 2017', 'nilos-core' ),
                'placeholder' => esc_html__( 'CI Magazin 2017', 'nilos-core' ),
                'condition' => [
                    '_about_style' => ['about-4']
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
        <?php if ($settings['_about_style'] == 'about-1') : ?>

        <?php elseif ($settings['_about_style'] == 'about-2') : ?>
            <!--About Two Start-->
            <section class="about-two">
                <div class="container">
                    <div class="about-two__inner">
                        <?php if($settings['_about_tab']): ?>
                        <div class="about-two__main-tab-box tabs-box">
                            <ul class="tab-buttons clearfix list-unstyled">
                                <?php $count = 0; foreach($settings['_about_tab'] as $item): $count++; ?>
                                <li data-tab="#<?php echo esc_attr(str_replace(' ', '-', $item['tab_name'])); ?>" class="tab-btn <?php echo $count == 1? 'active-btn': ''; ?>"><span><?php echo esc_html($item['tab_name']); ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="tabs-content">
                                <?php $count_2 = 0; foreach($settings['_about_tab'] as $item): $count_2++; ?>
                                <!--tab-->
                                <div class="tab <?php echo $count_2 == 1? 'active-tab': ''; ?>" id="<?php echo esc_attr(str_replace(' ', '-', $item['tab_name'])); ?>">
                                    <div class="about-two__content-box">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="about-two__content-left">
                                                    <div class="section-title-two text-left">
                                                        <div class="section-title-two__tagline-box">
                                                            <p class="section-title-two__tagline"><span
                                                                    class="icon-photo-camera"></span> <?php echo esc_html($item['tab_subtitle']); ?></p>
                                                        </div>
                                                        <h2 class="section-title-two__title"><?php echo wp_kses_post($item['tab_title']); ?>
                                                        </h2>
                                                    </div>
                                                    <p class="about-two__text-1"><?php echo wp_kses_post($item['tab_desc']); ?></p>
                                                    <ul class="list-unstyled about-two__contact-info">
                                                        <li>
                                                            <p>Call me</p>
                                                            <h4><a href="tel:<?php echo esc_attr($item['tab_callme']); ?>"><?php echo esc_html($item['tab_callme']); ?></a></h4>
                                                        </li>
                                                        <li>
                                                            <p>email address</p>
                                                            <h4><a href="mailto:<?php echo esc_attr($item['tab_email']); ?>"><?php echo esc_html($item['tab_email']); ?></a></h4>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="about-two__img">
                                                    <img src="<?php echo esc_url($item['tab_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--tab-->
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!--About Two End-->
        <?php elseif ($settings['_about_style'] == 'about-3') : ?>
            <!--About Three Start -->
            <section class="about-three">
                <div class="about-three__shape-1 float-bob-y">
                    <img src="<?php echo $settings['background_image']['url']; ?>" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6">
                            <div class="about-three__left">
                                <div class="section-title-three text-left">
                                    <div class="section-title-three__tagline-box">
                                        <span class="section-title-three__tagline"><?php echo $settings['tag']; ?></span>
                                    </div>
                                    <h2 class="section-title-three__title"><?php echo $settings['title']; ?></h2>
                                </div>
                                <ul class="list-unstyled about-three__counter">
                                    <?php foreach ($settings['counters'] as $item) : ?>
                                        <li>
                                            <div class="about-three__counter-single">
                                                <h3 class="odometer" data-count="<?php echo $item['counter_value']; ?>">00</h3>
                                                <p class="about-three__text"><?php echo $item['counter_title']; ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="about-three__bottom">
                                    <p class="about-three__bottom-text"><?php echo $settings['bottom_text']; ?></p>
                                    <a href="<?php echo $settings['bottom_text_link']['url']; ?>" class="about-three__arrow"><span class="icon-up"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="about-three__right">
                                <div class="about-three__img">
                                    <img src="<?php echo $settings['banner_image']['url']; ?>" alt="">
                                    <div class="about-three__video-link">
                                        <a href="<?php echo $settings['youtube_link']['url']; ?>" class="video-popup">
                                            <div class="about-three__video-icon">
                                                <span>Play</span>
                                                <i class="ripple"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--About Three End -->
            <?php if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ): ?>
            <script>
                ;(function($){
                    if ($(".odometer").length) {
                        var odo = $(".odometer");
                        odo.each(function () {
                        $(this).appear(function () {
                            var countNumber = $(this).attr("data-count");
                            $(this).html(countNumber);
                        });
                        });
                    }
                })(jQuery)
            </script>
            <?php endif; ?>
        <?php elseif ($settings['_about_style'] == 'about-4') : ?>
            <section class="about-four">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="about-four__left">
                                <div class="about-four__img-box wow slideInLeft">
                                    <div class="about-four__img">
                                        <img src="<?php echo esc_url($settings['about_image_1']['url']); ?>" alt="">
                                    </div>
                                    <div class="about-four__img-2">
                                        <img src="<?php echo esc_url($settings['about_image_2']['url']); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="about-four__right">
                                <div class="section-title-four text-left">
                                    <div class="section-title-four__tagline-box">
                                        <span class="section-title-four__tagline"><?php echo esc_html($settings['about_four_tagline']); ?></span>
                                    </div>
                                    <h2 class="section-title-four__title"><?php echo esc_html($settings['about_four_title']); ?></h2>
                                </div>
                                <p class="about-four__text"><?php echo esc_html($settings['about_four_desc']);?></p>
                                <h3 class="about-four__title"><?php echo esc_html($settings['about_four_title_2']); ?></h3>
                                <div class="about-four__awards-box">
                                    <ul class="about-four__awards-list list-unstyled">
                                        <li>
                                            <p><?php echo esc_html($settings['aword_list_1']); ?></p>
                                        </li>
                                        <li>
                                            <p><?php echo esc_html($settings['aword_list_2']); ?></p>
                                        </li>
                                    </ul>
                                    <ul class="about-four__awards-list about-four__awards-list-2 list-unstyled">
                                        <li>
                                            <p><?php echo  esc_html($settings['aword_list_3']); ?></p>
                                        </li>
                                        <li>
                                            <p><?php echo esc_html($settings['aword_list_4']); ?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php elseif ($settings['_about_style'] == 'about-5') : ?>

        <?php
        endif;
    }
}

$widgets_manager->register(new Nilos_About());
