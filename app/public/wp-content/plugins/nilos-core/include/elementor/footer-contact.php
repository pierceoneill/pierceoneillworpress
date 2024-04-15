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
class NILOS_Footer_Contact extends Widget_Base {

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
        return 'nilos-footer-contact';
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
        return __( 'Footer Contact', 'nilos-core' );
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
            'nilos_footer_contact',
                [
                  'label' => esc_html__( 'Footer Contact Info', 'nilos-core' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
                     'repeater_condition' => ['style_1'],
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
                     'repeater_condition' => ['style_1'],
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
                     'repeater_condition' => ['style_1'],
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
                           'repeater_condition' => ['style_1'],
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
                           'repeater_condition' => ['style_1'],
                     ]
                  ]
               );
         }
           
            $repeater->add_control(
            'nilos_footer_contact_title',
              [
                'label'   => esc_html__( 'Contact Title', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Contact Title', 'nilos-core' ),
                'label_block' => true,
              ]
            );
   
            $repeater->add_control(
               'nilos_contact_type',
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
               'nilos_contact_default_url',
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
                      'nilos_contact_type' => 'default'
                   ]
                 ]
               );
               
              $repeater->add_control(
               'nilos_contact_phone_url',
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
                      'nilos_contact_type' => 'phone'
                   ]
                 ]
               );
              $repeater->add_control(
               'nilos_contact_mail_url',
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
                      'nilos_contact_type' => 'email'
                   ]
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
              'nilos_footer_contact_list',
              [
                'label'       => esc_html__( 'Contact Repeater', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                  [
                    'nilos_footer_contact_title'   => esc_html__( 'nilos@mail.com', 'nilos-core' ),
                  ],
                  [
                    'nilos_footer_contact_title'   => esc_html__( '+012 456 5852', 'nilos-core' ),
                  ],
                ],
                'title_field' => '{{{ nilos_footer_contact_title }}}',
              ]
            );
           
           $this->end_controls_section();

    }


    protected function style_tab_content(){
        $this->nilos_icon_style('services_box_icon', 'Contact - Icon/Image/SVG', '.nilos-el-box-icon span');

        $this->nilos_link_controls_style('portfolio_description', 'Contact - Link Style', '.nilos-el-box-btn');
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

        <div class="nilos-footer-contact">

            <?php foreach ($settings['nilos_footer_contact_list'] as $item) : 
                
                $contact_type = $item['nilos_contact_type'];

                if($contact_type === 'mail'){
                    $contact_url = 'mailto:'.$item['nilos_contact_mail_url']['url'];
                }
                elseif ($contact_type === 'phone') {
                    $contact_url = 'tel:'.$item['nilos_contact_phone_url']['url'];
                }
                elseif ($contact_type === 'map') {
                    $contact_url = $item['nilos_contact_map_url']['url'];
                }
                elseif ($contact_type === 'default') {
                    $contact_url = $item['nilos_contact_default_url']['url'];
                }
                else{
                    $contact_url = "#";
                }
            ?>
            <div class="nilos-footer-contact-item d-flex align-items-start">
                <div class="nilos-footer-contact-icon nilos-el-box-icon">
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

                <div class="nilos-footer-contact-content">
                    <p><a class="nilos-el-box-btn" href="<?php echo esc_url($contact_url); ?>"> <?php echo nilos_kses($item['nilos_footer_contact_title']); ?></a></p>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>

        <?php
    }
}

$widgets_manager->register( new NILOS_Footer_Contact() );
