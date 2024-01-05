<?php    


class ControllerPagesAbout extends Controller { 


	private $error = array();


  


  	public function index() {


		


		$this->load->language('pages/about');





		$this->document->setTitle($this->language->get('heading_title'));





		$this->load->model('catalog/about');


		


		$this->getList();


		





  	}	


	


	protected function getList() {





		$data['heading_title'] = $this->language->get('heading_title');


		$data['dashmenu'] = $this->load->controller('pages/dashmenu');


		


		$data['breadcrumbs'] = array();





   		$data['breadcrumbs'][] = array(


       		'text'      => $this->language->get('text_home'),


			'href'      => $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], 'SSL'),


      		'separator' => false


   		);





   		$data['breadcrumbs'][] = array(


       		'text'      => $this->language->get('heading_title'),


			'href'      => $this->url->link('pages/gallery', 'token=' . $this->session->data['token'], 'SSL'),


      		'separator' => ' :: '


   		);


		


		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}


		


    	$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('pages/about', $data));


	


	}


}


?>