<?php
function nilos_iconpicker_admin_scripts() {
    wp_register_script('nilos-iconpicker', plugins_url( 'js/icon-picker.js', __FILE__ ), false, '1.0');
    wp_register_style('nilos-iconpicker', plugins_url( 'css/icon-picker.css', __FILE__ ), false, '1.0');
    wp_register_style('nilos-icon', plugins_url( 'css/nilosicon.css', __FILE__ ), false, '1.0');
}
add_action( 'admin_enqueue_scripts', 'nilos_iconpicker_admin_scripts' );


function nilos_menu_custom_icon_fields( $item_id, $item ) {
	$theme_locations = get_nav_menu_locations();
	$menuid = absint( get_user_option( 'nav_menu_recently_edited' ) );
	
	wp_enqueue_style( 'nilos-iconpicker');
	wp_enqueue_script('nilos-iconpicker');
	wp_enqueue_style( 'nilos-icon');

    $menu_item_iconfield = get_post_meta( $item_id, '_menu_item_iconfield', true );
	
    ?>
    <div class="et_menu_options">
        <div class="nilos-field-iconfield description description-wide">
            <label for="menu_item_iconfield-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Icon Field', 'nilos-core'  ); ?><br />
				<input type="text" class="widefat code edit-menu-item-custom nilosicon-picker" id="menu_item_iconfield-<?php echo esc_attr( $item_id ); ?>" name="menu_item_iconfield[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item_iconfield ); ?>"/>

            </label>
				<div class="nilos-iconsholder-wrapper">
                    <div class="nilos-iconsholder">
                        <input type="text" class="iconsearch" placeholder="<?php esc_attr_e('Search icon...','nilos-core'); ?>">
                    </div>
                </div>
        </div>
    </div>

    <?php

}
add_action( 'wp_nav_menu_item_custom_fields', 'nilos_menu_custom_icon_fields', 10, 2 );


function nilos_nav_icon_update( $menu_id, $menu_item_db_id ) {

    if (!empty($_REQUEST['menu_item_iconfield'])) {
        $iconfield_enabled_value = $_REQUEST['menu_item_iconfield'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_iconfield', $iconfield_enabled_value );
    }
}

add_action( 'wp_update_nav_menu_item', 'nilos_nav_icon_update', 10, 2 );

// mega menu functions
function nilos_mega_menu_custom_fields( $item_id, $item ) {

    $menu_item_elementor_template = get_post_meta( $item_id, '_menu_item_elementor_template', true );

    $post_args = [
        'post_status' => 'publish',
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    ];

    $pro_query = new \WP_Query($post_args);

    ?>
    
    <div class="et_menu_options">

        <div class="nilos-field-elementor-template description description-wide">
				<label for="menu_item_elementor-template-<?php echo esc_attr($item_id); ?>">
					<?php esc_html_e( 'Elementor Template', 'nilos-core'  ); ?><br />
					<select class="widefat code edit-menu-item-custom" id="menu_item_elementor_template-<?php echo esc_attr($item_id); ?>" 
                    name="menu_item_elementor_template[<?php echo esc_attr($item_id); ?>]">
                        <option value="-1"><?php echo esc_html__('Select A Template', 'nilos-core') ?></option>
						<?php while($pro_query->have_posts()) : $pro_query->the_post(); ?>

							<?php $selected = $menu_item_elementor_template == get_the_ID() ? "selected='selected'" : ''; ?>

							<option value="<?php echo esc_attr( get_the_ID() ) ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr( get_the_title() ) ?></option>

						<?php endwhile; ?>
					</select>
				</label>
        </div>

    </div>

    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'nilos_mega_menu_custom_fields', 10, 2 );


function nilos_mega_menu_update( $menu_id, $menu_item_db_id ) {

    if (!empty($_REQUEST['menu_item_elementor_template'])) {
        $iconfield_enabled_value = $_REQUEST['menu_item_elementor_template'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_elementor_template', $iconfield_enabled_value );
    }
}

add_action( 'wp_update_nav_menu_item', 'nilos_mega_menu_update', 10, 2 );