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
class Nilos_Team extends Widget_Base
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
        return 'nilos-team';
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
        return __('Nilos Team', 'nilos-core');
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
            '_team_title',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_team_style',
            [
                'label' => esc_html__('Service Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'team-1',
                'options' => [
                    'team-1' => esc_html__('Team 1', 'nilos-core'),
                    'team-2' => esc_html__('Team 2', 'nilos-core'),
                    'team-3' => esc_html__('Team 3', 'nilos-core'),
                    'team-4' => esc_html__('Team 4', 'nilos-core'),
                    'team-5' => esc_html__('Team 5', 'nilos-core'),
                ]
            ]
        );
        $this->add_control(
			'tagline',
			[
				'label' => esc_html__( 'Tagline', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Team', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your tagline here', 'nilos-core' ),
			]
		);
        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'More in my team', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);

        $this->end_controls_section();





        $this->start_controls_section(
            '_team_member',
            [
                'label' => esc_html__('Team Member', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(  
			'list',
			[
				'label' => esc_html__( 'Add taam member', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
                    [
                        'name'  => 'member_image',
                        'label' => esc_html__( 'Choose Image', 'nilos-core' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
					[
						'name' => 'member_name',
						'label' => esc_html__( 'Team name', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Add member name' , 'nilos-core' ),
						'label_block' => true,
					],
					[
						'name' => 'member_designation',
						'label' => esc_html__( 'Team designation', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Add member designation' , 'nilos-core' ),
						'label_block' => true,
					],

				],
				'default' => [
					[
						'list_title' => esc_html__( 'Add Member', 'nilos-core' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'nilos-core' ),
					],

				],
				'title_field' => '{{{ list_title }}}',
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
        <?php if ($settings['_team_style'] == 'team-1') : ?>
        <?php elseif ($settings['_team_style'] == 'team-2') : ?>

        <?php elseif ($settings['_team_style'] == 'team-3') : ?>

        <?php elseif ($settings['_team_style'] == 'team-4') : ?>
            <!--Team One Start-->
                <section class="team-one">
                    <div class="container">
                        <div class="section-title-four text-left">
                            <div class="section-title-four__tagline-box">
                                <span class="section-title-four__tagline"><?php echo esc_html($settings['tagline']); ?></span>
                            </div>
                            <h2 class="section-title-four__title"><?php echo esc_html($settings['title']); ?></h2>
                        </div>
                        <div class="team-one__inner">
                            <div class="row">
                                <?php foreach($settings['list'] as $team) : ?>
                                <!--Team One Single Start-->
                                <div class="col-xl-4 col-lg-4">
                                    <div class="team-one__single">
                                        <div class="team-one__img-box">
                                            <div class="team-one__img">
                                                <img src="<?php echo esc_attr( $team['member_image']['url']); ?>" alt="">
                                            </div>
                                            <h3 class="team-one__name"><?php echo esc_html( $team['member_name']); ?><span><?php echo esc_html($team['member_designation']); ?></span></h3>
                                        </div>
                                        <div class="team-one__social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!--Team One Single End-->
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <!--Team One End-->
        <?php elseif ($settings['_team_style'] == 'team-5') : ?>

        <?php endif;
    }
}

$widgets_manager->register(new Nilos_Team());
