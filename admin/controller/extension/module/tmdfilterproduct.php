<?php
class ControllerExtensionModuleTmdfilterProduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/tmdfilterproduct');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('tmdfilterproduct', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_tab'] = $this->language->get('text_tab');
		$data['text_vertcal'] = $this->language->get('text_vertcal');
		$data['text_normal'] = $this->language->get('text_normal');
		$data['text_crousal'] = $this->language->get('text_crousal');
		$data['text_verticrousl'] = $this->language->get('text_verticrousl');
		$data['text_tabcrousal'] = $this->language->get('text_tabcrousal');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_layouttype'] = $this->language->get('entry_layouttype');
		$data['entry_crousaltype'] = $this->language->get('entry_crousaltype');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_moduletitle'] = $this->language->get('entry_moduletitle');

		$data['help_product'] = $this->language->get('help_product');
		
		$data['tab_module'] = $this->language->get('tab_module');
		$data['tab_setting'] = $this->language->get('tab_setting');
		
		$data['tab_recentpost'] = $this->language->get('tab_recentpost');
		$data['tab_popular'] = $this->language->get('tab_popular');
		$data['tab_comment'] = $this->language->get('tab_comment');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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
		
		// recentpost module
		if (isset($this->error['recentpostwidth'])) {
			$data['error_recentpostwidth'] = $this->error['recentpostwidth'];
		} else {
			$data['error_recentpostwidth'] = '';
		}

		if (isset($this->error['recentpostheight'])) {
			$data['error_recentpostheight'] = $this->error['recentpostheight'];
		} else {
			$data['error_recentpostheight'] = '';
		}
		//// recentpost module
		
		// popular module
		if (isset($this->error['popularwidth'])) {
			$data['error_popularwidth'] = $this->error['popularwidth'];
		} else {
			$data['error_popularwidth'] = '';
		}

		if (isset($this->error['popularheight'])) {
			$data['error_popularheight'] = $this->error['popularheight'];
		} else {
			$data['error_popularheight'] = '';
		}
		//// popular module
		
		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/tmdfilterproduct', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/tmdfilterproduct', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/tmdfilterproduct', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('extension/module/tmdfilterproduct', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = 'Latest Posts Page';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '1';
		}

		if (isset($this->request->post['moduletitle'])) {
			$data['moduletitle'] = $this->request->post['moduletitle'];
		} elseif (!empty($module_info)) {
			$data['moduletitle'] = $module_info['moduletitle'];
		} else {
			$data['moduletitle'] = '';
		}
		
		
		///recentpost module//
		
			if (isset($this->request->post['recentpostlimit'])) {
			$data['recentpostlimit'] = $this->request->post['recentpostlimit'];
			} elseif (!empty($module_info)) {
				$data['recentpostlimit'] = $module_info['recentpostlimit'];
			} else {
				$data['recentpostlimit'] = '5';
			}
			
			if (isset($this->request->post['recentpostwidth'])) {
			$data['recentpostwidth'] = $this->request->post['recentpostwidth'];
			} elseif (!empty($module_info)) {
				$data['recentpostwidth'] = $module_info['recentpostwidth'];
			} else {
				$data['recentpostwidth'] = '80';
			}
			if (isset($this->request->post['recentpostheight'])) {
			$data['recentpostheight'] = $this->request->post['recentpostheight'];
			} elseif (!empty($module_info)) {
				$data['recentpostheight'] = $module_info['recentpostheight'];
			} else {
				$data['recentpostheight'] = '40';
			}
			if (isset($this->request->post['recentpoststatus'])) {
			$data['recentpoststatus'] = $this->request->post['recentpoststatus'];
			} elseif (!empty($module_info)) {
				$data['recentpoststatus'] = $module_info['recentpoststatus'];
			} else {
				$data['recentpoststatus'] = '1';
			}
			
			$this->load->model('localisation/language');

			$data['languages'] = $this->model_localisation_language->getLanguages();
			
			if (isset($this->request->post['module_title'])) {
				$data['module_title'] = $this->request->post['module_title'];
			} elseif (!empty($module_info)) {
				$data['module_title'] = $module_info['module_title'];
			} else {
				$data['module_title'] = array();
			}

		
			
		///recentpost module//

		///popular module//
		
			if (isset($this->request->post['popularlimit'])) {
			$data['popularlimit'] = $this->request->post['popularlimit'];
			} elseif (!empty($module_info)) {
				$data['popularlimit'] = $module_info['popularlimit'];
			} else {
				$data['popularlimit'] = '5';
			}
			
			if (isset($this->request->post['popularwidth'])) {
			$data['popularwidth'] = $this->request->post['popularwidth'];
			} elseif (!empty($module_info)) {
				$data['popularwidth'] = $module_info['popularwidth'];
			} else {
				$data['popularwidth'] = '80';
			}
			if (isset($this->request->post['popularheight'])) {
			$data['popularheight'] = $this->request->post['popularheight'];
			} elseif (!empty($module_info)) {
				$data['popularheight'] = $module_info['popularheight'];
			} else {
				$data['popularheight'] = '80';
			}
			if (isset($this->request->post['popularstatus'])) {
			$data['popularstatus'] = $this->request->post['popularstatus'];
			} elseif (!empty($module_info)) {
				$data['popularstatus'] = $module_info['popularstatus'];
			} else {
				$data['popularstatus'] = '1';
			}
			
			
		///popular module//
		
		///special module//
		
			if (isset($this->request->post['commentlimit'])) {
			$data['commentlimit'] = $this->request->post['commentlimit'];
			} elseif (!empty($module_info)) {
				$data['commentlimit'] = $module_info['commentlimit'];
			} else {
				$data['commentlimit'] = '5';
			}
			
			if (isset($this->request->post['commentstatus'])) {
			$data['commentstatus'] = $this->request->post['commentstatus'];
			} elseif (!empty($module_info)) {
				$data['commentstatus'] = $module_info['commentstatus'];
			} else {
				$data['commentstatus'] = '1';
			}
			
			
		///special module//

		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/tmdfilterproduct', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/tmdfilterproduct')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['recentpostwidth']) {
			$this->error['recentpostwidth'] = $this->language->get('error_recentpostwidth');
		}

		if (!$this->request->post['recentpostheight']) {
			$this->error['recentpostheight'] = $this->language->get('error_recentpostheight');
		}
		
		
		if (!$this->request->post['popularwidth']) {
			$this->error['popularwidth'] = $this->language->get('error_popularwidth');
		}

		if (!$this->request->post['popularheight']) {
			$this->error['popularheight'] = $this->language->get('error_popularheight');
		}
		
		return !$this->error;
	}
}
