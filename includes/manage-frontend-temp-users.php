<?php

/*
 * Handle the cmb-frontend-form shortcode
 *
 * @param  array  $atts Array of shortcode attributes
 * @return string       Form html
 */
function mro_cit_frontend_manage_temp_subscribers_shortcode( $atts = array() ) {

    global $current_user, $wp_roles;

    // Current user
    $user_id = get_current_user_id();
    $name = $current_user->display_name;


    $page_id = get_the_ID();


    // User is logged in and can manage temp subscribers
    if ( is_user_logged_in() && current_user_can( 'manage_temp_subscribers' ) ) {

        // Use ID of metabox in mro_cit_frontend_contacts_form
        $metabox_id = 'mro_cit_temp_subscribers_frontend';

        // since post ID will not exist yet, just need to pass it something
        $object_id  = $page_id;
        // var_dump($current_user);


        // Get CMB2 metabox object
        $cmb = cmb2_get_metabox( $metabox_id, $page_id );
        // var_dump($cmb);

        // Get $cmb object_types
        $post_types = $cmb->prop( 'object_types' );
        // var_dump($cmb->prop( 'object_types' ));



        // // Parse attributes. These shortcode attributes can be optionally overridden.
        $atts = shortcode_atts( array(
            'user_id'       => $user_id ? $user_id : 1, // Current user, or admin
            // 'post_status' => 'pending',
            'post_type'     => reset( $post_types ), // Only use first object_type in array
            // 'membership'    => $role,
            // 'company'       => $name,
            // 'country'       => $current_user->mro_cit_user_country,
            // 'sector'        => $current_user->mro_cit_user_sector,
        ), $atts, 'cmb-frontend-form' );

        // Initiate our output variable
        $output = '';

        // Handle form saving (if form has been submitted)
        $new_id = wds_handle_frontend_new_post_form_submission( $cmb, $atts );

        if ( $new_id ) {

            if ( is_wp_error( $new_id ) ) {

                // If there was an error with the submission, add it to our ouput.
                $output .= '<p class="callout alert error"><strong>' . __('Error', 'mro-cit-frontend') . '</strong>: ' .  $new_id->get_error_message() . '</p>';

            } else {

                // Add notice of submission
                $output .= '<p class="callout success">' . sprintf( __( 'Your contacts have been updated, %s.', 'mro-cit-frontend' ), esc_html( $name ) ) . '</p>';
            }

        }

        // Get our form
        $output .= cmb2_get_metabox_form( $cmb, $object_id, array( 'save_button' => __( 'Save subscribers', 'mro-cit-frontend' ) ) );

    // User is not logged in or can't add contacts
    } else {

        $output = '<p class="callout warning">' . __('Your account doesn\'t have permission to see this page.', 'mro-cit-frontend') . '</p>';

    }

    return $output;

}
add_shortcode( 'cit-temp-subscribers', 'mro_cit_frontend_manage_temp_subscribers_shortcode' );


/**
 * Handles form submission on save
 *
 * @param  CMB2  $cmb       The CMB2 object
 * @param  array $post_data Array of post-data for new post
 * @return mixed            New post ID if successful
 */
function mro_cit_handle_frontend_temp_subscribers_form_submission( $cmb, $post_data = array() ) {


    // If no form submission, bail
    if ( empty( $_POST ) ) {
        return false;
    }


    // check required $_POST variables and security nonce
    if (
        ! isset( $_POST['submit-cmb'], $_POST['object_id'], $_POST[ $cmb->nonce() ] )
        || ! wp_verify_nonce( $_POST[ $cmb->nonce() ], $cmb->nonce() )
    ) {
        return new WP_Error( 'security_fail', __( 'Security check failed.', 'mro-cit-frontend' ) );
        // write_log('Security check failed.');
    }


    if ( !is_user_logged_in() ) {
        return new WP_Error( 'user_not_logged_in', __( 'You must log in to do this.' ), 'mro-cit-frontend' );
    }

    if ( !current_user_can( 'manage_temp_subscribers' ) ) {
        return new WP_Error( 'no_permission', __( 'Your account doesn\'t have permission to do this.', 'mro-cit-frontend' ) );
    }


    // Do WordPress insert_post stuff
    // Fetch sanitized values
    $sanitized_values = $cmb->get_sanitized_values( $_POST );


    // Set our post data arguments
    $additional_contacts   = $sanitized_values['mro_cit_temp_subscribers_list'];
    unset( $sanitized_values['mro_cit_temp_subscribers_list'] );
}