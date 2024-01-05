<?php
class ControllerTmdBlogTotalblogcategory extends Controller {
		public function index() {
		$this->load->language('tmdblog/totalblogcategory');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('tmdblog/tmdblogcategory');
		
		$data['totalblogcategory'] = $this->model_tmdblog_tmdblogcategory->getTotalTmdblogcategories();

		$data['viewtmdblogcategory'] = $this->url->link('tmdblog/tmdblogcategory', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('tmdblog/totalblogcategory', $data);
	}
}
