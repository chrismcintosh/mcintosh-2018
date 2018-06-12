<?php


add_filter( 'post_gallery', 'themeprefix_gallery_output', 10, 3);

function themeprefix_gallery_output($output, $attr, $instance ) {

global $post, $wp_locale;

$html5 = current_theme_supports( 'html5', 'gallery' );
$atts = shortcode_atts( array(
	'order'      => 'ASC',
	'orderby'    => 'menu_order ID',
	'id'         => $post ? $post->ID : 0,
	'itemtag'    => $html5 ? 'figure'     : 'dl',
	'icontag'    => $html5 ? 'div'        : 'dt',
	'captiontag' => $html5 ? 'figcaption' : 'dd',
	'columns'    => 3,
	'size'       => 'thumbnail',
	'include'    => '',
	'exclude'    => '',
	'link'       => ''
), $attr, 'gallery' );

$id = intval( $atts['id'] );

if ( ! empty( $atts['include'] ) ) {
	$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

	$attachments = array();
	foreach ( $_attachments as $key => $val ) {
		$attachments[$val->ID] = $_attachments[$key];
	}
} elseif ( ! empty( $atts['exclude'] ) ) {
	$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
} else {
	$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
}

if ( empty( $attachments ) ) {
	return '';
}

if ( is_feed() ) {
	$output = "\n";
	foreach ( $attachments as $att_id => $attachment ) {
		$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
	}
	return $output;
}

$itemtag = tag_escape( $atts['itemtag'] );
$captiontag = tag_escape( $atts['captiontag'] );
$icontag = tag_escape( $atts['icontag'] );
$valid_tags = wp_kses_allowed_html( 'post' );
if ( ! isset( $valid_tags[ $itemtag ] ) ) {
	$itemtag = 'dl';
}
if ( ! isset( $valid_tags[ $captiontag ] ) ) {
	$captiontag = 'dd';
}
if ( ! isset( $valid_tags[ $icontag ] ) ) {
	$icontag = 'dt';
}

$columns = intval( $atts['columns'] );
$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
$float = is_rtl() ? 'right' : 'left';

$selector = "gallery-{$instance}";

$gallery_style = '';

/**
 * Filter whether to print default gallery styles.
 *
 * @since 3.1.0
 *
 * @param bool $print Whether to print default gallery styles.
 *                    Defaults to false if the theme supports HTML5 galleries.
 *                    Otherwise, defaults to true.
 */

$size_class = sanitize_html_class( $atts['size'] );
$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

/**
 * Filter the default gallery shortcode CSS styles.
 *
 * @since 2.5.0
 *
 * @param string $gallery_style Default CSS styles and opening HTML div container
 *                              for the gallery shortcode output.
 */
$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

$i = 0;
foreach ( $attachments as $id => $attachment ) {

	// $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
	// if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
	// 	$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
	// } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
	// 	$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
	// } else {
	// 	$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
     // }
     
     // Build the Image Output
     $image_output = '<a href="';
     $image_output .= wp_get_attachment_url($id);
     $image_output .= '" data-lightbox="post-gallery-';
     $image_output .= $post->ID . '"';
     $image_output .= 'data-title="';
     $image_output .= wp_get_attachment_caption( $id );
     $image_output .= '" >';
     $image_output .= wp_get_attachment_image( $id, 'medium' );
     $image_output .= '</a>';


	$image_meta  = wp_get_attachment_metadata( $id );

	$orientation = '';
	if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
		$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
	}
	$output .= "<{$itemtag} class='gallery-item'>";
	$output .= "
		<{$icontag} class='gallery-icon {$orientation}'>
			$image_output
		</{$icontag}>";
	if ( $captiontag && trim($attachment->post_excerpt) ) {
		$output .= "
			<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
			" . wptexturize($attachment->post_excerpt) . "
			</{$captiontag}>";
	}
	$output .= "</{$itemtag}>";
	if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
		$output .= '<br style="clear: both" />';
	}
}

if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
	$output .= "
		<br style='clear: both' />";
}

$output .= "
	</div>\n";

return $output;

}