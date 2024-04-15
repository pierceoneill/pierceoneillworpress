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
class NILOS_Author_Quote extends Widget_Base {

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
		return 'nilos-author-quote';
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
		return __( 'NILOS Author Quote', 'nilos-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
		 'nilos_author_quote_sec',
			 [
			   'label' => esc_html__( 'Author Info', 'nilos-core' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);

        $this->add_control(
         'nilos_author_thumb',
         [
           'label'   => esc_html__( 'Upload Author Image', 'nilos-core' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );

		$this->add_control(
		'nilos_author_name',
            [
                'label'       => esc_html__( 'Author Name', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Theodore Handle', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Title', 'nilos-core' ),
                'label_block' => true
            ]
		);
		$this->add_control(
		'nilos_author_designation',
            [
                'label'       => esc_html__( 'Author Designation', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( ' UI/UX design ', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Title', 'nilos-core' ),
                'label_block' => true
            ]
		);
		
		$this->add_control(
         'nilos_author_quote',
         [
           'label'       => esc_html__( 'Author Quote Text', 'nilos-core' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'We work with top suppliers and manufacturers to ensure that every item we ', 'nilos-core' ),
           'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
         ]
        );

        $this->add_control(
         'nilos_author_shape_switch',
         [
           'label'        => esc_html__( 'Enable Shape ?', 'nilos-core' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'nilos-core' ),
           'label_off'    => esc_html__( 'Hide', 'nilos-core' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
		
		$this->end_controls_section();

        $this->start_controls_section(
         'nilos_author_bg_sec',
             [
               'label' => esc_html__( 'Background Image', 'nilos-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );
        
        $this->add_control(
         'nilos_author_bg_image',
         [
           'label'   => esc_html__( 'Upload Background Image', 'nilos-core' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_bg',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();

		$this->start_controls_section(
		 'nilos_brand_sec',
			 [
			   'label' => esc_html__( 'Brand List', 'nilos-core' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
		'nilos_brand_title',
		  [
			'label'   => esc_html__( 'Brand Title', 'nilos-core' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Brand', 'nilos-core' ),
			'label_block' => true,
		  ]
		);

        $repeater->add_control(
         'nilos_brand_image',
         [
           'label'   => esc_html__( 'Upload Brand Image', 'nilos-core' ),
           'type'    => \Elementor\Controls_Manager::MEDIA,
             'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
           ],
         ]
        );
		
		$this->add_control(
		  'nilos_brand_list',
		  [
			'label'       => esc_html__( 'Brand List', 'nilos-core' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
			  [
				'nilos_brand_title'   => esc_html__( 'Brand Image', 'nilos-core' ),
			  ],
			  [
				'nilos_brand_title'   => esc_html__( 'Brand Image', 'nilos-core' ),
			  ],
			  [
				'nilos_brand_title'   => esc_html__( 'Brand Image', 'nilos-core' ),
			  ],
			],
			'title_field' => '{{{ nilos_brand_title }}}',
		  ]
		);
		
		
		$this->end_controls_section();
    }

    protected function style_tab_content(){
		$this->nilos_basic_style_controls('history_title', 'Title', '.nilos-el-box-title');
		$this->nilos_basic_style_controls('history_list', 'List', '.nilos-el-box-list');
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

            if ( !empty($settings['nilos_author_bg_image']['url']) ) {
                $nilos_author_bg_image_url = !empty($settings['nilos_author_bg_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_author_bg_image']['id'], $settings['thumbnail_size']) : $settings['nilos_author_bg_image']['url'];
                $nilos_author_bg_image_alt = get_post_meta($settings["nilos_author_bg_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if ( !empty($settings['nilos_author_thumb']['url']) ) {
                $nilos_author_thumb_url = !empty($settings['nilos_author_thumb']['id']) ? wp_get_attachment_image_url( $settings['nilos_author_thumb']['id'], $settings['thumbnail_size']) : $settings['nilos_author_thumb']['url'];
                $nilos_author_thumb_alt = get_post_meta($settings["nilos_author_thumb"]["id"], "_wp_attachment_image_alt", true);
            }
		?>


         <!-- author area start -->
         <section class="nilos-author-area pb-120">
            <div class="container">
               <div class="nilos-author-inner p-relative z-index-1 nilos-author-bg-overlay fix" data-bg-color="#821F40">

                    <?php if($settings['nilos_author_shape_switch'] == 'yes'): ?>
                    <!-- shape -->
                    <span class="nilos-author-shape-1"></span>
                    <!-- shape end -->
                    <?php endif; ?>

                  <div class="nilos-author-bg include-bg "  data-background="<?php echo esc_url($nilos_author_bg_image_url); ?>"></div>
                  <div class="row align-items-center">
                     <div class="col-xl-6 col-lg-6">
                        <div class="nilos-author-wrapper p-relative z-index-1">
                           <div class="nilos-author-info-wrapper d-flex align-items-center mb-30">

                                <?php if(!empty($nilos_author_thumb_url)): ?>
                                <div class="nilos-author-info-avater mr-10">
                                    <img src="<?php echo esc_url($nilos_author_thumb_url); ?>" alt="<?php echo esc_attr($nilos_author_bg_image_alt); ?>">
                                </div>
                                <?php endif; ?>

                              <div class="nilos-author-info">

                                <?php if(!empty($settings['nilos_author_name'])) : ?>
                                <h3 class="nilos-author-info-title"><?php echo esc_html($settings['nilos_author_name']); ?></h3>
                                <?php endif; ?>
                                
                                <?php if(!empty($settings['nilos_author_designation'])) : ?>
                                <span class="nilos-author-info-designation"><?php echo esc_html($settings['nilos_author_designation']); ?></span>
                                <?php endif; ?>
                              </div>
                           </div>
                            <?php if(!empty($settings['nilos_author_quote'])) : ?>
                           <div class="nilos-author-content">
                              <p><?php echo esc_html($settings['nilos_author_quote']); ?></p>
                           </div>
                            <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6">
                        <div class="nilos-author-brand-wrapper d-flex flex-wrap align-items-center justify-content-lg-end">
                            <?php foreach ($settings['nilos_brand_list'] as $key => $item) :  
                                if ( !empty($item['nilos_brand_image']['url']) ) {
                                    $nilos_brand_image_url = !empty($item['nilos_brand_image']['id']) ? wp_get_attachment_image_url( $item['nilos_brand_image']['id'], $settings['thumbnail_size']) : $item['nilos_brand_image']['url'];
                                    $nilos_brand_image_alt = get_post_meta($item["nilos_brand_image"]["id"], "_wp_attachment_image_alt", true);
                                }
                            ?>
                           <div class="nilos-author-brand-item text-center">
                              <img src="<?php echo esc_url($nilos_brand_image_url); ?>" alt="<?php echo esc_attr($nilos_brand_image_alt); ?>">
                           </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial area end -->
         

        <?php 
	}
}

$widgets_manager->register( new NILOS_Author_Quote() );