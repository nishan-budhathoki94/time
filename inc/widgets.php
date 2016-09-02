<?php
/**
 * Contains all the functions related to widget.
 *
 * @package ThemeGrill
 * @subpackage Time
 * @since Time 1.0
 */

register_widget( "time_service_widget" );

/**
 * Featured service widget to show pages.
 */
class time_service_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_service_block', 'description' => __( 'Display some pages as services.', 'time' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Services', 'time' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		for ( $i=0; $i<8; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
 		$defaults['section_id'] = 'services';
 		$defaults['section_title'] = 'SERVICES';
 		$defaults['section_desc'] = '';
 		$defaults['image_link'] = '0';
 		$defaults['read_more_button_enable'] = '0';
 		$defaults['select_column'] = 'column-3 service-inner-part';
 		$defaults['open_in_new_tab'] = '0';
 		$instance = wp_parse_args( (array) $instance, $defaults );
 		for ( $i=0; $i<8; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}
		$section_id = $instance['section_id'];
		$section_title = $instance['section_title'];
		$section_desc = $instance['section_desc'];
		$image_link = $instance['image_link'] ? 'checked="checked"' : '';
		$read_more_button_enable = $instance['read_more_button_enable'] ? 'checked="checked"' : '';
		$open_in_new_tab = $instance['open_in_new_tab'] ? 'checked="checked"' : '';
		$select_column = $instance['select_column'];
		
	?>
		
		<p>
	    	<label for="<?php echo $this->get_field_id('section_id'); ?>"><?php _e( 'Enter ID for this section(Without #)', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('section_id'); ?>" name="<?php echo $this->get_field_name('section_id'); ?>"
			 value="<?php echo esc_attr($section_id);?>" /> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('section_title'); ?>"><?php _e( 'Enter the heading for this section', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('section_title'); ?>" name="<?php echo $this->get_field_name('section_title'); ?>"
			  value="<?php echo esc_attr($section_title);?>"/> 
		</p>
		<p>
			 <label for="<?php echo $this->get_field_id('section_desc'); ?>"><?php _e( 'Enter the subheading for this section ', 'time' ); ?></label>
			<textarea class="textarea" rows ="5"  cols="30" id="<?php echo $this->get_field_id('section_desc'); ?>" name="<?php echo $this->get_field_name('section_desc'); ?>"  value="<?php echo esc_attr($section_desc);?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $image_link; ?> id="<?php echo $this->get_field_id('image_link'); ?>" name="<?php echo $this->get_field_name('image_link'); ?>" /> <label for="<?php echo $this->get_field_id('image_link'); ?>"><?php _e( 'Link featured image to their respective page', 'time' ); ?></label>
		</p>
		<?php for( $i=0; $i<8; $i++) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'time' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>
		<?php
		next( $defaults );// forwards the key of $defaults array
		} ?>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $read_more_button_enable; ?> id="<?php echo $this->get_field_id('read_more_button_enable'); ?>" name="<?php echo $this->get_field_name('read_more_button_enable'); ?>" /> <label for="<?php echo $this->get_field_id('read_more_button_enable'); ?>"><?php _e( 'Disable the read more button.', 'time' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $open_in_new_tab; ?> id="<?php echo $this->get_field_id('open_in_new_tab'); ?>" name="<?php echo $this->get_field_name('open_in_new_tab'); ?>" /> <label for="<?php echo $this->get_field_id('open_in_new_tab'); ?>"><?php _e( 'Check to open in new tab.', 'time' ); ?></label>
		</p>
		<?php _e('Select the services column', 'time'); ?>
		<p>
         <select id="<?php echo $this->get_field_id('select_column'); ?>" name="<?php echo $this->get_field_name('select_column'); ?>">
            <option value="column-2 service-inner-part" <?php if ( $select_column == 'column-2 service-inner-part' ) echo 'selected="selected"';?> ><?php _e( 'Two Column', 'time' );?></option>
            <option value="column-3 service-inner-part" <?php if ( $select_column == 'column-3 service-inner-part' ) echo 'selected="selected"'; ?> ><?php _e( 'Three Column', 'time' );?></option>
            <option value="column-4 service-inner-part" <?php if ( $select_column == 'column-4 service-inner-part' ) echo 'selected="selected"';?> ><?php _e( 'Four Column', 'time' );?></option>
         </select>
      </p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for( $i=0; $i<8; $i++ ) {
			$var = 'page_id'.$i;
			$instance[ $var] = absint( $new_instance[ $var ] );
		}

		$instance['section_id'] = $new_instance[ 'section_id' ];
		$instance['section_title'] = $new_instance['section_title'];
		$instance['section_desc'] = $new_instance['section_desc'];
		$instance[ 'image_link' ] = isset( $new_instance[ 'image_link' ] ) ? 1 : 0;
		$instance[ 'read_more_button_enable' ] = isset( $new_instance[ 'read_more_button_enable' ] ) ? 1 : 0;
		$instance[ 'select_column' ] = $new_instance[ 'select_column' ];
		$instance[ 'open_in_new_tab' ] = isset( $new_instance[ 'open_in_new_tab' ] ) ? 1 : 0;
		
		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$section_id = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : 'services';
 		$section_title = isset( $instance[ 'section_title' ] ) ? $instance[ 'section_title' ] : 'SERVICES';
 		$section_desc = isset( $instance[ 'section_desc' ] ) ? $instance[ 'section_desc' ] : '';
 		$image_link = !empty( $instance[ 'image_link' ] ) ? 'true' : 'false';
 		$read_more_button_enable = !empty( $instance[ 'read_more_button_enable' ] ) ? 'true' : 'false';
 		$open_in_new_tab = !empty( $instance[ 'open_in_new_tab' ] ) ? 'true' : 'false';
 		$select_column = isset( $instance[ 'select_column' ] ) ? $instance[ 'select_column' ] : 'column-3 service-inner-part';
 		$page_array = array();
 		for( $i=0; $i<8; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		}
 		if( !empty($page_array) ) {
		$get_featured_pages = new WP_Query( array(
			'posts_per_page' 			=> -1,
			'post_type'					=>  array( 'page' ),
			'post__in'		 			=> $page_array,
			'orderby' 		 			=> 'post__in'
		) );
		echo $before_widget; ?>
		<section id="<?php echo $section_id;?>" class="inner-section services">
			<div class="section-wrapper">
				<div class="container">
					<div class="section-title-wrapper">
							<h3 class="section-title"><span><?php echo $section_title;?></span></h3>
							<h2 class="section-subtitle"><span><?php echo $section_desc;?></span></h2>
					</div>
					<div class="service-content-wrap column-wrapper">
						<?php
			 			while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
							$page_title = get_the_title();
							?>
								<div class="<?php echo $select_column; ?>">
									<?php
									$new_tab = '';
									if ( $open_in_new_tab == 'true' ) {
										$new_tab = 'target="_blank"';
									}
									?>
									<?php
									if ( has_post_thumbnail() ) {
										if( $image_link == 'true' ) {
											echo'<div class="service-image-wrapper"><a title="'.get_the_title().'" href="'. get_permalink().'"'.esc_attr($new_tab).'>'.get_the_post_thumbnail( $post->ID, 'featured' ).'</a></div>';
										}
										else {
											echo'<div class="service-image-wrapper">'.get_the_post_thumbnail( $post->ID, 'featured' ).'</div>';
										}
									}
									?>
									<div class="entry-content">
									<?php echo $before_title; ?><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" <?php echo esc_attr($new_tab); ?>><?php echo $page_title; ?></a><?php echo $after_title; ?>
									<h2><span><?php echo get_the_excerpt(); ?></span></h2>
									<?php if ( $read_more_button_enable == "false" ) { ?>
										<div class="btn-wrapper">
											<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" <?php echo esc_attr($new_tab); ?>><?php  _e('View More', 'time'); ?></a>
										</div>
									<?php } ?>
									</div>
								</div>
						<?php endwhile;
				 		// Reset Post Data
			 			wp_reset_postdata();
			 			?>
					</div>
				</div>
			</div>
		</section>
		<?php
		echo $after_widget;
		}
 	}
}
