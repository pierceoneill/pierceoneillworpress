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
class NILOS_Contact_Common extends Widget_Base {

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
		return 'nilos-contact-common';
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
		return __( 'NILOS Common Contact', 'nilos-core' );
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


    public function get_nilos_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $nilos_cfa         = array();
        $nilos_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $nilos_forms       = get_posts( $nilos_cf_args );
        $nilos_cfa         = ['0' => esc_html__( 'Select Form', 'nilos-core' ) ];
        if( $nilos_forms ){
            foreach ( $nilos_forms as $nilos_form ){
                $nilos_cfa[$nilos_form->ID] = $nilos_form->post_title;
            }
        }else{
            $nilos_cfa[ esc_html__( 'No contact form found', 'nilos-core' ) ] = 0;
        }
        return $nilos_cfa;
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
	protected function register_controls() {

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
                    'layout-3' => esc_html__('Layout 3', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'nilos_contact',
            [
                'label' => esc_html__('Contact Form', 'nilos-core'),
            ]
        );

        $this->add_control(
            'nilos_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'nilos-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_nilos_contact_form(),
            ]
        );

        $this->end_controls_section();


        // nilos_section_title
        $this->start_controls_section(
            'nilos_section_title',
            [
                'label' => esc_html__('Title & Content', 'nilos-core'),
            ]
        );

