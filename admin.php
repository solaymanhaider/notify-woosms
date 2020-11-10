<?php
function notify_woosms_scripts() {
    wp_enqueue_style( 'notify_woosms_style',  plugin_dir_url( __FILE__ ) . "/css/style.css");
}

add_action( 'admin_print_styles', 'notify_woosms_scripts' );

add_action( 'admin_menu', 'notify_woosms_add_admin_menu' );
add_action( 'admin_init', 'notify_woosms_settings_init' );


function notify_woosms_add_admin_menu(  ) {

	add_options_page( 'Notify WooSMS', 'Notify WooSMS', 'manage_options', 'notify_woosms', 'notify_woosms_options_page' );

}


function notify_woosms_settings_init(  ) {

	register_setting( 'pluginPage', 'notify_woosms_settings' );

	add_settings_section(
		'notify_woosms_pluginPage_api_section',
		__( 'API SETTINGS', 'notify-woosms' ),
		'notify_woosms_settings_api_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'notify_woosms_enable_sms',
		__( 'SMS Notification:', 'notify-woosms' ),
		'notify_woosms_enable_sms_render',
		'pluginPage',
		'notify_woosms_pluginPage_api_section'
	);

	add_settings_field(
		'notify_woosms_select_provider',
		__( 'Select SMS Provider', 'notify_woosms' ),
		'notify_woosms_select_provider_render',
		'pluginPage',
		'notify_woosms_pluginPage_api_section'
	);

  add_settings_field(
		'notify_woosms_api_key',
		__( 'API Key:', 'notify-woosms' ),
		'notify_woosms_api_key_render',
		'pluginPage',
		'notify_woosms_pluginPage_api_section'
	);

	add_settings_field(
		'notify_woosms_api_user_name',
		__( 'User Name:', 'notify-woosms' ),
		'notify_woosms_api_user_name_render',
		'pluginPage',
		'notify_woosms_pluginPage_api_section'
	);


	add_settings_field(
		'notify_woosms_api_password',
		__( 'Password:', 'notify-woosms' ),
		'notify_woosms_api_password_render',
		'pluginPage',
		'notify_woosms_pluginPage_api_section'
	);

	add_settings_field(
		'notify_woosms_api_mask',
		__( 'Masking Name:', 'notify-woosms' ),
		'notify_woosms_api_mask_render',
		'pluginPage',
		'notify_woosms_pluginPage_api_section'
	);

	add_settings_field(
		'notify_woosms_api_src',
		__( 'SenderId:', 'notify-woosms' ),
		'notify_woosms_api_src_render',
		'pluginPage',
		'notify_woosms_pluginPage_api_section'
	);

	add_settings_section(
		'notify_woosms_pluginPage_section',
		__( 'SMS TEMPLATES', 'notify-woosms' ),
		'notify_woosms_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'notify_woosms_check_order_placed',
		__( 'New Order:', 'notify-woosms' ),
		'notify_woosms_check_order_placed_render',
		'pluginPage',
		'notify_woosms_pluginPage_section'
	);

	add_settings_field(
		'notify_woosms_template_order_placed',
		__( 'SMS Template:', 'notify-woosms' ),
		'notify_woosms_template_order_placed_render',
		'pluginPage',
		'notify_woosms_pluginPage_section'
	);

	add_settings_field(
		'notify_woosms_check_order_processing',
		__( 'Order Processing:', 'notify-woosms' ),
		'notify_woosms_check_order_processing_render',
		'pluginPage',
		'notify_woosms_pluginPage_section'
	);

	add_settings_field(
		'notify_woosms_template_order_processing',
		__( 'SMS Template:', 'notify-woosms' ),
		'notify_woosms_template_order_processing_render',
		'pluginPage',
		'notify_woosms_pluginPage_section'
	);

	add_settings_field(
		'notify_woosms_check_order_completed',
		__( 'Order Complete:', 'notify-woosms' ),
		'notify_woosms_check_order_completed_render',
		'pluginPage',
		'notify_woosms_pluginPage_section'
	);

	add_settings_field(
		'notify_woosms_template_order_completed',
		__( 'SMS Template:', 'notify-woosms' ),
		'notify_woosms_template_order_completed_render',
		'pluginPage',
		'notify_woosms_pluginPage_section'
	);


}


function notify_woosms_enable_sms_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='checkbox' name='notify_woosms_settings[notify_woosms_enable_sms]' <?php checked( $options['notify_woosms_enable_sms'], 1 ); ?> value='1'> Enable
	<?php

}


