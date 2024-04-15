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
class NILOS_Features extends Widget_Base {

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
		return 'features';
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
		return __( 'Features', 'nilos-core' );
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
                    'layout-2' => esc_html__('Layout 2', 'nilos-core'),
                    'layout-3' => esc_html__('Layout 3', 'nilos-core'),
                    'layout-4' => esc_html__('Layout 4', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'nilos_features',
            [
                'label' => esc_html__('Features List', 'nilos-core'),
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                    'repeater_condition' => ['style_1', 'style_2'],
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
                        'repeater_condition' => ['style_1', 'style_2'],
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
                        'repeater_condition' => ['style_1', 'style_2'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'nilos_features_title', [
                'label' => esc_html__('Title', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'nilos-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'nilos_features_description',
            [
                'label' => esc_html__('Description', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );        
        
        $this->add_control(
            'nilos_features_list',
            [
                'label' => esc_html__('Features - List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'nilos_features_title' => esc_html__('Business Stratagy', 'nilos-core'),
                    ],
                    [
                        'nilos_features_title' => esc_html__('Website Development', 'nilos-core')
                    ],
                    [
                        'nilos_features_title' => esc_html__('Marketing & Reporting', 'nilos-core')
                    ]
                ],
                'title_field' => '{{{ nilos_features_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'nilos-post-thumb',
            ]
        );
        $this->end_controls_section();

        // colum controls
        $this->nilos_columns('col');
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->nilos_section_style_controls('services_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('services_subtitle', 'Section - Subtitle', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('services_title', 'Section - Title', '.nilos-el-title');
        $this->nilos_basic_style_controls('services_description', 'Section - Description', '.nilos-el-content p');

        $this->nilos_section_style_controls('services_box', 'Features - Box', '.nilos-el-box');
        $this->nilos_basic_style_controls('services_box_title', 'Features - Box - Title', '.nilos-el-box-title');
        $this->nilos_basic_style_controls('services_box_description', 'Features - Box - Description', '.nilos-el-box-desc');
        $this->nilos_link_controls_style('services_box_link_btn', 'Features - Box - Button', '.nilos-el-box-btn');

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

		<?php if ( $settings['nilos_design_style']  == 'layout-2' ) : 
            $this->add_render_attribute('title_args', 'class', 'section__title-6 nilos-el-title');    
        ?>

         <!-- feature area start -->
         <section class="nilos-feature-area nilos-feature-border-2 pb-80">
            <div class="container">
               <div class="nilos-feature-inner-2">
                  <div class="row align-items-center">
                  <?php foreach ($settings['nilos_features_list'] as $key => $item) : ?>
                     <div class="col-xl-<?php echo esc_attr($settings['nilos_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['nilos_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['nilos_col_for_tablet']); ?> col-<?php echo esc_attr($settings['nilos_col_for_mobile']); ?>">
                        <div class="nilos-feature-item-2 d-flex align-items-start">
                           <div class="nilos-feature-icon-2 mr-10">
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
                           <div class="nilos-feature-content-2">

                              <?php if (!empty($item['nilos_features_title' ])): ?>
                                <h3 class="nilos-feature-title-2 nilos-el-box-title"><?php echo nilos_kses($item['nilos_features_title' ]); ?> </h3>
                                <?php endif; ?>

                                <?php if (!empty($item['nilos_features_description' ])): ?>
                                <p class="nilos-el-box-desc"><?php echo nilos_kses($item['nilos_features_description']); ?></p>
                                <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- feature area end -->

        <?php elseif ( $settings['nilos_design_style']  == 'layout-3' ) : 
            $this->add_render_attribute('title_args', 'class', 'section__title-6 nilos-el-title');    
        ?>

        <!-- feature area start -->
        <section class="nilos-feature-area nilos-feature-border-3 nilos-feature-style-2 pb-40 pt-45">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="nilos-feature-inner-2 d-flex flex-wrap align-items-center justify-content-between">
                     <?php foreach ($settings['nilos_features_list'] as $key => $item) : ?>
                        <div class="nilos-feature-item-2 d-flex align-items-start mb-40">
                           <div class="nilos-feature-icon-2 mr-10">
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
                           <div class="nilos-feature-content-2">
                              <?php if (!empty($item['nilos_features_title' ])): ?>
                                <h3 class="nilos-feature-title-2 nilos-el-box-title"><?php echo nilos_kses($item['nilos_features_title' ]); ?> </h3>
                                <?php endif; ?>

                                <?php if (!empty($item['nilos_features_description' ])): ?>
                                <p class="nilos-el-box-desc"><?php echo nilos_kses($item['nilos_features_description']); ?></p>
                                <?php endif; ?>
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- feature area end -->

        <?php elseif ( $settings['nilos_design_style']  == 'layout-4' ) : 
            $this->add_render_attribute('title_args', 'class', 'section__title-6 nilos-el-title');    
        ?>
        <!-- features area start -->
        <section class="nilos-feature-area nilos-feature-border-5 pb-55">
            <div class="container">
               <div class="nilos-feature-inner-5">
                  <div class="row">
                  <?php foreach ($settings['nilos_features_list'] as $key => $item) : ?>
                     <div class="col-xl-<?php echo esc_attr($settings['nilos_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['nilos_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['nilos_col_for_tablet']); ?> col-<?php echo esc_attr($settings['nilos_col_for_mobile']); ?>">
                        <div class="nilos-feature-item-5 d-flex align-items-center">
                           <div class="nilos-feature-icon-5">
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
                           <div class="nilos-feature-content-5">
                                <?php if (!empty($item['nilos_features_title' ])): ?>
                                <h3 class="nilos-feature-title-5 nilos-el-box-title"><?php echo nilos_kses($item['nilos_features_title' ]); ?> </h3>
                                <?php endif; ?>

                                <?php if (!empty($item['nilos_features_description' ])): ?>
                                <p class="nilos-el-box-desc"><?php echo nilos_kses($item['nilos_features_description']); ?></p>
                                <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </section>
         <!-- features area end -->

		<?php else: 
            $bloginfo = get_bloginfo( 'name' );   
        ?>
         <!-- feature area start -->
         <section class="nilos-feature-area nilos-feature-border-radius pb-70">
            <div class="container">
               <div class="row gx-1 gy-1 gy-xl-0">
                <?php foreach ($settings['nilos_features_list'] as $key => $item) : ?>
                  <div class="col-xl-<?php echo esc_attr($settings['nilos_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['nilos_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['nilos_col_for_tablet']); ?> col-<?php echo esc_attr($settings['nilos_col_for_mobile']); ?>">
                     <div class="nilos-feature-item d-flex align-items-start">
                        <div class="nilos-feature-icon mr-15">
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
                        <div class="nilos-feature-content">
                           <?php if (!empty($item['nilos_features_title' ])): ?>
                            <h3 class="nilos-feature-title nilos-el-box-title"><?php echo nilos_kses($item['nilos_features_title' ]); ?> </h3>
                            <?php endif; ?>

                            <?php if (!empty($item['nilos_features_description' ])): ?>
                            <p class="nilos-el-box-desc"><?php echo nilos_kses($item['nilos_features_description']); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <!-- feature area end -->

        <?php endif; ?>

        <?php
	}
}

$widgets_manager->register( new NILOS_Features() );
