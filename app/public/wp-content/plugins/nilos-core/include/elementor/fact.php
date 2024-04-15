<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use NilosCore\Elementor\Controls\Group_Control_NILOSBGGradient;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_Fact extends Widget_Base {

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
		return 'nilos-fact';
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
		return __( 'Fact', 'nilos-core' );
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   

	protected function register_controls_section() {

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

        // Service group
        $this->start_controls_section(
            'nilos_fact',
            [
                'label' => esc_html__('Fact List', 'nilos-core'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'nilos-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
   

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'nilos-core' ),
                    'style_2' => __( 'Style 2', 'nilos-core' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'nilos_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'nilos-core'),
                    'icon' => esc_html__('Icon', 'nilos-core'),
                    'svg' => esc_html__('SVG', 'nilos-core'),
                ],
                'condition' => [
                    'repeater_condition' => 'style_1'
                ]
            ]
        );


        $repeater->add_control(
            'nilos_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'nilos-core'),
                'condition' => [
                    'nilos_box_icon_type' => 'svg',
                    'repeater_condition' => 'style_1'
                ]
            ]
        );

        $repeater->add_control(
            'nilos_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'nilos-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'nilos_box_icon_type' => 'image',
                    'repeater_condition' => 'style_1',
                ]
            ]
        );

        if (nilos_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'nilos_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'nilos_box_icon_type' => 'icon',
                        'repeater_condition' => 'style_1'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'nilos_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'nilos_box_icon_type' => 'icon',
                        'repeater_condition' => 'style_1'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'nilos_fact_number', [
                'label' => esc_html__('Number', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'nilos-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'nilos_fact_number_unit', [
                'label' => esc_html__('Number Quantity', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('%', 'nilos-core'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'nilos_fact_title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'nilos-core'),
                'label_block' => true,
            ]
        );             


        $this->add_control(
            'nilos_fact_list',
            [
                'label' => esc_html__('Fact - List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'nilos_fact_title' => esc_html__('Business', 'nilos-core'),
                    ],
                    [
                        'nilos_fact_title' => esc_html__('Website', 'nilos-core')
                    ],
                    [
                        'nilos_fact_title' => esc_html__('Marketing', 'nilos-core')
                    ]
                ],
                'title_field' => '{{{ nilos_fact_title }}}',
            ]
        );
        $this->add_responsive_control(
            'nilos_fact_align',
            [
                'label' => esc_html__( 'Alignment', 'nilos-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'nilos-core' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'nilos-core' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'nilos-core' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();


	}

    // style_tab_content
    protected function style_tab_content(){
        $this->nilos_section_style_controls('fact_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_section_style_controls('fact_section_box', 'Box - Style', '.nilos-el-box');
        $this->nilos_basic_style_controls('fact_box_title', 'Fact - Title', '.nilos-el-box-title');
        $this->nilos_basic_style_controls('fact_box_number', 'Fact - Number', '.nilos-el-box-number');
        $this->nilos_icon_style('fact_box_icon', 'Fact - Icon', '.nilos-el-box-icon span');
        $this->nilos_basic_style_controls('fact_box_description', 'Fact - Description', '.nilos-el-box-desc');
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


		<?php else: 
            $bloginfo = get_bloginfo( 'name' );
        ?>	

         <!-- counter area start -->
         <section class="nilos-counter-area pb-100">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-10">
                     <div class="nilos-counter-wrapper d-flex flex-wrap justify-content-between">
                        <?php 
                            foreach ($settings['nilos_fact_list'] as $key => $item) :  
                        ?>
                        <div class="nilos-counter-item d-flex align-items-start mb-30">
                           <div class="nilos-counter-icon mr-15">
                                <?php if($item['nilos_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['nilos_box_icon']) || !empty($item['nilos_box_selected_icon']['value'])) : ?>
                                            <span><?php nilos_render_icon($item, 'nilos_box_icon', 'nilos_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                <?php elseif( $item['nilos_box_icon_type'] == 'image' ) : ?>
                                    <span>
                                        <?php if (!empty($item['nilos_box_icon_image']['url'])): ?>
                                        <img src="<?php echo $item['nilos_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['nilos_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>
                                    </span>
                                <?php else : ?>
                                    <span>
                                        <?php if (!empty($item['nilos_box_icon_svg'])): ?>
                                        <?php echo $item['nilos_box_icon_svg']; ?>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?> 
                           </div>
                           <div class="nilos-counter-content">
                                <?php if (!empty($item['nilos_fact_number' ])): ?>
                                <h4><span class="purecounter" data-purecounter-duration="1" data-purecounter-end="<?php echo nilos_kses($item['nilos_fact_number' ]); ?>">0</span><?php echo nilos_kses($item['nilos_fact_number_unit']);?></h4>
                                <?php endif; ?> 

                                <?php if (!empty($item['nilos_fact_title' ])): ?>
                                <p><?php echo nilos_kses($item['nilos_fact_title' ]); ?></p>
                                <?php endif; ?> 
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- counter area end -->


        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new NILOS_Fact() );