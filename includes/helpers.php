<?php
/**
 * Helpers.
 *
 * @since 0.1.0
 */

function mro_cit_exclude_category( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '-1, -113' );
    }
}
add_action( 'pre_get_posts', 'mro_cit_exclude_category' );



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




function mro_cit_events_archive_reverse( $query ) {

	if( $query->is_main_query() && !is_admin() && ( is_post_type_archive( 'cit_past_event' ) || is_post_type_archive( 'cit_report' ) ) ) {

		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'title' );

	}

}

add_action( 'pre_get_posts', 'mro_cit_events_archive_reverse' );