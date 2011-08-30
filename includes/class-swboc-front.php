<?php

class SWBOC_Front {
	function SWBOC_Front() {
		add_shortcode( 'smartblock', array ( $this, 'swboc_shortcode' ) );
	}
	
	function swboc_shortcode( $atts ) {
		extract( shortcode_atts( array (
			'id' => '',
		), $atts ) );
	
		$content = "";
	
		if ( $id != "" ) {
			$args = array (
				'post__in'  => array ( $id ),
				'post_type' => 'smartblock',
			);
		
			$swboc_posts = get_posts( $args );
		
			foreach ( $swboc_posts as $post ) {
				$content .= apply_filters( 'the_content', $post->post_content );
			}
		}
	
		return $content;
	}
}

?>