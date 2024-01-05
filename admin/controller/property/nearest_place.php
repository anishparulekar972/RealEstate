<?php


class ControllerPropertyNearestPlace extends Controller{


	private $error = array();


  public function index(){


		$this->load->language('property/nearest_place');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/nearest_place');


		$this->getList();


	}


	public function add(){


		$this->load->language('property/nearest_place');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/nearest_place');


	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){ 


			$this->model_property_nearest_place->addnNearestPlace($this->request->post);


			$this->session->data['success'] = $this->language->get('text_success');


			$url = '';


		if (isset($this->request->get['sort'])){


			$url .= '&sort=' . $this->request->get['sort'];


		}


		if (isset($this->request->get['order'])){


			$url .= '&order=' . $this->request->get['order'];


		}


		if (isset($this->request->get['page'])){


			$url .= '&page=' . $this->request->get['page'];


		}


		$this->response->redirect($this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . $url, true));


	}


	  $this->getform();





	}








	public function edit(){


		$this->load->language('property/nearest_place');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/nearest_place');


 		 if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){


			$this->model_property_nearest_place->editNearestPlace($this->request->get['nearest_place_id'],$this->request->post);


			$this->session->data['success'] = $this->language->get('text_successedit');


			$url = '';


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}


			if (isset($this->request->get['order'])){


				$url .= '&order=' . $this->request->get['order'];


			}


			if (isset($this->request->get['page'])){


				$url .= '&page=' . $this->request->get['page'];


			}


			$this->response->redirect($this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . $url, true));


		}


		$this->getform();


	}


	public function delete(){


		$this->load->language('property/nearest_place');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/nearest_place');


		if (isset($this->request->post['selected']) && $this->validateDelete()){


		foreach ($this->request->post['selected'] as $nearest_place_id){


			$this->model_property_nearest_place->deleteNearestPlace($nearest_place_id);


		}


		$this->session->data['success'] = $this->language->get('text_successdelete');


		$url = '';


		if (isset($this->request->get['sort'])){


			$url .= '&sort=' . $this->request->get['sort'];


		}


		if (isset($this->request->get['order']))


		{


			$url .= '&order=' . $this->request->get['order'];


		}


		if (isset($this->request->get['page']))


		{


			$url .= '&page=' . $this->request->get['page'];


		}


			$this->response->redirect($this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . $url, true));


		}


		$this->getList();


	}


	


	public function getList(){ 


		if (isset($this->request->get['sort'])) {


			$sort = $this->request->get['sort'];


		} else {


		$sort = 'name';


		}if (isset($this->request->get['order'])){


			$order = $this->request->get['order'];} else {


			$order = 'ASC';


		}


		if (isset($this->request->get['page'])) {


			$page = $this->request->get['page'];


		} 


		else {


			$page = 1;


		}


		$url = '';


		if (isset($this->request->get['sort'])) {


			$url .= '&sort=' . $this->request->get['sort'];


		}if (isset($this->request->get['order'])){


			$url .= '&order=' . $this->request->get['order'];


		}


		if (isset($this->request->get['page'])){


			$url .= '&page=' . $this->request->get['page'];


		}


		$data['heading_title']  	= $this->language->get('heading_title');

		$data['text_form']      	= $this->language->get('text_form');
		$data['text_list']      	= $this->language->get('text_list');
		$data['text_no_results']    = $this->language->get('text_no_results');
		$data['text_enable']        = $this->language->get('Enable');
		$data['text_disable']       = $this->language->get('Disable');
		$data['text_confirm']  		= $this->language->get('text_confirm');

		$data['column_image']   	= $this->language->get('column_image');
		$data['column_name']   		= $this->language->get('column_name');
		$data['column_sort_order']  = $this->language->get('column_sort_order');
		$data['column_status']  	= $this->language->get('column_status');
		$data['column_action']  	= $this->language->get('column_action');

		$data['button_add']         = $this->language->get('button_add');
		$data['button_cancle']      = $this->language->get('button_cancle');
		$data['button_delete']      = $this->language->get('button_delete');
		$data['button_']            = $this->language->get('button_delete');
		$data['button_edit']        = $this->language->get('button_edit');
		$data['button_view']        = $this->language->get('button_view');

		$data['column_description'] = $this->language->get('column_description');
		$data['column_price']       = $this->language->get('column_price');
		$data['column_sort_order']  = $this->language->get('column_sort_order');
		
		$data['button_filter'] 		= $this->language->get('button_filter');
		$data['token']         		= $this->session->data['token'];


		//// variable define


		$this->load->model('tool/image');


		$data['nearestplace'] = array();  


		$filter_data = array(


			'sort'  => $sort,


			'order' => $order,


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


		);


		


		$nearestplace_total = $this->model_property_nearest_place->getTotalNearestplace();


		$results = $this->model_property_nearest_place->getNearestPlaces($filter_data);


		foreach ($results as $result){


			if ($result['status']){


				$status = $this->language->get('text_enable');


			}else{


				$status = $this->language->get('text_disable');


			}


			if (is_file(DIR_IMAGE . $result['image'])){	


				$image = $this->model_tool_image->resize($result['image'], 40, 40);


			}else {


				$image = $this->model_tool_image->resize('no_image.png', 40, 40);


			}


			$data['nearestplace'][] = array(


				'nearest_place_id' => $result['nearest_place_id'],


				'name' => $result['name'],


				'image' => $image,


				'sort_order' => $result['sort_order'],


				'status' => $status,


				'edit' => $this->url->link('property/nearest_place/edit', 'token=' . 	$this->session->data['token'] . '&nearest_place_id=' . $result['nearest_place_id'] . $url, true),


				'view' => $this->url->link('sections/form/view', 'token=' . $this->session->data['token'] . '&nearest_place_id=' . $result['nearest_place_id'] . $url, true)


			);


		}	


			


		if (isset($this->request->post['selected'])) {


			$data['selected'] = (array) $this->request->post['selected'];


		}else{


			$data['selected'] = array();


		}


		$data['breadcrumbs'] = array();


		$url = '';


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)


		);


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . $url, true)


		);


		////////select for list///////


		$data['pagination'] = '';


		$data['results'] = '';


		if (isset($this->error['warning'])){


		$data['error_warning'] = $this->error['warning'];


		}else{


			$data['error_warning'] = '';


		}if (isset($this->session->data['success'])){


			$data['success'] = $this->session->data['success'];


			unset($this->session->data['success']);


		}else{


			$data['success'] = '';


		}


		if (isset($this->request->post['selected'])){


			$data['selected'] = (array) $this->request->post['selected'];


		}else {


			$data['selected'] = array();


		}


		


		//action button


		$data['add']    	= $this->url->link('property/nearest_place/add', '&token=' . $this->session->data['token'] . $url, true);


		$data['delete']		= $this->url->link('property/nearest_place/delete', '&token=' . $this->session->data['token'] . $url, true);


		$pagination 		= new Pagination();


		$pagination 		= new Pagination();


		$pagination->total	= $nearestplace_total;


		$pagination->page   = $page;


		$pagination->limit  = $this->config->get('config_limit_admin');


		$pagination->url    = $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);


		$data['pagination'] = $pagination->render();


		$data['results']    = sprintf($this->language->get('text_pagination'), ($nearestplace_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($nearestplace_total - $this->config->get('config_limit_admin'))) ? $nearestplace_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $nearestplace_total, ceil($nearestplace_total / $this->config->get('config_limit_admin')));


		$data['sort']       = $sort;


		$data['order']      = $order;


		if ($order == 'ASC') {


			$url .= '&order=DESC';


		}else{


			$url .= '&order=ASC';


		}	


		$data['sort_name'] 		 = $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);


		$data['sort_image']		 = $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . '&sort=image' . $url, true);		


		$data['sort_sort_order'] = $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);


		$data['sort_status'] 	 = $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . '&sort=status' . $url, true);


		$data['header']     	 = $this->load->controller('common/header');


		$data['column_left'] 	 = $this->load->controller('common/column_left');


		$data['footer']     	 = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('property/nearest_place_list', $data));





	}


	


	public function getform(){
		$data['heading_title']       		= $this->language->get('heading_title');
		$data['text_form']           		= $this->language->get('text_form');
		$data['text_list']           		= $this->language->get('text_list');
		$data['text_enable']  				= $this->language->get('enable');
		$data['text_disable']  				= $this->language->get('disable');

		$data['tab_general']         		= $this->language->get('tab_general');
		$data['tab_data']           		= $this->language->get('tab_data');

		$data['lable_image']   				= $this->language->get('lable_image');
		$data['lable_name']   				= $this->language->get('lable_name');
		$data['lable_sort_order']  			= $this->language->get('lable_sort_order');
		$data['lable_status']  				= $this->language->get('lable_status');

		$data['entry_name']          		= $this->language->get('entry_name');
		$data['entry_image']        		= $this->language->get('entry_image');
		$data['entry_sort_order']   	 	= $this->language->get('entry_sort_order');
		$data['entry_status']       		= $this->language->get('entry_status');

		$data['button_remove']     			= $this->language->get('button_remove');
		$data['button_add']         		= $this->language->get('button_add');
		$data['button_save']   				= $this->language->get('button_save');
		$data['button_delete'] 				= $this->language->get('button_delete');
		$data['button_cancel'] 				= $this->language->get('button_cancel');
	


		$data['breadcrumbs'] = array();


		$url = '';


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('text_home'),


		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)


		);


		if (isset($this->error['warning'])) 


		{


			$data['error_warning'] = $this->error['warning'];


		}else{


			$data['error_warning'] = '';


		}


		if (isset($this->session->data['success'])){


		$data['success'] = $this->session->data['success'];


			unset($this->session->data['success']);


		}else{


		$data['success'] = '';


		}


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . $url, true)


		);


		////////////////////////  language


		$this->load->model('localisation/language');


		$data['languages'] = $this->model_localisation_language->getLanguages();


		/////////////////////// language


		if (isset($this->request->post['selected'])){


			$data['selected'] = (array) $this->request->post['selected'];


		} else {


			$data['selected'] = array();


		}


		if (isset($this->error['name'])){


			$data['error_name'] = $this->error['name'];


		}else {


			$data['error_name'] = '';


		}


		if (isset($this->error['description'])){


			$data['error_desription'] = $this->error['description'];


		}else{


			$data['error_desription'] = '';


		}


		if (isset($this->error['sort_order'])){


			$data['error_sortorder'] = $this->error['sort_order'];


		}else {


			$data['error_sortorder'] = '';





		}


		if (isset($this->error['status'])) {


			$data['error_status'] = $this->error['status'];


		}else {


			$data['error_status'] = '';


		}


		if (!isset($this->request->get['nearest_place_id'])){


			$data['action'] = $this->url->link('property/nearest_place/add', 'token=' . $this->session->data['token'] . $url, true);


		}else{


			$data['action'] = $this->url->link('property/nearest_place/edit', 'token=' . $this->session->data['token'] . '&nearest_place_id=' . $this->request->get['nearest_place_id'] . $url, true);


		}


		$data['cancel'] = $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'] . $url, true);





		//edit//


		if (isset($this->request->get['nearest_place_id']) && ($this->request->server[			'REQUEST_METHOD'] != 'POST')) {


			$nearestplace_info = $this->model_property_nearest_place->getNearestPlace($this->request->get['nearest_place_id']);


		}


		$data['token'] = $this->session->data['token'];


		if (isset($this->request->post['sort_order'])){


			$data['sort_order'] = $this->request->post['sort_order'];


		}elseif (isset($nearestplace_info['sort_order'])){


			$data['sort_order'] = $nearestplace_info['sort_order'];


		}else {


			$data['sort_order'] = '';


		}


		if (isset($this->request->post['image'])){


			$data['image'] = $this->request->post['image'];


		}elseif (isset($nearestplace_info['image'])){


			$data['image'] = $nearestplace_info['image'];


		}else{


			$data['image'] = '';


		}


		if (isset($this->request->post['nearest_placename'])){


			$data['nearest_placename'] = $this->request->post['nearest_placename'];


		}elseif (isset($nearestplace_info)){


			$data['nearest_placename'] = $this->model_property_nearest_place->getNearestPlaceName($this->request->get['nearest_place_id']);


		}else{


			$data['nearest_placename'] = array();


		}


		////images///


		$this->load->model('tool/image');


			if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])){


			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);


		}elseif (!empty($nearestplace_info) && is_file(DIR_IMAGE . $nearestplace_info['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($nearestplace_info['image'], 100, 100);


		}else{


			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		}


		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		$data['header']      = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer']      = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('property/nearest_place_form', $data));





	}





	public function validateForm(){


		/*if (!$this->user->hasPermission('modify', 'property/nearest_place')){


			$this->error['warning'] = $this->language->get('error_permission');


		}*/


		foreach ($this->request->post['nearest_placename'] as $language_id => $value){


			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 64)){


				$this->error['name'][$language_id] = $this->language->get('error_name');


			}


		}


		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
			return !$this->error;


	}








	protected function validateDelete(){


		if (!$this->user->hasPermission('modify', 'property/nearest_place')){


			$this->error['warning'] = $this->language->get('error_permission');


		}


			return !$this->error;





		}


	}