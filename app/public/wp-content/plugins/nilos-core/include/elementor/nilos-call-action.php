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
class NILOS_call_action extends Widget_Base
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
        return 'nilos-call-to-action';
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
        return __('Nilos Call To Action', 'nilos-core');
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
        // layout Panel
        $this->start_controls_section(
            'nilos_layout',
            [
                'label' => esc_html__('Background Image', 'nilos-core'),
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
            'call_to_action_layout',
            [
                'label' => esc_html__('Content', 'nilos-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("The firm provides legals service to individual, business, & other organizations too.", 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
            ]
        );
        $this->add_control(
            'email_number',
            [
                'label' => esc_html__('Email & Number', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'email_number_title',
                        'label' => esc_html__('Title', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Title', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'email_number_value',
                        'label' => esc_html__('Option', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Value', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'email_number_link',
                        'label' => esc_html__('Link', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('#', 'nilos-core'),
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'email_number_title' => esc_html__('Title', 'nilos-core'),
                        'email_number_value' => esc_html__('Value', 'nilos-core'),
                        'email_number_link' => esc_html__('Link', 'nilos-core'),
                    ],
                ],
                'title_field' => '{{{ email_number_title }}}',
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
        <!-- CTA One Start -->
        <section class="cta-one">
            <div class="cta-one__bg" style="background-image: url(<?php echo $settings['background_image']['url']; ?>);"></div>
            <div class="container">
                <div class="cta-one__inner">
                    <div class="cta-one__icon">
                        <span class="icon-justice-scale"></span>
                    </div>
                    <h2 class="cta-one__title"><?php echo $settings['title']; ?></h2>
                    <ul class="list-unstyled cta-one__contact-info">
                        <?php foreach ($settings['email_number'] as $item) : ?>
                            <li>
                                <p class="cta-one__contact-sub-title"><?php echo $item['email_number_title']; ?></p>
                                <h4 class="cta-one__contact-number">
                                    <a href="<?php echo $item['email_number_link']; ?>"><?php echo $item['email_number_value']; ?></a>
                                </h4>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
        <!-- CTA One End -->
<?php
    }
}

$widgets_manager->register(new NILOS_call_action());
