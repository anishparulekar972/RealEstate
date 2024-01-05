<?php


class ControllerPropertyUnits extends Controller {


	private $error = array();


	public function index() 


	{


		$this->load->language('property/units');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/units');





		$this->getList();


	}





	public function add(){


		$this->load->language('property/units');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('property/units');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){

		
			$this->model_property_units->addOrderStatus($this->request->post);


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


			$this->response->redirect($this->url->link('property/units', 'token=' . $this->session->data['token'] . $url, true));


		}


		$this->getForm();


  }





	public function edit(){


		$this->load->language('property/units');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/units');


	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){


		$this->model_property_units->editpropertystatus($this->request->get['property_unit_id'], $this->request->post);


		$this->session->data['success'] = $this->language->get('text_successedit');


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


		$this->response->redirect($this->url->link('property/units', 'token=' . $this->session->data['token'] . $url, true));


	}


	$this->getForm();


	}





	public function delete(){


		$this->load->language('property/units');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/units');


	if (isset($this->request->post['selected']) && $this->validateDelete()) 


	{


		foreach ($this->request->post['selected'] as $property_unit_id) 


		{


			$this->model_property_units->deletepropertystatus($property_unit_id);


		}





		$this->session->data['success'] = $this->language->get('text_successdelete');





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





		$this->response->redirect($this->url->link('property/units', 'token=' . $this->session->data['token'] . $url, true));


	}


	$this->getList();


	}


	protected function getList(){


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


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('text_home'),


		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)


		);


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('property/units', 'token=' . $this->session->data['token'] . $url, true)


		);


		$data['add'] = $this->url->link('property/units/add', 'token=' . $this->session->data['token'] . $url, true);


		$data['delete'] = $this->url->link('property/units/delete', 'token=' . $this->session->data['token'] . $url, true);


		$data['property_statuses'] = array();


		$filter_data = array(


		'sort'  => $sort,


		'order' => $order,


		'start' => ($page - 1) * $this->config->get('config_limit_admin'),


		'limit' => $this->config->get('config_limit_admin')


		);


