<?php

/**
 * Set up taxonomies.
 *
 * @since 0.1.0
 */

/* Set up taxonomies */
add_action( 'init', 'mro_cit_register_tax' );


/* Register taxonomies */
function mro_cit_register_tax() {

	$all_post_types = array( 
		'page', 
		'post', 
		'cit_affiliate',
		'cit_alliances',
		'cit_archive',
		'cit_unknown',
		'cit_board_members',
		'cit_past_event',
		'cit_profile',
		'cit_testimonials',
		'cit_report' 
	);

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'DB Sources', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'DB Source', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search DB Sources', 'textdomain' ),
		'popular_items'              => __( 'Popular DB Sources', 'textdomain' ),
		'all_items'                  => __( 'All DB Sources', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit DB Source', 'textdomain' ),
		'update_item'                => __( 'Update DB Source', 'textdomain' ),
		'add_new_item'               => __( 'Add New DB Source', 'textdomain' ),
		'new_item_name'              => __( 'New DB Source Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate DB sources with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove DB sources', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used DB sources', 'textdomain' ),
		'not_found'                  => __( 'No DB sources found.', 'textdomain' ),
		'menu_name'                  => __( 'DB Sources', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'db-source' ),
	);

	register_taxonomy( 'mro_cit_db_src', $all_post_types, $args );


	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Years', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Year', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Years', 'textdomain' ),
		'popular_items'              => __( 'Popular Years', 'textdomain' ),
		'all_items'                  => __( 'All Years', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Year', 'textdomain' ),
		'update_item'                => __( 'Update Year', 'textdomain' ),
		'add_new_item'               => __( 'Add New Year', 'textdomain' ),
		'new_item_name'              => __( 'New Year Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate years with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove years', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used years', 'textdomain' ),
		'not_found'                  => __( 'No years found.', 'textdomain' ),
		'menu_name'                  => __( 'Years', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'year' ),
	);

	register_taxonomy( 'mro_cit_event_year', $all_post_types, $args );


	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Weird Dates', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Weird Date', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Weird Dates', 'textdomain' ),
		'popular_items'              => __( 'Popular Weird Dates', 'textdomain' ),
		'all_items'                  => __( 'All Weird Dates', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Weird Date', 'textdomain' ),
		'update_item'                => __( 'Update Weird Date', 'textdomain' ),
		'add_new_item'               => __( 'Add New Weird Date', 'textdomain' ),
		'new_item_name'              => __( 'New Weird Date Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate weird dates with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove weird dates', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used weird dates', 'textdomain' ),
		'not_found'                  => __( 'No weird dates found.', 'textdomain' ),
		'menu_name'                  => __( 'Weird Dates', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'weird-date' ),
	);

	register_taxonomy( 'mro_cit_weird_date', $all_post_types, $args );
}