function notify_woosms_select_provider_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<select name='notify_woosms_settings[notify_woosms_select_provider]'>
    <option value='dianahost_psms' <?php selected( $options['notify_woosms_select_provider'], 'dianahost_psms' ); ?>>DianaHost Psms</option>
    <option value='dianahost_esms' <?php selected( $options['notify_woosms_select_provider'], 'dianahost_esms' ); ?>>DianaHost Esms</option>
    <option value='dianahost_gsms' <?php selected( $options['notify_woosms_select_provider'], 'dianahost_gsms' ); ?>>DianaHost Gsms</option>
	</select>
	<?php

}

function notify_woosms_api_key_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='text' name='notify_woosms_settings[notify_woosms_api_key]' value='<?php echo $options['notify_woosms_api_key']; ?>'>
  <p><i>If you use API KEY, You don't have to enter user name and password.</i></p>
	<?php

}

function notify_woosms_api_user_name_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='text' name='notify_woosms_settings[notify_woosms_api_user_name]' value='<?php echo $options['notify_woosms_api_user_name']; ?>'>
	<?php

}


function notify_woosms_api_password_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='password' name='notify_woosms_settings[notify_woosms_api_password]' value='<?php echo $options['notify_woosms_api_password']; ?>'>
	<?php

}

function notify_woosms_api_src_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='text' name='notify_woosms_settings[notify_woosms_api_src]' value='<?php echo $options['notify_woosms_api_src']; ?>'>
	<?php

}

function notify_woosms_api_mask_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='text' name='notify_woosms_settings[notify_woosms_api_mask]' value='<?php echo $options['notify_woosms_api_mask']; ?>'>
	<?php

}


function notify_woosms_check_order_placed_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='checkbox' name='notify_woosms_settings[notify_woosms_check_order_placed]' <?php checked( $options['notify_woosms_check_order_placed'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function notify_woosms_template_order_placed_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<textarea cols='40' rows='5' name='notify_woosms_settings[notify_woosms_template_order_placed]'><?php echo $options['notify_woosms_template_order_placed']; ?></textarea>
	<?php

}


function notify_woosms_check_order_processing_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='checkbox' name='notify_woosms_settings[notify_woosms_check_order_processing]' <?php checked( $options['notify_woosms_check_order_processing'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function notify_woosms_template_order_processing_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<textarea cols='40' rows='5' name='notify_woosms_settings[notify_woosms_template_order_processing]'><?php echo $options['notify_woosms_template_order_processing']; ?></textarea>
	<?php

}


function notify_woosms_check_order_completed_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<input type='checkbox' name='notify_woosms_settings[notify_woosms_check_order_completed]' <?php checked( $options['notify_woosms_check_order_completed'], 1 ); ?> value='1'> Enable SMS
	<?php

}


function notify_woosms_template_order_completed_render(  ) {

	$options = get_option( 'notify_woosms_settings' );
	?>
	<textarea cols='40' rows='5' name='notify_woosms_settings[notify_woosms_template_order_completed]'><?php echo $options['notify_woosms_template_order_completed']; ?></textarea>
	<?php

}


function notify_woosms_settings_section_callback(  ) {

	echo __( 'Please enter your sms body text you want to send. <p>Use <span>{{ordernumber}}</span> <span>{{customername}}</span> for dynamic information.</p>', 'notify-woosms' );

}

function notify_woosms_settings_api_section_callback(  ) {

	echo __( 'Please enter your SMS API information of Notify.', 'notify-woosms' );

}


function notify_woosms_options_page(  ) {

		?>
		<div class="notify_woosms_settings_page">
			<div class="notify_woosms_settings_page_inner">
				<div class="notify_woosms_settings_page_header">

					<div class="notify_woosms_settings_page_header_info">
						<h2><?php echo __("Notify WooSMS");?></h2>
					</div>
				</div>
				<div class="notify_woosms_settings_page_body">
					<form action='options.php' method='post'>
						<?php
						settings_fields( 'pluginPage' );
						do_settings_sections( 'pluginPage' );
						submit_button();
						?>
					</form>
				</div>
				<div class="notify_woosms_settings_page_footer">
					<h4><strong><?php echo __("Please Note:</strong> This is a third-party plugin.<br>This plugin is not developed or managed by SMS providers.");?></h4>
					<p>Developed by: <a href="https://solaymanhaider.com" target="_blank"><?php echo __("Solayman Haider");?></a></p>
				</div>
			</div>
		</div>

		<?php

}
