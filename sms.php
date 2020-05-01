<?php
function notify_woosms_send_sms($mobilenumber, $smsbodytext){
	$options = get_option( 'notify_woosms_settings' );
	$body = array(
    'recipient' => $mobilenumber,
    'sender' => $options['notify_woosms_api_mask'],
    'body' => $smsbodytext,
    'userid' => $options['notify_woosms_api_user_name'],
    'password' => $options['notify_woosms_api_password']
	);

	$args = array(
	    'body' => $body,
	    'timeout' => '5',
	    'redirection' => '5',
	    'httpversion' => '1.0',
	    'blocking' => true,
	    'headers' => array(),
	    'cookies' => array()
	);

	$response = wp_remote_post( 'https://psms.dianahost.com/api/sms/v1/send', $args );

	return false;
}
