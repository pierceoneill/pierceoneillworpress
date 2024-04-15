<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use NilosCore\Elementor\Controls\Group_Control_NILOSBGGradient;
use NilosCore\Elementor\Controls\Group_Control_NILOSGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_blogs extends Widget_Base
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
        return 'blogs';
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
        return __('Blogs', 'nilos-core');
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
            '_blogs',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'tag',
            [
                'label' => esc_html__('Tag', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Our Blog", 'nilos-core'),
                'placeholder' => esc_html__('Type your tag here', 'nilos-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Company insights", 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
            ]
        );
        $this->end_controls_section();
    }

    // style_tab_content
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
        <!-- News Three Start -->
        <section class="news-three">
            <div class="container">
                <div class="section-title-three text-center">
                    <div class="section-title-three__tagline-box">
                        <span class="section-title-three__tagline"><?php echo $settings['tag']; ?></span>
                    </div>
                    <h2 class="section-title-three__title"><?php echo $settings['title']; ?></h2>
                </div>
                <div class="row">
                    <!-- News Three Single Start -->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                        <div class="news-three__single">
                            <div class="news-three__img">
                                <img src="<?php echo get_parent_theme_file_uri('/assets/img/blog/news-3-1.jpg'); ?>" alt="">
                                <div class="news-three__content">
                                    <p class="news-three__date">June 21, 2023</p>
                                    <h3 class="news-three__title"><a href="news-details.html">A law firm is a business
                                            an <br> entity that is formed</a></h3>
                                </div>
                                <div class="news-three__user-img">
                                    <img src="<?php echo get_parent_theme_file_uri('/assets/img/blog/news-three-user-1-1.jpg'); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- News Three Single End -->
                    <!-- News Three Single Start -->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
                        <div class="news-three__single">
                            <div class="news-three__img">
                                <img src="<?php echo get_parent_theme_file_uri('/assets/img/blog/news-3-1.jpg'); ?>" alt="">
                                <div class="news-three__content">
                                    <p class="news-three__date">June 21, 2023</p>
                                    <h3 class="news-three__title"><a href="news-details.html">Law firms may specialize
                                            <br> in certain areas</a></h3>
                                </div>
                                <div class="news-three__user-img">
                                    <img src="<?php echo get_parent_theme_file_uri('/assets/img/blog/news-three-user-1-1.jpg'); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- News Three Single End -->
                    <!-- News Three Single Start -->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
                        <div class="news-three__single">
                            <div class="news-three__img">
                                <img src="<?php echo get_parent_theme_file_uri('/assets/img/blog/news-3-1.jpg'); ?>" alt="">
                                <div class="news-three__content">
                                    <p class="news-three__date">June 21, 2023</p>
                                    <h3 class="news-three__title"><a href="news-details.html">Law such as corporate law
                                            <br> intellectual property</a></h3>
                                </div>
                                <div class="news-three__user-img">
                                    <img src="<?php echo get_parent_theme_file_uri('/assets/img/blog/news-three-user-1-1.jpg'); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- News Three Single End -->
                </div>
            </div>
        </section>
        <!-- News Three End -->
<?php
    }
}

$widgets_manager->register(new NILOS_blogs());
