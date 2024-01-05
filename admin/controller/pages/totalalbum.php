<?php

class ControllerPagesTotalAlbum extends Controller {

	public function index() {

		$this->load->language('pages/totalalbum');



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_view'] = $this->language->get('text_view');



		$data['token'] = $this->session->data['token'];



		// Total Orders

		$this->load->model('property/addphotos');

		

		$data['totalphoto'] = $this->model_property_addphotos->getTotaladdphotoss();



		$data['viewphoto'] = $this->url->link('pages/addphotos', 'token=' . $this->session->data['token'], 'SSL');



		return $this->load->view('pages/totalalbum', $data);

	}

}

