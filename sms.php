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

	if ($options['notify_woosms_select_provider'] == 'dianahost_psms') {
		$response = wp_remote_post( 'https://psms.dianahost.com/api/sms/v1/send', $args );
	} elseif ($options['notify_woosms_select_provider'] == 'dianahost_esms') {
		$apikey = $options['notify_woosms_api_key'];
		$response = wp_remote_post( 'http://esms.hostdokan.com/smsapi?api_key='.$apikey.'&type=text&contacts='.$mobilenumber.'&msg='.$smsbodytext.'&senderid='.$options['notify_woosms_api_mask'] );
	} elseif ($options['notify_woosms_select_provider'] == 'dianahost_gsms') {
		$apikey = $options['notify_woosms_api_key'];
		$response = wp_remote_post( 'http://gsms.pw/smsapi?api_key='.$apikey.'&type=text&contacts='.$mobilenumber.'&msg='.$smsbodytext.'&senderid='.$options['notify_woosms_api_mask'] );
	}  elseif ($options['notify_woosms_select_provider'] == 'tiniyo') {
		$url = 'https://api.tiniyo.com/v1/Account/' . $options['notify_woosms_api_user_name'] . '/Message'
		$body = array(
			'dst' => $mobilenumber,
			'src' => $options['notify_woosms_src'],
			'text' => $smsbodytext
		);
		$response = wp_remote_post( $url, array(
			'body'    => $data,
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( $options['notify_woosms_api_user_name'] . ':' . $options['notify_woosms_api_password'] ),
				'Content-Type' => 'application/json',
			),
		) );
	}


	return false;
}
