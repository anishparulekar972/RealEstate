<?php
class ControllerTmdBlogBlog extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tmdblog/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blog');

		$this->getList();
	}

	public function add() {
		$this->load->language('tmdblog/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blog');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_tmdblog_blog->addBlog($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('tmdblog/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blog');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_tmdblog_blog->editBlog($this->request->get['blog_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('tmdblog/blog');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blog');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $blog_id) {
				$this->model_tmdblog_blog->deleteBlog($blog_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}


	protected function getList() {
	
	if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}
		
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
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
			'href' => $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('tmdblog/blog/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('tmdblog/blog/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['repair'] = $this->url->link('tmdblog/blog/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['tmdblogcategories'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_status'   => $filter_status,
			'filter_date_added'    => $filter_date_added,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$blog_total = $this->model_tmdblog_blog->getTotalTmdBlog($filter_data);
		
		$results = $this->model_tmdblog_blog->getTmdBlogcategories($filter_data);
		
		$this->load->model('tool/image');
		foreach ($results as $result) {
		
		if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}
		
		
			$data['tmdblogcategories'][] = array(
				'blog_id' => $result['blog_id'],
				'name'        => $result['name'],
				'view'        => $result['viewed'],
				'image'       => $image,
				'sort_order'  => $result['sort_order'],
				'status'      => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'        => $this->url->link('tmdblog/blog/edit', 'token=' . $this->session->data['token'] . '&blog_id=' . $result['blog_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('tmdblog/blog/delete', 'token=' . $this->session->data['token'] . '&blog_id=' . $result['blog_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['dashmenu'] = $this->load->controller('tmdblog/dashmenu');

		$data['column_view'] = $this->language->get('column_view');
		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');	
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_rebuild'] = $this->language->get('button_rebuild');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['token'] = $this->session->data['token'];
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

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
				
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		
		$data['sort_status'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, 'SSL');
		
		$data['sort_viewed'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . '&sort=viewed' . $url, 'SSL');
		
		$data['sort_sort_order'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $blog_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($blog_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($blog_total - $this->config->get('config_limit_admin'))) ? $blog_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $blog_total, ceil($blog_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_status'] = $filter_status;
		$data['filter_date_added'] = $filter_date_added;
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tmdblog/blog_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['blog_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_username'] = $this->language->get('entry_username');
		
		$data['dashmenu'] = $this->load->controller('tmdblog/dashmenu');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_tmdblogcategory'] = $this->language->get('entry_tmdblogcategory');
		$data['entry_blogcoment'] = $this->language->get('entry_blogcoment');
		$data['text_select'] = $this->language->get('text_select');
		$data['help_tmdblogcategory'] = $this->language->get('help_tmdblogcategory');
		$data['text_no_comment'] = $this->language->get('text_no_comment');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_comment'] = $this->language->get('column_comment');
		$data['column_action'] = $this->language->get('column_action');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_comment'] = $this->language->get('tab_comment');
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

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
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
			'href' => $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['blog_id'])) {
			$data['action'] = $this->url->link('tmdblog/blog/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('tmdblog/blog/edit', 'token=' . $this->session->data['token'] . '&blog_id=' . $this->request->get['blog_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['blog_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$blog_info = $this->model_tmdblog_blog->getBlog($this->request->get['blog_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');
		$this->load->model('property/agent');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['blog_description'])) {
			$data['blog_description'] = $this->request->post['blog_description'];
		} elseif (isset($this->request->get['blog_id'])) {
			$data['blog_id']=$this->request->get['blog_id'];
			$data['blog_description'] = $this->model_tmdblog_blog->getBlogDescriptions($this->request->get['blog_id']);
			
		} else {
			$data['blog_description'] = array();
		}

		// Blog Categories
		$this->load->model('tmdblog/tmdblogcategory');

		if (isset($this->request->post['blog_category'])) {
			$blogcategories = $this->request->post['blog_category'];
		} elseif (isset($this->request->get['blog_id'])) {
			$blogcategories = $this->model_tmdblog_blog->getBlogBlogcategories($this->request->get['blog_id']);
		} else {
			$blogcategories = array();
		}

		$data['blog_categories'] = array();

		foreach ($blogcategories as $tmdblogcategory_id) {
			$tmdblogcategory_info = $this->model_tmdblog_tmdblogcategory->getTmdblogcategory($tmdblogcategory_id);
		

			if ($tmdblogcategory_info) {
				$data['blog_categories'][] = array(
					'tmdblogcategory_id' => $tmdblogcategory_info['tmdblogcategory_id'],
					'name' => ($tmdblogcategory_info['path']) ? $tmdblogcategory_info['path'] . ' &gt; ' . $tmdblogcategory_info['name'] : $tmdblogcategory_info['name']
				);
			}
		}
		
		// Blog Categories
		

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($blog_info)) {
			$data['keyword'] = $blog_info['keyword'];
		} else {
			$data['keyword'] = '';
		}
		
		if (isset($this->request->post['blogcoment'])) {
			$data['blogcoment'] = $this->request->post['blogcoment'];
		} elseif (!empty($blog_info)) {
			$data['blogcoment'] = $blog_info['blogcoment'];
		} else {
			$data['blogcoment'] = 1;
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($blog_info)) {
			$data['image'] = $blog_info['image'];
		} else {
			$data['image'] = '';
		}
		
		

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($blog_info) && is_file(DIR_IMAGE . $blog_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($blog_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($blog_info)) {
			$data['sort_order'] = $blog_info['sort_order'];
		} else {
			$data['sort_order'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($blog_info)) {
			$data['status'] = $blog_info['status'];
		} else {
			$data['status'] = true;
		}
		
		
		if (isset($this->request->post['user_id'])) {
			$data['user_id'] = $this->request->post['user_id'];
		} elseif (!empty($blog_info)) {
			$data['user_id'] = $blog_info['user_id'];
		} else {
			$data['user_id'] = '';
		}
		
		
		
		 $this->load->model('user/user');
		 $data['users']=array();
		$username_info = $this->model_user_user->getUsers($data);
	
		foreach ($username_info as $info){
		$data['users'][] = array(
		'user_id' => $info['user_id'],
		'username' => $info['username']
		);
		
		}
		$data['blog_id']='';
		$data['comments']=array();
		if(isset($this->request->get['blog_id'])){
		$data['blog_id']=$this->request->get['blog_id'];	
		$comment_info = $this->model_tmdblog_blog->getComments($this->request->get['blog_id']);
		
		foreach($comment_info as $info){
			$agent_info = $this->model_property_agent->getAgent($info['property_agent_id']);
			if(!empty($agent_info['agentname'])) {
			$name=	$agent_info['agentname'];
			}else{
				$name='';
			}

			$data['comments'][]=array(
			'blog_id'  => $info['blog_id'],
			'property_agent_id' => $info['property_agent_id'],
			'comment_id'  => $info['comment_id'],
			'name'        => $name,
			'comment'     => html_entity_decode($info['comment'], ENT_QUOTES, 'UTF-8'),
			'action'      => '',
			);
		}
		}
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tmdblog/blog_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'tmdblog/blog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['blog_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('tmdblog/url_alias');

			$url_alias_info = $this->model_tmdblog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['blog_id']) && $url_alias_info['query'] != 'blog_id=' . $this->request->get['blog_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['blog_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'tmdblog/blog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'tmdblog/blog')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('tmdblog/blog');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_tmdblog_blog->getTmdBlogcategories($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'blog_id' => $result['blog_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function deletecoment() {
		$json=array();
			
			if(isset($this->request->get['comment_id']))
			{
			$this->load->model('tmdblog/blog');	
			$this->model_tmdblog_blog->deleteComment($this->request->get['comment_id']);
			
			$json['success']='Your file type removed successfully!';
			}else
			{
			$json['error']='Unable to removed!';
			}
			
			$this->response->setOutput(json_encode($json));
		}
		
		public function loadcomment() {
		$url= '';
		$this->load->model('tmdblog/blog');
		$this->load->model('property/agent');
		
		$data['comments']=array();
		
		$data['delete'] = $this->url->link('tmdblog/blog/deletecoment', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data=array();
		
		
		$comment_info = $this->model_tmdblog_blog->getComments($this->request->get['blog_id']);

		foreach($comment_info as $info){
		$agent_info = $this->model_property_agent->getAgent($info['property_agent_id']);
			if(!empty($agent_info['agentname'])) {
			$name=	$agent_info['agentname'];
			}else{
				$name='';
			}
			$data['comments'][]=array(
			'blog_id'  => $info['blog_id'],
			'property_agent_id' => $info['property_agent_id'],
			'comment_id'  => $info['comment_id'],
			'name'        => $info['name'],
			'comment'     => html_entity_decode($info['comment'], ENT_QUOTES, 'UTF-8'),
			'action'      => '',
			);
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tmdblog/loadcoment/loadcoment', $data));
		
		}
		
}