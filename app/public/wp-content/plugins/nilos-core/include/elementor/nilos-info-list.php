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
class Nilos_Info_list extends Widget_Base {

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
        return 'nilos-info-list';
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
        return __( 'Nilos Info List', 'nilos-core' );
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

    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }  


    protected function register_controls_section() {
        
        $this->start_controls_section(
            '_list_content',
            [
                'label' => esc_html__('List Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'_list_style',
			[
				'label' => esc_html__( 'List Style', 'nilos-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'list-1',
				'options' => [
					'list-1' => esc_html__( 'List 1', 'nilos-core' ),
					'list-2' => esc_html__( 'List 2', 'nilos-core' ),
				]
			]
		);



        $this->add_control(
            '_info_list',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => '_list_icon_new',
                        'show_label' => false,
                        'type' => Controls_Manager::ICONS,
                        'label_block' => true,
                        'default' => [
                            'value' => 'fas fa-star',
                            'library' => 'solid',
                        ],
                    ],
                    [
                        'name'  => '_list_subtitle',
                        'label' => esc_html__('Subtitle', 'nilos-core'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Subtitle', 'nilos-core'),
                        'placeholder' => esc_html__('Type Sub Heading Text', 'nilos-core'),
                    ],
                    [
                        'name'  => '_list_info',
                        'label' => esc_html__('Info', 'nilos-core'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('+888 999 777 00', 'nilos-core'),
                    ],
                    [
                        'name'  => '_list_info_url',
                        'label' => esc_html__( 'Link', 'nilos-core' ),
                        'type' => Controls_Manager::URL,
                        'options' => [ 'url', 'is_external', 'nofollow' ],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                        ]
                    ],
                ],
                'default' => [
                    [
                        '_list_info'        => '+888 999 777 00'
                    ]
                ],
                'title_field' => '{{{ _list_info }}}',
                'condition'   => [
                    '_list_style'    => 'list-1'
                ]
            ]
        );

        $this->add_control(
            'wrapper_class',
            [
                'label' => esc_html__('A wrapper class', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => 'faq-page__some-topic-list',
                'placeholer'    => 'A wrapper class',
                'condition'     => [
                    '_list_style'    => 'list-2'
                ]
            ]
        );
        
        $this->add_control(
            '_info_list_2',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => '_list_info',
                        'label' => esc_html__('Info', 'nilos-core'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Company Policies', 'nilos-core'),
                    ],
                    [
                        'name'  => '_list_info_url',
                        'label' => esc_html__( 'Link', 'nilos-core' ),
                        'type' => Controls_Manager::URL,
                        'options' => [ 'url', 'is_external', 'nofollow' ],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                        ]
                    ],
                ],
                'default' => [
                    [
                        '_list_info'         => esc_html__('Company Policies', 'nilos-core'),
                    ]
                ],
                'title_field' => '{{{ _list_info }}}',
                'condition'   => [
                    '_list_style'    => 'list-2'
                ]
            ]
        );
        

        $this->end_controls_section();
    }

    protected function style_tab_content() {
        $this->start_controls_section(
			'_list_infos',
			[
				'label' => esc_html__( 'Infos', 'nilos-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'infos',
				'selector' => '{{WRAPPER}} .list-unstyled li .text p a',
			]
		);
        $this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-unstyled li .text p a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'_list_icons',
			[
				'label' => esc_html__( 'Icons', 'nilos-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icons',
				'selector' => '{{WRAPPER}} .list-unstyled .icon span',
			]
		);
        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-unstyled .icon span' => 'color: {{VALUE}}',
				],
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
        <?php if($settings['_list_style'] == 'list-1'): ?>
        <ul class="list-unstyled faq-page__contact-info">
            <?php foreach($settings['_info_list'] as $key => $item): ?>
            <li>
                <div class="icon">
                    <span><?php nilos_render_icon($item, '_list_icon_old', '_list_icon_new'); ?></span>
                </div>
                <div class="text">
                    <?php
                        if(!empty($item['_list_info_url']['url'])){
                            $this->add_link_attributes('_list_info_url', $item['_list_info_url']);
                        }
                    ?>
                    <p><a <?php echo $this->get_render_attribute_string( '_list_info_url' ); ?>><?php echo esc_html($item['_list_info']); ?></a></p>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php elseif($settings['_list_style'] == 'list-2'): ?>
        <ul class="list-unstyled <?php echo esc_attr($settings['wrapper_class']); ?>">
            <?php foreach($settings['_info_list_2'] as $key => $item): ?>
            <li>
                    <?php
                        if(!empty($item['_list_info_url']['url'])){
                            $this->add_link_attributes('_list_info_url', $item['_list_info_url']);
                        }
                    ?>
                <a <?php echo $this->get_render_attribute_string( '_list_info_url' ); ?>><?php echo esc_html($item['_list_info']); ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php
        endif;
    }
}

$widgets_manager->register( new Nilos_Info_list() );
