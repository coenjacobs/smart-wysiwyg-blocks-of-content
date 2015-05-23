<?php
/*
Plugin Name: Smart WYSIWYG Blocks Of Content
Plugin URI: https://wordpress.org/plugins/smart-wysiwyg-blocks-of-content/
Description: Adds a custom post type that can be easily inserted at multiple spots, including widgets. Easy way to create WYSIWYG widgets.
Author: Coen Jacobs
Version: 1.0.0-bleeding
Author URI: http://coenjacobs.me
*/

require( 'vendor/autoload.php' );

if ( is_admin() ) {
	new CoenJacobs\SWBOC\Admin();
} else {
	new CoenJacobs\SWBOC\Front();	
}