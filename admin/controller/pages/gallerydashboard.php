<?php

class ControllerPagesGallerydashboard extends Controller {

	public function index() {

		$this->load->language('pages/gallerydashboard');



		$this->document->setTitle($this->language->get('heading_title'));



		$data['heading_title'] = $this->language->get('heading_title');



		$data['text_sale'] = $this->language->get('text_sale');

		

		$data['text_activity'] = $this->language->get('text_activity');

		$data['text_recent'] = $this->language->get('text_recent');

		$data['text_dash'] = $this->language->get('text_dash');

		$data['text_gallery'] = $this->language->get('text_gallery');

		$data['text_photo'] = $this->language->get('text_photo');

		$data['text_about'] = $this->language->get('text_about');

		$data['text_sett'] = $this->language->get('text_sett');

		$data['text_addmodule'] = $this->language->get('text_addmodule');

		$data['dashmenu'] = $this->load->controller('pages/dashmenu');

		$data['breadcrumbs'] = array();



		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),

			'href' => $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], 'SSL')

		);



		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),

			'href' => $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], 'SSL')

		);

		

		// Check install directory exists

		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {

			$data['error_install'] = $this->language->get('error_install');

		} else {

			$data['error_install'] = '';

		}



		$data['token'] = $this->session->data['token'];

		

		$data['dashboard'] = $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], 'SSL');

		$data['addmodule'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['gallery'] = $this->url->link('pages/gallery', 'token=' . $this->session->data['token'], 'SSL');

		$data['photo'] = $this->url->link('pages/tmdgallerycategory', 'token=' . $this->session->data['token'], 'SSL');

		$data['setting'] = $this->url->link('pages/artical', 'token=' . $this->session->data['token'], 'SSL');

		$data['about'] = $this->url->link('pages/artical', 'token=' . $this->session->data['token'], 'SSL');

		

		

		$data['header'] = $this->load->controller('common/header');

		$data['column_left'] = $this->load->controller('common/column_left');

		$data['totalgallery'] = $this->load->controller('pages/totalgallery');

		$data['totalalbum'] = $this->load->controller('pages/totalalbum');

		

		

		$data['recentgallery'] = $this->load->controller('pages/recentgallery');

		$data['footer'] = $this->load->controller('common/footer');



		// Run currency update

		if ($this->config->get('config_currency_auto')) {

			$this->load->model('localisation/currency');



			$this->model_localisation_currency->refresh();

		}

			

		$this->response->setOutput($this->load->view('pages/gallerydashboard', $data));

	}

}

