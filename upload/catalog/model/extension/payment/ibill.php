<?php

class ModelExtensionPaymentibill extends Model {

public function addOrder($order_id, $response_data) {
      $qr = "INSERT INTO `oc_ibill_order` (`order_id`, `data`, `status`, `time`) VALUES ('".$order_id."', '".serialize($response_data)."', '".$response_data['std_status']."', now())";
      $this->db->query($qr);
	   }



	public function getMethod($address, $total) {
		$this->load->language('extension/payment/ibill');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('ibill_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('ibill_total') > 0 && $this->config->get('ibill_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('ibill_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		if (!in_array($this->session->data['currency'], $this->getSupportedCurrencies())) {
			$status = false;
		}

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'		 => 'ibill',
				'title'		 => $this->language->get('text_title'),
				'terms'		 => '',
				'sort_order' => $this->config->get('ibill_sort_order')
			);
		}

		return $method_data;
	}

	public function getSupportedCurrencies() {
		return array(
			'USD',
			'GBP',
			'EUR',
			'MYR',
			'INR'
			
		);
	}

	public function log($data, $class_step = 6, $function_step = 6) {
		if ($this->config->get('ibill_debug')) {
			$backtrace = debug_backtrace();
			$log = new Log('ibill.log');
			$log->write('(' . $backtrace[$class_step]['class'] . '::' . $backtrace[$function_step]['function'] . ') - ' . print_r($data, true));
		}
	}

	private function exception(Exception $exception) {
		$this->log($exception->getMessage(), 1, 2);

		switch (true) {
			case $exception instanceof CardinityException\Request:
				if ($exception->getErrorsAsString()) {
					$this->log($exception->getErrorsAsString(), 1, 2);
				}

				break;
			case $exception instanceof CardinityException\InvalidAttributeValue:
				foreach ($exception->getViolations() as $violation) {
					$this->log($violation->getMessage(), 1, 2);
				}

				break;
		}
	}
}