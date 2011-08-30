<?php
/*
Plugin Name: Smart WYSIWYG Blocks Of Content
Plugin URI: http://cnjcbs.com/wordpress-plugins/smart-wysiwyg-blocks-of-content
Description: Adds a custom post type that can be easily inserted at multiple spots, including widgets. Easy way to create WYSIWYG widgets.
Author: Coen Jacobs
Version: 0.5
Author URI: http://cnjcbs.com
*/

function swboc_shortcode($atts) {
	extract(shortcode_atts(array(
		'id' => '',
	), $atts));
	
	$content = "";
	
	if($id != "")
	{
		$args = array(
			'post__in' => array($id),
			'post_type' => 'smartblock',
		);
		
		$swboc_posts = get_posts($args);
		
		foreach( $swboc_posts as $post ) :
			$content .= apply_filters('the_content', $post->post_content);
		endforeach;
	}
	
	return $content;
}

add_shortcode('smartblock', 'swboc_shortcode');

class SWBOC_Widget extends WP_Widget {
	function SWBOC_Widget() {
		$widget_ops = array( 'classname' => 'SWBOC_Widget', 'description' => 'Widget to show a Smart WYSIWYG Block of Content' );
		$this->WP_Widget( 'swboc', 'SWBOC Widget', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		
		$swboc_id = esc_attr($instance['swboc_id']);
		$swboc_title = esc_attr($instance['title']);
		
		echo $before_title.$swboc_title.$after_title;
		
		$args = array(
			'post__in' => array($swboc_id),
			'post_type' => 'smartblock',
		);
		
		$swboc_posts = get_posts($args);
		
		foreach( $swboc_posts as $post ) :
			echo apply_filters('the_content', $post->post_content);
		endforeach;

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$this->title = esc_attr($instance['title']);
		$updated_instance = $new_instance;
		return $updated_instance;
	}

	function form( $instance ) {
		$swboc_id = esc_attr($instance['swboc_id']);
		$swboc_title = esc_attr($instance['title']); ?>
		
		<label for="<?php echo $this->get_field_id('title'); ?>">Title:
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $swboc_title; ?>" /></label>
		
		<label for="<?php echo $this->get_field_id('swboc_id'); ?>">Smart block:
		<select class="widefat" id="<?php echo $this->get_field_id('swboc_id'); ?>" name="<?php echo $this->get_field_name('swboc_id'); ?>">
		
			<?php $args = 'post_type=smartblock&posts_per_page=-1&orderby=ID&order=ASC';
			
			$swboc_posts = get_posts($args);
			
			foreach( $swboc_posts as $post ) :
    			$currentID = $post->ID;
				
				if($currentID == $swboc_id)
					$extra = 'SELECTED';
				else
					$extra = '';
				
				echo '<option value="'.$currentID.'" '.$extra.'>'.$post->post_title.'</option>';
			endforeach; 
			
		?></select></label><?php
	}
}

add_action( 'widgets_init', create_function( '', "register_widget('SWBOC_Widget');" ) );

function create_swboc_type() {
	register_post_type( 'smartblock',
		array(
			'labels' => array(
				'name' => __( 'Smart Blocks' ),
				'singular_name' => __( 'Smart Block' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Smart Block' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Smart Block' ),
				'new_item' => __( 'New Smart Block' ),
				'view' => __( 'View Smart Block' ),
				'view_item' => __( 'View Smart Block' ),
				'search_items' => __( 'Search Smart Blocks' ),
				'not_found' => __( 'No Smart Blocks found' ),
				'not_found_in_trash' => __( 'No Smart Blocks found in Trash' ),
				'parent' => __( 'Parent Smart Block' ),
			),
			'public' => false,
			'description' => __( 'A Smart Block is a effective way to store content that you will use more than once.'),
			'show_ui' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'menu_position' => 20,
			'hierarchical' => false,
			'query_var' => true,
			'supports' => array( 'title', 'editor'),
			'can_export' => true,
		)
	);
}

add_action( 'init', 'create_swboc_type' );

function update_swboc_database()
{
	$db_version = get_option('swboc_database_version');
	
	if($db_version != '' || $db_version < 2)
	{
		global $wpdb;
		$wpdb->update( $wpdb->posts, array( 'post_type' => 'smartblock' ), array( 'post_type' => 'Smart Block' ) );
		update_option('swboc_database_version', 2);
	}
}

add_action('admin_init', 'update_swboc_database');

?>