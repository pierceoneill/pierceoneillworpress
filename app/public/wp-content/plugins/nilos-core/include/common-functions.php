<?php

namespace NilosCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use Elementor\REPEA;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use NilosCore\Elementor\Controls\Group_Control_NILOSBGGradient;
use NilosCore\Elementor\Controls\Group_Control_NILOSGradient;


if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Get All Post Types
 */
function nilos_get_post_types()
{

    $nilos_cpts = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'object');
    $nilos_exclude_cpts = array('elementor_library', 'attachment');
    foreach ($nilos_exclude_cpts as $exclude_cpt) {
        unset($nilos_cpts[$exclude_cpt]);
    }
    $post_types = array_merge($nilos_cpts);
    foreach ($post_types as $type) {
        $types[$type->name] = $type->label;
    }
    return $types;
}


/**
 * Get all types of post.
 */
function nilos_get_all_types_post($post_type)
{

    $posts_args = get_posts(array(
        'post_type' => $post_type,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => 20,
    ));

    $posts = array();

    if (!empty($posts_args) && !is_wp_error($posts_args)) {
        foreach ($posts_args as $post) {
            $posts[$post->ID] = $post->post_title;
        }
    }

    return $posts;
}

/**
 * Get all Pages
 */
if (!function_exists('nilos_get_all_pages')) {
    function nilos_get_all_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 50,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

/**
 * Post Settings Parameter
 */
function nilos_get_post_settings($settings)
{
    foreach ($settings as $key => $value) {
        $post_args[$key] = $value;
    }
    $post_args['post_status'] = 'publish';

    return $post_args;
}

/**
 * Get Post Thumbnail Size
 */
function nilos_get_thumbnail_sizes()
{
    $sizes = get_intermediate_image_sizes();
    foreach ($sizes as $s) {
        $ret[$s] = $s;
    }
    return $ret;
}

/**
 * Post Orderby Options
 */
function nilos_get_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    return $orderby;
}

/**
 * Get Post Categories
 */
function nilos_get_categories($taxonomy)
{
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ));
    $options = array();
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
    }
    return $options;
}

/**
 * Get all Pages
 */
if (!function_exists('nilos_get_pages')) {
    function nilos_get_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 20,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function nilos_get_allowed_html_desc($level = 'basic')
{
    if (!in_array($level, ['basic', 'intermediate', 'advance'])) {
        $level = 'basic';
    }

    $tags_str = '<' . implode('>,<', array_keys(nilos_get_allowed_html_tags($level))) . '>';
    return sprintf(__('This input field has support for the following HTML tags: %1$s', 'nilos-core'), '<code>' . esc_html($tags_str) . '</code>');
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function nilos_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [
            'class' => [],
        ],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];
    }

    if ($level === 'advance') {
        $allowed_html['ul'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['ol'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['li'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];

    }

    return $allowed_html;
}

// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function nilos_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),      
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(
        'class'   => array(),
      ),
      'h2'                     => array(
        'class'   => array(),
      ),
      'h3'                     => array(
        'class'   => array(),
      ),
      'h4'                     => array(
        'class'   => array(),
      ),
      'h5'                     => array(
        'class'   => array(),
      ),
      'h6'                     => array(
        'class'   => array(),
      ),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
        'class' => true,
        'aria-hidden' => true,
        'aria-labelledby' => true,
        'role' => true,
        'xmlns' => true,
        'width' => true,
        'height' => true,
        'fill' => true,
        'viewbox' => true, // <= Must be lower case!
    ),
    'g'     => array( 'fill' => true ),
    'title' => array( 'title' => true ),
    'path'  => array( 
                'd' => true, 
                'fill' => true, 
                'stroke' => true,
                'stroke-width' => true,
                'stroke-linecap' => true,
                'stroke-linejoin' => true, 

        ),
   );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