//$order_status_total = $this->model_property_order_status->getTotalOrderStatuses();


		$results = $this->model_property_units->getpropertystatus($filter_data);


		foreach ($results as $result){


			$data['property_statuses'][] = array(


			'property_unit_id' => $result['property_unit_id'],


			'name'            => $result['name'] . (($result['property_unit_id'] == $this->config->get('config_property_status_id')) ? $this->language->get('text_default') : null),


			'edit'            => $this->url->link('property/units/edit', 'token=' . $this->session->data['token'] . '&property_unit_id=' . $result['property_unit_id'] . $url, true)


			);


		}


		$data['heading_title'] 	= $this->language->get('heading_title');
		$data['text_list'] 		= $this->language->get('text_list');
		$data['text_no_results']= $this->language->get('text_no_results');

		$data['text_confirm'] 	= $this->language->get('text_confirm');
		$data['column_name'] 	= $this->language->get('column_name');
		$data['column_action'] 	= $this->language->get('column_action');

		$data['button_add'] 	= $this->language->get('button_add');
		$data['button_edit'] 	= $this->language->get('button_edit');
		$data['button_delete'] 	= $this->language->get('button_delete');

		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} 


		else 


		{


			$data['error_warning'] = '';


		}





		if (isset($this->session->data['success'])) 


		{


			$data['success'] = $this->session->data['success'];





		unset($this->session->data['success']);


		} 


		else 


		{


		$data['success'] = '';


		}


		if (isset($this->request->post['selected'])) 


		{


		$data['selected'] = (array)$this->request->post['selected'];


		} 


		else 


		{


		$data['selected'] = array();


		}


		$url = '';


		if ($order == 'ASC')


		{


		$url .= '&order=DESC';


		} 


		else 


		{


		$url .= '&order=ASC';


		}


		if (isset($this->request->get['page'])) 


		{


		$url .= '&page=' . $this->request->get['page'];


		}


		$data['sort_name'] = $this->url->link('property/units', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);


		$url = '';


		if (isset($this->request->get['sort'])) 


		{


		$url .= '&sort=' . $this->request->get['sort'];


		}


		if (isset($this->request->get['order'])) 


		{


		$url .= '&order=' . $this->request->get['order'];


		}


		/*$pagination = new Pagination();


		$pagination->total = $order_status_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('property/units', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);





		$data['pagination'] = $pagination->render();





		$data['results'] = sprintf($this->language->get('text_pagination'), ($order_status_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_status_total - $this->config->get('config_limit_admin'))) ? $order_status_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_status_total, ceil($order_status_total / $this->config->get('config_limit_admin')));*/


		$data['sort'] = $sort;


		$data['order'] = $order;


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('property/units_list', $data));


  }

	protected function getForm(){
		$data['heading_title'] 	= $this->language->get('heading_title');
		$data['text_form'] 		= !isset($this->request->get['property_unit_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['lable_name'] 	= $this->language->get('lable_name');
		$data['entry_name'] 	= $this->language->get('entry_name');
		$data['button_save'] 	= $this->language->get('button_save');
		$data['button_cancel'] 	= $this->language->get('button_cancel');
	
	if (isset($this->error['warning'])) 


	{


	 $data['error_warning'] = $this->error['warning'];


	} 


	else 


	{


	 $data['error_warning'] = '';


	}


	if (isset($this->error['name'])) 


	{


	$data['error_name'] = $this->error['name'];


	} 


	else 


	{


	$data['error_name'] = array();


	}


	$url = '';


	if (isset($this->request->get['sort'])) 


	{


	$url .= '&sort=' . $this->request->get['sort'];


	}


	if (isset($this->request->get['order'])) {


	$url .= '&order=' . $this->request->get['order'];


	}


	if (isset($this->request->get['page'])) 


	{


	$url .= '&page=' . $this->request->get['page'];


	}


	$data['breadcrumbs'] = array();


	$data['breadcrumbs'][] = array(


		'text' => $this->language->get('text_home'),


		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)


	);


	$data['breadcrumbs'][] = array(


		'text' => $this->language->get('heading_title'),


		'href' => $this->url->link('property/units', 'token=' . $this->session->data['token'] . $url, true)


	);


	if (!isset($this->request->get['property_unit_id'])) 


	{


		$data['action'] = $this->url->link('property/units/add', 'token=' . $this->session->data['token'] . $url, true);


	} 


	else{


		$data['action'] = $this->url->link('property/units/edit', 'token=' . $this->session->data['token'] . '&property_unit_id=' . $this->request->get['property_unit_id'] . $url, true);


	}


	$data['cancel'] = $this->url->link('property/units', 'token=' . $this->session->data['token'] . $url, true);





	$this->load->model('localisation/language');


	$data['languages'] = $this->model_localisation_language->getLanguages();


	if (isset($this->request->post['property_unit'])) {


		$data['property_unit'] = $this->request->post['property_unit'];


	} 


	elseif (isset($this->request->get['property_unit_id'])) 


	{


		$data['property_unit'] = $this->model_property_units->getpropertystatusDescriptions($this->request->get['property_unit_id']);


	} 


	else 


	{


		$data['property_unit'] = array();


	}


	$data['header'] = $this->load->controller('common/header');


	$data['column_left'] = $this->load->controller('common/column_left');


	$data['footer'] = $this->load->controller('common/footer');





	$this->response->setOutput($this->load->view('property/units_form', $data));


}





	protected function validateForm(){


		if (!$this->user->hasPermission('modify', 'property/units')) 


		{


			$this->error['warning'] = $this->language->get('error_permission');


		}





		foreach ($this->request->post['property_unit'] as $language_id => $value) 


		{


			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 32)) 


			{


			$this->error['name'][$language_id] = $this->language->get('error_name');


			}


		}


			return !$this->error;


	}





	protected function validateDelete(){


		if (!$this->user->hasPermission('modify', 'property/units')){


			$this->error['warning'] = $this->language->get('error_permission');


		}


			$this->load->model('setting/store');


		





	foreach ($this->request->post['selected'] as $property_unit_id){


		if ($this->config->get('config_property_status_id') == $property_unit_id) 


		{


			$this->error['warning'] = $this->language->get('error_default');


		}


		if ($this->config->get('config_download_status_id') == $property_unit_id) 


		{


			$this->error['warning'] = $this->language->get('error_download');


		}


		$store_total = $this->model_setting_store->getTotalStoresByOrderStatusId($property_unit_id);





		if ($store_total) 


		{


			$this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);


		}



	}


		return !$this->error;


}





	public function autocomplete(){

	$this->load->language('property/units');

	if (isset($this->request->get['filter_name'])){


		if (isset($this->request->get['sort'])) 


		{


			$sort = $this->request->get['sort'];


		} 


		else


		{


			$sort = 'name';


		}





		if (isset($this->request->get['order'])) 


		{


			$order = $this->request->get['order'];


		} 


		else


		{


			$order = 'ASC';


		}





		if (isset($this->request->get['page'])) 


		{


			$page = $this->request->get['page'];


		} 


		else 


		{


		$page = 1;


		}


		$this->load->model('property/units');


		$filter_data = array(


		'filter_name'=> $this->request->get['filter_name'],


		'order' => $order,


		'sort' => $sort,


		'start' => ($page - 1) * $this->config->get('config_limit_admin'),


		'limit' => $this->config->get('config_limit_admin')


		);


		$results = $this->model_property_units->getpropertystatusouto($filter_data);


		foreach ($results as $result) {


		$json[] = array(


		'property_unit_id' => $result['property_unit_id'],


		'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))


		);


		}


	}


		$sort_order = array();


		foreach ($json as $key => $value) 


		{


			$sort_order[$key] = $value['name'];


		}


		array_multisort($sort_order, SORT_ASC, $json);


		$this->response->addHeader('Content-Type: application/json');


		$this->response->setOutput(json_encode($json));


	}





}


