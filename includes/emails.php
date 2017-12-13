<?php
/**
 * redefine new user notification function
 *
 * emails new users their login info
 * http://www.webtipblog.com/change-wordpress-user-registration-welcome-email/
 *
 * @author  Joe Sexton <joe@webtipblog.com>
 * @param   integer $user_id user id
 * @param   string $plaintext_pass optional password
 */
if ( !function_exists( 'wp_new_user_notification' ) ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
 
        // set content type to html
        add_filter( 'wp_mail_content_type', 'wpmail_content_type' );
 
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