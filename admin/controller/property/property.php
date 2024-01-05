<?php
class ControllerPropertyProperty extends Controller {
	private $error = array();
	public function index(){
		$this->load->language('property/property');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('property/property');
		$this->getList();
	}
	public function add(){
		$this->load->language('property/property');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('property/property');
		
		if (($this->request->server['REQUEST_METHOD']=='POST') && $this->validateForm()){ 
			$this->model_property_property->addProperty($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
		    $url = '';
			if (isset($this->request->get['sort'])){
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])){
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])) {

				$url .= '&page=' . $this->request->get['page'];

			}

				$this->response->redirect($this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true));

		}

		$this->getform();

	}

	public function approve(){
		$this->load->language('property/property');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('property/property');
		$approves = array();
		if (isset($this->request->post['selected'])){

			$approve = $this->request->post['selected'];

		} 

		elseif (isset($this->request->get['property_id'])){

			$approves[] = $this->request->get['property_id'];

		}

		if ($approves && $this->validateApprove()){

			foreach($approves as $property_id){

				$this->model_property_property->approve($property_id);

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

			$this->response->redirect($this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true));

		}

		$this->getList();

	}



	 public function disapprove(){

		$this->load->language('property/property');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('property/property');



		$approves = array();

		if (isset($this->request->post['selected'])){

			$approve = $this->request->post['selected'];

		} 

		elseif (isset($this->request->get['property_id'])){

			$approves[] = $this->request->get['property_id'];

		}

		if ($approves && $this->validateDesapprove()){

			foreach($approves as $property_id){

				$this->model_property_property->Disapprove($property_id);

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

			$this->response->redirect($this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true));

		}

		$this->getList(); 



	 }





	public function edit(){

		$this->load->language('property/property');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('property/property');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()){
			//echo "<pre>";
			//print_r($this->request->post); die();
			
			$this->model_property_property->editProperty($this->request->get['property_id'],$this->request->post);

			$this->session->data['success'] = $this->language->get('text_successedit');

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

			$this->response->redirect($this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true));

		}

		$this->getform();

	}

	public function delete(){

		$this->load->language('property/property');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('property/property');

		if (isset($this->request->post['selected']) && $this->validateDelete()){

		foreach ($this->request->post['selected'] as $property_id){

			$this->model_property_property->deleteProperty($property_id);

		}

			$this->session->data['success'] = $this->language->get('text_successdelete');

			$url = '';

			if (isset($this->request->get['sort'])) {

				$url .= '&sort=' . $this->request->get['sort'];

			}



			if (isset($this->request->get['order'])){

				$url .= '&order=' . $this->request->get['order'];

			}



			if (isset($this->request->get['page'])) {

				$url .= '&page=' . $this->request->get['page'];

			}

			$this->response->redirect($this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true));

		}

		$this->getList();

	}

	public function getList(){ 

		if (isset($this->request->get['filter_name'])){

			$filter_name = $this->request->get['filter_name'];

		} else {

			$filter_name = false;

		}

		

		if (isset($this->request->get['filter_propertystatus'])){

			$filter_propertystatus = $this->request->get['filter_propertystatus'];

		} else { 

			$filter_propertystatus = false;

		}

		

		if (isset($this->request->get['filter_agent'])){

			$filter_agent = $this->request->get['filter_agent'];

		} else {

			$filter_agent = false;

		}

		

		if (!empty($this->request->get['filter_price_from'])){

			$filter_price_from = $this->request->get['filter_price_from'];

		} else {$filter_price_from = false;

		}

		

		if (!empty($this->request->get['filter_price_to'])){

			$filter_price_to = $this->request->get['filter_price_to'];

		} else {

			$filter_price_to = false;

		}

		

		if (isset($this->request->get['filter_status'])) {

			$filter_status = $this->request->get['filter_status'];

		} else {

			$filter_status = false;

		} 

		$url = '';
		
				if (isset($this->request->get['sort'])){



			$url .= '&sort=' . $this->request->get['sort'];



		}



		if (isset($this->request->get['order'])){



		$url .= '&order=' . $this->request->get['order'];



		}
		

		if (isset($this->request->get['sort'])){

			$sort = $this->request->get['sort'];

		} else {

			$sort = 'ppd.name';

		}

		if (isset($this->request->get['sort'])) {

			$sort = $this->request->get['sort'];

		} else {

			$sort = 'p.property_status_id';

		}

		

		if (isset($this->request->get['sort'])){

			$sort = $this->request->get['sort'];

		} else {

			$sort = 'p.price';

		}


		if (isset($this->request->get['sort'])){



			$sort = $this->request->get['sort'];



		}else{



			$sort = 'p.property_id ';



		}

		if (isset($this->request->get['order'])) {

			$order = $this->request->get['order'];

		} else {

			$order = 'DESC';

		}

		

		if (isset($this->request->get['page'])) {

			$page = $this->request->get['page'];

		} else {

			$page = 1;

		}

		

		$url = '';

		if (isset($this->request->get['filter_name'])) {

			$url .= '&filter_name=' . $this->request->get['filter_name'];

		}

		

		if (isset($this->request->get['filter_propertystatus'])){

			$url .= '&filter_propertystatus=' .$this->request->get['filter_propertystatus'];

		}

		

		if (isset($this->request->get['filter_agent'])){

			$url .= '&filter_agent=' .$this->request->get['filter_agent'];

		}

		

		if (isset($this->request->get['filter_status'])){

			$url .= '&filter_status=' .$this->request->get['filter_status'];

		}

		

		if (isset($this->request->get['filter_price_from'])) {

			$url .= '&filter_price_from=' .$this->request->get['filter_price_from'];

		}

		

		if (isset($this->request->get['filter_price_to'])){

			$url .= '&filter_price_to=' .$this->request->get['filter_price_to'];

		}

		

		

		$data['heading_title']  			= $this->language->get('heading_title');
		$data['text_none']  				= $this->language->get('text_none');
		$data['tab_customfield']  			= $this->language->get('tab_customfield');
		$data['text_form']      			= $this->language->get('text_form');
		$data['text_list']      			= $this->language->get('text_list');
		$data['text_no_results']      		= $this->language->get('text_no_results');
		$data['text_enable']               	= $this->language->get('Enable');
		$data['text_disable']              	= $this->language->get('Disable');
		$data['text_confirm']  				= $this->language->get('text_confirm');
		$data['text_loading']  				= $this->language->get('text_loading');
		$data['text_select']       			= $this->language->get('text_select');

		$data['filterlablel_name']          = $this->language->get('filterlablel_name');
		$data['filterlablel_property_status']= $this->language->get('filterlablel_property_status');
		$data['filterlablel_price']         = $this->language->get('filterlablel_price');
		$data['filterlablel_status']  	    = $this->language->get('filterlablel_status');
		$data['filterlablel_price_range']   = $this->language->get('filterlablel_price_range');
		$data['filterlablel_price_from'] 	= $this->language->get('filterlablel_price_from');
		$data['filterlablel_agent'] 		= $this->language->get('filterlablel_agent');

		$data['column_status']  			= $this->language->get('column_status');
		$data['column_price_from'] 			= $this->language->get('column_price_from');
		$data['column_property_status']  	= $this->language->get('column_property_status');
		$data['column_agent'] 			    = $this->language->get('column_agent');
		$data['column_price_range']         = $this->language->get('column_price_range');
		$data['column_approved'] 			= $this->language->get('column_approved');
		$data['column_action']              = $this->language->get('column_action');
		$data['column_image']  			    = $this->language->get('column_image');
		$data['column_name']                = $this->language->get('column_name');
		$data['column_sort_order']          = $this->language->get('column_sort_order');
		$data['column_price']              	= $this->language->get('column_price');

		
		$data['button_add']                 = $this->language->get('button_add');
		$data['button_cancle']              = $this->language->get('button_cancle');
		$data['button_delete']              = $this->language->get('button_delete');
		$data['button_edit']               	= $this->language->get('button_edit');
		$data['button_view']               	= $this->language->get('button_view');
		$data['button_filter'] 				= $this->language->get('button_filter');
		$data['button_approve'] 			= $this->language->get('button_approve');
		$data['button_desapprove'] 			= $this->language->get('button_desapprove');
		$data['button_edit']       			= $this->language->get('button_edit');
		$data['token']         				= $this->session->data['token'];

	

		//// variable define

		if (isset($this->request->post['selected'])){

			$data['selected'] = (array) $this->request->post['selected'];

		} else {

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

			'href' => $this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true)

		);

		////////select for list///////

		$data['results'] = '';

		if (isset($this->error['warning'])){

			$data['error_warning'] = $this->error['warning'];

		} else {

			$data['error_warning'] = '';

		}

		

		if (isset($this->session->data['success'])){

		$data['success'] = $this->session->data['success'];

		unset($this->session->data['success']);

		} else {

			$data['success'] = '';

		}

		

		if (isset($this->request->post['selected'])){

			$data['selected'] = (array) $this->request->post['selected'];

		} else {

			$data['selected'] = array();

		}

		

		//action button

		$data['add']    = $this->url->link('property/property/add', '&token=' . $this->session->data['token'] . $url, true);

		$data['delete'] = $this->url->link('property/property/delete', '&token=' . $this->session->data['token'] . $url, true);

		///list/////

		$data['propert']=array();

		$filter_data = array(

			'sort' 			 		=> $sort,

			'order' 				=> $order,

			'filter_name' 			=> $filter_name,

			'filter_price_from' 	=> $filter_price_from,

			'filter_price_to' 		=> $filter_price_to,

			'filter_propertystatus' =>$filter_propertystatus,

			'filter_agent'          =>$filter_agent,

			'filter_status' 		=> $filter_status,

			'start' => ($page - 1) * $this->config->get('config_limit_admin'),

			'limit' => $this->config->get('config_limit_admin')

		);	

		$this->load->model('tool/image');

		$this->load->model('property/property_status');

		$data['propert']=array();

		$propert_total = $this->model_property_property->getTotalProperty($filter_data);

		$results=$this->model_property_property->getPropertys($filter_data);

		foreach($results as $result){
			$agent_info = $this->model_property_property->getAgent($result['property_agent_id']);
			if(isset($agent_info['agentname'])) {
				$agentname = $agent_info['agentname'];
			} else {
				$agentname ='';
			}
			if (!$result['approved']) {

				$approve = $this->url->link('property/property/approve', 'token=' . $this->session->data['token'] . '&property_id=' . $result['property_id'] . $url, true);

			} else {

				$approve = '';

			}



			if ($result['approved']) {

				$disapproved = $this->url->link('property/property/disapprove', 'token=' . $this->session->data['token'] . '&property_id=' . $result['property_id'] . $url, true);

			} else {

				$disapproved = '';

			}



			if ($result['status']){

				$status = $this->language->get('text_enable');

			} else {

				$status = $this->language->get('text_disable');

			}

			if (is_file(DIR_IMAGE . $result['image'])){

				$image = $this->model_tool_image->resize($result['image'], 40, 40);

			} else {

				$image = $this->model_tool_image->resize('no_image.png', 40, 40);

			}

			$propertstatus_info=$this->model_property_property_status->getOrderStatus($result['property_status_id']);

			if(isset($propertstatus_info['name'])){

				$property_status=$propertstatus_info['name'];         

			} else {

				$property_status='';

			}

			$data['propert'][]=array(

				'property_id'		=>$result['property_id'],

				'agentname' 	    => $agentname,
				'property_status' 	=> $property_status,

				'image' 			=> $image,

				//'name'=>$result['propertyname'],

				'name'				=>$result['name'],

				'price'				=>$result['price'],

				'sort_order'		=>$result['sort_order'],

				'approve'			=>$approve,

				'disapproved'		=>$disapproved,

				'status'			=>$status,

				'edit'				=> $this->url->link('property/property/edit', 'token=' . $this->session->	data['token'] . '&property_id=' .$result['property_id'] . $url, true)

			);

		}	

			if ($order == 'ASC'){



			$url .= '&order=DESC';



		}else{



			$url .= '&order=ASC';



		}	



		$pagination = new Pagination();

		$pagination = new Pagination();

		$pagination->total 			= $propert_total;

		$pagination->page 			= $page;

		$pagination->limit 			= $this->config->get('config_limit_admin');

		$pagination->url 			= $this->url->link('property/property', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] 		= $pagination->render();

		$data['results'] 			= sprintf($this->language->get('text_pagination'), ($propert_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($propert_total - $this->config->get('config_limit_admin'))) ? $propert_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $propert_total, ceil($propert_total / $this->config->get('config_limit_admin')));

    	$data['sort_image']			= $this->url->link('property/property', 'token=' . $this->session->data['token'] .'&sort=p.image' . $url, true);
    	$data['sort_agent']			= $this->url->link('property/property', 'token=' . $this->session->data['token'] .'&sort=p.agent' . $url, true);
    	$data['sort_name']			= $this->url->link('property/property', 'token=' . $this->session->data['token'] .'&sort=ppd.name' . $url, true);

		$data['sort_propertystatus']= $this->url->link('property/property', 'token=' .$this->session->data['token'] . '&sort=p.property_status_id' . $url, true);

		$data['sort_status']  		= $this->url->link('property/property', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, true);

		$data['sort_price']  		= $this->url->link('property/property', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, true);

		
		$data['filter_name']		= $filter_name;
		$data['filter_price_from'] 	= $filter_price_from;
		$data['filter_price_to']	= $filter_price_to;
		$data['filter_propertystatus'] =$filter_propertystatus;
		$data['filter_agent']        =$filter_agent;
		$data['filter_status'] 		= $filter_status;
		$data['sort'] = $sort;
		$data['order'] = $order;

		if(isset($data['filter_agent'])) {
			$agent_info = $this->model_property_property->getAgent($data['filter_agent']);
		}
		if(isset($agent_info['agentname'])) {
			$data['filteragent'] = $agent_info['agentname'];
		} else {
			$data['filteragent'] ='';
		}

		if(isset($data['filter_propertystatus'])) {
			$status_info = $this->model_property_property->getPropertyStatus($data['filter_propertystatus']);
		}

		if(isset($status_info['name'])) {
			$data['statusname'] = $status_info['name'];
		} else {
			$data['statusname'] ='';
		}
		

		$data['header']      = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer']      = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('property/property_list', $data));

	}

	public function getform(){
		$data['heading_title']       		= $this->language->get('heading_title');
		$data['tab_customfield']       		= $this->language->get('tab_customfield');
		$data['text_form']           		= $this->language->get('text_form');
		$data['text_select']      			= $this->language->get('text_select');
		$data['text_list']           		= $this->language->get('text_list');
		$data['text_none']        			= $this->language->get('text_none');
		$data['text_map']         			= $this->language->get('text_map');
		$data['text_upload']         		= $this->language->get('text_upload');

		$data['tab_general']         		= $this->language->get('tab_general');
		$data['tab_data']            		= $this->language->get('tab_data');

		$data['tab_Address_Map']    		= $this->language->get('Address & Map');
		$data['tab_image']           		= $this->language->get('Image');
		$data['tab_neareast_place']  		= $this->language->get('Neareast Place');
		$data['tab_feature']         		= $this->language->get('Amenities');

		$data['lable_description']   		= $this->language->get('lable_description');
		$data['lable_destinies']     		= $this->language->get('lable_destinies');
		$data['lable_name']          		= $this->language->get('lable_name');
		$data['lable_country']      		= $this->language->get('lable_country');
		$data['lable_city']          		= $this->language->get('lable_city');
		$data['lable_arealenght']    		= $this->language->get('lable_arealenght');
		$data['lable_local_area']    		= $this->language->get('lable_local_area');
		$data['lable_pincode']      		= $this->language->get('lable_pincode');
		$data['lable_latitude']      		= $this->language->get('lable_latitude');
		$data['lable_longitude']     		= $this->language->get('lable_longitude');
		$data['lable_images']        		= $this->language->get('lable_images');
		$data['lable_titles']        		= $this->language->get('lable_titles');
		$data['lable_alt']          		= $this->language->get('lable_alt');
		$data['lable_Zone_region']   		= $this->language->get('lable_Zone_region');
		$data['lable_sort_order']    		= $this->language->get('lable_sort_order');
		$data['lable_meta_title']    		= $this->language->get('lable_meta_title');
		$data['lable_property_status']    	= $this->language->get('lable_property_status');
		$data['lable_status']				= $this->language->get('lable_status');
		$data['lable_store']				= $this->language->get('lable_store');
		$data['lable_meta_keyword']  		= $this->language->get('lable_meta_keyword');
		$data['lable_property_name'] 		= $this->language->get('lable_property_name');
		$data['lable_meta_descriptions'] 	= $this->language->get('lable_meta_descriptions');
		$data['lable_tag'] 			 		= $this->language->get('lable_tag');		
		$data['lable_products']      		= $this->language->get('lable_products');
		$data['lable_image']                = $this->language->get('lable_image');
		$data['lable_title']                = $this->language->get('lable_title');
		$data['lable_SEO_URL']              = $this->language->get('lable_SEO_URL');
		$data['lable_property']             = $this->language->get('lable_property');
		$data['lable_video']      	        = $this->language->get('lable_video');
		$data['lable_Price']                = $this->language->get('lable_Price');
		$data['lable_agent']                = $this->language->get('lable_agent');
		$data['lable_category']             = $this->language->get('lable_category');
		$data['lable_Description_property'] = $this->language->get('lable_Description_property');
		$data['lable_neighborhood'] 		= $this->language->get('lable_neighborhood');
		$data['lable_area'] 				= $this->language->get('lable_area');
		$data['lable_bedrooms'] 			= $this->language->get('lable_bedrooms');
		$data['lable_bathrooms'] 			= $this->language->get('lable_bathrooms');
		$data['lable_roomcount'] 			= $this->language->get('lable_roomcount');
		$data['lable_pricelabel'] 			= $this->language->get('lable_pricelabel');
		$data['lable_Parkingspaces'] 		= $this->language->get('lable_Parkingspaces');
		$data['lable_builtin'] 				= $this->language->get('lable_builtin');
		$data['lable_amenities'] 			= $this->language->get('lable_amenities');
		$data['lable_approved']             = $this->language->get('lable_approved');
		
		$data['entry_description']   		= $this->language->get('entry_description');
		$data['entry_destinies']     		= $this->language->get('entry_destinies');
		$data['entry_name']          		= $this->language->get('entry_name');
		$data['entry_country']      		= $this->language->get('entry_country');
		$data['entry_city']          		= $this->language->get('entry_city');
		$data['entry_arealenght']    		= $this->language->get('entry_arealenght');
		$data['entry_local_area']    		= $this->language->get('entry_local_area');
		$data['entry_pincode']      		= $this->language->get('entry_pincode');
		$data['entry_latitude']      		= $this->language->get('entry_latitude');
		$data['entry_longitude']     		= $this->language->get('entry_longitude');
		$data['entry_images']        		= $this->language->get('entry_images');
		$data['entry_titles']        		= $this->language->get('entry_titles');
		$data['entry_alt']          		= $this->language->get('entry_alt');
		$data['entry_Zone_region']   		= $this->language->get('entry_Zone_region');
		$data['entry_sort_order']    		= $this->language->get('entry_sort_order');
		$data['entry_meta_title']    		= $this->language->get('entry_meta_title');
		$data['entry_property_status']    	= $this->language->get('entry_property_status');
		$data['entry_status']				= $this->language->get('entry_status');
		$data['entry_store']				= $this->language->get('entry_store');
		$data['entry_meta_keyword']  		= $this->language->get('entry_meta_keyword');
		$data['entry_property_name'] 		= $this->language->get('entry_property_name');
		$data['entry_meta_descriptions'] 	= $this->language->get('entry_meta_descriptions');
		$data['entry_tag'] 			 		= $this->language->get('entry_tag');		
		$data['entry_products']      		= $this->language->get('entry_products');
		$data['entry_image']                = $this->language->get('entry_image');
		$data['entry_title']                = $this->language->get('entry_title');
		$data['entry_SEO_URL']              = $this->language->get('entry_SEO_URL');
		$data['entry_property']             = $this->language->get('entry_property');
		$data['entry_video']      	        = $this->language->get('entry_video');
		$data['entry_Price']                = $this->language->get('entry_Price');
		$data['entry_agent']                = $this->language->get('entry_agent');
		$data['entry_category']             = $this->language->get('entry_category');
		$data['entry_Description_property'] = $this->language->get('entry_Description_property');
		$data['entry_neighborhood'] 		= $this->language->get('entry_neighborhood');
		$data['entry_area'] 				= $this->language->get('entry_area');
		$data['entry_bedrooms'] 			= $this->language->get('entry_bedrooms');
		$data['entry_bathrooms'] 			= $this->language->get('entry_bathrooms');
		$data['entry_roomcount'] 			= $this->language->get('entry_roomcount');
		$data['entry_pricelabel'] 			= $this->language->get('entry_pricelabel');
		$data['entry_Parkingspaces'] 		= $this->language->get('entry_Parkingspaces');
		$data['entry_builtin'] 				= $this->language->get('entry_builtin');
		$data['entry_amenities'] 			= $this->language->get('entry_amenities');
		$data['entry_approved']             = $this->language->get('entry_approved');

		$data['text_enable']   				= $this->language->get('Enable');
		$data['text_disable'] 				= $this->language->get('Disable');
		$data['text_loading'] 				= $this->language->get('text_loading');

		$data['button_remove']       		= $this->language->get('button_remove');
		$data['button_add']                 = $this->language->get('button_add');
		$data['button_save']   				= $this->language->get('button_save');
		$data['button_delete'] 				= $this->language->get('button_delete');
		$data['button_cancel'] 				= $this->language->get('button_cancel');
		$data['button_upload'] 				= $this->language->get('button_upload');

		$data['breadcrumbs'] 				= array();
		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(

		'text' => $this->language->get('text_home'),

		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)

		);

		if (isset($this->error['warning'])){

			$data['error_warning'] = $this->error['warning'];

		} else {

			$data['error_warning'] = '';

		}

		if (isset($this->session->data['success'])){

			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);

		} else {

			$data['success'] = '';

		}

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),

			'href' => $this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true)

		);

		

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

				

		$this->load->model('localisation/country');

		$data['countrys'] = $this->model_localisation_country->getCountries(array());

		

  		$this->load->model('localisation/zone');

		$data['zone'] = $this->model_localisation_zone->getZones($data);



		///feature checked

		$this->load->model('property/feature');

		// $data= $this->request->get['property_id'];

		if (isset($this->request->get['property_id'])) {

			$property_id = $this->request->get['property_id'];

		} else {

			$property_id = '';

		}

		$data['feature_c']=array();

		$checkfeatures = $this->model_property_feature->checkFeatures($property_id);

		$data['feature']=array();

		foreach($checkfeatures as $checkf){

			$data['checkfeatures'][]=array(

				'feature_id'=>$checkf['feature_id'],

			);

			$data['feature_c'][]=$checkf['feature_id'];

		}

		

		//////////////////////// feature/////////////

		$this->load->model('property/feature');

		$features = $this->model_property_feature->getFeatures(array());

		$this->load->model('tool/image');

		foreach($features as $feature){

			if (is_file(DIR_IMAGE . $feature['image'])){

				$image = $this->model_tool_image->resize($feature['image'], 40, 40);

			} else {

				$image = $this->model_tool_image->resize('no_image.png', 40, 40);

			}

			$data['feature'][] = array(

				'feature_id' => $feature['feature_id'],

				'name' => $feature['name'],

				'image' => $image,

			);



		}

		/////////////////////// feature/////////////

		

		/////////////////////// nearestplace

		$this->load->model('property/nearest_place');

		$this->load->model('property/property');

		$data['nearestplace'] = array();  

		$nearestplaces =$this->model_property_nearest_place->getNearestPlaces(array());

		$this->load->model('tool/image');

		$data['nearestplace']=array();

		if(isset($nearestplaces)){

			foreach($nearestplaces as $nearestplace){

				if (is_file(DIR_IMAGE . $nearestplace['image'])){

					$image = $this->model_tool_image->resize($nearestplace['image'], 40, 40);

				} else {

					$image = $this->model_tool_image->resize('no_image.png', 40, 40);

				}

				$destinies= $this->model_property_property->getNearestplaceid($property_id,$nearestplace['nearest_place_id']);

				//echo "<pre>";

				//print_r($destinies);die();



				$data['nearestplace'][] = array(

					'nearest_place_id' => $nearestplace['nearest_place_id'],

					'name' => $nearestplace['name'],

					'destinies' =>$destinies,

					'image' => $image,

				);

				//echo "<pre>";

				//print_r($data['nearestplace']);die();

			 }

		}

		/////////////////////// nearestplace/////

		

		if (isset($this->request->post['selected'])){

			$data['selected'] = (array) $this->request->post['selected'];

		} else {

			$data['selected'] = array();

		}

		if (isset($this->error['name'])){

			$data['error_name'] = $this->error['name'];

		} else {

			$data['error_name'] = '';

		}

		if (isset($this->error['meta_title'])){

			$data['error_meta_title'] = $this->error['meta_title'];

		} else {

			$data['error_meta_title'] = '';

		}


		

		if (isset($this->error['country_id'])){

			$data['error_country_id'] = $this->error['country_id'];

		} else {

			$data['error_country_id'] = '';

		}

		if (isset($this->error['zone_id'])){

			$data['error_zone_id'] = $this->error['zone_id'];

		} else {

			$data['error_zone_id'] = '';

		}

		if (isset($this->error['sort_order'])){

			$data['error_sort_order'] = $this->error['sort_order'];

		} else {

			$data['error_sort_order'] = '';

		}

		if (isset($this->error['property_status_id'])) {
			$data['error_property_status_id'] = $this->error['property_status_id'];
		} else {
			$data['error_property_status_id'] = '';
		}

		if (!isset($this->request->get['property_id'])){

			$data['action'] = $this->url->link('property/property/add', 'token=' . $this->session->data['token'] . $url, true);

		} else {

			$data['action'] = $this->url->link('property/property/edit', 'token=' . $this->session->data['token'] . '&property_id=' . $this->request->get['property_id'] . $url, true);

		}

		$data['cancel'] = $this->url->link('property/property', 'token=' . $this->session->data['token'] . $url, true);

		//edit in form//

		if (isset($this->request->get['property_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')){

			$property_info = $this->model_property_property->getPropertyEdit($this->request->get['property_id']);

		}

		$data['token'] = $this->session->data['token'];



		$this->load->model('property/custom_field');

		$data['custom_fields'] = $this->model_property_custom_field->getCustomFieldsselect($this->config->get('config_customer_group_id'));
		if (isset($this->request->post['custom_field'])) {
			$data['account_custom_field'] = $this->request->post['custom_field'];
		} elseif (isset($property_info)) {
			$data['account_custom_field'] = json_decode($property_info['custom_field'], true);
		} else {
			$data['account_custom_field'] = array();
		}
		//echo "<pre>";
		//print_r($data['account_custom_field']); die();
		

		if (isset($this->request->post['sort_order'])){

			$data['sort_order'] = $this->request->post['sort_order'];

		} elseif (isset($property_info['sort_order'])) {

			$data['sort_order'] = $property_info['sort_order'];

		} else {

			$data['sort_order'] = '';		

		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image'])){
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($property_info)){
			$data['image'] = $property_info['image'];
		} else {
			$data['image'] = '';
		}

		if (isset($this->request->post['image_thumb']) && is_file(DIR_IMAGE . $this->request->post['image_thumb'])){
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image_thumb'], 100, 100);
		} elseif(!empty($property_info) && is_file(DIR_IMAGE . $property_info['image'])){
			$data['thumb'] = $this->model_tool_image->resize($property_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])){
			$data['thumbimage'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif(!empty($property_info) && is_file(DIR_IMAGE . $property_info['image'])){
			$data['thumbimage'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		} else {
			$data['thumbimage'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		

		$data['placeholder2'] = $this->model_tool_image->resize('no_image.png', 100, 100);



		if (isset($this->request->post['video'])){

			$data['video'] = $this->request->post['video'];

		} elseif (isset($property_info['video'])) {

			$data['video'] = $property_info['video'];

		} else {

			$data['video'] = '';		

		}

		if (isset($this->request->post['price']))	{

		$data['price'] = $this->request->post['price'];

		} elseif (isset($property_info['price'])){

			$data['price'] = $property_info['price'];

		} else {

			$data['price'] = '';		

		}

		if (isset($this->request->post['country_id'])){

			$data['country_id'] = $this->request->post['country_id'];

		} elseif (isset($property_info['country_id'])){

			$data['country_id'] = $property_info['country_id'];

		} else {
		// 30 05 2019 modifie code //
			$data['country_id'] = $this->config->get('config_country_id');		
		// 30 05 2019 modifie code //

		}

		

		

		if (isset($this->request->post['approved'])){

			$data['approved'] = $this->request->post['approved'];

		} elseif (isset($property_info['approved'])){

			$data['approved'] = $property_info['approved'];

		} else {

			$data['approved'] = '';		

		}

		

		

		if (isset($this->request->post['status'])){

			$data['status'] = $this->request->post['status'];

		} elseif (isset($property_info['status'])){

			$data['status'] = $property_info['status'];

		} else {

			$data['status'] = '';		

		}

		

		if (isset($this->request->post['zone_id'])){

			$data['zone_id'] = $this->request->post['zone_id'];

		} elseif (isset($property_info['zone_id'])){

			$data['zone_id'] = $property_info['zone_id'];

		} else {

			$data['zone_id'] = '';		

		}

		

		if (isset($this->request->post['pincode'])) {

			$data['pincode'] = $this->request->post['pincode'];

		} elseif (isset($property_info['pincode'])) {

			$data['pincode'] = $property_info['pincode'];

		} else {

			$data['pincode'] = '';		

		}

		

		if (isset($this->request->post['local_area'])){

			$data['local_area'] = $this->request->post['local_area'];

		} elseif (isset($property_info['local_area'])) {

			$data['local_area'] = $property_info['local_area'];

		} else {

			$data['local_area'] = '';		

		}

		

		if (isset($this->request->post['latitude'])){

			$data['latitude'] = $this->request->post['latitude'];

		} elseif (isset($property_info['latitude'])){

			$data['latitude'] = $property_info['latitude'];

		} else {

			$data['latitude'] = '';		

		}

		if (isset($this->request->post['city'])){

			$data['city'] = $this->request->post['city'];

		} elseif (isset($property_info['city'])){

			$data['city'] = $property_info['city'];

		} else {

			$data['city'] = '';		

		}

		if (isset($this->request->post['neighborhood'])){

			$data['neighborhood'] = $this->request->post['neighborhood'];

		} elseif (isset($property_info['neighborhood'])){

			$data['neighborhood'] = $property_info['neighborhood'];

		} else {

			$data['neighborhood'] = '';		

		}

		if (isset($this->request->post['area'])){

			$data['area'] = $this->request->post['area'];

		} elseif (isset($property_info['area'])){

			$data['area'] = $property_info['area'];

		} else {

			$data['area'] = '';		

		}

		

		if (isset($this->request->post['lenght'])){

			$data['lenght'] = $this->request->post['lenght'];

		} elseif (isset($property_info['lenght'])){

			$data['lenght'] = $property_info['lenght'];

		} else {

			$data['lenght'] = '';		

		}

		

		

		if (isset($this->request->post['bedrooms'])){

			$data['bedrooms'] = $this->request->post['bedrooms'];

		} elseif (isset($property_info['bedrooms'])){

			$data['bedrooms'] = $property_info['bedrooms'];

		} else {

			$data['bedrooms'] = '';		

		}

		if (isset($this->request->post['bathrooms'])){

			$data['bathrooms'] = $this->request->post['bathrooms'];

		} elseif (isset($property_info['bathrooms'])){

			$data['bathrooms'] = $property_info['bathrooms'];

		} else {

			$data['bathrooms'] = '';		

		}

		

		if (isset($this->request->post['roomcount'])){

			$data['roomcount'] = $this->request->post['roomcount'];

		} elseif (isset($property_info['roomcount'])){

			$data['roomcount'] = $property_info['roomcount'];

		} else {

			$data['roomcount'] = '';		

		}

		if (isset($this->request->post['Parkingspaces'])){

			$data['Parkingspaces'] = $this->request->post['Parkingspaces'];

		} elseif (isset($property_info['Parkingspaces'])){

			$data['Parkingspaces'] = $property_info['Parkingspaces'];

		} else {

			$data['Parkingspaces'] = '';		

		}

		

		if (isset($this->request->post['builtin'])){

			$data['builtin'] = $this->request->post['builtin'];

		} elseif (isset($property_info['builtin'])){

			$data['builtin'] = $property_info['builtin'];

		} else {

			$data['builtin'] = '';		

		}

		

	

		

		if (isset($this->request->post['lenght'])){

			$data['lenght'] = $this->request->post['lenght'];

		} elseif (isset($property_info['lenght'])){

			$data['lenght'] = $property_info['lenght'];

		}else{

			$data['lenght'] = '';		

		}

		

		if (isset($this->request->post['pricelabel'])){

			$data['pricelabel'] = $this->request->post['pricelabel'];

		} elseif (isset($property_info['pricelabel'])){

			$data['pricelabel'] = $property_info['pricelabel'];

		} else {

			$data['pricelabel'] = '';		

		}

		

		if (isset($this->request->post['longitude'])){

			$data['longitude'] = $this->request->post['longitude'];

		} elseif (isset($property_info['longitude'])){

			$data['longitude'] = $property_info['longitude'];

		} else {

			$data['longitude'] = '';		

		}

		

		if (isset($this->request->post['title'])){

			$data['title'] = $this->request->post['title'];

		} elseif (isset($property_info['title'])){

			$data['title'] = $property_info['title'];

		} else {

			$data['title'] = '';		

		}

		

		if (isset($this->request->post['destinies'])){

			$data['destinies'] = $this->request->post['destinies'];

		} elseif (isset($property_info['destinies'])){

			$data['destinies'] = $property_info['destinies'];

		} else {

			$data['destinies'] = '';		

		}

		

		if (isset($this->request->post['alt'])){

			$data['alt'] = $this->request->post['alt'];

		} elseif (isset($property_info['alt'])){

			$data['alt'] = $property_info['alt'];

		} else {

			$data['alt'] = '';		

		}

		if (isset($this->request->post['area_type'])){

			$data['area_type'] = $this->request->post['area_type'];

		} elseif (isset($property_info['area_type'])){

			$data['area_type'] = $property_info['area_type'];

		} else {

			$data['area_type'] = '';		

		}

				

		if (isset($this->request->post['feature_id'])){

			$data['feature_id'] = $this->request->post['feature_id'];

		} elseif (isset($property_info['feature_id'])){

			$data['feature_id'] = $property_info['feature_id'];

		} else {

			$data['feature_id'] = '';		

		}

		

		if (isset($this->request->post['Property_description'])) {

			$data['Property_description'] = $this->request->post['Property_description'];

		} elseif (isset($property_info)) {

			$data['Property_description'] = $this->model_property_property->getPropertyDescription($this->request->get['property_id']);

		} else {

			$data['Property_description'] = array();

		}

		///image

   		$this->load->model('tool/image');

		if (isset($this->request->post['images_tab'])) {

			$image_tabs = $this->request->post['images_tab'];

		} elseif (isset($this->request->get['property_id'])) {

			$image_tabs = $this->model_property_property->getPropertyImages($this->request->get['property_id']);

		} else {

			$image_tabs = array();

		}

		$data['image_tabs'] = array();

		foreach ($image_tabs as $image_tab) {

			DIR_IMAGE . $image_tab['image'];

			if (is_file(DIR_IMAGE . $image_tab['image'])){

				$image = $image_tab['image'];

				$thumbs = $image_tab['image'];

			} else	{

				$image = '';

				$thumbs = 'no_image.png';

			}

			$data['image_tabs'][] = array(

				'image'      => $image,

				'thumbs'      => $this->model_tool_image->resize($thumbs, 100, 100),

				'title' => $image_tab['title'],

				'alt' => $image_tab['alt']

			);

		}

		/// name this is input 

		

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])){

			$data['thumbs'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);

		} elseif(!empty($property_info) && is_file(DIR_IMAGE . $property_info['image'])){

			$data['thumbs'] = $this->model_tool_image->resize($property_info['image'], 100, 100);

		} else {

			$data['thumbs'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['property_agent_id'])){

			$data['property_agent_id'] = $this->request->post['property_agent_id'];

		}	elseif (isset($property_info['property_agent_id'])){

			$data['property_agent_id'] = $property_info['property_agent_id'];

		} else {

			$data['property_agent_id'] = '';		

		}

		$this->load->model('property/units');

		$data['areatypes'] = $this->model_property_units->getpropertyunits();

	
		if (isset($this->request->post['property_status_id'])) {

			$data['property_status_id'] = $this->request->post['property_status_id'];

		} elseif (isset($property_info['property_status_id'])) {

			$data['property_status_id'] = $property_info['property_status_id'];

		} else {

			$data['property_status_id'] = '';		

		}



		if(!empty($data['property_status_id'])){	

			$this->load->model('property/property_status');

			$propertstatus_info=$this->model_property_property_status->getOrderStatus($data['property_status_id']);

			$data['property_status']=$propertstatus_info['name'];

		} else {

			$data['property_status']='';

		}

		/*if(!empty($data['property_agent_id'])){	

			$this->load->model('property/agent');

			$agent_info=$this->model_property_agent->getAgent($data['property_agent_id']);

			$data['agent']=$agent_info['agentname'];

		} else {

			$data['agent']='';

		}*/



		if (isset($this->request->post['agent'])) {

			$data['agent'] = $this->request->post['agent'];

		} elseif (!empty($property_info)) {

			$this->load->model('property/agent');

			$agent_info=$this->model_property_agent->getAgent($data['property_agent_id']);

			if ($agent_info) {

				$data['agent'] = $agent_info['agentname'];

			} else {

				$data['agent'] = '';

			}

		} else {

			$data['agent'] = '';

		}

	

		///getpropertycategoryid multiple id show///

		///

		if (isset($this->request->post['category_id'])){

			$category_ids = $this->request->post['category_id'];

		} elseif (!empty($property_info)){

			$category_ids = $this->model_property_property->getpropertycategoryid($this->request->get['property_id']);

		} else {

			$category_ids = '';

		}

		/// name this is input 

		$data['categories']=array();

		$this->load->model('property/category');

		if(!empty($category_ids)){

			foreach($category_ids as $category_id){

				$category_info=$this->model_property_category->getCategory($category_id);

				///subcategory//

				if(!empty($category_info['path'])){

					$category=$category_info['path'].' > '.$category_info['name'];

				} elseif(empty($category_info['path']) && empty($category_info['name'])) {

					$category='';

				}
				else{
					$category=$category_info['name'];

				}

				///subcategory//

				$data['categories'][]=array(

					'category_id'=>$category_id,

					'name'=>$category,

				);

			}

		}

		if (isset($this->request->post['features'])){

			$data['features'] = $this->request->post['features'];

		} elseif (isset($this->request->get['property_id'])) {

			$data['features'] = $property_info = $this->model_property_feature->getFeature($this->request->get['property_id']);

		} else {

			$data['features'] =array();		

		}

		

		

		 $this->load->model('property/custom_field');
        $data['custom_fields']= $this->model_property_custom_field->getCustomFieldsselect(array());

        

		////edit

		$data['header']      = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer']      = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('property/property_form', $data));



	}

	

	public function validateForm(){

		if (!$this->user->hasPermission('modify', 'property/property')){

			$this->error['warning'] = $this->language->get('error_permission');

		}

		

		foreach ($this->request->post['Property_description'] as $language_id => $value) {

			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 64)){

				$this->error['name'][$language_id] = $this->language->get('error_name');

			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 64)){

				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');

			}

		}


		if (empty($this->request->post['property_status_id'])) {
			
			$this->error['property_status_id'] = $this->language->get('error_status');
		}


		if ((utf8_strlen($this->request->post['country_id']) < 2) || (utf8_strlen($this->request->post['country_id']) > 64)) {
			$this->error['country_id'] = $this->language->get('error_country_id');
		}

		if ((utf8_strlen($this->request->post['sort_order']) < 1) || (utf8_strlen($this->request->post['sort_order']) > 64)) {
			$this->error['sort_order'] = $this->language->get('error_sort_order');
		}

		if ((utf8_strlen($this->request->post['zone_id']) < 2) || (utf8_strlen($this->request->post['zone_id']) > 64)) {
			$this->error['zone_id'] = $this->language->get('error_zone_id');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;

	}

	

	protected function validateDelete(){

		if (!$this->user->hasPermission('modify', 'property/property')){

			$this->error['warning'] = $this->language->get('error_permission');

		}

		return !$this->error;

	}

			

	protected function validateApprove(){

		if (!$this->user->hasPermission('modify', 'property/property')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}

	    return !$this->error;

	}



	protected function validateDesapprove(){

		if (!$this->user->hasPermission('modify', 'property/property')) {

			$this->error['warning'] = $this->language->get('error_permission');

		}

	    return !$this->error;



	}



		////////14-10-2016//

	public function autocomplete() {

		if (isset($this->request->get['filter_name'])){

			if (isset($this->request->get['sort'])){

				$sort = $this->request->get['sort'];

			}else {	

				$sort = 'ppd.name';

			}

		if (isset($this->request->get['order'])){

				$order = $this->request->get['order'];

			}else {

				$order = 'ASC';

			}

		if (isset($this->request->get['page'])){

				$page = $this->request->get['page'];

			}else {

				$page = 1;

			}

			$this->load->model('property/property');

			$filter_data = array(

				'filter_name'  => $this->request->get['filter_name'],

				'order' => $order,

				'start' => ($page - 1) * $this->config->get('config_limit_admin'),

				'limit' => $this->config->get('config_limit_admin')

			);

			$results=$this->model_property_property->getPropertys($filter_data);

			foreach ($results as $result){

				$json[] = array(

				'property_id' => $result['property_id'],

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

	

	public function country() {

		$json = array();



		$this->load->model('localisation/country');



		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);



		if ($country_info) {

			$this->load->model('localisation/zone');



			$json = array(

				'country_id'        => $country_info['country_id'],

				'name'              => $country_info['name'],

				'iso_code_2'        => $country_info['iso_code_2'],

				'iso_code_3'        => $country_info['iso_code_3'],

				'address_format'    => $country_info['address_format'],

				'postcode_required' => $country_info['postcode_required'],

				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),

				'status'            => $country_info['status']

			);

		}



		$this->response->addHeader('Content-Type: application/json');

		$this->response->setOutput(json_encode($json));

	}

	public function getmapproperty(){

			$json[]=array();

			if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
					// Country 
				
				$this->load->model('localisation/country');
				$country='';
				if(isset($this->request->post['country_id']))

				{
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
				$country=$country_info['name'];

				}
	

				// Zone
			

				$this->load->model('localisation/zone');
				$zone='';
				if(isset($this->request->post['zone_id']))

				{

				$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);

				$zone=$zone_info['name'];

				}

				

				

				

				$city='';

				if(isset($this->request->post['city']))

				{

				$city=$this->request->post['city'];

				}

				

				$local_area='';

				if(isset($this->request->post['local_area']))

				{

				$local_area=$this->request->post['local_area'];

				}

				

				$pincode='';

				if(isset($this->request->post['pincode']))

				{

				$pincode=$this->request->post['pincode'];

				}

				$address=$country .' '.$zone .' '. $city .' '. $local_area .''.$pincode;

				 

				$address = str_replace(" ", "+", $address);

				//print_r($address);die();

				 
					$key=$this->config->get('config_mapkey');
				 $url = "https://maps.google.com/maps/api/geocode/json?key=$key&address=$address";
				


				
				

				

 $options = array(

        CURLOPT_RETURNTRANSFER => true,     // return web page

        CURLOPT_HEADER         => false,    // don't return headers

        CURLOPT_FOLLOWLOCATION => true,     // follow redirects

        CURLOPT_ENCODING       => "",       // handle all encodings

        CURLOPT_USERAGENT      => "spider", // who am i

        CURLOPT_AUTOREFERER    => true,     // set referer on redirect

        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect

        CURLOPT_TIMEOUT        => 120,      // timeout on response

        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects

        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks

    );



    $ch      = curl_init( $url );

    curl_setopt_array( $ch, $options );

    $response = curl_exec( $ch );

    $err     = curl_errno( $ch );

    $errmsg  = curl_error( $ch );

    $header  = curl_getinfo( $ch );

    curl_close( $ch );



 

			$json1 = json_decode($response,TRUE); //generate array object from the response from the web

				if(isset($json1['results'][0]['geometry']['location']['lng']))

				{

				$json['lat']=$json1['results'][0]['geometry']['location']['lat'];

				$json['lng']=$json1['results'][0]['geometry']['location']['lng'];

				$json['success']='Address Found';

				}

				else

				{

				$json['error']='Address Not Found';

				}

			}	

			$this->response->addHeader('Content-Type: application/json');

			$this->response->setOutput(json_encode($json));

	}

	public function upload(){
		$this->load->language('property/property');
		$json = array();
		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}
			// Allowed file extension types
			$allowed = array();
			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));
			$filetypes = explode("\n", $extension_allowed);
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			// Allowed file mime types
			$allowed = array();
			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));
			$filetypes = explode("\n", $mime_allowed);
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');

			}
			// Check to see if any PHP files are trying to be uploaded
			$content = file_get_contents($this->request->files['file']['tmp_name']);
			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_filetype');
			}
			// Return any upload error
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		if (!$json) {
			$targetDir = DIR_IMAGE.'catalog/';
			$file = $filename;
			$location = $targetDir.$file;
			$location1 = 'catalog/'.$file;
			move_uploaded_file($this->request->files['file']['tmp_name'], $location);
			$json['location1'] =$location1;
			$json['success'] = $this->language->get('text_upload');
		}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
	}

}