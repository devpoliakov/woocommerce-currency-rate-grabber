<?php 

/*
Plugin Name: WC currency rate grabber
Plugin URI: http://devpoliakov.com/
Description: Get your currency rate from the preffer source
Version: 0.1.1
Author: Poliakov Yurii
Author URI: 
*/


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
/**
* variables
*/
$cleanRows = unserialize(get_option('testusBlankkey'));


// Hook for adding admin menus
add_action('admin_menu', 'cr_grabber_add_pages');

// action function for above hook
function cr_grabber_add_pages() {
  add_submenu_page( 'woocommerce', 'Your currency rate configuration', 'Currency rate',
                'administrator', 'currency_rate_options_page', 'currency_rate_options_page');
}

require_once 'inc/options_page.php';





// register hook
add_action( 'wp', 'curency_cron_activation' );
function curency_cron_activation() {
    if ( ! wp_next_scheduled( 'curency_upd_cron' ) )
        wp_schedule_event( time(), 'hourly', 'curency_upd_cron' );
}


add_action( 'curency_upd_cron', 'available_currencies' );
function available_currencies(){
	$daily_exchange_json = file_get_contents('http://www.floatrates.com/daily/qar.json');
	$daily_exchange = json_decode($daily_exchange_json, true);

	$currency_arr = json_encode($daily_exchange['usd']);

	// set rates to option
	update_option('wc_exchange_rate', $currency_arr);

}