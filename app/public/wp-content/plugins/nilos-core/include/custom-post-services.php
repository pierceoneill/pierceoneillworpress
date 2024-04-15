<?php 
class NilosServicesPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_filter( 'template_include', array( $this, 'services_template_include' ) );
	}
	
	public function services_template_include( $template ) {
		if ( is_singular( 'services' ) ) {
			return $this->get_template( 'single-services.php');
		}
		return $template;
	}
	
	public function get_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = NILOS_ADDONS_DIR . '/include/template/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}
	
	
	public function register_custom_post_type() {
		$nilos_serv_slug = get_theme_mod( 'nilos_serv_slug', __( 'services', 'nilos-core' ) );
		$labels = array(
			'name'                  => esc_html_x( 'Services', 'Post Type General Name', 'nilos-core' ),
			'singular_name'         => esc_html_x( 'Service', 'Post Type Singular Name', 'nilos-core' ),
			'menu_name'             => esc_html__( 'Service', 'nilos-core' ),
			'name_admin_bar'        => esc_html__( 'Service', 'nilos-core' ),
			'archives'              => esc_html__( 'Item Archives', 'nilos-core' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'nilos-core' ),
			'all_items'             => esc_html__( 'All Items', 'nilos-core' ),
			'add_new_item'          => esc_html__( 'Add New Service', 'nilos-core' ),
			'add_new'               => esc_html__( 'Add New', 'nilos-core' ),
			'new_item'              => esc_html__( 'New Item', 'nilos-core' ),
			'edit_item'             => esc_html__( 'Edit Item', 'nilos-core' ),
			'update_item'           => esc_html__( 'Update Item', 'nilos-core' ),
			'view_item'             => esc_html__( 'View Item', 'nilos-core' ),
			'search_items'          => esc_html__( 'Search Item', 'nilos-core' ),
			'not_found'             => esc_html__( 'Not found', 'nilos-core' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'nilos-core' ),
			'featured_image'        => esc_html__( 'Featured Image', 'nilos-core' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'nilos-core' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'nilos-core' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'nilos-core' ),
			'inserbt_into_item'     => esc_html__( 'Insert into item', 'nilos-core' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'nilos-core' ),
			'items_list'            => esc_html__( 'Items list', 'nilos-core' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'nilos-core' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'nilos-core' ),
		);

		$args   = array(
			'label'                 => esc_html__( 'Service', 'nilos-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-shield',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => $nilos_serv_slug,
				'with_front' => false
			),
		);

		register_post_type( 'services', $args );
	}
	
	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Service Categories', 'Taxonomy General Name', 'nilos-core' ),
			'singular_name'              => esc_html_x( 'Service Categories', 'Taxonomy Singular Name', 'nilos-core' ),
			'menu_name'                  => esc_html__( 'Service Categories', 'nilos-core' ),
			'all_items'                  => esc_html__( 'All Service Category', 'nilos-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'nilos-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'nilos-core' ),
			'new_item_name'              => esc_html__( 'New Service Category Name', 'nilos-core' ),
			'add_new_item'               => esc_html__( 'Add New Service Category', 'nilos-core' ),
			'edit_item'                  => esc_html__( 'Edit Service Category', 'nilos-core' ),
			'update_item'                => esc_html__( 'Update Service Category', 'nilos-core' ),
			'view_item'                  => esc_html__( 'View Service Category', 'nilos-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'nilos-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'nilos-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'nilos-core' ),
			'popular_items'              => esc_html__( 'Popular Service Category', 'nilos-core' ),
			'search_items'               => esc_html__( 'Search Service Category', 'nilos-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'nilos-core' ),
			'no_terms'                   => esc_html__( 'No Service Category', 'nilos-core' ),
			'items_list'                 => esc_html__( 'Service Category list', 'nilos-core' ),
			'items_list_navigation'      => esc_html__( 'Service Category list navigation', 'nilos-core' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('services-cat','services', $args );
	}

}

new NilosServicesPost();