        $this->add_control(
            'nilos_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'nilos-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nilos-core' ),
                'label_off' => esc_html__( 'Hide', 'nilos-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nilos_sub_title',
            [
                'label' => esc_html__('Sub Title', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('NILOS Sub Title', 'nilos-core'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'nilos-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'nilos_title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('NILOS Title Here', 'nilos-core'),
                'placeholder' => esc_html__('Type Heading Text', 'nilos-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'nilos_description',
            [
                'label' => esc_html__('Description', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('NILOS section description here', 'nilos-core'),
                'placeholder' => esc_html__('Type section description here', 'nilos-core'),
            ]
        );

        $this->add_control(
            'nilos_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'nilos-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'nilos-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'nilos-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'nilos-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'nilos-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'nilos-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'nilos-core'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'nilos_align',
            [
                'label' => esc_html__('Alignment', 'nilos-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'nilos-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'nilos-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'nilos-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
         'nilos_job_contact_btn_sec',
             [
               'label' => esc_html__( 'Button', 'nilos-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'nilos_design_style' => 'layout-2'
               ]
             ]
        );
        
        
        $this->add_control(
            'nilos_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'nilos-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nilos-core' ),
                'label_off' => esc_html__( 'Hide', 'nilos-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nilos_btn_text',
            [
                'label' => esc_html__('Button Text', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'nilos-core'),
                'title' => esc_html__('Enter button text', 'nilos-core'),
                'label_block' => true,
                'condition' => [
                    'nilos_btn_button_show' => 'yes'
                ],
            ]
        );
      
        
        $this->end_controls_section();

        $this->start_controls_section(
         'nilos_contact_info_sec',
             [
               'label' => esc_html__( 'Box Title & Content', 'nilos-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'nilos_design_style' => 'layout-3'
               ]
             ]
        );
        
        $this->add_control(
            'nilos_contact_info_title',
             [
                'label'       => esc_html__( 'Title', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Send Us a Mail', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
                'label_block' => true,
             ]
        );

        $this->add_control(
         'nilos_contact_info_desc',
            [
                'label'       => esc_html__( 'Description', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 10,
                'default'     => esc_html__( 'Do you have a query about your order, or need a hand with getting your products set up?', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
            ]
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
         'nilos_contact_box_sec',
             [
               'label' => esc_html__( 'Info Box', 'nilos-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'nilos_design_style' => 'layout-3'
               ]
             ]
        );
        
        $this->add_control(
            'nilos_contact_box_title',
             [
                'label'       => esc_html__( 'Title', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Reach Out', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
                'label_block' => true,
             ]
        );
        
        $this->add_control(
            'nilos_contact_box_desc',
               [
                   'label'       => esc_html__( 'Description', 'nilos-core' ),
                   'type'        => \Elementor\Controls_Manager::TEXTAREA,
                   'rows'        => 10,
                   'default'     => esc_html__( 'Any confusion about your order? We are here to help 24/7', 'nilos-core' ),
                   'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
               ]
        );

        $this->add_control(
         'nilos_contact_info_note',
         [
           'label'       => esc_html__( 'Additional Info', 'nilos-core' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'See our Refund Policies or FAQ', 'nilos-core' ),
           'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
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
                    ]
                ]
            );
        }
        
        $repeater->add_control(
         'nilos_contact_box_title',
           [
             'label'   => esc_html__( 'Conact Title', 'nilos-core' ),
             'type'        => \Elementor\Controls_Manager::TEXT,
             'default'     => esc_html__( 'Contact Us', 'nilos-core' ),
             'label_block' => true,
           ]
         );

         $repeater->add_control(
            'nilos_contact_type',
            [
              'label'   => esc_html__( 'Select Type', 'nilos-core' ),
              'type' => \Elementor\Controls_Manager::SELECT,
              'options' => [
                'default'  => esc_html__( 'Default', 'nilos-core' ),
                'email'  => esc_html__( 'Email', 'nilos-core' ),
                'phone'  => esc_html__( 'Phone', 'nilos-core' ),
                'map'  => esc_html__( 'Map', 'nilos-core' ),
              ],
              'default' => 'default',
            ]
           );

         $repeater->add_control(
          'nilos_contact_box_title_url',
          [
            'label'   => esc_html__( 'URL', 'nilos-core' ),
            'type'        => \Elementor\Controls_Manager::URL,
            'default'     => [
                'url'               => '#',
                'is_external'       => true,
                'nofollow'          => true,
                'custom_attributes' => '',
              ],
              'placeholder' => esc_html__( 'Your URL', 'nilos-core' ),
              'label_block' => true,
            ]
          );

         $repeater->add_control(
          'enable_underline_style',
          [
            'label'        => esc_html__( 'Enable Underline Style', 'nilos-core' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'nilos-core' ),
            'label_off'    => esc_html__( 'Hide', 'nilos-core' ),
            'return_value' => 'yes',
            'default'      => 'no',
          ]
         );

        
   
           $repeater->add_control(
            'nilos_contact_map_url',
            [
              'label'   => esc_html__( 'Map URL', 'nilos-core' ),
              'type'        => \Elementor\Controls_Manager::URL,
              'default'     => [
                  'url'               => '#',
                  'is_external'       => true,
                  'nofollow'          => true,
                  'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Your URL', 'nilos-core' ),
                'label_block' => true,
                'condition' => [
                   'nilos_contact_type' => 'map'
                ]
              ]
        );
         
         $this->add_control(
            'nilos_contact_box_list',
            [
              'label'       => esc_html__( 'Info List', 'nilos-core' ),
              'type'        => \Elementor\Controls_Manager::REPEATER,
              'fields'      => $repeater->get_controls(),
              'default'     => [
                [
                  'nilos_contact_box_title'   => esc_html__( 'Start Chat', 'nilos-core' ),
                ],
              ],
              'title_field' => '{{{ nilos_contact_box_title }}}',
            ]
          );
        
        $this->end_controls_section();

        
        $this->nilos_section_style_controls('comint_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('about_subtitle', 'Section - Subtitle', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('about_title', 'Section - Title', '.nilos-el-title');
        $this->nilos_basic_style_controls('about_description', 'Section - Description', '.nilos-el-content p');

		$this->nilos_basic_style_controls('section_subtitle', 'Contact - Title', '.nilos-el-contact-title');
		$this->nilos_basic_style_controls('section_contact_desc', 'Contact - Description', '.nilos-el-contact-desc');

		$this->nilos_icon_style('section_icon', 'Box - Icon', '.nilos-el-box-icon');
		$this->nilos_basic_style_controls('section_title', 'Box - Title', '.nilos-el-box-title');
		$this->nilos_basic_style_controls('section_desc', 'Box - Description', '.nilos-el-box-desc');
		$this->nilos_basic_style_controls('section_info', 'Box - Info', '.nilos-el-box-info p');
		$this->nilos_basic_style_controls('section_note', 'Box - Note', '.nilos-el-box-note p');

        $this->nilos_input_controls_style('contact_input', 'Box - Input', '.nilos-el-contact-input input','.nilos-el-contact-input textarea');
        $this->nilos_link_controls_style('contact_btn', 'Box - Button', '.nilos-el-contact-input-btn button');
        $this->nilos_link_controls_style('contact_btn_btn', 'Box - Button', '.nilos-el-box-btn');
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

		<?php if ( $settings['nilos_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'job__form-title nilos-el-title');
		?>
		
         <!-- job details area start -->
         <section class="job__details-area nilos-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="job__details-wrapper">
                     <?php if (!empty($settings['nilos_btn_text'])) : ?>
                        <div class="job__details-btn">
                           <button type="button" class="nilos-btn job-form-open-btn nilos-el-box-btn"><?php echo $settings['nilos_btn_text']; ?></button>
                        </div>
                        <?php endif; ?>
                        <div class="job__form job-apply-form mt-40 nilos-el-content nilos-el-contact-input nilos-el-contact-input-btn">
                        <?php if ( !empty($settings['nilos_section_title_show']) ) : ?>

                            <?php if ( !empty($settings['nilos_sub_title']) ) : ?>
                            <span class="faq__title-pre nilos-el-subtitle">
                                <?php echo nilos_kses( $settings['nilos_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['nilos_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['nilos_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        nilos_kses( $settings['nilos_title' ] )
                                        );
                                endif;
                            ?>
                            <?php if ( !empty($settings['nilos_description']) ) : ?>
                                <p><?php echo nilos_kses( $settings['nilos_description'] ); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- form here -->
                        <?php if( !empty($settings['nilos_select_contact_form']) ) : ?>
							<?php echo do_shortcode( '[contact-form-7  id="'.$settings['nilos_select_contact_form'].'"]' ); ?>

						<?php else : ?>
							<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'nilos-core' ). '</p></div>'; ?>
						<?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- job details area emd -->


        <?php elseif( $settings['nilos_design_style']  == 'layout-3' ):
            $this->add_render_attribute('title_args', 'class', 'nilos-section-title-2 nilos-el-title');
		?>

         <!-- contact area start -->
         <section class="contact__area grey-bg-4 pb-120 pt-110 nilos-el-section">
            <div class="container">
            <?php if ( !empty($settings['nilos_section_title_show']) ) : ?>
               <div class="row justify-content-center">
                  <div class="col-xl-7 col-lg-8">
                     <div class="nilos-section-wrapper-2 text-center mb-70 nilos-el-subtitle">
                        <?php if ( !empty($settings['nilos_sub_title']) ) : ?>
                            <span class="faq__title-pre nilos-el-subtitle">
                                <?php echo nilos_kses( $settings['nilos_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                           <?php
                                if ( !empty($settings['nilos_title' ]) ) :
                                    printf( '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape( $settings['nilos_title_tag'] ),
                                        $this->get_render_attribute_string( 'title_args' ),
                                        nilos_kses( $settings['nilos_title' ] )
                                        );
                                endif;
                            ?>
                            <?php if ( !empty($settings['nilos_description']) ) : ?>
                                <p><?php echo nilos_kses( $settings['nilos_description'] ); ?></p>
                            <?php endif; ?>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-xl-4 col-lg-4">
                     <div class="contact__wrapper-2">
                        <div class="contact__content-2">
                           <?php if ( !empty($settings['nilos_contact_info_title']) ) : ?>
                           <h3 class="contact-title nilos-el-contact-title"><?php echo nilos_kses( $settings['nilos_contact_info_title'] ); ?></h3>
                           <?php endif; ?>

                           <?php if ( !empty($settings['nilos_contact_info_desc']) ) : ?>
                                <p class="nilos-el-contact-desc"><?php echo nilos_kses( $settings['nilos_contact_info_desc'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="contact__info-box">

                            <?php if ( !empty($settings['nilos_contact_box_title']) ) : ?>
                           <h3 class="contact__info-box-title nilos-el-box-title"><?php echo nilos_kses( $settings['nilos_contact_box_title'] ); ?></h3>
                           <?php endif; ?>

                            <?php if ( !empty($settings['nilos_contact_box_desc']) ) : ?>
                                <p class="nilos-el-box-desc"><?php echo nilos_kses( $settings['nilos_contact_box_desc'] ); ?></p>
                            <?php endif; ?>

                           <div class="contact__info-item-wrapper d-flex flex-wrap align-items-center">
                            
                           <?php  foreach ($settings['nilos_contact_box_list'] as $key => $item) :
                            
                                $enable_underline_style = ($item['enable_underline_style'] == 'yes') ? 'has-fw-400' : '';
                            ?>

                              <div class="contact__info-item">
                                 <div class="contact__info-icon nilos-el-box-icon">
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
                                 <div class="contact__info-content nilos-el-box-info <?php echo esc_attr($enable_underline_style); ?>">
                                 <?php if($item['nilos_contact_type'] == 'email') : ?>
                                    <p><a href="mailto:<?php echo esc_url($item['nilos_contact_box_title_url']['url']); ?>"><?php echo esc_html($item['nilos_contact_box_title']); ?></a></p>

                                    <?php elseif($item['nilos_contact_type'] == 'phone') : ?>
                                    <p><a href="tel:<?php echo esc_url($item['nilos_contact_box_title_url']['url']); ?>"><?php echo esc_html($item['nilos_contact_box_title']); ?></a></p>
                                    
                                    <?php elseif($item['nilos_contact_type'] == 'map') : ?>
                                    <p><a href="<?php echo esc_url($item['nilos_contact_map_url']['url']); ?>" target="_blank"><?php echo esc_html($item['nilos_contact_box_title']); ?></a></p>
                                    
                                    <?php else : ?>
                                    <p><a href="<?php echo esc_url($item['nilos_contact_box_title_url']['url']); ?>" target="_blank"><?php echo esc_html($item['nilos_contact_box_title']); ?></a></p>
                                    <?php endif; ?>
                                 </div>
                              </div>

                              <?php endforeach; ?>
                           </div>

                           <?php if(!empty($settings['nilos_contact_info_note'])) : ?>
                           <div class="contact__info-box-refund nilos-el-box-note">
                              <p><?php echo nilos_kses($settings['nilos_contact_info_note']); ?></p>
                           </div>
                           <?php endif; ?>
                        </div>

                     </div>
                  </div>
                  <div class="col-xl-8 col-lg-8">
                     <div class="contact__form-3 ml-70 nilos-el-contact-input nilos-el-contact-input-btn">
                        <?php if( !empty($settings['nilos_select_contact_form']) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['nilos_select_contact_form'].'"]' ); ?>
						<?php else : ?>
							<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'nilos-core' ). '</p></div>'; ?>
						<?php endif; ?>              
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- contact area end -->

		<?php else :
			$this->add_render_attribute('title_args', 'class', 'portfolio__comment-title nilos-el-title');
		?>
			

         <!-- portfolio comment area start -->
         <section class="portfolio__comment grey-bg-7 pt-90 pb-105 nilos-el-section">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__comment-top nilos-el-content">
                        <?php if ( !empty($settings['nilos_sub_title']) ) : ?>
							<span class="nilos-sub-title mb-15 nilos-el-subtitle"><?php echo nilos_kses( $settings['nilos_sub_title'] ); ?></span>
						<?php endif; ?>
                        <?php
							if ( !empty($settings['nilos_title' ]) ) :
								printf( '<%1$s %2$s>%3$s</%1$s>',
									tag_escape( $settings['nilos_title_tag'] ),
									$this->get_render_attribute_string( 'title_args' ),
									nilos_kses( $settings['nilos_title' ] )
									);
							endif;
						?>
                        <?php if ( !empty($settings['nilos_description']) ) : ?>
							<p><?php echo nilos_kses( $settings['nilos_description'] ); ?></p>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__comment-form nilos-el-contact-input nilos-el-contact-input-btn">
                     <?php if( !empty($settings['nilos_select_contact_form']) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['nilos_select_contact_form'].'"]' ); ?>
						<?php else : ?>
							<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'nilos-core' ). '</p></div>'; ?>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- portfolio comment area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new NILOS_Contact_Common() );
