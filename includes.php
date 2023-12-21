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

	return $query;
}

function themeist_books_add_after_post_content($content) {
	if (is_singular( 'book' )) {
		$content .= themeist_books_get_details();
	}
	return $content;
}
add_filter('the_content', 'themeist_books_add_after_post_content');

/**
 * Prints Book retailer information from Books CPT Plugin
 */
if ( ! function_exists( 'themeist_books_get_details' ) ) :
function themeist_books_get_details() {
	$book_publisher = get_post_meta( get_the_ID(), '_book_publisher', true);
	$book_publisher_url = get_post_meta( get_the_ID(), '_book_publisher_website', true);
	$book_retailer = get_post_meta( get_the_ID(), '_book_retailer', true );

	if ( '' !=  $book_publisher || array_filter($book_retailer) ) {
		$book_details = '<div class="book-details">';

		if ( '' !=  $book_publisher ) {
			if ( '' !=  $book_publisher_url ) :
				$book_details .= '<p><strong>Publisher: </strong> <a href="' . esc_url( $book_publisher_url ) . '" title="' . $book_publisher . '" target="_blank"><span>' . $book_publisher . '</span></a></p>';
			else :
				$book_details .= '<p><strong>Publisher: </strong>' . $book_publisher . '</p>';
			endif;
		}

		if (!empty($book_retailer)) {
			$book_details .= '<h2 class="book-details-title">You can purchase this book online at: </h2>';
			$book_details .= '<ul>';

			foreach ( (array) $book_retailer as $key => $entry ) {
				$name = $url = $logo  = '';

				if ( isset( $entry['name'] ) )
					$name = esc_html( $entry['name'] );

				if ( isset( $entry['url'] ) )
					$url = esc_url( $entry['url'] );

				if ( '' !=  $name ) {
					if ( '' !=  $url ) {
						$book_details .= '<li><a href="' . $url . '" title="' . $name . '" target="_blank">' . $name . '</a></li>';
					} else {
						$book_details .= '<li>' . $name . '</li>';
					}
				}
			}

			$book_details .= '</ul>';
		}

		$book_details .= '</div>';
		return $book_details;
	}
}
endif;

?>