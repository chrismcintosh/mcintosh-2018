<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mcintosh-18
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="off-canvas-wrapper">

    <div class="off-canvas position-right" id="offCanvas" data-off-canvas>
    <button class="close-button" aria-label="Close menu" type="button" data-toggle="offCanvas">
	<span aria-hidden="true">&times;</span>
	</button>
	<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'mobile-menu',
					'items_wrap' => '<ul id="%1$s" class="%2$s accordion" data-responsive-menu="accordion medium-accordion">%3$s</ul>',
					'walker'  => new Foundation_Walker()
				) );
			?>
    </div>

        <div class="off-canvas-content" data-off-canvas-content>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'mcintosh' ); ?></a>

	<header class="site-header">
		<div class="site-header__wrapper">
			<h1 class="site-title" rel="home">
				<?php 
					if ( has_custom_logo() === true ) { 
						the_custom_logo();
					} else {
						?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php bloginfo( 'name' );?> </a><?php
					}
				?>
			</h1>
		<nav id="site-navigation" class="main-navigation">
			<button class="mobile-menu-toggle" data-toggle="offCanvas"><i class="fas fa-align-right"></i> Menu</button>

			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'desktop-menu',
					'items_wrap' => '<ul id="%1$s" class="%2$s dropdown medium-horizontal" data-responsive-menu="dropdown medium-dropdown">%3$s</ul>',
					'walker'  => new Foundation_Walker()
				) );
			?>
		</nav><!-- #site-navigation -->
		</div><!-- .site-header__wrapper -->
	</header>

	<div id="content" class="site-content">
