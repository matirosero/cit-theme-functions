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
		'name' => __( 'Phone number', 'mro-cit-functions' ),
		// 'desc' => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'   => $prefix . 'phone',
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

add_action( 'cmb2_admin_init', 'mro_cit_register_user_personal_metabox' );
function mro_cit_register_user_personal_metabox() {
	$prefix = 'mro_cit_user_';
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'afiliado_personal_edit',
		'title'            => __( 'Afiliado Personal Profile Metabox', 'mro-cit-functions' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		'show_on' 			=> array( 
								'key' => 'role', 
								'value' => 'afiliado_personal' 
								),
	) );

	$cmb_user->add_field( array(
		'name'     => __( 'Afiliado Personal', 'mro-cit-functions' ),
		// 'desc'     => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'       => $prefix . 'afiliado_personal_title',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Occupation', 'mro-cit-functions' ),
		// 'desc' => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'   => $prefix . 'occupation',
		'type' => 'text',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Company', 'mro-cit-functions' ),
		// 'desc' => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'   => $prefix . 'company',
		'type' => 'text',
	) );
}


add_action( 'cmb2_admin_init', 'mro_cit_register_user_enterprise_metabox' );
function mro_cit_register_user_enterprise_metabox() {
	$prefix = 'mro_cit_user_';
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'afiliado_enterprise_edit',
		'title'            => __( 'Afiliado Enterprise Profile Metabox', 'mro-cit-functions' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		'show_on' 			=> array( 
								'key' => 'role', 
								'value' => array(
									'afiliado_enterprise', 
									'afiliado_enterprise_pendiente'),
								),
	) );

	$cmb_user->add_field( array(
		'name'     => __( 'Afiliado Enterprise', 'mro-cit-functions' ),
		// 'desc'     => __( 'field description (optional)', 'mro-cit-functions' ),
		'id'       => $prefix . 'afiliado_enterprise_title',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Business sector', 'mro-cit-functions' ),
		// 'desc' => __( 'Secondary contact\s first name', 'mro-cit-functions' ),
		'id'   => $prefix . 'sector',
		'type' => 'text',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Secondary Contact Email', 'demo-functions' ),
		'desc' => esc_html__( 'Email address for secondary contact', 'demo-functions' ),
		'id'   => $prefix . 'secondary_email',
		'type' => 'text_email',
		// 'repeatable' => true,
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Secondary Contact: First Name', 'mro-cit-functions' ),
		// 'desc' => __( 'Secondary contact\s first name', 'mro-cit-functions' ),
		'id'   => $prefix . 'secondary_first',
		'type' => 'text',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Secondary Contact: Last Name', 'mro-cit-functions' ),
		// 'desc' => __( 'Secondary contact\s last name', 'mro-cit-functions' ),
		'id'   => $prefix . 'secondary_last',
		'type' => 'text',
	) );
}