<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Time
 */


    if( get_theme_mod('time_activate_footer',1) == 1 ):?>
		<div class="copyright" style="background-color: <?php echo esc_attr(get_theme_mod('time_footer_color','#e3e3e3'));?>; 
		text-align:<?php echo esc_attr(get_theme_mod('time_footer_text_position','center'));?>">
			<div class="container">
				<?php echo get_theme_mod('time_footer_text');?>
			</div>
		</div>
	<?php endif;?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
