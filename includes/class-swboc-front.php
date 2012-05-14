<?php

class SWBOC_Front {
	private $common;
	
	function SWBOC_Front() {
		include( 'class-swboc-common.php' );
		$this->common = new SWBOC_Common();
		
		add_shortcode( 'smartblock', array ( $this, 'swboc_shortcode' ) );
	}
	
	function swboc_shortcode( $atts ) {
		extract( shortcode_atts( array (
			'id' => '',
		), $atts ) );
	
		$content = "";

		global $post;
		$temp = $post;
	
		if ( $id != "" ) {
			$args = array (
				'post__in'  => array ( $id ),
				'post_type' => 'smartblock',
			);
		
			$swboc_posts = get_posts( $args );
		
			remove_filter( 'the_content', 'prepend_attachment' );

			foreach ( $swboc_posts as $post ) {
				$content .= apply_filters( 'the_content', $post->post_content );
			}

			add_filter( 'the_content', 'prepend_attachment' );
		}

		$post = $temp;
	
		return $content;
	}
}

?>