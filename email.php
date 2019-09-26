<?php 


/**
 * author: Andrzej Skowron
 * email: skwrn@outlook.com
 * 
 * Woocommerce - Kinguin API intergration
 */

define("HTML_EMAIL_HEADERS", array('Content-Type: text/html; charset=UTF-8'));

function send_email_woocommerce($email, $subject, $heading, $message) {
    $mailer = WC()->mailer();
    $wrapped_message = $mailer->wrap_message($heading, $message);
    $wc_email = new WC_Email;
    $html_message = $wc_email->style_inline($wrapped_message);
    wp_mail( $email, $subject, $html_message, HTML_EMAIL_HEADERS );
}