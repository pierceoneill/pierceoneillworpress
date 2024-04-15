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
class NILOS_Footer_Subscribe extends Widget_Base {

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
		return 'nilos-footer-subscribe';
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
		return __( 'Footer Subscribe', 'nilos-core' );
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


    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'nilos-core'),
            'behance' => esc_html__('Behance', 'nilos-core'),
            'bitbucket' => esc_html__('BitBucket', 'nilos-core'),
            'codepen' => esc_html__('CodePen', 'nilos-core'),
            'delicious' => esc_html__('Delicious', 'nilos-core'),
            'deviantart' => esc_html__('DeviantArt', 'nilos-core'),
            'digg' => esc_html__('Digg', 'nilos-core'),
            'dribbble' => esc_html__('Dribbble', 'nilos-core'),
            'email' => esc_html__('Email', 'nilos-core'),
            'facebook' => esc_html__('Facebook', 'nilos-core'),
            'flickr' => esc_html__('Flicker', 'nilos-core'),
            'foursquare' => esc_html__('FourSquare', 'nilos-core'),
            'github' => esc_html__('Github', 'nilos-core'),
            'houzz' => esc_html__('Houzz', 'nilos-core'),
            'instagram' => esc_html__('Instagram', 'nilos-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'nilos-core'),
            'linkedin' => esc_html__('LinkedIn', 'nilos-core'),
            'medium' => esc_html__('Medium', 'nilos-core'),
            'pinterest' => esc_html__('Pinterest', 'nilos-core'),
            'product-hunt' => esc_html__('Product Hunt', 'nilos-core'),
            'reddit' => esc_html__('Reddit', 'nilos-core'),
            'slideshare' => esc_html__('Slide Share', 'nilos-core'),
            'snapchat' => esc_html__('Snapchat', 'nilos-core'),
            'soundcloud' => esc_html__('SoundCloud', 'nilos-core'),
            'spotify' => esc_html__('Spotify', 'nilos-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'nilos-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'nilos-core'),
            'tumblr' => esc_html__('Tumblr', 'nilos-core'),
            'twitch' => esc_html__('Twitch', 'nilos-core'),
            'twitter' => esc_html__('Twitter', 'nilos-core'),
            'vimeo' => esc_html__('Vimeo', 'nilos-core'),
            'vk' => esc_html__('VK', 'nilos-core'),
            'website' => esc_html__('Website', 'nilos-core'),
            'whatsapp' => esc_html__('WhatsApp', 'nilos-core'),
            'wordpress' => esc_html__('WordPress', 'nilos-core'),
            'xing' => esc_html__('Xing', 'nilos-core'),
            'yelp' => esc_html__('Yelp', 'nilos-core'),
            'youtube' => esc_html__('YouTube', 'nilos-core'),
        ];
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

     protected function register_controls(){
		$this->register_controls_section();
		$this->style_tab_content();
	}	

	protected function register_controls_section() {

        $this->start_controls_section(
            'nilos_contact',
            [
                'label' => esc_html__('Contact Form', 'nilos-core'),
            ]
        );

        $this->add_control(
        'nilos_contact_desc_text',
         [
            'label'       => esc_html__( 'Description Text', 'nilos-core' ),
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'default'     => esc_html__( 'Our conversation is just getting started', 'nilos-core' ),
            'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
            'label_block' => true,
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

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->nilos_basic_style_controls('about_title', 'Section - Title', '.nilos-el-title');
        $this->nilos_input_controls_style('coming_input', 'Form - Input', '.nilos-el-box-input input', '.nilos-el-box-input textarea');
        $this->nilos_link_controls_style('coming_input_btn', 'Form - Button', '.nilos-el-box-input button');
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

         <div class="nilos-footer-subscribe">
            <?php if(!empty($settings['nilos_contact_desc_text'])) :?>
            <p class="nilos-contact-title nilos-el-title"><?php echo nilos_kses($settings['nilos_contact_desc_text']); ?></p>
            <?php endif; ?>
            <div class="nilos-footer-subscribe-form mb-30 nilos-el-box-input">
                <?php if( !empty($settings['nilos_select_contact_form']) ) : ?>
                    <?php echo do_shortcode( '[contact-form-7  id="'.$settings['nilos_select_contact_form'].'"]' ); ?>
                <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'nilos-core' ). '</p></div>'; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php
	}
}

$widgets_manager->register( new NILOS_Footer_Subscribe() );
