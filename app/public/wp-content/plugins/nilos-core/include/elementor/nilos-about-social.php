<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_About_Social extends Widget_Base {

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
        return 'nilos-about-social';
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
        return __( 'Nilos About Social', 'nilos-core' );
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
            '_social_content',
            [
                'label' => esc_html__('Social Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_social_title',
            [
                'label' => esc_html__('Widget Title', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Social <br> Connect',
                'placeholder' => esc_html__('Type Heading Text', 'nilos-core'),
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            '_social_list_content',
            [
                'label' => esc_html__('Social List Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        if (nilos_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                '_social_list_old_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                ]
            );
        } else {
            $repeater->add_control(
                '_social_list_new_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value'     => 'fab fa-facebook-f',
                        'library'   => 'solid',
                    ],
                ]
            );
        }
        $repeater->add_control(
            '_social_list_link',
			[
				'label' => esc_html__( 'Link', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
        );
        

        $this->add_control(
            '_social_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_social_list_link'        => [
                            'url'   => 'https://facebook.com',
                        ],
                        '_social_list_new_icon'    => [
                            'value'     => 'fab fa-facebook-f',
                            'library'   => 'solid',
                        ]
                    ],
                    [
                        '_social_list_link'        => [
                            'url'   => 'https://twitter.com',
                        ],
                        '_social_list_new_icon'    => [
                            'value'     => 'fab fa-twitter',
                            'library'   => 'solid',
                        ]
                    ],
                    [
                        '_social_list_link'        => [
                            'url'   => 'https://youtube.com',
                        ],
                        '_social_list_new_icon'    => [
                            'value'     => 'fab fa-youtube',
                            'library'   => 'solid',
                        ]
                    ],
                    [
                        '_social_list_link'        => [
                            'url'   => 'https://behance.com',
                        ],
                        '_social_list_new_icon'    => [
                            'value'     => 'fab fa-behance',
                            'library'   => 'solid',
                        ]
                        
                    ],
                ],
            ]
        );
        

        $this->end_controls_section();
    }

    protected function style_tab_content() {
        $this->nilos_basic_style_controls('_social_list', 'Widget', '.about-one__social-box');
        $this->nilos_basic_style_controls('_social_title', 'Widget title', '.about-one__social-box .about-one__social-title');
        $this->nilos_basic_style_controls('_social_icons', 'Icons', '.about-one__social-box .about-one__social a');
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
        <div class="about-one__social-box">
            <h3 class="about-one__social-title"><?php echo wp_kses_post($settings['_social_title']); ?></h3>
            <?php if(!empty($settings['_social_list'])): ?>
            <div class="about-one__social">
                <?php foreach($settings['_social_list'] as $key => $item): ?>
                <?php
                    if(!empty($item['_social_list_link']['url'])){
                        $this->add_link_attributes('_social_list_link', $item['_social_list_link']);
                    }
                ?>
                <a <?php echo $this->get_render_attribute_string( '_social_list_link' ); ?>><?php nilos_render_icon($item, '_social_list_old_icon', '_social_list_new_icon'); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        endif;
    }
}

$widgets_manager->register( new Nilos_About_Social() );
