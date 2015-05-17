<?php

class SWBOC_Widget extends WP_Widget {
	function SWBOC_Widget() {
		$widget_ops = array( 'classname' => 'SWBOC_Widget', 'description' => 'Widget to show a Smart WYSIWYG Block of Content' );
		$this->WP_Widget( 'swboc', 'SWBOC Widget', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		
		$swboc_id    = ( isset( $instance[ 'swboc_id' ] ) ) ? esc_attr( $instance[ 'swboc_id' ] ) : '';
		$swboc_title = ( isset( $instance[ 'title' ] ) ) ? esc_attr( $instance[ 'title' ] ) : '';
		
		if ( ! empty( $swboc_title ) )
			echo $before_title . $swboc_title . $after_title;
		
		$args = array (
			'post__in'  => array ( $swboc_id ),
			'post_type' => 'smartblock',
		);
		
		$swboc_posts = get_posts( $args );

		remove_filter( 'the_content', 'prepend_attachment' );
		
		foreach ( $swboc_posts as $post ) {
			echo apply_filters( 'the_content', $post->post_content );
		}

		add_filter( 'the_content', 'prepend_attachment' );

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$this->title = esc_attr( $instance[ 'title' ] );
		
		$updated_instance = $new_instance;
		
		return $updated_instance;
	}

	function form( $instance ) {
		$swboc_id    = ( isset( $instance[ 'swboc_id' ] ) ) ? esc_attr( $instance[ 'swboc_id' ] ) : '';
		$swboc_title = ( isset( $instance[ 'title' ] ) ) ? esc_attr( $instance[ 'title' ] ) : '';
		?>
		
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $swboc_title; ?>" /></label>
		
		<label for="<?php echo $this->get_field_id( 'swboc_id' ); ?>">Smart block:
		<select class="widefat" id="<?php echo $this->get_field_id( 'swboc_id'); ?>" name="<?php echo $this->get_field_name( 'swboc_id' ); ?>">
		
		<?php
		$args = array (
			'post_type'      => 'smartblock',
			'posts_per_page' => -1,
			'orderby'        => 'ID',
			'order'          => 'ASC'
		);
			
		$swboc_posts = get_posts( $args );
			
		foreach ( $swboc_posts as $post ) {
    		$currentID = $post->ID;
				
			if ( $currentID == $swboc_id ) {
				$extra = 'SELECTED';
			} else {
				$extra = '';
			}
			
			echo '<option value="' . $currentID . '" ' . $extra . '>' . $post->post_title . '</option>';
		} 
		?>
		
		</select>
		</label>
	<?php
	}
}

?>