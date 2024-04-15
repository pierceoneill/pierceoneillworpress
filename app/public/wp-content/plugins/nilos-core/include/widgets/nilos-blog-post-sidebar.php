<?php
	/**
	 * NilosCore Sidebar Posts Image
	 *
	 *
	 * @author 		themedox
	 * @category 	Widgets
	 * @package 	NilosCore/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	*/

Class NILOS_Post_Sidebar_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct('nilos-latest-posts', 'Nilos Sidebar Posts Image', array(
			'description'	=> 'Latest Blog Post Widget by themedox'
		));
	}


	public function widget($args, $instance){
		extract($args);
		extract($instance);

 		echo $before_widget;
		?>

		<?php
			if($instance['title']):
				echo $before_title; ?>
					<?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
				<?php echo $after_title; ?>
			<?php endif; ?>
		
			<div class="nilos-sidebar-widget-content">
				<ul class="sidebar__post-list list-unstyled">
					<?php
						$q = new WP_Query( array(
							'post_type'     => 'post',
							'posts_per_page'=> ($instance['count']) ? $instance['count'] : '3',
							'order'			=> ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
							'orderby' => 'date'
						));

						if( $q->have_posts() ):
							while( $q->have_posts() ):
							$q->the_post();
					?>
					<li>
						<?php if(has_post_thumbnail()): ?>
						<div class="sidebar__post-image">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(90, 85)); ?></a>
						</div>
						<?php endif; ?>
						<div class="sidebar__post-content">
							<span class="sidebar__post-content-meta">
								<i class="fas fa-calendar-alt"></i>
								<?php the_time('F d, Y'); ?>
							</span>
							<h3>
								<a href="<?php the_permalink(); ?>"><?php print wp_trim_words(get_the_title(), 5, ''); ?></a>
							</h3>
						</div>
					</li>
					<?php endwhile; endif; ?>
				</ul>
			</div>
		<!-- latest post end -->

		<?php echo $after_widget; ?>

		<?php
	}



	public function form($instance){
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '3', 'nilos-core' );
		$posts_order = ! empty( $instance['posts_order'] ) ? $instance['posts_order'] : esc_html__( 'DESC', 'nilos-core' );
		$choose_style = ! empty( $instance['choose_style'] ) ? $instance['choose_style'] : esc_html__( 'style_1', 'nilos-core' );
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr( $count ); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if($posts_order === 'ASC'){ echo 'selected="selected"'; } ?>>ASC</option>
				<option value="DESC" <?php if($posts_order === 'DESC'){ echo 'selected="selected"'; } ?>>DESC</option>
			</select>
		</p>

	<?php }


}

add_action('widgets_init', function(){
	register_widget('NILOS_Post_Sidebar_Widget');
});
