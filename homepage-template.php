<?php
/**
 * The template for displaying all single posts.
 * Template Name:HomePage
 *
 *
 * @package Time
 */

get_header(); 
$slider_activate = absint(get_theme_mod('time_activate_slider',''));
$slides_count =	absint(get_theme_mod('time_slider_number','2'));
//checking if the slider is activated
if(  $slider_activate == 1 ):?>
	<section class="home-slider">
		<div class="slider-wrapper">
			<ul class="bxslider">
			<?php for ( $i = 1; $i <= $slides_count; $i++ ) {
					$slider_image = esc_url(get_theme_mod('time_slider_image'.$i,''));
					$slider_title = esc_html(get_theme_mod('time_slider_title'.$i,'Times Landing Page'));
					$slider_description = esc_html(get_theme_mod('time_slider_text'.$i,''));
					$slider_button1_text = esc_html(get_theme_mod('time_slider_first_button_text'.$i,'Learn More'));
					$slider_button2_text = esc_html(get_theme_mod('time_slider_second_button_text'.$i,'Buy Now'));
					$slider_button1_link = esc_url(get_theme_mod('time_slider_first_button_link'.$i,''));
					$slider_button2_link = esc_url(get_theme_mod('time_slider_second_button_link'.$i,''));?>
				    <li>
					    <img src="<?php echo $slider_image; ?>" />
						<div class="entry-content">
						  	<h3 class="entry-title slider-title">
						  		<?php echo $slider_title; ?>
						  	</h3>
				  
						  	<div class="entry-des slider-text">
						  			  	<p><?php echo $slider_description; ?></p>
						 	</div>
							<div class="btn-wrapper">
								<?php if( $slider_button1_link ) {

									echo '<a href="'.$slider_button1_link.'">'.$slider_button1_text.'</a>';
								}

								if( $slider_button2_link ) {

									echo '<a href="'.$slider_button2_link.'">'.$slider_button2_text.'</a>';
								}?>
							</div>
						</div>
				    </li>
			<?php } ?>
			</ul>
		</div>
	</section>
<?php
endif;
//End of slider actvation check

if( is_active_sidebar( 'frontpage_sidebar' ) ) {
		// Calling the  frontpage sidebar if it exists.
		if ( !dynamic_sidebar( 'frontpage_sidebar' ) ):
		endif;
	}


get_footer();
