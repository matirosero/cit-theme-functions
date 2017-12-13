<?php

//1. Add a new form element...
add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';

        ?>
        <p>
            <label for="first_name"><?php _e( 'First Name', 'mydomain' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
        </p>
        <?php

    $last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : '';

        ?>
        <p>
            <label for="last_name"><?php _e( 'Last Name', 'mydomain' ) ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
        </p>
        <?php

    $mro_cit_user_company = ( ! empty( $_POST['mro_cit_user_phone'] ) ) ? trim( $_POST['mro_cit_user_company'] ) : '';

        ?>
        <p>
            <label for="mro_cit_user_company"><?php _e( 'Company', 'mydomain' ) ?><br />
                <input type="text" name="mro_cit_user_company" id="mro_cit_user_company" class="input" value="<?php echo esc_attr( wp_unslash( $mro_cit_user_company ) ); ?>" size="25" /></label>
        </p>
        <?php

    $mro_cit_user_membership = ( ! empty( $_POST['mro_cit_user_membership'] ) ) ? trim( $_POST['mro_cit_user_membership'] ) : '';

        ?>
        <p>
            <label for="mro_cit_user_membership"><?php _e( 'Membership type', 'mydomain' ) ?><br />

                <select class="cmb2_select" name="mro_cit_user_membership" id="mro_cit_user_membership">

                    <option value="afiliado_personal" selected="selected">Afiliado Personal</option>
                    <option value="afiliado_enterprise">Afiliado Enterprise</option>

                </select>
             </label>
        </p>

        <p>La cuota anual para Afiliados Enterprise es $650. Le daremos seguimiento a su inscripción por correo.</p>

        <?php

    $mro_cit_user_phone = ( ! empty( $_POST['mro_cit_user_phone'] ) ) ? trim( $_POST['mro_cit_user_phone'] ) : '';

        ?>
        <p>
            <label for="mro_cit_user_phone"><?php _e( 'Phone', 'mydomain' ) ?><br />
                <input type="text" name="mro_cit_user_phone" id="mro_cit_user_phone" class="input" value="<?php echo esc_attr( wp_unslash( $mro_cit_user_phone ) ); ?>" size="25" /></label>
        </p>
        <?php

    $mro_cit_user_occupation = ( ! empty( $_POST['mro_cit_user_occupation'] ) ) ? trim( $_POST['mro_cit_user_occupation'] ) : '';

        ?>
        <p>
            <label for="mro_cit_user_occupation"><?php _e( 'Occupation', 'mydomain' ) ?><br />
                <input type="text" name="mro_cit_user_occupation" id="mro_cit_user_occupation" class="input" value="<?php echo esc_attr( wp_unslash( $mro_cit_user_occupation ) ); ?>" size="25" /></label>
        </p>
        <?php

    $mro_cit_user_country = ( ! empty( $_POST['mro_cit_user_country'] ) ) ? trim( $_POST['mro_cit_user_country'] ) : '';

        ?>
        <p>
            <label for="mro_cit_user_country"><?php _e( 'Country', 'mydomain' ) ?><br />

                <select class="cmb2_select" name="mro_cit_user_country" id="mro_cit_user_country">

                    <?php
                    $countries = country_list();

                    foreach ($countries as $key => $country) {
                        echo '<option value="' . $key . '">' . $country . '</option>';
                    }
                    ?>

                </select>
             </label>
        </p>
        <?php
}




//2. Add validation. In this case, we make sure first_name is required.
add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    // First name is not empty
    if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        $errors->add( 'first_name_error', __( '<strong>ERROR</strong>: Please include your first name.', 'mydomain' ) );
    }

    // Last name is not empty
    if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
        $errors->add( 'last_name_error', __( '<strong>ERROR</strong>: Please include your last name.', 'mydomain' ) );
    }

    // Valid membership type
    if ( ! empty( $_POST['mro_cit_user_membership'] ) && trim( $_POST['mro_cit_user_membership'] ) != '' ) {

        if ( ! mro_cit_validate_membership( $_POST['mro_cit_user_membership'] ) ) {
            $errors->add( 'membership_error', __( '<strong>ERROR</strong>: Please enter a valid membership type.', 'mydomain' ) );
        }
    }

    // Valid country
    if ( ! empty( $_POST['mro_cit_user_country'] ) && trim( $_POST['mro_cit_user_country'] ) != '' ) {

        if ( ! mro_cit_validate_country( $_POST['mro_cit_user_country'] ) ) {
            $errors->add( 'country_error', __( '<strong>ERROR</strong>: Please choose a valid country.', 'mydomain' ) );
        }
    }

    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'myplugin_user_register' );
function myplugin_user_register( $user_id ) {

    if ( ! empty( $_POST['first_name'] ) ) {
        $first_name = sanitize_text_field( $_POST['first_name'] );
        update_user_meta( $user_id, 'first_name', $first_name );
    }

    if ( ! empty( $_POST['last_name'] ) ) {
        $last_name = sanitize_text_field( $_POST['last_name'] );
        update_user_meta( $user_id, 'last_name', $last_name );
    }

    if ( ! empty( $_POST['mro_cit_user_company'] ) ) {
        $company = sanitize_text_field( $_POST['mro_cit_user_company'] );
        update_user_meta( $user_id, 'mro_cit_user_company', $company );
    }

    if ( ! empty( $_POST['mro_cit_user_phone'] ) ) {
        $phone = sanitize_text_field( $_POST['mro_cit_user_phone'] );
        update_user_meta( $user_id, 'mro_cit_user_phone', $phone );
    }

    if ( ! empty( $_POST['mro_cit_user_occupation'] ) ) {
        $occupation = sanitize_text_field( $_POST['mro_cit_user_occupation'] );
        update_user_meta( $user_id, 'mro_cit_user_occupation', $occupation );
    }

    if ( ! empty( $_POST['mro_cit_user_country'] ) ) {
        $country = sanitize_meta( 'mro_cit_user_country', $_POST['mro_cit_user_country'], 'user' );
        update_user_meta( $user_id, 'mro_cit_user_country', $country );
    }

    if ( ! empty( $_POST['mro_cit_user_membership'] ) ) {
        $membership = sanitize_meta( 'mro_cit_user_membership', $_POST['mro_cit_user_membership'], 'user' );
        update_user_meta( $user_id, 'mro_cit_user_membership', $membership );
    }
}