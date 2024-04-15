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
class Nilos_Services extends Widget_Base
{

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
    public function get_name()
    {
        return 'nilos-services';
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
        return __('Nilos Services', 'nilos-core');
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


    protected function register_controls_section()
    {
        $this->start_controls_section(
            '_services',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_service_style',
            [
                'label' => esc_html__('Service Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'service-1',
                'options' => [
                    'service-1' => esc_html__('Service 1', 'nilos-core'),
                    'service-2' => esc_html__('Service 2', 'nilos-core'),
                    'service-3' => esc_html__('Service 3', 'nilos-core'),
                    'service-4' => esc_html__('Service 4', 'nilos-core'),
                    'service-5' => esc_html__('Service 5', 'nilos-core'),
                ]
            ]
        );
        
        $this->add_control(
            'tag',
            [
                'label' => esc_html__('Tag', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Since From 1990', 'nilos-core'),
                'placeholder' => esc_html__('Type your tag here', 'nilos-core'),
                'condition' => [
                    '_service_style'    => ['service-2', 'service-3']
                ]
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('I operate law firm and agency working with brands – building insightful sights.', 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
                'condition' => [
                    '_service_style'    => ['service-2', 'service-3']
                ]
            ]
        );
        
        $this->end_controls_section();
        $this->start_controls_section(
            '_services_list',
            [
                'label' => esc_html__('Services List', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'services_list',
            [
                'label' => esc_html__('Services List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'icon_or_image',
                        'label' => esc_html__('Icon/Image', 'nilos-core'),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'image',
                        'options' => [
                            'icon' => esc_html__('Icon', 'nilos-core'),
                            'image' => esc_html__('Image', 'nilos-core')
                        ]
                    ],
                    [
                        'name' => 'service_image',
                        'label' => esc_html__('Icon', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => \Elementor\Utils::get_placeholder_image_src()
                        ],
                        'condition' => [
                            'icon_or_image' => 'image'
                        ]
                    ],
                    [
                        'name'  => 'icon',
                        'label' => esc_html__( 'Icon', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fas fa-circle',
                            'library' => 'fa-solid',
                        ],
                        'recommended' => [
                            'fa-solid' => [
                                'circle',
                                'dot-circle',
                                'square-full',
                            ],
                            'fa-regular' => [
                                'circle',
                                'dot-circle',
                                'square-full',
                            ],
                        ],
                        'condition' => [
                            'icon_or_image' => 'icon'
                        ]
                    ],
                    [
                        'name' => 'service_title',
                        'label' => esc_html__('Title', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Website UI Design', 'nilos-core'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'service_desc',
                        'label' => esc_html__('Descriptons', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default'   => esc_html__('The goal of website design is create an aesthetically leasing', 'nilos-core'),
                        'label_block' => true,
                        'condition' => [
                            '_service_style'  => ['service-5', 'service-2']
                        ]
                    ],
                    [
                        'name' => 'service_link',
                        'label' => esc_html__('Link', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            // 'custom_attributes' => '',
                        ],
                        'label_block' => true,
                    ]
                ],
                'title_field' => '{{{ service_title }}}',
                'condition' => [
                    '_service_style'  => ['service-5', 'service-2', 'service-3', 'service-1']
                ]
            ]


        );

        //service 4
        $this->add_control(
			'service_list_1',
			[
				'label' => esc_html__( 'Services list', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'service_title',
						'label' => esc_html__( 'Title', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Service Title' , 'nilos-core' ),
						'label_block' => true,
					],

                    [
                        'name'  => 'service_image',
                        'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'service_link',
                        'label' => esc_html__('Link', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            // 'custom_attributes' => '',
                        ],
                        'label_block' => true,
                    ]

				],
                'default'   => [
                    [
                        'service_title' => esc_html__('Motion', 'nilos-core'),
                        'service_image'  => [
                            'url'       => \Elementor\Utils::get_placeholder_image_src()
                        ],
                        'service_link'  => [
                            'url'       => '#'
                        ]
                    ]
                ],
                'condition' => [
                    '_service_style'  => ['service-4']
                ]
			]
		);

        $this->add_control(
            'circle_text',
            [
                'label' => esc_html__('Bottom Text', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Get solid costume design for your program ', 'nilos-core'),
                'placeholder' => esc_html__('Type your text', 'nilos-core'),
                'condition' => [
                    '_service_style'   => 'service-4'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'list_2',
            [
                'label' => esc_html__('List 2', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_service_style'    => ['service-4']
                ]
            ]
        );

        //service 4
        $this->add_control(
			'service_list_2',
			[
				'label' => esc_html__( 'Services list 2', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'service_title',
						'label' => esc_html__( 'Title', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Service Title' , 'nilos-core' ),
						'label_block' => true,
					],

                    [
                        'name'  => 'service_image',
                        'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'service_link',
                        'label' => esc_html__('Link', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            // 'custom_attributes' => '',
                        ],
                        'label_block' => true,
                    ]

				],
                'default'   => [
                    [
                        'service_title' => esc_html__('Motion', 'nilos-core'),
                        'service_image'  => [
                            'url'       => \Elementor\Utils::get_placeholder_image_src()
                        ],
                        'service_link'  => [
                            'url'       => '#'
                        ]
                    ]
                ],
                'condition' => [
                    '_service_style'  => ['service-4']
                ]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'list_3',
            [
                'label' => esc_html__('List 3', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_service_style'    => ['service-4']
                ]
            ]
        );

        //service 4
        $this->add_control(
			'service_list_3',
			[
				'label' => esc_html__( 'Services list 3', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'service_title',
						'label' => esc_html__( 'Title', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Service Title' , 'nilos-core' ),
						'label_block' => true,
					],

                    [
                        'name'  => 'service_image',
                        'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'service_link',
                        'label' => esc_html__('Link', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            // 'custom_attributes' => '',
                        ],
                        'label_block' => true,
                    ]

				],
                'default'   => [
                    [
                        'service_title' => esc_html__('Motion', 'nilos-core'),
                        'service_image'  => [
                            'url'       => \Elementor\Utils::get_placeholder_image_src()
                        ],
                        'service_link'  => [
                            'url'       => '#'
                        ]
                    ]
                ],
                'condition' => [
                    '_service_style'  => ['service-4']
                ]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            '_service_more',
            [
                'label' => esc_html__('More Button', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_service_style'    => ['service-3']
                ]
            ]
        );

        $this->add_control(
            'more',
            [
                'label' => esc_html__('Button text', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('More Services', 'nilos-core'),
                'placeholder' => esc_html__('Type your text here', 'nilos-core'),
            ]
        );

        $this->add_control(
            'more_btn_link',
            [
                'label' => esc_html__( 'Button link', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function style_tab_content()
    {
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
        $settings = $this->get_settings_for_display(); ?>
        <?php if ($settings['_service_style'] == 'service-1') : ?>
            <!--Services Five Start-->
            <section class="services-five">
                <div class="container">
                    <?php if(!empty($settings['services_list'])): ?>
                    <div class="row">
                        <?php foreach ($settings['services_list'] as $item) :  ?>
                        <!--Services Five Single Start-->
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="services-five__single">
                                <div class="services-five__icon">
                                    <img src="<?php echo esc_url($item['service_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <h3 class="services-five__title"><a href="<?php echo esc_url($item['service_link']['url']); ?>"><?php echo esc_html($item['service_title']); ?></a></h3>
                                <p class="services-five__text"><?php echo wp_kses_post($item['service_desc']); ?></p>
                                <div class="services-five__border"></div>
                                <a href="<?php echo esc_url($item['service_link']['url']); ?>" class="services-five__read-more"><?php esc_html_e('Read more', 'nilos-core'); ?></a>
                            </div>
                        </div>
                        <!--Services Five Single End-->
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <!--Services Five End-->
        <?php elseif ($settings['_service_style'] == 'service-2') : ?>
            <!--Services Two Start-->
            <section class="services-two">
                <div class="container">
                    <div class="section-title-two text-center">
                        <div class="section-title-two__tagline-box">
                            <p class="section-title-two__tagline"><span class="icon-photo-camera"></span> <?php echo esc_html($settings['tag']); ?></p>
                        </div>
                        <h2 class="section-title-two__title"><?php echo esc_html($settings['title']); ?></h2>
                    </div>
                    <?php if($settings['services_list']): ?>
                    <div class="row">
                        <?php foreach($settings['services_list'] as $item): ?>
                        <!--Services Two Single Start-->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="services-two__single">
                                <?php if($item['icon_or_image'] == 'icon'): ?>
                                <div class="services-two__icon">
                                    <span><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                </div>
                                <?php endif; ?>
                                <h3 class="services-two__title"><a href="<?php echo esc_url($item['service_link']['url']); ?>"><?php echo esc_html($item['service_title']); ?></a></h3>
                                <p class="services-two__text"><?php echo esc_html($item['service_desc']); ?></p>
                                <a href="<?php echo esc_url($item['service_link']['url']); ?>" class="services-two__btn-box">
                                    <span class="services-two__read-more">read more</span>
                                    <span class="icon-up services-two__arrow"></span>
                                </a>
                            </div>
                        </div>
                        <!--Services Two Single End-->
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <!--Services Two End-->
        <?php elseif ($settings['_service_style'] == 'service-3') : ?>
            <!--Services Six Start -->
            <section class="services-six">
                <div class="container">
                    <div class="services-six__inner">
                        <div class="section-title-three text-left">
                            <div class="section-title-three__tagline-box">
                                <span class="section-title-three__tagline"><?php echo $settings['tag']; ?></span>
                            </div>
                            <h2 class="section-title-three__title"><?php echo $settings['title']; ?></h2>
                        </div>
                        <div class="services-six__more-services">
                            <a href="<?php echo esc_url($settings['more_btn_link']['url']); ?>"><?php echo esc_html($settings['more']); ?> <span class="icon-up"></span></a>
                        </div>
                        <?php if($settings['services_list']): ?>
                        <div class="services-six__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                                "loop": true,
                                "autoplay": true,
                                "margin": 30,
                                "nav": true,
                                "dots": false,
                                "smartSpeed": 500,
                                "autoplayTimeout": 10000,
                                "navText": ["<span class=\"fa fa-arrow-left\"></span>","<span class=\"fa fa-arrow-right\"></span>"],
                                "responsive": {
                                    "0": {
                                        "items": 1
                                    },
                                    "768": {
                                        "items": 1
                                    },
                                    "992": {
                                        "items": 1
                                    },
                                    "1290": {
                                        "items": 1
                                    }
                                }
                            }'>
                            <?php foreach($settings['services_list'] as $item): ?>
                            <!--Services Six Single Start -->
                            <div class="item">
                                <div class="services-six__single">
                                    <div class="services-six__img">
                                        <?php if($item['icon_or_image'] == 'image'): ?>
                                        <img src="<?php echo esc_url($item['service_image']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                        <a href="<?php echo esc_url($item['service_link']['url']); ?>" class="services-six__arrow"><span class="icon-up"></span></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="services-six__title-box">
                                        <h2 class="services-six__title"><?php echo esc_html($item['service_title']); ?></h2>
                                        <h2 class="services-six__title-two"><?php echo esc_html($item['service_title']); ?></h2>
                                    </div>
                                </div>
                            </div>
                            <!--Services Six Single End -->
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!--Services Six End -->
            <?php if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ): ?>
            <script>
                ;(function($){
                    if ($(".thm-owl__carousel").length) {
                        $(".thm-owl__carousel").each(function () {
                            let elm = $(this);
                            let options = elm.data('owl-options');
                            let thmOwlCarousel = elm.owlCarousel(options);
                        });
                        }

                        if ($(".thm-owl__carousel--custom-nav").length) {
                        $(".thm-owl__carousel--custom-nav").each(function () {
                            let elm = $(this);
                            let owlNavPrev = elm.data('owl-nav-prev');
                            let owlNavNext = elm.data('owl-nav-next');
                            $(owlNavPrev).on("click", function (e) {
                            elm.trigger('prev.owl.carousel');
                            e.preventDefault();
                            })

                            $(owlNavNext).on("click", function (e) {
                            elm.trigger('next.owl.carousel');
                            e.preventDefault();
                            })
                        });
                    }
                })(jQuery)
            </script>
            <?php endif; ?>
        <?php elseif ($settings['_service_style'] == 'service-4') : ?>
            <!--Services Three Start-->
            <section class="services-four">
                <div class="container">
                    <div class="services-four__inner">
                        <ul class="list-unstyled services-four__list">
                            <?php foreach($settings['service_list_1'] as $item) : ?>
                                <li>
                                    <a href="<?php echo esc_url($item['service_link']['url']); ?>"><?php echo esc_html($item['service_title']); ?></a>
                                    <div class="services-four__img">
                                        <img src="<?php echo esc_html($item['service_image']['url']);?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>

                        <ul class="list-unstyled services-four__list">
                            <?php foreach($settings['service_list_2'] as $item) : ?>
                                <li>
                                    <a href="<?php echo esc_url($item['service_link']['url']); ?>"><?php echo esc_html($item['service_title']); ?></a>
                                    <div class="services-four__img">
                                        <img src="<?php echo esc_html($item['service_image']['url']);?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>

                        <ul class="list-unstyled services-four__list">
                            <?php foreach($settings['service_list_3'] as $item) : ?>
                                <li>
                                    <a href="<?php echo esc_url($item['service_link']['url']); ?>"><?php echo esc_html($item['service_title']); ?></a>
                                    <div class="services-four__img">
                                        <img src="<?php echo esc_html($item['service_image']['url']);?>" alt="<?php bloginfo('name'); ?>">
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>

                        <div class="services-four__curved-circle">
                            <div class="curved-circle-2">
                                <?php echo $settings['circle_text'] ?>
                            </div><!-- /.curved-circle -->
                            <div class="services-four__curved-circle-icon">
                                <h3>*</h3>
                            </div>
                        </div><!-- /.curved-circle -->
                        
                    </div>
                </div>
            </section>
            <!--Services Three End-->
            <?php if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ): ?>
            <script>
                ;(function($){
                    if ($('.curved-circle-2').length) {
                    $('.curved-circle-2').circleType({
                        position: 'absolute',
                        dir: 1,
                        radius: 100,
                        forceHeight: true,
                        forceWidth: true
                    });
                    }
                })(jQuery);
            </script>
            <?php endif; ?>
        <?php elseif ($settings['_service_style'] == 'service-5') : ?>

            <!--Services Three Start-->
            <section class="services-three">
                <?php if(!empty($settings['services_list'])): ?>
                <ul class="list-unstyled services-three__inner">
                    <?php foreach ($settings['services_list'] as $item) :  ?>
                        <li>
                            <div class="services-three__single">
                                <div class="services-three__icon">
                                    <img src="<?php echo esc_url($item['service_icon']['url']); ?>" alt="<?php bloginfo('name'); ?>">
                                </div>
                                <h3 class="services-three__title"><a href="<?php echo esc_url($item['service_link']['url']); ?>"><?php echo esc_html($item['service_title']); ?></a></h3>
                                <p class="services-three__text"><?php echo wp_kses_post($item['service_desc']); ?></p>
                                <div class="services-three__border"></div>
                                <a href="<?php echo esc_url($item['service_link']['url']); ?>" class="services-three__read-more"><?php esc_html_e('Read more', 'nilos-core'); ?></a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </section>
            <!--Services Three End-->
        <?php endif;
    }
}

$widgets_manager->register(new Nilos_Services());
