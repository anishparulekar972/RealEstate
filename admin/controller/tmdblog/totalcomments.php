<?php
class ControllerTmdBlogTotalcomments extends Controller {
	public function index() {
		$this->load->language('tmdblog/totalcomments');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('tmdblog/blogcomment');
		
		$data['totalcomment'] = $this->model_tmdblog_blogcomment->getTotalTmdblogcomment();
		
		$data['viewcomment'] = $this->url->link('tmdblog/totalcomments', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('tmdblog/totalcomments', $data);
	}
}
