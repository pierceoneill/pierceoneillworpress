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
class Nilos_About_Img extends Widget_Base {

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
        return 'nilos-about-img';
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
        return __( 'Nilos About Image', 'nilos-core' );
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
            'image_content',
            [
                'label' => esc_html__('Image Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_about_style',
            [
                'label' => esc_html__('About Image Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'about-2',
                'options' => [
                    'about-2' => esc_html__('About Image 2', 'nilos-core'),
                    'about-3' => esc_html__('About Image 3', 'nilos-core'),
                    'about-4' => esc_html__('About Image 4', 'nilos-core'),
                    'about-5' => esc_html__('About Image 5', 'nilos-core'),
                ]
            ]
        );
        $this->add_control(
            '_image',
            [
                'label' => esc_html__('Choose Image', 'nilos-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url'   => \Elementor\Utils::get_placeholder_image_src()
                ]
            ]
        );

        $this->add_control(
            '_btn_text',
            [
                'label' => esc_html__('Button Text', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Download CV', 'nilos-core'),
                'placeholder' => esc_html__('Type Button Text', 'nilos-core'),
            ]
        );
        $this->add_control(
            '_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
                'condition' => [
                    '_about_style'  => ['about-2']
                ]
			]
        );
        $this->end_controls_section();
    }

    protected function style_tab_content() {
        $this->start_controls_section(
			'img_button_link',
			[
				'label' => esc_html__( 'Button Link', 'nilos-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_img_button_link',
				'selector' => '{{WRAPPER}} .about-one__img-2 a',
			]
		);
        $this->end_controls_section();
        $this->nilos_basic_style_controls('_image_content', 'Image', '.about-one__img-2');
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
        <?php if($settings['_about_style'] == 'about-2'): ?>
            <div class="about-one__img-2">
                <img src="<?php echo esc_url($settings['_image']['url']); ?>" alt="">
                <?php
                    if(!empty($settings['_btn_link']['url'])){
                        $this->add_link_attributes('_btn_link', $settings['_btn_link']);
                    }
                ?>
                <a <?php echo $this->get_render_attribute_string( '_btn_link' ); ?> class="about-one__download"><?php echo esc_html($settings['_btn_text']); ?></a>
            </div>
        <?php elseif($settings['_about_style'] == 'about-5'): ?>
            <div class="about-five__right">
                <div class="about-five__img wow slideInRight" data-wow-delay="100ms"
                    data-wow-duration="2500ms">
                    <img src="<?php echo esc_url($settings['_image']['url']); ?>" alt="">
                    <div class="about-five__user">
                        <h3 class="about-five__user-name"><?php echo esc_html($settings['_btn_text']); ?></h3>
                    </div>
                </div>
            </div>
        <?php
        endif;
    }
}

$widgets_manager->register( new Nilos_About_Img() );
