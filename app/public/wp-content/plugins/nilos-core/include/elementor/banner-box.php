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
class NILOS_Banner_Box extends Widget_Base {

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
        return 'nilos-banner-box';
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
        return __( 'Banner Box', 'nilos-core' );
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
                    'layout-2' => esc_html__('Layout 2', 'nilos-core'),
                    'layout-3' => esc_html__('Layout 3', 'nilos-core'),
                    'layout-4' => esc_html__('Layout 4', 'nilos-core'),
                    'layout-5' => esc_html__('Layout 5', 'nilos-core'),
                    'layout-6' => esc_html__('Layout 6', 'nilos-core'),
                    'layout-7' => esc_html__('Layout 7', 'nilos-core'),
                    'layout-8' => esc_html__('Layout 8', 'nilos-core'),
                    'layout-9' => esc_html__('Layout 9', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'nilos_banner_sec',
             [
               'label' => esc_html__( 'Title & Content', 'nilos-core' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
        );

        $this->add_control(
            'nilos_image_subtitle',
            [
                'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'nilos_design_style' => 'layout-9'
                ]
            ]
        );        

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'nilos_image_subtitle_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
         'is_brown_style',
         [
           'label'        => esc_html__( 'Enable Brown Style?', 'nilos-core' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'nilos-core' ),
           'label_off'    => esc_html__( 'Hide', 'nilos-core' ),
           'return_value' => 'yes',
           'default'      => 'no',
           'condition' => [
            'nilos_design_style' => 'layout-7'
            ]
         ]
        );
        
