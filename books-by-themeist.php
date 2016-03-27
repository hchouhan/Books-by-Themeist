<?php
/**
 * Plugin Name: Books by Themeist
 * Plugin URI: http://themeist.co
 * Text Domain: books-by-themeist
 * Domain Path: /languages
 * Description: Books CPT for theme developers to use in their client projects
 * Version: 0.1.1
 * Author: Harish Chouhan
 * Author URI: http://www.dreamsmedia.in
 */

class Themeist_Books {

	/**
	 * Sets up the plugin.
	 */
	function __construct() {

		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 2 );
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 3 );
		add_action( 'plugins_loaded', array( &$this, 'my_plugin_load_plugin_textdomain' ), 4 );
	}

	function my_plugin_load_plugin_textdomain() {
	    load_plugin_textdomain( 'books-by-themeist', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	


	/**
	 * Defines constants for the plugin.
	 */
	function constants() {
		define( 'THEMIST_BOOKS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
	}

	/**
	 * Loads files needed across the site.
	 */
	function includes() {

		/* Load includes. */
		require_once( THEMIST_BOOKS_DIR . 'includes.php' );

		/* Load taxonomies. */
		require_once( THEMIST_BOOKS_DIR . 'taxonomies.php' );

		/* Load post types. */
		require_once( THEMIST_BOOKS_DIR . 'post-types.php' );

		/* Custom Metabox for this theme */
		require_once( THEMIST_BOOKS_DIR . 'custom-metabox.php' );
	}

	/**
	 * Loads admin files.
	 */
	function admin() {

		if ( is_admin() ) {

			/* Load main admin file. */
			require_once( THEMIST_BOOKS_DIR . 'admin.php' );

			/* Load meta boxes. */
			//require_once( THEMIST_BOOKS_DIR . 'meta-boxes.php' );
		}
	}

}

new Themeist_Books();

?>