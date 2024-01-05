<?php
class ControllerCommonTheme extends Controller {
	private $error = array();
	public function index() {
		$this->load->model('setting/setting');
		$this->load->language('common/theme');
		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] 			= $this->language->get('heading_title');
		$data['text_edit'] 				= $this->language->get('text_edit');
		$data['text_form'] 				= $this->language->get('text_form');
		$data['text_default']           = $this->language->get('text_default');
		$data['text_enable']            = $this->language->get('text_enable');
		$data['text_disable']           = $this->language->get('text_disable');
		$data['text_select']            = $this->language->get('text_select');
		$data['text_none'] 				= $this->language->get('text_none');
		$data['text_header1'] 			= $this->language->get('text_header1');
		$data['text_header2'] 			= $this->language->get('text_header2');
		$data['text_header3'] 			= $this->language->get('text_header3');
		$data['text_header4'] 			= $this->language->get('text_header4');
		$data['text_header5'] 			= $this->language->get('text_header5');
		$data['text_footer1'] 			= $this->language->get('text_footer1');
		$data['text_footer2'] 			= $this->language->get('text_footer2');
		$data['text_footer3'] 			= $this->language->get('text_footer3');
		$data['text_footer4'] 			= $this->language->get('text_footer4');
		$data['text_agent1'] 			= $this->language->get('text_agent1');
		$data['text_agent2'] 			= $this->language->get('text_agent2');
		$data['text_agent3'] 			= $this->language->get('text_agent3');
		$data['text_proprties1'] 		= $this->language->get('text_proprties1');
		$data['text_proprties2'] 		= $this->language->get('text_proprties2');
		$data['text_proprties3'] 		= $this->language->get('text_proprties3');
		$data['text_search1'] 			= $this->language->get('text_search1');
		$data['text_search2'] 			= $this->language->get('text_search2');
		$data['text_search3'] 			= $this->language->get('text_search3');

		$data['tab_setting']            = $this->language->get('tab_setting');
		$data['tab_header']             = $this->language->get('tab_header');
		$data['tab_footer']             = $this->language->get('tab_footer');
		$data['tab_search']             = $this->language->get('tab_search');
		$data['tab_prolayout']          = $this->language->get('tab_prolayout');
		$data['tab_agent']              = $this->language->get('tab_agent');
		$data['tab_properites']         = $this->language->get('tab_properites');
		$data['tab_socialmedia'] 		= $this->language->get('tab_socialmedia');

		$data['lable_name']             = $this->language->get('lable_name');
		$data['lable_footericon'] 		= $this->language->get('lable_footericon');
		$data['lable_fburl'] 			= $this->language->get('lable_fburl');
		$data['lable_google'] 			= $this->language->get('lable_google');
		$data['lable_twet'] 			= $this->language->get('lable_twet');
		$data['lable_in'] 				= $this->language->get('lable_in');
		$data['lable_instagram'] 		= $this->language->get('lable_instagram');
		$data['lable_pinterest'] 		= $this->language->get('lable_pinterest');
		$data['lable_youtube'] 			= $this->language->get('lable_youtube');
		$data['lable_blogger'] 			= $this->language->get('lable_blogger');
		$data['lable_address2'] 		= $this->language->get('lable_address2');
		$data['lable_title'] 			= $this->language->get('lable_title');
		$data['lable_aboutdes'] 		= $this->language->get('lable_aboutdes');
		$data['lable_phoneno'] 			= $this->language->get('lable_phoneno');
		$data['lable_mobile'] 			= $this->language->get('lable_mobile');
		$data['lable_email'] 			= $this->language->get('lable_email');
		$data['lable_twittercode'] 		= $this->language->get('lable_twittercode');

		$data['entry_footericon'] 		= $this->language->get('entry_footericon');
		$data['entry_fburl'] 			= $this->language->get('entry_fburl');
		$data['entry_google'] 			= $this->language->get('entry_google');
		$data['entry_twet'] 			= $this->language->get('entry_twet');
		$data['entry_in'] 				= $this->language->get('entry_in');
		$data['entry_instagram'] 		= $this->language->get('entry_instagram');
		$data['entry_pinterest'] 		= $this->language->get('entry_pinterest');
		$data['entry_youtube'] 			= $this->language->get('entry_youtube');
		$data['entry_blogger'] 			= $this->language->get('entry_blogger');
		$data['entry_address2'] 		= $this->language->get('entry_address2');
		$data['entry_title'] 			= $this->language->get('entry_title');
		$data['entry_aboutdes'] 		= $this->language->get('entry_aboutdes');
		$data['entry_phoneno'] 			= $this->language->get('entry_phoneno');
		$data['entry_mobile'] 			= $this->language->get('entry_mobile');
		$data['entry_email'] 			= $this->language->get('entry_email');
		$data['entry_twittercode'] 		= $this->language->get('entry_twittercode');

