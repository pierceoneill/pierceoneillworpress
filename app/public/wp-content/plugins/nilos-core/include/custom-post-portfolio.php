<?php 
class NILOSProjectPost 
{
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'init', array( $this, 'create_cat' ) );
		add_action( 'init', array( $this, 'create_tag' ) );
		add_filter( 'template_include', array( $this, 'portfolio_template_include' ) );
		add_action( 'wp_ajax_load_portfolio', array( $this, 'load_ajax_portfolios' ) );
	}

	public function load_ajax_portfolios(){
		if(isset($_REQUEST['security']) && !wp_verify_nonce($_REQUEST['security'], 'portfolio')){
			return;
		}
		$query = new WP_Query(array(
			'post_type'     => 'portfolio',
			'post_status'   => 'publish',
			'posts_per_page'=> 2,
			'paged'			=> $_REQUEST['page']
		));
		if($query->have_posts()): 
		while($query->have_posts()): $query->the_post(); 
		$terms = array();
		foreach(get_the_terms(get_the_ID(), 'portfolio-cat') as $term){
			$terms[]    = $term->slug;
		}?>
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
		<?php endwhile;
		wp_reset_postdata();
		endif; 
		die();
	}
	
	public function portfolio_template_include( $template ) {
		if ( is_singular( 'portfolio' ) ) {
			return $this->get_template( 'single-portfolio.php');
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
		$labels = array(
			'name'                  => esc_html_x( 'Portfolios', 'Post Type General Name', 'nilos-core' ),
			'singular_name'         => esc_html_x( 'Portfolio', 'Post Type Singular Name', 'nilos-core' ),
			'menu_name'             => esc_html__( 'Portfolio', 'nilos-core' ),
			'name_admin_bar'        => esc_html__( 'Portfolio', 'nilos-core' ),
			'archives'              => esc_html__( 'Item Archives', 'nilos-core' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'nilos-core' ),
			'all_items'             => esc_html__( 'All Items', 'nilos-core' ),
			'add_new_item'          => esc_html__( 'Add New Portfolio', 'nilos-core' ),
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
			'label'                 => esc_html__( 'Portfolio', 'nilos-core' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-index-card',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => 'nilos-portfolios',
				'with_front' => false
			),
		);

		register_post_type( 'portfolio', $args );
	}
	
	public function create_tag() {
		$labels = array(
			'name'                       => esc_html_x( 'Portfolio Tags', 'Taxonomy General Name', 'nilos-core' ),
			'singular_name'              => esc_html_x( 'Portfolio Tags', 'Taxonomy Singular Name', 'nilos-core' ),
			'menu_name'                  => esc_html__( 'Portfolio Tags', 'nilos-core' ),
			'all_items'                  => esc_html__( 'All Portfolio Tag', 'nilos-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'nilos-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'nilos-core' ),
			'new_item_name'              => esc_html__( 'New Portfolio Tag Name', 'nilos-core' ),
			'add_new_item'               => esc_html__( 'Add New Portfolio Tag', 'nilos-core' ),
			'edit_item'                  => esc_html__( 'Edit Portfolio Tag', 'nilos-core' ),
			'update_item'                => esc_html__( 'Update Portfolio Tag', 'nilos-core' ),
			'view_item'                  => esc_html__( 'View Portfolio Tag', 'nilos-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'nilos-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'nilos-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'nilos-core' ),
			'popular_items'              => esc_html__( 'Popular Portfolio Tag', 'nilos-core' ),
			'search_items'               => esc_html__( 'Search Portfolio Tag', 'nilos-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'nilos-core' ),
			'no_terms'                   => esc_html__( 'No Portfolio Tag', 'nilos-core' ),
			'items_list'                 => esc_html__( 'Portfolio Tag list', 'nilos-core' ),
			'items_list_navigation'      => esc_html__( 'Portfolio Tag list navigation', 'nilos-core' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('portfolio-tag','portfolio', $args );
	}

	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x( 'Portfolio Categories', 'Taxonomy General Name', 'nilos-core' ),
			'singular_name'              => esc_html_x( 'Portfolio Categories', 'Taxonomy Singular Name', 'nilos-core' ),
			'menu_name'                  => esc_html__( 'Portfolio Categories', 'nilos-core' ),
			'all_items'                  => esc_html__( 'All Portfolio Category', 'nilos-core' ),
			'parent_item'                => esc_html__( 'Parent Item', 'nilos-core' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'nilos-core' ),
			'new_item_name'              => esc_html__( 'New Portfolio Category Name', 'nilos-core' ),
			'add_new_item'               => esc_html__( 'Add New Portfolio Category', 'nilos-core' ),
			'edit_item'                  => esc_html__( 'Edit Portfolio Category', 'nilos-core' ),
			'update_item'                => esc_html__( 'Update Portfolio Category', 'nilos-core' ),
			'view_item'                  => esc_html__( 'View Portfolio Category', 'nilos-core' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'nilos-core' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'nilos-core' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'nilos-core' ),
			'popular_items'              => esc_html__( 'Popular Portfolio Category', 'nilos-core' ),
			'search_items'               => esc_html__( 'Search Portfolio Category', 'nilos-core' ),
			'not_found'                  => esc_html__( 'Not Found', 'nilos-core' ),
			'no_terms'                   => esc_html__( 'No Portfolio Category', 'nilos-core' ),
			'items_list'                 => esc_html__( 'Portfolio Category list', 'nilos-core' ),
			'items_list_navigation'      => esc_html__( 'Portfolio Category list navigation', 'nilos-core' ),
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

		register_taxonomy('portfolio-cat','portfolio', $args );
	}

}

new NILOSProjectPost();