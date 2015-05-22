<?php

class SWBOC_Common {
	function SWBOC_Common() {	
		include( 'class-swboc-widget.php' );
		add_action( 'widgets_init', create_function( '', "register_widget( 'SWBOC_Widget' );" ) );
	}
}

?>