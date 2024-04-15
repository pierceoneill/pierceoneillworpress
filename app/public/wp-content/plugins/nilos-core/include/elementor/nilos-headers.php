<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_Headers extends Widget_Base
{

    use \NilosCore\Widgets\NilosCoreElementFunctions;

    protected $nav_menu_index = 1;

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'nilos-headers';
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
    public function get_title()
    {
        return __('Nilos Headers', 'nilos-core');
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
    public function get_icon()
    {
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
    public function get_categories()
    {
        return ['nilos-core'];
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
    public function get_script_depends()
    {
        return ['nilos-core'];
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

    protected function register_controls()
    {
        $this->register_controls_section();
        $this->style_tab_content();
    }

    private function get_available_menus() {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }


    protected function register_controls_section()
    {

        $this->start_controls_section(
            '_header',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_header_style',
            [
                'label' => esc_html__('Header Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'header-2',
                'options' => [
                    'header-2' => esc_html__('Header 2', 'nilos-core'),
                    'header-3' => esc_html__('Header 3', 'nilos-core'),
                    'header-4' => esc_html__('Header 4', 'nilos-core'),
                    'header-5' => esc_html__('Header 5', 'nilos-core'),
                ]
            ]
        );

        $this->add_control(
			'logo',
			[
				'label' => esc_html__( 'Choose logo', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => get_parent_theme_file_uri('/assets/img/logo/logo-2.png'),
				],
			]
		);

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) {
            $this->add_control(
                'menu',
                [
                    'label'        => __( 'Menu', 'nilos-core' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'nilos-core' ), admin_url( 'nav-menus.php' ) ),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'nilos-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->add_control(
			'info',
			[
				'label' => esc_html__( 'Info mail', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'info@webmail.com', 'nilos-core' ),
				'placeholder' => esc_html__( 'Give a mail here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'GET A QOUTE', 'nilos-core' ),
                'condition' => [
                    '_header_style' => ['header-3', 'header-5']
                ]
			]
		);

        $this->add_control(
			'btn_url',
			[
				'label' => esc_html__( 'Button URL', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
                'condition' => [
                    '_header_style' => ['header-3', 'header-5']
                ]
			]
		);

        $this->add_control(
			'social_links',
			[
				'label' => esc_html__( 'Social Links', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Title/Icon', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Link Title' , 'nilos-core' ),
						'label_block' => true,
					],
					[
						'name' => 'list_url',
						'label' => esc_html__( 'URL', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::URL,
                        'options' => [ 'url', 'is_external', 'nofollow' ],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            'custom_attributes' => '',
                        ],
                        'label_block' => true,
					],
				],
				'default' => [
					[
						'list_title' => esc_html__( 'Fb.', 'nilos-core' ),
						'list_url' => [
                            'url'   => '#'
                        ],
					],
					[
						'list_title' => esc_html__( 'Tw.', 'nilos-core' ),
						'list_url' => [
                            'url'   => '#'
                        ],
					],
				],
				'title_field' => '{{{ list_title }}}',
                'condition' => [
                    '_header_style' => ['header-5']
                ]
			]
		);


        $this->end_controls_section();
    }

    protected function style_tab_content(){
    }

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        require_once get_parent_theme_file_path(). '/inc/class-navwalker.php';

        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'main-menu__list',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => 'Nilos_Navwalker_Class::fallback',
            'container'   => '',
            'walker'      => new \TPCore\Widgets\Nilos_Navwalker_Class,
        ];

        $menu_html = wp_nav_menu( $args );
        if ( ! empty( $settings['btn_url']['url'] ) ) {
            $this->add_link_attributes( 'btn_url', $settings['btn_url'] );
        }
        
        ?>
        <?php if ($settings['_header_style'] == 'header-2') : ?>
            <header class="main-header-two">
                <nav class="main-menu main-menu-two">
                    <div class="main-menu-two__wrapper">
                        <div class="main-menu-two__wrapper-inner">
                            <div class="main-menu-two__logo">
                                <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($settings['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>"></a>
                            </div>
                            <div class="main-menu-two__main-menu-box">
                                <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                <?php echo $menu_html; ?>
                            </div>
                            <div class="main-menu-two__right">
                                <div class="main-menu-two__email-box-and-nav-sidebar">
                                    <div class="main-menu-two__email-box">
                                        <a href="mailto:<?php echo esc_html($settings['info']); ?>" class="main-menu-two__email"> <span>mail us.</span><?php echo esc_html($settings['info']); ?></a>
                                    </div>
                                    <div class="main-menu-two__nav-sidebar-icon">
                                        <a class="navSidebar-button" href="#"><span class="icon-dots-menu"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="stricky-header stricked-menu main-menu main-menu-two">
                <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
            </div><!-- /.stricky-header -->
        <?php elseif ($settings['_header_style'] == 'header-3') : ?>
            <header class="main-header-three">
                <nav class="main-menu main-menu-three">
                    <div class="main-menu-three__wrapper">
                        <div class="container">
                            <div class="main-menu-three__wrapper-inner">
                                <div class="main-menu-three__left">
                                    <div class="main-menu-three__logo">
                                        <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($settings['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>"></a>
                                    </div>
                                    <div class="main-menu-three__main-menu-box">
                                        <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                        <?php echo $menu_html; ?>
                                    </div>
                                </div>
                                <div class="main-menu-three__right">
                                    <div class="main-menu-three__email-box-and-btn">
                                        <div class="main-menu-three__email-box">
                                            <div class="main-menu-three__email-icon">
                                                <span class="icon-open-mail"></span>
                                            </div>
                                            <h5 class="main-menu-three__email-number">
                                                <a href="mailto:<?php echo esc_html($settings['info']); ?>" class="main-menu-three__email"><?php echo esc_html($settings['info']); ?></a>
                                            </h5>
                                        </div>
                                        <div class="main-menu-three__btn">
                                            <a <?php echo $this->get_render_attribute_string( 'btn_url' ); ?>><?php echo esc_html($settings['btn_text']); ?><span></span> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="stricky-header stricked-menu main-menu main-menu-three">
                <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
            </div><!-- /.stricky-header -->
        <?php elseif ($settings['_header_style'] == 'header-4') : ?>
            <header class="main-header-four">
                <nav class="main-menu main-menu-four">
                    <div class="main-menu-four__wrapper">
                        <div class="main-menu-four__wrapper-inner">
                            <div class="main-menu-four__left">
                                <div class="main-menu-four__logo">
                                    <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($settings['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>"></a>
                                </div>
                                <div class="main-menu-four__main-menu-box">
                                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                    <?php echo $menu_html; ?>
                                </div>
                            </div>
                            <div class="main-menu-four__right">
                                <div class="main-menu-four__nav-sidebar-icon">
                                    <a class="navSidebar-button" href="#"><span class="icon-dots-menu"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="stricky-header stricked-menu main-menu main-menu-four">
                <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
            </div><!-- /.stricky-header -->
        <?php elseif ($settings['_header_style'] == 'header-5') : ?>
            <header class="main-header-five">
                <nav class="main-menu main-menu-five">
                    <div class="main-menu-five__wrapper">
                        <div class="container">
                            <div class="main-menu-five__wrapper-inner">
                                <div class="main-menu-five__logo">
                                    <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($settings['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>"></a>
                                </div>
                                <div class="main-menu-three__main-menu-box">
                                    <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                    <?php echo $menu_html; ?>
                                </div>
                                <div class="main-menu-five__right">
                                    <?php if($settings['social_links']): ?>
                                    <div class="main-menu-five__social">
                                        <?php foreach($settings['social_links'] as $link): ?>
                                        <a href="<?php echo esc_url($link['list_url']['url']); ?>"><?php echo wp_kses_post($link['list_title']); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="main-menu-five__btn">
                                        <a <?php echo $this->get_render_attribute_string( 'btn_url' ); ?>><?php echo esc_html($settings['btn_text']); ?><span></span> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="stricky-header stricked-menu main-menu main-menu-five" style="display: none;">
                <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
            </div><!-- /.stricky-header -->
        <?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Headers());
