<?php
/**
 * redefine new user notification function
 *
 * emails new users their login info
 * http://www.webtipblog.com/change-wordpress-user-registration-welcome-email/
 * http://www.webtipblog.com/change-wordpress-user-registration-welcome-email/
 *
 */
if ( !function_exists( 'wp_new_user_notification' ) ) {
    function wp_new_user_notification( $user_id, $deprecated = null, $notify = '' ) {

		if ( $deprecated !== null ) {
			_deprecated_argument( __FUNCTION__, '4.3.1' );
		}

        // set content type to html
        // add_filter( 'wp_mail_content_type', 'wpmail_content_type' );

		global $wpdb, $wp_hasher;
		$user = get_userdata( $user_id );

		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

		// $membership_type = $user->mro_cit_user_membership;

		$user_roles = $user->roles;

		if ( 'user' !== $notify ) {
			$switched_locale = switch_to_locale( get_locale() );

			// if ( $membership_type == 'Afiliado Enterprise' ) {
			if ( in_array('afiliado_enterprise_pendiente', $user_roles) ) {

				$subject = 'Solicitud de afiliación empresarial al Club de Investigación Tecnológica';

				$message  = sprintf( __( 'Se ha registrado un nuevo afiliado en %s, y desea ser un Afiliado Empresarial.' ), $blogname ) . "\r\n\r\n";

				$message .= sprintf( __( 'Empresa: %s' ), $user->nickname ) . "\r\n\r\n";

				
				$recipient = array(
					get_option( 'admin_email' ),
					'matirosero@icloud.com',
				);

			} else {
				$subject = 'Nuevo afiliado personal al  Club de Investigación Tecnológica';

				/* translators: %s: site title */
				$message  = sprintf( __( 'Se ha registrado un nuevo afiliado en %s:' ), $blogname ) . "\r\n\r\n";
				
				$recipient = get_option( 'admin_email' );
			}
			
			/* translators: %s: user login */
			$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
			/* translators: %s: user email address */
			$message .= sprintf( __( 'Email: %s' ), $user->user_email ) . "\r\n";

			$wp_new_user_notification_email_admin = array(
				'to'      => $recipient,
				/* translators: Password change notification email subject. %s: Site title */
				'subject' => $subject,
				'message' => $message,
				'headers' => '',
			);

			/**
			 * Filters the contents of the new user notification email sent to the site admin.
			 *
			 * @since 4.9.0
			 *
			 * @param array   $wp_new_user_notification_email {
			 *     Used to build wp_mail().
			 *
			 *     @type string $to      The intended recipient - site admin email address.
			 *     @type string $subject The subject of the email.
			 *     @type string $message The body of the email.
			 *     @type string $headers The headers of the email.
			 * }
			 * @param WP_User $user     User object for new user.
			 * @param string  $blogname The site title.
			 */
			$wp_new_user_notification_email_admin = apply_filters( 'wp_new_user_notification_email_admin', $wp_new_user_notification_email_admin, $user, $blogname );

			@wp_mail(
				$wp_new_user_notification_email_admin['to'],
				wp_specialchars_decode( sprintf( $wp_new_user_notification_email_admin['subject'], $blogname ) ),
				$wp_new_user_notification_email_admin['message'],
				$wp_new_user_notification_email_admin['headers']
			);

			if ( $switched_locale ) {
				restore_previous_locale();
			}
		}


		//New user email
		// `$deprecated was pre-4.3 `$plaintext_pass`. An empty `$plaintext_pass` didn't sent a user notification.
		if ( 'admin' === $notify || ( empty( $deprecated ) && empty( $notify ) ) ) {
			return;
		}

		// Generate something random for a password reset key.
		$key = wp_generate_password( 20, false );

		/** This action is documented in wp-login.php */
		do_action( 'retrieve_password_key', $user->user_login, $key );

		// Now insert the key, hashed, into the DB.
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . WPINC . '/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );

		$switched_locale = switch_to_locale( get_user_locale( $user ) );

		/* translators: %s: user login */
		$message = 'Bienvenido al Club de Investigación Tecnológica, ' . $user->first_name . "\r\n\r\n";
		$message .= 'Nos da mucho gusto que se ha unido a nosotros.' . "\r\n\r\n";
		$message .= 'A continuación, encontrará información importante sobre su cuenta.' . "\r\n\r\n";

		$message .= sprintf(__('Usuario: %s'), $user->user_login) . "\r\n\r\n";
		$message .= __('Para establecer su contraseña, visite la siguiente dirección:') . "\r\n\r\n";
		$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . ">\r\n\r\n";


		$message .= 'Saludos cordiales,' . "\r\n\r\n";
		$message .= 'Club de Investigación Tecnológica' . "\r\n";
		$message .= site_url();

		$wp_new_user_notification_email = array(
			'to'      => $user->user_email,
			/* translators: Password change notification email subject. %s: Site title */
			'subject' => __( 'Bienvenido al Club de Investigación Tecnológica' ),
			'message' => $message,
			'headers' => '',
		);

		/**
		 * Filters the contents of the new user notification email sent to the new user.
		 *
		 * @since 4.9.0
		 *
		 * @param array   $wp_new_user_notification_email {
		 *     Used to build wp_mail().
		 *
		 *     @type string $to      The intended recipient - New user email address.
		 *     @type string $subject The subject of the email.
		 *     @type string $message The body of the email.
		 *     @type string $headers The headers of the email.
		 * }
		 * @param WP_User $user     User object for new user.
		 * @param string  $blogname The site title.
		 */
		$wp_new_user_notification_email = apply_filters( 'wp_new_user_notification_email', $wp_new_user_notification_email, $user, $blogname );

		wp_mail(
			$wp_new_user_notification_email['to'],
			wp_specialchars_decode( sprintf( $wp_new_user_notification_email['subject'], $blogname ) ),
			$wp_new_user_notification_email['message'],
			$wp_new_user_notification_email['headers']
		);

		if ( $switched_locale ) {
			restore_previous_locale();
		}


/*
 
        // user
        $user = new WP_User( $user_id );
        $userEmail = stripslashes( $user->user_email );
        $siteUrl = get_site_url();
        $logoUrl = plugin_dir_url( __FILE__ ).'/images/logo_cit.png';
 
        $subject = 'Bienvenido al Club de Investigaci&oacute;n Tecnol&oacute;gica';
        $headers = 'From: Club de Investigaci&oacute;n Tecnol&oacute;gica <gekidasa@gmail.com>';
 
        // admin email
        $message  = "Un nuevo afiliado ha sido registrado"."\r\n\r\n";
        $message .= 'Email: '.$userEmail."\r\n";
        @wp_mail( get_option( 'admin_email' ), 'Nuevo afiliado', $message, $headers );
 
        ob_start();
        include plugin_dir_path( __FILE__ ).'/email_welcome.php';
        $message = ob_get_contents();
        ob_end_clean();
 
        @wp_mail( $userEmail, $subject, $message, $headers );
 
        // remove html content type
        remove_filter ( 'wp_mail_content_type', 'wpmail_content_type' );
*/
    }
}
 
/**
 * wpmail_content_type
 * allow html emails
 *
 * @author Joe Sexton <joe@webtipblog.com>
 * @return string
 */
function wpmail_content_type() {
 
    return 'text/html';
}