<?php
class ControllerPropertyEnquiry extends Controller
{
  private $error = array();
	public function index(){
		$this->load->language('property/enquiry');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('property/enquiry');
		$this->getList();
	}
  public function add(){

		$this->load->language('property/enquiry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('property/enquiry');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){

			$this->model_property_enquiry->addEnquiry($this->request->post);

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



			$this->response->redirect($this->url->link('property/enquiry','token=' . $this->session->data['token'] . $url, true));



		}



		$this->getForm();



  }



	



	public function delete(){



		$this->load->language('property/enquiry');



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('property/enquiry');



		if (isset($this->request->post['selected']) && $this->validateDelete()){



		foreach ($this->request->post['selected'] as $enquiry_id){



			$this->model_property_enquiry->deleteEnquiry($enquiry_id);



		}



		$this->session->data['success'] = $this->language->get('text_successdelete');



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



			$this->response->redirect($this->url->link('property/enquiry','token=' . $this->session->data['token'] . $url, true));



		}



		$this->getList();



	}







///// editform //////







	public function edit(){



		$this->load->language('property/enquiry');  



		$this->document->setTitle($this->language->get('heading_title'));



		$this->load->model('property/enquiry');



		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){



			$this->model_property_enquiry->editEnquiry($this->request->get['enquiry_id'],$this->request->post);



		$this->session->data['success'] = $this->language->get('text_successedit');



		$url = '';



		if (isset($this->request->get['sort']))	{



			$url .= '&sort=' . $this->request->get['sort'];



		}



		if (isset($this->request->get['order'])){



		$url .= '&order=' . $this->request->get['order'];



		}



		if (isset($this->request->get['page']))	{



			$url .= '&page=' . $this->request->get['page'];



		}







			$this->response->redirect($this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . $url, true));



		}



		$this->getForm();



  }







	private  function getList(){



		$url = '';



		if (isset($this->request->get['sort'])) {



			$url .= '&sort=' . $this->request->get['sort'];



		}



		if (isset($this->request->get['order'])) {



			$url .= '&order=' . $this->request->get['order'];



		}



		if (isset($this->request->get['page'])){



			$url .= '&page=' . $this->request->get['page'];



		}



		if (isset($this->request->get['sort'])){



			$sort = $this->request->get['sort'];



		}else{



			$sort = 'name';



		}if (isset($this->request->get['sort'])){







		$sort = $this->request->get['sort'];



		}else {



			$sort = 'property_id';



		}



		if (isset($this->request->get['sort'])){



			$sort = $this->request->get['sort'];



		}else{



			$sort = 'email';



		}







		if (isset($this->request->get['order'])){



			$order = $this->request->get['order'];



		}else {



			$order = 'ASC';



		}



		if (isset($this->request->get['page'])) {



			$page = $this->request->get['page'];



		}else{



			$page = 1;



		}



		$data['heading_title']      = $this->language->get('heading_title');

		$data['text_no_results']    = $this->language->get('text_no_results');
		$data['text_none']          = $this->language->get('text_none');
		$data['text_confirm']       = $this->language->get('text_confirm');
		$data['text_enable']        = $this->language->get('text_enable');
		$data['text_disable']       = $this->language->get('text_disable');
		$data['text_list']          = $this->language->get('text_list');

		$data['column_property']    = $this->language->get('column_property');
		$data['column_name']        = $this->language->get('column_name');
		$data['column_agentname']   = $this->language->get('column_agentname');
		$data['column_email']       = $this->language->get('column_email');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_action']      = $this->language->get('column_action');
		
		$data['button_add']         = $this->language->get('button_add');
		$data['button_edit']        = $this->language->get('button_edit');
		$data['button_delete']      = $this->language->get('button_delete');
		$data['button_filter']      = $this->language->get('button_filter');
		$data['token']              = $this->session->data['token'];

		$url = '';



		$data['breadcrumbs'] = array();



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('text_home') ,



			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')



		);



		$data['breadcrumbs'][] = array(



			'text' => $this->language->get('heading_title') ,



			'href' => $this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . $url, 'SSL')



		);



		if (isset($this->error['warning'])){



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



		$data['enquiry'] = array();



		$this->load->model('tool/image');



		$this->load->model('property/property');



		$filter_data = array(



			'sort'  => $sort,



			'order' => $order,



			'start' => ($page - 1) * $this->config->get('config_limit_admin'),



			'limit' => $this->config->get('config_limit_admin')



		);



		$nquiry_total = $this->model_property_enquiry->getTotalEnquiry($filter_data);



		$results = $this->model_property_enquiry->getEnquirys($filter_data);



		



		foreach ($results as $result){



			$propertstatus_info=$this->model_property_property->getPropertyName($result['property_id']);



			if(isset($propertstatus_info['name'])){



				$property_enquery=$propertstatus_info['name'];         



			}else{



				$property_enquery='';



			}



			$agent_info=$this->model_property_enquiry->getAgent($result['property_agent_id']);
 
			if(isset($agent_info['agentname'])){

				$agentnames=$agent_info['agentname'];         

			}else{

				$agentnames='';

			}



			$data['enquiry'][] = array(



				'enquiry_id'	 	=> $result['enquiry_id'],



				'property_enquery' 	=> $property_enquery,



				'name' 				=> $result['name'],

				'agentnames' 		=> $agentnames,



				'email' 			=> $result['email'],



				'description'		=> $result['description'],



				'edit' 				=> $this->url->link('property/enquiry/edit', 'token=' . $this->session->data['token'] . '&enquiry_id=' . $result['enquiry_id'] . $url, true)        



			);



		}







		if ($order == 'ASC') {



		$url .= '&order=DESC';



		}else{



		$url .= '&order=ASC';



		}	



		$pagination = new Pagination();



		$pagination = new Pagination();



		$pagination->total = $nquiry_total;



		$pagination->page = $page;



		$pagination->limit = $this->config->get('config_limit_admin');



		$pagination->url = $this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);



		$data['pagination'] = $pagination->render();



		$data['results'] = sprintf($this->language->get('text_pagination'), ($nquiry_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($nquiry_total - $this->config->get('config_limit_admin'))) ? $nquiry_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $nquiry_total, ceil($nquiry_total / $this->config->get('config_limit_admin')));



		$data['sort'] = $sort;



		$data['order'] = $order;



		$data['sort_property_id']  = $this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . '&sort=property_id' . $url, true);



		$data['sort_name']  = $this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);



		$data['sort_email']  = $this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);



		$data['add'] = $this->url->link('property/enquiry/add', 'token=' . $this->session->data['token'], 'SSL');



		$data['delete'] = $this->url->link('property/enquiry/delete', 'token=' . $this->session->data['token'], 'SSL');



		$data['header'] = $this->load->controller('common/header');



		$data['column_left'] = $this->load->controller('common/column_left');



		$data['footer'] = $this->load->controller('common/footer');



		$this->response->setOutput($this->load->view('property/enquiry_list', $data));



 }



	private  function getForm(){
		$data['heading_title'] 		= $this->language->get('heading_title');
		$data['text_form'] 			= !isset($this->request->get['property_info']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none']			= $this->language->get('text_none');
		$data['text_no_results'] 	= $this->language->get('text_no_results');
		$data['text_enable'] 		= $this->language->get('text_enable');
		$data['text_disable'] 		= $this->language->get('text_disable');
		$data['text_list'] 			= $this->language->get('text_list');

		$data['lable_property'] 	= $this->language->get('lable_property');
		$data['lable_agent'] 		= $this->language->get('lable_agent');
		$data['lable_name'] 		= $this->language->get('lable_name');
		$data['lable_email'] 		= $this->language->get('lable_email');
		$data['lable_description'] 	= $this->language->get('lable_description');

		$data['entry_property'] 	= $this->language->get('entry_property');
		$data['entry_agent'] 		= $this->language->get('entry_agent');
		$data['entry_name'] 		= $this->language->get('entry_name');
		$data['entry_email'] 		= $this->language->get('entry_email');
		$data['entry_description'] 	= $this->language->get('entry_description');

		$data['button_add'] 		= $this->language->get('button_add');
		$data['button_edit'] 		= $this->language->get('button_edit');
		$data['button_save'] 		= $this->language->get('button_save');
		$data['button_cancel'] 		= $this->language->get('button_cancel');
		

		$url = '';



		$data['breadcrumbs'] = array();



		$data['breadcrumbs'][] = array(



		'text' => $this->language->get('text_home') ,



		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')



		);



		$data['breadcrumbs'][] = array(



		'text' => $this->language->get('heading_title') ,



		'href' => $this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . $url, 'SSL')



		);







		if (isset($this->error['warning'])){



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



		/////edit qouery /////



		if (isset($this->request->get['enquiry_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {



		$form_info = $this->model_property_enquiry->getEnquiry($this->request->get['enquiry_id']);



		}







		$data['token'] = $this->session->data['token'];	



		//////// edit form ////////////////////



		if(isset($this->request->post['name'])){



			$data['name']=$this->request->post['name'];



		}else if(isset($form_info['name'])){



			$data['name']=$form_info['name'];



		}else{



			$data['name']='';



		}



		if(isset($this->request->post['email'])){



		$data['email']=$this->request->post['email'];



		}else if(isset($form_info['email'])){



		$data['email']=$form_info['email'];



		}else{



		$data['email']='';



		}



		if(isset($this->request->post['description'])){



		$data['description']=$this->request->post['description'];



		}else if(isset($form_info['description'])){



		$data['description']=$form_info['description'];



		}else{



		$data['description']='';



		}



		



		if(isset($this->request->post['property_id'])){



		$data['property_id']=$this->request->post['property_id'];



		}



		else if(isset($form_info['property_id'])){



		$data['property_id']=$form_info['property_id'];



		}else{



		$data['property_id']='';



		}



		



		if (isset($this->request->post['property_agent_id'])){

			$data['property_agent_id'] = $this->request->post['property_agent_id'];

		}	elseif (isset($form_info['property_agent_id'])){

			$data['property_agent_id'] = $form_info['property_agent_id'];

		} else {

			$data['property_agent_id'] = '';		

		}



		$this->load->model('property/agent');

		if (isset($this->request->post['agent'])) {

		$data['agent'] = $this->request->post['agent'];

		} elseif (!empty($form_info)) {

			

		$vendor_info = $this->model_property_agent->getAgent($form_info['property_agent_id']);

		if (isset($vendor_info['agentname'])) {

		$data['agent'] = $vendor_info['agentname'];

		} else {

		$data['agent'] = '';

		}

		} else {

		$data['agent'] = '';

		}



		



	



		if(!empty($data['property_id'])){	               



		$this->load->model('property/property');



		$propertenquery_info=$this->model_property_property->getPropertyName($data['property_id']);

		if(isset($propertenquery_info['name'])){

		$data['property_enquery']=$propertenquery_info['name'];

		} else {
			$data['property_enquery']='';
		}



		}else{



		$data['property_enquery']='';



		}



		



		



		



		////////////////////////  country////////////



		$this->load->model('localisation/country');



		$data['countries'] = $this->model_localisation_country->getCountries(array());



		/////////////////////// country







		////////////////////////  country////////////



		$this->load->model('property/property');



		$data['property'] =$this->model_property_property->getPropertys(array());







		/////////////////////// country///







		if (!isset($this->request->get['enquiry_id'])){



		$data['action'] = $this->url->link('property/enquiry/add', 'token=' . $this->session->data['token'] . $url, true);



		} else {



		$data['action'] = $this->url->link('property/enquiry/edit', 'token=' . $this->session->data['token'] . '&enquiry_id=' . $this->request->get['enquiry_id'] . $url, true);



		}



		$data['cancel'] = $this->url->link('property/enquiry', 'token=' . $this->session->data['token'] . $url, true);



		if(isset($this->error['name'])) {



		$data['error_name'] = $this->error['name'];



		}else{



		$data['error_name'] = '';



		}



		if (isset($this->error['email'])){



		$data['error_email'] = $this->error['email'];



		}else{



		$data['error_email'] = '';



		}



		////images///



		$data['header'] = $this->load->controller('common/header');



		$data['column_left'] = $this->load->controller('common/column_left');



		$data['footer'] = $this->load->controller('common/footer');



		$this->response->setOutput($this->load->view('property/enquiry_form', $data));



}



	protected function validateForm(){



		if (!$this->user->hasPermission('modify', 'property/enquiry')){



			$this->error['warning'] = $this->language->get('error_permission');



		}



		if ((utf8_strlen($this->request->post['name'])< 3)||(utf8_strlen($this->request->post['name']) > 255)){



			$this->error['name']= $this->language->get('error_name');



		}



		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])){



			$this->error['email'] = $this->language->get('error_email');



		}



		return !$this->error;



	}







	protected function validateDelete(){



		if (!$this->user->hasPermission('modify', 'property/enquiry')){



		$this->error['warning'] = $this->language->get('error_permission');



		}



		return !$this->error;



	}



	



	



 }





