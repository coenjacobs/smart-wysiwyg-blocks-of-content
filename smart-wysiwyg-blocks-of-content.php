<?php
/*
Plugin Name: Smart WYSIWYG Blocks Of Content
Plugin URI: https://wordpress.org/plugins/smart-wysiwyg-blocks-of-content/
Description: Adds a custom post type that can be easily inserted at multiple spots, including widgets. Easy way to create WYSIWYG widgets.
Author: Coen Jacobs
Version: 0.6.1
Author URI: http://coenjacobs.me
*/

if ( is_admin() ) {
	include( 'includes/class-swboc-admin.php' );
	$SWBOC_Admin = new SWBOC_Admin();
} else {
	include( 'includes/class-swboc-front.php' );
	$SWBOC_Front = new SWBOC_Front();	
}

?>