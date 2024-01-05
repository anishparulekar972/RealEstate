<?php


class ControllerPropertyPropertyType extends Controller{


	private $error = array();


	public function index(){


		$this->load->language('property/property_type');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/property_type');


		$this->getList();


	}


	


	public function add(){


		$this->load->language('property/property_type');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/property_type');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){ 


			$this->model_property_property_type->addPropertyType($this->request->post);


			$this->session->data['success'] = $this->language->get('text_success');


			$url = '';


			if (isset($this->request->get['sort'])) 


			{


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


			$this->response->redirect($this->url->link('property/property_type', 'token=' . $this->session->data['token'] . $url, true));





		}


	$this->getform();


}


	public function edit(){


		$this->load->language('property/property_type');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/property_type');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){


		$this->model_property_property_type->editPropertyType($this->request->get['property_type_id'],$this->request->post);


		$this->session->data['success'] = $this->language->get('text_successedit');


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


		$this->response->redirect($this->url->link('property/property_type', 'token=' . $this->session->data['token'] . $url, true));


	}


		$this->getform();


 }





	public function delete(){


		$this->load->language('property/property_type');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/property_type');


		if (isset($this->request->post['selected']) && $this->validateDelete())


		{


		foreach ($this->request->post['selected'] as $property_type_id) 


		{


			$this->model_property_property_type->DeleteProperty($property_type_id);


		}


		$this->session->data['success'] = $this->language->get('text_successdelete');


		$url = '';


		if (isset($this->request->get['sort'])) 


		{


		$url .= '&sort=' . $this->request->get['sort'];


		}


		if (isset($this->request->get['order'])) {


		$url .= '&order=' . $this->request->get['order'];


		}


		if (isset($this->request->get['page'])) {


		$url .= '&page=' . $this->request->get['page'];


		}


		$this->response->redirect($this->url->link('property/property_type', 'token=' . $this->session->data['token'] . $url, true));


		}


		$this->getList();


	}





	public function getList(){ 


	$url = '';


		if (isset($this->request->get['sort'])) 


		{


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


		if (isset($this->request->get['sort'])) 


		{


			$sort = $this->request->get['sort'];


		} 


		else 


		{


			$sort = 'name';


		}


		if (isset($this->request->get['sort'])) 


		{





			$sort = $this->request->get['sort'];


		} 


		else 


		{


			$sort = 'property_id';


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


		$data['heading_title']  = $this->language->get('heading_title');


		$data['text_no_results']      = $this->language->get('text_no_results');


		$data['text_form']      = $this->language->get('text_form');


		$data['text_list']      = $this->language->get('text_list');


		$data['column_title']   = $this->language->get('column_title');


		$data['column_Order']   = $this->language->get('column_Order');


		$data['column_status']  = $this->language->get('column_status');


		$data['column_product'] = $this->language->get('column_product');


		$data['entry_property'] = $this->language->get('entry_property');


		$data['column_action']  = $this->language->get('column_action');


		$data['column_image']   = $this->language->get('column_image');


		$data['column_name']   = $this->language->get('column_name');


		$data['column_sort_order']   = $this->language->get('column_sort_order');


		$data['button_add']         = $this->language->get('button_add');


		$data['button_cancle']      = $this->language->get('button_cancle');


		$data['button_delete']      = $this->language->get('button_delete');


		$data['button_']            = $this->language->get('button_delete');


		$data['button_edit']        = $this->language->get('button_edit');


		$data['button_view']        = $this->language->get('button_view');


		$data['column_description'] = $this->language->get('column_description');


		$data['column_price']       = $this->language->get('column_price');


		$data['column_sort_order']  = $this->language->get('column_sort_order');


		$data['text_enable']        = $this->language->get('enable');


		$data['text_disable']       = $this->language->get('disable');


		$data['text_confirm']  = $this->language->get('text_confirm');


		$data['button_filter'] = $this->language->get('button_filter');


		$data['token']         = $this->session->data['token'];


		$data['pagination'] = '';


		$data['results'] = '';


		//// variable define


		if (isset($this->request->post['selected'])) 


		{


			$data['selected'] = (array) $this->request->post['selected'];


		} 


		else


		{


		$data['selected'] = array();


		}


		$data['breadcrumbs'] = array();


		$url = '';





		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('text_home'),


		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data[	'token'], true)


		);


		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('property/property_type', 'token=' . $this->session->data['token'] . $url, true)


		);


		////////select for list///////


		$data['results'] = '';


		if (isset($this->error['warning'])) 


		{


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


			$data['selected'] = (array) $this->request->post['selected'];


		} 


		else 


		{


			$data['selected'] = array();


		}


		//action button


		$data['add']    = $this->url->link('property/property_type/add', '&token=' . $this->session->data['token'] . $url, true);


		$data['delete'] = $this->url->link('property/property_type/delete', '&token=' . $this->session->data['token'] . $url, true);


