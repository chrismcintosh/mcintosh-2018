<?php

/**
* Template Name: Flexible Content Page
* Description: Used to display content from the Advanced Custom Fields Flexible
* Content field group.
*/

get_header(); ?>

	
		<main id="main" class="site-main">

               <?php
                    if( have_rows( 'flexible_content' ) ) {
                         sby_display_flexible_content();                   
                    }
               ?>

		</main><!-- #main -->


<?php
get_sidebar();
get_footer();