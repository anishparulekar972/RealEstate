<?php


class ControllerPagesNewssubscribers extends Controller {


	private $error = array();


 


	public function index() {


		$this->load->language('pages/newssubscribers');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('property/newssubscribers');


		


		$this->getList();


	}





	public function add() {


		$this->load->language('pages/newssubscribers');





		$this->document->setTitle($this->language->get('heading_title'));


		


		$this->load->model('property/newssubscribers');


		


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_newssubscribers->addEmail($this->request->post);


			


			$this->session->data['success'] = $this->language->get('text_success');





			$url = '';





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}


			


			$this->response->redirect($this->url->link('pages/newssubscribers', 'token=' . $this->session->data['token'].$url, 'SSL'));


		}





		$this->getForm();


	}





	public function edit() {


		$this->load->language('pages/newssubscribers');





		$this->document->setTitle($this->language->get('heading_title'));		


		


		$this->load->model('property/newssubscribers');


		


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_newssubscribers->editEmail($this->request->get['id'], $this->request->post);


			


			$this->session->data['success'] = $this->language->get('text_success');


			


			$url = '';





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}


			


			$this->response->redirect($this->url->link('pages/newssubscribers', 'token=' . $this->session->data['token'].$url, 'SSL'));


		}





		$this->getForm();


	}


	public function export() {


		


		$this->load->model('property/newssubscribers');


		


		$contents="Name \t Email \n";


		


		$results = $this->model_property_newssubscribers->exportEmails();


		


		$filename ="Newsletter_subscribers_".date("Y-m-d").".xls";


		if($results) {


			foreach($results as $results){


				$contents .= implode("\t",$results)."\n";	


			}


		}else{


			$contents = $this->language->get('text_no_results');


		}


		header('Content-type: application/ms-excel');


		header('Content-Disposition: attachment; filename='.$filename);


		echo $contents;


		


	}


	public function delete() { 


		$this->load->language('pages/newssubscribers');





		$this->document->setTitle($this->language->get('heading_title'));		


		


		$this->load->model('property/newssubscribers');


		


		if (isset($this->request->post['selected'])) {


      		foreach ($this->request->post['selected'] as $id) {


				$this->model_property_newssubscribers->deleteEmail($id);	


			}


						


			$this->session->data['success'] = $this->language->get('text_success');


			


			$url = '';





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}


			


			$this->response->redirect($this->url->link('pages/newssubscribers', 'token=' . $this->session->data['token'].$url, 'SSL'));


		}





		$this->getList();


	}





	public function getList() {


		$url='';


	


  		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('pages/newssubscribers', 'token=' . $this->session->data['token'] . $url, 'SSL')


		);


							


		


		$data['add'] = $this->url->link('pages/newssubscribers/add', 'token=' . $this->session->data['token'], 'SSL');


		$data['delete'] = $this->url->link('pages/newssubscribers/delete', 'token=' . $this->session->data['token'], 'SSL');


		$data['export'] = $this->url->link('pages/newssubscribers/export', 'token=' . $this->session->data['token'], 'SSL');	


	

		$data['text_export'] = $this->language->get('text_export');


		


		if(isset($this->request->get['page'])) {


	            $page = $this->request->get['page'];


		}else{


		        $page = 1;


		}


	


		$data['emails'] = array();

		$filter_data = "";

		$email_total = $this->model_property_newssubscribers->getTotalEmails($data);

		$results = $this->model_property_newssubscribers->getEmails($data,($page - 1) * $this->config->get('config_admin_limit'),$this->config->get('config_admin_limit'));





		foreach ($results as $result) {


			$data['emails'][] = array(


				'id' 		=> $result['id'],


				'name' 	=> $result['name'],


				'email' 	=> $result['email_id'],


				'edit'    => $this->url->link('pages/newssubscribers/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'], 'SSL')


			);


		}	


	


		$data['heading_title'] = $this->language->get('heading_title');


		


		$data['text_no_results'] = $this->language->get('text_no_results');


		$data['text_list'] = $this->language->get('text_list');


		$data['text_confirm'] = $this->language->get('text_confirm');





		$data['column_name'] = $this->language->get('column_name');


		$data['column_email'] = $this->language->get('column_email');


		


		$data['column_action'] = $this->language->get('column_action');





		$data['button_add'] = $this->language->get('button_add');


		$data['button_edit'] = $this->language->get('button_edit');


		$data['button_delete'] = $this->language->get('button_delete');


 


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


		


		$url = "";


		


		


		$pagination = new Pagination();


		$pagination->total = $email_total;


		$pagination->page  = $page;


		$pagination->limit = $this->config->get('config_admin_limit');


		$pagination->text  = $this->language->get('text_pagination');


		$pagination->url   = $this->url->link('pages/newssubscribers/', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');





		$data['pagination'] = $pagination->render();


		$data['results'] = sprintf($this->language->get('text_pagination'), ($email_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($email_total - $this->config->get('config_limit_admin'))) ? $email_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $email_total, ceil($email_total / $this->config->get('config_limit_admin')));





		$data['sort_name'] = $this->url->link('pages/newssubscribers/', 'token=' . $this->session->data['token']);


		


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/newsletter_subscriberslist', $data));


 	}





	private function getForm() {


		$data['heading_title'] = $this->language->get('heading_title');


		$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');


		


		$data['entry_name'] = $this->language->get('entry_name');


		$data['entry_code'] = $this->language->get('entry_code');


		


		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');





		$data['tab_general'] = $this->language->get('tab_general');





 		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}





 		if (isset($this->error['error_email_id'])) {


			$data['error_email_id'] = $this->error['error_email_id'];


		} else {


			$data['error_email_id'] = '';


		}


		


 		if (isset($this->error['error_email_exist'])) {


			$data['error_email_exist'] = $this->error['error_email_exist'];


		} else {


			$data['error_email_exist'] = '';


		}


		


		





  		$data['breadcrumbs'] = array();





  		$data['breadcrumbs'][] = array(


       		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),


       		'text'      => $this->language->get('text_home'),


      		'separator' => FALSE


   		);





  		$data['breadcrumbs'][] = array(


       		'href'      => $this->url->link('pages/newssubscribers', 'token=' . $this->session->data['token'], 'SSL'),


       		'text'      => $this->language->get('heading_title'),


      		'separator' => ' :: '


   		);


			


		if (!isset($this->request->get['id'])) {


			$data['action'] = $this->url->link('pages/newssubscribers/add', 'token=' . $this->session->data['token'], 'SSL');


		} else {


			$data['action'] = $this->url->link('pages/newssubscribers/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'], 'SSL');


		}


		


		$data['token'] = $this->session->data['token'];


		  


    	$data['cancel'] = $this->url->link('pages/newssubscribers', 'token=' . $this->session->data['token'], 'SSL');





		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {


			$email_info = $this->model_property_newssubscribers->getEmail($this->request->get['id']);


		}


		


		if (isset($this->request->post['email_id'])) {


			$data['email_id'] = $this->request->post['email_id'];


		} elseif (isset($email_info)) {


			$data['email_id'] = $email_info['email_id'];


		} else {


			$data['email_id'] = '';


		}


			


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/newsletter_subscriber_form', $data));


	}





	private function validateForm() {


		


		$this->load->model('property/newssubscribers');


		


		if (!$this->user->hasPermission('modify', 'pages/newssubscribers')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		if ((utf8_strlen($this->request->post['email_id']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email_id'])) {


			$this->error['error_email_id'] = $this->language->get('error_email_id');


		}


		


	 	if(isset($this->request->get['id']) && $this->request->get['id']!=""){


			if($this->model_property_newssubscribers->checkmail($this->request->post['email_id'],$this->request->get['id']))


			 $this->error['error_email_exist'] = $this->language->get('error_email_exist');


			 


		}





		return !$this->error;


	}





}


?>