///list/////


		$data['propert']=array();


		$filter_data = array(


			'sort'  => $sort,


			'order' => $order,


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


		);


		$propertytype_total=$this->model_property_property_type->getTotalPropertyType($filter_data);


	





		$results=$this->model_property_property_type->getPropertyTypes($data);





		foreach($results as $result)


		{


			if ($result['status']) 


			{


				$status = $this->language->get('text_enable');


			} 


			else 


			{


				$status = $this->language->get('text_disable');


			}


			$data['propert'][]=array(


				'property_type_id'=>$result['property_type_id'],


				'name'=>$result['name'],


				'sort_order'=>$result['sort_order'],


				'status'=>$status,


				'edit'=> $this->url->link('property/property_type/edit', 'token=' . $this->session->data['token'] . '&property_type_id=' .$result['property_type_id'] . $url, true)


			);


		}	


		$pagination = new Pagination();


		$pagination = new Pagination();


		$pagination->total = $propertytype_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('property/property_type', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);


		$data['pagination'] = $pagination->render();


		$data['results'] = sprintf($this->language->get('text_pagination'), ($propertytype_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($propertytype_total - $this->config->get('config_limit_admin'))) ? $propertytype_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $propertytype_total, ceil($propertytype_total / $this->config->get('config_limit_admin')));


		


		


		


		$data['header']      = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer']      = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('property/property_type_list', $data));


	}


	public function getform(){


		$data['heading_title']       = $this->language->get('heading_title');


		$data['text_form']           = $this->language->get('text_form');


		$data['text_list']           = $this->language->get('text_list');


		$data['tab_general']         = $this->language->get('tab_general');


		$data['tab_data']            = $this->language->get('tab_data');


		$data['entry_description']   = $this->language->get('entry_description');


		$data['entry_name']          = $this->language->get('entry_name');


		$data['entry_sort_order']    = $this->language->get('entry_sort_order');


		$data['entry_status']        = $this->language->get('entry_status');


		$data['entry_property_name'] = $this->language->get('entry_property_name');


		$data['button_remove']       = $this->language->get('button_remove');


		$data['button_add']          = $this->language->get('button_add');


		$data['column_action']  = $this->language->get('column_action');


		$data['entry_products']   = $this->language->get('entry_products');


		$data['entry_image']        = $this->language->get('entry_image');


		$data['entry_title']                = $this->language->get('entry_title');


		$data['entry_SEO_URL']                = $this->language->get('entry_SEO_URL');


		$data['entry_property']             = $this->language->get('entry_property');


		$data['entry_Description_property'] = $this->language->get('entry_Description_property');


		$data['text_enable']   = $this->language->get('enable');


		$data['text_disable']  = $this->language->get('disable');


		$data['button_save']   = $this->language->get('button_save');


		$data['button_delete'] = $this->language->get('button_delete');


		$data['button_cancel'] = $this->language->get('button_cancel');


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


		$data['breadcrumbs'][] = array(


		'text' => $this->language->get('heading_title'),


		'href' => $this->url->link('property/property_type', 'token=' . $this->session->data['token'] . $url, true)


		);


		////////////////////////  language


		$this->load->model('localisation/language');


		$data['languages'] = $this->model_localisation_language->getLanguages();


		/////////////////////// language


		if (isset($this->request->post['selected'])) 


		{


			$data['selected'] = (array) $this->request->post['selected'];


		} 


		else 


		{


			$data['selected'] = array();


		}


		if (isset($this->error['name'])) 


		{


			$data['error_name'] = $this->error['name'];


		} 


		else 


		{


			$data['error_name'] = '';


		}


		if (isset($this->error['description'])) 


		{


			$data['error_desription'] = $this->error['description'];


		} 


		else 


		{


			$data['error_desription'] = '';





		}


		if (isset($this->error['sort_order'])) 


		{


			$data['error_sortorder'] = $this->error['sort_order'];


		} 


		else 


		{


			$data['error_sortorder'] = '';





		}


		if (isset($this->error['status']))


		{


			$data['error_status'] = $this->error['status'];


		} 


		else 


		{


			$data['error_status'] = '';


		}


		if (!isset($this->request->get['property_type_id']))


		{


			$data['action'] = $this->url->link('property/property_type/add', 'token=' . $this->session->data['token'] . $url, true);


		} 


		else


		{


			$data['action'] = $this->url->link('property/property_type/edit', 'token=' . $this->session->data['token'] . '&property_type_id=' . $this->request->get['property_type_id'] . $url, true);


		}


		$data['cancel'] = $this->url->link('property/property_type', 'token=' . $this->session->data['token'] . $url, true);


		//edit//


		if (isset($this->request->get['property_type_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) 


		{


			$property_info = $this->model_property_property_type->getPropertyType($this->request->get['property_type_id']);


		}





		$data['token'] = $this->session->data['token'];








		if (isset($this->request->post['sort_order'])) 


		{


			$data['sort_order'] = $this->request->post['sort_order'];


		}	 


		elseif (isset($property_info['sort_order']))


		{


			$data['sort_order'] = $property_info['sort_order'];


		} 


		else 


		{


			$data['sort_order'] = '';


		}


		if (isset($this->request->post['Property_description'])) 


		{


			$data['Property_description'] = $this->request->post['Property_description'];


		} 		


		elseif (isset($property_info)) 


		{


			$data['Property_description'] = $this->model_property_property_type->getTypeDescription($this->request->get['property_type_id']);


		} 


		else 


		{


			$data['Property_description'] = array();


		}


		$data['header']      = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer']      = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('property/property_type_form', $data));


	}





	public function validateForm(){


		if (!$this->user->hasPermission('modify', 'property/property_type')) 


		{


			$this->error['warning'] = $this->language->get('error_permission');


		}


		foreach ($this->request->post['Property_description'] as $language_id => $value){


			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 64))


			{


				$this->error['name'][$language_id] = $this->language->get('error_name');


			}





			if ((utf8_strlen($value['description']) < 3) || (utf8_strlen($value['description']) > 64)) 


			{


				$this->error['description'][$language_id] = $this->language->get('error_desription');


			}	


		}


			return !$this->error;


	}


	


	protected function validateDelete() 


		{


		if (!$this->user->hasPermission('modify', 'property/property_type')) 


		{


			$this->error['warning'] = $this->language->get('error_permission');


		}


		return !$this->error;





		}


	}