<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_Btn extends Widget_Base {

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
		return 'nilos-btn';
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
		return __( 'NILOS BTN', 'nilos-core' );
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
		return 'nilos-icon';
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
	protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'nilos_layout',
            [
                'label' => esc_html__('Design Layout', 'nilos-core'),
            ]
        );
        $this->add_control(
            'nilos_design_style',
            [
                'label' => esc_html__('Select Layout', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // nilos_btn_button_group
        $this->start_controls_section(
            'nilos_btn_button_group',
            [
                'label' => esc_html__('Button', 'nilos-core'),
            ]
        );

        $this->add_control(
            'nilos_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'nilos-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nilos-core' ),
                'label_off' => esc_html__( 'Hide', 'nilos-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nilos_btn_text',
            [
                'label' => esc_html__('Button Text', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'nilos-core'),
                'title' => esc_html__('Enter button text', 'nilos-core'),
                'label_block' => true,
                'condition' => [
                    'nilos_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'nilos_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'nilos_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'nilos_btn_link',
            [
                'label' => esc_html__('Button link', 'nilos-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('htniloss://your-link.com', 'nilos-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'nilos_btn_link_type' => '1',
                    'nilos_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'nilos_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'nilos-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => nilos_get_all_pages(),
                'condition' => [
                    'nilos_btn_link_type' => '2',
                    'nilos_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'nilos_align',
            [
                'label' => esc_html__('Alignment', 'nilos-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'nilos-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'nilos-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'nilos-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        
        $this->end_controls_section();

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

		<?php if ( $settings['nilos_design_style']  == 'layout-2' ): 
            // Link
            if ('2' == $settings['nilos_btn_link_type']) {
                $this->add_render_attribute('nilos-button-arg', 'href', get_permalink($settings['nilos_btn_page_link']));
                $this->add_render_attribute('nilos-button-arg', 'target', '_self');
                $this->add_render_attribute('nilos-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('nilos-button-arg', 'class', 'nilos-btn nilos-btn-border');
            } else {
                if ( ! empty( $settings['nilos_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'nilos-button-arg', $settings['nilos_btn_link'] );
                    $this->add_render_attribute('nilos-button-arg', 'class', 'nilos-btn nilos-btn-border');
                }
            }
        ?>

		<?php else: 
            // Link
            if ('2' == $settings['nilos_btn_link_type']) {
                $this->add_render_attribute('nilos-button-arg', 'href', get_permalink($settings['nilos_btn_page_link']));
                $this->add_render_attribute('nilos-button-arg', 'target', '_self');
                $this->add_render_attribute('nilos-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('nilos-button-arg', 'class', 'nilos-btn-border-9');
            } else {
                if ( ! empty( $settings['nilos_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'nilos-button-arg', $settings['nilos_btn_link'] );
                    $this->add_render_attribute('nilos-button-arg', 'class', 'nilos-btn-border-9');
                }
            }
		?>	

        <?php if (!empty($settings['nilos_btn_text'])) : ?>
        <div class="blog__more-10 text-center wow fadeInUp" data-wow-delay=".9s" data-wow-duration="1s">
            <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?> ><?php echo $settings['nilos_btn_text']; ?> <i class="fa-regular fa-angle-right"></i></a>
        </div>
        <?php endif; ?>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new NILOS_Btn() );