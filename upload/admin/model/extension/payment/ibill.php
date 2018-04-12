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
class ModelExtensionPaymentibill extends Model {
	public function install() {
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "ibill_order`(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`order_id` int(11) NOT NULL,
				`data` longtext NOT NULL,
			  `status` varchar(255) NOT NULL,
			  `time` datetime NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");

	}
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "ibill_order`;");
	}

	public function getLogs( $start = 0, $limit = 10) {
		if ($start < 0) {$start = 0;	}
		if ($limit < 1) {$limit = 10;	}
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ibill_order ORDER BY order_id DESC LIMIT " . (int)$start . "," . (int)$limit);
		return $query->rows;

	}

	public function getTotalLogs() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "ibill_order");
		
	
		
		return $query->row['total'];
	}

	public function getMYRcurrency() {
		$query = $this->db->query("SELECT COUNT(*) AS count FROM " . DB_PREFIX . "currency WHERE code = 'MYR'");
		return $query->row['count'];
	}

}
