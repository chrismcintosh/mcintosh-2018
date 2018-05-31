<?php 
// Define ACF component markup
function sby_display_flexible_content()
{
    // loop through the rows of data
    while (have_rows('flexible_content')) : the_row();
        // List Components for ACF Page Builder
        if (get_row_layout() == 'text_image') {
            include get_stylesheet_directory().'/lib/acf/components/text-image.php';
        } elseif (get_row_layout() == 'welcome') {
            include get_stylesheet_directory().'/lib/acf/components/welcome.php';
        }
    endwhile;
}