if( !function_exists('nilos_is_elementor_version')){
    function nilos_is_elementor_version($operator = '<', $version = '2.6.0')
    {
        return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
    }
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
if(!function_exists('nilos_render_icon')){
    function nilos_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
    {
        // Check if its already migrated
        $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
        // Check if its a new widget without previously selected icon using the old Icon control
        $is_new = empty($settings[$old_icon_id]);

        $attributes['aria-hidden'] = 'true';

        if (nilos_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
            \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
        } else {
            if (empty($attributes['class'])) {
                $attributes['class'] = $settings[$old_icon_id];
            } else {
                if (is_array($attributes['class'])) {
                    $attributes['class'][] = $settings[$old_icon_id];
                } else {
                    $attributes['class'] .= ' ' . $settings[$old_icon_id];
                }
            }
            // printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
        }
    }
}


/**
 * Get all types of post.
 *
 * @param string $post_type
 *
 * @return array
 */
function get_post_list($post_type = 'any')
{
    return get_query_post_list($post_type);
}


/**
 * @param string $post_type
 * @param int $limit
 * @param string $search
 * @return array
 */
function get_query_post_list($post_type = 'any', $limit = -1, $search = '')
{
    global $wpdb;
    $where = '';
    $data = [];

    if (-1 == $limit) {
        $limit = '';
    } elseif (0 == $limit) {
        $limit = "limit 0,1";
    } else {
        $limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
    }

    if ('any' === $post_type) {
        $in_search_post_types = get_post_types(['exclude_from_search' => false]);
        if (empty($in_search_post_types)) {
            $where .= ' AND 1=0 ';
        } else {
            $where .= " AND {$wpdb->posts}.post_type IN ('" . join("', '",
                    array_map('esc_sql', $in_search_post_types)) . "')";
        }
    } elseif (!empty($post_type)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
    }

    if (!empty($search)) {
        $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
    }

    $query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
    $results = $wpdb->get_results($query);
    if (!empty($results)) {
        foreach ($results as $row) {
            $data[$row->ID] = $row->post_title;
        }
    }
    return $data;
}


/**
 * Get all elementor page templates
 *
 * @param null $type
 *
 * @return array
 */
function get_elementor_templates($type = null)
{
    $options = [];

    if ($type) {
        $args = [
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ];
        $args['tax_query'] = [
            [
                'taxonomy' => 'elementor_library_type',
                'field' => 'slug',
                'terms' => $type,
            ],
        ];

        $page_templates = get_posts($args);

        if (!empty($page_templates) && !is_wp_error($page_templates)) {
            foreach ($page_templates as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }
    } else {
        $options = get_query_post_list('elementor_library');
    }

    return $options;
}



/**
 * Slugify
 */
if (!function_exists('nilos_slugify')){
    function nilos_slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;

    }
}



// Use the following code to get ride of autop (automatic <p> tag) and line breaking tag (<br> tag).
add_filter( 'wpcf7_autop_or_not', '__return_false' );


//get course url from different lms plugins
function eduker_header_search_url() {
    if(class_exists( 'SFWD_LMS' )) {
        return esc_url( home_url( '/courses' ) );
    }
    elseif(class_exists( 'LearnPress' )) {
        return esc_url( home_url( '/lp-courses' ) );
    }
    else {
        return esc_url( home_url( '/courses' ) );
    }
}


/**
 * Element Common Functions
 */
trait NilosCoreElementFunctions
{

    /**
     * @param null $control_id
     * @param string $control_name
     * @param string $selector
     */
    protected function nilos_icon_style($control_id = null, $control_name = 'Icon/Image Style', $selector = '.single-service .icon'){
        $this->start_controls_section(
            'nilos_'.$control_id.'_media_style',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_NILOSGradient::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_color',
                'label' => esc_html__('Color', 'nilos-core'),
                'selector' => '{{WRAPPER}} '. $selector,
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . 'area_background',
            [
                'label' => esc_html__('Background Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . '' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nilos_'.$control_id.'_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'nilos-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '. $selector .' ' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'nilos_'.$control_id.'_image_width',
            [
                'label' => esc_html__( 'Image/SVG Width', 'nilos-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '. $selector .' img, {{WRAPPER}} '. $selector .' svg' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'nilos_'.$control_id.'_image_height',
            [
                'label' => esc_html__( 'Image/SVG Height', 'nilos-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '. $selector .' img, {{WRAPPER}} '. $selector .' svg' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'nilos_'.$control_id.'_image_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'nilos-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} '. $selector .' img, {{WRAPPER}} '. $selector .' i, {{WRAPPER}} '. $selector .' svg' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'nilos_'.$control_id.'_image_padding',
            [
                'label' => esc_html__( 'Padding', 'nilos-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} '. $selector .' img, {{WRAPPER}} '. $selector .' i, {{WRAPPER}} '. $selector .' svg' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }



    /*
        
    ===========================================
    ========= NILOS Basic Style Controls =========
    ===========================================

    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID

    */

    protected function nilos_basic_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {


        $this->start_controls_section(
            'nilos_' . $control_id . '_styling',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_NILOSGradient::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_advs',
                'label' => esc_html__('Color', 'nilos-core'),
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_typography',
                'label' => esc_html__('Typography', 'nilos-core'),
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );
        $this->add_responsive_control(
            'nilos_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'nilos_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'nilos_' . $control_id . '_border_radius',
            [
                'label' => esc_html__('Border Radius', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'nilos_' . $control_id . '_border',
				'selector' => '{{WRAPPER}} ' . $control_selector,
			]
		);
        $this->end_controls_section();
    }

    /*
        
    =============================================
    ========= NILOS Section Style Controls =========
    =============================================

    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID

    */


    protected function nilos_section_style_controls($control_id = null, $control_name = null, $control_selector = null)
    {
        $this->start_controls_section(
            'nilos_' . $control_id . '_area_styling',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'nilos_' . $control_id . 'area_background',
                'label' => esc_html__('Background', 'nilos-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} ' . $control_selector,
            ]
        );
        $this->add_responsive_control(
            'nilos_' . $control_id . '_area_padding',
            [
                'label' => esc_html__('Padding', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'nilos_' . $control_id . '_area_margin',
            [
                'label' => esc_html__('Margin', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    /*
        
    ==========================================
    ========= NILOS Link Style Controls =========
    ==========================================

    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID

    */

    protected function nilos_link_controls_style($control_id = null, $control_name = null, $control_selector = null)
    {
        /**
         * Button One
         */
        $this->start_controls_section(
            'nilos_' . $control_id . '_button',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );


        $this->start_controls_tabs('nilos_' . $control_id . '_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('nilos_' . $control_id . '_btn_normal', ['label' => esc_html__('Normal', 'nilos-core')]);

        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_btn_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'nilos-core' ),
                'selector' => '{{WRAPPER}} ' . $control_selector . '',
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_border_style',
            [
                'label' => esc_html__('Border Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'nilos-core'),
                    'none' => esc_html__('None', 'nilos-core'),
                    'solid' => esc_html__('Solid', 'nilos-core'),
                    'double' => esc_html__('Double', 'nilos-core'),
                    'dotted' => esc_html__('Dotted', 'nilos-core'),
                    'dashed' => esc_html__('Dashed', 'nilos-core'),
                    'groove' => esc_html__('Groove', 'nilos-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nilos_' . $control_id . '_btn_normal_border_width',
            [
                'label' => esc_html__('Border Width', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );


        $this->add_control(
            'nilos_' . $control_id . '_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'nilos-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('nilos_' . $control_id . '_btn_hover', ['label' => esc_html__('Hover', 'nilos-core')]);

        $this->add_control(
            'nilos_' . $control_id . '_btn_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_btn_hover_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'nilos-core' ),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':hover',
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_hover_border_style',
            [
                'label' => esc_html__('Border Style', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default', 'nilos-core'),
                    'none' => esc_html__('None', 'nilos-core'),
                    'solid' => esc_html__('Solid', 'nilos-core'),
                    'double' => esc_html__('Double', 'nilos-core'),
                    'dotted' => esc_html__('Dotted', 'nilos-core'),
                    'dashed' => esc_html__('Dashed', 'nilos-core'),
                    'groove' => esc_html__('Groove', 'nilos-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'border-style: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nilos_' . $control_id . '_btn_hover_border_width',
            [
                'label' => esc_html__('Border Width', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':hover' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );




        $this->end_controls_tab();

        $this->end_controls_tabs();

                $this->add_responsive_control(
            'nilos_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nilos_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /*
        
    ==========================================
    ========= NILOS Input Style Controls =========
    ==========================================

    1. $control_id -> Tab ID
    2. $control_name -> Tab Title
    3. $control_selector -> Selector Class or ID

    */

    protected function nilos_input_controls_style($control_id = null, $control_name = null, $control_selector = '.nilos-input', $control_selector2 = '.nilos-textarea')
    {
        /**
         * Button One
         */
        $this->start_controls_section(
            'nilos_' . $control_id . '_button',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_typography',
                'selector' => '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '',
            ]
        );


        $this->start_controls_tabs('nilos_' . $control_id . '_button_tabs');

        // Normal State Tab
        $this->start_controls_tab('nilos_' . $control_id . '_btn_normal', ['label' => esc_html__('Normal', 'nilos-core')]);

        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_bg_color',
            [
                'label' => esc_html__('Background Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . '::placeholder, {{WRAPPER}} ' . $control_selector2 . '::placeholder' => 'color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->add_control(
            'nilos_' . $control_id . '_btn_normal_border_color',
            [
                'label' => esc_html__('Border Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'border-color: {{VALUE}} !important;;',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_btn_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'nilos-core' ),
                'selector' => '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '',
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'nilos-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ', {{WRAPPER}} ' . $control_selector2 . '' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        // Focus State Tab
        $this->start_controls_tab('nilos_' . $control_id . '_btn_hover', ['label' => esc_html__('Focus', 'nilos-core')]);

        $this->add_control(
            'nilos_' . $control_id . '_btn_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus' => 'background: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_btn_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'nilos-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus' => 'border-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nilos_' . $control_id . '_btn_hover_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'nilos-core' ),
                'selector' => '{{WRAPPER}} ' . $control_selector . ':focus,{{WRAPPER}} ' . $control_selector2 . ':focus',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

                $this->add_responsive_control(
            'nilos_' . $control_id . '_padding',
            [
                'label' => esc_html__('Padding', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ',{{WRAPPER}} ' . $control_selector2 . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nilos_' . $control_id . '_margin',
            [
                'label' => esc_html__('Margin', 'nilos-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} ' . $control_selector . ',{{WRAPPER}} ' . $control_selector2 . '' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

     /*
        
    ==========================================
    ========= NILOS Button Render Controls =========
    ==========================================

    1. $control_id -> Button ID
    2. $control_name -> Button Title
    3. $default_btn_text -> Button Text
    3. $default_btn_enable -> Enable / Disable

    */
    protected function nilos_button_render_controls($control_id = 'button', $control_name = 'Button', $control_condition = 'layout-1' ,  $default_btn_text = 'Read More', $default_btn_enable = 'yes')
    {

        $this->start_controls_section(
            'nilos_' . $control_id . '_button_group',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
                'condition' => [
                    'nilos_design_style' => $control_condition 
                ],
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_button_show',
            [
                'label' => esc_html__( 'Show Button', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nilos-core' ),
                'label_off' => esc_html__( 'Hide', 'nilos-core' ),
                'return_value' => 'yes',
                'default' => $default_btn_enable,
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_text',
            [
                'label' => esc_html__($control_name . ' Text', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => $default_btn_text,
                'title' => esc_html__('Enter button text', 'nilos-core'),
                'label_block' => true,
                'condition' => [
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_link_type',
            [
                'label' => esc_html__($control_name . ' Link Type', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_link',
            [
                'label' => esc_html__($control_name . ' link', 'nilos-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('htniloss://your-link.com', 'nilos-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'nilos_' . $control_id . '_link_type' => '1',
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_page_link',
            [
                'label' => esc_html__('Select ' . $control_name . ' Page', 'nilos-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => nilos_get_all_pages(),
                'condition' => [
                    'nilos_' . $control_id . '_link_type' => '2',
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

    }

    /*
        
    ====================================================
    ========= NILOS Section Title Render Controls =========
    ====================================================

    1. $control_id -> Section Title ID
    2. $control_name -> Button Title
    3. $default_btn_text -> Button Text
    3. $default_btn_enable -> Enable / Disable

    */
    protected function nilos_section_title_render_controls($control_id = null, $section_name = 'Section Title', $condition = ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8', 'layout-9', 'layout-10'] ,  $sub_title = 'Sub Title', $default_title = 'Your Section Title', $default_description = 'There are many variations of passages of Lorem Ipsum available, <br /> but the majority have suffered alteration.', $default_title_tag = 'h2', $default_align = 'text-left',  $enable_section_title_show_hide = true, $default_section_title_enable = 'yes')
    {
        $this->start_controls_section(
            'nilos_' . $control_id . '_section_title',
            [
                'label' => esc_html__($section_name, 'nilos-core'),
                'condition' => [
                    'nilos_design_style' => $condition
                ]
            ]
        );
        if ($enable_section_title_show_hide){
            $this->add_control(
                'nilos_' . $control_id . '_section_title_show',
                [
                    'label' => esc_html__( 'Section Title & Content', 'nilos-core' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'nilos-core' ),
                    'label_off' => esc_html__( 'Hide', 'nilos-core' ),
                    'return_value' => 'yes',
                    'default' => $default_section_title_enable,
                ]
            );
        }

        $this->add_control(
            'nilos_' . $control_id . '_sub_title',
            [
                'label' => esc_html__('Sub Title', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => $sub_title,
                'placeholder' => esc_html__('Type Before Heading Text', 'nilos-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_title',
            [
                'label' => esc_html__('Title', 'nilos-core'),
                'description' => nilos_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $default_title,
                'placeholder' => esc_html__('Type Heading Text', 'nilos-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'nilos-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'nilos-core'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'nilos-core'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'nilos-core'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'nilos-core'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'nilos-core'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'nilos-core'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => $default_title_tag,
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'nilos_' . $control_id . '_align',
            [
                'label' => esc_html__('Alignment', 'nilos-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-start' => [
                        'title' => esc_html__('Left', 'nilos-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'nilos-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-end' => [
                        'title' => esc_html__('Right', 'nilos-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => $default_align,
                'toggle' => false,
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Nilos Get Custom Posts
     */

    protected function get_all_posts( $post_type ){
        $args = [
            'post_type'     => $post_type,
            'numberposts'   => -1,
            'post_status'   => 'publish'   
        ];

        $options  = [];
        $posts = get_posts($args);
        foreach($posts as $post){
            $options[$post->ID] = $post->post_title;
        }

        return $options;
    }

    protected function nilos_link_controls_render($control_id = null, $control_name = 'nilos-btn' , $settings = null)
    {

        if ('2' == $settings['nilos_' . $control_id .'_link_type']) {
            $this->add_render_attribute('nilos-button-arg', 'href', get_permalink($settings['nilos_' . $control_id .'_page_link']));
            $this->add_render_attribute('nilos-button-arg', 'target', '_self');
            $this->add_render_attribute('nilos-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('nilos-button-arg', 'class', ''.$control_name.' nilos-el-btn');
        } else {
            if ( ! empty( $settings['nilos_' . $control_id .'_link']['url'] ) ) {
                $this->add_link_attributes( 'nilos-button-arg', $settings['nilos_' . $control_id .'_link'] );
                $this->add_render_attribute('nilos-button-arg', 'class', ''.$control_name.' nilos-el-btn');
            }
        }
       
    }



    /*
        
    ===========================================
    ========= NILOS Column Controls =========
    ===========================================

    1. $control_id -> ID
    2. $control_name -> Colum Title

    */

    protected function nilos_columns($control_id = 'columns_options', $control_name = 'Select Columns', $default_for_lg = '4', $default_for_md = '6', $default_for_sm = '6', $default_for_all = '12'){
        $this->start_controls_section(
            'nilos_' . $control_id . 'columns_section',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'nilos-core' ),
                    6 => esc_html__( '2 Columns', 'nilos-core' ),
                    4 => esc_html__( '3 Columns', 'nilos-core' ),
                    3 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'nilos-core' ),
                    2 => esc_html__( '6 Columns', 'nilos-core' ),
                    1 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_lg,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_laptop',
            [
                'label' => esc_html__( 'Columns for Large', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'nilos-core' ),
                    6 => esc_html__( '2 Columns', 'nilos-core' ),
                    4 => esc_html__( '3 Columns', 'nilos-core' ),
                    3 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'nilos-core' ),
                    2 => esc_html__( '6 Columns', 'nilos-core' ),
                    1 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_md,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'nilos-core' ),
                    6 => esc_html__( '2 Columns', 'nilos-core' ),
                    4 => esc_html__( '3 Columns', 'nilos-core' ),
                    3 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'nilos-core' ),
                    2 => esc_html__( '6 Columns', 'nilos-core' ),
                    1 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_sm,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'nilos-core' ),
                'description' => esc_html__( 'Screen width less than 767px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'nilos-core' ),
                    6 => esc_html__( '2 Columns', 'nilos-core' ),
                    4 => esc_html__( '3 Columns', 'nilos-core' ),
                    3 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'nilos-core' ),
                    2 => esc_html__( '6 Columns', 'nilos-core' ),
                    1 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    /*
        
    ===============================================
    ========= NILOS Column Carousel Controls =========
    ===============================================

    1. $control_id -> ID
    2. $control_name -> Colum Title

    */
    protected function nilos_columns_carousel($control_id = 'carousel_columns_options', $control_name = 'Select Columns', $default_for_xl = '4', $default_for_lg = '4', $default_for_md = '3', $default_for_sm = '2', $default_for_all = '1', $default_for_xs = '1'){
        $this->start_controls_section(
            'nilos_' . $control_id . 'columns_section',
            [
                'label' => esc_html__($control_name, 'nilos-core'),
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_for_xl_desktop',
            [
                'label' => esc_html__( 'Columns for Extra Large Desktop', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1920px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_xl,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_lg,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_md,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_sm,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'nilos-core' ),
                'description' => esc_html__( 'Screen width less than 767', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_for_xs_mobile',
            [
                'label' => esc_html__( 'Columns for Extra Small Mobile', 'nilos-core' ),
                'description' => esc_html__( 'Screen width less than 575px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => $default_for_xs,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    /*
        
    =============================================
    ========= NILOS BUtton Render Controls =========
    =============================================

    1. $control_id -> ID
    2. $control_name -> Button Title
    2. $control_condition -> Condition

    */

    protected function nilos_button_render($control_id = null, $control_name = 'box', $control_condition = 'layout-1'){
        $this->start_controls_section(
            'nilos_'.$control_id.'_btn',
                [
                  'label' => esc_html__( ''.$control_name.'', 'nilos-core' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'nilos_design_style' => $control_condition 
                  ],
                ]
           );
           $this->add_control(
               'nilos_'.$control_id.'_btn_switcher',
               [
                   'label' => esc_html__( 'Add '.$control_name.' link', 'nilos-core' ),
                   'type' => \Elementor\Controls_Manager::SWITCHER,
                   'label_on' => esc_html__( 'Yes', 'nilos-core' ),
                   'label_off' => esc_html__( 'No', 'nilos-core' ),
                   'return_value' => 'yes',
                   'default' => 'yes',
                   'separator' => 'before',
               ]
           );
           $this->add_control(
               'nilos_'.$control_id.'_btn_text',
               [
                   'label' => esc_html__('Button Text', 'nilos-core'),
                   'type' => Controls_Manager::TEXT,
                   'default' => esc_html__('Button Text', 'nilos-core'),
                   'title' => esc_html__('Enter button text', 'nilos-core'),
                   'label_block' => true,
                   'condition' => [
                       'nilos_'.$control_id.'_btn_switcher' => 'yes'
                   ],
               ]
           );
           $this->add_control(
               'nilos_'.$control_id.'_btn_link_type',
               [
                   'label' => esc_html__( ''.$control_name.' Link Type', 'nilos-core' ),
                   'type' => \Elementor\Controls_Manager::SELECT,
                   'options' => [
                       '1' => 'Custom Link',
                       '2' => 'Internal Page',
                   ],
                   'default' => '1',
                   'condition' => [
                       'nilos_'.$control_id.'_btn_switcher' => 'yes'
                   ]
               ]
           );
           $this->add_control(
               'nilos_'.$control_id.'_btn_link',
               [
                   'label' => esc_html__( ''.$control_name.' Link link', 'nilos-core' ),
                   'type' => \Elementor\Controls_Manager::URL,
                   'dynamic' => [
                       'active' => true,
                   ],
                   'placeholder' => esc_html__( 'htniloss://your-link.com', 'nilos-core' ),
                   'show_external' => true,
                   'default' => [
                       'url' => '#',
                       'is_external' => false,
                       'nofollow' => false,
                   ],
                   'condition' => [
                       'nilos_'.$control_id.'_btn_link_type' => '1',
                       'nilos_'.$control_id.'_btn_switcher' => 'yes',
                   ]
               ]
           );
           $this->add_control(
               'nilos_'.$control_id.'_btn_page_link',
               [
                   'label' => esc_html__( 'Select '.$control_name.' Link Page', 'nilos-core' ),
                   'type' => \Elementor\Controls_Manager::SELECT2,
                   'label_block' => true,
                   'options' => nilos_get_all_pages(),
                   'condition' => [
                       'nilos_'.$control_id.'_btn_link_type' => '2',
                       'nilos_'.$control_id.'_btn_switcher' => 'yes',
                   ]
               ]
           );
   
           $this->end_controls_section();
    }

    protected function nilos_query_controls($control_id = null, $control_name = null, $default_title_num = 6, $default_content_limit = '10', $post_type = 'any', $taxonomy = 'category', $posts_per_page = '6', $offset = '0', $orderby = 'date', $order = 'desc')
    {

        $this->start_controls_section(
            'nilos-core' . $control_id . '_query',
            [
                'label' => sprintf(esc_html__('%s Query', 'nilos-core'), $control_name),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'nilos-core'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'nilos-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => $posts_per_page,
            ]
        );
        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'nilos-core'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'nilos-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => nilos_get_categories($taxonomy),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'nilos-core'),
                'description' => esc_html__('Select a category to exclude', 'nilos-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => nilos_get_categories($taxonomy),
                'label_block' => true
            ]
        );
        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'nilos-core'),
                'type' => Controls_Manager::SELECT2,
                'options' => nilos_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'nilos-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => $offset,
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => nilos_get_orderby_options(),
                'default' => $orderby,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'nilos-core' ),
                    'desc' 	=> esc_html__( 'Descending', 'nilos-core' )
                ],
                'default' => $order,

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'nilos-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'nilos-core' ),
                'label_off' => esc_html__( 'No', 'nilos-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nilos_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'nilos-core'),
                'description' => esc_html__('Set how many word you want to displa!', 'nilos-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => $default_title_num,
            ]
        );

        if ($post_type !== 'product') {
            $this->add_control(
                'nilos_post_content',
                [
                    'label' => __('Content', 'nilos-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'nilos-core'),
                    'label_off' => __('Hide', 'nilos-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'nilos_post_content_limit',
                [
                    'label' => __('Content Limit', 'nilos-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => $default_content_limit,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'nilos_post_content' => 'yes',

                    ]
                ]
            );
            $this->add_control(
                'nilos_post_button',
                [
                    'label' => __('Blog Button', 'nilos-core'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => __('Read More', 'nilos-core'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );
        }


        $this->end_controls_section();

    }

    protected function nilos_post_layout($control_id = null, $control_name = null){
        $this->start_controls_section(
            'nilos_'. $control_id .'_',
            [
                'label' => sprintf(esc_html__('%s - Layout', 'nilos-core'), $control_name),
            ]
        );
        $this->add_control(
            'nilos_design_style',
            [
                'label' => esc_html__('Select Layout', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Blog Slider 1', 'nilos-core'),
                    'layout-2' => esc_html__('Blog Box', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'nilos_'. $control_id .'__dots',
            [
                'label' => esc_html__('Dots?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'nilos-core'),
                'label_off' => esc_html__('Hide', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-100',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__arrow',
            [
                'label' => esc_html__('Arrow Icons?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'nilos-core'),
                'label_off' => esc_html__('Hide', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-100',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__infinite',
            [
                'label' => esc_html__('Infinite?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nilos-core'),
                'label_off' => esc_html__('No', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-100',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__autoplay',
            [
                'label' => esc_html__('Autoplay?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nilos-core'),
                'label_off' => esc_html__('No', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-100',
                ),
            ]
        );        
        $this->add_control(
            'nilos_'. $control_id .'__autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '2500',
                'title' => esc_html__('Enter autoplay speed', 'nilos-core'),
                'label_block' => true,
                'condition' => array(
                    'nilos_post__autoplay' => 'yes',
                    'nilos_design_style' => 'layout-100',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__filter',
            [
                'label' => esc_html__('Filter?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nilos-core'),
                'label_off' => esc_html__('No', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-100',
                ),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'nilos-post-thumb',
            ]
        );

        $this->end_controls_section();
    }

    protected function nilos_post_layout_2($control_id = null, $control_name = null){
        $this->start_controls_section(
            'nilos_'. $control_id .'_',
            [
                'label' => sprintf(esc_html__('%s - Layout', 'nilos-core'), $control_name),
            ]
        );
        $this->add_control(
            'nilos_design_style',
            [
                'label' => esc_html__('Select Layout', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Blog Grid', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
         'enable_sidebar',
            [
                'label'        => esc_html__( 'Enable Sidebar ?', 'nilos-core' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'nilos-core' ),
                'label_off'    => esc_html__( 'Hide', 'nilos-core' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );


        $this->add_control(
            'nilos_'. $control_id .'__pagination',
            [
                'label' => esc_html__( 'Pagination', 'nilos-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nilos-core' ),
                'label_off' => esc_html__( 'Hide', 'nilos-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'nilos_'. $control_id .'__height',
            [
                'label' => esc_html__( 'Height', 'nilos-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nilos-project-img img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__dots',
            [
                'label' => esc_html__('Dots?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'nilos-core'),
                'label_off' => esc_html__('Hide', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__arrow',
            [
                'label' => esc_html__('Arrow Icons?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'nilos-core'),
                'label_off' => esc_html__('Hide', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__infinite',
            [
                'label' => esc_html__('Infinite?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nilos-core'),
                'label_off' => esc_html__('No', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__autoplay',
            [
                'label' => esc_html__('Autoplay?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nilos-core'),
                'label_off' => esc_html__('No', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-2',
                ),
            ]
        );        
        $this->add_control(
            'nilos_'. $control_id .'__autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '2500',
                'title' => esc_html__('Enter autoplay speed', 'nilos-core'),
                'label_block' => true,
                'condition' => array(
                    'nilos_post__autoplay' => 'yes',
                    'nilos_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__filter',
            [
                'label' => esc_html__('Filter?', 'nilos-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'nilos-core'),
                'label_off' => esc_html__('No', 'nilos-core'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'nilos_design_style' => 'layout-3',
                ),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'nilos-post-thumb',
            ]
        );
       
        $this->end_controls_section();
    }

    protected function nilos_post_carousel_col($control_id = null, $control_name = null){
        $this->start_controls_section(
            'nilos_'. $control_id .'__slider_columns_section',
            [
                'label' => sprintf(esc_html__('%s - Columns for Carousel', 'nilos-core'), $control_name),
            ]
        );

        $this->add_control(
            'nilos_'. $control_id .'__slider_for_xl_desktop',
            [
                'label' => esc_html__( 'Columns for Extra Large Desktop', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1920px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__slider_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__slider_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__slider_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'nilos-core' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => '2',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__slider_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'nilos-core' ),
                'description' => esc_html__( 'Screen width less than 767', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'nilos_'. $control_id .'__slider_for_xs_mobile',
            [
                'label' => esc_html__( 'Columns for Extra Small Mobile', 'nilos-core' ),
                'description' => esc_html__( 'Screen width less than 575px', 'nilos-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'nilos-core' ),
                    2 => esc_html__( '2 Columns', 'nilos-core' ),
                    3 => esc_html__( '3 Columns', 'nilos-core' ),
                    4 => esc_html__( '4 Columns', 'nilos-core' ),
                    5 => esc_html__( '5 Columns', 'nilos-core' ),
                    6 => esc_html__( '6 Columns', 'nilos-core' ),
                    7 => esc_html__( '7 Columns', 'nilos-core' ),
                    8 => esc_html__( '8 Columns', 'nilos-core' ),
                    9 => esc_html__( '9 Columns', 'nilos-core' ),
                    10 => esc_html__( '10 Columns', 'nilos-core' ),
                    11 => esc_html__( '10 Columns', 'nilos-core' ),
                    12 => esc_html__( '12 Columns', 'nilos-core' ),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function nilos_icon_controls($control_id = null, $control_condition = 'layout-2'){

        if($control_condition){
            $this->add_control(
                'nilos_'. $control_id .'_icon_type',
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
                        'nilos_design_style' => $control_condition 
                      ],
                ]
            );
            $this->add_control(
                'nilos_'. $control_id .'_icon_svg',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'nilos-core'),
                    'condition' => [
                        'nilos_'. $control_id .'_icon_type' => 'svg'
                    ]
                ]
            );
    
            $this->add_control(
                'nilos_'. $control_id .'_icon_image',
                [
                    'label' => esc_html__('Upload Icon Image', 'nilos-core'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        // 'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'nilos_'. $control_id .'_icon_type' => 'image',
                    ]
                ]
            );
    
            if (nilos_is_elementor_version('<', '2.6.0')) {
                $this->add_control(
                    'nilos_'. $control_id .'_icon',
                    [
                        'show_label' => false,
                        'type' => Controls_Manager::ICON,
                        'label_block' => true,
                        'default' => 'fa fa-star',
                        'condition' => [
                            'nilos_'. $control_id .'_icon_type' => 'icon'
                        ]
                    ]
                );
            } else {
                $this->add_control(
                    'nilos_'. $control_id .'_selected_icon',
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
                            'nilos_'. $control_id .'_icon_type' => 'icon'
                        ]
                    ]
                );
            }

        }else{
            $this->add_control(
                'nilos_'. $control_id .'_icon_type',
                [
                    'label' => esc_html__('Select Icon Type', 'nilos-core'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'image',
                    'options' => [
                        'image' => esc_html__('Image', 'nilos-core'),
                        'icon' => esc_html__('Icon', 'nilos-core'),
                        'svg' => esc_html__('SVG', 'nilos-core'),
                    ],
                ]
            );
            $this->add_control(
                'nilos_'. $control_id .'_icon_svg',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'nilos-core'),
                    'condition' => [
                        'nilos_'. $control_id .'_icon_type' => 'svg'
                    ]
                ]
            );
    
            $this->add_control(
                'nilos_'. $control_id .'_icon_image',
                [
                    'label' => esc_html__('Upload Icon Image', 'nilos-core'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        // 'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'nilos_'. $control_id .'_icon_type' => 'image',
                    ]
                ]
            );
    
            if (nilos_is_elementor_version('<', '2.6.0')) {
                $this->add_control(
                    'nilos_'. $control_id .'_icon',
                    [
                        'show_label' => false,
                        'type' => Controls_Manager::ICON,
                        'label_block' => true,
                        'default' => 'fa fa-star',
                        'condition' => [
                            'nilos_'. $control_id .'_icon_type' => 'icon'
                        ]
                    ]
                );
            } else {
                $this->add_control(
                    'nilos_'. $control_id .'_selected_icon',
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
                            'nilos_'. $control_id .'_icon_type' => 'icon'
                        ]
                    ]
                );
            }
        }

    }

    protected function nilos_price_currency($control_id = null, $control_name = 'Silver Plan'){

        $this->add_control(
            ''. $control_id .'_title',
         [
            'label'       => esc_html__( 'Price Title', 'nilos-core' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default' => sprintf(esc_html__('%s', 'nilos-core'), $control_name),
            'placeholder' => esc_html__( 'Your title here', 'nilos-core' ),
         ]
        );

        $this->add_control(
            ''. $control_id .'_desc',
         [
           'label'       => esc_html__( 'Price Description', 'nilos-core' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Free forever,! No credit card required.', 'nilos-core' ),
           'placeholder' => esc_html__( 'Your Description Here', 'nilos-core' ),
         ]
        );

        $this->add_control(
            ''. $control_id .'_currency',
            [
                'label' => __('Currency', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'nilos-core'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'nilos-core'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'nilos-core'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'nilos-core'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'nilos-core'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'nilos-core'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'nilos-core'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'nilos-core'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'nilos-core'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'nilos-core'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'nilos-core'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'nilos-core'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'nilos-core'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'nilos-core'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'nilos-core'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'nilos-core'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'nilos-core'),
                    'custom' => __('Custom', 'nilos-core'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            ''. $control_id .'_currency_custom',
            [
                'label' => __('Custom Symbol', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            ''. $control_id .'_price',
            [
                'label' => __('Price', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            ''. $control_id .'_period',
            [
                'label' => __('Period', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Per Month', 'nilos-core'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
    }

    protected function nilos_price_btn_controls($control_id = 'button', $control_name = 'Button', $default_btn_text = 'Read More', $default_btn_enable = 'yes')
    {

        $this->add_control(
            'nilos_' . $control_id . '_button_show',
            [
                'label' => esc_html__( 'Show Button', 'nilos-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'nilos-core' ),
                'label_off' => esc_html__( 'Hide', 'nilos-core' ),
                'return_value' => 'yes',
                'default' => $default_btn_enable,
            ]
        );

        $this->add_control(
            'nilos_' . $control_id . '_text',
            [
                'label' => esc_html__($control_name . ' Text', 'nilos-core'),
                'type' => Controls_Manager::TEXT,
                'default' => $default_btn_text,
                'title' => esc_html__('Enter button text', 'nilos-core'),
                'label_block' => true,
                'condition' => [
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_link_type',
            [
                'label' => esc_html__($control_name . ' Link Type', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_link',
            [
                'label' => esc_html__($control_name . ' link', 'nilos-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('htniloss://your-link.com', 'nilos-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'nilos_' . $control_id . '_link_type' => '1',
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'nilos_' . $control_id . '_page_link',
            [
                'label' => esc_html__('Select ' . $control_name . ' Page', 'nilos-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => nilos_get_all_pages(),
                'condition' => [
                    'nilos_' . $control_id . '_link_type' => '2',
                    'nilos_' . $control_id . '_button_show' => 'yes'
                ]
            ]
        );
    }

    protected function nilos_product_layout($control_id = null, $control_name = null){
        $this->start_controls_section(
            'nilos_'. $control_id .'_',
            [
                'label' => sprintf(esc_html__('%s - Layout', 'nilos-core'), $control_name),
            ]
        );
        $this->add_control(
            'nilos_design_style',
            [
                'label' => esc_html__('Select Layout', 'nilos-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Product Offer', 'nilos-core'),
                    'layout-2' => esc_html__('Product Simple', 'nilos-core'),
                    'layout-3' => esc_html__('Product Arrival', 'nilos-core'),
                    'layout-4' => esc_html__('Product SM List', 'nilos-core'),
                    'layout-5' => esc_html__('Product Slider Trending', 'nilos-core'),
                    'layout-6' => esc_html__('Product Weeks Featured', 'nilos-core'),
                ],
                'default' => 'layout-1',
            ]
        );


        if(false){
            $this->add_control(
                'nilos_'. $control_id .'__dots',
                [
                    'label' => esc_html__('Dots?', 'nilos-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'nilos-core'),
                    'label_off' => esc_html__('Hide', 'nilos-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'nilos_design_style' => ['layout-1']
                    ]
                    
                ]
            );
    
            $this->add_control(
            'nilos_'. $control_id .'__slides_per_view',
             [
                'label'       => esc_html__( 'Slides Per View', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '3', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Number', 'nilos-core' ),
                'condition' => [
                    'nilos_design_style' => ['layout-1']
                ]
             ]
            );
            $this->add_control(
            'nilos_'. $control_id .'__slides_per_view_lg',
             [
                'label'       => esc_html__( 'Slides Per View In LG (992px)', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '2', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Number', 'nilos-core' ),
                'condition' => [
                    'nilos_design_style' => ['layout-1']
                ]
             ]
            );
            $this->add_control(
            'nilos_'. $control_id .'__slides_per_view_md',
             [
                'label'       => esc_html__( 'Slides Per View In MD (768px)', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '2', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Number', 'nilos-core' ),
                'condition' => [
                    'nilos_design_style' => ['layout-1']
                ]
             ]
            );
            $this->add_control(
            'nilos_'. $control_id .'__slides_per_view_sm',
             [
                'label'       => esc_html__( 'Slides Per View In SM (576px)', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '1', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Number', 'nilos-core' ),
                'condition' => [
                    'nilos_design_style' => ['layout-1']
                ]
             ]
            );
            $this->add_control(
            'nilos_'. $control_id .'__slides_per_view_xs',
             [
                'label'       => esc_html__( 'Slides Per View In XS (0-575px)', 'nilos-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '1', 'nilos-core' ),
                'placeholder' => esc_html__( 'Your Number', 'nilos-core' ),
                'condition' => [
                    'nilos_design_style' => ['layout-1']
                ]
             ]
            );
            $this->add_control(
                'nilos_'. $control_id .'__arrow',
                [
                    'label' => esc_html__('Arrow Icons?', 'nilos-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'nilos-core'),
                    'label_off' => esc_html__('Hide', 'nilos-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'nilos_design_style' => ['layout-1']
                    ]
                ]
            );
            $this->add_control(
                'nilos_'. $control_id .'__infinite',
                [
                    'label' => esc_html__('Infinite?', 'nilos-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'nilos-core'),
                    'label_off' => esc_html__('No', 'nilos-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'nilos_design_style' => ['layout-1']
                    ]
                ]
            );
            $this->add_control(
                'nilos_'. $control_id .'__autoplay',
                [
                    'label' => esc_html__('Autoplay?', 'nilos-core'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'nilos-core'),
                    'label_off' => esc_html__('No', 'nilos-core'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'nilos_design_style' => ['layout-1']
                    ]
                ]
            );        
            $this->add_control(
                'nilos_'. $control_id .'__autoplay_speed',
                [
                    'label' => esc_html__('Autoplay Speed', 'nilos-core'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '2500',
                    'title' => esc_html__('Enter autoplay speed', 'nilos-core'),
                    'label_block' => true,
                    'condition' => [
                        'nilos_design_style' => ['layout-1']
                    ]
                ]
            );
        }
        
        $this->end_controls_section();
    }

    protected function nilos_product_badges(){
        $this->start_controls_section(
            'nilos_product_badge_sec',
               [
                 'label' => esc_html__( 'Badge Controls', 'nilos-core' ),
                 'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               ]
           );
           
           $this->add_control(
            'product_trending_badge_enable',
              [
                 'label'        => esc_html__( 'Enable Trending Badge ?', 'nilos-core' ),
                 'type'         => \Elementor\Controls_Manager::SWITCHER,
                 'label_on'     => esc_html__( 'Show', 'nilos-core' ),
                 'label_off'    => esc_html__( 'Hide', 'nilos-core' ),
                 'return_value' => 'yes',
                 'default'      => 'no',
              ]
           );
      
      
           $this->add_control(
               'product_badge_type',
              [
                 'label'   => esc_html__( 'Product Badge Type', 'nilos-core' ),
                 'type' => \Elementor\Controls_Manager::SELECT,
                 'options' => [
                       'sales'  => esc_html__( 'Based On Sales', 'nilos-core' ),
                       'rating'  => esc_html__( 'Based On Rating', 'nilos-core' ),
                       'review'  => esc_html__( 'Based On Review', 'nilos-core' ),
                       'views'  => esc_html__( 'Based On Views', 'nilos-core' ),
                    ],
                 'default' => 'sales',
                 'condition' => [
                    'product_trending_badge_enable' => 'yes'
                 ]
              ]
           );
      
           $this->add_control(
           'sale_count_to_show',
            [
              'label'       => esc_html__( 'Sales Count', 'nilos-core' ),
              'type'        => \Elementor\Controls_Manager::TEXT,
              'default'     => esc_html__( '10', 'nilos-core' ),
              'placeholder' => esc_html__( 'Count Number', 'nilos-core' ),
              'description' => esc_html__( 'How many sales are required to show it', 'nilos-core' ),
              'condition' => [
                 'product_badge_type' => 'sales',
                 'product_trending_badge_enable' => 'yes'
              ]
            ]
           );
           $this->add_control(
           'rating_count_to_show',
            [
              'label'       => esc_html__( 'Rating Count', 'nilos-core' ),
              'type'        => \Elementor\Controls_Manager::TEXT,
              'default'     => esc_html__( '5', 'nilos-core' ),
              'placeholder' => esc_html__( 'Rating Count Number', 'nilos-core' ),
              'description' => esc_html__( 'How many ratings are required to show it', 'nilos-core' ),
              'condition' => [
                 'product_badge_type' => 'rating',
                 'product_trending_badge_enable' => 'yes'
              ]
            ]
           );
           $this->add_control(
           'review_count_to_show',
            [
              'label'       => esc_html__( 'Reviews Count', 'nilos-core' ),
              'type'        => \Elementor\Controls_Manager::TEXT,
              'default'     => esc_html__( '3', 'nilos-core' ),
              'placeholder' => esc_html__( 'Review Count', 'nilos-core' ),
              'description' => esc_html__( 'How many reviews are required to show it', 'nilos-core' ),
              'condition' => [
                 'product_badge_type' => 'review',
                 'product_trending_badge_enable' => 'yes'
              ]
            ]
           );
           $this->add_control(
           'view_count_to_show',
            [
              'label'       => esc_html__( 'Views Count', 'nilos-core' ),
              'type'        => \Elementor\Controls_Manager::TEXT,
              'default'     => esc_html__( '10', 'nilos-core' ),
              'placeholder' => esc_html__( 'Views Count', 'nilos-core' ),
              'description' => esc_html__( 'How many views are required to show it', 'nilos-core' ),
              'condition' => [
                 'product_badge_type' => 'views',
                 'product_trending_badge_enable' => 'yes'
              ]
            ]
           );
           
      
           $this->add_control(
              'product_hot_badge_enable',
                 [
                    'label'        => esc_html__( 'Enable Hot Badge?', 'nilos-core' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'nilos-core' ),
                    'label_off'    => esc_html__( 'Hide', 'nilos-core' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                 ]
              );
              // for hot badge
              $this->add_control(
                 'date_diff_to_show',
                 [
                    'label'       => esc_html__( 'Date Count', 'nilos-core' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( '10', 'nilos-core' ),
                    'placeholder' => esc_html__( 'Date Count', 'nilos-core' ),
                    'description' => esc_html__( 'How many days from uploaded are going to showing it.', 'nilos-core' ),
                    'condition' => [
                     'product_hot_badge_enable' => 'yes'
                    ]
                 ]
              );
           
           
           $this->end_controls_section();
    }

    protected function nilos_post_result_count($query, $settings = null){


        $total      = $query->found_posts;
        $per_page   = $settings['posts_per_page'];

        if (get_query_var('paged')) {
           $current = get_query_var('paged');
       } else if (get_query_var('page')) {
           $current = get_query_var('page');
       } else {
           $current = 1;
       }

        // var_dump($current);
        if ( 1 === intval( $total ) ) {
              _e( 'Showing the single result', 'nilos-core' );
        } elseif ( $total <= $per_page || -1 === $per_page ) {
              /* translators: %d: total results */
              printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'nilos-core' ), $total );
        } else {
              $first = ( $per_page * $current ) - $per_page + 1;
              $last  = min( $total, $per_page * $current );

              // var_dump($first, $last);
              /* translators: 1: first result 2: last result 3: total results */
              printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'nilos-core' ), $first, $last, $total );
        }

	
    }

}  


/**
 * nilos_Helper
 */
class NILOS_Helper
{

    public static function get_query_args($posttype = 'post', $taxonomy = 'category', $settings = null)
    {

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'  => $taxonomy,
                    'field'     => 'slug',
                    'terms'     => $exclude_category_list_value,
                    'operator'  => 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'  => $taxonomy,
                    'field'     => 'slug',
                    'terms'     => $category_list_value,
                    'operator'  => 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }



        return $args;
    }
}