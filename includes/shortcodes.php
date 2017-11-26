<?php

/**
 * Register all shortcodes
 *
 * @return null
 */
function mro_cit_theme_functions_register_shortcodes() {
    add_shortcode('junta', 'mro_cit_board_members');
}
add_action( 'init', 'mro_cit_theme_functions_register_shortcodes' );

/*
 * List board members
 * - [junta]
 *
 * Returns list of board memb ers
 */
function mro_cit_board_members($atts) {
    global $wp_query,
        $post;

    /*
	 * The WordPress Query class.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/WP_Query
	 */
	$args = array(



		// Type & Status Parameters
		'post_type'   => 'cit_board_members',
		'post_status' => 'publish',

		// Order & Orderby Parameters
		'order'               => 'DESC',
		'orderby'             => 'name',

		// Pagination Parameters
		'posts_per_page'         => -1,

		// Parameters relating to caching
		'cache_results'          => true,
		'update_post_term_cache' => true,
		'update_post_meta_cache' => true,

	);

    $query = new WP_Query( $args );

    if( ! $query->have_posts() ) :
        return false;
    else :
    	$content = '';

		while( $query->have_posts() ) : $query->the_post();

            $content .= '<h3 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

        endwhile; 

        wp_reset_postdata();

		return $content;
    endif;
}