<?php

class ControllerPagesTotalgallery extends Controller {

		public function index() {

		$this->load->language('pages/totalgallery');



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_view'] = $this->language->get('text_view');



		$data['token'] = $this->session->data['token'];



		// Total Orders

		$this->load->model('property/gallery');

		

		$data['totalgallery'] = $this->model_property_gallery->getTotalgallaries();



		$data['viewgallery'] = $this->url->link('pages/gallery', 'token=' . $this->session->data['token'], 'SSL');



		return $this->load->view('pages/totalgallery', $data);

	}

}

