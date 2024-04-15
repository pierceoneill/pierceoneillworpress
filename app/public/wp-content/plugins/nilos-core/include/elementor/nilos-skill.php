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
class Nilos_Skill extends Widget_Base
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
        return 'nilos-skill';
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
        return __('Nilos Skill', 'nilos-core');
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


        // Content 
        $this->start_controls_section(
            'skill-one',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            '_skill_style',
            [
                'label' => esc_html__('skill Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'skill-1',
                'options' => [
                    'skill-1' => esc_html__('skill 1', 'nilos-core'),
                    'skill-2' => esc_html__('skill 2', 'nilos-core'),
                    'skill-3' => esc_html__('skill 3', 'nilos-core'),
                    'skill-4' => esc_html__('skill 4', 'nilos-core'),
                    'skill-5' => esc_html__('skill 5', 'nilos-core'),
                ]
            ]
        );

        $this->add_control(
			'skill_section_image',
			[
				'label' => esc_html__( 'Choose Image', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'skill_tagline',
			[
				'label' => esc_html__( 'Tagline', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Skillset', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your skillset here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'skill_section_title',
			[
				'label' => esc_html__( 'Skill Title', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 6,
				'default' => esc_html__( 'My skill will tell like i am dope', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);


        $this->add_control(
			'progress_fields',
			[
				'label' => esc_html__( 'Repeater List', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'progress_title',
						'label' => esc_html__( 'Progress Title', 'nilos-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Custom Design' , 'nilos-core' ),
						'label_block' => true,
					],
                    [
                        'name'  => 'progress_bar',
                        'label' => __('Progress Percentage', 'text-domain'),
                        'type'  => \Elementor\Controls_Manager::NUMBER,
                        'default' => '50'
                    ]
                    

				],
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'nilos-core' ),
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
        <?php if ($settings['_skill_style'] == 'skill-1') : ?>

        <?php elseif ($settings['_skill_style'] == 'skill-2') : ?>

        <?php elseif ($settings['_skill_style'] == 'skill-3') : ?>

        <?php elseif ($settings['_skill_style'] == 'skill-4') : ?>
        <!--Skill One Start-->
        <section class="skill-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="skill-one__left">
                            <div class="section-title-four text-left">
                                <div class="section-title-four__tagline-box">
                                    <span class="section-title-four__tagline"><?php echo $settings['skill_tagline']; ?></span>
                                </div>
                                <h2 class="section-title-four__title"><?php echo wp_kses_post($settings['skill_section_title']); ?></h2>
                            </div>
                            <div class="skill-one__progress">
                                <?php foreach($settings['progress_fields'] as $progress) : ?>
                                <div class="skill-one__progress-single">
                                    <h4 class="skill-one__progress-title"><?php echo $progress['progress_title']; ?></h4>
                                    <div class="bar">
                                        <div class="bar-inner count-bar" data-percent="<?php echo esc_attr($progress['progress_bar']) .'%'; ?>">
                                            <div class="count-text"> <?php echo esc_attr($progress['progress_bar']) .'%'; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="skill-one__right">
                            <div class="skill-one__img wow slideInRight" data-wow-delay="100ms"
                                data-wow-duration="2500ms">
                                <img src="<?php echo $settings['skill_section_image']['url'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Skill One End-->
        <?php if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ): ?>
        <script>
            ;(function($){
                if ($(".count-bar").length) {
                    $(".count-bar").appear(
                    function () {
                        var el = $(this);
                        var percent = el.data("percent");
                        $(el).css("width", percent).addClass("counted");
                    }, {
                        accY: -50
                    }
                    );
                }

            })(jQuery);
        </script>
        <?php endif; ?>
        <?php elseif ($settings['_skill_style'] == 'skill-5') : ?>
        <?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Skill());
