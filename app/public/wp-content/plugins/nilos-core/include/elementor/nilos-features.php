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
class Nilos_Features extends Widget_Base {

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
        return 'nilos-features';
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
        return __( 'Nilos Features', 'nilos-core' );
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
            '_features',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'_feature_style',
			[
				'label' => esc_html__( 'Feature Style', 'nilos-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'feature-1',
				'options' => [
					'feature-1' => esc_html__( 'Feature 1', 'nilos-core' ),
					'feature-2' => esc_html__( 'Feature 2', 'nilos-core' ),
					'feature-3' => esc_html__( 'Feature 3', 'nilos-core' ),
					'feature-4' => esc_html__( 'Feature 4', 'nilos-core' ),
					'feature-5' => esc_html__( 'Feature 5', 'nilos-core' ),
				]
			]
		);
        $this->add_control(
            'feature_list_text',
            [
                'label' => esc_html__('Feature List Text', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Title', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Let\'s Talk', 'nilos-core'),
                        'label_block' => true,
                    ]
                ],
                'title_field' => '{{{ text }}}',
                'condition' => [
                    '_feature_style'  => ['feature-2']
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function style_tab_content() {
       
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
        <?php if($settings['_feature_style'] == 'feature-1'): ?>
        
        <?php elseif($settings['_feature_style'] == 'feature-2'): ?>
        <!--Feature Two Start-->
        <section class="feature-two">
            <div class="feature-two__bg"></div><!-- /.feature-two__bg -->
            <div class="feature-two__gradient-bg-left"></div>
            <div class="feature-two__gradient-bg-right"></div>
            <div class="feature-two__inner clearfix marquee_mode">
                <?php if($settings['feature_list_text']): ?>
                <ul class="list-unstyled feature-two__list clearfix">
                    <?php foreach($settings['feature_list_text'] as $item): ?>
                    <li><?php echo esc_html($item['text']); ?> <span>+</span> </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div><!-- /.feature-two__inner -->
        </section>
        <!--Feature Two End-->
        <?php elseif($settings['_feature_style'] == 'feature-3'): ?>
 
        <?php elseif($settings['_feature_style'] == 'feature-4'): ?>

        <?php elseif($settings['_feature_style'] == 'feature-5'): ?>

        <?php
        endif;
    }
}

$widgets_manager->register( new Nilos_Features() );
