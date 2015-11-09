<?php

add_action( 'init', 'themeist_register_book_post_types' );

function themeist_register_book_post_types() {

	/* Plugin post type. */
	register_post_type( 'books',
		array(
			'public' => 		true,
			'publicly_queryable' =>	true,
			'show_in_nav_menus' =>	true,
			'show_in_admin_bar' => 	true,
			'exclude_from_search' =>	false,
			'hierarchical' => 		false,
			'show_ui' => true,

			'has_archive' =>		 'books',
			'query_var' => 		'books',
			'capability_type' => 	'post',
			'menu_position' => 		5,

			'exclude_from_search' => false,
			'menu_position' => 5,
			'labels' => array(
				'name' => __( 'Books' ),
				'singular_name' => __( 'Books' ),
				'menu_name' => 		'Books',
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Book' ),
				'edit' => __( 'Edit Book' ),
				'edit_item' => __( 'Edit Book' ),
				'new_item' => __( 'New Book' ),
				'view' => __( 'View Book' ),
				'view_item' => __( 'View Book' ),
				'search_items' => __( 'Search Book' ),
				'not_found' => __( 'No Books found' ),
				'not_found_in_trash' => __( 'No Books found in Trash' ),
				'parent_item_colon' =>	null,
				'all_items' =>		'All Books'
			),

			// this sets where the Themes section lives and contains a tag to insert the Platform in URL below
			// this can be any depth e.g. books/%theme_platform%
			'rewrite' => array(
				//'slug' => 			'themes/%theme_platform%',
				'slug' => 			'books',
				'with_front' => 		false,
				'feeds' =>		true,
			),

			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields'
			)

		)
	);
}


/*	add_filter('post_type_link', 'themes_permalink_filter_function', 1, 3);
	function themes_permalink_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
		if ( strpos('%theme_platform%', $post_link) === 'FALSE' ) {
		  return $post_link;
		}
		$post = get_post($id);
		if ( !is_object($post) || $post->post_type != 'themes' ) {
		  return $post_link;
		}
		// this calls the term to be added to the URL
		$terms = wp_get_object_terms($post->ID, 'theme_platform');
		if ( !$terms ) {
		  return str_replace('themes/%theme_platform%/', '', $post_link);
		}
		return str_replace('%theme_platform%', $terms[0]->slug, $post_link);
	}*/

?>