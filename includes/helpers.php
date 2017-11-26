<?php
/**
 * Helpers.
 *
 * @since 0.1.0
 */


/*
 * Include CPT in certain archives
 */
function custom_post_type_cat_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_category( array( 9, 16, 7 ) ) ) {
      $query->set( 'post_type', array( 'post', 'cit_archive' ) );
    }
  }
}

add_action('pre_get_posts','custom_post_type_cat_filter');

/*
 * Exclude categories from frontpage
 */
function mro_cit_exclude_category( $query ) {
    if ( ( $query->is_home() && $query->is_main_query() ) || ( $query->is_category( array( 15, 13 ) ) && $query->is_main_query() ) ) {
        $query->set( 'cat', '-1, -113' );
    }
}
add_action( 'pre_get_posts', 'mro_cit_exclude_category' );


/*
 * Exclude posts not from db src content from past event archive
 */
function mro_cit_events_archive_exclude( $query ) {

	if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'cit_past_event' ) ) {

		//Don't show events that come from content DB
		$taxquery = array(
	        array(
				'taxonomy' => 'mro_cit_db_src',
				'field'    => 'slug',
				'terms'    => 'src-content',
				'operator' => 'NOT IN'
	        )
	    );
	    $query->set( 'tax_query', $taxquery );

	}

}
add_action( 'pre_get_posts', 'mro_cit_events_archive_exclude' );


/*
 * Reverse past events order
 */
function mro_cit_events_archive_reverse( $query ) {

	if( $query->is_main_query() && !is_admin() && ( is_post_type_archive( 'cit_past_event' ) || is_post_type_archive( 'cit_report' ) ) ) {

		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'title' );
	}
}
add_action( 'pre_get_posts', 'mro_cit_events_archive_reverse' );


/*
 * Show other post types in author archives
 */
function mro_cit_custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('cit_report', 'post') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'mro_cit_custom_post_author_archive');