        $this->add_control(
        'nilos_banner_subtitle',
            [
                'label'       => esc_html__( 'Banner Subtitle', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Women', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
        'nilos_banner_title',
         [
            'label'       => esc_html__( 'Banner Title', 'nilos-core' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'NILOSp Blouse Shirts', 'nilos-core' ),
            'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
         'nilos_banner_url',
         [
           'label'   => esc_html__( 'Banner Title URL', 'nilos-core' ),
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

         $this->add_control(
          'nilos_enable_square_style',
          [
            'label'        => esc_html__( 'Enable Square Style?', 'nilos-core' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'nilos-core' ),
            'label_off'    => esc_html__( 'Hide', 'nilos-core' ),
            'return_value' => 'yes',
            'default'      => 'no',
            'condition' => [
                'nilos_design_style' => ['layout-1', 'layout-2']
            ]
          ]
         );

        
        $this->end_controls_section();

        // _nilos_image
		$this->start_controls_section(
            '_nilos_image',
            [
                'label' => esc_html__('Thumbnail', 'nilos-core'),
            ]
        );
        $this->add_control(
            'nilos_image',
            [
                'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );        

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'nilos_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        $this->nilos_button_render_controls('nilosbtn', 'Button', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8', 'layout-9']);
    }

    protected function style_tab_content(){
        $this->nilos_section_style_controls('about_section', 'Section - Style', '.nilos-el-section');
        $this->nilos_basic_style_controls('about_subtitle', 'Section - Subtitle', '.nilos-el-subtitle');
        $this->nilos_basic_style_controls('about_title', 'Section - Title', '.nilos-el-title');
        $this->nilos_basic_style_controls('about_description', 'Section - Description', '.nilos-el-content p');
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
        $control_id = 'nilosbtn';
        ?>

        <?php if ( $settings['nilos_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'research__title');
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->nilos_link_controls_render('nilosbtn', 'nilos-link-btn', $this->get_settings());

            $enable_square_style = $settings['nilos_enable_square_style'] == 'yes' ? 'has-square' : '';
        ?>

        <div class="nilos-banner-item nilos-banner-item-sm grey-bg <?php echo esc_attr($enable_square_style);?> nilos-banner-height p-relative mb-30 z-index-1 fix">
            <div class="nilos-banner-thumb include-bg transition-3" data-background="<?php echo esc_url($nilos_image); ?>"></div>
            <div class="nilos-banner-content">

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                <h3 class="nilos-banner-title">
                    <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                    <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                    <?php else: ?>
                        <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                    <?php endif; ?>
                </h3>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <p><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></p>
                <?php endif; ?>
                

                <!-- button start -->
                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-banner-btn">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>><?php echo $settings['nilos_' . $control_id .'_text']; ?>
                        <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                            <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
                <!-- button end --> 

            </div>
        </div>

        <?php elseif( $settings['nilos_design_style']  == 'layout-3' ): 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->nilos_link_controls_render('nilosbtn', 'nilos-btn nilos-btn-border nilos-btn-border-white nilos-btn-border-white-sm', $this->get_settings());
            
        ?>

            <div class="nilos-trending-banner p-relative">
                <div class="nilos-trending-banner-thumb w-img include-bg" data-background="<?php echo esc_url($nilos_image); ?>"></div>
                <div class="nilos-trending-banner-content">
                    <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                    <span class="nilos-trending-banner-subtitle"><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                    <?php endif; ?>

                    <?php if(!empty($settings['nilos_banner_title'])) : ?>
                    <h3 class="nilos-trending-banner-title">
                        <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                    <?php endif; ?>

                    <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                    <div class="nilos-trending-banner-btn">
                        <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>>
                            <?php echo $settings['nilos_' . $control_id .'_text']; ?>
                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                <path d="M16 7.5L1 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif( $settings['nilos_design_style']  == 'layout-4' ): 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->nilos_link_controls_render('nilosbtn', 'nilos-btn', $this->get_settings());
            
        ?>

        <div class="nilos-collection-item nilos-collection-height grey-bg p-relative z-index-1 fix">
            <div class="nilos-collection-thumb include-bg include-bg transition-3" data-background="<?php echo esc_url($nilos_image); ?>"></div>
            <div class="nilos-collection-content">

                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <span><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                    <h3 class="nilos-collection-title">
                        <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-collection-btn">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>>
                    <?php echo $settings['nilos_' . $control_id .'_text']; ?>
                        <svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                            <path d="M10.9994 4.99981L1.04004 4.99981" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.98291 1L10.9998 4.99967L6.98291 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['nilos_design_style']  == 'layout-5' ): 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->nilos_link_controls_render('nilosbtn', 'nilos-link-btn-line', $this->get_settings());
            
        ?>

        <div class="nilos-collection-item nilos-collection-height grey-bg p-relative z-index-1 fix">
            <div class="nilos-collection-thumb has-overlay include-bg transition-3" data-background="<?php echo esc_url($nilos_image); ?>"></div>
            <div class="nilos-collection-content-1">

                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <span><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                    <h3 class="nilos-collection-title-1">
                        <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-collection-btn-1">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>><?php echo $settings['nilos_' . $control_id .'_text']; ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['nilos_design_style']  == 'layout-6' ): 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->nilos_link_controls_render('nilosbtn', 'nilos-btn nilos-btn-border', $this->get_settings());
            
        ?>

        <div class="nilos-banner-item-4 nilos-banner-height-4 fix p-relative z-index-1" data-bg-color="#F3F7FF">
            <div class="nilos-banner-thumb-4 include-bg black-bg transition-3" data-background="<?php echo esc_url($nilos_image); ?>"></div>
            <div class="nilos-banner-content-4">

                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <span><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                    <h3 class="nilos-banner-title-4">
                        <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-banner-btn-4">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>>
                        <?php echo $settings['nilos_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                            <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['nilos_design_style']  == 'layout-7' ): 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->nilos_link_controls_render('nilosbtn', 'nilos-btn nilos-btn-border', $this->get_settings());
            
            $color_style = $settings['is_brown_style'] == 'yes' ? 'has-brown' : 'has-green';
        ?>

        <div class="nilos-banner-item-4 nilos-banner-height-4 fix p-relative z-index-1 <?php echo esc_attr($color_style); ?> sm-banner" data-bg-color="#F0F6EF">
            <div class="nilos-banner-thumb-4 include-bg black-bg transition-3" data-background="<?php echo esc_url($nilos_image); ?>"></div>
            <div class="nilos-banner-content-4">

                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <span><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                    <h3 class="nilos-banner-title-4">
                        <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-banner-btn-4">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>>
                        <?php echo $settings['nilos_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                            <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['nilos_design_style']  == 'layout-8' ): 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->nilos_link_controls_render('nilosbtn', 'nilos-btn nilos-btn-border', $this->get_settings());
        ?>
        <div class="nilos-banner-full nilos-banner-full-height fix p-relative z-index-1">
            <div class="nilos-banner-full-thumb include-bg black-bg transition-3" data-background="<?php echo esc_url($nilos_image); ?>"></div>
            <div class="nilos-banner-full-content">
                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <span><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                    <h3 class="nilos-banner-full-title">
                        <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>

                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-banner-full-btn">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>>
                        <?php echo $settings['nilos_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                            <path d="M16 7.49988L1 7.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47554L16.0002 7.49954L9.9502 13.5245" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif( $settings['nilos_design_style']  == 'layout-9' ): 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
            if ( !empty($settings['nilos_image_subtitle']['url']) ) {
                $nilos_image_subtitle = !empty($settings['nilos_image_subtitle']['id']) ? wp_get_attachment_image_url( $settings['nilos_image_subtitle']['id'], $settings['nilos_image_subtitle_size_size']) : $settings['nilos_image_subtitle']['url'];
                $nilos_image_subtitle_alt = get_post_meta($settings["nilos_image_subtitle"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->nilos_link_controls_render('nilosbtn', 'nilos-btn-green nilos-btn-green-sm', $this->get_settings());
        ?>

        <div class="nilos-product-side-banner text-center mb-60 light-green-bg">
            <div class="nilos-product-side-banner-content">


                <?php if(!empty($nilos_image_subtitle)) : ?>
                <div class="nilos-product-side-banner-subtitle">
                    <img src="<?php echo esc_url($nilos_image_subtitle) ?>" alt="<?php echo esc_attr($nilos_image_subtitle_alt); ?>">
                </div>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <span><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                    <h3 class="nilos-product-side-banner-title">
                        <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                        <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                        <?php else: ?>
                            <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                        <?php endif; ?>
                    </h3>
                <?php endif; ?>


                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-product-side-banner-btn">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?>>
                        <?php echo $settings['nilos_' . $control_id .'_text']; ?>
                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                            <path d="M16 7.49976L1 7.49976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>

                <?php if(!empty($nilos_image)) : ?>
                <div class="nilos-product-side-banner-thumb">
                    <img src="<?php echo esc_url($nilos_image) ?>" alt="<?php echo esc_attr($nilos_image_alt); ?>">
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php else:
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->nilos_link_controls_render('nilosbtn', 'nilos-link-btn', $this->get_settings());

            $enable_square_style = $settings['nilos_enable_square_style'] == 'yes' ? 'has-square' : '';
        ?>


        <div class="nilos-banner-item grey-bg <?php echo esc_attr($enable_square_style); ?> nilos-banner-height p-relative mb-30 z-index-1 fix">
            <div class="nilos-banner-thumb include-bg transition-3" data-background="<?php echo esc_url($nilos_image); ?>"></div>
            <div class="nilos-banner-content">
                <?php if(!empty($settings['nilos_banner_subtitle'])) : ?>
                <span><?php echo nilos_kses($settings['nilos_banner_subtitle']); ?></span>
                <?php endif; ?>

                <?php if(!empty($settings['nilos_banner_title'])) : ?>
                <h3 class="nilos-banner-title">
                    <?php if(!empty($settings['nilos_banner_url']['url'])): ?>
                    <a href="<?php echo esc_url($settings['nilos_banner_url']['url']) ?>"><?php echo nilos_kses($settings['nilos_banner_title']); ?></a>

                    <?php else: ?>
                        <?php echo nilos_kses($settings['nilos_banner_title']); ?>
                    <?php endif; ?>
                </h3>
                <?php endif; ?>

                <!-- button start -->
                <?php if ($settings['nilos_' . $control_id .'_button_show'] == 'yes') : ?>
                <div class="nilos-banner-btn">
                    <a <?php echo $this->get_render_attribute_string( 'nilos-button-arg' ); ?> class=""><?php echo $settings['nilos_' . $control_id .'_text']; ?>
                        <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                            <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>
                <!-- button end -->                    
            </div>
        </div>
        <?php endif; ?>

        <?php
    }
}

$widgets_manager->register( new NILOS_Banner_Box() );
