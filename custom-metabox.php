<?php
/**
 * Custom Meta Boxes
 *
 * @link https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 * @category Books by Themeist
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 *
 * @since 0.1.1
 */

/**
 * Custom Heading & Sub Heading
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function books_by_themeist_custom_metabox( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_book_';

	/**
	 * Custom Heading & Sub Heading
	 */
	$meta_boxes['metabox_heading'] = array(
		'id'         => 'book_details',
		'title'      => __( 'Book Details', THEME_TEXTDOMAIN ),
		'pages'      => array( 'books', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Publisher Name', THEME_TEXTDOMAIN ),
				'desc' => __( 'Enter Publishers Name', THEME_TEXTDOMAIN ),
				'id'   => $prefix . 'publisher',
				'type' => 'text',
			),
			array(
				'name' => __( 'Publisher Website', THEME_TEXTDOMAIN ),
				'desc' => __( 'Enter Publishers Website URL', THEME_TEXTDOMAIN ),
				'id'   => $prefix . 'publisher_website',
				'type' => 'text_url',
			),

			array(
				'id' => $prefix . 'retailers',
				'type' => 'group',
				'description' => __( 'List of Retailers', THEME_TEXTDOMAIN ),
				'options' => array(
					'group_title'   => __( 'Retailer {#}', THEME_TEXTDOMAIN ), // since version 1.1.4, {#} gets replaced by row number
					'add_button'    => __( 'Add Another Retailer', THEME_TEXTDOMAIN ),
					'remove_button' => __( 'Remove Retailer', THEME_TEXTDOMAIN ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => __( 'Retailer Name', THEME_TEXTDOMAIN ),
						'id'   => 'name',
						'type' => 'text',
					),
					array(
						'name' => __( 'Purchase URL', THEME_TEXTDOMAIN ),
						'id'   => 'url',
						'type' => 'text_url',
					),
/*					array(
						'name' => __( 'Retailer Logo', THEME_TEXTDOMAIN ),
						'id'   => 'logo',
						'type' => 'file',
					),*/
				),
			),
			// How to output the data can be found at https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Field-Types#group
		),
	);

	return $meta_boxes;

}
add_filter( 'cmb_meta_boxes', 'books_by_themeist_custom_metabox' );


?>