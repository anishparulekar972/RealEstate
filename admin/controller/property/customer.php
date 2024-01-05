<?php


class ControllerPropertyCustomer extends Controller {


	private $error = array();





	public function index() {


		$this->load->language('property/customer');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/customer');





		$this->getList();


	}





	public function add() {


		$this->load->language('property/customer');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/customer');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_customer->addCustomer($this->request->post);





			$this->session->data['success'] = $this->language->get('text_success');





			$url = '';


			


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			$this->response->redirect($this->url->link('property/customer', 'token=' . $this->session->data['token'] . $url, true));


		}





		$this->getForm();


	}





	public function edit() {


		$this->load->language('property/customer');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/customer');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_customer->editCustomer($this->request->get['customer_id'], $this->request->post);





			$this->session->data['success'] = $this->language->get('text_success');





			$url = '';


			


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			$this->response->redirect($this->url->link('property/customer', 'token=' . $this->session->data['token'] . $url, true));


		}





		$this->getForm();


	}





	public function delete() {


		$this->load->language('property/customer');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/customer');





		if (isset($this->request->post['selected']) && $this->validateDelete()) {


			foreach ($this->request->post['selected'] as $customer_id) {


				$this->model_property_customer->deleteCustomer($customer_id);


			}





			$this->session->data['success'] = $this->language->get('text_success');





			$url = '';


			


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			$this->response->redirect($this->url->link('property/customer', 'token=' . $this->session->data['token'] . $url, true));


		}





		$this->getList();


	}


	protected function getList() {





		if (isset($this->request->get['filter_firstname'])) {


			$filter_firstname = $this->request->get['filter_firstname'];


		} else {


			$filter_firstname = false;


		}


		


		if (isset($this->request->get['sort'])) {


			$sort = $this->request->get['sort'];


		} else {


			$sort = 'firstname';


		}


		


		if (isset($this->request->get['sort'])) {


			$sort = $this->request->get['sort'];


		} else {


			$sort = 'plans_id';


		}





		if (isset($this->request->get['order'])) {


			$order = $this->request->get['order'];


		} else {


			$order = 'ASC';


		}





		if (isset($this->request->get['page'])) {


			$page = $this->request->get['page'];


		} else {


			$page = 1;


		}





		$url = '';


		


		if (isset($this->request->get['sort'])) {


			$url .= '&sort=' . $this->request->get['sort'];


		}





		if (isset($this->request->get['order'])) {


			$url .= '&order=' . $this->request->get['order'];


		}





		if (isset($this->request->get['page'])) {


			$url .= '&page=' . $this->request->get['page'];


		}





		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('property/customer', 'token=' . $this->session->data['token'] . $url, true)


		);





		$data['add'] = $this->url->link('property/customer/add', 'token=' . $this->session->data['token'] . $url, true);


		$data['delete'] = $this->url->link('property/customer/delete', 'token=' . $this->session->data['token'] . $url, true);





		$data['customers'] = array();





		$filter_data = array(


			'filter_firstname'         => $filter_firstname,


			'sort'                     => $sort,


			'order'                    => $order,


			'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit'                    => $this->config->get('config_limit_admin')


		);





		$customer_total = $this->model_property_customer->getTotalCustomers($filter_data);





		$results = $this->model_property_customer->getCustomers($filter_data);


		$this->load->model('membership/plans');


		foreach ($results as $result) {


			


			


       		$plansinfo=$this->model_membership_plans->getPlansiesedit($result['plans_id']);


			if(isset($plansinfo['plans_id'])){


				$data['plans']=$plansinfo['name']; 


			}	





			$data['customers'][] = array(


				'customer_id'    => $result['customer_id'],


				'firstname'      => $result['firstname'],


				'plans_id'       => $plansinfo['name'],


				'email'          => $result['email'],


				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),


				'edit'           => $this->url->link('property/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, true)


			);


		}





		$data['heading_title'] 	= $this->language->get('heading_title');





		$data['text_list'] 		= $this->language->get('text_list');


		$data['text_enabled'] 	= $this->language->get('text_enabled');


		$data['text_disabled'] 	= $this->language->get('text_disabled');


		$data['text_yes'] 		= $this->language->get('text_yes');


		$data['text_no'] 		= $this->language->get('text_no');


		$data['text_default'] 	= $this->language->get('text_default');


		$data['text_no_results']= $this->language->get('text_no_results');


		$data['text_confirm'] 	= $this->language->get('text_confirm');





		$data['column_name'] 	= $this->language->get('column_name');


		$data['column_email'] 	= $this->language->get('column_email');


		$data['column_status'] 	= $this->language->get('column_status');


		$data['column_action'] 	= $this->language->get('column_action');


		$data['column_plans'] 	= $this->language->get('column_plans');





		$data['entry_name'] 	= $this->language->get('entry_name');


		$data['entry_email'] 	= $this->language->get('entry_email');


		$data['entry_customer_group'] = $this->language->get('entry_customer_group');


		$data['entry_status'] 	= $this->language->get('entry_status');


		$data['entry_approved'] = $this->language->get('entry_approved');


		$data['entry_ip'] 		= $this->language->get('entry_ip');


		$data['entry_date_added'] = $this->language->get('entry_date_added');





		$data['button_approve'] = $this->language->get('button_approve');


		$data['button_add'] 	= $this->language->get('button_add');


		$data['button_edit'] 	= $this->language->get('button_edit');


		$data['button_delete'] 	= $this->language->get('button_delete');


		$data['button_filter'] 	= $this->language->get('button_filter');


		$data['button_login'] 	= $this->language->get('button_login');


		$data['button_unlock'] 	= $this->language->get('button_unlock');





		$data['token'] = $this->session->data['token'];





		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}





		if (isset($this->session->data['success'])) {


			$data['success'] = $this->session->data['success'];





			unset($this->session->data['success']);


		} else {


			$data['success'] = '';


		}





		if (isset($this->request->post['selected'])) {


			$data['selected'] = (array)$this->request->post['selected'];


		} else {


			$data['selected'] = array();


		}





		$url = '';


		


		if (isset($this->request->get['filter_firstname'])) {


			$url .= '&filter_firstname=' . $this->request->get['filter_firstname'];


		}





		if ($order == 'ASC') {


			$url .= '&order=DESC';


		} else {


			$url .= '&order=ASC';


		}





		if (isset($this->request->get['page'])) {


			$url .= '&page=' . $this->request->get['page'];


		}





		$data['sort_firstname'] = $this->url->link('property/customer', 'token=' . $this->session->data['token'] . '&sort=firstname' . $url, true);


		


		$data['sort_plans'] = $this->url->link('property/customer', 'token=' . $this->session->data['token'] . '&sort=plans' . $url, true);


		


		


		$data['sort_email'] = $this->url->link('property/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, true);


		$data['sort_status'] = $this->url->link('property/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, true);


		


		$url = '';





		if (isset($this->request->get['filter_firstname'])) {


			$url .= '&filter_firstname=' . $this->request->get['filter_firstname'];


		}





		if (isset($this->request->get['sort'])) {


			$url .= '&sort=' . $this->request->get['sort'];


		}





		if (isset($this->request->get['order'])) {


			$url .= '&order=' . $this->request->get['order'];


		}





		$pagination = new Pagination();


		$pagination->total = $customer_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('property/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);





		$data['pagination'] = $pagination->render();





		$data['results'] = sprintf($this->language->get('text_pagination'), ($customer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customer_total - $this->config->get('config_limit_admin'))) ? $customer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_total, ceil($customer_total / $this->config->get('config_limit_admin')));





		$data['filter_firstname'] = $filter_firstname;


		





		$this->load->model('setting/store');


		


		$data['stores'] = $this->model_setting_store->getStores();





		$data['sort'] = $sort;


		$data['order'] = $order;





		$data['header'] 	 = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] 	 = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('property/customer_list', $data));


	}





	protected function getForm() {


		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_form'] = !isset($this->request->get['customer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');


		$data['text_enabled'] = $this->language->get('text_enabled');


		$data['text_disabled'] = $this->language->get('text_disabled');


		$data['text_yes'] = $this->language->get('text_yes');


		$data['text_no'] = $this->language->get('text_no');


		$data['text_select'] = $this->language->get('text_select');


		$data['text_none'] = $this->language->get('text_none');


		$data['text_loading'] = $this->language->get('text_loading');


		$data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');


		$data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');





		$data['entry_firstname'] = $this->language->get('entry_firstname');


		$data['entry_lastname'] = $this->language->get('entry_lastname');


		$data['entry_email'] = $this->language->get('entry_email');


		$data['entry_telephone'] = $this->language->get('entry_telephone');


		$data['entry_fax'] = $this->language->get('entry_fax');


		$data['entry_password'] = $this->language->get('entry_password');


		$data['entry_confirm'] = $this->language->get('entry_confirm');


		$data['entry_newsletter'] = $this->language->get('entry_newsletter');


		$data['entry_status'] = $this->language->get('entry_status');


		$data['entry_approved'] = $this->language->get('entry_approved');


		$data['entry_safe'] = $this->language->get('entry_safe');


		$data['entry_company'] = $this->language->get('entry_company');


		$data['entry_address_1'] = $this->language->get('entry_address_1');


		$data['entry_address_2'] = $this->language->get('entry_address_2');


		$data['entry_city'] = $this->language->get('entry_city');


		$data['entry_postcode'] = $this->language->get('entry_postcode');


		$data['entry_zone'] = $this->language->get('entry_zone');


		$data['entry_country'] = $this->language->get('entry_country');


		$data['entry_default'] = $this->language->get('entry_default');


		$data['entry_comment'] = $this->language->get('entry_comment');


		$data['entry_description'] = $this->language->get('entry_description');


		$data['entry_amount'] = $this->language->get('entry_amount');


		$data['entry_points'] = $this->language->get('entry_points');





		$data['help_safe'] = $this->language->get('help_safe');


		$data['help_points'] = $this->language->get('help_points');


		$data['entry_plans'] = $this->language->get('entry_plans');








		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');


		$data['button_address_add'] = $this->language->get('button_address_add');


		$data['button_history_add'] = $this->language->get('button_history_add');


		$data['button_transaction_add'] = $this->language->get('button_transaction_add');


		$data['button_reward_add'] = $this->language->get('button_reward_add');


		$data['button_remove'] = $this->language->get('button_remove');


		$data['button_upload'] = $this->language->get('button_upload');





		$data['tab_general'] = $this->language->get('tab_general');


		$data['tab_address'] = $this->language->get('tab_address');


		$data['tab_history'] = $this->language->get('tab_history');


		$data['tab_transaction'] = $this->language->get('tab_transaction');


		$data['tab_reward'] = $this->language->get('tab_reward');


		$data['tab_ip'] = $this->language->get('tab_ip');





		$data['token'] = $this->session->data['token'];





		if (isset($this->request->get['customer_id'])) {


			$data['customer_id'] = $this->request->get['customer_id'];


		} else {


			$data['customer_id'] = 0;


		}





		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}





		if (isset($this->error['firstname'])) {


			$data['error_firstname'] = $this->error['firstname'];


		} else {


			$data['error_firstname'] = '';


		}





		if (isset($this->error['lastname'])) {


			$data['error_lastname'] = $this->error['lastname'];


		} else {


			$data['error_lastname'] = '';


		}





		if (isset($this->error['email'])) {


			$data['error_email'] = $this->error['email'];


		} else {


			$data['error_email'] = '';


		}





		if (isset($this->error['telephone'])) {


			$data['error_telephone'] = $this->error['telephone'];


		} else {


			$data['error_telephone'] = '';


		}





		if (isset($this->error['password'])) {


			$data['error_password'] = $this->error['password'];


		} else {


			$data['error_password'] = '';


		}





		if (isset($this->error['confirm'])) {


			$data['error_confirm'] = $this->error['confirm'];


		} else {


			$data['error_confirm'] = '';


		}





		if (isset($this->error['custom_field'])) {


			$data['error_custom_field'] = $this->error['custom_field'];


		} else {


			$data['error_custom_field'] = array();


		}





		if (isset($this->error['address'])) {


			$data['error_address'] = $this->error['address'];


		} else {


			$data['error_address'] = array();


		}





		$url = '';


		


		if (isset($this->request->get['sort'])) {


			$url .= '&sort=' . $this->request->get['sort'];


		}





		if (isset($this->request->get['order'])) {


			$url .= '&order=' . $this->request->get['order'];


		}





		if (isset($this->request->get['page'])) {


			$url .= '&page=' . $this->request->get['page'];


		}





		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('property/customer', 'token=' . $this->session->data['token'] . $url, true)


		);





		if (!isset($this->request->get['customer_id'])) {


			$data['action'] = $this->url->link('property/customer/add', 'token=' . $this->session->data['token'] . $url, true);


		} else {


			$data['action'] = $this->url->link('property/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, true);


		}





		$data['cancel'] = $this->url->link('property/customer', 'token=' . $this->session->data['token'] . $url, true);





		if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {


			$customer_info = $this->model_property_customer->getCustomer($this->request->get['customer_id']);


		}


		


		if (isset($this->request->post['firstname'])) {


			$data['firstname'] = $this->request->post['firstname'];


		} elseif (!empty($customer_info)) {


			$data['firstname'] = $customer_info['firstname'];


		} else {


			$data['firstname'] = '';


		}





		if (isset($this->request->post['lastname'])) {


			$data['lastname'] = $this->request->post['lastname'];


		} elseif (!empty($customer_info)) {


			$data['lastname'] = $customer_info['lastname'];


		} else {


			$data['lastname'] = '';


		}





		if (isset($this->request->post['email'])) {


			$data['email'] = $this->request->post['email'];


		} elseif (!empty($customer_info)) {


			$data['email'] = $customer_info['email'];


		} else {


			$data['email'] = '';


		}





		if (isset($this->request->post['telephone'])) {


			$data['telephone'] = $this->request->post['telephone'];


		} elseif (!empty($customer_info)) {


			$data['telephone'] = $customer_info['telephone'];


		} else {


			$data['telephone'] = '';


		}





		if (isset($this->request->post['fax'])) {


			$data['fax'] = $this->request->post['fax'];


		} elseif (!empty($customer_info)) {


			$data['fax'] = $customer_info['fax'];


		} else {


			$data['fax'] = '';


		}


		


		


		/// name this is input 





		if (isset($this->request->post['plans_id'])){


			$data['plans_id'] = $this->request->post['plans_id'];


		} elseif (isset($customer_info['plans_id'])) {


			$data['plans_id'] = $customer_info['plans_id'];


		} else {


			$data['plans_id'] = '';		


		}








		if(!empty($data['plans_id'])) {	


			$this->load->model('membership/plans');


		$plansinfo=$this->model_membership_plans->getPlansiesedit($data['plans_id']);


			$data['plans']=$plansinfo['name'];


		} else {


			$data['plans']='';


		}


		





		if (isset($this->request->post['newsletter'])) {


			$data['newsletter'] = $this->request->post['newsletter'];


		} elseif (!empty($customer_info)) {


			$data['newsletter'] = $customer_info['newsletter'];


		} else {


			$data['newsletter'] = '';


		}





		if (isset($this->request->post['status'])) {


			$data['status'] = $this->request->post['status'];


		} elseif (!empty($customer_info)) {


			$data['status'] = $customer_info['status'];


		} else {


			$data['status'] = true;


		}





		if (isset($this->request->post['approved'])) {


			$data['approved'] = $this->request->post['approved'];


		} elseif (!empty($customer_info)) {


			$data['approved'] = $customer_info['approved'];


		} else {


			$data['approved'] = true;


		}





		if (isset($this->request->post['safe'])) {


			$data['safe'] = $this->request->post['safe'];


		} elseif (!empty($customer_info)) {


			$data['safe'] = $customer_info['safe'];


		} else {


			$data['safe'] = 0;


		}





		if (isset($this->request->post['password'])) {


			$data['password'] = $this->request->post['password'];


		} else {


			$data['password'] = '';


		}





		if (isset($this->request->post['confirm'])) {


			$data['confirm'] = $this->request->post['confirm'];


		} else {


			$data['confirm'] = '';


		}


		


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('property/customer_form', $data));


	}





	protected function validateForm() {


		if (!$this->user->hasPermission('modify', 'property/customer')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {


			$this->error['firstname'] = $this->language->get('error_firstname');


		}





		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {


			$this->error['lastname'] = $this->language->get('error_lastname');


		}





		if ((utf8_strlen($this->request->post['email'])< 3)||(utf8_strlen($this->request->post['email']) > 255)) {


	    	$this->error['email']= $this->language->get('error_email');


		}





		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {


			$this->error['telephone'] = $this->language->get('error_telephone');


		}





		return !$this->error;


	}





	protected function validateDelete() {


		if (!$this->user->hasPermission('modify', 'property/customer')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		return !$this->error;


	}


}


