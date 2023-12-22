<?php

/**
 * Add Support for Custom Meta Box Library
 * Included in plugin "WordPress for my Clients" - https://github.com/hchouhan/WordPress-for-My-Clients
 * @link https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 *
 */
add_theme_support('cmb2');

add_filter( 'pre_get_posts', 'themeist_books_pre_get_posts' );

function themeist_books_pre_get_posts( $query ) {
	if ( is_admin() )
		return $query;
	elseif ( $query->is_main_query() && is_post_type_archive( 'books' ) ) {
		$query->set( 'posts_per_page', -1 );
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'desc' );
	}

	return $query;
}

/**
 * Prints Book retailer information from Books CPT Plugin
 */
if (!function_exists('themeist_books_get_details')) :
    function themeist_books_get_details() {
        $book_publisher = get_post_meta(get_the_ID(), '_book_publisher', true);
        $book_publisher_url = esc_url(get_post_meta(get_the_ID(), '_book_publisher_website', true));
        $book_retailer = (array) get_post_meta(get_the_ID(), '_book_retailer', true);

        // Check if any relevant data exists
        if (empty($book_publisher) && empty(array_filter($book_retailer, 'themeist_filter_retailer_data'))) {
            return ''; // No data to display, exit early
        }

        $book_details = '<div class="book-details">';

        // Display publisher details
        if (!empty($book_publisher)) {
            $book_details .= '<p><strong>Publisher: </strong>';
            $book_details .= !empty($book_publisher_url) ? "<a href=\"{$book_publisher_url}\" title=\"{$book_publisher}\" target=\"_blank\"><span>{$book_publisher}</span></a>" : $book_publisher;
            $book_details .= '</p>';
        }

        // Display retailer details
        if (!empty($book_retailer)) {
            $book_details .= '<h4 class="book-details-title">You can purchase this book online at: </h4>';
            $book_details .= '<ul>';

            foreach ($book_retailer as $entry) {
                $name = sanitize_text_field($entry['name'] ?? '');
                $url = esc_url($entry['url'] ?? '');

                if (!empty($name)) {
                    $book_details .= "<li>" . (!empty($url) ? "<a href=\"{$url}\" title=\"{$name}\" target=\"_blank\">{$name}</a>" : $name) . "</li>";
                }
            }

            $book_details .= '</ul>';
        }

        $book_details .= '</div>';

        return $book_details;
    }

    // Custom filter function to check if retailer data is valid
    function themeist_filter_retailer_data($data) {
        return !empty($data['name']);
    }
endif;

function themeist_books_add_after_post_content($content) {
	if (is_singular( 'books' )) {
		$content .= themeist_books_get_details();
	}
	return $content;
}
add_filter('the_content', 'themeist_books_add_after_post_content');

?>