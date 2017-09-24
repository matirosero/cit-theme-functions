<?php


add_action( 'cmb2_admin_init', 'mro_cit_register_migration_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function mro_cit_register_migration_metabox() {
	$prefix = 'mro_cit_migration_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Migration Information', 'mro-cit-cpt' ),
		'object_types'  => array( 
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
		), // Post type
		// 'show_on_cb' => 'mro_cit_migration_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'mro_cit_migration_add_some_classes', // Add classes through a callback.
	) );


	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Manual author', 'mro-cit-cpt' ),
		'desc'       => esc_html__( 'Read-only: URL on old site', 'mro-cit-cpt' ),
		'id'         => '_mro_manual_author',
		'type'       => 'text',
		// 'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'mro-cit-cpt' ),
		'save_field' => false, // Disables the saving of this field.
		'attributes' => array(
			'disabled' => 'disabled',
			'readonly' => 'readonly',
		),
		'column'          => true,
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Old URL', 'mro-cit-cpt' ),
		'desc'       => esc_html__( 'Read-only: URL on old site', 'mro-cit-cpt' ),
		'id'         => '_mro_old_url',
		'type'       => 'text',
		// 'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'mro-cit-cpt' ),
		'save_field' => false, // Disables the saving of this field.
		'attributes' => array(
			'disabled' => 'disabled',
			'readonly' => 'readonly',
		),
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Manual date', 'mro-cit-cpt' ),
		'desc'       => esc_html__( 'Read-only: URL on old site', 'mro-cit-cpt' ),
		'id'         => '_mro_manual_date',
		'type'       => 'text',
		// 'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'mro-cit-cpt' ),
		'save_field' => false, // Disables the saving of this field.
		'attributes' => array(
			'disabled' => 'disabled',
			'readonly' => 'readonly',
		),
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Yoast SEO Title', 'mro-cit-cpt' ),
		'desc'       => esc_html__( 'Read-only: URL on old site', 'mro-cit-cpt' ),
		'id'         => '_yoast_wpseo_title',
		'type'       => 'text',
		// 'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'mro-cit-cpt' ),
		'save_field' => false, // Disables the saving of this field.
		'attributes' => array(
			'disabled' => 'disabled',
			'readonly' => 'readonly',
		),
	) );

	$cmb_demo->add_field( array(
		'name'       => esc_html__( 'Yoast SEO Description', 'mro-cit-cpt' ),
		'desc'       => esc_html__( 'Read-only: URL on old site', 'mro-cit-cpt' ),
		'id'         => '_yoast_wpseo_metadesc',
		'type'       => 'textarea',
		// 'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'mro-cit-cpt' ),
		'save_field' => false, // Disables the saving of this field.
		'attributes' => array(
			'disabled' => 'disabled',
			'readonly' => 'readonly',
		),
	) );
}