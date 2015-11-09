<?php

//add_action( 'init', 'themeist_register_book_taxonomies' );

function themeist_register_book_taxonomies() {

	/* Theme Platform taxonomy. */
	register_taxonomy(
		'book_categry',
		array( 
			'books' 
		),
		array(
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'hierarchical' => false,
			'query_var' => true,

			'labels' => array(
				'name' => __( 'Book Type' ),
				'singular_name' => __( 'Book Type' ),
				'search_items' => __( 'Search Book Type' ),
				'popular_items' => __( 'Popular Book Type' ),
				'all_items' => __( 'All Book Types' ),
				'parent_item' => __( 'Parent Book Type' ),
				'parent_item_colon' => __( 'Parent Book Type:' ),
				'edit_item' => __( 'Edit Book Type' ),
				'update_item' => __( 'Update Book Type' ),
				'add_new_item' => __( 'Add New Book Type' ),
				'new_item_name' => __( 'New Book Type' ),
			),

			// this sets the taxonomy view URL (must have category base i.e. /platform)
			// this can be any depth e.g. themeist.co/books/platform
			'rewrite' => array(
				'with_front' => 		false,
				'slug' => 			'books'
			),
		)
	);	

}


?>