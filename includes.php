<?php

/**
 * Add Support for Custom Meta Box Library
 * Included in plugin "WordPress for my Clients" - https://github.com/hchouhan/WordPress-for-My-Clients
 * @link https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 *
 */
add_theme_support('dot_metabox_support');

add_filter( 'pre_get_posts', 'themeist_books_pre_get_posts' );


function themeist_books_pre_get_posts( $query ) {

	if ( is_admin() )
		return $query;

	elseif ( $query->is_main_query() && is_post_type_archive( 'books' ) ) {
		$query->set( 'posts_per_page', -1 );
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'asc' );
	}

/*	elseif ( $query->is_main_query() && is_search() ) {
		$query->set( 'posts_per_page', 25 );
	}*/

	return $query;
}



?>