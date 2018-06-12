<?php

/**
* Template Name: Flexible Content Page
* Description: Used to display content from the Advanced Custom Fields Flexible
* Content field group.
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
get_footer();