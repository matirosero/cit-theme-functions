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
        $query->set( 'cat', '-1, -115' );
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
// function mro_cit_events_archive_reverse( $query ) {

// 	if( $query->is_main_query() && !is_admin() && ( is_post_type_archive( 'cit_past_event' ) || is_post_type_archive( 'cit_report' ) ) ) {

// 		$query->set( 'order', 'ASC' );
// 		$query->set( 'orderby', 'title' );
// 	}
// }
// add_action( 'pre_get_posts', 'mro_cit_events_archive_reverse' );


/*
 * Show other post types in author archives
 */
function mro_cit_custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('cit_report', 'post') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'mro_cit_custom_post_author_archive');


function country_list() {
	$countries = array(
		'Costa Rica' => 'Costa Rica',
		'Afghanistan' => 'Afghanistan',
		'Albania' => 'Albania',
		'Algeria' => 'Algeria',
		'Angola' => 'Angola',
		'Argentina' => 'Argentina',
		'Armenia' => 'Armenia',
		'Azerbaijan' => 'Azerbaijan',
		'Bahrain' => 'Bahrain',
		'Bangladesh' => 'Bangladesh',
		'Barbados' => 'Barbados',
		'Belarus' => 'Belarus',
		'Belgium' => 'Belgium',
		'Benin' => 'Benin',
		'Bhutan' => 'Bhutan',
		'Bolivia' => 'Bolivia',
		'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
		'Botswana' => 'Botswana',
		'Brazil' => 'Brazil',
		'Bulgaria' => 'Bulgaria',
		'Burkina Faso' => 'Burkina Faso',
		'Burundi' => 'Burundi',
		'Cambodia' => 'Cambodia',
		'Cameroon' => 'Cameroon',
		'Cape Verde' => 'Cape Verde',
		'Central African Republic' => 'Central African Republic',
		'Chad' => 'Chad',
		'Chile' => 'Chile',
		'China' => 'China',
		'Colombia' => 'Colombia',
		'Comoros' => 'Comoros',
		'Croatia' => 'Croatia',
		'Cuba' => 'Cuba',
		'Cyprus' => 'Cyprus',
		'Denmark' => 'Denmark',
		'Djibouti' => 'Djibouti',
		'Dominican Republic' => 'Dominican Republic',
		'Ecuador' => 'Ecuador',
		'Egypt' => 'Egypt',
		'El Salvador' => 'El Salvador',
		'Equatorial Guinea' => 'Equatorial Guinea',
		'Eritrea' => 'Eritrea',
		'Ethiopia' => 'Ethiopia',
		'Fiji' => 'Fiji',
		'Gabon' => 'Gabon',
		'Gambia' => 'Gambia',
		'Georgia' => 'Georgia',
		'Ghana' => 'Ghana',
		'Guatemala' => 'Guatemala',
		'Guinea' => 'Guinea',
		'Guinea Bissau' => 'Guinea Bissau',
		'Guyana' => 'Guyana',
		'Haiti' => 'Haiti',
		'Honduras' => 'Honduras',
		'India' => 'India',
		'Indonesia' => 'Indonesia',
		'Iran' => 'Iran',
		'Iraq' => 'Iraq',
		'Jamaica' => 'Jamaica',
		'Japan Liaison Office' => 'Japan Liaison Office',
		'Jordan' => 'Jordan',
		'Kazakhstan' => 'Kazakhstan',
		'Kenya' => 'Kenya',
		'Kuwait' => 'Kuwait',
		'Kyrgyzstan' => 'Kyrgyzstan',
		'Latvia' => 'Latvia',
		'Laos' => 'Laos',
		'Lebanon' => 'Lebanon',
		'Lesotho' => 'Lesotho',
		'Liberia' => 'Liberia',
		'Libya' => 'Libya',
		'Lithuania' => 'Lithuania',
		'Madagascar' => 'Madagascar',
		'Malawi' => 'Malawi',
		'Malaysia' => 'Malaysia',
		'Maldives' => 'Maldives',
		'Mali' => 'Mali',
		'Mauritania' => 'Mauritania',
		'Mauritius' => 'Mauritius',
		'Mexico' => 'Mexico',
		'Moldova' => 'Moldova',
		'Mongolia' => 'Mongolia',
		'Montenegro' => 'Montenegro',
		'Morocco' => 'Morocco',
		'Mozambique' => 'Mozambique',
		'Myanmar' => 'Myanmar',
		'Namibia' => 'Namibia',
		'Nepal' => 'Nepal',
		'Nicaragua' => 'Nicaragua',
		'Niger' => 'Niger',
		'Nigeria' => 'Nigeria',
		'Norway' => 'Norway',
		'Pakistan' => 'Pakistan',
		'Palestinian Programme' => 'Palestinian Programme',
		'Panama' => 'Panama',
		'Papua New Guinea' => 'Papua New Guinea',
		'Paraguay' => 'Paraguay',
		'Peru' => 'Peru',
		'Philippines' => 'Philippines',
		'Romania' => 'Romania',
		'Russian Federation' => 'Russian Federation',
		'Rwanda' => 'Rwanda',
		'Samoa' => 'Samoa',
		'Sao Tome and Principe' => 'Sao Tome and Principe',
		'Saudi Arabia' => 'Saudi Arabia',
		'Senegal' => 'Senegal',
		'Servia' => 'Serbia',
		'Seychelles' => 'Seychelles',
		'Sierra Leone' => 'Sierra Leone',
		'Slovak Republic' => 'Slovak Republic',
		'Somalia' => 'Somalia',
		'South Africa' => 'South Africa',
		'Sri Lanka' => 'Sri Lanka',
		'Sudan' => 'Sudan',
		'Swaziland' => 'Swaziland',
		'Sweden' => 'Sweden',
		'Switzerland' => 'Switzerland',
		'Syria' => 'Syria',
		'Tajikistan' => 'Tajikistan',
		'Tanzania' => 'Tanzania',
		'Thailand' => 'Thailand',
		'Timor-Leste' => 'Timor-Leste',
		'Togo' => 'Togo',
		'Trinidad and Tobago' => 'Trinidad and Tobago',
		'Tunisia' => 'Tunisia',
		'Turkey' => 'Turkey',
		'Turkmenistan' => 'Turkmenistan',
		'Uganda' => 'Uganda',
		'Ukraine' => 'Ukraine',
		'United Arab Emirates' => 'United Arab Emirates',
		'United States' => 'United States',
		'Uruguay' => 'Uruguay',
		'Uzbekistan' => 'Uzbekistan',
		'Venezuela' => 'Venezuela',
		'Viet Nam' => 'Viet Nam',
		'Yemen' => 'Yemen',
		'Zambia' => 'Zambia',
		'Zimbabwe' => 'Zimbabwe'
	);
	return $countries;
}