<?php
ob_start();
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

class ControllerExtensionPaymentibill extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/ibill');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ibill', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));

		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_production'] = $this->language->get('text_production');
		$data['text_sandbox'] = $this->language->get('text_sandbox');
		
		$data['text_no'] = $this->language->get('text_no');
		$data['text_yes'] = $this->language->get('text_yes');
		
		$data['text_authorization'] = $this->language->get('Authorization');
		$data['text_sale'] = $this->language->get('Sale');
		

		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_apikey'] = $this->language->get('entry_apikey');
		$data['entry_mid'] = $this->language->get('entry_mid');
		$data['entry_debug'] = $this->language->get('entry_debug');
		$data['entry_url'] = $this->language->get('entry_url');
		
		$data['entry_sandbox'] = $this->language->get('entry_sandbox');
		$data['entry_transaction'] = $this->language->get('entry_transaction');
		
		$data['help_rurl'] = $this->language->get('help_rurl');
		$data['help_mid'] = $this->language->get('help_mid');
		$data['help_apikey'] = $this->language->get('help_apikey');
		$data['help_debug'] = $this->language->get('help_debug');
		$data['help_total'] = $this->language->get('help_total');
        $data['entry_isolang'] = $this->language->get('entry_isolang');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['key'])) {
			$data['error_apikey'] = $this->error['apikey'];
		} else {
			$data['error_apikey'] = '';
		}

		if (isset($this->error['mid'])) {
			$data['error_mid'] = $this->error['mid'];
		} else {
			$data['error_mid'] = '';
		}
if (isset($this->error['lang'])) {
			$data['error_lang'] = $this->error['lang'];
		} else {
			$data['error_lang'] = '';
		}

		$data['breadcrumbs'] = array();
		
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/ibill', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/ibill', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
		
		

		if (isset($this->request->post['ibill_apikey'])) {
			$data['ibill_apikey'] = $this->request->post['ibill_apikey'];
		} else {
			$data['ibill_apikey'] = $this->config->get('ibill_apikey');
		}

		if (isset($this->request->post['ibill_mid'])) {
			$data['ibill_mid'] = $this->request->post['ibill_mid'];
		} else {
			$data['ibill_mid'] = $this->config->get('ibill_mid');
		}
		

		if (isset($this->request->post['ibill_debug'])) {
			$data['ibill_debug'] = $this->request->post['ibill_debug'];
		} else {
			$data['ibill_debug'] = $this->config->get('ibill_debug');
		}

		if (isset($this->request->post['ibill_order_status_id'])) {
			$data['ibill_order_status_id'] = $this->request->post['ibill_order_status_id'];
		} else {
			$data['ibill_order_status_id'] = $this->config->get('ibill_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['ibill_geo_zone_id'])) {
			$data['ibill_geo_zone_id'] = $this->request->post['ibill_geo_zone_id'];
		} else {
			$data['ibill_geo_zone_id'] = $this->config->get('ibill_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['ibill_status'])) {
			$data['ibill_status'] = $this->request->post['ibill_status'];
		} else {
			$data['ibill_status'] = $this->config->get('ibill_status');
		}

		if (isset($this->request->post['ibill_sort_order'])) {
			$data['ibill_sort_order'] = $this->request->post['ibill_sort_order'];
		} else {
			$data['ibill_sort_order'] = $this->config->get('ibill_sort_order');
			
			
		}
		


		if(($_SERVER['HTTPS'])) 
		{
		    $data['ibill_returnurl'] = HTTPS_CATALOG.'index.php?route=extension/payment/ibill/callback/';
		}
		else
		{
		    $data['ibill_returnurl'] = HTTP_CATALOG.'index.php?route=extension/payment/ibill/callback/';
		}
		


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/ibill', $data));
		

	}

   public function install() {
		$this->load->model('extension/payment/ibill');

		$this->model_extension_payment_ibill->install();
	}

	public function uninstall() {
		$this->load->model('extension/payment/ibill');

		$this->model_extension_payment_ibill->uninstall();
	}
	
	
	public function logs() {
		$this->load->language('extension/payment/ibill');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_id'] = $this->language->get('column_id');
		$data['column_data'] = $this->language->get('column_data');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_time'] = $this->language->get('column_time');
		$data['column_logs_detail'] = $this->language->get('column_logs_detail');


		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['logs'] = array();

		$this->load->model('extension/payment/ibill');

		$results = $this->model_extension_payment_ibill->getLogs(($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['logs'][] = array(
				'order_id'       	=> $result['order_id'],
				'data'     			=> $result['data'],
				'status'    		=> nl2br($result['status']),
				'date_added' 		=> $result['time']
			);
		}

		$logs_total = $this->model_extension_payment_ibill->getTotalLogs();
		

		$pagination = new Pagination();
		$pagination->total = $logs_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('extension/payment/ibill/logs', 'token=' . $this->session->data['token'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($logs_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($logs_total - 10)) ? $logs_total : ((($page - 1) * 10) + 10), $logs_total, ceil($logs_total / 10));

		$this->response->setOutput($this->load->view('extension/payment/ibill_logs.tpl', $data));
	}

	
	
	
	public function installMYRcurrency() {

		$this->load->language('extension/payment/ibill');
		$this->load->model('localisation/currency');
		$this->model_localisation_currency->addCurrency($this->request->post);
		echo $success_currency = $this->language->get('success_currency');
	}

	protected function validate() {
		$this->load->model('extension/payment/ibill');

		$check_credentials = true;

		if (version_compare(phpversion(), '5.4.0', '<')) {
			$this->error['warning'] = $this->language->get('error_php_version');
		}

		if (!$this->user->hasPermission('modify', 'extension/payment/ibill')) {
			$this->error['warning'] = $this->language->get('error_permission');

			$check_credentials = false;
		}

		if (!$this->request->post['ibill_apikey']) {
			$this->error['apikey'] = $this->language->get('error_apikey');

			$check_credentials = false;
		}

		if (!$this->request->post['ibill_mid']) {
			$this->error['mid'] = $this->language->get('error_mid');

			$check_credentials = false;
		}

		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		// Check if MYR currency installed or not
		$this->load->model('extension/payment/ibill');
		$currency_total = $this->model_extension_payment_ibill->getMYRcurrency();

		$currency_total;
		if(!$currency_total) {
			$this->error['lang'] = $this->language->get('error_lang');
		}

		return !$this->error;
	}
	
}