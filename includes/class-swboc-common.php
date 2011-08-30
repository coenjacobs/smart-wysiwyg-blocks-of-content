<?php

class SWBOC_Common {
	function SWBOC_Common() {
		add_action( 'init', array ( $this, 'create_swboc_type' ) );
		
		include( 'class-swboc-widget.php' );
		add_action( 'widgets_init', create_function( '', "register_widget( 'SWBOC_Widget' );" ) );
	}
	
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

}

?>