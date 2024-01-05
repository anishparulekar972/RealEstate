<?php


class ControllerPagesTestimonial extends Controller {


	private $error = array();


 


	public function index() {


		$this->language->load('pages/testimonial');





		$this->document->setTitle($this->language->get('heading_title'));


		


		$this->load->model('property/testimonial');


		


		$this->getList();


	} 





	public function add() {


		$this->language->load('pages/testimonial');





		$this->document->setTitle($this->language->get('heading_title'));


		


		$this->load->model('property/testimonial');


		


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_testimonial->addtestimonial($this->request->post);


			


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


						


			$this->response->redirect($this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getForm();


	}





	public function edit() {


		$this->language->load('pages/testimonial');





		$this->document->setTitle($this->language->get('heading_title'));


		


		$this->load->model('property/testimonial');


		


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_property_testimonial->edittestimonial($this->request->get['testimonial_id'], $this->request->post);


			


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


						


			$this->response->redirect($this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getForm();


	}





	public function delete() { 


		$this->language->load('pages/testimonial');





		$this->document->setTitle($this->language->get('heading_title'));


		


		$this->load->model('property/testimonial');





		if (isset($this->request->post['selected']) && $this->validateDelete()) {


			foreach($this->request->post['selected'] as $testimonial_id) {


				$this->model_property_testimonial->deletetestimonial($testimonial_id);


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


						


			$this->response->redirect($this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getList();


	}





	protected function getList() {


		if (isset($this->request->get['sort'])) {


			$sort = $this->request->get['sort'];


		} else {


			$sort = 'r.name';


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





		$data['testimonials'] = array();





		$data = array(


			'sort'  => $sort,


			'order' => $order,


			'start' => ($page - 1) * $this->config->get('config_admin_limit'),


			'limit' => $this->config->get('config_admin_limit')


		);


		


		$testimonial_total = $this->model_property_testimonial->getTotaltestimonials($data);


		


		$results = $this->model_property_testimonial->gettestimonials($data);


		if(isset($results)) {


			foreach($results as $result) {





				$data['testimonials'][] = array(


					'testimonial_id'  => $result['testimonial_id'],


					'author'     => $result['name'],


					'country'     => $result['country'],


					'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),


					'date_added' => date($this->language->get('date_format_short'), strtotime($result['date'])),


					'selected'   => isset($this->request->post['selected']) && in_array($result['testimonial_id'], $this->request->post['selected']),


					'edit'        => $this->url->link('pages/testimonial/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $result['testimonial_id'] . $url, 'SSL')


				);





			}


		}


		


		$data['insert'] = $this->url->link('pages/testimonial/add', 'token=' . $this->session->data['token'] . $url, 'SSL');


		


		$data['delete'] = $this->url->link('pages/testimonial/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	


	


		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_no_results'] = $this->language->get('text_no_results');


		$data['text_list'] = $this->language->get('text_list');


		$data['text_confirm'] = $this->language->get('text_confirm');





		$data['column_product'] = $this->language->get('column_product');


		$data['entry_country'] = $this->language->get('entry_country');


		$data['column_author'] = $this->language->get('column_author');


		$data['column_rating'] = $this->language->get('column_rating');


		$data['column_status'] = $this->language->get('column_status');


		$data['column_date_added'] = $this->language->get('column_date_added');


		$data['column_action'] = $this->language->get('column_action');		


		


		$data['button_insert'] = $this->language->get('button_insert');


		$data['button_delete'] = $this->language->get('button_delete');


		$data['button_edit'] = $this->language->get('button_edit');


 


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





		if ($order == 'ASC') {


			$url .= '&order=DESC';


		} else {


			$url .= '&order=ASC';


		}





		if (isset($this->request->get['page'])) {


			$url .= '&page=' . $this->request->get['page'];


		}


		


		$data['sort_product'] = $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');


		$data['sort_author'] = $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, 'SSL');


		$data['sort_country'] = $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . '&sort=r.country' . $url, 'SSL');


		$data['sort_status'] = $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, 'SSL');


		$data['sort_date_added'] = $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, 'SSL');


		


		$url = '';





		if (isset($this->request->get['sort'])) {


			$url .= '&sort=' . $this->request->get['sort'];


		}


												


		if (isset($this->request->get['order'])) {


			$url .= '&order=' . $this->request->get['order'];


		}


		


		$data['breadcrumbs'] = array();





   		$data['breadcrumbs'][] = array(


       		'text'      => $this->language->get('text_home'),


			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),


      		'separator' => false


   		);





   		$data['breadcrumbs'][] = array(


       		'text'      => $this->language->get('heading_title'),


			'href'      => $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'),


      		'separator' => ' :: '


   		);





		$pagination = new Pagination();


		$pagination->total = $testimonial_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_admin_limit');


		$pagination->text = $this->language->get('text_pagination');


		$pagination->url = $this->url->link('property/testimonial', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');


			


		$data['pagination'] = $pagination->render();


		$data['results'] = sprintf($this->language->get('text_pagination'), ($testimonial_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($testimonial_total - $this->config->get('config_limit_admin'))) ? $testimonial_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $testimonial_total, ceil($testimonial_total / $this->config->get('config_limit_admin')));





		$data['sort'] = $sort;


		$data['order'] = $order;


				


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');


		


		





		$this->response->setOutput($this->load->view('pages/testimonial_list', $data));


	}





	protected function getForm() {


		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_enabled'] = $this->language->get('text_enabled');


		$data['text_disabled'] = $this->language->get('text_disabled');


		$data['text_none'] = $this->language->get('text_none');


		$data['text_select'] = $this->language->get('text_select');


		$data['text_form'] = !isset($this->request->get['testimonial_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');





		$data['entry_product'] = $this->language->get('entry_product');


		$data['entry_author'] = $this->language->get('entry_author');


		$data['entry_rating'] = $this->language->get('entry_rating');


		$data['entry_status'] = $this->language->get('entry_status');


		$data['entry_text'] = $this->language->get('entry_text');


		$data['entry_good'] = $this->language->get('entry_good');


		$data['entry_bad'] = $this->language->get('entry_bad');




		$data['text_product']   = $this->language->get('text_product');
 		$data['text_author']    = $this->language->get('text_author');
		$data['text_rating']    = $this->language->get('text_rating');
		$data['text_status']    = $this->language->get('text_status');
		$data['text_text']      = $this->language->get('text_text');
		$data['text_good']      = $this->language->get('text_good');
        $data['text_bad']        = $this->language->get('text_bad');
        $data['text_image']        = $this->language->get('text_image');







		$data['button_save']    = $this->language->get('button_save');
		$data['button_cancel']  = $this->language->get('button_cancel');





 		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}


 		


		if (isset($this->error['product'])) {


			$data['error_product'] = $this->error['product'];


		} else {


			$data['error_product'] = '';


		}


		


 		if (isset($this->error['author'])) {


			$data['error_author'] = $this->error['author'];


		} else {


			$data['error_author'] = '';


		}


		


 		if (isset($this->error['text'])) {


			$data['error_text'] = $this->error['text'];


		} else {


			$data['error_text'] = '';


		}


		


 		if (isset($this->error['rating'])) {


			$data['error_rating'] = $this->error['rating'];


		} else {


			$data['error_rating'] = '';


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


       		'text'      => $this->language->get('text_home'),


			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),


      		'separator' => false


   		);





   		$data['breadcrumbs'][] = array(


       		'text'      => $this->language->get('heading_title'),


			'href'      => $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL'),


      		'separator' => ' :: '


   		);


										


		if (!isset($this->request->get['testimonial_id'])) { 


			$data['action'] = $this->url->link('pages/testimonial/add', 'token=' . $this->session->data['token'] . $url, 'SSL');


		} else {


			$data['action'] = $this->url->link('pages/testimonial/edit', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $this->request->get['testimonial_id'] . $url, 'SSL');


		}


		


		$data['cancel'] = $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'] . $url, 'SSL');





		if (isset($this->request->get['testimonial_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {


			$testimonial_info = $this->model_property_testimonial->gettestimonial($this->request->get['testimonial_id']);


		}


		


		$data['token'] = $this->session->data['token'];


			


		

	


		if (isset($this->request->post['country'])) {


			$data['country'] = $this->request->post['country'];


		} elseif (!empty($testimonial_info)) {


			$data['country'] = $testimonial_info['country'];


		} else {


			$data['country'] = '';


		}


				


		if (isset($this->request->post['author'])) {


			$data['author'] = $this->request->post['author'];


		} elseif (!empty($testimonial_info)) {


			$data['author'] = $testimonial_info['name'];


		} else {


			$data['author'] = '';


		}





		if (isset($this->request->post['text'])) {


			$data['text'] = $this->request->post['text'];


		} elseif (!empty($testimonial_info)) {


			$data['text'] = $testimonial_info['enquiry'];


		} else {


			$data['text'] = '';


		}





	


		if (isset($this->request->post['status'])) {


			$data['status'] = $this->request->post['status'];


		} elseif (!empty($testimonial_info)) {


			$data['status'] = $testimonial_info['status'];


		} else {


			$data['status'] = '';


		}


		


		$data['entry_image'] = $this->language->get('entry_image');


		


		if (isset($this->request->post['image'])) {


			$data['image'] = $this->request->post['image'];


		} elseif (!empty($testimonial_info)) {


			$data['image'] = $testimonial_info['image'];


		} else {


			$data['image'] = '';


		}





		$this->load->model('tool/image');





		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);


		} elseif (!empty($testimonial_info) && is_file(DIR_IMAGE . $testimonial_info['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($testimonial_info['image'], 100, 100);


		} else {


			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		}





		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


				


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/testimonial_form', $data));


	}


	


	protected function validateForm() {


		if (!$this->user->hasPermission('modify', 'pages/testimonial')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}


	


		if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 64)) {


			$this->error['author'] = $this->language->get('error_author');


		}





		if (utf8_strlen($this->request->post['text']) < 1) {


			$this->error['text'] = $this->language->get('error_text');


		}


				


		return !$this->error;


	}





		protected function validateDelete() {


		if (!$this->user->hasPermission('modify', 'pages/testimonial')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		return !$this->error;


	}	


}


?>