<?php
class ControllerExtensionPaymentibill extends Controller {
	public function index() {
		$this->load->language('extension/payment/ibill');

        $this->load->model('checkout/order');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$this->language->load('extension/payment/ibill');
		
		$data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
	   	$data['button_confirm'] = $this->language->get('button_confirm');
		$data['text_failure'] = $this->language->get('text_failure');
		$data['text_failure_wait'] = sprintf($this->language->get('text_failure_wait'), $this->url->link('checkout/cart'));
		$data['text_response'] = $this->language->get('text_response');
		

	    // the App id is found in the self-care environments (developers menu)
		$app_id  = $this->config->get('ibill_mid');
		
		// the password is set in the self-care environments (developers menu)
		$api_key = $this->config->get('ibill_apikey');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$data['apiorderid'] = $this->session->data['order_id'];
		$data['apiname'] = $order_info['payment_firstname'].''.$order_info['payment_lastname'];;
		$data['apiaddress'] = $order_info['payment_address_1'].''.$order_info['payment_address_2'];;
		$data['apiphone'] = $order_info['telephone'];
		$data['apiemail'] = $order_info['email'];
		$data['apisecret'] = $this->config->get('ibill_apikey');
		$data['apiid'] = $this->config->get('ibill_mid');
		$data['apidetail'] = 'Payment for invoice'.$this->session->data['order_id'];
		$data['apiamount'] = $this->currency->format($order_info['total'],'MYR' ,'', false);

        return $this->load->view('extension/payment/ibill', $data);
	}
	
	
	
	function callback()
	{ 
        $api_key = $this->config->get('ibill_apikey');
        $std_status_code=$_POST['std_status_code']; 		//Code payment status get from ibill.my
        $std_status=$_POST['std_status']; 					//Payment Status get from ibill.my
        $std_order_id=$_POST['std_order_id'];				//Order ID send by opencart system
        $std_purchase_code=$_POST['std_purchase_code'];		//Purchase Code get from ibill.my
        $std_secret=$_POST['std_secret'];					//Your secret key register on ibill.my
        $std_amount=$_POST['std_amount'];					//Total Amount Customer Pay 
        $std_datepaid=$_POST['std_datepaid'];				//Time Customer make payment
        
        
        if($std_secret == $api_key)
        {
            
            $this->load->model('checkout/order');
		    $this->load->model('extension/payment/ibill');
		    $order_id = $this->session->data['order_id'];
		    $this->model_extension_payment_ibill->addOrder($order_id, $_POST);
            
            
            
            if ($std_status_code == '00' && $std_status == 'Paid' )
			{
    	    	$order_status_id = $this->config->get('config_order_status_id');
				$this->load->model('checkout/order');
				$order_info = $this->model_checkout_order->getOrder($order_id);
				$this->model_checkout_order->addOrderHistory($order_id,$this->config->get('ibill_order_status_id'));
		     	$this->response->redirect($this->url->link('checkout/success', '', true));
		    }

	
     		else if ($std_status_code == '99') //Payment pending on bank site
			{
					echo "PENDING FOR AUTHORIZER TO APPROVE!!";
			}
			//paymnet fail
			else  {    
			            $this->load->language('extension/payment/ibill');
				 		$data['response_msg'] = $_POST['std_status'];
						
			 			$data['column_left'] = $this->load->controller('common/column_left');
			 			$data['column_right'] = $this->load->controller('common/column_right');
			 			$data['continue'] = $this->url->link('checkout/cart');
			 			$data['content_top'] = $this->load->controller('common/content_top');
			 			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			 			$data['footer'] = $this->load->controller('common/footer');
			 			$data['header'] = $this->load->controller('common/header');
			 			$data['text_failure'] = $this->language->get('text_failure');
			 			$data['text_message'] = $this->language->get('text_message');
			 			$data['button_continue'] = $this->language->get('button_continue');
			 			$data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
	                
	                 	$data['text_response'] = $this->language->get('text_response');

			 			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/payment/ibill_failure.tpl')) {
			 			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/extension/payment/ibill_failure.tpl', $data));
			 			} else {
			 			$this->response->setOutput($this->load->view('extension/payment/ibill_failure.tpl', $data));
			 			}
			 }
		}
		else //wrong api key
		{
		    $this->load->language('extension/payment/ibill'); 
			$data['response_msg'] = $this->language->get('text_tampered');
	
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['continue'] = $this->url->link('checkout/cart');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			$data['text_failure'] = $this->language->get('text_failure');
			$data['text_message'] = $this->language->get('text_message');
			$data['button_continue'] = $this->language->get('button_continue');
		    $data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
	        
	        $data['text_response'] = $this->language->get('text_response');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/extension/payment/ibill_failure.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/extension/payment/ibill_failure.tpl', $data));
			} else {
			$this->response->setOutput($this->load->view('extension/payment/ibill_failure.tpl', $data));
		}
	}
        
        
	} 
	
		
}