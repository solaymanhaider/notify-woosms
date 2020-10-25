<?php
/**
 * @package notify_woosms
 * @version 2.0
 */
/*
Plugin Name: Notify WooSMS
Plugin URI: https://wordpress.org/plugins/notify-woosms/
Description: WooCommerce order status sms notifications plugin for Bangladeshi SMS service providers.
Author: Solayman Haider
Version: 1.0
Author URI: https://solaymanhaider.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

include( plugin_dir_path( __FILE__ ) . 'admin.php');
include( plugin_dir_path( __FILE__ ) . 'sms.php');
include( plugin_dir_path( __FILE__ ) . 'woocommerce.php');
