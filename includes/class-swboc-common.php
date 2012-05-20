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
					'name'               => __( 'Smart Blocks', 'swboc' ),
					'singular_name'      => __( 'Smart Block', 'swboc' ),
					'add_new'            => __( 'Add New', 'swboc' ),
					'add_new_item'       => __( 'Add New Smart Block', 'swboc' ),
					'edit'               => __( 'Edit', 'swboc' ),
					'edit_item'          => __( 'Edit Smart Block', 'swboc' ),
					'new_item'           => __( 'New Smart Block', 'swboc' ),
					'view'               => __( 'View Smart Block', 'swboc' ),
					'view_item'          => __( 'View Smart Block', 'swboc' ),
					'search_items'       => __( 'Search Smart Blocks', 'swboc' ),
					'not_found'          => __( 'No Smart Blocks found', 'swboc' ),
					'not_found_in_trash' => __( 'No Smart Blocks found in Trash', 'swboc' ),
					'parent'             => __( 'Parent Smart Block', 'swboc' ),
				),
				'public'              => false,
				'description'         => __( 'A Smart Block is an effective way to store content that you will use more than once.', 'swboc' ),
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