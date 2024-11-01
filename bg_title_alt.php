<?php
/*
Plugin Name: Title like Alt
Description: Restore Image Title from Alt attribute
Version: 1.0
License: GPL
Author: VBog
Author URI: http://bogaiskov.ru/
*/

function bg_title_alt ( $html, $id ) {

    if (strpos($html, "title=")) {
    	return $html;
    } else {
		$thumb_title = get_post_meta($id, '_wp_attachment_image_alt', true);
		return str_replace('<img', '<img title="' . $thumb_title . '" '  , $html);      
	}
}
add_filter( 'media_send_to_editor', 'bg_title_alt', 15, 2 );

function bg_title_alt_to_gallery( $content, $id ) {
	$thumb_title = get_post_meta($id, '_wp_attachment_image_alt', true);
	return str_replace('<a', '<a title="' . esc_attr($thumb_title) . '" ', $content);
}	
add_filter('wp_get_attachment_link', 'bg_title_alt_to_gallery', 10, 4);
