<?php


class ControllerPropertyAgent extends Controller


{


	private $error = array();


	public function index(){


		$this->load->language('property/agent');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/agent');





		$this->getList();}





public function add(){


		$this->load->language('property/agent');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/agent');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){


			$this->model_property_agent->addAgent($this->request->post);


			$this->session->data['success'] = $this->language->get('text_success');


			$url = '';


		if (isset($this->request->get['sort'])){


			$url .= '&sort=' . $this->request->get['sort'];


		}


		if (isset($this->request->get['order'])){


			$url .= '&order=' . $this->request->get['order'];


		}


		if (isset($this->request->get['page'])){


			$url .= '&page=' . $this->request->get['page'];}


			$this->response->redirect($this->url->link('property/agent','token=' . $this->session->data['token'] . $url, true));


		}


			$this->getForm();


	}


	


	public function approve(){


		 $this->load->language('property/agent');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/agent');


		$approves = array();


		if (isset($this->request->post['selected'])){


			$approve = $this->request->post['selected'];


		} 


		elseif (isset($this->request->get['property_agent_id'])){


			$approves[] = $this->request->get['property_agent_id'];


		}


		if ($approves && $this->validateApprove()){


			foreach($approves as $property_agent_id){


				$this->model_property_agent->approve($property_agent_id);


			}


			$this->session->data['success'] = $this->language->get('text_success');


			$url = '';


			if (isset($this->request->get['sort'])){


				$url .= '&sort=' . $this->request->get['sort'];


			}


			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}


			if (isset($this->request->get['page'])){


				$url .= '&page=' . $this->request->get['page'];


			}


			$this->response->redirect($this->url->link('property/agent', 'token=' . $this->session->data['token'] . $url, true));


		}


		$this->getList();


		 


	 }


	


  public function edit(){


		$this->load->language('property/agent');  


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/agent');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){


			$this->model_property_agent->editAgent($this->request->get['property_agent_id'],$this->request->post);


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


			$this->response->redirect($this->url->link('property/agent', 'token=' . $this->session->data['token'] . $url, true));


			}


			$this->getForm();


			}





	public function delete(){


		$this->load->language('property/agent');


		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('property/agent');


		//change delete//


		if (isset($this->request->post['selected']) && $this->validateDelete()) 


		{


			foreach ($this->request->post['selected'] as $property_agent_id)


			{


			$this->model_property_agent->deleteAgent($property_agent_id);


			}


			$this->session->data['success'] = $this->language->get('text_successdelete');


			$url = '';


			$this->response->redirect($this->url->link('property/agent', 'token=' . $this->session->data['token'] . $url, true));


		}


		$this->getList();


		}


	private  function getList(){


		if (isset($this->request->get['filter_agentname'])) 


			{


				$filter_agentname = $this->request->get['filter_agentname'];


			} 


			else 


			{


				$filter_agentname = false;


			}


			if (isset($this->request->get['filter_status'])) 


			{


				$filter_status = $this->request->get['filter_status'];


			} 


			else 


			{


				$filter_status = false;


			}


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


				$sort = 'agentname';





			}


			if (isset($this->request->get['sort'])) 


			{


				$sort = $this->request->get['sort'];


			} 


			else 


			{


			$sort = 'sort_order';





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


			if (isset($this->request->get['filter_agentname'])) 


			{


				$url .= '&filter_agentname=' . $this->request->get['filter_agentname'];


			}


			if (isset($this->request->get['filter_status'])) 


			{


				$url .= '&filter_status=' . $this->request->get['filter_status'];


			}





			$data['heading_title'] = $this->language->get('heading_title');


			$data['text_no_results'] = $this->language->get('text_no_results');


			$data['text_confirm'] = $this->language->get('text_confirm');


			$data['column_name'] = $this->language->get('column_name');


			$data['text_enable'] = $this->language->get('text_enable');


			$data['text_disable'] = $this->language->get('text_disable');


			$data['column_images'] = $this->language->get('column_images');


			$data['column_sortorder'] = $this->language->get('column_sortorder');


			$data['column_email'] = $this->language->get('column_email');


			$data['column_status'] = $this->language->get('column_status');


			$data['column_action'] = $this->language->get('column_action');


			$data['column_sort_order'] = $this->language->get('column_sort_order');


			$data['column_approve'] = $this->language->get('column_approve');


			$data['text_list'] = $this->language->get('text_list');


			$data['button_add'] = $this->language->get('button_add');


			$data['button_edit'] = $this->language->get('button_edit');


			$data['button_delete'] = $this->language->get('button_delete');


			$data['column_agent'] = $this->language->get('column_agent');


			$data['button_filter'] = $this->language->get('button_filter');


			$data['button_approve'] = $this->language->get('button_approve');


			$data['token']         = $this->session->data['token'];


			$url = '';


			$data['breadcrumbs'] = array();


			$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home') ,


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')


			);


			$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title') ,


			'href' => $this->url->link('property/agent', 'token=' . $this->session->data['token'] . $url, 'SSL')


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


			$data['agent'] = array();


			$this->load->model('tool/image');





			$filter_data = array(


			'sort'  => $sort,


			'order' => $order,


			'filter_agentname' => $filter_agentname,


			'filter_status' => $filter_status,


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


			);


 $agent_total=$this->model_property_agent->getTotalAgent($filter_data); 


			$results = $this->model_property_agent->getAgents($filter_data);


			foreach ($results as $result) 


			{


				if (!$result['approved']) {


					$approve = $this->url->link('property/agent/approve', 'token=' . $this->session->data['token'] . '&property_agent_id=' . $result['property_agent_id'] . $url, true);


				} else {


			  	$approve = '';


				}


				


				if ($result['status']) {


					$status = $this->language->get('text_enable');


				} 


				else 


				{


					$status = $this->language->get('text_disable');


				}


			if (is_file(DIR_IMAGE . $result['image'])) 


			{


			$image = $this->model_tool_image->resize($result['image'], 40, 40);


			} 


			else 


			{


			$image = $this->model_tool_image->resize('no_image.png', 40, 40);


			}


			$data['agent'][] = array(


			'property_agent_id' => $result['property_agent_id'],


			'agentname'         => $result['agentname'],


			'email'            => $result['email'],


			'sort_order'       => $result['sort_order'],


			'image'            => $image,


			'status'           => $status,


			'approve'          =>$approve,


			'edit' => $this->url->link('property/agent/edit', 'token=' . $this->session->data['token'] . '&property_agent_id=' . $result['property_agent_id'] . $url, true)        


			);





			}


			if ($order == 'ASC') 


			{


				$url .= '&order=DESC';


			} 


			else 


			{


				$url .= '&order=ASC';


			}	


		$pagination = new Pagination();


		$pagination = new Pagination();


		$pagination->total = $agent_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('property/agent', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);


		$data['pagination'] = $pagination->render();


		$data['results'] = sprintf($this->language->get('text_pagination'), ($agent_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($agent_total - $this->config->get('config_limit_admin'))) ? $agent_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $agent_total, ceil($agent_total / $this->config->get('config_limit_admin')));





		$data['sort'] = $sort;


			$data['order'] = $order;


			$data['filter_agentname']   = $filter_agentname;


			$data['filter_status'] = $filter_status;


			$data['sort_name']  = $this->url->link('property/agent', 'token=' . $this->session->data['token'] . '&sort=agentname' . $url, true);


			


			$data['sort_image']  = $this->url->link('property/agent', 'token=' . $this->session->data['token'] . '&sort=image' . $url, true);


			


			$data['sort_email']  = $this->url->link('property/agent', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);


			$data['sort_sort_order']  = $this->url->link('property/agent', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);


			$data['add'] = $this->url->link('property/agent/add', 'token=' . $this->session->data['token'], 'SSL');





			$data['delete'] = $this->url->link('property/agent/delete', 'token=' . $this->session->data['token'], 'SSL');





			$data['header'] = $this->load->controller('common/header');


			$data['column_left'] = $this->load->controller('common/column_left');


			$data['footer'] = $this->load->controller('common/footer');


			$this->response->setOutput($this->load->view('property/agent_list', $data));


		}








	private  function getForm(){


		$data['text_form'] = !isset($this->request->get['property_info']) ? $this->language->get('text_add') : $this->language->get('text_edit');


		$data['heading_title'] = $this->language->get('heading_title');


		$data['entry_Agent'] = $this->language->get('entry_Agent');


		$data['entry_image'] = $this->language->get('entry_image');


		$data['entry_descriptions'] = $this->language->get('entry_descriptions');


		$data['entry_country'] = $this->language->get('entry_country');


		$data['entry_status'] = $this->language->get('entry_status');


		$data['text_no_results'] = $this->language->get('text_no_results');


		$data['text_enable'] = $this->language->get('text_enable');


		$data['text_disable'] = $this->language->get('text_disable');


		$data['column_name'] = $this->language->get('column_name');


		$data['column_images'] = $this->language->get('column_images');


		$data['column_sortorder'] = $this->language->get('column_sortorder');


		$data['column_email'] = $this->language->get('column_email');


		$data['column_status'] = $this->language->get('column_status');


		$data['entry_email'] = $this->language->get('entry_email');


		$data['entry_address'] = $this->language->get('entry_address');


		$data['entry_password'] = $this->language->get('entry_password');


		$data['entry_city'] = $this->language->get('entry_city');


		$data['entry_contact'] = $this->language->get('entry_contact');


		$data['entry_pincode'] = $this->language->get('entry_pincode');


		$data['entry_sort_order'] = $this->language->get('entry_sort_order');


		$data['sort_order'] = $this->language->get('sort_order');


		$data['column_action'] = $this->language->get('column_action');


		$data['text_list'] = $this->language->get('text_list');


		$data['button_add'] = $this->language->get('button_add');


		$data['entry_positions'] = $this->language->get('entry_positions');


		


		$data['button_edit'] = $this->language->get('button_edit');


		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');


		$url = '';


		$data['breadcrumbs'] = array();


		$data['breadcrumbs'][] = array(


				'text' => $this->language->get('text_home') ,


				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')


		);


		$data['breadcrumbs'][] = array(


				'text' => $this->language->get('heading_title') ,


				'href' => $this->url->link('property/agent', 'token=' . $this->session->data['token'] . $url, 'SSL')


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


		/////edit qouery /////


		if (isset($this->request->get['property_agent_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) 


		{


		$form_info = $this->model_property_agent->getAgent($this->request->get['property_agent_id']);


		}


		$data['token'] = $this->session->data['token'];		


		//////// edit form ////////////////////


		if(isset($this->request->post['agentname']))


		{


		$data['agentname']=$this->request->post['agentname'];


		}


		else if(isset($form_info['agentname']))


		{


		$data['agentname']=$form_info['agentname'];


		}


		else


		{


		$data['agentname']='';


		}





		if(isset($this->request->post['image']))


		{


		$data['image']=$this->request->post['image'];


		}


		else if(isset($form_info['image']))


		{


		$data['image']=$form_info['image'];


		}


		else


		{


		$data['image']='';


		}


		if(isset($this->request->post['country']))


		{


			$data['country']=$this->request->post['country'];


		}


		else if(isset($form_info['country']))


		{


			$data['country']=$form_info['country'];


		}


		else


		{


			$data['country']='';


		}


		if(isset($this->request->post['email']))


		{


			$data['email']=$this->request->post['email'];


		}


		else if(isset($form_info['email']))


		{


			$data['email']=$form_info['email'];


		}


		else


		{


			$data['email']='';


		}


		if(isset($this->request->post['address']))


		{


			$data['address']=$this->request->post['address'];


		}


		else if(isset($form_info['address']))


		{


			$data['address']=$form_info['address'];


		}


		else


		{


		$data['address']='';


		}


		if(isset($this->request->post['city']))


		{


		$data['city']=$this->request->post['city'];


		}


		else if(isset($form_info['city']))


		{


		$data['city']=$form_info['city'];


		}


		else


		{


		$data['city']='';


		}


		


		if(isset($this->request->post['description']))


		{


		$data['description']=$this->request->post['description'];


		}


		else if(isset($form_info['description']))


		{


		$data['description']=$form_info['description'];


		}


		else


		{


		$data['description']='';


		}


		


		if(isset($this->request->post['positions']))


		{


		$data['positions']=$this->request->post['positions'];


		}


		else if(isset($form_info['positions']))


		{


		$data['positions']=$form_info['positions'];


		}


		else


		{


		$data['positions']='';


		}


		


		


		


		


		if(isset($this->request->post['contact']))


		{


		$data['contact']=$this->request->post['contact'];


		}


		else if(isset($form_info['contact']))


		{


		$data['contact']=$form_info['contact'];


		}


		else


		{


		$data['contact']='';


		}


		if(isset($this->request->post['pincode']))


		{


		$data['pincode']=$this->request->post['pincode'];


		}


		else if(isset($form_info['pincode']))


		{


		$data['pincode']=$form_info['pincode'];


		}


		else


		{


		$data['pincode']='';


		}


		if(isset($this->request->post['country']))


		{


			$data['country']=$this->request->post['country'];


		}


		else if(isset($form_info['country']))


		{


			$data['country']=$form_info['country'];


		}


		else


		{


			$data['country']='';


		}


		if(isset($this->request->post['status']))


		{


		$data['status']=$this->request->post['status'];


		}


		else if(isset($form_info['status']))


		{


		$data['status']=$form_info['status'];


		}


		else


		{


		$data['status']='';


		}


		if(isset($this->request->post['sort_order']))


		{


			$data['sort_order']=$this->request->post['sort_order'];


		}


		else if(isset($form_info['sort_order']))


		{


			$data['sort_order']=$form_info['sort_order'];


		}


		else


		{


			$data['sort_order']='';


		}


		////////////////////////  country////////////


		$this->load->model('localisation/country');


		$data['countries'] = $this->model_localisation_country->getCountries(array());


		/////////////////////// country


   if (!isset($this->request->get['property_agent_id'])) 


		{


		$data['action'] = $this->url->link('property/agent/add', 'token=' . $this->session->data['token'] . $url, true);


		} 


		else{


			$data['action'] = $this->url->link('property/agent/edit', 'token=' . $this->session->data['token'] . '&property_agent_id=' . $this->request->get['property_agent_id'] . $url, true);


			}


			$data['cancel'] = $this->url->link('property/agent', 'token=' . $this->session->data['token'] . $url, true);


   		if(isset($this->error['agentname'])) 


				{


				$data['error_agentname'] = $this->error['agentname'];


				} 


				else 


				{


				$data['error_agentname'] = '';


				}


				if (isset($this->error['email']))


				{


				$data['error_email'] = $this->error['email'];


				} 


				else 


				{


				$data['error_email'] = '';


				}


				if(isset($this->error['address'])) 


				{


				$data['error_address'] = $this->error['address'];


				} 	


				else 


				{


				$data['error_address'] = '';


				}


				if(isset($this->error['city'])) 


				{


				$data['error_city'] = $this->error['city'];


				} 	


				else 


				{


				$data['error_city'] = '';


				}


				if(isset($this->error['pincode'])) 


				{


				$data['error_pincode'] = $this->error['pincode'];


				} 	


				else 


				{


				$data['error_pincode'] = '';


				}





				if(isset($this->error['Sort order']))


				{


				$data['error_Sort order'] = $this->error['Sort order'];


				} 	


				else 


				{


				$data['error_Sort_order'] = '';


				}


			////images///


				$this->load->model('tool/image');


				if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) 


				{


				$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);


				} 


				elseif (!empty($form_info) && is_file(DIR_IMAGE . $form_info['image'])) 


				{


				$data['thumb'] = $this->model_tool_image->resize($form_info['image'], 100, 100);


				} 


				else 


				{


				$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


				}


				$data['header'] = $this->load->controller('common/header');


				$data['column_left'] = $this->load->controller('common/column_left');


				$data['footer'] = $this->load->controller('common/footer');





				$this->response->setOutput($this->load->view('property/agent_form', $data));





				}


	protected function validateForm() 


		{


		if (!$this->user->hasPermission('modify', 'property/agent')) {


		$this->error['warning'] = $this->language->get('error_permission');


		}





			if ((utf8_strlen($this->request->post['agentname'])< 3)||(utf8_strlen($this->		request->post['agentname']) > 255)) 


		{


			$this->error['agentname']= $this->language->get('error_agentname');


		}


			if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) 


		{


			$this->error['email'] = $this->language->get('error_email');


		}


			return !$this->error;


		}


	


	protected function validateApprove()


	{


		if (!$this->user->hasPermission('modify', 'property/agent')) {


			$this->error['warning'] = $this->language->get('error_permission');


	}


	    return !$this->error;


	}


		public function autocomplete() 





		{


		$json = array();





		if (isset($this->request->get['filter_name'])) 


		{


		$this->load->model('property/agent');





		$filter_data = array(


		'filter_name' => $this->request->get['filter_name'],


		'sort'        => 'agentname',


		'order'       => 'ASC',


		'start'       => 0,


		'limit'       => 5


		);





		$results = $this->model_property_agent->getAgents($filter_data);


		


		foreach ($results as $result) 


		{





		$json[] = array(


		'property_agent_id' => $result['property_agent_id'],


		'agentname'        => strip_tags(html_entity_decode($result['agentname'], ENT_QUOTES, 'UTF-8'))


		);


	 }


	}


	$sort_order = array();


		foreach ($json as $key => $value) 


		{


		$sort_order[$key] = $value['agentname'];


		}


		array_multisort($sort_order, SORT_ASC, $json);





		$this->response->addHeader('Content-Type: application/json');


		$this->response->setOutput(json_encode($json));


		}


				////   validateDelete  ////





		protected function validateDelete() 


		{


			if (!$this->user->hasPermission('modify', 'property/agent'))


		{


			$this->error['warning'] = $this->language->get('error_permission');


		}


		return !$this->error;


		}		





		}


		?>


