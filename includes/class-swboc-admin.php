<?php

class SWBOC_Admin {
	private $common;
	
	function SWBOC_Admin() {
		include( 'class-swboc-common.php' );
		$this->common = new SWBOC_Common();
		
		add_action( 'admin_init', array ( $this, 'update_swboc_database' ) );
	}
	
	function update_swboc_database() {
		$db_version = get_option( 'swboc_database_version' );
	
		if ( $db_version != '' || $db_version < 2 ) {
			global $wpdb;
			$wpdb->update( $wpdb->posts, array( 'post_type' => 'smartblock' ), array( 'post_type' => 'Smart Block' ) );
			update_option( 'swboc_database_version', 2 );
		}
	}
}

?>