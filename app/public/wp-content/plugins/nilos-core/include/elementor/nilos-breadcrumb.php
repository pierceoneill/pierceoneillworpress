<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Elementor\Core\Utils\ImportExport\Url;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_Breadcrumb extends Widget_Base {

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
        return 'nilos-breadcrumb';
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
        return __( 'Nilos Breadcrumb', 'nilos-core' );
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

    protected function register_controls_section(){

        $this->start_controls_section(
         'nilos_banner_sec',
             [
               'label' => esc_html__( 'Title & Content', 'nilos-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
        'nilos_breadcrumb_subtitle',
         [
            'label'       => esc_html__( 'Breadcrumb Subtitle', 'nilos-core' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Us', 'nilos-core' ),
            'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
            'label_block' => true,
         ]
        );
        
        $this->add_control(
        'nilos_breadcrumb_title',
         [
            'label'       => esc_html__( 'Breadcrumb Title', 'nilos-core' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'The Page Title', 'nilos-core' ),
            'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
            'label_block' => true
         ]
        );

        $this->add_control(
			'nilos_image',
			[
				'label' => esc_html__( 'Breadcrumb Bg', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => get_parent_theme_file_uri('/assets/img/shape/page-header-shape.png'),
				],
			]
		);

        $this->end_controls_section();

    }

    protected function style_tab_content(){
        $this->nilos_basic_style_controls('services_box_title', 'Box - Title', '.page-header__inner h2');
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
        if ( !empty($settings['nilos_image']['url']) ) {
            $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
            $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
        }
        ?>
         <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header__shape-1 float-bob-y">
                <img src="<?php echo esc_url($nilos_image); ?>" alt="<?php echo esc_attr($nilos_image_alt); ?>">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="<?php echo home_url(); ?>"><?php esc_html_e('Home', 'nilos-core'); ?></a></li>
                        <li><span>/</span></li>
                        <li><?php echo single_post_title(); ?></li>
                    </ul>
                    <h2><?php echo esc_html($settings['nilos_breadcrumb_title']); ?></h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <?php
    }
}

$widgets_manager->register( new NILOS_Breadcrumb() );
