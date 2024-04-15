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
class Nilos_Impression extends Widget_Base {

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
		return 'nilos-impression';
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
		return __( 'Nilos Impression', 'nilos-core' );
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
			'text',
			[
				'label' => esc_html__( 'Text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Work & Activity <br> Impressions',
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);
        $this->add_control(
			'percent',
			[
				'label' => esc_html__( 'Percent', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '75'
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

		<?php if ( $settings['nilos_design_style']  == 'layout-2' ): ?>
		<?php else: ?>	
            <div class="impression-one__content-right">
                <div class="impression-one__progress-wrap">
                    <div class="impression-one__progress-single">
                        <div class="impression-one__progress-box">
                            <div class="circle-progress"
                                data-options='{ "value": 0.9,"thickness": 6,"emptyFill": "#E2E2E2","lineCap": "square", "size": 148, "fill": { "color": "#222222" } }'>
                            </div><!-- /.circle-progress -->
                            <span><?php echo $settings['percent']; ?>%</span>
                        </div>
                    </div>
                </div>
                <div class="impression-one__content-bottom">
                    <h3 class="impression-one__content-title"><?php echo $settings['text']?></h3>
                    <div class="impression-one__content-icon">
                        <span class="icon-hot-air-balloon"></span>
                    </div>
                </div>
            </div>
            <script>
                ;(function($){
                    $(document).ready(function(){
                        if ($(".circle-progress").length) {
                            $(".circle-progress").appear(function () {
                                let circleProgress = $(".circle-progress");
                                circleProgress.each(function () {
                                let progress = $(this);
                                let progressOptions = progress.data("options");
                                progress.circleProgress(progressOptions);
                                });
                            });
                        }
                    })
                })(jQuery)
            </script>
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Nilos_Impression() );