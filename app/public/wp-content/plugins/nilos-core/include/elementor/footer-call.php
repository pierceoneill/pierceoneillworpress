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
class NILOS_Footer_Call extends Widget_Base {

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
        return 'nilos-footer-call';
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
        return __( 'Footer Call', 'nilos-core' );
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

        $this->start_controls_section(
            'nilos_footer_call_sec',
                [
                  'label' => esc_html__( 'Footer Call', 'nilos-core' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
           );

           $this->add_control(
           'nilos_footer_call_subtitle',
            [
               'label'       => esc_html__( 'Title', 'nilos-core' ),
               'type'        => \Elementor\Controls_Manager::TEXT,
               'default'     => esc_html__( 'Got Questions? Call us', 'nilos-core' ),
               'placeholder' => esc_html__( 'Your Text', 'nilos-core' ),
               'label_block' => true
            ]
           );
           
           
           $repeater = new \Elementor\Repeater();

           
            $repeater->add_control(
            'nilos_footer_call_title',
              [
                'label'   => esc_html__( 'Contact Title', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Contact Title', 'nilos-core' ),
                'label_block' => true,
              ]
            );
   
            $repeater->add_control(
               'nilos_footer_call_type',
               [
                 'label'   => esc_html__( 'Select Type', 'nilos-core' ),
                 'type' => \Elementor\Controls_Manager::SELECT,
                 'options' => [
                   'email'  => esc_html__( 'Email', 'nilos-core' ),
                   'phone'  => esc_html__( 'Phone', 'nilos-core' ),
                   'map'  => esc_html__( 'Map', 'nilos-core' ),
                   'default'  => esc_html__( 'Default', 'nilos-core' ),
                 ],
                 'default' => 'default',
               ]
              );
      
              $repeater->add_control(
               'nilos_footer_call_default_url',
               [
                 'label'   => esc_html__( 'Default URL', 'nilos-core' ),
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
                      'nilos_footer_call_type' => 'default'
                   ]
                 ]
               );
               
              $repeater->add_control(
               'nilos_footer_call_phone_url',
               [
                 'label'   => esc_html__( 'Phone URL', 'nilos-core' ),
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
                      'nilos_footer_call_type' => 'phone'
                   ]
                 ]
               );
              $repeater->add_control(
               'nilos_footer_call_mail_url',
               [
                 'label'   => esc_html__( 'Email URL', 'nilos-core' ),
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
                      'nilos_footer_call_type' => 'email'
                   ]
                 ]
               );
   
              $repeater->add_control(
               'nilos_footer_call_map_url',
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
                      'nilos_footer_call_type' => 'map'
                   ]
                 ]
               );
            
            $this->add_control(
              'nilos_footer_call_list',
              [
                'label'       => esc_html__( 'Call Repeater', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                  [
                    'nilos_footer_call_title'   => esc_html__( '012 458 246', 'nilos-core' ),
                  ],
                ],
                'title_field' => '{{{ nilos_footer_call_title }}}',
              ]
            );
           
           $this->end_controls_section();
   


    }


    protected function style_tab_content(){
        $this->nilos_basic_style_controls('footer_subtitle', 'Title', '.nilos-el-title');
        $this->nilos_link_controls_style('portfolio_description', 'Link - Style', '.nilos-el-box-btn');
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

        <div class="nilos-footer-talk">

            <?php if(!empty($settings['nilos_footer_call_subtitle'])) : ?>
            <span class="nilos-el-title"><?php echo esc_html($settings['nilos_footer_call_subtitle']); ?></span>
            <?php endif; ?>

            <?php foreach ($settings['nilos_footer_call_list'] as $item) : 
                
                $contact_type = $item['nilos_footer_call_type'];

                if($contact_type === 'mail'){
                    $contact_url = 'mailto:'.$item['nilos_footer_call_mail_url']['url'];
                }
                elseif ($contact_type === 'phone') {
                    $contact_url = 'tel:'.$item['nilos_footer_call_phone_url']['url'];
                }
                elseif ($contact_type === 'map') {
                    $contact_url = $item['nilos_footer_call_map_url']['url'];
                }
                elseif ($contact_type === 'default') {
                    $contact_url = $item['nilos_footer_call_default_url']['url'];
                }
                else{
                    $contact_url = "#";
                }

            ?>
            <h4><a href="<?php echo esc_url($contact_url ); ?>" class="nilos-el-box-btn"><?php echo esc_html($item['nilos_footer_call_title']); ?></a></h4>
            <?php endforeach; ?>
        </div>

        <?php
    }
}

$widgets_manager->register( new NILOS_Footer_Call() );
