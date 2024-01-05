<?php


class ControllerPagesgallery extends Controller {


	private $error = array();





	public function index() {


		$this->load->language('pages/gallery');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/gallery');





		$this->getList();


	}





	public function add() {


		$this->load->language('pages/gallery');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/gallery');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_gallery->addgallery($this->request->post);





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





			$this->response->redirect($this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getForm();


	}





	public function edit() {


		$this->load->language('pages/gallery');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/gallery');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_gallery->editgallery($this->request->get['album_id'], $this->request->post);





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





			$this->response->redirect($this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getForm();


	}





	public function delete() {


		$this->load->language('pages/gallery');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/gallery');





		if (isset($this->request->post['selected']) && $this->validateDelete()) {


			foreach ($this->request->post['selected'] as $album_id) {


				$this->model_property_gallery->deletegallery($album_id);


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





			$this->response->redirect($this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getList();


	}





	protected function getList() {


		$this->load->model('tool/image');


		


		if(isset($this->request->get['page'])){


			$page = $this->request->get['page'];


		}else{


			$page = 1;


		}





		$url = '';





		if (isset($this->request->get['page'])) {


			$url .= '&page=' . $this->request->get['page'];


		}





		if (isset($this->request->get['order'])) {


			$url .= '&order=' . $this->request->get['order'];


		}


		





		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], 'SSL')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . $url, 'SSL')


		);


		


		$data['insert'] = $this->url->link('pages/gallery/add', 'token=' . $this->session->data['token'] . $url, 'SSL');


		$data['delete'] = $this->url->link('pages/gallery/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');





		$data['gallaries'] = array();





		$filter_data = array(


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


		);





		$gallery_total = $this->model_property_gallery->getTotalgallaries();


		$results = $this->model_property_gallery->getgallaries($filter_data);





		foreach ($results as $result) {


			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {


				$image = $this->model_tool_image->resize($result['image'], 40, 40);


			} else {


				$image = $this->model_tool_image->resize('no_image.png', 40, 40);


			}


		


			


			$data['gallaries'][] = array(


				'album_id' 	  => $result['album_id'],


				'name'        => $result['name'],


				'image'		  => $image, 	


				'status'	  => ($result['status']==1 ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),	


				'sort_order'  => $result['sort_order'],


				'selected'    => isset($this->request->post['selected']) && in_array($result['album_id'], $this->request->post['selected']),


				'edit'        => $this->url->link('pages/gallery/edit', 'token=' . $this->session->data['token'] . '&album_id=' . $result['album_id'] . $url, 'SSL')


			);


		}





		$data['heading_title'] = $this->language->get('heading_title');


		


		$data['text_list'] = $this->language->get('text_list');


		$data['text_no_results'] = $this->language->get('text_no_results');


		$data['text_confirm'] = $this->language->get('text_confirm');





		$data['column_name'] = $this->language->get('column_name');


		$data['column_sort_order'] = $this->language->get('column_sort_order');


		$data['column_image'] = $this->language->get('column_image');


		$data['column_status'] = $this->language->get('column_status');


		$data['column_action'] = $this->language->get('column_action');





		$data['button_insert'] = $this->language->get('button_insert');


		$data['button_edit'] = $this->language->get('button_edit');


		$data['button_delete'] = $this->language->get('button_delete');


		


		$data['dashmenu'] = $this->load->controller('pages/dashmenu');





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





		$url = '';





		if (isset($this->request->get['page'])) {


			$url .= '&page=' . $this->request->get['page'];


		}





		$pagination = new Pagination();


		$pagination->total = $gallery_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');





		$data['pagination'] = $pagination->render();





		$data['results'] = sprintf($this->language->get('text_pagination'), ($gallery_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($gallery_total - $this->config->get('config_limit_admin'))) ? $gallery_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $gallery_total, ceil($gallery_total / $this->config->get('config_limit_admin')));








		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/gallery_list', $data));


	}





	protected function getForm() {


		$data['heading_title'] = $this->language->get('heading_title');


		


		$data['text_form'] = !isset($this->request->get['album_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');


		$data['text_loading'] = $this->language->get('text_loading');





		$data['text_none'] = $this->language->get('text_none');


		$data['text_default'] = $this->language->get('text_default');


		$data['text_image_manager'] = $this->language->get('text_image_manager');


		$data['text_browse'] = $this->language->get('text_browse');


		$data['text_clear'] = $this->language->get('text_clear');		


		$data['text_enabled'] = $this->language->get('text_enabled');


    	$data['text_disabled'] = $this->language->get('text_disabled');


		$data['text_percent'] = $this->language->get('text_percent');


		$data['text_amount'] = $this->language->get('text_amount');


				


		$data['entry_name'] = $this->language->get('entry_name');


		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');


		$data['entry_meta_description'] = $this->language->get('entry_meta_description');


		$data['entry_description'] = $this->language->get('entry_description');


		$data['entry_parent'] = $this->language->get('entry_parent');


		$data['entry_filter'] = $this->language->get('entry_filter');


		$data['entry_store'] = $this->language->get('entry_store');


		$data['entry_keyword'] = $this->language->get('entry_keyword');


		$data['entry_image'] = $this->language->get('entry_image');


		$data['entry_top'] = $this->language->get('entry_top');


		$data['entry_column'] = $this->language->get('entry_column');		


		$data['entry_sort_order'] = $this->language->get('entry_sort_order');


		$data['entry_status'] = $this->language->get('entry_status');


		$data['entry_layout'] = $this->language->get('entry_layout');


		$data['entry_url'] = $this->language->get('entry_url');





		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');


		$data['button_upload'] = $this->language->get('button_upload');


		


		$data['tab_general'] = $this->language->get('tab_general');


    	$data['tab_data'] = $this->language->get('tab_data');


		$data['tab_design'] = $this->language->get('tab_design');


		


		$data['dashmenu'] = $this->load->controller('pages/dashmenu');





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





		if (isset($this->error['filename'])) {


			$data['error_filename'] = $this->error['filename'];


		} else {


			$data['error_filename'] = '';


		}





		if (isset($this->error['mask'])) {


			$data['error_mask'] = $this->error['mask'];


		} else {


			$data['error_mask'] = '';


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


			'href' => $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], 'SSL')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . $url, 'SSL')


		);


		


