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
class Nilos_Footer extends Widget_Base
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
        return 'nilos-footer';
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
        return __('Nilos Footer', 'nilos-core');
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
            '_footer',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_footer_style',
            [
                'label' => esc_html__('Footer Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'footer-2',
                'options' => [
                    'footer-2' => esc_html__('Footer 2', 'nilos-core'),
                    'footer-3' => esc_html__('Footer 3', 'nilos-core'),
                    'footer-4' => esc_html__('Footer 4', 'nilos-core'),
                    'footer-5' => esc_html__('Footer 5', 'nilos-core'),
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
        $settings = $this->get_settings_for_display();?>

        <?php if ($settings['_footer_style'] == 'footer-2') : ?>

        <?php elseif ($settings['_footer_style'] == 'footer-3') : ?>
            <!--Site Footer Start-->
            <footer class="site-footer-three">
                <div class="site-footer-three__top">
                    <div class="container">
                        <div class="site-footer-three__top-inner">
                            <div class="site-footer-three__top-logo">
                                <a href="index.html">
                                    <img src="<?php echo get_parent_theme_file_uri("assets/img/resources/site-footer-three-top-logo.png"); ?>" alt="">
                                </a>
                            </div>
                            <div class="site-footer-three__top-content">
                                <h4>Nilos</h4>
                                <p>Professional Lawyer & Attorney</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-footer-three__menu-box">
                    <div class="container">
                        <div class="site-footer-three__menu-box-inner">
                            <ul class="list-unstyled site-footer-three__menu">
                                <li><a href="about.html">About Me</a></li>
                                <li><a href="service-details.html">Services</a></li>
                                <li><a href="portfolio.html">Case Study</a></li>
                                <li><a href="about.html">Careers</a></li>
                                <li><a href="faq.html">Faq</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="site-footer-three__content-box">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="footer-widget-three__contact-info">
                                    <p class="footer-widget-three__title">get in touch</p>
                                    <ul class="list-unstyled footer-widget-three__contact-info-list">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-open-mail"></span>
                                            </div>
                                            <div class="text">
                                                <p><a href="mailto:info@nilo-photography.com">info@nilo-photography.com</a>
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-call"></span>
                                            </div>
                                            <div class="text">
                                                <p><a href="tel:77788899900">+777 888 999 00</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-pin"></span>
                                            </div>
                                            <div class="text">
                                                <p>12/A, Booston Tower, NYC</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4">
                                <div class="footer-widget-three__open-hours">
                                    <p class="footer-widget-three__title">opening hours</p>
                                    <div class="footer-widget-three__open-hours-box">
                                        <ul class="list-unstyled footer-widget-three__open-hours-list">
                                            <li>Mon - Wed</li>
                                            <li>Fri - Sat</li>
                                            <li>Sunday</li>
                                        </ul>
                                        <ul class="list-unstyled footer-widget-three__open-hours-list footer-widget-three__open-hours-list--two">
                                            <li>10 AM - 08 PM</li>
                                            <li>09 AM - 06 PM</li>
                                            <li>Off Day</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-4">
                                <div class="footer-widget-three__newsletter">
                                    <p class="footer-widget-three__title">newsletter</p>
                                    <div class="footer-widget-three__email-form">
                                        <form class="footer-widget-three__email-box" data-url="MC_FORM_URL">
                                            <div class="footer-widget-three__email-input-box">
                                                <input type="email" placeholder="Business email" name="email">
                                                <div class="footer-widget-three__email-icon">
                                                    <span class="icon-open-mail"></span>
                                                </div>
                                            </div>
                                            <button type="submit" class="footer-widget-three__btn">Subscribe</button>
                                        </form>
                                        <p class="footer-widget-three__email-text">*** We don’t want to save your data</p>
                                        <div class="mc-form__response"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-footer-three__bottom">
                    <div class="container">
                        <div class="site-footer-three__inner">
                            <p class="site-footer-three__text">Copyright & Design by <a href="#">@nilosdesign</a> - 2023</p>
                            <div class="footer-widget-three__social">
                                <ul class="footer-widget-three__social-box list-unstyled">
                                    <li>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-behance"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--Site Footer End-->
        <?php elseif ($settings['_footer_style'] == 'footer-4') : ?>

        <?php elseif ($settings['_footer_style'] == 'footer-5') : ?>

        <?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Footer());
