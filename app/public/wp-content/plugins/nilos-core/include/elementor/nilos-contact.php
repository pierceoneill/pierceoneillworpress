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
class Nilos_Contact extends Widget_Base
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
        return 'nilos-contact';
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
        return __('Nilos Contact', 'nilos-core');
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
            'contact-one',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_contact_style',
            [
                'label' => esc_html__('skill Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'contact-1',
                'options' => [
                    'contact-1' => esc_html__('contact 1', 'nilos-core'),
                    'contact-2' => esc_html__('contact 2', 'nilos-core'),
                    'contact-3' => esc_html__('contact 3', 'nilos-core'),
                    'contact-4' => esc_html__('contact 4', 'nilos-core'),
                    'contact-5' => esc_html__('contact 5', 'nilos-core'),
                ]
            ]
        );


        $this->add_control(
			'contact_tagline',
			[
				'label' => esc_html__( 'Tagline', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'OFFICE BRANCH', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your tagline here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Description', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( 'Let’s discuss', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);


        $this->end_controls_section();

        $this->start_controls_section(
            'contact__left',
            [
                'label' => esc_html__('Content Left', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'contact_tag',
			[
				'label' => esc_html__( 'Tagline', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'New Yeark', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your tagline here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'contact_info_left',
			[
				'label' => esc_html__( 'Contact Info', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
                    
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'textdomain' ),
                        'type'  => \Elementor\Controls_Manager::ICONS
                    ],
                    [
						'name' => 'text',
						'label' => esc_html__('Text', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'info@webmail.com' , 'nilos-core' ),
						'label_block' => true,
					]

				],
				'default' => [
					[
						'text' => esc_html__( 'info@webmail.com', 'nilos-core' )
					],
				],
				'title_field' => '{{{ text }}}',
			],

		);


        //right
        $this->add_control(
			'contact_tag_right',
			[
				'label' => esc_html__( 'Tagline', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'uganda', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your tagline here', 'nilos-core' ),
			]
		);


        $this->add_control(
            'contact_info_right',
            [
                'label' => esc_html__( 'Contact Info Right', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'textdomain' ),
                        'type'  => \Elementor\Controls_Manager::ICONS
                    ],
                    [
						'name' => 'text',
						'label' => esc_html__('Text', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'info@webmail.com' , 'nilos-core' ),
						'label_block' => true,
					]

                ],
                'default' => [
                    [
						'text' => esc_html__( 'info@webmail.com', 'nilos-core' )
					],
                ],
                'title_field' => '{{{ text }}}',
            ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'contact_right',
            [
                'label' => esc_html__('Content Right', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]

            
        );

        $this->add_control(
			'form_shortcout',
			[
				'label' => esc_html__( 'Form shortcout', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( 'Default description', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your description here', 'nilos-core' ),
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
        <?php if ($settings['_contact_style'] == 'contact-1') : ?>

        <?php elseif ($settings['_contact_style'] == 'contact-2') : ?>

        <?php elseif ($settings['_contact_style'] == 'contact-3') : ?>

        <?php elseif ($settings['_contact_style'] == 'contact-4') : ?>
        <!--Contact Two Start-->
            <section class="contact-two">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6">
                            <div class="contact-two__left">
                                <div class="section-title-four text-left">
                                    <div class="section-title-four__tagline-box">
                                        <span class="section-title-four__tagline"><?php echo $settings['contact_tagline']; ?></span>
                                    </div>
                                    <h2 class="section-title-four__title"> <?php echo wp_kses_post($settings['section_title']);?> 
                                </div>
                                <div class="contact-two__contact-box">
                                    <div class="contact-two__contact-left">
                                        <p class="contact-two__tag"><?php echo $settings['contact_tag']; ?></p>
                                        <ul class="contact-two__list list-unstyled">
                                            <?php foreach($settings['contact_info_left'] as $item) : ?>
                                            <li>
                                                <div class="icon">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </div>
                                                <div class="text">
                                                    <p><a href="#"><?php echo esc_html($item['text']); ?></a></p>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="contact-two__contact-right">
                                        <p class="contact-two__tag contact-two__tag-2"><?php echo esc_html($settings['contact_tag_right']); ?></p>
                                        <ul class="contact-two__list list-unstyled">
                                            <?php foreach($settings['contact_info_right'] as $item) : ?>
                                            <li>
                                                <div class="icon">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </div>
                                                <div class="text">
                                                    <p><a href="#"><?php echo esc_html($item['text']); ?></a></p>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="contact-two__right">
                                <div class="contact-two__form-box">
                                    <div class="contact-two__form contact-form-validated" novalidate="novalidate">
                                        <?php echo do_shortcode($settings['form_shortcout']) ?>
                                    </div>
                                    <div class="result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!--Contact Two End-->

        <?php elseif ($settings['_contact_style'] == 'contact-5') : ?>
        <?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Contact());
