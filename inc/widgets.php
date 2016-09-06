<?php
/**
 * Contains all the functions related to widget.
 *
 * @package ThemeGrill
 * @subpackage Time
 * @since Time 1.0
 */

register_widget( "time_service_widget" );
register_widget( "time_feature_widget" );
register_widget( "time_testimonial_widget" );
register_widget( "time_post_widget" );

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
			<textarea class="textarea" rows ="5"  cols="30" id="<?php echo $this->get_field_id('section_desc'); ?>" 
			name="<?php echo $this->get_field_name('section_desc'); ?>"><?php echo esc_attr($section_desc);?></textarea>
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
		<section id="<?php echo esc_attr($section_id);?>" class="inner-section services">
			<div class="section-wrapper">
				<div class="container">
					<div class="section-title-wrapper">
							<h3 class="section-title"><span><?php echo esc_html($section_title);?></span></h3>
							<h2 class="section-subtitle"><span><?php echo esc_html($section_desc);?></span></h2>
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
											echo'<div class="service-image-wrapper"><a title="'.get_the_title().'" href="'. get_permalink().'"'.esc_attr($new_tab).'>'.get_the_post_thumbnail( $post->ID, 'service' ).'</a></div>';
										}
										else {
											echo'<div class="service-image-wrapper">'.get_the_post_thumbnail( $post->ID, 'service' ).'</div>';
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
 		

		/**************************************************************************************/

/**
 * Feature widget to show pages.
 */
class time_feature_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_feature_block', 'description' => __( 'Display some pages as features with parallax background.', 'time' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: features', 'time' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		for ( $i=0; $i<8; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
 		$defaults['section_id'] = 'features';
 		$defaults['section_title'] = 'FEATURES';
 		$defaults['section_desc'] = '';
 		$defaults['background_image'] = '';
 		$defaults['image_link'] = '0';
 		$defaults['read_more_button_enable'] = '0';
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
		$background_image = $instance['background_image'];
		
	?>
		
		<p>
	    	<label for="<?php echo $this->get_field_id('section_id'); ?>"><?php _e( 'Enter ID for this section(Without #)', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('section_id'); ?>" name="<?php echo $this->get_field_name('section_id'); ?>"
			 value="<?php echo esc_attr($section_id);?>" /> 
		</p>
		<p>
	    	<label for="<?php echo $this->get_field_id('background_image'); ?>"><?php _e( 'Enter the background image URL', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('background_image'); ?>" name="<?php echo $this->get_field_name('background_image'); ?>"
			 value="<?php echo esc_attr($background_image);?>" /> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('section_title'); ?>"><?php _e( 'Enter the heading for this section', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('section_title'); ?>" name="<?php echo $this->get_field_name('section_title'); ?>"
			  value="<?php echo esc_attr($section_title);?>"/> 
		</p>
		<p>
			 <label for="<?php echo $this->get_field_id('section_desc'); ?>"><?php _e( 'Enter the subheading for this section ', 'time' ); ?></label>
			<textarea class="textarea" rows ="5"  cols="30" id="<?php echo $this->get_field_id('section_desc'); ?>" name="<?php echo $this->get_field_name('section_desc'); ?>"><?php echo esc_attr($section_desc);?> </textarea>
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
		$instance['background_image'] = $new_instance['background_image'];
		$instance[ 'image_link' ] = isset( $new_instance[ 'image_link' ] ) ? 1 : 0;
		$instance[ 'read_more_button_enable' ] = isset( $new_instance[ 'read_more_button_enable' ] ) ? 1 : 0;
		$instance[ 'open_in_new_tab' ] = isset( $new_instance[ 'open_in_new_tab' ] ) ? 1 : 0;
		
		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$section_id = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : 'features';
 		$section_title = isset( $instance[ 'section_title' ] ) ? $instance[ 'section_title' ] : 'FEATURES';
 		$section_desc = isset( $instance[ 'section_desc' ] ) ? $instance[ 'section_desc' ] : '';
 		$background_image = $instance['background_image'];
 		$image_link = !empty( $instance[ 'image_link' ] ) ? 'true' : 'false';
 		$read_more_button_enable = !empty( $instance[ 'read_more_button_enable' ] ) ? 'true' : 'false';
 		$open_in_new_tab = !empty( $instance[ 'open_in_new_tab' ] ) ? 'true' : 'false';
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
		<section id="<?php echo esc_attr($section_id);?>" class="inner-section features" <?php if($background_image): echo 'style="background:url('.esc_url($background_image).') 50% 0 no-repeat fixed "'; endif; ?>>
		<div class="overlay"></div>
			<div class="section-wrapper">
				<div class="container">
					<div class="section-title-wrapper">
							<h3 class="section-title"><span><?php echo esc_html($section_title);?></span></h3>
							<h2 class="section-subtitle"><span><?php echo esc_html($section_desc);?></span></h2>
					</div>
					<div class="features-content-wrap column-wrapper">
						<?php
						$features_count = 0;
			 			while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
			 				$features_count++;
			 				$bottom_class = ($features_count > 2) ? 'bottom-half' : ' ';
 							$page_title = get_the_title();
							?>
								<div class="column-2 feature-part <?php echo $bottom_class;?>">
									<?php
									$new_tab = '';
									if ( $open_in_new_tab == 'true' ) {
										$new_tab = 'target="_blank"';
									}
									?>
									<?php
									if ( has_post_thumbnail() ) {
										$thumb = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
										$image = aq_resize( $img_url, 232, 232, true ); //resize & crop the image
										if(!$image) { $image = $img_url; }

										if( $image_link == 'true' ) {
											echo'<div class="feature-image"><a title="'.get_the_title().'" href="'. get_permalink().'"'.esc_attr($new_tab).'><img src="'.$image.'"></a></div>';
										}
										else {
											echo'<div class="feature-image"><img src="'.$image.'"></div>';
										}
									}
									?>
									<div class="entry-content">
									<?php echo $before_title.$page_title.$after_title; ?>
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

 /**
 * Testimonial widget
 */
class time_testimonial_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_testimonial_block', 'description' => __( 'Display some pages as testimonials.', 'time' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Testimonials', 'time' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		for ( $i=0; $i<8; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
 		$defaults['section_id'] = 'testimonials';
 		$defaults['section_title'] = 'WHAT OUR CLIENT SAYS';
 		$defaults['section_desc'] = '';
 		$defaults['designation'] = 'Web Developer';
 		$instance = wp_parse_args( (array) $instance, $defaults );
 		for ( $i=0; $i<8; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}
		$section_id = $instance['section_id'];
		$section_title = $instance['section_title'];
		$section_desc = $instance['section_desc'];
		$designation = $instance['designation'];
		
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
			<textarea class="textarea" rows ="5"  cols="30" id="<?php echo $this->get_field_id('section_desc'); ?>" 
			name="<?php echo $this->get_field_name('section_desc'); ?>"><?php echo esc_attr($section_desc);?></textarea>
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
			<label for="<?php echo $this->get_field_id('designation'); ?>"><?php _e( 'Enter the designation of the client', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('designation'); ?>" name="<?php echo $this->get_field_name('designation'); ?>"
			  value="<?php echo esc_attr($designation);?>"/> 
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
		$instance[ 'select_column' ] = $new_instance[ 'select_column' ];
		
		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$section_id = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : 'testimonials';
 		$section_title = isset( $instance[ 'section_title' ] ) ? $instance[ 'section_title' ] : 'WHAT OUR CLIENT SAYS';
 		$section_desc = isset( $instance[ 'section_desc' ] ) ? $instance[ 'section_desc' ] : '';
 		$designation = isset( $instance['designation'] ) ? $instance['designation'] : 'Web Developer';
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
		<section id="<?php echo esc_attr($section_id);?>" class="inner-section clients">
			<div class="section-wrapper">
				<div class="container">
					<div class="section-title-wrapper">
							<h3 class="section-title"><span><?php echo esc_html($section_title);?></span></h3>
							<h2 class="section-subtitle"><span><?php echo esc_html($section_desc);?></span></h2>
					</div>
					<div class="clients-content-wrap">
						<ul class="client-slider">
						<?php
			 			while( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
							$page_title = get_the_title();
							?>
								<li>
									<?php
									if ( has_post_thumbnail() ) {
										$thumb = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image
										$image = aq_resize( $img_url, 100, 120, true ); //resize & crop the image
										if(!$image) { $image = $img_url; }

										echo'<div class="image-wrapper"><img src="'.$image.'"></div>';
									}
									?>
									<div class="clients-des-wrap">
										<div class="clients-content">
											<?php the_excerpt();?>							
										</div>

										<div class="clients-name">
											<h4><?php the_title(); _e(',','time')?><span> <?php echo esc_html($designation);?></span></h4>
										</div>
									</div>
								</li>
						<?php endwhile;
				 		// Reset Post Data
			 			wp_reset_postdata();
			 			?>
			 			</ul>
					</div>
				</div>
			</div>
		</section>
		<?php
		echo $after_widget;
		}
 	}
}
 		

		/**************************************************************************************/

/**
 * Blog Post widget to show pages.
 */
class time_post_widget extends WP_Widget {
 	function __construct() {
 		$widget_ops = array( 'classname' => 'widget_post_block', 'description' => __( 'Display latest or category specific blog posts', 'time' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 );
		parent::__construct( false, $name = __( 'TG: Featured Posts', 'time' ), $widget_ops, $control_ops);
 	}

 	function form( $instance ) {
 		$defaults['section_id'] = 'blog';
 		$defaults['section_title'] = 'BLOGS';
 		$defaults['section_desc'] = '';
 		$defaults['type'] = 'latest';
 		$defaults['category'] = '';
 		$defaults['number'] = 3;
 		$defaults['background_image'] = '';
 		$defaults['read_more_button_enable'] = '0';
 		$defaults['open_in_new_tab'] = '0';
 		$instance = wp_parse_args( (array) $instance, $defaults );
		$section_id = $instance['section_id'];
		$section_title = $instance['section_title'];
		$section_desc = $instance['section_desc'];
		$type = $instance['type'];
		$category = $instance['category'];
		$number = $instance['number'];
		$read_more_button_enable = $instance['read_more_button_enable'] ? 'checked="checked"' : '';
		$open_in_new_tab = $instance['open_in_new_tab'] ? 'checked="checked"' : '';
		$background_image = $instance['background_image'];
	?>
		
		<p>
	    	<label for="<?php echo $this->get_field_id('section_id'); ?>"><?php _e( 'Enter ID for this section(Without #)', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('section_id'); ?>" name="<?php echo $this->get_field_name('section_id'); ?>"
			 value="<?php echo esc_attr($section_id);?>" /> 
		</p>
		<p>
	    	<label for="<?php echo $this->get_field_id('background_image'); ?>"><?php _e( 'Enter the background image URL', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('background_image'); ?>" name="<?php echo $this->get_field_name('background_image'); ?>"
			 value="<?php echo esc_attr($background_image);?>" /> 
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('section_title'); ?>"><?php _e( 'Enter the heading for this section', 'time' ); ?></label>
			<input class="text" type="text" id="<?php echo $this->get_field_id('section_title'); ?>" name="<?php echo $this->get_field_name('section_title'); ?>"
			  value="<?php echo esc_attr($section_title);?>"/> 
		</p>

		<p>
			 <label for="<?php echo $this->get_field_id('section_desc'); ?>"><?php _e( 'Enter the subheading for this section ', 'time' ); ?></label>
			<textarea class="textarea" rows ="5"  cols="30" id="<?php echo $this->get_field_id('section_desc'); ?>" name="<?php echo $this->get_field_name('section_desc'); ?>"><?php echo esc_attr($section_desc);?> </textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'accelerate' ); ?></label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'time' );?><br />
		 <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'time' );?><br /></p>

		<p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'time' ); ?>:</label>
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $read_more_button_enable; ?> id="<?php echo $this->get_field_id('read_more_button_enable'); ?>" name="<?php echo $this->get_field_name('read_more_button_enable'); ?>" /> <label for="<?php echo $this->get_field_id('read_more_button_enable'); ?>"><?php _e( 'Disable the read more button.', 'time' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $open_in_new_tab; ?> id="<?php echo $this->get_field_id('open_in_new_tab'); ?>" name="<?php echo $this->get_field_name('open_in_new_tab'); ?>" /> <label for="<?php echo $this->get_field_id('open_in_new_tab'); ?>"><?php _e( 'Check to open in new tab.', 'time' ); ?></label>
		</p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['section_id'] = $new_instance[ 'section_id' ];
		$instance['section_title'] = $new_instance['section_title'];
		$instance['section_desc'] = $new_instance['section_desc'];
		$instance['number'] = $new_instance['number'];
		$instance['type'] = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
 		$instance['category'] = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$instance['background_image'] = $new_instance['background_image'];
		$instance[ 'read_more_button_enable' ] = isset( $new_instance[ 'read_more_button_enable' ] ) ? 1 : 0;
		$instance[ 'open_in_new_tab' ] = isset( $new_instance[ 'open_in_new_tab' ] ) ? 1 : 0;
		
		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$section_id = isset( $instance[ 'section_id' ] ) ? $instance[ 'section_id' ] : 'features';
 		$section_title = isset( $instance[ 'section_title' ] ) ? $instance[ 'section_title' ] : 'FEATURES';
 		$section_desc = isset( $instance[ 'section_desc' ] ) ? $instance[ 'section_desc' ] : '';
 		$number = isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : 3;
 		$type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest';
 		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
 		$background_image = isset( $instance[ 'background_image' ] ) ? $instance[ 'background_image' ] : '';
 		$read_more_button_enable = !empty( $instance[ 'read_more_button_enable' ] ) ? 'true' : 'false';
 		$open_in_new_tab = !empty( $instance[ 'open_in_new_tab' ] ) ? 'true' : 'false';
 		if( $type == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' 			=> $number,
				'post_type'					=> 'post',
				'ignore_sticky_posts' 	=> true
			) );
		}
		else {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' 			=> $number,
				'post_type'					=> 'post',
				'category__in'				=> $category
			) );
		}
		echo $before_widget; ?>
		<section id="<?php echo esc_attr($section_id);?>" class="inner-section blogs" <?php if($background_image): echo 'style="background:url('.esc_url($background_image).') 50% 0 no-repeat fixed "'; endif; ?>>
		<div class="overlay"></div>
			<div class="section-wrapper">
				<div class="container">
					<div class="section-title-wrapper">
							<h3 class="section-title"><span><?php echo esc_html($section_title);?></span></h3>
							<h2 class="section-subtitle"><span><?php echo esc_html($section_desc);?></span></h2>
					</div>
					<div class="blog-content-wrap column-wrapper">
						<?php
			 			while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
			 			$page_title = get_the_title();
							?>
								<div class="column-3 blog-inner-content">
									<?php
									$new_tab = '';
									if ( $open_in_new_tab == 'true' ) {
										$new_tab = 'target="_blank"';
									}
									?>
									<?php
									if ( has_post_thumbnail() ) {
										$thumb = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url( $thumb,'post' );
										$image = aq_resize( $img_url,373, 265, true ); //resize & crop the image
										if(!$image) { $image = $img_url; }

										echo'<div class="image-wrapper"><img src="'.$image.'"></div>';
										
									}
									?>
									<div class="entry-content">
									<?php echo $before_title.$page_title.$after_title; ?>
									<h2><i class="fa fa-user"></i> <span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author();?></a></span> <?php _e('|','time');?> 
									<i class="fa fa-pencil-square-o"></i> <span><?php the_category( '/', get_the_ID() ); ?></span></h2>
									
									<p><span><?php echo get_the_excerpt(); ?></span></p>
									<?php if ( $read_more_button_enable == "false" ) { ?>
										<div class="btn-wrapper">
											<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" <?php echo esc_attr($new_tab); ?>><?php  _e('Read More', 'time'); ?></a>
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