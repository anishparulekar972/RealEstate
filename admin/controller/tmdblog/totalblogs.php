<?php
class ControllerTmdBlogTotalBlogs extends Controller {
	public function index() {
		$this->load->language('tmdblog/totalblogs');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		$this->load->model('tmdblog/blog');

		$data['totalblog'] = $this->model_tmdblog_blog->getTotalTmdBlog();

		$data['viewblog'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('tmdblog/totalblogs', $data);
	}
}
