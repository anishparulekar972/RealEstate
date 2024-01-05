<?php
class ControllerTmdBlogDashmenu extends Controller {
	public function index() {
		$this->load->language('tmdblog/dashmenu');

		$data['text_dash'] = $this->language->get('text_dash');
		$data['text_blog'] = $this->language->get('text_blog');
		$data['text_cate'] = $this->language->get('text_cate');
		$data['text_comm'] = $this->language->get('text_comm');
		$data['text_sett'] = $this->language->get('text_sett');
		$data['text_addmodule'] = $this->language->get('text_addmodule');

		$data['token'] = $this->session->data['token'];
		
		$data['tmdblogsetting'] = $this->url->link('tmdblog/tmdblogsetting', 'token=' . $this->session->data['token'], 'SSL');
		$data['blogcategory'] = $this->url->link('tmdblog/tmdblogcategory', 'token=' . $this->session->data['token'], 'SSL');
		$data['dashboard'] = $this->url->link('tmdblog/blogdashboard', 'token=' . $this->session->data['token'], 'SSL');
		$data['blog'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'], 'SSL');
		$data['comment'] = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'], 'SSL');
		$data['addmodule'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
		$data['dashboard_menu']=false;
		$data['blogs_menu']=false;
		$data['category_menu']=false;
		$data['comment_menu']=false;
		$data['setting_menu']=false;				
		$data['module_menu']=false;				
		if(isset($this->request->get['route']) && $this->request->get['route']=='tmdblog/blogdashboard')
		{
		 $data['dashboard_menu']=true;
		}
		
		if(!isset($this->request->get['route']))
		{
		 $data['dashboard_menu']=true;
		}
		
		if(isset($this->request->get['route']) && $this->request->get['route']=='tmdblog/blog')
		{
		$data['blogs_menu']=true;
		}
		
		if(isset($this->request->get['route']) && $this->request->get['route']=='tmdblog/tmdblogcategory'){
		$data['category_menu']=true;
		}
		if(isset($this->request->get['route']) && $this->request->get['route']=='tmdblog/blogcomment'){
		$data['comment_menu']=true;
		}
		if(isset($this->request->get['route']) && $this->request->get['route']=='tmdblog/tmdblogsetting'){
		$data['setting_menu']=true;
		}
		if(isset($this->request->get['route']) && $this->request->get['route']=='extension/module'){
		$data['module_menu']=true;
		}
		
		return $this->load->view('tmdblog/dashmenu', $data);
	}
}
