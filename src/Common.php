<?php namespace CoenJacobs\SWBOC;

class Common {
	public function __construct() {
		new PostTypes();
		include( 'class-swboc-widget.php' );
		add_action( 'widgets_init', create_function( '', "register_widget( 'SWBOC_Widget' );" ) );
	}
}

?>