		$data['help_category'] 			= $this->language->get('help_category');
		$data['token']                  = $this->session->data['token'];

		$data['button_save'] 			= $this->language->get('button_save');
		$data['button_remove'] 			= $this->language->get('button_remove');
		$data['button_add'] 			= $this->language->get('button_add');
		$data['button_cancel'] 			= $this->language->get('button_cancel');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('tmdrealstate', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('common/theme', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/theme', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('common/theme', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('common/theme', 'token=' . $this->session->data['token'], true);

		$data['token'] = $this->session->data['token'];
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		///// Setting /////

		if (isset($this->request->post['tmdrealstate_layout'])) {


			$data['tmdrealstate_layout'] = $this->request->post['tmdrealstate_layout'];


		} else {


			$data['tmdrealstate_layout'] = $this->config->get('tmdrealstate_layout');


		}


		


		if (isset($this->request->post['tmdrealstate_header'])) {


			$data['tmdrealstate_header'] = $this->request->post['tmdrealstate_header'];


		} else {


			$data['tmdrealstate_header'] = $this->config->get('tmdrealstate_header');


		}


		


		if (isset($this->request->post['tmdrealstate_footer'])) {


			$data['tmdrealstate_footer'] = $this->request->post['tmdrealstate_footer'];


		} else {


			$data['tmdrealstate_footer'] = $this->config->get('tmdrealstate_footer');


		}


		


		if (isset($this->request->post['tmdrealstate_prolayout'])) {


			$data['tmdrealstate_prolayout'] = $this->request->post['tmdrealstate_prolayout'];


		} else {


			$data['tmdrealstate_prolayout'] = $this->config->get('tmdrealstate_prolayout');


		}


		


		if (isset($this->request->post['tmdrealstate_search'])) {


			$data['tmdrealstate_search'] = $this->request->post['tmdrealstate_search'];


		} else {


			$data['tmdrealstate_search'] = $this->config->get('tmdrealstate_search');


		}


		


		if (isset($this->request->post['tmdrealstate_aboutdes'])) {


			$data['tmdrealstate_aboutdes'] = $this->request->post['tmdrealstate_aboutdes'];


		} else {


			$data['tmdrealstate_aboutdes'] = $this->config->get('tmdrealstate_aboutdes');


		}


		


		


		if (isset($this->request->post['tmdrealstate_title'])) {


			$data['tmdrealstate_title'] = $this->request->post['tmdrealstate_title'];


		} else {


			$data['tmdrealstate_title'] = $this->config->get('tmdrealstate_title');


		}


		


		if (isset($this->request->post['tmdrealstate_phoneno'])) {


			$data['tmdrealstate_phoneno'] = $this->request->post['tmdrealstate_phoneno'];


		} else {


			$data['tmdrealstate_phoneno'] = $this->config->get('tmdrealstate_phoneno');


		}


		


		if (isset($this->request->post['tmdrealstate_mobile '])) {


			$data['tmdrealstate_mobile'] = $this->request->post['tmdrealstate_mobile'];


		} else {


			$data['tmdrealstate_mobile'] = $this->config->get('tmdrealstate_mobile');


		}


		


		


		if (isset($this->request->post['tmdrealstate_email_soci '])) {


			$data['tmdrealstate_email_soci'] = $this->request->post['tmdrealstate_email_soci'];


		} else {


			$data['tmdrealstate_email_soci'] = $this->config->get('tmdrealstate_email_soci');


		}


		


		


		if (isset($this->request->post['tmdrealstate_address2'])) {


			$data['tmdrealstate_address2'] = $this->request->post['tmdrealstate_address2'];


		} else {


			$data['tmdrealstate_address2'] = $this->config->get('tmdrealstate_address2');


		}


		


		


		if (isset($this->request->post['tmdrealstate_fburl'])) {


			$data['tmdrealstate_fburl'] = $this->request->post['tmdrealstate_fburl'];


		} else {


			$data['tmdrealstate_fburl'] = $this->config->get('tmdrealstate_fburl');


		}


		


		if (isset($this->request->post['tmdrealstate_google'])) {


			$data['tmdrealstate_google'] = $this->request->post['tmdrealstate_google'];


		} else {


			$data['tmdrealstate_google'] = $this->config->get('tmdrealstate_google');


		}


		


		


		if (isset($this->request->post['tmdrealstate_twet'])) {


			$data['tmdrealstate_twet'] = $this->request->post['tmdrealstate_twet'];


		} else {


			$data['tmdrealstate_twet'] = $this->config->get('tmdrealstate_twet');


		}


		


		


		


		


		if (isset($this->request->post['tmdrealstate_in'])) {


			$data['tmdrealstate_in'] = $this->request->post['tmdrealstate_in'];


		} else {


			$data['tmdrealstate_in'] = $this->config->get('tmdrealstate_in');


		}


		


		


		if (isset($this->request->post['tmdrealstate_instagram'])) {


			$data['tmdrealstate_instagram'] = $this->request->post['tmdrealstate_instagram'];


		} else {


			$data['tmdrealstate_instagram'] = $this->config->get('tmdrealstate_instagram');


		}








		


		if (isset($this->request->post['tmdrealstate_pinterest'])) {


			$data['tmdrealstate_pinterest'] = $this->request->post['tmdrealstate_pinterest'];


		} else {


			$data['tmdrealstate_pinterest'] = $this->config->get('tmdrealstate_pinterest');


		}











		


		if (isset($this->request->post['tmdrealstate_youtube'])) {


			$data['tmdrealstate_youtube'] = $this->request->post['tmdrealstate_youtube'];


		} else {


			$data['tmdrealstate_youtube'] = $this->config->get('tmdrealstate_youtube');


		}





		


		if (isset($this->request->post['tmdrealstate_blogger'])) {


			$data['tmdrealstate_blogger'] = $this->request->post['tmdrealstate_blogger'];


		} else {


			$data['tmdrealstate_blogger'] = $this->config->get('tmdrealstate_blogger');


		}


		


			if (isset($this->request->post['tmdrealstate_footericon'])) {


				$data['tmdrealstate_footericon'] = $this->request->post['tmdrealstate_footericon'];


			} else {


				$data['tmdrealstate_footericon'] = $this->config->get('tmdrealstate_footericon');


			}


			


			if (isset($this->request->post['tmdrealstate_twittercode'])) {


				$data['tmdrealstate_twittercode'] = $this->request->post['tmdrealstate_twittercode'];


			} else {


				$data['tmdrealstate_twittercode'] = $this->config->get('tmdrealstate_twittercode');


			}


			





		


		$this->load->model('tool/image');


			if (isset($this->request->post['tmdrealstate_footericon']) && is_file(DIR_IMAGE . $this->request->post['tmdrealstate_footericon'])) {


				$data['thumb'] = $this->model_tool_image->resize($this->request->post['tmdrealstate_footericon'], 100, 100);


			} elseif ($this->config->get('tmdrealstate_footericon') && is_file(DIR_IMAGE . $this->config->get('tmdrealstate_footericon'))) {


				$data['thumb'] = $this->model_tool_image->resize($this->config->get('tmdrealstate_footericon'), 100, 100);


			} else {


				$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


			}





			$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);





		


		if (isset($this->request->post['tmdrealstate_properites'])) {


			$data['tmdrealstate_properites'] = $this->request->post['tmdrealstate_properites'];


		} else {


			$data['tmdrealstate_properites'] = $this->config->get('tmdrealstate_properites');


		}


		


		if (isset($this->request->post['tmdrealstate_agent'])) {


			$data['tmdrealstate_agent'] = $this->request->post['tmdrealstate_agent'];


		} else {


			$data['tmdrealstate_agent'] = $this->config->get('tmdrealstate_agent');


		}


		if (isset($this->request->post['tmdrealstate_theme'])) {
			$data['tmdrealstate_theme'] = $this->request->post['tmdrealstate_theme'];
		} else {
			$data['tmdrealstate_theme'] = $this->config->get('tmdrealstate_theme');
		}


		if (isset($this->error['warning'])) {


			$data['error_warning'] = $this->error['warning'];


		} else {


			$data['error_warning'] = '';


		}





		if (isset($this->session->data['success'])) {


			$data['success'] = $this->session->data['success'];


			unset($this->session->data['success']);


		} else {


			$data['success'] = '';


		}





		$data['header'] 		= $this->load->controller('common/header');


		$data['column_left'] 	= $this->load->controller('common/column_left');


		$data['footer'] 		= $this->load->controller('common/footer');





		$this->response->setOutput($this->load->view('common/theme.tpl', $data));


	}


	protected function validate() {


		


	if (!$this->user->hasPermission('modify','common/theme')) {


			$this->error['warning'] = $this->language->get('error_permission');


	}


	


	return !$this->error;


}


}


