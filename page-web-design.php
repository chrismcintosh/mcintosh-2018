<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mcintosh-18
 */

add_filter( 'body_class', 'full_width_body_class' );
function full_width_body_class( $classes ) {
	$classes[] = 'full-width';
	return $classes;
}

get_header(); ?>

	<main id="main" class="site-main">

		<div class="hero" style="background: url('http://chris.test/wp-content/uploads/2018/06/rawpixel-648563-unsplash.jpg')">
			<div class="wrap">
				<h2>Win More Customers <br> With an Amazing Website</h2>
				<a href="/schedule-consultation" class="button" role="button">Schedule Free Consultation</a>
			</div>
		</div>

		<div class="product-description">
			<div class="wrap">
				<div class="section">
					<h2>Made With Love</h2>
					<div class="product-intro">
						Your Website is your most important digital asset but it can be so easy to get it wrong. Shouldnt it be easier to put your best foot forward with your marketing?
					</div>
					<div class="feature">
						<h3>Custom</h3>
						<p>Your business has unique needs and serves unique people, your website should reflect that.</p>
					</div>
					<div class="feature">
						<h3>Training</h3>
						<p>We'll provide you with training so that you can make changes on your website.</p>
					</div>
					<div class="feature">
						<h3>Professional Standards</h3>
						<p>We create websites with the latest standards -- built to last.</p>
					</div>
					<div class="feature">
						<h3>Success Strategies</h3>
						<p>We work with you to create a strategy for your website that can be implemented in all forms of your digital marketing.</p>
					</div>

				</div>
				<img src="http://chris.test/wp-content/uploads/2018/06/rawpixel-684806-unsplash.jpg" class="section square" />
			</img>
		</div>

	</main><!-- #main -->

<?php
get_footer();
