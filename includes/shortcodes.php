<?php

/**
 * Register all shortcodes
 *
 * @return null
 */
function mro_cit_theme_functions_register_shortcodes() {
    add_shortcode('junta', 'mro_cit_board_members');
    add_shortcode('tabla-afiliacion', 'mro_cit_membership_table');
}
add_action( 'init', 'mro_cit_theme_functions_register_shortcodes' );


/*
 * List board members
 * - [tabla-afiliacion]
 *
 * Returns pricing table
 */
function mro_cit_membership_table($atts) {

    $content = '<ul class="cd-pricing">
    <li>
        <header class="cd-pricing-header">
            <h2>Institucional</h2>
 
            <div class="cd-price">
                <span>$900</span>
                <span>mes</span>
            </div>
        </header> <!-- .cd-pricing-header -->
 
        <div class="cd-pricing-features">
            <ul>
                <li class="available"><em>Boletín informativo</em></li>
                <li class="available"><em>Acceso a informes de investigación</em></li>
                <li class="available"><em>Puede enviar 3 asistentes a desayunos mensuales</em></li>
                <li class="available"><em>Acceso remoto a desayunos (streaming)</em></li>
            </ul>
        </div> <!-- .cd-pricing-features -->
 
        <footer class="cd-pricing-footer">
            <a href="#0">Escoger</a>
        </footer> <!-- .cd-pricing-footer -->
    </li>

    <li>
        <header class="cd-pricing-header">
            <h2>Empresarial</h2>
 
            <div class="cd-price">
                <span>$650</span>
                <span>mes</span>
            </div>
        </header> <!-- .cd-pricing-header -->
 
        <div class="cd-pricing-features">
            <ul>
                <li class="available"><em>Boletín informativo</em></li>
                <li class="available"><em>Acceso a informes de investigación</em></li>
                <li class="available"><em>Puede enviar 2 asistentes a desayunos mensuales</em></li>
                <li class="available"><em>Acceso remoto a desayunos (streaming)</em></li>
            </ul>
        </div> <!-- .cd-pricing-features -->
 
        <footer class="cd-pricing-footer">
            <a href="#0">Escoger</a>
        </footer> <!-- .cd-pricing-footer -->
    </li>

    <li>
        <header class="cd-pricing-header">
            <h2>Institucional</h2>
 
            <div class="cd-price">
                <span>$900</span>
                <span>mes</span>
            </div>
        </header> <!-- .cd-pricing-header -->
 
        <div class="cd-pricing-features">
            <ul>
                <li class="available"><em>Boletín informativo</em></li>
                <li class="available"><em>Acceso a informes de investigación</em></li>
                <li class="available"><em>Puede comprar entradas a desayunos mensuales</em></li>
            </ul>
        </div> <!-- .cd-pricing-features -->
 
        <footer class="cd-pricing-footer">
            <a href="#0">Escoger</a>
        </footer> <!-- .cd-pricing-footer -->
    </li>

    </ul>';

    return $content;
}

/*
 * List board members
 * - [junta]
 *
 * Returns list of board members
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
		// 'orderby'             => 'name',
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
    	$content = '<div class="row small-up-2 medium-up-3">';

		while( $query->have_posts() ) : $query->the_post();

            $content .= '<div class="profile-block column column-block">
            	<a href="' . get_permalink() . '">'.
            	get_the_post_thumbnail($post->ID,'thumbnail', array( 'class' => 'profile-image' )).'</a>
            	<h3 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

            if ( get_post_meta( $post->ID, 'mro_cit_board_member_position', true ) ) :
            	$content .= '<div class="profile-meta"><span class="profile-position">'.get_post_meta( $post->ID, 'mro_cit_board_member_position', true ) .'</span></div>';
            endif;

            	$content .= '</div>';

        endwhile; 

        $content .= '<div>';

        wp_reset_postdata();

		return $content;
    endif;
}