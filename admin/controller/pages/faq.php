<?php

class ControllerPagesFaq extends Controller {

	private $error = array();



	public function index() {

		$this->load->language('pages/faq');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/faq');

		

		$this->getList();

	}



	public function add() {

		$this->load->language('pages/faq');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/faq');



		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_faq_faq->addfaq($this->request->post);



			$this->session->data['success'] = $this->language->get('text_success');



			$url = '';

			

			if (isset($this->request->get['filter_name'])) {

				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));

			}

			

			if (isset($this->request->get['filter_category'])) {

				$url .= '&filter_category=' . $this->request->get['filter_category'];

			}



			if (isset($this->request->get['filter_status'])) {

				$url .= '&filter_status=' . $this->request->get['filter_status'];

			}



			if (isset($this->request->get['sort'])) {

				$url .= '&sort=' . $this->request->get['sort'];

			}



			if (isset($this->request->get['order'])) {

				$url .= '&order=' . $this->request->get['order'];

			}



			if (isset($this->request->get['page'])) {

				$url .= '&page=' . $this->request->get['page'];

			}



			$this->response->redirect($this->url->link('pages/faq', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}



		$this->getForm();

	}



	public function edit(){

		$this->load->language('pages/faq');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/faq');



		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_faq_faq->editfaq($this->request->get['faq_id'], $this->request->post);



			$this->session->data['success'] = $this->language->get('text_success');



			$url = '';

			

			if (isset($this->request->get['filter_name'])) {

				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));

			}

			

			if (isset($this->request->get['filter_category'])) {

				$url .= '&filter_category=' . $this->request->get['filter_category'];

			}



			if (isset($this->request->get['filter_status'])) {

				$url .= '&filter_status=' . $this->request->get['filter_status'];

			}



			if (isset($this->request->get['sort'])) {

				$url .= '&sort=' . $this->request->get['sort'];

			}



			if (isset($this->request->get['order'])) {

				$url .= '&order=' . $this->request->get['order'];

			}



			if (isset($this->request->get['page'])) {

				$url .= '&page=' . $this->request->get['page'];

			}



			$this->response->redirect($this->url->link('pages/faq', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}



		$this->getForm();

	}



	public function delete() {

		$this->load->language('pages/faq');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/faq');



		if (isset($this->request->post['selected']) && $this->validateDelete()) {

			foreach ($this->request->post['selected'] as $faq_id) {

				$this->model_faq_faq->deletefaq($faq_id);

			}



			$this->session->data['success'] = $this->language->get('text_success');



			$url = '';

			

			if (isset($this->request->get['filter_name'])) {

				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));

			}

			

			if (isset($this->request->get['filter_category'])) {

				$url .= '&filter_category=' . $this->request->get['filter_category'];

			}



			if (isset($this->request->get['filter_status'])) {

				$url .= '&filter_status=' . $this->request->get['filter_status'];

			}



			if (isset($this->request->get['sort'])) {

				$url .= '&sort=' . $this->request->get['sort'];

			}



			if (isset($this->request->get['order'])) {

				$url .= '&order=' . $this->request->get['order'];

			}



			if (isset($this->request->get['page'])) {

				$url .= '&page=' . $this->request->get['page'];

			}



			$this->response->redirect($this->url->link('pages/faq', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}



		$this->getList();

	}



	protected function getList() {

		if (isset($this->request->get['filter_name'])) {

			$filter_name = $this->request->get['filter_name'];

		} else {

			$filter_name = null;

		}

		

		if (isset($this->request->get['filter_category'])){

			$filter_category = $this->request->get['filter_category'];

		} else {

			$filter_category = null;

		}

		

		if (isset($this->request->get['filter_status'])) {

			$filter_status = $this->request->get['filter_status'];

		} else {

			$filter_status = null;

		}

		

		if (isset($this->request->get['sort'])) {

			$sort = $this->request->get['sort'];

		} else {

			$sort = 'name';

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

		

		if (isset($this->request->get['filter_name'])) {

			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));

		}

		

		if (isset($this->request->get['filter_category'])) {

			$url .= '&filter_category=' . $this->request->get['filter_category'];

		}



		if (isset($this->request->get['filter_status'])) {

			$url .= '&filter_status=' . $this->request->get['filter_status'];

		}



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

			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')

		);



		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),

			'href' => $this->url->link('pages/faq', 'token=' . $this->session->data['token'] . $url, 'SSL')

		);



		$data['add'] = $this->url->link('pages/faq/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['delete'] = $this->url->link('pages/faq/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['repair'] = $this->url->link('pages/faq/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');



		$data['faqs'] = array();

		$data['token'] = $this->session->data['token'];



		$filter_data = array(

			'filter_name'  => $filter_name,

			'filter_category'  => $filter_category,

			'filter_status'  => $filter_status,

			'sort'  => $sort,

			'order' => $order,

			'start' => ($page - 1) * $this->config->get('config_limit_admin'),

			'limit' => $this->config->get('config_limit_admin')

		);



		$faq_total = $this->model_faq_faq->getTotalCategories();

		$this->load->model('faq/category');

		$results = $this->model_faq_faq->getFAQs($filter_data);

		foreach ($results as $result) {

			$categoriename=array();

			if($result['fcategory_ids']){

				if(isset($result['fcategory_id'])){

				  $categories[] = $result['fcategory_id'];

				}else{

				 $categories = explode(',',$result['fcategory_ids']);		

				}

				foreach($categories as $fcategory_id){

				   $fcategory_info = $this->model_faq_category->getCategory($fcategory_id);

				   $categoriename[] =$fcategory_info['name'];

				}

			}

			if($categoriename){

				$categorienames = implode('<br/>',$categoriename);

			}else{

				$categorienames = '';

			}

			

			$data['faqs'][] = array(

				'faq_id' 		 => $result['faq_id'],

				'name'       	 => $result['name'],

				'categorienames' => $categorienames,

				'sort_order'  	 => $result['sort_order'],

				'status'  	 	 => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),

				'edit'        	 => $this->url->link('pages/faq/edit', 'token=' . $this->session->data['token'] . '&faq_id=' . $result['faq_id'] . $url, 'SSL'),

				'delete'      	 => $this->url->link('pages/faq/delete', 'token=' . $this->session->data['token'] . '&faq_id=' . $result['faq_id'] . $url, 'SSL')

			);

		}

		

		$this->load->model('faq/category');

		$data['fcategories'] = $this->model_faq_category->getCategories($filter_data=array());



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_list'] = $this->language->get('text_list');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['text_enabled'] = $this->language->get('text_enabled');

		$data['text_disabled'] = $this->language->get('text_disabled');

		



		$data['column_name'] = $this->language->get('column_name');

		$data['column_sort_order'] = $this->language->get('column_sort_order');

		$data['column_action'] = $this->language->get('column_action');

		

		$data['entry_name'] = $this->language->get('entry_name');

		$data['entry_category'] = $this->language->get('entry_category');

		$data['entry_status'] = $this->language->get('entry_status');



		$data['button_add'] = $this->language->get('button_add');

		$data['button_edit'] = $this->language->get('button_edit');

		$data['button_delete'] = $this->language->get('button_delete');

		$data['button_filter'] = $this->language->get('button_filter');



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



		if ($order == 'ASC') {

			$url .= '&order=DESC';

		} else {

			$url .= '&order=ASC';

		}



		if (isset($this->request->get['page'])) {

			$url .= '&page=' . $this->request->get['page'];

		}



		$data['sort_name'] = $this->url->link('pages/faq', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');

		$data['sort_sort_order'] = $this->url->link('pages/faq', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');



		$url = '';

		

		if (isset($this->request->get['filter_name'])) {

			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));

		}

		

		if (isset($this->request->get['filter_category'])) {

			$url .= '&filter_category=' . $this->request->get['filter_category'];

		}



		if (isset($this->request->get['filter_status'])) {

			$url .= '&filter_status=' . $this->request->get['filter_status'];

		}



		if (isset($this->request->get['sort'])) {

			$url .= '&sort=' . $this->request->get['sort'];

		}



		if (isset($this->request->get['order'])) {

			$url .= '&order=' . $this->request->get['order'];

		}



		$pagination = new Pagination();

		$pagination->total = $faq_total;

		$pagination->page = $page;

		$pagination->limit = $this->config->get('config_limit_admin');

		$pagination->url = $this->url->link('pages/faq', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');



		$data['pagination'] = $pagination->render();



		$data['results'] = sprintf($this->language->get('text_pagination'), ($faq_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($faq_total - $this->config->get('config_limit_admin'))) ? $faq_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $faq_total, ceil($faq_total / $this->config->get('config_limit_admin')));



		$data['sort'] = $sort;

		$data['order'] = $order;

		$data['filter_name'] = $filter_name;

		$data['filter_category'] = $filter_category;

		$data['filter_status'] = $filter_status;



		$data['header'] = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this->load->controller('common/footer');



		$this->response->setOutput($this->load->view('pages/faq_list', $data));

	}



	protected function getForm() {

		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_form'] = !isset($this->request->get['faq_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['text_none'] = $this->language->get('text_none');

		$data['text_default'] = $this->language->get('text_default');

		$data['text_enabled'] = $this->language->get('text_enabled');

		$data['text_disabled'] = $this->language->get('text_disabled');



		$data['entry_name'] = $this->language->get('entry_name');

		$data['entry_description'] = $this->language->get('entry_description');

		$data['entry_meta_title'] = $this->language->get('entry_meta_title');

		$data['entry_meta_description'] = $this->language->get('entry_meta_description');

		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');

		$data['entry_keyword'] = $this->language->get('entry_keyword');

		$data['entry_parent'] = $this->language->get('entry_parent');

		$data['entry_filter'] = $this->language->get('entry_filter');

		$data['entry_store'] = $this->language->get('entry_store');

		$data['entry_image'] = $this->language->get('entry_image');

		$data['entry_top'] = $this->language->get('entry_top');

		$data['entry_column'] = $this->language->get('entry_column');

		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['entry_status'] = $this->language->get('entry_status');

		$data['entry_layout'] = $this->language->get('entry_layout');

		$data['entry_category'] = $this->language->get('entry_category');


		$data['text_name'] = $this->language->get('text_name');

		$data['text_description'] = $this->language->get('text_description');

		$data['text_meta_title'] = $this->language->get('text_meta_title');

		$data['text_meta_description'] = $this->language->get('text_meta_description');

		$data['text_meta_keyword'] = $this->language->get('text_meta_keyword');

		$data['text_keyword'] = $this->language->get('text_keyword');

		$data['text_parent'] = $this->language->get('text_parent');

		$data['text_filter'] = $this->language->get('text_filter');

		$data['text_store'] = $this->language->get('text_store');

		$data['text_image'] = $this->language->get('text_image');

		$data['text_top'] = $this->language->get('text_top');

		$data['text_column'] = $this->language->get('text_column');

		$data['text_sort_order'] = $this->language->get('text_sort_order');

		$data['text_status'] = $this->language->get('text_status');

		$data['text_layout'] = $this->language->get('text_layout');

		$data['text_category'] = $this->language->get('text_category');



		$data['help_filter'] = $this->language->get('help_filter');

		$data['help_keyword'] = $this->language->get('help_keyword');

		$data['help_top'] = $this->language->get('help_top');

		$data['help_column'] = $this->language->get('help_column');



		$data['button_save'] = $this->language->get('button_save');

		$data['button_cancel'] = $this->language->get('button_cancel');



		$data['tab_general'] = $this->language->get('tab_general');

		$data['tab_data'] = $this->language->get('tab_data');

		$data['tab_design'] = $this->language->get('tab_design');



		if (isset($this->error['warning'])) {

			$data['error_warning'] = $this->error['warning'];

		} else {

			$data['error_warning'] = '';

		}



		if (isset($this->error['categories'])) {

			$data['error_category'] = $this->error['categories'];

		} else {

			$data['error_category'] = array();

		}

		

		if (isset($this->error['name'])) {

			$data['error_name'] = $this->error['name'];

		} else {

			$data['error_name'] = array();

		}



		if (isset($this->error['meta_title'])) {

			$data['error_meta_title'] = $this->error['meta_title'];

		} else {

			$data['error_meta_title'] = array();

		}



		if (isset($this->error['keyword'])) {

			$data['error_keyword'] = $this->error['keyword'];

		} else {

			$data['error_keyword'] = '';

		}



		$url = '';

		

		if (isset($this->request->get['filter_name'])) {

			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));

		}

		

		if (isset($this->request->get['filter_category'])) {

			$url .= '&filter_category=' . $this->request->get['filter_category'];

		}



		if (isset($this->request->get['filter_status'])) {

			$url .= '&filter_status=' . $this->request->get['filter_status'];

		}



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

			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')

		);



		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),

			'href' => $this->url->link('pages/faq', 'token=' . $this->session->data['token'] . $url, 'SSL')

		);



		if (!isset($this->request->get['faq_id'])) {

			$data['action'] = $this->url->link('pages/faq/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

		} else {

			$data['action'] = $this->url->link('pages/faq/edit', 'token=' . $this->session->data['token'] . '&faq_id=' . $this->request->get['faq_id'] . $url, 'SSL');

		}



		$data['cancel'] = $this->url->link('pages/faq', 'token=' . $this->session->data['token'] . $url, 'SSL');



		if (isset($this->request->get['faq_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {

			$faq_info = $this->model_faq_faq->getfaq($this->request->get['faq_id']);

		}



		$data['token'] = $this->session->data['token'];



		$this->load->model('localisation/language');



		$data['languages'] = $this->model_localisation_language->getLanguages();



		if (isset($this->request->post['faq_description'])) {

			$data['faq_description'] = $this->request->post['faq_description'];

		} elseif (isset($this->request->get['faq_id'])) {

			$data['faq_description'] = $this->model_faq_faq->getfaqDescriptions($this->request->get['faq_id']);

		} else {

			$data['faq_description'] = array();

		}

		

		if (isset($this->request->post['categories'])) {

			$data['categoriess'] = $this->request->post['categories'];

		} elseif (isset($this->request->get['faq_id'])) {

			$data['categoriess'] = $this->model_faq_faq->getfaqcategories($this->request->get['faq_id']);

		} else {

			$data['categoriess'] = array();

		}



		if (isset($this->request->post['sort_order'])) {

			$data['sort_order'] = $this->request->post['sort_order'];

		} elseif (!empty($faq_info)) {

			$data['sort_order'] = $faq_info['sort_order'];

		} else {

			$data['sort_order'] = 0;

		}



		if (isset($this->request->post['status'])) {

			$data['status'] = $this->request->post['status'];

		} elseif (!empty($faq_info)) {

			$data['status'] = $faq_info['status'];

		} else {

			$data['status'] = true;

		}

		

		$this->load->model('faq/category');

		$data['categories'] = $this->model_faq_category->getCategories($filter_data=array());



		$data['header'] = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this->load->controller('common/footer');



		$this->response->setOutput($this->load->view('pages/faq_form', $data));

	}



	protected function validateForm() {

		if (!$this->user->hasPermission('modify', 'pages/faq')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}



		foreach ($this->request->post['faq_description'] as $language_id => $value) {

			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {

				$this->error['name'][$language_id] = $this->language->get('error_name');

			}

		}

		

		if(empty($this->request->post['categories'])){

			$this->error['categories']=$this->language->get('error_category');

			

		}



		return !$this->error;

	}



	protected function validateDelete() {

		if (!$this->user->hasPermission('modify', 'pages/faq')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}



		return !$this->error;

	}



	protected function validateRepair() {

		if (!$this->user->hasPermission('modify', 'pages/faq')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}



		return !$this->error;

	}

}