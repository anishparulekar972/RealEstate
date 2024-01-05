<?php


class ControllerCommonHeader extends Controller {


	public function index() {


		$data['title'] = $this->document->getTitle();





		if ($this->request->server['HTTPS']) {


			$data['base'] = HTTPS_SERVER;


		} else {


			$data['base'] = HTTP_SERVER;


		}





		$data['description'] = $this->document->getDescription();


		$data['keywords'] = $this->document->getKeywords();


		$data['links'] = $this->document->getLinks();


		$data['styles'] = $this->document->getStyles();


		$data['scripts'] = $this->document->getScripts();


		$data['lang'] = $this->language->get('code');


		$data['direction'] = $this->language->get('direction');





		$this->load->language('common/header');





		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_order'] = $this->language->get('text_order');


		$data['text_processing_status'] = $this->language->get('text_processing_status');


		$data['text_complete_status'] = $this->language->get('text_complete_status');


		$data['text_return'] = $this->language->get('text_return');


		$data['text_customer'] = $this->language->get('text_customer');


		$data['text_online'] = $this->language->get('text_online');


		$data['text_approval'] = $this->language->get('text_approval');


		$data['text_product'] = $this->language->get('text_product');


		$data['text_stock'] = $this->language->get('text_stock');


		$data['text_review'] = $this->language->get('text_review');


		$data['text_affiliate'] = $this->language->get('text_affiliate');


		$data['text_store'] = $this->language->get('text_store');


		$data['text_front'] = $this->language->get('text_front');


		$data['text_help'] = $this->language->get('text_help');


		$data['alerts'] = $this->language->get('alerts');


		$data['return'] = $this->language->get('return');


		$data['online'] = $this->language->get('online');


		$data['return_total'] = $this->language->get('return_total');


		$data['online_total'] = $this->language->get('online_total');


		$data['customer_approval'] = $this->language->get('customer_approval');


		$data['customer_total'] = $this->language->get('customer_total');


		$data['product'] = $this->language->get('product');


		$data['review'] = $this->language->get('review');


		$data['review_total'] = $this->language->get('review_total');


		$data['affiliate_approval'] = $this->language->get('affiliate_approval');


		$data['affiliate_total'] = $this->language->get('affiliate_total');


		$data['stores'] = $this->language->get('stores');


		$data['product_total'] = $this->language->get('product_total');


		$data['supplied'] = $this->language->get('supplied');


		$data['logout'] = $this->language->get('logout');


		


		


		


		$data['processing_status'] = $this->language->get('processing_status');


		$data['complete_status'] = $this->language->get('complete_status');


		$data['processing_status_total'] = $this->language->get('processing_status_total');


		$data['text_complete_status'] = $this->language->get('text_complete_status');


		$data['complete_status_total'] = $this->language->get('complete_status_total');


		


		$data['text_homepage'] = $this->language->get('text_homepage');


		$data['text_documentation'] = $this->language->get('text_documentation');


		$data['text_support'] = $this->language->get('text_support');


		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());


		$data['text_logout'] = $this->language->get('text_logout');


		


		//xml


			$this->load->model('user/user');


	


			$this->load->model('tool/image');


			//$data['stores'] = array();


			$user_info = $this->model_user_user->getUser($this->user->getId());


	


			if ($user_info) {


				$data['firstname'] = $user_info['firstname'];


				$data['lastname'] = $user_info['lastname'];


	


				$data['user_group'] = $user_info['user_group'];


	


				if (is_file(DIR_IMAGE . $user_info['image'])) {


					$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);


				} else {


					$data['image'] = '';


				}


			} else {


				$data['firstname'] = '';


				$data['lastname'] = '';


				$data['user_group'] = '';


				$data['image'] = '';


			}		


		//xml


		


		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {


			$data['logged'] = '';





			$data['home'] = $this->url->link('common/dashboard', '', true);


		} else {


			$data['logged'] = true;





			$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true);


			$data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], true);





			


		}


		


		// Online Stores


			$data['stores'] = array();





			$data['stores'][] = array(


				'name' => $this->config->get('config_name'),


				'href' => HTTP_CATALOG


			);





			$this->load->model('setting/store');





			$results = $this->model_setting_store->getStores();


			if(isset($results)) {


				foreach ($results as $result) {


					$data['stores'][] = array(


						'name' => $result['name'],


						'href' => $result['url']


					);


				}


			}


		return $this->load->view('common/header', $data);


	}


}


