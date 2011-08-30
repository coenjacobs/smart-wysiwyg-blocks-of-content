<?php
/*
Plugin Name: Smart WYSIWYG Blocks Of Content
Plugin URI: http://cnjcbs.com/wordpress-plugins/smart-wysiwyg-blocks-of-content
Description: Adds a custom post type that can be easily inserted at multiple spots, including widgets. Easy way to create WYSIWYG widgets.
Author: Coen Jacobs
Version: 0.5
Author URI: http://cnjcbs.com
*/

include( 'includes/class-swboc-front.php' );

$SWBOC_Front = new SWBOC_Front();

add_shortcode( 'smartblock', array ( $SWBOC_Front, 'swboc_shortcode' ) );

include( 'includes/class-swboc-widget.php' );

add_action( 'widgets_init', create_function( '', "register_widget( 'SWBOC_Widget' );" ) );

include( 'includes/class-swboc-common.php' );

$SWBOC_Common = new SWBOC_Common();

add_action( 'init', array ( $SWBOC_Common, 'create_swboc_type' ) );

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