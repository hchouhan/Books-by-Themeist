<?php
/**
 * Custom Meta Boxes
 *
 * @link https://github.com/CMB2/CMB2
 * @category Books by Themeist
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 *
 * @since 0.1
 */

/**
 * Custom Heading & Sub Heading
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
add_action( 'cmb2_admin_init', 'books_by_themeist_custom_metabox' );
function books_by_themeist_custom_metabox( ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_book_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'book_details',
		'title'         => __( 'Book Details', 'books-by-themeist' ),
		'object_types'  => array( 'books', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Publisher Name', 'books-by-themeist' ),
		'desc'       => __( 'Enter Publishers Name', 'books-by-themeist' ),
		'id'         => $prefix . 'publisher',
		'type'       => 'text',
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

	// URL text field
	$cmb->add_field( array(
		'name' => __( 'Publisher Website', 'books-by-themeist' ),
		'desc' => __( 'Enter Publishers Website URL', 'books-by-themeist' ),
		'id'   => $prefix . 'publisher_website',
		'type' => 'text_url',
		// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
		// 'repeatable' => true,
	) );

}

/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
add_action( 'cmb2_admin_init', 'books_by_themeist_custom_metabox_retailers' );
function books_by_themeist_custom_metabox_retailers() {
	$prefix = '_book_';
	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'retailers',
		'title'        => esc_html__( 'List of Retailers', 'books-by-themeist' ),
		'object_types' => array( 'books' ),
	) );
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'retailer',
		'type'        => 'group',
		//'description' => esc_html__( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Retailer {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Retailer', 'cmb2' ),
			'remove_button' => esc_html__( 'Remove Retailer', 'cmb2' ),
			'sortable'      => true,
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Retailer Name', 'cmb2' ),
		'id' => 'name',
		'type' => 'text',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Purchase URL', 'cmb2' ),
		'id' => 'url',
		'type' => 'text_url',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Retailer Logo', 'cmb2' ),
		'id' => 'logo',
		'type' => 'file',
	) );
}

?>