		if (!isset($this->request->get['album_id'])) {


			$data['action'] = $this->url->link('pages/gallery/add', 'token=' . $this->session->data['token'] . $url, 'SSL');


		} else {


			$data['action'] = $this->url->link('pages/gallery/edit', 'token=' . $this->session->data['token'] . '&album_id=' . $this->request->get['album_id'] . $url, 'SSL');


		}





		$data['cancel'] = $this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . $url, 'SSL');





		$this->load->model('localisation/language');





		$data['languages'] = $this->model_localisation_language->getLanguages();





		if (isset($this->request->get['album_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {


			$gallery_info = $this->model_property_gallery->getgallery($this->request->get['album_id']);


		}





		$data['token'] = $this->session->data['token'];





		if (isset($this->request->get['album_id'])) {


			$data['album_id'] = $this->request->get['album_id'];


		} else {


			$data['album_id'] = 0;


		}





		$this->load->model('localisation/language');


		


		$data['languages'] = $this->model_localisation_language->getLanguages();





		if (isset($this->request->post['album_description'])) {


			$data['album_description'] = $this->request->post['album_description'];


		} elseif (isset($this->request->get['album_id'])) {


			$data['album_description'] = $this->model_property_gallery->getgalleryDescriptions($this->request->get['album_id']);


		} else {


			$data['album_description'] = array();


		}





		$this->load->model('setting/store');


		


		$data['stores'] = $this->model_setting_store->getStores();


		


		


		if (isset($this->request->post['image'])) {


			$data['image'] = $this->request->post['image'];


		} elseif (!empty($gallery_info)) {


			$data['image'] = $gallery_info['image'];


		} else {


			$data['image'] = '';


		}


		


		$this->load->model('tool/image');





		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);


		} elseif (!empty($gallery_info) && $gallery_info['image'] && file_exists(DIR_IMAGE . $gallery_info['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($gallery_info['image'], 100, 100);


		} else {


			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		}


		


		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


			


		if (isset($this->request->post['sort_order'])) {


			$data['sort_order'] = $this->request->post['sort_order'];


		} elseif (!empty($gallery_info)) {


			$data['sort_order'] = $gallery_info['sort_order'];


		} else {


			$data['sort_order'] = 0;


		}


		


		if (isset($this->request->post['status'])) {


			$data['status'] = $this->request->post['status'];


		} elseif (!empty($gallery_info)) {


			$data['status'] = $gallery_info['status'];


		} else {


			$data['status'] = 1;


		}


		


		if (isset($this->request->post['keyword'])) {


			$data['keyword'] = $this->request->post['keyword'];


		} elseif (!empty($gallery_info)) {


			$data['keyword'] = $gallery_info['keyword'];


		} else {


			$data['keyword'] = '';


		}





		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/gallery_form', $data));


	}





	protected function validateForm(){


		if (!$this->user->hasPermission('modify', 'pages/gallery')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		foreach ($this->request->post['album_description'] as $language_id => $value) {


			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {


				$this->error['name'][$language_id] = $this->language->get('error_name');


			}


		}


		


		if ($this->error && !isset($this->error['warning'])) {


			$this->error['warning'] = $this->language->get('error_warning');


		}


					


		return !$this->error;


	}


	


	protected function validateDelete() {


		if (!$this->user->hasPermission('modify', 'pages/gallery')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}


 


		return !$this->error;


	}








}