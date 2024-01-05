<?php
class ControllerTmdBlogBlogdashboard extends Controller {
	public function index() {
		$this->load->language('tmdblog/blogdashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_sale'] = $this->language->get('text_sale');
		
		$data['text_activity'] = $this->language->get('text_activity');
		$data['text_recent'] = $this->language->get('text_recent');
		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('tmdblog/blogdashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('tmdblog/blogdashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}

		$data['token'] = $this->session->data['token'];
		
		$data['dashmenu'] = $this->load->controller('tmdblog/dashmenu');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['categories'] = $this->load->controller('tmdblog/totalblogcategory');
		$data['totalblogs'] = $this->load->controller('tmdblog/totalblogs');
		$data['comments'] = $this->load->controller('tmdblog/totalcomments');
		
		$data['recentposts'] = $this->load->controller('tmdblog/recentblog');
		$data['footer'] = $this->load->controller('common/footer');

		// Run currency update
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');

			$this->model_localisation_currency->refresh();
		}
			
		$this->response->setOutput($this->load->view('tmdblog/blogdashboard', $data));
	}
}
