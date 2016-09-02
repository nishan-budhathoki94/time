<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Time
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="home">
<div id="page" class="hfeedsite">
	<header id="masthead" class="site-header">
		<div class="header-wrapper clearfix">
			<div class="container">
				<div class="header-wrapper clearfix">
					<div class="logo">
						<h1>
							<?php $img_src = esc_url(get_theme_mod( 'time_logo' ));?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php if( $img_src ) { 
								echo '<img src="'.$img_src.'">';
							}
								else {
								echo esc_attr( get_bloginfo( 'name', 'display' ) );
							}?>
							</a>
						</h1>
					</div><!--end logo-->

				<nav id="site-navigation" class="main-navigation">
					<div class="menu-toggle">
						<i class="fa fa-bars"></i>
					</div>
					<?php
						if ( has_nav_menu( 'primary' ) ) {
							wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'nav', 'container' => false ) );
						}
						else {
							wp_page_menu();
						}
					?>
				</nav><!-- #site-navigation -->
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
