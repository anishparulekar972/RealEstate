<?php


class ControllerPagesDashmenu extends Controller {


	public function index() {


		$this->load->language('pages/dashmenu');





		$data['text_dash'] = $this->language->get('text_dash');


		$data['text_gallery'] = $this->language->get('text_gallery');


		$data['text_photo'] = $this->language->get('text_photo');


		$data['text_sett'] = $this->language->get('text_sett');


		$data['text_addmodule'] = $this->language->get('text_addmodule');


		$data['text_about'] = $this->language->get('text_about');





		$data['token'] = $this->session->data['token'];


		


		$data['gallerysetting'] = $this->url->link('pages/tmdgallerysetting', 'token=' . $this->session->data['token'], 'SSL');


		$data['galleryphoto'] = $this->url->link('pages/addphotos', 'token=' . $this->session->data['token'], 'SSL');


		$data['dashboard'] = $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], 'SSL');


		$data['gallery'] = $this->url->link('pages/gallery', 'token=' . $this->session->data['token'], 'SSL');


		$data['addmodule'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');


		$data['about'] = $this->url->link('pages/about', 'token=' . $this->session->data['token'], 'SSL');


		


		$data['dashboard_menu']=false;


		$data['gallery_menu']=false;


		$data['photo_menu']=false;


		$data['setting_menu']=false;				


		$data['module_menu']=false;				


		$data['about_menu']=false;				


		if(isset($this->request->get['route']) && $this->request->get['route']=='pages/blogdashboard')


		{


		 $data['dashboard_menu']=true;


		}


		


		if(!isset($this->request->get['route']))


		{


		 $data['dashboard_menu']=true;


		}


		


		if(isset($this->request->get['route']) && $this->request->get['route']=='pages/gallery')


		{


		$data['gallery_menu']=true;


		}


		


		if(isset($this->request->get['route']) && $this->request->get['route']=='pages/about')


		{


		$data['about_menu']=true;


		}


		


		if(isset($this->request->get['route']) && $this->request->get['route']=='pages/addphotos'){


		$data['photo_menu']=true;


		}


		


		if(isset($this->request->get['route']) && $this->request->get['route']=='pages/tmdgallerysetting'){


		$data['setting_menu']=true;


		}


		if(isset($this->request->get['route']) && $this->request->get['route']=='extension/module'){


		$data['module_menu']=true;


		}


		


		return $this->load->view('pages/dashmenu', $data);


	}


}


