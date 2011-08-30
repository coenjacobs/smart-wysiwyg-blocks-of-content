<?php

class SWBOC_Admin {
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