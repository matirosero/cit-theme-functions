<?php

add_action( 'cmb2_admin_init', 'mro_cit_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function mro_cit_register_user_profile_metabox() {
	$prefix = 'mro_cit_user_';
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'User Profile Metabox', 'mro-cit-functions' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => __( 'Extra Info', 'mro-cit-functions' ),
		// 'desc'     => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'             => esc_html__( 'Membership type', 'mro-cit-functions' ),
		'id'               => $prefix . 'membership',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'Afiliado Personal' => 'Afiliado Personal',
			'Afiliado Enterprise' => 'Afiliado Enterprise',
		),
		'after_field'  => '<p>La cuota anual para Afiliados Enterprise es $650. Le daremos seguimiento a su inscripción por correo.</p>',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Company', 'mro-cit-functions' ),
		// 'desc' => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'   => $prefix . 'company',
		'type' => 'text',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Phone number', 'mro-cit-functions' ),
		// 'desc' => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'   => $prefix . 'phone',
		'type' => 'text',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Occupation', 'mro-cit-functions' ),
		// 'desc' => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'   => $prefix . 'occupation',
		'type' => 'text',
	) );

	$cmb_user->add_field( array(
		'name'             => esc_html__( 'Country', 'mro-cit-functions' ),
		'id'               => $prefix . 'country',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => country_list(),
	) );
}