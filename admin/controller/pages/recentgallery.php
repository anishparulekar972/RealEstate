<?php

class ControllerPagesRecentgallery extends Controller {

	public function index() {

		$this->load->language('pages/recentgallery');



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_no_results'] = $this->language->get('text_no_results');

		

		$data['column_galleryid'] = $this->language->get('column_galleryid');

		$data['column_galleryname'] = $this->language->get('column_galleryname');

		$data['column_totalalbum'] = $this->language->get('column_totalalbum');

		$data['column_status'] = $this->language->get('column_status');

		$data['column_action'] = $this->language->get('column_action');

		$data['button_view'] = $this->language->get('button_view');



		$data['token'] = $this->session->data['token'];



		$url='';

		$this->load->model('property/gallery');

		$data['recentgallerys'] = array();

		

		

		$results = $this->model_property_gallery->getRecentGallery();

		

		foreach ($results as $result) {

			

			$total=$this->model_property_gallery->getTotalalbum($result['album_id']);

			

			$data['recentgallerys'][] = array(				

			'album_id' => $result['album_id'],

			'name'   => $result['name'],

			'total'  => $total,

			'status' => $result['status'],

			'href' => $this->url->link('pages/gallery', 'token=' . $this->session->data['token'] . '&album_id=' . $result['album_id'] . $url, 'SSL'),

		);

		}



		return $this->load->view('pages/recentgallery', $data);

	}

}

