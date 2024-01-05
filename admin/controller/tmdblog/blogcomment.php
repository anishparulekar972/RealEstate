<?php
class ControllerTmdBlogBlogComment extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tmdblog/blogcomment');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blogcomment');
		

		$this->getList();
	}

	public function add() {
		$this->load->language('tmdblog/blogcomment');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blogcomment');
			
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_tmdblog_blogcomment->addBlogcomment($this->request->post);
			//print_r($this->request->post); die();
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

			$this->response->redirect($this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('tmdblog/blogcomment');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blogcomment');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_tmdblog_blogcomment->editBlogcomment($this->request->get['comment_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('tmdblog/blogcomment');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('tmdblog/blogcomment');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $comment_id) {
				$this->model_tmdblog_blogcomment->deleteBlogcomment($comment_id);
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

			$this->response->redirect($this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('tmdblog/blogcomment/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('tmdblog/blogcomment/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['repair'] = $this->url->link('tmdblog/blogcomment/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

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

		$blog_total = $this->model_tmdblog_blogcomment->getTotalTmdblogcomment();
		
		$results = $this->model_tmdblog_blogcomment->getTmdblogcommentes($filter_data);
		
		$this->load->model('tool/image');
		foreach ($results as $result) {
		
		if (is_file(DIR_IMAGE . $result['commentimage'])) {
				$commentimage = $this->model_tool_image->resize($result['commentimage'], 40, 40);
			} else {
				$commentimage = $this->model_tool_image->resize('no_image.png', 40, 40);
			}
		
		
			$data['tmdblogcategories'][] = array(
				'comment_id'  => $result['comment_id'],
				'cname'       => $result['cname'],
				'view'        => $result['viewed'],
				'image'       => $commentimage,
				'sort_order'  => $result['sort_order'],
				'status'      => ($result['cstatus']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'        => $this->url->link('tmdblog/blogcomment/edit', 'token=' . $this->session->data['token'] . '&comment_id=' . $result['comment_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('tmdblog/blogcomment/delete', 'token=' . $this->session->data['token'] . '&comment_id=' . $result['comment_id'] . $url, 'SSL')
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
		
		$data['sort_name'] = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		
		$data['sort_status'] = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, 'SSL');
		
		$data['sort_viewed'] = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . '&sort=viewed' . $url, 'SSL');
		
		$data['sort_sort_order'] = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
		$pagination->url = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

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

		$this->response->setOutput($this->load->view('tmdblog/blogcomment_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['comment_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_customername'] = $this->language->get('entry_customername');
		$data['dashmenu'] = $this->load->controller('tmdblog/dashmenu');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_blogcoment'] = $this->language->get('entry_blogcoment');
		$data['text_select'] = $this->language->get('text_select');
		$data['help_tmdblog'] = $this->language->get('help_tmdblog');
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
		$data['entry_tmdblog'] = $this->language->get('entry_tmdblog');
		$data['entry_comment'] = $this->language->get('entry_comment');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_image'] = $this->language->get('tab_image');
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
			'href' => $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['comment_id'])) {
			$data['action'] = $this->url->link('tmdblog/blogcomment/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('tmdblog/blogcomment/edit', 'token=' . $this->session->data['token'] . '&comment_id=' . $this->request->get['comment_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('tmdblog/blogcomment', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['comment_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$blog_info = $this->model_tmdblog_blogcomment->getBlogcomment($this->request->get['comment_id']);
		}

		$data['token'] = $this->session->data['token'];

		
		if (isset($this->request->post['property_agent_id'])) {
			$data['property_agent_id'] = $this->request->post['property_agent_id'];
		} elseif (!empty($blog_info)) {
			$data['property_agent_id'] = $blog_info['property_agent_id'];
		} else {
			$data['property_agent_id'] = '';
		}
		
		 $this->load->model('property/agent');
		 $data['customers']=array();
		$customer_info = $this->model_property_agent->getAgents($data);
	
		foreach ($customer_info as $info){
		$data['customers'][] = array(
		'property_agent_id' => $info['property_agent_id'],
		'customername' => $info['agentname']
		);
		
		}
		
		if (isset($this->request->post['blog_id'])) {
			$data['blog_id'] = $this->request->post['blog_id'];
		} elseif (!empty($blog_info)) {
			$data['blog_id'] = $blog_info['blog_id'];
		} else {
			$data['blog_id'] = '';
		}
		
		 $data['blogsinfo']=array();
		 $this->load->model('tmdblog/blog');
		
		$blog_infos = $this->model_tmdblog_blog->getTmdBlogcategories($data);
		//	print_r($blog_infos); die();
		foreach ($blog_infos as $infos){
		$data['blogsinfo'][] = array(
		'blog_id' => $infos['blog_id'],
		'name' => $infos['name']
		);
		
		}
		
		
		
		 // Blogs
		$this->load->model('tmdblog/tmdblogcategory');

		if (isset($this->request->post['blog_blogs'])) {
			$blogs = $this->request->post['blog_blogs'];
		} elseif (isset($this->request->get['blog_id'])) {
			$blogs = unserialize($blogs['blog_id']);
		} else {
			$blogs = array();
		}

		$data['blog_categories'] = array();

		foreach ($blogs as $blog_id) {
			$tmdblogcategory_info = $this->model_tmdblog_blog->getBlog($blog_id);
		

			if ($tmdblogcategory_info) {
				$data['blog_categories'][] = array(
					'blog_id' => $tmdblogcategory_info['blog_id'],
					'name' => ($tmdblogcategory_info['path']) ? $tmdblogcategory_info['path'] . ' &gt; ' . $tmdblogcategory_info['name'] : $tmdblogcategory_info['name']
				);
			}
		}
		
		// Blog Categories
		

		
		
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($blog_info)) {
			$data['sort_order'] = $blog_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		} 
		
		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (!empty($blog_info)) {
			$data['comment'] = $blog_info['comment'];
		} else {
			$data['comment'] = '';
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

		
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($blog_info)) {
			$data['status'] = $blog_info['status'];
		} else {
			$data['status'] = true;
		}
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tmdblog/blogcomment_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'tmdblog/blogcomment')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'tmdblog/blogcomment')) {
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
}