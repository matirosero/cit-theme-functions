<?php

/*
 * Override the title/content field retrieval so CMB2 doesn't look in post-meta.
 */
function cmb2_override_post_title_display( $data, $post_id ) {
	return get_post_field( 'post_title', $post_id );
}
function cmb2_override_post_content_display( $data, $post_id ) {
	return get_post_field( 'post_content', $post_id );
}
add_filter( 'cmb2_override_post_title_meta_value', 'cmb2_override_post_title_display', 10, 2 );
add_filter( 'cmb2_override_post_content_meta_value', 'cmb2_override_post_content_display', 10, 2 );
/*
 * WP will handle the saving for us, so don't save title/content to meta.
 */
add_filter( 'cmb2_override_post_title_meta_save', '__return_true' );
add_filter( 'cmb2_override_post_content_meta_save', '__return_true' );



function reset_editor()
{
     global $_wp_post_type_features;

     $post_type="page";
     $feature = "editor";
     if ( !isset($_wp_post_type_features[$post_type]) )
     {

     }
     elseif ( isset($_wp_post_type_features[$post_type][$feature]) )
     unset($_wp_post_type_features[$post_type][$feature]);
}

add_action("init","reset_editor");