<?php
/*
Plugin Name: Smart WYSIWYG Blocks Of Content
Plugin URI: http://cnjcbs.com/wordpress-plugins/smart-wysiwyg-blocks-of-content
Description: Adds a custom post type that can be easily inserted at multiple spots, including widgets. Easy way to create WYSIWYG widgets.
Author: Coen Jacobs
Version: 0.5
Author URI: http://cnjcbs.com
*/

function swboc_shortcode( $atts ) {
	extract( shortcode_atts( array (
		'id' => '',
	), $atts ) );
	
	$content = "";
	
	if ( $id != "" ) {
		$args = array (
			'post__in'  => array ( $id ),
			'post_type' => 'smartblock',
		);
		
		$swboc_posts = get_posts( $args );
		
		foreach ( $swboc_posts as $post ) {
			$content .= apply_filters( 'the_content', $post->post_content );
		}
	}
	
	return $content;
}

add_shortcode( 'smartblock', 'swboc_shortcode' );

include( 'includes/class-swboc-widget.php' );

add_action( 'widgets_init', create_function( '', "register_widget( 'SWBOC_Widget' );" ) );

function create_swboc_type() {
	register_post_type( 'smartblock',
		array(
			'labels' => array(
				'name'               => __( 'Smart Blocks' ),
				'singular_name'      => __( 'Smart Block' ),
				'add_new'            => __( 'Add New' ),
				'add_new_item'       => __( 'Add New Smart Block' ),
				'edit'               => __( 'Edit' ),
				'edit_item'          => __( 'Edit Smart Block' ),
				'new_item'           => __( 'New Smart Block' ),
				'view'               => __( 'View Smart Block' ),
				'view_item'          => __( 'View Smart Block' ),
				'search_items'       => __( 'Search Smart Blocks' ),
				'not_found'          => __( 'No Smart Blocks found' ),
				'not_found_in_trash' => __( 'No Smart Blocks found in Trash' ),
				'parent'             => __( 'Parent Smart Block' ),
			),
			'public'              => false,
			'description'         => __( 'A Smart Block is an effective way to store content that you will use more than once.' ),
			'show_ui'             => true,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'menu_position'       => 20,
			'hierarchical'        => false,
			'query_var'           => true,
			'supports'            => array ( 'title', 'editor'),
			'can_export'          => true,
		)
	);
}

add_action( 'init', 'create_swboc_type' );

function update_swboc_database() {
	$db_version = get_option( 'swboc_database_version' );
	
	if ( $db_version != '' || $db_version < 2 ) {
		global $wpdb;
		$wpdb->update( $wpdb->posts, array( 'post_type' => 'smartblock' ), array( 'post_type' => 'Smart Block' ) );
		update_option( 'swboc_database_version', 2 );
	}
}

add_action( 'admin_init', 'update_swboc_database' );

?>