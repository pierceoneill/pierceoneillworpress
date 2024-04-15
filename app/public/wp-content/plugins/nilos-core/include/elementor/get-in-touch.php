<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_Get_In_Touch extends Widget_Base {

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
		return 'nilos-get-in-touch';
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
		return __( 'Nilos Get In touch', 'nilos-core' );
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
    }  

    protected function register_controls_section(){
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
                    'layout-2' => esc_html__('Layout 2', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'GET IN TOUCH',
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);
        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Have any Project on your mind. Let us know',
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Let\'s Talk Now',
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);
        $this->add_control(
			'btn_url',
			[
				'label' => esc_html__( 'Button URL', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

        $this->add_control(
			'shape',
			[
				'label' => esc_html__( 'A shape', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
        if ( ! empty( $settings['btn_url']['url'] ) ) {
			$this->add_link_attributes( 'btn_url', $settings['btn_url'] );
		}
		?>

		<?php if ( $settings['nilos_design_style']  == 'layout-2' ): ?>
		<?php else: ?>	
            <div class="impression-one__get-intouch">
                <p class="impression-one__get-intouch-sub-title"><?php echo $settings['subtitle']; ?></p>
                <h4 class="impression-one__get-intouch-title"><?php echo $settings['title']; ?></h4>
                <div class="impression-one__btn">
                    <a <?php echo $this->get_render_attribute_string( 'btn_url' ); ?>><?php echo $settings['btn_text']; ?> <span></span> </a>
                </div>
                <div class="impression-one__get-intouch-shape-1">
                    <img src="<?php echo $settings['shape']['url']; ?>" alt="<?php bloginfo('name'); ?>">
                </div>
            </div>
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Nilos_Get_In_Touch() );