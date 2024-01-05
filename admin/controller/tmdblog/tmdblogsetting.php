<?php
class ControllerTmdBlogTmdblogsetting extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tmdblog/tmdblogsetting');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_setting_setting->editSetting('tmdblogsetting', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('tmdblog/tmdblogsetting', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_top'] = $this->language->get('entry_top');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_titlesize'] = $this->language->get('entry_titlesize');
		$data['entry_titlecolor'] = $this->language->get('entry_titlecolor');
		$data['entry_article'] = $this->language->get('entry_article');
		$data['entry_google'] = $this->language->get('entry_google');
		$data['entry_pinterest'] = $this->language->get('entry_pinterest');
		$data['entry_twitter'] = $this->language->get('entry_twitter');
		$data['entry_facebook'] = $this->language->get('entry_facebook');
		$data['entry_feedbackrow'] = $this->language->get('entry_feedbackrow');
		$data['entry_descp'] = $this->language->get('entry_descp');
		
		$data['entry_descptextcolor'] = $this->language->get('entry_descptextcolor');
		$data['entry_articletextcolor'] = $this->language->get('entry_articletextcolor');
		$data['entry_postboxbgcolor'] = $this->language->get('entry_postboxbgcolor');
		$data['entry_containerbgcolor'] = $this->language->get('entry_containerbgcolor');
		$data['entry_titlebgcolor'] = $this->language->get('entry_titlebgcolor');
		$data['entry_titletextcolor'] = $this->language->get('entry_titletextcolor');
		$data['entry_blogtextcolor'] = $this->language->get('entry_blogtextcolor');
		$data['entry_articleimg'] = $this->language->get('entry_articleimg');
		$data['entry_themehovercolor'] = $this->language->get('entry_themehovercolor');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		//new
		$data['entry_bloglayout'] = $this->language->get('entry_bloglayout');
		$data['entry_blogperpage'] = $this->language->get('entry_blogperpage');
		$data['entry_blogperrow'] = $this->language->get('entry_blogperrow');
		$data['entry_dispalytitle'] = $this->language->get('entry_dispalytitle');
		$data['entry_dispalydes'] = $this->language->get('entry_dispalydes');
		$data['entry_blogthumbsize'] = $this->language->get('entry_blogthumbsize');
		$data['help_meta_title'] = $this->language->get('help_meta_title');
		$data['help_meta_keyword'] = $this->language->get('help_meta_keyword');
		$data['help_meta_description'] = $this->language->get('help_meta_description');
		$data['help_approve'] = $this->language->get('help_approve');
		$data['help_notifies'] = $this->language->get('help_notifies');
		$data['help_guestcomment'] = $this->language->get('help_guestcomment');
		$data['help_totalcomment'] = $this->language->get('help_totalcomment');
		$data['help_soicalshares'] = $this->language->get('help_soicalshares');
		$data['help_postcomments'] = $this->language->get('help_postcomments');
		$data['help_dispalytlikes'] = $this->language->get('help_dispalytlikes');
		$data['help_dispalyallowlike'] = $this->language->get('help_dispalyallowlike');
		$data['help_bloglayout'] = $this->language->get('help_bloglayout');
		$data['help_blogperpage'] = $this->language->get('help_blogperpage');
		$data['help_blogperrow'] = $this->language->get('help_blogperrow');
		$data['help_dispalytitle'] = $this->language->get('help_dispalytitle');
		$data['help_dispalydes'] = $this->language->get('help_dispalydes');
		$data['help_blogthumbsize'] = $this->language->get('help_blogthumbsize');
		$data['help_dispalyblogtimg'] = $this->language->get('help_dispalyblogtimg');
		$data['help_dispalydate'] = $this->language->get('help_dispalydate');
		$data['help_dispalyview'] = $this->language->get('help_dispalyview');
		$data['help_dispalyauth'] = $this->language->get('help_dispalyauth');
		$data['help_commentlimit'] = $this->language->get('help_commentlimit');
		$data['help_keyword'] = $this->language->get('help_keyword');
		//new
		
		$data['entry_thumbimg'] = $this->language->get('entry_thumbimg');
		$data['entry_comntbanner'] = $this->language->get('entry_comntbanner');
		$data['text_blogcommentsglobal'] = $this->language->get('text_blogcommentsglobal');
		$data['entry_blogcomments'] = $this->language->get('entry_blogcomments');
		$data['help_blogcomment'] = $this->language->get('help_blogcomment');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_width'] = $this->language->get('entry_width');
		
				
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_top'] = $this->language->get('help_top');
		$data['help_column'] = $this->language->get('help_column');
		$data['help_article'] = $this->language->get('help_article');
		$data['help_google'] = $this->language->get('help_google');
		$data['help_pinterest'] = $this->language->get('help_pinterest');
		$data['help_twitter'] = $this->language->get('help_twitter');
		$data['help_facebook'] = $this->language->get('help_facebook');
		$data['help_feedbackrow'] = $this->language->get('help_feedbackrow');
		$data['help_descp'] = $this->language->get('help_descp');
		$data['help_article'] = $this->language->get('help_article');
		$data['help_articleimg'] = $this->language->get('help_articleimg');
		$data['entry_commentlimit'] = $this->language->get('entry_commentlimit');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_main'] = $this->language->get('tab_main');
		$data['tab_setting'] = $this->language->get('tab_setting');
		$data['tab_color'] = $this->language->get('tab_color');
		$data['tab_support'] = $this->language->get('tab_support');
		$data['tab_postseting'] = $this->language->get('tab_postseting');
		$data['tab_blogseting'] = $this->language->get('tab_blogseting');
		$data['text_searchpage'] = $this->language->get('text_searchpage');
		$data['text_categorypage'] = $this->language->get('text_categorypage');
		$data['text_relatedblog'] = $this->language->get('text_relatedblog');
		$data['text_blogpage'] = $this->language->get('text_blogpage');
		$data['text_listpage'] = $this->language->get('text_listpage');
		$data['text_page'] = $this->language->get('text_page');
		
		$data['dashmenu'] = $this->load->controller('tmdblog/dashmenu');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('tmdblog/blogdashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('tmdblog/tmdblogsetting', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$data['action'] = $this->url->link('tmdblog/tmdblogsetting', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('tmdblog/tmdblogsetting', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['tmdblogsetting_description'])) {
			$data['tmdblogsetting_description'] = $this->request->post['tmdblogsetting_description'];
		} elseif ($this->config->get('tmdblogsetting_description')) { 
			$data['tmdblogsetting_description'] = $this->config->get('tmdblogsetting_description');
		}
		
		if (isset($this->request->post['tmdblogsetting_image'])) {
			$data['tmdblogsetting_image'] = $this->request->post['tmdblogsetting_image'];
		} else {
			$data['tmdblogsetting_image'] = $this->config->get('tmdblogsetting_image');
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['tmdblogsetting_image']) && is_file(DIR_IMAGE . $this->request->post['tmdblogsetting_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['tmdblogsetting_image'], 100, 100);
		} elseif ($this->config->get('tmdblogsetting_image') && is_file(DIR_IMAGE . $this->config->get('tmdblogsetting_image'))) {
			$data['thumb'] = $this->model_tool_image->resize($this->config->get('tmdblogsetting_image'), 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['tmdblogsetting_titlecolor'])) {
			$data['tmdblogsetting_titlecolor'] = $this->request->post['tmdblogsetting_titlecolor'];
		} else {
			$data['tmdblogsetting_titlecolor'] = $this->config->get('tmdblogsetting_titlecolor');
		}
		
		/*post setting*/
		
		if (isset($this->request->post['tmdblogsetting_article'])) {
			$data['tmdblogsetting_article'] = $this->request->post['tmdblogsetting_article'];
		} else {
			$data['tmdblogsetting_article'] = $this->config->get('tmdblogsetting_article');
		}
		if (isset($this->request->post['tmdblogsetting_descp'])) {
			$data['tmdblogsetting_descp'] = $this->request->post['tmdblogsetting_descp'];
		} else {
			$data['tmdblogsetting_descp'] = $this->config->get('tmdblogsetting_descp');
		}
		if (isset($this->request->post['tmdblogsetting_feedbackrow'])) {
			$data['tmdblogsetting_feedbackrow'] = $this->request->post['tmdblogsetting_feedbackrow'];
		} else {
			$data['tmdblogsetting_feedbackrow'] = $this->config->get('tmdblogsetting_feedbackrow');
		}
		if (isset($this->request->post['tmdblogsetting_facebook'])) {
			$data['tmdblogsetting_facebook'] = $this->request->post['tmdblogsetting_facebook'];
		} else {
			$data['tmdblogsetting_facebook'] = $this->config->get('tmdblogsetting_facebook');
		}
		if (isset($this->request->post['tmdblogsetting_twitter'])) {
			$data['tmdblogsetting_twitter'] = $this->request->post['tmdblogsetting_twitter'];
		} else {
			$data['tmdblogsetting_twitter'] = $this->config->get('tmdblogsetting_twitter');
		}
		if (isset($this->request->post['tmdblogsetting_pinterest'])) {
			$data['tmdblogsetting_pinterest'] = $this->request->post['tmdblogsetting_pinterest'];
		} else {
			$data['tmdblogsetting_pinterest'] = $this->config->get('tmdblogsetting_pinterest');
		}
		if (isset($this->request->post['tmdblogsetting_google'])) {
			$data['tmdblogsetting_google'] = $this->request->post['tmdblogsetting_google'];
		} else {
			$data['tmdblogsetting_google'] = $this->config->get('tmdblogsetting_google');
		}
		if (isset($this->request->post['tmdblogsetting_articleimg'])) {
			$data['tmdblogsetting_articleimg'] = $this->request->post['tmdblogsetting_articleimg'];
		} else {
			$data['tmdblogsetting_articleimg'] = $this->config->get('tmdblogsetting_articleimg');
		}
		
		
		if (isset($this->request->post['tmdblogsetting_commentlimit'])) {
				$data['tmdblogsetting_commentlimit'] = $this->request->post['tmdblogsetting_commentlimit'];
				} else {
					$data['tmdblogsetting_commentlimit'] = $this->config->get('tmdblogsetting_commentlimit');
				}
		
		if (isset($this->request->post['tmdblogsetting_image_comntthumb_width'])) {
				$data['tmdblogsetting_image_comntthumb_width'] = $this->request->post['tmdblogsetting_image_comntthumb_width'];
				} else {
					$data['tmdblogsetting_image_comntthumb_width'] = $this->config->get('tmdblogsetting_image_comntthumb_width');
				}

				if (isset($this->request->post['tmdblogsetting_image_comntthumb_height'])) {
					$data['tmdblogsetting_image_comntthumb_height'] = $this->request->post['tmdblogsetting_image_comntthumb_height'];
				} else {
					$data['tmdblogsetting_image_comntthumb_height'] = $this->config->get('tmdblogsetting_image_comntthumb_height');
				}
				
				if (isset($this->request->post['tmdblogsetting_image_comntbanner_width'])) {
					$data['tmdblogsetting_image_comntbanner_width'] = $this->request->post['tmdblogsetting_image_comntbanner_width'];
				} else {
					$data['tmdblogsetting_image_comntbanner_width'] = $this->config->get('tmdblogsetting_image_comntbanner_width');
				}

				if (isset($this->request->post['tmdblogsetting_image_comntbanner_height'])) {
					$data['tmdblogsetting_image_comntbanner_height'] = $this->request->post['tmdblogsetting_image_comntbanner_height'];
				} else {
					$data['tmdblogsetting_image_comntbanner_height'] = $this->config->get('tmdblogsetting_image_comntbanner_height');
				}
				if (isset($this->request->post['tmdblogsetting_globalcoment'])) {
					$data['tmdblogsetting_globalcoment'] = $this->request->post['tmdblogsetting_globalcoment'];
				} else {
					$data['tmdblogsetting_globalcoment'] = $this->config->get('tmdblogsetting_globalcoment');
				}
				
		/*post setting*/
		
		/*blog setting*/
		
		if (isset($this->request->post['tmdblogsetting_blogarticle'])) {
			$data['tmdblogsetting_blogarticle'] = $this->request->post['tmdblogsetting_blogarticle'];
		} else {
			$data['tmdblogsetting_blogarticle'] = $this->config->get('tmdblogsetting_blogarticle');
		}
		if (isset($this->request->post['tmdblogsetting_blogdescp'])) {
			$data['tmdblogsetting_blogdescp'] = $this->request->post['tmdblogsetting_blogdescp'];
		} else {
			$data['tmdblogsetting_blogdescp'] = $this->config->get('tmdblogsetting_blogdescp');
		}
		if (isset($this->request->post['tmdblogsetting_blogfeedbackrow'])) {
			$data['tmdblogsetting_blogfeedbackrow'] = $this->request->post['tmdblogsetting_blogfeedbackrow'];
		} else {
			$data['tmdblogsetting_blogfeedbackrow'] = $this->config->get('tmdblogsetting_blogfeedbackrow');
		}
		if (isset($this->request->post['tmdblogsetting_blogfacebook'])) {
			$data['tmdblogsetting_blogfacebook'] = $this->request->post['tmdblogsetting_blogfacebook'];
		} else {
			$data['tmdblogsetting_blogfacebook'] = $this->config->get('tmdblogsetting_blogfacebook');
		}
		if (isset($this->request->post['tmdblogsetting_blogtwitter'])) {
			$data['tmdblogsetting_blogtwitter'] = $this->request->post['tmdblogsetting_blogtwitter'];
		} else {
			$data['tmdblogsetting_blogtwitter'] = $this->config->get('tmdblogsetting_blogtwitter');
		}
		if (isset($this->request->post['tmdblogsetting_blogpinterest'])) {
			$data['tmdblogsetting_blogpinterest'] = $this->request->post['tmdblogsetting_blogpinterest'];
		} else {
			$data['tmdblogsetting_blogpinterest'] = $this->config->get('tmdblogsetting_blogpinterest');
		}
		if (isset($this->request->post['tmdblogsetting_bloggoogle'])) {
			$data['tmdblogsetting_bloggoogle'] = $this->request->post['tmdblogsetting_bloggoogle'];
		} else {
			$data['tmdblogsetting_bloggoogle'] = $this->config->get('tmdblogsetting_bloggoogle');
		}
		
		
		if (isset($this->request->post['tmdblogsetting_blogarticleimg'])) {
			$data['tmdblogsetting_blogarticleimg'] = $this->request->post['tmdblogsetting_blogarticleimg'];
		} else {
			$data['tmdblogsetting_blogarticleimg'] = $this->config->get('tmdblogsetting_blogarticleimg');
		}
		
		/*blog setting*/
		
		/*color setting*/
		
			if (isset($this->request->post['tmdblogsetting_titletextcolor'])) {
				$data['tmdblogsetting_titletextcolor'] = $this->request->post['tmdblogsetting_titletextcolor'];
			} else {
				$data['tmdblogsetting_titletextcolor'] = $this->config->get('tmdblogsetting_titletextcolor');
			}
			if (isset($this->request->post['tmdblogsetting_themecolor'])) {
				$data['tmdblogsetting_themecolor'] = $this->request->post['tmdblogsetting_themecolor'];
			} else {
				$data['tmdblogsetting_themecolor'] = $this->config->get('tmdblogsetting_themecolor');
			}
			if (isset($this->request->post['tmdblogsetting_containerbgcolor'])) {
				$data['tmdblogsetting_containerbgcolor'] = $this->request->post['tmdblogsetting_containerbgcolor'];
			} else {
				$data['tmdblogsetting_containerbgcolor'] = $this->config->get('tmdblogsetting_containerbgcolor');
			}
			if (isset($this->request->post['tmdblogsetting_postboxbgcolor'])) {
				$data['tmdblogsetting_postboxbgcolor'] = $this->request->post['tmdblogsetting_postboxbgcolor'];
			} else {
				$data['tmdblogsetting_postboxbgcolor'] = $this->config->get('tmdblogsetting_postboxbgcolor');
			}
			if (isset($this->request->post['tmdblogsetting_articletextcolor'])) {
				$data['tmdblogsetting_articletextcolor'] = $this->request->post['tmdblogsetting_articletextcolor'];
			} else {
				$data['tmdblogsetting_articletextcolor'] = $this->config->get('tmdblogsetting_articletextcolor');
			}
			if (isset($this->request->post['tmdblogsetting_descptextcolor'])) {
				$data['tmdblogsetting_descptextcolor'] = $this->request->post['tmdblogsetting_descptextcolor'];
			} else {
				$data['tmdblogsetting_descptextcolor'] = $this->config->get('tmdblogsetting_descptextcolor');
			}
			
			if (isset($this->request->post['tmdblogsetting_headinghovercolor'])) {
				$data['tmdblogsetting_headinghovercolor'] = $this->request->post['tmdblogsetting_headinghovercolor'];
			} else {
				$data['tmdblogsetting_headinghovercolor'] = $this->config->get('tmdblogsetting_headinghovercolor');
			}
			
			if (isset($this->request->post['tmdblogsetting_themehovercolor'])) {
				$data['tmdblogsetting_themehovercolor'] = $this->request->post['tmdblogsetting_themehovercolor'];
			} else {
				$data['tmdblogsetting_themehovercolor'] = $this->config->get('tmdblogsetting_themehovercolor');
			}
			
		
		/*color setting*/

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tmdblog/tmdblogsetting_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'tmdblog/tmdblogsetting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['tmdblogsetting_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}
		
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'tmdblog/tmdblogsetting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}