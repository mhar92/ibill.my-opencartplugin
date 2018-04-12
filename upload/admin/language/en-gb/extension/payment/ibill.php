<?php
/**
 * Plugin Name: Opencart plugin for ibill.my
 * Plugin URI: https://ibill.my/merchant/
 * Description: Enable online payments using online banking thorugh ibill.my Malaysia Online Payment & Billing Solutions Provider.
 * Version: 1.0.0
 * Author: ibill.my
 * Author URI: https://ibill.my/
 * OC requires: 2.3.0.2
 * OC tested up to: 2.3.0.2
*/
// Heading
$_['heading_title']					= 'iBill.my Malaysia Payment Solution';

// Text
$_['text_payment']					= 'Payment';
$_['text_success']					= 'Successfully modified ibill.my plugin module!';
$_['text_edit']                     = 'Edit plugin ';
$_['text_ibill']					= '<a href="https://ibill.my/" target="_blank"><img src="view/image/payment/ibill_logo.png" alt="ibill" title="ibill" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_production']				= 'Production';
$_['text_sandbox']					= 'Sandbox';
$_['text_payment_info']				= 'Refund information';
$_['text_no_refund']				= 'No refund history';
$_['text_confirm_refund']			= 'Are you sure you want to refund';
$_['text_na']						= 'N/A';
$_['text_success_action']			= 'Success';
$_['text_error_generic']			= 'Error: There was an error with your request. Please check the logs.';

// Column
$_['column_refund']					= 'Refund';
$_['column_date']					= 'Date';
$_['column_refund_history']			= 'Refund History';
$_['column_action']					= 'Action';
$_['column_status']					= 'Status';
$_['column_amount']					= 'Amount';
$_['column_description']			= 'Description';


$_['column_id']                     = 'Order_id';
$_['column_data']                   = 'Data';
$_['column_status']                 = 'Payment Response Status';
$_['column_time']                   = 'Date - Time';
$_['column_logs_detail']            = 'Logs Details';

// Entry
$_['entry_total']					= 'Total';
$_['entry_order_status']			= 'Order Status';
$_['entry_geo_zone']				= 'Geo Zone';
$_['entry_status']					= 'Status';
$_['entry_sort_order']				= 'Sort Order';
$_['entry_apikey']					= 'API Secret Key';
$_['entry_mid']					    = 'App ID';
$_['entry_debug']					= 'Payment Details';
$_['entry_sandbox']					= 'Sandbox Mode';
$_['entry_transaction']				= 'Transaction Method';
$_['entry_url']                     =  'Return Url';
$_['entry_isolang']				    = 'Language';


// Help
$_['help_rurl']						= 'Copy this URL and set on your iBill.my account';
$_['help_mid']						= 'Get your API ID on iBill.my account';
$_['help_apikey']					= 'Get your API Secret Key on iBill.my account';
$_['help_debug']					= 'Enabling this will show return payment data to Payment Details section. We encourage you to always enabled.';
$_['help_total']					= 'The checkout total the order must reach before this payment method becomes active.';

// Button
$_['button_refund']					= 'Refund';

//success
$_['success_currency']				 = 'MYR currency Installed.';

// Error
$_['error_key']						= 'Key Required!';
$_['error_secret']					= 'Secret Required!';
$_['error_composer']				= 'Unable to load ibill.my SDK. Please download a compiled vendor folder or run composer.';
$_['error_php_version']				= 'Minimum version of PHP 5.4.0 is required!';
$_['error_permission']				= 'Warning: You do not have permission to modify payment ibill!';
$_['error_connection']				= 'There was a problem establishing a connection to the ibill API. Please check your Key and Secret settings.';
$_['error_warning']					= 'Warning: Please check the form carefully for errors!';
$_['$error_returnurl']              = 'Warning: Please enter return url';
$_['error_lang']				    = 'MYR Curreny not Installed! Close this box to install MYR currency';