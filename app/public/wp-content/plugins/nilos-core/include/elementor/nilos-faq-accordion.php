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
class Nilos_Faq_Accordion extends Widget_Base {

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
        return 'nilos-faq-accordion';
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
        return __( 'Nilos Faq Accordion', 'nilos-core' );
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
            '_nilos_accordion',
            [
                'label' => esc_html__('Accordion', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            '_accordion_title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Website Design', 'nilos-core'),
                'placeholder' => esc_html__('Type Heading Text', 'nilos-core'),
            ]
        );
        $repeater->add_control(
            '_accordion_content',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Your website is the face of your business, which is why you need to invest as much energy into it as you do into the look and feel.',
            ]
        );


        $this->add_control(
            '_accordion_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        '_accordion_title'          => 'Website Design',
                        '_accordion_content'        => 'Your website is the face of your business, which is why you need to invest as much energy into it as you do into the look and feel.',
                    ],
                ],
                'title_field' => '{{{ _accordion_title }}}'
            ]
        );
        

        $this->end_controls_section();
    }

    protected function style_tab_content() {
        $this->start_controls_section(
			'_accordion_title',
			[
				'label' => esc_html__( 'Title', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title',
				'selector' => '{{WRAPPER}} .faq-page__right .accrodion-grp .accrodion .accrodion-title h4',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'_accordion_content',
			[
				'label' => esc_html__( 'Content', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content',
				'selector' => '{{WRAPPER}} .faq-page__right .accrodion-grp .accrodion .accrodion-content .inner p',
			]
		);
        $this->end_controls_section();
        $this->nilos_basic_style_controls('_accordion', 'Accordion', '.services-one__right');
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
        <?php if(!empty($settings['_accordion_list'])): ?>
            <div class="faq-page__right">
                <div class="accrodion-grp faq-page-accrodion" data-grp-name="faq-page-accrodion">
                    <?php foreach($settings['_accordion_list'] as $item): ?>
                    <div class="accrodion">
                        <div class="accrodion-title">
                            <h4><?php echo esc_html($item['_accordion_title']); ?></h4>
                        </div>
                        <div class="accrodion-content">
                            <div class="inner">
                                <p><?php echo wp_kses_post($item['_accordion_content']); ?></p>
                            </div><!-- /.inner -->
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php
        endif;
    }
}

$widgets_manager->register( new Nilos_Faq_Accordion() );
