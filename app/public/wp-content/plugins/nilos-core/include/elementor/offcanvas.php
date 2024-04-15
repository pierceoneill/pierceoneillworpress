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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_Offcanvas extends Widget_Base {

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
		return 'nilos-offcanvas';
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
		return __( 'Nilos Offcanvas', 'nilos-core' );
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

        // layout Panel
        $this->start_controls_section(
            'nilos_layout',
            [
                'label' => esc_html__('Contents', 'nilos-core'),
            ]
        );

		$this->add_control(
			'_offcanvas_style',
			[
				'label' => esc_html__( 'Offcanvas Style', 'nilos-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'offcanvas-1',
				'options' => [
					'offcanvas-1' => esc_html__( 'Offcanvas 1', 'nilos-core' ),
					'offcanvas-2' => esc_html__( 'Offcanvas 2', 'nilos-core' ),
					'offcanvas-3' => esc_html__( 'Offcanvas 3', 'nilos-core' ),
					'offcanvas-4' => esc_html__( 'Offcanvas 4', 'nilos-core' ),
					'offcanvas-5' => esc_html__( 'Offcanvas 5', 'nilos-core' ),
				]
			]
		);


        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){

        $this->nilos_section_style_controls('canvas_style', 'Canvas - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('canvas_heading', 'Canvas - Heading', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('canvas_text', 'Canvas - Description', '.nilos-el-content p');
        $this->nilos_basic_style_controls('canvas_form_title', 'Form - Title', '.nilos-el-title');

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
        <?php if($settings['_offcanvas_style'] == 'offcanvas-1'): ?>
			<div class="main-menu__nav-sidebar-icon asas">
            <a class="navSidebar-button" href="#"><span class="icon-dots-menu"></span></a>
        </div>
        <?php elseif($settings['_offcanvas_style'] == 'offcanvas-2'): ?>

        <?php elseif($settings['_offcanvas_style'] == 'offcanvas-3'): ?>
 
        <?php elseif($settings['_offcanvas_style'] == 'offcanvas-4'): ?>

        <?php elseif($settings['_offcanvas_style'] == 'offcanvas-5'): ?>

        <?php
        endif;
    }
}

$widgets_manager->register( new Nilos_Offcanvas() );
