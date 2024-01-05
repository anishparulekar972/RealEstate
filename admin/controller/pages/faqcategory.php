<?php

class ControllerPagesFaqCategory extends Controller {

	private $error = array();



	public function index() {

		$this->load->language('pages/faqcategory');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/category');

		

		$this->getList();

	}



	public function add() {

		$this->load->language('pages/faqcategory');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/category');



		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_faq_category->addCategory($this->request->post);



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



			$this->response->redirect($this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}



		$this->getForm();

	}



	public function edit(){

		$this->load->language('pages/faqcategory');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/category');



		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_faq_category->editCategory($this->request->get['fcategory_id'], $this->request->post);



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



			$this->response->redirect($this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}



		$this->getForm();

	}



	public function delete() {

		$this->load->language('pages/faqcategory');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('faq/category');



		if (isset($this->request->post['selected']) && $this->validateDelete()) {

			foreach ($this->request->post['selected'] as $fcategory_id) {

				$this->model_faq_category->deleteCategory($fcategory_id);

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



			$this->response->redirect($this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}



		$this->getList();

	}



	protected function getList() {

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

			'href' => $this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . $url, 'SSL')

		);



		$data['add'] = $this->url->link('pages/faqcategory/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['delete'] = $this->url->link('pages/faqcategory/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['repair'] = $this->url->link('pages/faqcategory/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');



		$data['categories'] = array();



		$filter_data = array(

			'sort'  => $sort,

			'order' => $order,

			'start' => ($page - 1) * $this->config->get('config_limit_admin'),

			'limit' => $this->config->get('config_limit_admin')

		);



		$category_total = $this->model_faq_category->getTotalCategories();



		$results = $this->model_faq_category->getCategories($filter_data);



		foreach ($results as $result) {

			$data['categories'][] = array(

				'fcategory_id' => $result['fcategory_id'],

				'name'        => $result['name'],

				'sort_order'  => $result['sort_order'],

				'edit'        => $this->url->link('pages/faqcategory/edit', 'token=' . $this->session->data['token'] . '&fcategory_id=' . $result['fcategory_id'] . $url, 'SSL'),

				'delete'      => $this->url->link('pages/faqcategory/delete', 'token=' . $this->session->data['token'] . '&fcategory_id=' . $result['fcategory_id'] . $url, 'SSL')

			);

		}



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_list'] = $this->language->get('text_list');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['text_confirm'] = $this->language->get('text_confirm');



		$data['column_name'] = $this->language->get('column_name');

		$data['column_sort_order'] = $this->language->get('column_sort_order');

		$data['column_action'] = $this->language->get('column_action');



		$data['button_add'] = $this->language->get('button_add');

		$data['button_edit'] = $this->language->get('button_edit');

		$data['button_delete'] = $this->language->get('button_delete');

		$data['button_rebuild'] = $this->language->get('button_rebuild');



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



		$data['sort_name'] = $this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');

		$data['sort_sort_order'] = $this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');



		$url = '';



		if (isset($this->request->get['sort'])) {

			$url .= '&sort=' . $this->request->get['sort'];

		}



		if (isset($this->request->get['order'])) {

			$url .= '&order=' . $this->request->get['order'];

		}



		$pagination = new Pagination();

		$pagination->total = $category_total;

		$pagination->page = $page;

		$pagination->limit = $this->config->get('config_limit_admin');

		$pagination->url = $this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');



		$data['pagination'] = $pagination->render();



		$data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));



		$data['sort'] = $sort;

		$data['order'] = $order;



		$data['header'] = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this->load->controller('common/footer');



		$this->response->setOutput($this->load->view('pages/faqcategory_list', $data));

	}



	protected function getForm() {

		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_form'] = !isset($this->request->get['fcategory_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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


      ///


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

			'href' => $this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . $url, 'SSL')

		);



		if (!isset($this->request->get['fcategory_id'])) {

			$data['action'] = $this->url->link('pages/faqcategory/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

		} else {

			$data['action'] = $this->url->link('pages/faqcategory/edit', 'token=' . $this->session->data['token'] . '&fcategory_id=' . $this->request->get['fcategory_id'] . $url, 'SSL');

		}



		$data['cancel'] = $this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'] . $url, 'SSL');



		if (isset($this->request->get['fcategory_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {

			$category_info = $this->model_faq_category->getCategory($this->request->get['fcategory_id']);

		}



		$data['token'] = $this->session->data['token'];



		$this->load->model('localisation/language');



		$data['languages'] = $this->model_localisation_language->getLanguages();



		if (isset($this->request->post['category_description'])) {

			$data['category_description'] = $this->request->post['category_description'];

		} elseif (isset($this->request->get['fcategory_id'])) {

			$data['category_description'] = $this->model_faq_category->getCategoryDescriptions($this->request->get['fcategory_id']);

		} else {

			$data['category_description'] = array();

		}



		

		$this->load->model('setting/store');



		$data['stores'] = $this->model_setting_store->getStores();



		if (isset($this->request->post['category_store'])) {

			$data['category_store'] = $this->request->post['category_store'];

		} elseif (isset($this->request->get['fcategory_id'])) {

			$data['category_store'] = $this->model_faq_category->getCategoryStores($this->request->get['fcategory_id']);

		} else {

			$data['category_store'] = array(0);

		}



		if (isset($this->request->post['keyword'])) {

			$data['keyword'] = $this->request->post['keyword'];

		} elseif (!empty($category_info)) {

			$data['keyword'] = $category_info['keyword'];

		} else {

			$data['keyword'] = '';

		}



		if (isset($this->request->post['sort_order'])) {

			$data['sort_order'] = $this->request->post['sort_order'];

		} elseif (!empty($category_info)) {

			$data['sort_order'] = $category_info['sort_order'];

		} else {

			$data['sort_order'] = 0;

		}



		if (isset($this->request->post['status'])) {

			$data['status'] = $this->request->post['status'];

		} elseif (!empty($category_info)) {

			$data['status'] = $category_info['status'];

		} else {

			$data['status'] = true;

		}



		$data['header'] = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this->load->controller('common/footer');



		$this->response->setOutput($this->load->view('pages/faqcategory_form', $data));

	}



	protected function validateForm() {

		if (!$this->user->hasPermission('modify', 'pages/faqcategory')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}



		foreach ($this->request->post['category_description'] as $language_id => $value) {

			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {

				$this->error['name'][$language_id] = $this->language->get('error_name');

			}

		}



		if (utf8_strlen($this->request->post['keyword']) > 0) {

			$this->load->model('catalog/url_alias');



			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);



			if ($url_alias_info && isset($this->request->get['fcategory_id']) && $url_alias_info['query'] != 'fcategory_id=' . $this->request->get['fcategory_id']) {

				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));

			}



			if ($url_alias_info && !isset($this->request->get['fcategory_id'])) {

				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));

			}



			if ($this->error && !isset($this->error['warning'])) {

				$this->error['warning'] = $this->language->get('error_warning');

			}

		}



		return !$this->error;

	}



	protected function validateDelete() {

		if (!$this->user->hasPermission('modify', 'pages/faqcategory')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}



		return !$this->error;

	}



	protected function validateRepair() {

		if (!$this->user->hasPermission('modify', 'pages/faqcategory')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}



		return !$this->error;

	}

}