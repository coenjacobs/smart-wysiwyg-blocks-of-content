<?php namespace CoenJacobs\SWBOC;

class Common {
	public function __construct() {
		new PostTypes();

		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	public function register_widgets() {
		register_widget( 'CoenJacobs\SWBOC\Widget' );
	}
}