<?php
/*
Plugin Name: CIT Theme Functions
Plugin URI: https://github.com/matirosero/cit-theme-functions
Description: Custom functions for the Club de Investigación Tecnológica website.
Version: 0.1
Author: Mat Rosero
Author URI: https://www.matilderosero.com/
This plugin is released under the GPLv2 license. The images packaged with this plugin are the property of their respective owners, and do not, necessarily, inherit the GPLv2 license.
*/


/**
 * Get the CMB2 bootstrap!
 *
 * @since 0.1.0
 */
if ( file_exists( __DIR__ . '/vendor/cmb2/init.php' ) ) {
  	require_once __DIR__ . '/vendor/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/vendor/CMB2/init.php' ) ) {
  	require_once __DIR__ . '/vendor/CMB2/init.php';
}


/**
 * Load plugin textdomain.
 *
 * @since 0.1.0
 */
function mro_cit_load_textdomain() {
	load_plugin_textdomain( 'mro-cit-cpt', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'mro_cit_load_textdomain' );


/**
 * Helpers.
 *
 * @since 0.1.0
 */
require_once( dirname( __FILE__ ) . '/includes/helpers.php' );


/**
 * Post types.
 *
 * @since 0.1.0
 */
require_once( dirname( __FILE__ ) . '/includes/register-cpt.php' );


/**
 * Taxonomies.
 *
 * @since 0.1.0
 */
require_once( dirname( __FILE__ ) . '/includes/register-taxonomies.php' );


/**
 * Custom fields (uses CMB2).
 *
 * @since 0.1.0
 */
require_once( dirname( __FILE__ ) . '/includes/demo-register-custom-fields.php' );

require_once( dirname( __FILE__ ) . '/includes/register-custom-fields.php' );


/**
 * Sortable columns.
 * https://code.tutsplus.com/articles/quick-tip-make-your-custom-column-sortable--wp-25095
 *
 * @since 0.1.0
 */
require_once( dirname( __FILE__ ) . '/includes/sort-columns.php' );


/**
 * Add old URL to columns.
 *
 * @since 0.1.0
 */
require_once( dirname( __FILE__ ) . '/includes/add-old-url-column.php' );


/**
 * Widgets.
 *
 * @since 0.1.0
 */
require_once( dirname( __FILE__ ) . '/includes/widget-latest-cpt.php' );
