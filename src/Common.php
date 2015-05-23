<?php namespace CoenJacobs\SWBOC;

class Common {
	public function __construct() {
		new PostTypes();

		add_action( 'widgets_init', create_function( '', "register_widget( 'CoenJacobs\SWBOC\Widget' );" ) );
	}
}

?>