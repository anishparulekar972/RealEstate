<?php


class ControllerMembershipPlans extends Controller {


	private $error = array();





	public function index() {


		$this->load->language('membership/plans');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('membership/plans');





		$this->getList();


	}





	public function add() {


		$this->load->language('membership/plans');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('membership/plans');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			//echo "<pre>";


			///print_r($this->request->post);die();


			$this->model_membership_plans->addPlans($this->request->post);





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





			$this->response->redirect($this->url->link('membership/plans', 'token=' . $this->session->data['token'] . $url, true));


		}





		$this->getForm();


	}





	public function edit() {


		$this->load->language('membership/plans');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('membership/plans');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_membership_plans->editPlans($this->request->get['plans_id'], $this->request->post);





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





			$this->response->redirect($this->url->link('membership/plans', 'token=' . $this->session->data['token'] . $url, true));


		}





		$this->getForm();


	}





	public function delete() {


		$this->load->language('membership/plans');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('membership/plans');





		if (isset($this->request->post['selected']) && $this->validateDelete()) {


			foreach ($this->request->post['selected'] as $plans_id) {


				$this->model_membership_plans->deletePlans($plans_id);


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





			$this->response->redirect($this->url->link('membership/plans', 'token=' . $this->session->data['token'] . $url, true));


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


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('membership/plans', 'token=' . $this->session->data['token'] . $url, true)


		);





		$data['add'] = $this->url->link('membership/plans/add', 'token=' . $this->session->data['token'] . $url, true);


		$data['delete'] = $this->url->link('membership/plans/delete', 'token=' . $this->session->data['token'] . $url, true);


		


		$data['plansies'] = array();





		$filter_data = array(


			'sort'  => $sort,


			'order' => $order,


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


		);


		$this->load->model('tool/image');


		$plans_total = $this->model_membership_plans->getTotalPlansies();





		$results = $this->model_membership_plans->getPlansies($filter_data);


		


		foreach ($results as $result) {


		


			if (is_file(DIR_IMAGE . $result['image'])) {


				$image = $this->model_tool_image->resize($result['image'], 40, 40);


			} else {


				$image = $this->model_tool_image->resize('no_image.png', 40, 40);


			}


			


			$data['plansies'][] = array(


				'plans_id' => $result['plans_id'],


				'name'        => $result['name'],


				'image'      => $image,


				'price'       => $this->currency->format($result['price'],$this->config->get('config_currency')),


				'sort_order'  => $result['sort_order'],


				'edit'        => $this->url->link('membership/plans/edit', 'token=' . $this->session->data['token'] . '&plans_id=' . $result['plans_id'] . $url, true),


				'delete'      => $this->url->link('membership/plans/delete', 'token=' . $this->session->data['token'] . '&plans_id=' . $result['plans_id'] . $url, true)


			);


		}





		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_list'] = $this->language->get('text_list');


		$data['text_no_results'] = $this->language->get('text_no_results');


		$data['text_confirm'] = $this->language->get('text_confirm');





		$data['column_name'] = $this->language->get('column_name');


		$data['column_image'] = $this->language->get('column_image');


		$data['column_price'] = $this->language->get('column_price');


		$data['column_sort_order'] = $this->language->get('column_sort_order');


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





		$data['sort_name'] = $this->url->link('membership/plans', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);


		$data['sort_price'] = $this->url->link('membership/plans', 'token=' . $this->session->data['token'] . '&sort=price' . $url, true);


		$data['sort_sort_order'] = $this->url->link('membership/plans', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);





		$url = '';





		if (isset($this->request->get['sort'])) {


			$url .= '&sort=' . $this->request->get['sort'];


		}





		if (isset($this->request->get['order'])) {


			$url .= '&order=' . $this->request->get['order'];


		}





		$pagination = new Pagination();


		$pagination->total = $plans_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('membership/plans', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);





		$data['pagination'] = $pagination->render();





		$data['results'] = sprintf($this->language->get('text_pagination'), ($plans_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($plans_total - $this->config->get('config_limit_admin'))) ? $plans_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $plans_total, ceil($plans_total / $this->config->get('config_limit_admin')));





		$data['sort'] = $sort;


		$data['order'] = $order;





		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('membership/plans_list', $data));


	}





	protected function getForm() {


		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_form'] = !isset($this->request->get['plans_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');


		$data['text_none'] = $this->language->get('text_none');


		$data['text_default'] = $this->language->get('text_default');


		$data['text_enabled'] = $this->language->get('text_enabled');


		$data['text_disabled'] = $this->language->get('text_disabled');


		$data['enter_validate'] = $this->language->get('enter_validate');


		$data['enter_number'] = $this->language->get('enter_number');


		 $data['text_day'] = $this->language->get('text_day');


		 $data['text_month'] = $this->language->get('text_month');


		$data['text_years'] = $this->language->get('text_years');


		$data['text_select'] = $this->language->get('text_select');


           $data['text_none'] = $this->language->get('text_none');





		$data['entry_name'] = $this->language->get('entry_name');


		$data['entry_description'] = $this->language->get('entry_description');


		$data['entry_price'] = $this->language->get('entry_price');


		$data['entry_keyword'] = $this->language->get('entry_keyword');


		$data['entry_image'] = $this->language->get('entry_image');


		$data['entry_sort_order'] = $this->language->get('entry_sort_order');


		$data['entry_status'] = $this->language->get('entry_status');


		$data['entry_variation'] = $this->language->get('entry_variation');


		$data['entry_text'] = $this->language->get('entry_text');


		$data['button_add'] = $this->language->get('button_add');


		$data['entry_title'] = $this->language->get('entry_title');


		


		


		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');


		$data['button_remove'] = $this->language->get('button_remove');


		$data['button_variation_add'] = $this->language->get('button_variation_add');


		$data['button_extraoption_add'] = $this->language->get('button_extraoption_add');


		


		$data['help_keyword'] = $this->language->get('help_keyword');


		





		





		$data['tab_general'] = $this->language->get('tab_general');


		$data['tab_data'] = $this->language->get('tab_data');


		$data['tab_variation'] = $this->language->get('tab_variation');


		$data['tab_extraoptions'] = $this->language->get('tab_extraoptions');


		$data['token'] = $this->session->data['token'];





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





		if (isset($this->error['parent'])) {


			$data['error_parent'] = $this->error['parent'];


		} else {


			$data['error_parent'] = '';


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


			'href' => $this->url->link('membership/plans', 'token=' . $this->session->data['token'] . $url, true)


		);





		if (!isset($this->request->get['plans_id'])) {


			$data['action'] = $this->url->link('membership/plans/add', 'token=' . $this->session->data['token'] . $url, true);


		} else {


			$data['action'] = $this->url->link('membership/plans/edit', 'token=' . $this->session->data['token'] . '&plans_id=' . $this->request->get['plans_id'] . $url, true);


		}





		$data['cancel'] = $this->url->link('membership/plans', 'token=' . $this->session->data['token'] . $url, true);





		if (isset($this->request->get['plans_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {


			$plans_info = $this->model_membership_plans->getPlans($this->request->get['plans_id']);


		}





		$data['token'] = $this->session->data['token'];





		$this->load->model('localisation/language');





		$data['languages'] = $this->model_localisation_language->getLanguages();





		if (isset($this->request->post['plans_description'])) {


			$data['plans_description'] = $this->request->post['plans_description'];


		} elseif (isset($this->request->get['plans_id'])) {


			$data['plans_description'] = $this->model_membership_plans->getPlansDescriptions($this->request->get['plans_id']);


		} else {


			$data['plans_description'] = array();


		}





		


		if (isset($this->request->post['price'])) {


			$data['price'] = $this->request->post['price'];


		} elseif (!empty($plans_info)) {


			$data['price'] = $plans_info['price'];


		} else {


			$data['price'] = '';


		}


		if (isset($this->request->post['keyword'])) {


			$data['keyword'] = $this->request->post['keyword'];


		} elseif (!empty($plans_info)) {


			$data['keyword'] = $plans_info['keyword'];


		} else {


			$data['keyword'] = '';


		}


		


		if (isset($this->request->post['number'])) {


			$data['number'] = $this->request->post['number'];


		} elseif (!empty($plans_info)) {


			$data['number'] = $plans_info['number'];


		} else {


			$data['number'] = '';


		}


		


		if (isset($this->request->post['type'])) {


			$data['type'] = $this->request->post['type'];


		} elseif (!empty($plans_info)) {


			$data['type'] = $plans_info['type'];


		} else {


			$data['type'] = '';


		}





		if (isset($this->request->post['image'])) {


			$data['image'] = $this->request->post['image'];


		} elseif (!empty($plans_info)) {


			$data['image'] = $plans_info['image'];


		} else {


			$data['image'] = '';


		}





		$this->load->model('tool/image');





		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);


		} elseif (!empty($plans_info) && is_file(DIR_IMAGE . $plans_info['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($plans_info['image'], 100, 100);


		} else {


			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		}





		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);





		





		if (isset($this->request->post['sort_order'])) {


			$data['sort_order'] = $this->request->post['sort_order'];


		} elseif (!empty($plans_info)) {


			$data['sort_order'] = $plans_info['sort_order'];


		} else {


			$data['sort_order'] = 0;


		}





		if (isset($this->request->post['status'])) {


			$data['status'] = $this->request->post['status'];


		} elseif (!empty($plans_info)) {


			$data['status'] = $plans_info['status'];


		} else {


			$data['status'] = true;


		}


		


		// Variation


		


		$this->load->model('membership/variation');





		if (isset($this->request->post['plans_variation'])) {


			$plans_variations = $this->request->post['plans_variation'];


		} elseif (isset($this->request->get['plans_id'])) {


			$plans_variations = $this->model_membership_plans->getPlansVariations($this->request->get['plans_id']);


		} else {


			$plans_variations = array();


		}





		$data['plans_variations'] = array();





		foreach ($plans_variations as $plans_variation) {


			$variation_info = $this->model_membership_variation->getVariation($plans_variation['variation_id']);


		


			if ($variation_info) {


				$data['plans_variations'][] = array(


					'variation_id'                  => $plans_variation['variation_id'],


					'name'                          => $variation_info['name']


					


				);


			}


		}


		


		// Extra Options


		


		if (isset($this->request->post['plans_options'])) {


			$plans_optionss = $this->request->post['plans_options'];


		} elseif (isset($this->request->get['plans_id'])) {


			$plans_optionss = $this->model_membership_plans->getPlansOptions($this->request->get['plans_id']);


		} else {


			$plans_optionss = array();


		}





		$data['plans_optionss'] = array();





		foreach ($plans_optionss as $plans_options) {


			


			$data['plans_optionss'][] = array(				


				'title' => $plans_options['title'],


				'price' => $plans_options['price'],


				'sort_order' => $plans_options['sort_order']


			);


		}





		


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('membership/plans_form', $data));


	}





	protected function validateForm() {


		if (!$this->user->hasPermission('modify', 'membership/plans')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		foreach ($this->request->post['plans_description'] as $language_id => $value) {


			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {


				$this->error['name'][$language_id] = $this->language->get('error_name');


			}





			


		}





		if (utf8_strlen($this->request->post['keyword']) > 0) {


			$this->load->model('catalog/url_alias');





			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);





			if ($url_alias_info && isset($this->request->get['plans_id']) && $url_alias_info['query'] != 'plans_id=' . $this->request->get['plans_id']) {


				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));


			}





			if ($url_alias_info && !isset($this->request->get['plans_id'])) {


				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));


			}


		}


		


		if ($this->error && !isset($this->error['warning'])) {


			$this->error['warning'] = $this->language->get('error_warning');


		}


		


		return !$this->error;


	}





	protected function validateDelete() {


		if (!$this->user->hasPermission('modify', 'membership/plans')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		return !$this->error;


	}


	


	


		public function autocomplete() {


			


		


		if (isset($this->request->get['filter_name'])) {


			


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


			


			


			$this->load->model('membership/plans');


			


			$filter_data = array(


			'sort'  => $this->request->get['filter_name'],


			'order' => $order,


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


		);





		$results = $this->model_membership_plans->getPlansies($filter_data);





			foreach ($results as $result) {


				


				$json[] = array(


					'plans_id' => $result['plans_id'],


					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))


				);


			}


		}


		


		$sort_order = array();





		foreach ($json as $key => $value) {


			$sort_order[$key] = $value['name'];


		}





		array_multisort($sort_order, SORT_ASC, $json);





		$this->response->addHeader('Content-Type: application/json');


		$this->response->setOutput(json_encode($json));


		


		


		}





	





}


