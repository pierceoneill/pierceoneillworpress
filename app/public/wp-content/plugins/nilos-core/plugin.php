<?php

namespace NilosCore;

use NilosCore\PageSettings\Page_Settings;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class NILOS_Core_Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

	public function nilos_core_elementor_category($manager)
	{
		$manager->add_category(
			'nilos-core',
			array(
				'title' => esc_html__('Nilos Addons', 'nilos-core'),
				'icon' => 'eicon-banner',
			)
		);
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_register_script('nilos-core', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'nilos-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * nilos_enqueue_editor_scripts
	 */
	function nilos_enqueue_editor_scripts()
	{
		wp_enqueue_style('nilos-element-addons-editor', NILOS_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
	}





	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('nilos-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{
		// Its is now safe to include Widgets files
		foreach ($this->nilos_widget_list() as $widget_file_name) {
			require_once(NILOS_ELEMENTS_PATH . "/{$widget_file_name}.php");
		}
	}

	public function nilos_widget_list()
	{
		return [
			'menus',
			'blog-post',
			'nilos-social',
			'nilos-breadcrumb',
			'offcanvas',
			'nilos-list',
			'nilos-about-social',
			'nilos-scroll-text',
			'nilos-accordion',
			'nilos-faq-accordion',
			'nilos-portfolio-accordion',
			'nilos-about-img',
			'nilos-testimonials',
			'nilos-info-list',
			'nilos-headers',
			'nilos-gallery',
			'nilos-hero',
			'nilos-about',
			'nilos-services',
			'nilos-features',
			'nilos-brands',
			'nilos-portfolio',
			'menu-list',
			'nilos-footer',
			'video-popup',
			'quote',
			'impression',
			'get-in-touch',
			'lawyer-address',
			'nilos-blogs',
			'nilos-call-action',
			'nilos-skill',
			'nilos-team',
			'nilos-contact',
			'why-choose',
			'contact-box'
		];
	}

	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

	public function register_controls(Controls_Manager $controls_Manager)
	{
		include_once(NILOS_ADDONS_DIR . '/controls/nilos-gradient.php');
		$nilosgradient = 'NilosCore\Elementor\Controls\Group_Control_NILOSGradient';
		$controls_Manager->add_group_control($nilosgradient::get_type(), new $nilosgradient());

		include_once(NILOS_ADDONS_DIR . '/controls/nilos-bggradient.php');
		$nilosbggradient = 'NilosCore\Elementor\Controls\Group_Control_NILOSBGGradient';
		$controls_Manager->add_group_control($nilosbggradient::get_type(), new $nilosbggradient());
	}



	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);

		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		add_action('elementor/elements/categories_registered', [$this, 'nilos_core_elementor_category']);

		// Register custom controls
		add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
		add_action('elementor/controls/register_style_controls', [$this, 'register_style_rols']);

		add_action('elementor/editor/after_enqueue_scripts', [$this, 'nilos_enqueue_editor_scripts']);

		//register new icons
		add_filter('elementor/icons_manager/additional_tabs', [$this, 'add_custom_icon_font']);

		// add_filter('elementor/icons/add_fonts', [$this, 'add_custom_icon_font']);
	}

	public function add_custom_icon_font($tabs = array()){
		// Append new icons
		$icomoon_icons = array(
			'icon-video-camera',
			'icon-justice-scale',
			'icon-dots-menu',
			'icon-facebook',
			'icon-twitter',
			'icon-youtube',
			'icon-tik-tok',
			'icon-linkedin',
			'icon-telegram',
			'icon-call',
			'icon-open',
			'icon-computer',
			'icon-protractor',
			'icon-desk-lamp',
			'icon-portfolio',
			'icon-magic-wand',
			'icon-graphic-design',
			'icon-film',
			'icon-movie-clapper-open',
			'icon-pin'
		);

		$tabs['nilo-icons'] = array(
			'name' => 'nilo-icomoon',
			'label' => esc_html__('Nilos - Icomoon Icons', 'nilos-core'),
			'labelIcon' => 'nilos-icomoon',
			'prefix' => '',
			'displayPrefix' => 'nilos',
			'url' => get_parent_theme_file_uri() .'/assets/css/nilos-icons.css',
			'icons' => $icomoon_icons,
			'ver' => '1.0.0',
		);


		return $tabs;
	}
	

	
}

// Instantiate Plugin Class
NILOS_Core_Plugin::instance();
