<?php


class ControllerExtensionModuleNewslettersubscribe extends Controller {


	private $error = array(); 


	


	public function index() {   


	


		$this->load->language('extension/module/newslettersubscribe');





		$this->document->setTitle($this->language->get('heading_title1'));


		


		$this->load->model('extension/module');


				


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {


			if (!isset($this->request->get['module_id'])) {


				$this->model_extension_module->addModule('newslettersubscribe', $this->request->post);


			} else {


				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);


			}





			$this->session->data['success'] = $this->language->get('text_success');





			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));


		}


				


		$data['heading_title'] = $this->language->get('heading_title');





		$data['text_yes'] = $this->language->get('text_yes');


		$data['text_no'] = $this->language->get('text_no');


		$data['text_enabled'] = $this->language->get('text_enabled');


		$data['text_disabled'] = $this->language->get('text_disabled');


		$data['text_content_top'] = $this->language->get('text_content_top');


		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		


		$data['text_column_left'] = $this->language->get('text_column_left');


		$data['text_column_right'] = $this->language->get('text_column_right');


		


		$data['entry_admin'] = $this->language->get('entry_admin');


		$data['entry_name'] = $this->language->get('entry_name');


		$data['entry_layout'] = $this->language->get('entry_layout');


		$data['entry_position'] = $this->language->get('entry_position');


		$data['entry_status'] = $this->language->get('entry_status');


		$data['entry_sort_order'] = $this->language->get('entry_sort_order');


		$data['entry_unsubscribe'] = $this->language->get('entry_unsubscribe');


		$data['entry_popup'] = $this->language->get('entry_popup');


		$data['entry_registered'] = $this->language->get('entry_registered');	


		$data['entry_mail'] = $this->language->get('entry_mail');


		$data['entry_options'] = $this->language->get('entry_options');


		$data['entry_text_color'] = $this->language->get('entry_text_color');


		$data['entry_text_color1'] = $this->language->get('entry_text_color1');


		$data['entry_bgtop_color'] = $this->language->get('entry_bgtop_color');


		$data['entry_bgbottom_color'] = $this->language->get('entry_bgbottom_color');


		$data['entry_border_color'] = $this->language->get('entry_border_color');


		$data['entry_text'] = $this->language->get('entry_text');


		$data['entry_hover_color'] = $this->language->get('entry_hover_color');


		$data['entry_container_color'] = $this->language->get('entry_container_color');


		$data['text_edit'] = $this->language->get('text_edit');


			


		$data['help_name'] = $this->language->get('help_name');		


		$data['help_status'] = $this->language->get('help_status');		


		$data['help_popup'] = $this->language->get('help_popup');		


		$data['help_unsubscribe'] = $this->language->get('help_unsubscribe');		


		$data['help_text'] = $this->language->get('help_text');


		$data['help_text_color'] = $this->language->get('help_text_color');		


		$data['help_text_color1'] = $this->language->get('help_text_color1');		


		$data['help_bgtop'] = $this->language->get('help_bgtop');		


		$data['help_bgbottom'] = $this->language->get('help_bgbottom');		


		$data['help_border'] = $this->language->get('help_border');		


		$data['help_hover'] = $this->language->get('help_hover');		


		$data['help_container'] = $this->language->get('help_container');		


		


		$data['button_save'] = $this->language->get('button_save');


		$data['button_cancel'] = $this->language->get('button_cancel');


		$data['button_add_module'] = $this->language->get('button_add_module');


		$data['button_remove'] = $this->language->get('button_remove');


		$data['login'] = $this->url->link('account/login');


		


		$data['tab_general'] = $this->language->get('tab_general');


		$data['tab_data'] = $this->language->get('tab_data');


		$data['tab_design'] = $this->language->get('tab_design');


		


 		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}


		


		if (isset($this->error['name'])) {


			$data['error_name'] = $this->error['name'];


		} else {


			$data['error_name'] = '';


		}





  		$data['breadcrumbs'] = array();





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_home'),


			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')


		);





		$data['breadcrumbs'][] = array(


			'text' => $this->language->get('text_module'),


			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')


		);





		if (!isset($this->request->get['module_id'])) {


			$data['breadcrumbs'][] = array(


				'text' => $this->language->get('heading_title'),


				'href' => $this->url->link('extension/module/newslettersubscribe', 'token=' . $this->session->data['token'], 'SSL')


			);


		} else {


			$data['breadcrumbs'][] = array(


				'text' => $this->language->get('heading_title'),


				'href' => $this->url->link('extension/module/newslettersubscribe', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')


			);			


		}


		


		if (!isset($this->request->get['module_id'])) {


			$data['action'] = $this->url->link('extension/module/newslettersubscribe', 'token=' . $this->session->data['token'], 'SSL');


		} else {


			$data['action'] = $this->url->link('extension/module/newslettersubscribe', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');


		}


		


		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);





		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {


			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);


		}	


			


		if (isset($this->request->post['name'])) {


			$data['name'] = $this->request->post['name'];


		} elseif (!empty($module_info)) {


			$data['name'] = $module_info['name'];


		} else {


			$data['name'] = '';


		}


		if (isset($this->request->post['pupbutoncolor'])) {


			$data['pupbutoncolor'] = $this->request->post['pupbutoncolor'];


		} elseif (isset($module_info['pupbutoncolor'])) {


			$data['pupbutoncolor'] = $module_info['pupbutoncolor'];


		} else {


			$data['pupbutoncolor'] = '';


		}


		if (isset($this->request->post['newstext_color'])) {


			$data['newstext_color'] = $this->request->post['newstext_color'];


		} elseif (isset($module_info['newstext_color'])) {


			$data['newstext_color'] = $module_info['newstext_color'];


		} else {


			$data['newstext_color'] = '';


		}


		if (isset($this->request->post['newstextnopop_color'])) {


			$data['newstextnopop_color'] = $this->request->post['newstextnopop_color'];


		} elseif (isset($module_info['newstextnopop_color'])) {


			$data['newstextnopop_color'] = $module_info['newstextnopop_color'];


		} else {


			$data['newstextnopop_color'] = '';


		}


		if (isset($this->request->post['butontextcolor'])) {


			$data['butontextcolor'] = $this->request->post['butontextcolor'];


		} elseif (isset($module_info['butontextcolor'])) {


			$data['butontextcolor'] = $module_info['butontextcolor'];


		} else {


			$data['butontextcolor'] = '';


		}


		if (isset($this->request->post['buttonbg'])) {


			$data['buttonbg'] = $this->request->post['buttonbg'];


		} elseif (isset($module_info['buttonbg'])) {


			$data['buttonbg'] = $module_info['buttonbg'];


		} else {


			$data['buttonbg'] = '';


		}


		if (isset($this->request->post['newslatertext'])) {


			$data['newslatertext'] = $this->request->post['newslatertext'];


		} elseif (isset($module_info['newslatertext'])) {


			$data['newslatertext'] = $module_info['newslatertext'];


		} else {


			$data['newslatertext'] = '';


		}


		if (isset($this->request->post['newsbutonhover'])) {


			$data['newsbutonhover'] = $this->request->post['newsbutonhover'];


		} elseif (isset($module_info['newsbutonhover'])) {


			$data['newsbutonhover'] = $module_info['newsbutonhover'];


		} else {


			$data['newsbutonhover'] = '';


		}


		if (isset($this->request->post['containerbg'])) {


			$data['containerbg'] = $this->request->post['containerbg'];


		} elseif (isset($module_info['containerbg'])) {


			$data['containerbg'] = $module_info['containerbg'];


		} else {


			$data['containerbg'] = '';


		}


				


		if (isset($this->request->post['option_unsubscribe'])) {


			$data['option_unsubscribe'] = $this->request->post['option_unsubscribe'];


		} elseif (!empty($module_info)) {


			$data['option_unsubscribe'] = $module_info['option_unsubscribe'];


		}else {


			$data['option_unsubscribe'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_registered'])) {


			$data['newslettersubscribe_registered'] = $this->request->post['newslettersubscribe_registered'];


		}elseif (!empty($module_info)) {


			$data['newslettersubscribe_registered'] = $module_info['newslettersubscribe_registered'];


		} else {


			$data['newslettersubscribe_registered'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_mail_status'])) {


			$data['newslettersubscribe_mail_status'] = $this->request->post['newslettersubscribe_mail_status'];


		} elseif (!empty($module_info)) {


			$data['newslettersubscribe_mail_status'] = $module_info['newslettersubscribe_mail_status'];


		}else {


			$data['newslettersubscribe_mail_status'] = '';


		}


		


		/* if (isset($this->request->post['newslettersubscribe_thickbox'])) {


			$data['newslettersubscribe_thickbox'] = $this->request->post['newslettersubscribe_thickbox'];


		} elseif (!empty($module_info)) {


			$data['newslettersubscribe_thickbox'] = $module_info['newslettersubscribe_thickbox'];


		}else {


			$data['newslettersubscribe_thickbox'] = '1';


		} */


		


		if (isset($this->request->post['newslettersubscribe_popup'])) {


			$data['newslettersubscribe_popup'] = $this->request->post['newslettersubscribe_popup'];


		} elseif (!empty($module_info)) {


			$data['newslettersubscribe_popup'] = $module_info['newslettersubscribe_popup'];


		}else {


			$data['newslettersubscribe_popup'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_option_field'])){


			$data['newslettersubscribe_option_field'] = $this->request->post['newslettersubscribe_option_field'];


		} elseif (!empty($module_info)) {


			$data['newslettersubscribe_option_field'] = $module_info['newslettersubscribe_option_field'];


		}else {


			$data['newslettersubscribe_option_field'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_option_field1'])) {


			$data['newslettersubscribe_option_field1'] = $this->request->post['newslettersubscribe_option_field1'];


		}elseif (!empty($module_info['newslettersubscribe_option_field1'])){


			$data['newslettersubscribe_option_field1'] = $module_info['newslettersubscribe_option_field1'];


		} else {


			$data['newslettersubscribe_option_field1'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_option_field2'])) {


			$data['newslettersubscribe_option_field2'] = $this->request->post['newslettersubscribe_option_field2'];


		}elseif(!empty($module_info['newslettersubscribe_option_field2'])){


			$data['newslettersubscribe_option_field2'] = $module_info['newslettersubscribe_option_field2'];


		} else {


			$data['newslettersubscribe_option_field2'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_option_field3'])) {


			$data['newslettersubscribe_option_field3'] = $this->request->post['newslettersubscribe_option_field3'];


		}elseif(!empty($module_info['newslettersubscribe_option_field3'])){


			$data['newslettersubscribe_option_field3'] = $module_info['newslettersubscribe_option_field3'];


		} else {


			$data['newslettersubscribe_option_field3'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_option_field4'])) {


			$data['newslettersubscribe_option_field4'] = $this->request->post['newslettersubscribe_option_field4'];


		}elseif (!empty($module_info['newslettersubscribe_option_field4'])){


			$data['newslettersubscribe_option_field4'] = $module_info['newslettersubscribe_option_field4'];


		} else {


			$data['newslettersubscribe_option_field4'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_option_field5'])) {


			$data['newslettersubscribe_option_field5'] = $this->request->post['newslettersubscribe_option_field5'];


		}elseif (!empty($module_info['newslettersubscribe_option_field5'])){


			$data['newslettersubscribe_option_field5'] = $module_info['newslettersubscribe_option_field5'];


		} else {


			$data['newslettersubscribe_option_field5'] = '';


		}


		


		if (isset($this->request->post['newslettersubscribe_option_field6'])) {


			$data['newslettersubscribe_option_field6'] = $this->request->post['newslettersubscribe_option_field6'];


		}elseif (!empty($module_info['newslettersubscribe_option_field6'])){


			$data['newslettersubscribe_option_field6'] = $module_info['newslettersubscribe_option_field6'];


		} else {


			$data['newslettersubscribe_option_field6'] = '';


		}	


		


		


		if (isset($this->request->post['newslettersubscribe_status'])) {


			$data['newslettersubscribe_status'] = $this->request->post['status'];


		}elseif(!empty($module_info)){


			$data['newslettersubscribe_status'] = $module_info['status'];


		} else {


			$data['newslettersubscribe_status'] = '';


		}


		


		$data['header'] = $this->load->controller('common/header');


		$data['column_left'] = $this->load->controller('common/column_left');


		$data['footer'] = $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('extension/module/newslettersubscribe', $data));


	}


	


	private function validate() {


		if (!$this->user->hasPermission('modify', 'extension/module/newslettersubscribe')) {


			$this->error['warning'] = $this->language->get('error_permission');


		}


		


		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {


			$this->error['name'] = $this->language->get('error_name');


		}


		


		return !$this->error;


	}


}


?>