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
class NILOS_Why_Choose extends Widget_Base {

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
		return 'nilos-why-choose';
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
		return __( 'Nilos Why Choose', 'nilos-core' );
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
            'content',
            [
                'label' => esc_html__('Content', 'nilos-core'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'nilos-core'),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Core Features', 'nilos-core')
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Why choose us', 'nilos-core')
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'nilos-core'),
                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                'default'   => wp_kses_post('For each business, we take a bespoke approach to developing change within the organisation.')
            ]
        );
        $this->add_control(
            'headings',
            [
                'label' => esc_html__('Headings', 'nilos-core'),
                'type'  => \Elementor\Controls_Manager::REPEATER,
                'fields'    => [
                    [
                        'name'  => 'heading',
                        'label' => esc_html__('Heading', 'nilos-core'),
                        'type'  => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Some title here', 'nilos-core'),
                    ],
                    [
                        'name'  => 'heading_link',
                        'label' => esc_html__('Heading link', 'nilos-core'),
                        'type'  => \Elementor\Controls_Manager::URL,
                        'default'   => [
                            'url'   => '',
                            'is_external'   => true,
                            'nofollow'  => true,
                        ]
                    ]
                ],
                'default'   => [
                    [
                        'heading'   => esc_html__('We Develop Strategies'),
                        'heading_link'  => [
                            'url'   => '#'
                        ]
                    ]
                ],
                'title_field'   => '{{ heading }}'      
            ]
        );
        

        $this->end_controls_section();

        // Button 
        $this->nilos_button_render('video', 'Button');

        // _nilos_image
        $this->start_controls_section(
            '_nilos_image_section',
            [
                'label' => esc_html__('Layout Image', 'nilos-core'),
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
        if ( !empty($settings['nilos_image']['url']) ) {
            $nilos_image = !empty($settings['nilos_image']['id']) ? wp_get_attachment_image_url( $settings['nilos_image']['id'], $settings['nilos_image_size_size']) : $settings['nilos_image']['url'];
            $nilos_image_alt = get_post_meta($settings["nilos_image"]["id"], "_wp_attachment_image_alt", true);
        }

		?>
        <!--Why Choose One Start-->
        <section class="why-choose-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="why-choose-one__left">
                            <div class="why-choose-one__title">
                                <p><?php echo esc_html($settings['subtitle']); ?></p>
                                <h2><?php echo esc_html($settings['title']); ?></h2>
                            </div>
                            <p class="why-choose-one__text"><?php echo wp_kses_post($settings['desc']); ?></p>
                            <?php if($settings['headings']): ?>
                            <ul class="list-unstyled why-choose-one__list">
                                <?php foreach($settings['headings'] as $item): ?>
                                <li><a href="<?php echo esc_url($item['heading_link']['url']); ?>"><?php echo esc_html($item['heading']); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="why-choose-one__right">
                            <div class="why-choose-one__img">
                                <img src="<?php echo esc_url($nilos_image); ?>" alt="<?php echo esc_attr($nilos_image_alt); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Why Choose One End-->
        <?php

	}

}

$widgets_manager->register( new NILOS_Why_Choose() );
