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
class NILOS_Footer_Social extends Widget_Base {

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
        return 'nilos-social';
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
        return __( 'Nilos Social', 'nilos-core' );
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

    protected static function get_profile_names()
    {
        return [
            '500px' => esc_html__('500px', 'nilos-core'),
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



    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }  



    protected function register_controls_section() {

        $this->start_controls_section(
            '_social_contents',
            [
                'label' => esc_html__('Social Contents', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wrapper_class',
            [
                'label' => esc_html__('A wrapper class', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholer'    => 'A wrapper class'
            ]
        );

        $this->add_responsive_control(
            'content_align',
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
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'nilos-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link', [
                'label' => esc_html__('Profile Link', 'nilos-core'),
                'placeholder' => esc_html__('Add your profile link', 'nilos-core'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'htniloss://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'htniloss://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'htniloss://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'nilos-core'),
                'label_off' => esc_html__('Hide', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'nilos_profile_title',
            [
                'label' => esc_html__('Profile Title', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('NILOS Profile Title', 'nilos-core'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'nilos-core'),
                'label_block' => true,
                'condition' => [
                    'nilos_design_style' => 'layout-2'
                ],
            ]
        );
        

        $this->end_controls_section();
    }

    protected function style_tab_content() {
        $this->nilos_link_controls_style('slider_social_link', 'Social - Link', '.nilos-el-social-link');
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
        
        <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
        <ul class="list-unstyled <?php echo esc_attr($settings['wrapper_class']); ?>">
        <?php
            foreach ($settings['profiles'] as $profile) :
                $icon = $profile['name'];
                $url = esc_url($profile['link']['url']);
                
                printf('<li><a target="_blank" rel="noopener"  href="%s" class="nilos-el-social-link elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a></li>',
                    $url,
                    esc_attr($profile['_id']),
                    esc_attr($icon)
                );
            endforeach; 
        ?>
        </ul>
        <?php endif; ?> 

        <?php
    }
}

$widgets_manager->register( new NILOS_Footer_Social() );