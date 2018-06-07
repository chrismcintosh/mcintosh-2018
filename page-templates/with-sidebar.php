<?php
/**
* Template Name: With Sidebar Page
* Description: Used to display content from the Advanced Custom Fields Flexible
* Content field group.
*
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mcintosh-18
 */

get_header(); ?>

	
	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'lib/template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
