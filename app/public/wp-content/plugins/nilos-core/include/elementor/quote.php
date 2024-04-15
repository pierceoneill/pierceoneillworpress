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
class Nilos_Quote extends Widget_Base {

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
		return 'nilos-quote';
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
		return __( 'Nilos Quote', 'nilos-core' );
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
			'quotes',
			[
				'label' => esc_html__( 'Quotes', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Author', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => 'alonso d <span>-head of idea</span>',
						'label_block' => true,
					],
					[
						'name' => 'list_content',
						'label' => esc_html__( 'Quote', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => 'Understanding the buyer & the process of sale.',
						'show_label' => false,
					]
				],
				'default' => [
					[
						'list_title' => 'alonso d <span>-head of idea</span>',
						'list_content' => esc_html__( 'Understanding the buyer & the process of sale.', 'nilos-core' ),
					]
				],
				'title_field' => '{{{ list_title }}}',
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
            <?php if($settings['quotes']): ?>
            <div class="impression-one__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                "loop": true,
                "autoplay": true,
                "margin": 0,
                "nav": false,
                "dots": true,
                "smartSpeed": 500,
                "autoplayTimeout": 10000,
                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "768": {
                        "items": 1
                    },
                    "992": {
                        "items": 1
                    },
                    "1290": {
                        "items": 1
                    }
                }
            }'>
                <?php foreach($settings['quotes'] as $item): ?>
                <div class="item">
                    <div class="impression-one__items">
                        <div class="impression-one__carousel-icon">
                            <span class="icon-quote"></span>
                        </div>
                        <p class="impression-one__carousel-text">"<?php echo esc_html($item['list_content']); ?>"</p>
                        <p class="impression-one__carousel-client"><?php echo $item['list_title']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <script>
                ;(function($){
                    $(document).ready(function(){
                        if ($(".thm-owl__carousel").length) {
                            $(".thm-owl__carousel").each(function () {
                                let elm = $(this);
                                let options = elm.data('owl-options');
                                let thmOwlCarousel = elm.owlCarousel(options);
                            });
                        }
                    })
                })(jQuery)
            </script>
            <?php endif; ?>
        <?php endif; ?>
        <?php 
	}
}

$widgets_manager->register( new Nilos_Quote() );