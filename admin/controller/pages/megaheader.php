<?php


class ControllerPagesMegaheader extends Controller {


	private $error = array();





	public function index() {


		$this->load->language('pages/megaheader');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('megaheader/megaheader');





		$this->getList();


	}





	public function add() {


		$this->load->language('pages/megaheader');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('megaheader/megaheader');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			$this->model_megaheader_megaheader->addMegaheader($this->request->post);





			$this->session->data['success'] = $this->language->get('text_success');





			$url = '';





			if (isset($this->request->get['filter_title'])) {


				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));


			}


            


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			$this->response->redirect($this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getForm();


	}





	public function edit() {


		$this->load->language('pages/megaheader');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('megaheader/megaheader');





		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {


			//print_r($this->request->post);die();


			$this->model_megaheader_megaheader->editMegaheader($this->request->get['megaheader_id'], $this->request->post);





			$this->session->data['success'] = $this->language->get('text_success');





			$url = '';





			if (isset($this->request->get['filter_title'])) {


				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));


			}


            


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			$this->response->redirect($this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getForm();


	}





	public function delete() {


		$this->load->language('pages/megaheader');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('megaheader/megaheader');





		if (isset($this->request->post['selected']) && $this->validateDelete()) {


			foreach ($this->request->post['selected'] as $megaheader_id) {


				$this->model_megaheader_megaheader->deleteMegaheader($megaheader_id);


			}





			$this->session->data['success'] = $this->language->get('text_success');





			$url = '';





			if (isset($this->request->get['filter_title'])) {


				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));


			}


            


			if (isset($this->request->get['sort'])) {


				$url .= '&sort=' . $this->request->get['sort'];


			}





			if (isset($this->request->get['order'])) {


				$url .= '&order=' . $this->request->get['order'];


			}





			if (isset($this->request->get['page'])) {


				$url .= '&page=' . $this->request->get['page'];


			}





			$this->response->redirect($this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . $url, 'SSL'));


		}





		$this->getList();


	}





	protected function getList() {


        if (isset($this->request->get['filter_title'])) {


			$filter_title = $this->request->get['filter_title'];


		} else {


			$filter_title = null;


		}


        


		if (isset($this->request->get['sort'])) {


			$sort = $this->request->get['sort'];


		} else {


			$sort = 'od.name';


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





		if (isset($this->request->get['filter_title'])) {


				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));


		}


        


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


			'href' => $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . $url, 'SSL')


		);





		$data['add'] = $this->url->link('pages/megaheader/add', 'token=' . $this->session->data['token'] . $url, 'SSL');


		$data['delete'] = $this->url->link('pages/megaheader/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');		


		$data['setting'] = $this->url->link('pages/megaheader/setting', 'token=' . $this->session->data['token'] . $url, 'SSL');





		$data['megaheaders'] = array();





		$filter_data = array(


			'filter_title'  => $filter_title,


			'sort'  => $sort,


			'order' => $order,


			'start' => ($page - 1) * $this->config->get('config_limit_admin'),


			'limit' => $this->config->get('config_limit_admin')


		);





		$megaheader_total = $this->model_megaheader_megaheader->getTotalMegaheaders($filter_data);





		$results = $this->model_megaheader_megaheader->getMegaheaders($filter_data);





		foreach ($results as $result) {


			$data['megaheaders'][] = array(


				'megaheader_id'  => $result['megaheader_id'],


				/* new code */


				'icon'  	  => $result['title_icon'],


				/* new code */


				'title'       => $result['title'],


				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),


				'sort_order' => $result['sort_order'],


				'edit'       => $this->url->link('pages/megaheader/edit', 'token=' . $this->session->data['token'] . '&megaheader_id=' . $result['megaheader_id'] . $url, 'SSL')


			);


		}





		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_list'] = $this->language->get('text_list');


		$data['text_no_results'] = $this->language->get('text_no_results');


		$data['text_confirm'] = $this->language->get('text_confirm');


		


		$data['entry_title'] = $this->language->get('entry_title');


		$data['entry_status'] = $this->language->get('entry_status');


		


        


		$data['column_title'] = $this->language->get('column_title');


		$data['column_status'] = $this->language->get('column_status');


		$data['column_edit'] = $this->language->get('column_edit');


		$data['column_sort_order'] = $this->language->get('column_sort_order');


		$data['column_action'] = $this->language->get('column_action');





		$data['button_add'] = $this->language->get('button_add');


		$data['button_edit'] = $this->language->get('button_edit');


		$data['button_delete'] = $this->language->get('button_delete');


		$data['button_setting'] = $this->language->get('button_setting');


		$data['button_filter'] = $this->language->get('button_filter');


        


        $data['token'] = $this->session->data['token'];





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





		$data['sort_title'] = $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . '&sort=od.title' . $url, 'SSL');


		$data['sort_sort_order'] = $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . '&sort=o.sort_order' . $url, 'SSL');


		$data['sort_status'] = $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . '&sort=o.status' . $url, 'SSL');





		$url = '';





		if (isset($this->request->get['filter_title'])) {


				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));


		}


		


		if (isset($this->request->get['sort'])) {


			$url .= '&sort=' . $this->request->get['sort'];


		}





		if (isset($this->request->get['order'])) {


			$url .= '&order=' . $this->request->get['order'];


		}





		$pagination = new Pagination();


		$pagination->total = $megaheader_total;


		$pagination->page = $page;


		$pagination->limit = $this->config->get('config_limit_admin');


		$pagination->url = $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');





		$data['pagination'] = $pagination->render();





		$data['results'] = sprintf($this->language->get('text_pagination'), ($megaheader_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($megaheader_total - $this->config->get('config_limit_admin'))) ? $megaheader_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $megaheader_total, ceil($megaheader_total / $this->config->get('config_limit_admin')));





		$data['filter_title'] = $filter_title;


		$data['sort'] = $sort;


		$data['order'] = $order;





		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/megaheader_list', $data));


	}





	protected function getForm() {


		$data['heading_title'] = $this->language->get('heading_title');		


		


		$data['text_enable'] = $this->language->get('text_enable');


		$data['text_form'] = $this->language->get('text_form');


		$data['text_disable'] = $this->language->get('text_disable');


		$data['text_yes'] = $this->language->get('text_yes');


		$data['text_no'] = $this->language->get('text_no');


		$data['text_category'] = $this->language->get('text_category');


		$data['text_select'] = $this->language->get('text_select');


		$data['text_info'] = $this->language->get('text_info');


		$data['text_manufact'] = $this->language->get('text_manufact');


		$data['text_custom'] = $this->language->get('text_custom');


		$data['text_editor'] = $this->language->get('text_editor');


		$data['text_product'] = $this->language->get('text_product');


		//// new changes  27-10-2016///


		


		//// new changes  27-10-2016///


		$data['text_product1'] = $this->language->get('text_product1');


		$data['text_subcategory'] = $this->language->get('text_subcategory');


		$data['text_category_image'] = $this->language->get('text_category_image');


		$data['text_manufatureimage'] = $this->language->get('text_manufatureimage');


		$data['text_category_description'] = $this->language->get('text_category_description');


		$data['text_sku'] = $this->language->get('text_sku');


		$data['text_upc'] = $this->language->get('text_upc');

		$data['entry_store'] = $this->language->get('entry_store');


		$data['text_default'] = $this->language->get('text_default');


		$data['entry_icontitle'] = $this->language->get('entry_icontitle');
		$data['entry_selectimagetype'] = $this->language->get('entry_selectimagetype');
		$data['entry_patternimage'] = $this->language->get('entry_patternimage');	
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_open'] = $this->language->get('entry_open');
		$data['entry_url'] = $this->language->get('entry_url');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_row'] = $this->language->get('entry_row');		
		$data['entry_status'] = $this->language->get('entry_status');


		$data['entry_col'] = $this->language->get('entry_col');


		$data['entry_sort_order'] = $this->language->get('entry_sort_order');


		$data['entry_enable'] = $this->language->get('entry_enable');


		$data['entry_custname'] = $this->language->get('entry_custname');


		$data['entry_custurl'] = $this->language->get('entry_custurl');


		$data['entry_customcode'] = $this->language->get('entry_customcode');

		$data['text_icontitle'] = $this->language->get('text_icontitle');
		$data['text_selectimagetype'] = $this->language->get('text_selectimagetype');
		$data['text_patternimage'] = $this->language->get('text_patternimage');	
		$data['text_image'] = $this->language->get('text_image');
		$data['text_open'] = $this->language->get('text_open');
		$data['text_url'] = $this->language->get('text_url');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_type'] = $this->language->get('text_type');
		$data['text_row'] = $this->language->get('text_row');		
		$data['text_status'] = $this->language->get('text_status');
		$data['text_showicon'] = $this->language->get('text_showicon');
		$data['text_store'] = $this->language->get('text_store');


		$data['text_col'] = $this->language->get('text_col');


		$data['text_sort_order'] = $this->language->get('text_sort_order');


		$data['text_enable'] = $this->language->get('text_enable');
		$data['text_information'] = $this->language->get('text_information');


		$data['text_custname'] = $this->language->get('text_custname');


		$data['text_custurl'] = $this->language->get('text_custurl');


		$data['text_customcode'] = $this->language->get('text_customcode');


		


		$data['text_none'] = $this->language->get('text_none');


		$data['text_pname'] = $this->language->get('text_pname');


		$data['text_model'] = $this->language->get('text_model');


		$data['text_image'] = $this->language->get('text_image');


		$data['text_price'] = $this->language->get('text_price');


		$data['text_description'] = $this->language->get('text_description');


		


		


		


		$data['button_custom'] = $this->language->get('button_custom');


		$data['button_remove'] = $this->language->get('button_remove');





	


		$data['entry_category'] = $this->language->get('entry_category');


		$data['entry_product'] = $this->language->get('entry_product');


		$data['entry_information'] = $this->language->get('entry_information');


		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');


		$data['entry_row'] = $this->language->get('entry_row');


		$data['entry_titleshow'] = $this->language->get('entry_titleshow');


		$data['entry_cols'] = $this->language->get('entry_cols');


		$data['entry_showicon'] = $this->language->get('entry_showicon');


		


		$data['help_keyword'] = $this->language->get('help_keyword');


		$data['help_category'] = $this->language->get('help_category');


		$data['help_product'] = $this->language->get('help_product');


		$data['help_manufacturer'] = $this->language->get('help_category');


		$data['help_information'] = $this->language->get('help_category');


		$data['help_bottom'] = $this->language->get('help_bottom');





		$data['tab_data'] = $this->language->get('tab_data');


		$data['tab_general'] = $this->language->get('tab_general');


		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');


		$data['button_megaheader_value_add'] = $this->language->get('button_megaheader_value_add');


		$data['button_remove'] = $this->language->get('button_remove');





		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}





		if (isset($this->error['title'])) {


			$data['error_title'] = $this->error['title'];


		} else {


			$data['error_title'] = array();


		}


		if (isset($this->error['status'])) {


			$data['error_status'] = $this->error['status'];


		} else {


			$data['error_status'] = array();


		}


		if (isset($this->error['color'])) {


			$data['error_color'] = $this->error['color'];


		} else {


			$data['error_color'] = '';


		}


		


		$url = '';





		if (isset($this->request->get['filter_title'])) {


				$url .= '&filter_title=' . urlencode(html_entity_decode($this->request->get['filter_title'], ENT_QUOTES, 'UTF-8'));


		}


		


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


			'href' => $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . $url, 'SSL')


		);





		if (!isset($this->request->get['megaheader_id'])) {


			$data['action'] = $this->url->link('pages/megaheader/add', 'token=' . $this->session->data['token'] . $url, 'SSL');


		} else {


			$data['action'] = $this->url->link('pages/megaheader/edit', 'token=' . $this->session->data['token'] . '&megaheader_id=' . $this->request->get['megaheader_id'] . $url, 'SSL');


		}





		$data['cancel'] = $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'] . $url, 'SSL');





		if (isset($this->request->get['megaheader_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {


			$megaheader_info = $this->model_megaheader_megaheader->getMegaheader($this->request->get['megaheader_id']);


		}


 


		$data['token'] = $this->session->data['token'];


		


		// Categories


		$this->load->model('megaheader/category');





		if (isset($this->request->post['product_category'])) {


			$categories = $this->request->post['product_category'];


		} elseif (!empty($megaheader_info['categories'])) {


			$categories = unserialize($megaheader_info['categories']);


		} else {


			$categories = array();


		}





		$data['product_categories'] = array();


		if(!empty($categories)){


		foreach ($categories as $category_id) {


			$category_info = $this->model_megaheader_category->getCategory($category_id);


     


		 if($category_info){


				$data['product_categories'][] = array(


					'category_id' => $category_info['category_id'],


					'name'          => $category_info['name']


				);


			}


		}


		}


		


		//// new changes  27-10-2016///


		


		$this->load->model('setting/store');





		$data['stores'] = $this->model_setting_store->getStores();





		if (isset($this->request->post['meagaheader_store'])) {


			$data['meagaheader_store'] = $this->request->post['meagaheader_store'];


		} elseif (isset($this->request->get['megaheader_id'])) {


			$data['meagaheader_store'] = $this->model_megaheader_megaheader->getmegaStores($this->request->get['megaheader_id']);


		} else {


			$data['meagaheader_store'] = array(0);


		}


		//// new changes  27-10-2016///


		


		// Information


		


		$this->load->model('megaheader/information');





		if (isset($this->request->post['header_information'])) {


			$informations = $this->request->post['header_information'];


		} elseif (!empty($megaheader_info['informations'])) {


			$informations = unserialize($megaheader_info['informations']);


		} else {


			$informations = array();


		}


		


		


		$data['header_informationies'] = array();


		


		


		if(!empty($informations)){


		foreach ($informations as $information_id) {	


			


			$info = $this->model_megaheader_information->getInformation($information_id);	


			


			if($info){


				$data['header_informationies'][] = array(


					'information_id' => $info['information_id'],


					'name'          => $info['keyword']


				);


			}


		}


		}


		





		// Manufacturer


		


		$this->load->model('megaheader/manufacturer');





		if (isset($this->request->post['header_manufacturer'])) {


			$manufacturers = $this->request->post['header_manufacturer'];


		} elseif (!empty($megaheader_info['manufactures'])) {


			$manufacturers = unserialize($megaheader_info['manufactures']);


		} else {


			$manufacturers = array();


		}


		


		$data['header_manufactureries'] = array();


		


		if(!empty($manufacturers)){


		foreach ($manufacturers as $manufacturer_id) {


			


			$manu_info = $this->model_megaheader_manufacturer->getManufacturer($manufacturer_id);


			$data['header_manufactureries'][] = array(


				'manufacturer_id' => $manu_info['manufacturer_id'],


				'name'          => $manu_info['name'],


			);


		}


		}





		// Custom Type


		if (isset($this->request->post['custom_type'])) {


			$custom_types = $this->request->post['custom_type'];


		} elseif (isset($this->request->get['megaheader_id'])) {


			$custom_types = $this->model_megaheader_megaheader->getMegaheadercustoms($this->request->get['megaheader_id']);


		} else {


			$custom_types = array();


		}





		$data['custom_types'] = array();


			if(!empty($custom_types)){


				


			foreach ($custom_types as $custom_type) {


			$data['custom_types'][] = array(


				'megaheader_ctype_desc' => $custom_type['megaheader_ctype_desc'],


				'custurl' => $custom_type['custurl'],


				'sort_order' => $custom_type['sort_order']


			);


		}


		}


		


		$this->load->model('localisation/language');





		$data['languages'] = $this->model_localisation_language->getLanguages();


    


		if (isset($this->request->post['megaheader_description'])) {


			$data['megaheader_description'] = $this->request->post['megaheader_description'];


		} elseif (isset($this->request->get['megaheader_id'])) {


			$data['megaheader_description'] = $this->model_megaheader_megaheader->getMegaheaderDescriptions($this->request->get['megaheader_id']);


		} else {


			$data['megaheader_description'] = array();


		}


		


		if (isset($this->request->post['customcode'])) {


			$data['customcode'] = $this->request->post['customcode'];


		} elseif (!empty($megaheader_info)) {


			$data['customcode'] = $megaheader_info['customcode'];


		} else {


			$data['customcode'] = '';


			


		}if (isset($this->request->post['customcode_description'])) {


			$data['customcode_description'] = $this->request->post['customcode_description'];


		} elseif (isset($this->request->get['megaheader_id'])) {


			$data['customcode_description'] = $this->model_megaheader_megaheader->getCustomcodeDescriptions($this->request->get['megaheader_id']);


		} else {


			$data['customcode_description'] = array();


		}


		


	


		if (isset($this->request->post['title_icon'])) {


			$data['title_icon'] = $this->request->post['title_icon'];


		} elseif (!empty($megaheader_info)) {


			$data['title_icon'] = $megaheader_info['title_icon'];


		} else {


			$data['title_icon'] = '';


		}


		


		if (isset($this->request->post['sort_order'])) {


			$data['sort_order'] = $this->request->post['sort_order'];


		} elseif (!empty($megaheader_info)) {


			$data['sort_order'] = $megaheader_info['sort_order'];


		} else {


			$data['sort_order'] = '';


		}


		if (isset($this->request->post['row'])) {


			$data['row'] = $this->request->post['row'];


		} elseif (!empty($megaheader_info)) {


			$data['row'] = $megaheader_info['row'];


		} else {


			$data['row'] = '';


		}


		if (isset($this->request->post['col'])) {


			$data['col'] = $this->request->post['col'];


		} elseif (!empty($megaheader_info)) {


			$data['col'] = $megaheader_info['col'];


		} else {


			$data['col'] = '';


		}


		if (isset($this->request->post['status'])) {


			$data['status'] = $this->request->post['status'];


		} elseif (!empty($megaheader_info)) {


			$data['status'] = $megaheader_info['status'];


		} else {


			$data['status'] = '';


		}


		if (isset($this->request->post['enable'])) {


			$data['enable'] = $this->request->post['enable'];


		} elseif (!empty($megaheader_info)) {


			$data['enable'] = $megaheader_info['enable'];


		} else {


			$data['enable'] = '';


		}


		if (isset($this->request->post['showicon'])) {


			$data['showicon'] = $this->request->post['showicon'];


		} elseif (!empty($megaheader_info)) {


			$data['showicon'] = $megaheader_info['showicon'];


		} else {


			$data['showicon'] = '';


		}


		if (isset($this->request->post['open'])) {


			$data['open'] = $this->request->post['open'];


		} elseif (!empty($megaheader_info)) {


			$data['open'] = $megaheader_info['open'];


		} else {


			$data['open'] = '';


		}


		if (isset($this->request->post['url'])) {


			$data['url'] = $this->request->post['url'];


		} elseif (!empty($megaheader_info)) {


			$data['url'] = $megaheader_info['url'];


		} else {


			$data['url'] = '';


		}


		


		/* new code */


		if (isset($this->request->post['bgimagetype'])) {


			$data['bgimagetype'] = $this->request->post['bgimagetype'];


		} elseif (!empty($megaheader_info)) {


			$data['bgimagetype'] = $megaheader_info['bgimagetype'];


		} else {


			$data['bgimagetype'] = '';


		}


		 if (isset($this->request->post['patternimage'])) {


			$data['patternimage'] = $this->request->post['patternimage'];


		} elseif (!empty($megaheader_info)) {


			$data['patternimage'] = $megaheader_info['patternimage'];


		} else {


			$data['patternimage'] = '';


		}


		/* new code */	


		


		


		if (isset($this->request->post['type'])) {


			$data['type'] = $this->request->post['type'];


		} elseif (!empty($megaheader_info)) {


			$data['type'] = $megaheader_info['type'];


		} else {


			$data['type'] = '';


		}	


		if (isset($this->request->post['cate'])) {


			$data['cate'] = $this->request->post['cate'];


		} elseif (!empty($megaheader_info)) {


			$data['cate'] = $megaheader_info['categories'];


		} else {


			$data['cate'] = 'product1';


		}


		


		if (isset($this->request->post['prod'])) {


			$data['prodprod'] = $this->request->post['prod'];


		} elseif (!empty($megaheader_info)) {


			$data['prod'] = $megaheader_info['products'];


		} else {


			$data['prod'] = '';


		}		


		if (isset($this->request->post['productsetting'])) {


			$data['productsetting'] = $this->request->post['productsetting'];


		} elseif (!empty($megaheader_info)) {


			$data['productsetting'] = unserialize($megaheader_info['productsetting']);


		} else {


			$data['productsetting'] = '';


		}		


		


		if (isset($this->request->post['image'])) {


			$data['image'] = $this->request->post['image'];


		} elseif (!empty($megaheader_info)) {


			$data['image'] = $megaheader_info['image'];


		} else {


			$data['image'] = '';


		}





		$this->load->model('tool/image');





		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);


		} elseif (!empty($megaheader_info) && is_file(DIR_IMAGE . $megaheader_info['image'])) {


			$data['thumb'] = $this->model_tool_image->resize($megaheader_info['image'], 100, 100);


		} else {


			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		}





		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		


		


		


		


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/megaheader_form', $data));


	}





	protected function validateForm() {


		if (!$this->user->hasPermission('modify', 'pages/megaheader')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}





		foreach ($this->request->post['megaheader_description'] as $language_id => $value) {


			if ((utf8_strlen($value['title']) < 1) || (utf8_strlen($value['title']) > 128)) {


				$this->error['title'][$language_id] = $this->language->get('error_title');


			}


		}


		


		return !$this->error;


	}





	protected function validateDelete() {


		if (!$this->user->hasPermission('modify', 'pages/megaheader')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}








		return !$this->error;


	}


	


	public function setting() {


		$this->load->language('pages/megaheader_setting');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('setting/setting');





		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {


			$this->model_setting_setting->editSetting('megaheader', $this->request->post);





			$this->session->data['success'] = $this->language->get('text_success');





			$this->response->redirect($this->url->link('pages/megaheader', 'token=' . $this->session->data['token'], 'SSL'));


		}





		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_add'] = $this->language->get('text_add');


		$data['text_enabled'] = $this->language->get('text_enabled');


		$data['text_disabled'] = $this->language->get('text_disabled');


		


		$data['help_bg_color'] = $this->language->get('help_bg_color');


		$data['help_title'] = $this->language->get('help_title');


		$data['help_link'] = $this->language->get('help_link');


		$data['help_link_hover'] = $this->language->get('help_link_hover');


		$data['help_powered'] = $this->language->get('help_powered');


		$data['help_title_font'] = $this->language->get('help_title_font');


		$data['help_sub_link'] = $this->language->get('help_sub_link');


		$data['help_product_limit'] = $this->language->get('help_product_limit');


		$data['help_category_limit'] = $this->language->get('help_category_limit');


		$data['help_product_image'] = $this->language->get('help_product_image');


		$data['help_manufacture_image'] = $this->language->get('help_manufacture_image');


		$data['help_drpmebg'] = $this->language->get('help_manufacture_image');


		$data['help_category_image'] = $this->language->get('help_category_image');


		


		


		$data['entry_bg_color'] = $this->language->get('entry_bg_color');


		$data['entry_title'] = $this->language->get('entry_title');


		$data['entry_link'] = $this->language->get('entry_link');


		$data['entry_link_hover'] = $this->language->get('entry_link_hover');


		$data['entry_powered'] = $this->language->get('entry_powered');


		$data['entry_title_font'] = $this->language->get('entry_title_font');


		$data['entry_sub_link'] = $this->language->get('entry_sub_link');


		$data['entry_product_limit'] = $this->language->get('entry_product_limit');


		$data['entry_category_limit'] = $this->language->get('entry_category_limit');


		$data['entry_product_image'] = $this->language->get('entry_product_image');


		$data['entry_width'] = $this->language->get('entry_width');	


		$data['entry_height'] = $this->language->get('entry_height');	


		$data['entry_category_image'] = $this->language->get('entry_category_image');		


		$data['entry_manufacture_image'] = $this->language->get('entry_manufacture_image');


		$data['entry_hovtitle'] = $this->language->get('entry_hovtitle');


		$data['entry_bghovtitle'] = $this->language->get('entry_bghovtitle');


		$data['entry_bgtitle'] = $this->language->get('entry_bgtitle');


		$data['entry_drpmebg'] = $this->language->get('entry_drpmebg');


		/* update code */


		$data['entry_menuexpend'] = $this->language->get('entry_menuexpend');


		$data['text_yes'] = $this->language->get('text_yes');


		$data['text_no'] = $this->language->get('text_no');


		/* update code */


		


		


		$data['help_bgtitle'] = $this->language->get('help_bgtitle');


		$data['help_bghovetitle'] = $this->language->get('help_bghovetitle');


		$data['help_hovtitle'] = $this->language->get('help_hovtitle');


		





		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');





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


		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_megaheader'),


			'href' => $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'], 'SSL')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('heading_title'),


			'href' => $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'], 'SSL')


		);





		$data['action'] = $this->url->link('pages/megaheader/setting', 'token=' . $this->session->data['token'], 'SSL');





		$data['cancel'] = $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'], 'SSL');


		


		/* update new */


		if (isset($this->request->post['megaheader_menuexpend'])) {


			$data['megaheader_menuexpend'] = $this->request->post['megaheader_menuexpend'];


		} else {


			$data['megaheader_menuexpend'] = $this->config->get('megaheader_menuexpend');;


		}	


		


		/* update new */





		if (isset($this->request->post['megaheader_drpmebg'])) {


			$data['megaheader_drpmebg'] = $this->request->post['megaheader_drpmebg'];


		} else {


			$data['megaheader_drpmebg'] = $this->config->get('megaheader_drpmebg');


		}


		if (isset($this->request->post['megaheader_bg_color'])) {


			$data['megaheader_bg_color'] = $this->request->post['megaheader_bg_color'];


		} else {


			$data['megaheader_bg_color'] = $this->config->get('megaheader_bg_color');


		}


		if (isset($this->request->post['megaheader_title'])) {


			$data['megaheader_title'] = $this->request->post['megaheader_title'];


		} else {


			$data['megaheader_title'] = $this->config->get('megaheader_title');


		}


		if (isset($this->request->post['megaheader_hovtitle'])) {


			$data['megaheader_hovtitle'] = $this->request->post['megaheader_hovtitle'];


		} else {


			$data['megaheader_hovtitle'] = $this->config->get('megaheader_hovtitle');


		}


		if (isset($this->request->post['megaheader_bgtitle'])) {


			$data['megaheader_bgtitle'] = $this->request->post['megaheader_bgtitle'];


		} else {


			$data['megaheader_bgtitle'] = $this->config->get('megaheader_bgtitle');


		}


		if (isset($this->request->post['megaheader_bghovtitle'])) {


			$data['megaheader_bghovtitle'] = $this->request->post['megaheader_bghovtitle'];


		} else {


			$data['megaheader_bghovtitle'] = $this->config->get('megaheader_bghovtitle');


		}


		if (isset($this->request->post['megaheader_link'])) {


			$data['megaheader_link'] = $this->request->post['megaheader_link'];


		} else {


			$data['megaheader_link'] = $this->config->get('megaheader_link');


		}


		if (isset($this->request->post['megaheader_link_hover'])) {


			$data['megaheader_link_hover'] = $this->request->post['megaheader_link_hover'];


		} else {


			$data['megaheader_link_hover'] = $this->config->get('megaheader_link_hover');


		}


		if (isset($this->request->post['megaheader_powered'])) {


			$data['megaheader_powered'] = $this->request->post['megaheader_powered'];


		} else {


			$data['megaheader_powered'] = $this->config->get('megaheader_powered');


		}


		if (isset($this->request->post['megaheader_title_font'])) {


			$data['megaheader_title_font'] = $this->request->post['megaheader_title_font'];


		} else {


			$data['megaheader_title_font'] = $this->config->get('megaheader_title_font');


		}


		if (isset($this->request->post['megaheader_sub_link'])) {


			$data['megaheader_sub_link'] = $this->request->post['megaheader_sub_link'];


		} else {


			$data['megaheader_sub_link'] = $this->config->get('megaheader_sub_link');


		}


		if (isset($this->request->post['megaheader_product_limit'])) {


			$data['megaheader_product_limit'] = $this->request->post['megaheader_product_limit'];


		} else {


			$data['megaheader_product_limit'] = $this->config->get('megaheader_product_limit');


		}


		if (isset($this->request->post['megaheader_category_limit'])) {


			$data['megaheader_category_limit'] = $this->request->post['megaheader_category_limit'];


		} else {


			$data['megaheader_category_limit'] = $this->config->get('megaheader_category_limit');


		}


		if (isset($this->request->post['megaheader_product_height'])) {


			$data['megaheader_product_height'] = $this->request->post['megaheader_product_height'];


		} else {


			$data['megaheader_product_height'] = $this->config->get('megaheader_product_height');


		}


		if (isset($this->request->post['megaheader_product_width'])) {


			$data['megaheader_product_width'] = $this->request->post['megaheader_product_width'];


		} else {


			$data['megaheader_product_width'] = $this->config->get('megaheader_product_width');


		}		


		if (isset($this->request->post['megaheader_category_width'])) {


			$data['megaheader_category_width'] = $this->request->post['megaheader_category_width'];


		} else {


			$data['megaheader_category_width'] = $this->config->get('megaheader_category_width');


		}


		if (isset($this->request->post['megaheader_category_height'])) {


			$data['megaheader_category_height'] = $this->request->post['megaheader_category_height'];


		} else {


			$data['megaheader_category_height'] = $this->config->get('megaheader_category_height');


		}


		if (isset($this->request->post['megaheader_manufacture_height'])) {


			$data['megaheader_manufacture_height'] = $this->request->post['megaheader_manufacture_height'];


		} else {


			$data['megaheader_manufacture_height'] = $this->config->get('megaheader_manufacture_height');


		}


		if (isset($this->request->post['megaheader_manufacture_width'])) {


			$data['megaheader_manufacture_width'] = $this->request->post['megaheader_manufacture_width'];


		} else {


			$data['megaheader_manufacture_width'] = $this->config->get('megaheader_manufacture_width');


		}		





		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/megaheader_setting', $data));


	}


	


	public function infoautocomplete() {


		$json = array();





		if (isset($this->request->get['filter_name'])) {


			$this->load->model('megaheader/information');





			$filter_data = array(


				'filter_name' => $this->request->get['filter_name'],


				'sort'        => 'name',


				'order'       => 'ASC',


				'start'       => 0,


				'limit'       => ''


			);





			$results = $this->model_megaheader_information->getInformations($filter_data);


		


			foreach ($results as $result) {


				$json[] = array(


					'information_id' => $result['information_id'],


					'name'        => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'))


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


	


	public function manufautocomplete() {


		$json = array();





		if (isset($this->request->get['filter_name'])) {


			$this->load->model('catalog/manufacturer');





			$filter_data = array(


				'filter_name' => $this->request->get['filter_name'],


				'sort'        => 'name',


				'order'       => 'ASC',


				'start'       => 0,


				'limit'       => ''


			);





			$results = $this->model_catalog_manufacturer->getManufacturers($filter_data);


		


			foreach ($results as $result) {


				$json[] = array(


					'manufacturer_id' => $result['manufacturer_id'],


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