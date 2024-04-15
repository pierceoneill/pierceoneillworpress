<?php

namespace NilosCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * NILOS Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Nilos_Portfolio extends Widget_Base
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
        return 'nilos-portfolio';
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
        return __('Nilos Portfolio', 'nilos-core');
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
            '_portfolios',
            [
                'label' => esc_html__('Choose Portfolio', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_portfolio_style',
            [
                'label' => esc_html__('Portfolio Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'portfolio-1',
                'options' => [
                    'portfolio-1' => esc_html__('Portfolio 1', 'nilos-core'),
                    'portfolio-2' => esc_html__('Portfolio 2', 'nilos-core'),
                    'portfolio-3' => esc_html__('Portfolio 3', 'nilos-core'),
                    'portfolio-4' => esc_html__('Portfolio 4', 'nilos-core'),
                    'portfolio-5' => esc_html__('Portfolio 5', 'nilos-core'),
                ]
            ]
        );
        $this->add_control(
            'portfolios',
            [
                'label' => esc_html__('Portfolio List', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'logo',
                        'label' => esc_html__('Company Logo', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default'   => [
                            'url'   => get_parent_theme_file_uri() . '/assets/img/project/portfolio-logo.png'
                        ],
                        'condition' => [
                            '_portfolio_style'  => ['portfolio-5']
                        ]
                    ],
                    [
                        'name'  => 'portfolio',
                        'label' => esc_html__('Select a post', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::SELECT2,
                        'default' => '',
                        'options' => $this->get_portfolios()
                    ],
                    [
                        'name'  => 'portfolio_cat',
                        'label' => esc_html__('Select a category', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::SELECT2,
                        'default' => '',
                        'options' => $this->get_portfolio_categories(),
                        'condition' => [
                            '_portfolio_style'  => ['portfolio-1']
                        ]
                    ],
                ],
                'default'   => [
                    [
                        'logo'  => [
                            'url'   => get_parent_theme_file_uri() . '/assets/img/project/portfolio-logo.png'
                        ]
                    ]
                ],
                'condition' => [
                    '_portfolio_style'  => ['portfolio-5', 'portfolio-4', 'portfolio-3', 'portfolio-2']
                ]
            ]
        );
        $this->add_control(
            'portfolios_cat',
            [
                'label' => esc_html__('Portfolio Categories', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name'  => 'portfolio_cat',
                        'label' => esc_html__('Select a category', 'nilos-core'),
                        'type' => \Elementor\Controls_Manager::SELECT2,
                        'default' => '',
                        'options' => $this->get_portfolio_categories()
                    ],
                ],
                'condition' => [
                    '_portfolio_style'  => ['portfolio-1']
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_portfolio',
            [
                'label' => esc_html__('Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_portfolio_style'  => ['portfolio-5', 'portfolio-3', 'portfolio-2']
                ]
            ]
        );
        $this->add_control(
            'tag',
            [
                'label' => esc_html__('Tag', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Portfolio", 'nilos-core'),
                'placeholder' => esc_html__('Type your tag here', 'nilos-core'),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Our case study", 'nilos-core'),
                'placeholder' => esc_html__('Type your title here', 'nilos-core'),
            ]
        );
        $this->end_controls_section();
        

        $this->start_controls_section(
            '_download_button',
            [
                'label' => esc_html__('CV Download', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    '_portfolio_style'  => ['portfolio-5', 'portfolio-3', 'portfolio-2']
                ]
            ]
        );
        $this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Download CV', 'nilos-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'nilos-core' ),
			]
		);
        $this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Button Link', 'nilos-core' ),
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

        /// portfolio 4

        $this->start_controls_section(
            '_bottom_content',
            [
                'label' => esc_html__('Bottom Content', 'nilos-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ],
        );

        $this->add_control(
			'offer_text',
			[
				'label' => esc_html__( 'Offer text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => wp_kses_post( 'Make your order done today!<span>Get 10% offer in summer</span>' ),
				'placeholder' => esc_html__( 'Type your text here', 'nilos-core' ),
			]
		);

        $this->add_control(
			'hire_btn_text',
			[
				'label' => esc_html__( 'Hire Button text', 'nilos-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hire me now' ),
				'placeholder' => esc_html__( 'Type a short text', 'nilos-core' ),
			]
		);

        $this->add_control(
			'hire_btn_link',
			[
				'label' => esc_html__( 'Hire Button Link', 'nilos-core' ),
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

    protected function get_portfolio_categories(){
        $categories = get_terms(array(
            'taxonomy'      => 'portfolio-cat',
            'hide_empty'    => false
        ));
        $cat = array();
        foreach($categories as $category){
            $cat[$category->slug]  = $category->name;
        }
        return $cat;
    }

    protected function get_portfolios()
    {
        $args = array(
            'post_type'     => 'portfolio',
            'post_status'   => 'publish',
            'posts_per_page' => -1
        );
        $portfolios = new WP_Query($args);
        $arr = array();
        if ($portfolios->have_posts()) {

            while ($portfolios->have_posts()) {
                $portfolios->the_post();
                $arr[get_the_ID()]  = get_the_title();
            }
            wp_reset_query();
        }
        return $arr;
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

        ?>
        <?php if ($settings['_portfolio_style'] == 'portfolio-1') : ?>
            <!--Portfolio Page Start-->
            <section class="portfolio-page">
                <div class="container">
                    <div class="portfolio-page__filter-box">
                        <ul class="portfolio-page__filter style1 post-filter list-unstyled clearfix">
                            <li data-filter=".filter-item" class="active"><span class="filter-text">All Works</span>
                            </li>
                            <?php if($settings['portfolios_cat']): 
                                foreach($settings['portfolios_cat'] as $item):
                            ?>
                            <li data-filter=".<?php echo esc_attr($item['portfolio_cat']); ?>">
                                <span class="filter-text"><?php echo esc_html(get_term_by('slug', $item['portfolio_cat'], 'portfolio-cat')->name); ?></span>
                            </li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <?php  if($settings['portfolios_cat']): ?>
                    <div class="row filter-layout" id="portfolio-ajax-load">
                        <?php
                            foreach($settings['portfolios_cat'] as $item):  
                            $query = new WP_Query(array(
                                'post_type'     => 'portfolio',
                                'post_status'   => 'publish',
                                'posts_per_page'    => 6,
                                'tax_query'     => array(
                                    array(
                                        'taxonomy'  => 'portfolio-cat',
                                        'field'     => 'slug',
                                        'terms'     => $item['portfolio_cat']
                                    )
                                )
                            ));
                            if($query->have_posts()): 
                        ?>
                        
                        <?php while($query->have_posts()): $query->the_post(); 
                            $terms = array();
                            foreach(get_the_terms(get_the_ID(), 'portfolio-cat') as $term){
                                $terms[]    = $term->slug;
                            }
                        ?>
                        <!--Portfolio Page Single Start-->
                        <div class="col-xl-6 col-lg-6 col-md-6 filter-item <?php echo esc_attr(implode(' ', $terms)); ?>">
                            <div class="portfolio-page__single">
                                <div class="portfolio-page__img">
                                    <?php
                                        if(has_post_thumbnail()){
                                            the_post_thumbnail();
                                        }
                                    ?>
                                    <div class="portfolio-page__content">
                                        <p class="portfolio-page__sub-title"><?php echo esc_html(implode(',', $terms)); ?></p>
                                        <h4 class="portfolio-page__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Portfolio Page Single End-->
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php endif; endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="portfolio-page__btn">
                                <a href="javascript:void(0)" class="portfolio-load-more"><?php echo esc_html__('Load More', 'nilos-core'); ?> <span></span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Portfolio Page End-->
        <?php elseif ($settings['_portfolio_style'] == 'portfolio-2') : ?>
            <!--Portfolio Two Start-->
            <section class="portfolio-two">
                <div class="container">
                    <div class="section-title-two text-left">
                        <div class="section-title-two__tagline-box">
                            <p class="section-title-two__tagline"><span class="icon-photo-camera"></span> <?php echo esc_html($settings['tag']); ?></p>
                        </div>
                        <h2 class="section-title-two__title"><?php echo esc_html($settings['title']); ?></h2>
                    </div>
                    <?php if($settings['portfolios']): ?>
                    <ul class="list-unstyled portfolio-two__list">
                        <?php foreach($settings['portfolios'] as $item): 
                            
                            $portfolio = new WP_Query(array(
                                'post_type' => 'portfolio',
                                'p'         => $item['portfolio'],
                                'posts_per_page' => 1, // Set to 1 to retrieve only one post
                            ));  
                            if ($portfolio->have_posts()) :
                                while ($portfolio->have_posts()) : $portfolio->the_post();  
                        ?>
                        <li>
                            <div class="portfolio-two__tag">
                                <?php
                                    $categories = get_the_terms(get_the_ID(), 'portfolio-cat');
                                    if (!empty($categories)) {
                                        foreach ($categories as $cat) {
                                            echo '<a href="'.get_term_link($cat).'">' .$cat->name . '</a>';
                                        }
                                    }
                                ?>
                            </div>
                            <div class="portfolio-two__title-box">
                                <h2 class="portfolio-two__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="portfolio-two__img">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            </div>
                        </li>
                        <?php
                            endwhile;
                        endif;
                        ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="portfolio-two__btn">
                        <a href="<?php echo esc_url($settings['btn_link']['url']); ?>"><?php echo esc_html($settings['btn_text']); ?> <span class="icon-up"></span></a>
                    </div>
                </div>
            </section>
            <!--Portfolio Two End-->
        <?php elseif ($settings['_portfolio_style'] == 'portfolio-3') : ?>
            <!--Portfolio Three Start -->
            <section class="portfolio-three">
                <div class="container">
                    <div class="section-title-three text-center">
                        <div class="section-title-three__tagline-box">
                            <span class="section-title-three__tagline"><?php echo $settings['tag']; ?></span>
                        </div>
                        <h2 class="section-title-three__title"><?php echo $settings['title']; ?></h2>
                    </div>
                    <?php if($settings['portfolios']): ?>
                    <div class="portfolio-three__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                    "loop": true,
                    "autoplay": true,
                    "margin": 70,
                    "nav": false,
                    "dots": true,
                    "smartSpeed": 500,
                    "autoplayTimeout": 10000,
                    "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
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
                <?php foreach($settings['portfolios'] as $item): 
                            
                            $portfolio = new WP_Query(array(
                                'post_type' => 'portfolio',
                                'p'         => $item['portfolio'],
                                'posts_per_page' => 1, // Set to 1 to retrieve only one post
                            ));  
                            if ($portfolio->have_posts()) :
                                while ($portfolio->have_posts()) : $portfolio->the_post();  
                        ?>
                        <div class="item">
                            <div class="portfolio-three__single">
                                <div class="portfolio-three__img">
                                    <?php the_post_thumbnail(); ?>
                                    <div class="portfolio-three__content">
                                        <p class="portfolio-three__sub-title"><?php
                                            $categories = get_the_terms(get_the_ID(), 'portfolio-cat');
                                            if (!empty($categories)) {
                                                echo '<a href="'.get_term_link($categories[0]).'">' .$categories[0]->name . '</a>';
                                            }
                                        ?> <span></span> </p>
                                        <h3 class="portfolio-three__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            endwhile;
                        endif;
                        ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <!--Portfolio Three End -->
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
        <?php elseif ($settings['_portfolio_style'] == 'portfolio-4') : ?>
            <!--Portfolio Four Start-->
            <section class="portfolio-four">
                <div class="portfolio-four__top">
                    <div class="portfolio-four__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                            "loop": true,
                            "autoplay": true,
                            "margin": 0,
                            "nav": false,
                            "dots": false,
                            "smartSpeed": 500,
                            "autoplayTimeout": 10000,
                            "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                            "responsive": {
                                "0": {
                                    "items": 1
                                },
                                "768": {
                                    "items": 2
                                },
                                "992": {
                                    "items": 3
                                },
                                "1290": {
                                    "items": 4
                                }
                            }
                        }'>
                        <!--Portfolio Four Single Start-->
                        <?php foreach($settings['portfolios'] as $item) : 
                            $portfolio = new WP_Query(array(
                                'post_type' => 'portfolio',
                                'p'         => $item['portfolio'],
                                'posts_per_page' => 1, // Set to 1 to retrieve only one post
                            ));  
                            if ($portfolio->have_posts()) :
                                while ($portfolio->have_posts()) : $portfolio->the_post();  
                        ?>
                            <div class="item">
                                <div class="portfolio-four__single">
                                    <div class="portfolio-four__img-box">
                                        <div class="portfolio-four__img">
                                            <?php
                                                if(has_post_thumbnail()){
                                                    the_post_thumbnail();
                                                }
                                            ?>
                                        </div>
                                        <div class="portfolio-four__content">
                                            <p class="portfolio-four__sub-title"><?php
                                            $categories = get_the_terms(get_the_ID(), 'portfolio-cat');
                                            if (!empty($categories)) {
                                                echo '<a href="'.get_term_link($categories[0]).'">' .$categories[0]->name . '</a>';
                                                echo isset($categories[1])? ', <a href="'.get_term_link($categories[1]).'">' .$categories[1]->name . '</a>' : '';
                                            }
                                        ?> </p>
                                            <div class="portfolio-four__title-and-arrow">
                                                <h3 class="portfolio-four__title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                                                <div class="portfolio-four__arrow">
                                                    <a href="<?php the_permalink(); ?>"><span class="icon-up"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endwhile;
                        endif;
                        ?>
                        <?php endforeach;?>
                        <!--Portfolio Four Single Start-->
                    </div>
                </div>
                <div class="portfolio-four__bottom">
                    <div class="container">
                        <div class="portfolio-four__bottom-inner">
                            <div class="portfolio-four__bottom-title">
                                <h3> <?php echo wp_kses_post($settings['offer_text']); ?></h3>
                            </div>
                            <div class="portfolio-four__btn-box">
                                <a href="<?php echo esc_url($settings['hire_btn_link']['url']); ?>" class="portfolio-four__btn thm-btn-four"><?php echo $settings['hire_btn_text'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Portfolio Four End-->
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
        <?php elseif ($settings['_portfolio_style'] == 'portfolio-5') : ?>
            <?php if ($settings['portfolios']) : ?>
                <!--Portfolio Five Start-->
                <div class="row">
                    <?php foreach ($settings['portfolios'] as $item) :
                        $args = array(
                            'post_type' => 'portfolio',
                            'p'         => $item['portfolio'],
                            'posts_per_page' => 1, // Set to 1 to retrieve only one post
                        );

                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();?>
                                <!--Portfolio Five Single Start-->
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="portfolio-five__single">
                                        <div class="portfolio-five__img">
                                            <?php the_post_thumbnail(); ?>
                                            <div class="portfolio-five__content">
                                                <p class="portfolio-five__sub-title"><?php
                                                $tags = get_the_terms(get_the_ID(), 'portfolio-tag');
                                                if (!empty($tags)) {
                                                    $output = '';
                                                    foreach ($tags as $tag) {
                                                        $output .= $tag->name . ',';
                                                    }
                                                    echo rtrim($output, ',');
                                                }
                                                ?></p>
                                                <h3 class="portfolio-five__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            </div>
                                            <div class="portfolio-five__logo">
                                                <a href="<?php the_post_thumbnail_url(); ?>" class="img-popup">
                                                    <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                        endif;
                        ?>
                        <!--Portfolio Five Single End-->
                    <?php endforeach; ?>
                </div>
                <!--Portfolio Five End-->
            <?php endif; ?>
        <?php
        endif;
    }
}

$widgets_manager->register(new Nilos_Portfolio());
