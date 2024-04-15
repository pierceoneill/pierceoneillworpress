<?php
namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class NILOS_Video_Popup extends Widget_Base {

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
		return 'nilos-video-popup';
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
		return __( 'Nilos Video Popup', 'nilos-core' );
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
                    'layout-4' => esc_html__('Layout 4', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // nilos_video
        $this->start_controls_section(
            'nilos_video',
            [
                'label' => esc_html__('Video', 'nilos-core'),
            ]
        );

        $this->add_control(
            'nilos_video_url',
            [
                'label' => esc_html__('Video', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'https://www.youtube.com/watch?v=Get7rqXYrbQ',
                'title' => esc_html__('Video url', 'nilos-core'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Button 
        $this->nilos_button_render('video', 'Button');

        // _nilos_image
        $this->start_controls_section(
            '_nilos_image_section',
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
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?> 
         
         <!-- video area start -->
         <section class="video__area video__overlay box-plr-145 black-bg-13 nilos-el-section">
            <div class="container-fluid">
               <div class="video__inner-8 pt-185 pb-155 include-bg wow fadeInUp" data-background="<?php echo esc_url($nilos_image); ?>">
                  <div class="row justify-content-center">
                     <div class="col-xxl-7 col-xl-8 col-lg-10">
                        <div class="video__content-8 text-center">
                            <?php if ( !empty($settings['nilos_video_url']) ) : ?>
                            <div class="video__play-8 mb-20">
                                <a href="<?php echo esc_url($settings["nilos_video_url"]); ?>" class="popup-video video__play-btn video__play-btn-8 nilos-pulse-border nilos-el-box-btn">
                                    <span class="video-play-bg nilos-el-box-btn-bg"></span>
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/video/video-icon-play.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="section__title-wrapper-8 text-center">
                                <?php if(!empty($settings['nilos_video_title']))  :?>
                                <h3 class="section__title-8 nilos-el-title"><?php echo nilos_kses($settings['nilos_video_title']) ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- video area end -->

        <?php elseif ( $settings['nilos_design_style']  == 'layout-3' ) : 
            $bloginfo = get_bloginfo( 'name' );

            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
                $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
            }
		?> 

         <!-- video area start -->
         <section class="video__area p-relative z-index-1 video__bg video__pt-183 video__pb-223 nilos-el-section">
            <div class="video__bg-shape include-bg" data-background="<?php echo esc_url($nilos_image); ?>"></div>

            <?php if(!empty($settings['nilos_video_shape_switch'])) : ?>
            <div class="video__shape">
               <img class="video__shape-1" src="<?php echo get_template_directory_uri() . '/assets/img/video/video-dot-1.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
               <img class="video__shape-2" src="<?php echo get_template_directory_uri() . '/assets/img/video/video-dot-2.png' ?>" alt="<?php echo esc_attr($bloginfo); ?>">
            </div>
            <?php endif; ?>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-10">
                     <div class="video__content-2 text-center">
                     <?php if ( !empty($settings['nilos_video_url']) ) : ?>
                        <div class="video__play-2">
                           <a href="<?php echo esc_url($settings["nilos_video_url"]); ?>" class="popup-video video__play-btn video__play-btn-2 nilos-pulse-border nilos-el-box-btn">
                              <span class="video-play-bg nilos-el-box-btn-bg"></span>
                              <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="htnilos://www.w3.org/2000/svg">
                                 <path d="M17 10.2L0.200001 19.8995V0.500546L17 10.2Z" fill="currentColor"/>
                              </svg>                                                                
                           </a>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['nilos_video_subtitle'])):?>
                        <span class="nilos-el-subtitle"><?php echo nilos_kses($settings['nilos_video_subtitle']); ?></span>
                        <?php endif; ?>

                        <?php if(!empty($settings['nilos_video_title']))  :?>
                        <h3 class="video__title-2 nilos-el-title"><?php echo nilos_kses($settings['nilos_video_title']) ?></h3>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- video area end -->

		<?php elseif ( $settings['nilos_design_style']  == 'layout-4' ) : 
            if ( !empty($settings['nilos_image']['url']) ) {
                $nilos_image = $settings['nilos_image']['url'];
            }
		?>
        <div class="impression-one__left">
            <div class="impression-one__left-bg"
                style="background-image: url(<?php echo esc_url($nilos_image); ?>);"></div>
            <div class="impression-one__video-link">
                <a href="<?php echo esc_url($settings["nilos_video_url"]); ?>" class="video-popup">
                    <div class="impression-one__video-text">
                        <p><?php _e('Play', 'nilos-core'); ?></p>
                        <i class="ripple"></i>
                    </div>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <?php

	}

}

$widgets_manager->register( new NILOS_Video_Popup() );
