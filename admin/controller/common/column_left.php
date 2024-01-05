<?php


class ControllerCommonColumnLeft extends Controller {


	public function index() {


		if (isset($this->request->get['token']) && isset($this->session->data['token']) && ($this->request->get['token'] == $this->session->data['token'])) {


			$this->load->language('common/column_left');


	


			$this->load->model('user/user');


	


			$this->load->model('tool/image');


	


			$user_info = $this->model_user_user->getUser($this->user->getId());


	


			if (isset($user_info)) {


				$data['firstname'] = $user_info['firstname'];


				$data['lastname'] = $user_info['lastname'];


				$data['username'] = $user_info['username'];


	


				$data['user_group'] = $user_info['user_group'];


	


				if (is_file(DIR_IMAGE . $user_info['image'])) {


					$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);


				} else {


					$data['image'] = '';


				}


			} else {


				$data['firstname'] = '';


				$data['username'] = '';


				$data['lastname'] = '';


				$data['user_group'] = '';


				$data['image'] = '';


			}			


		


			// Create a 3 level menu array


			// Level 2 can not have children


			


			// Menu


			$data['menus'][] = array(


				'id'       => 'menu-dashboard',


				'icon'	   => 'fa-home',


				'name'	   => $this->language->get('text_dashboard'),


				'href'     => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),


				'children' => array()


			);


			


			//new menu


			


			// Setting


			$system = array();


			


			if ($this->user->hasPermission('access', 'common/theme')) {


				$system[] = array(


					'name'	   => $this->language->get('text_themecontrol'),


					'href'     => $this->url->link('common/theme', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);	


			}


			if ($this->user->hasPermission('access', 'pages/megaheader')) {		


				$system[] = array(


					'name'	   => $this->language->get('text_megaheader'),


					'href'     => $this->url->link('pages/megaheader', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);					


			}



			if ($this->user->hasPermission('access', 'setting/setting')) {


				$system[] = array(


					'name'	   => $this->language->get('text_setting'),


					'href'     => $this->url->link('setting/setting', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);	


			}


			


			


			


			if ($this->user->hasPermission('access', 'setting/backup')) {


				$system[] = array(


					'name'	   => $this->language->get('text_backup'),


					'href'     => $this->url->link('setting/backup', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


		   if ($this->user->hasPermission('access', 'setting/seo_url')) {





				$system[] = array(





					'name'	   => $this->language->get('text_seo_url'),





					'href'     => $this->url->link('setting/seo_url', 'token=' . $this->session->data['token'], true),





					'children' => array()		





				);





			}


		


		


			if ($system) {


				$data['menus'][] = array(


					'id'       => 'menu-system',


					'icon'	   => 'fa-cogs', 


					'name'	   => $this->language->get('text_system'),


					'href'     => '',


					'children' => $system


				);		


			}


			


			


			


			


			


			


			// Property


			$property = array();


			


			if ($this->user->hasPermission('access', 'property/category')) {


				$property[] = array(


					'name'	   => $this->language->get('text_category'),


					'href'     => $this->url->link('property/category', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			


			if ($this->user->hasPermission('access', 'property/property_status')) {


				$property[] = array(


					'name'	   => $this->language->get('text_order_status'),


					'href'     => $this->url->link('property/property_status', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			if ($this->user->hasPermission('access', 'property/feature')) {


				$property[] = array(


					'name'	   => $this->language->get('text_feature'),


					'href'     => $this->url->link('property/feature', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			if ($this->user->hasPermission('access', 'property/nearest_place')) {


				$property[] = array(


					'name'	   => $this->language->get('text_nearest'),


					'href'     => $this->url->link('property/nearest_place', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}
			
			if ($this->user->hasPermission('access', 'property/units')) {


				$property[] = array(


					'name'	   => $this->language->get('text_units'),


					'href'     => $this->url->link('property/units', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			if ($this->user->hasPermission('access', 'property/custom_field')) {


				$property[] = array(


					'name'	   => $this->language->get('text_custom_field'),


					'href'     => $this->url->link('property/custom_field', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			


			if ($this->user->hasPermission('access', 'property/property')) {


				$property[] = array(


					'name'	   => $this->language->get('text_property'),


					'href'     => $this->url->link('property/property', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


		
			
/*

			if ($this->user->hasPermission('access', 'property/customer')) {


				$property[] = array(


					'name'	   => $this->language->get('text_customer'),


					'href'     => $this->url->link('property/customer', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			if ($this->user->hasPermission('access', 'property/review')) {		


				$property[] = array(


					'name'	   => $this->language->get('text_review'),


					'href'     => $this->url->link('property/review', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);		


			}
  */

			


			if ($this->user->hasPermission('access', 'property/enquiry')) {		


				$property[] = array(


					'name'	   => $this->language->get('text_enquiry'),


					'href'     => $this->url->link('property/enquiry', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);		


			}


			


			if ($property) {


				$data['menus'][] = array(


					'id'       => 'menu-property',


					'icon'	   => 'fa-file-text-o', 


					'name'	   => $this->language->get('text_property'),


					'href'     => '',


					'children' => $property


				);		


			}


			

						$user = array();


			
		//agent

				if ($this->user->hasPermission('access', 'agent/agent')) {
				$agent[] = array(

					'name'	   => $this->language->get('text_agent'),

					'href'     => $this->url->link('agent/agent', 'token=' . $this->session->data['token'], true),

					'children' => array()		

				);

			}

			if ($this->user->hasPermission('access', 'agent/mail')) {
				$agent[] = array(

					'name'	   => $this->language->get('text_mail'),

					'href'     => $this->url->link('agent/mail', 'token=' . $this->session->data['token'], true),

					'children' => array()		

				);

			}

			if ($agent) {

				$data['menus'][] = array(
					'id'       => 'menu-users',
					'icon'	   => 'fa-user', 
					'name'	   => $this->language->get('text_agent'),
					'href'     => '',
					'children' => $agent

				);		

			}

			


			//Agent & user


			$user = array();


			


			if ($this->user->hasPermission('access', 'user/user')) {


				$user[] = array(


					'name'	   => $this->language->get('text_users'),


					'href'     => $this->url->link('user/user', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);	


			}


			


			if ($this->user->hasPermission('access', 'user/user_permission')) {	


				$user[] = array(


					'name'	   => $this->language->get('text_user_group'),


					'href'     => $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);	


			}


			


			if ($user) {


				$data['menus'][] = array(


					'id'       => 'menu-users',


					'icon'	   => 'fa-font', 


					'name'	   => $this->language->get('text_users'),


					'href'     => '',


					'children' => $user


				);		


			}


			


			


			//Module/layout


			$modulelayout = array();


				


			if ($this->user->hasPermission('access', 'extension/extension')) {


				$modulelayout[] = array(


					'name'	   => $this->language->get('text_module'),


					'href'     => $this->url->link('extension/extension', 'token=' . $this->session->data['token'].'&type=module', true),


					'children' => array()		


				);


			}


		

			if ($this->user->hasPermission('access', 'modulelayout/layout')) {


				$modulelayout[] = array(


					'name'	   => $this->language->get('text_layout'),


					'href'     => $this->url->link('modulelayout/layout', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);	


			}


			

			if ($this->user->hasPermission('access', 'modulelayout/banner')) {


				$modulelayout[] = array(


					'name'	   => $this->language->get('text_banner'),


					'href'     => $this->url->link('modulelayout/banner', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			if ($modulelayout) {


				$data['menus'][] = array(


					'id'       => 'menu-modulelayout',


					'icon'	   => 'fa-bar-chart', 


					'name'	   => $this->language->get('text_pagebuilder'),


					'href'     => '',


					'children' => $modulelayout


				);		


			}


			


			


			





			// Localisation


			$localisation = array();


			


			if ($this->user->hasPermission('access', 'localisation/country')) {


				$localisation[] = array(


					'name'	   => $this->language->get('text_country'),


					'href'     => $this->url->link('localisation/country', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			if ($this->user->hasPermission('access', 'localisation/zone')) {


				$localisation[] = array(


					'name'	   => $this->language->get('text_zone'),


					'href'     => $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}


			


			if ($this->user->hasPermission('access', 'localisation/geo_zone')) {


				$localisation[] = array(


					'name'	   => $this->language->get('text_geo_zone'),


					'href'     => $this->url->link('localisation/geo_zone', 'token=' . $this->session->data['token'], true),


					'children' => array()


				);


			}


			


			if ($this->user->hasPermission('access', 'localisation/language')) {


				$localisation[] = array(


					'name'	   => $this->language->get('text_language'),


					'href'     => $this->url->link('localisation/language', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}		


			if ($this->user->hasPermission('access', 'localisation/currency')) {


				$localisation[] = array(


					'name'	   => $this->language->get('text_currency'),


					'href'     => $this->url->link('localisation/currency', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);


			}
			


			if ($localisation) {


				$data['menus'][] = array(


					'id'       => 'menu-system',


					'icon'	   => 'fa-map-marker', 


					'name'	   => $this->language->get('text_localisation'),


					'href'     => '',


					'children' => $localisation


				);


			}


			


			//pages


			$pages = array();


			


			if ($this->user->hasPermission('access', 'pages/information')) {		


				$pages[] = array(


					'name'	   => $this->language->get('text_information'),


					'href'     => $this->url->link('pages/information', 'token=' . $this->session->data['token'], true),


					'children' => array()


				);


			}


			


			

			


			if ($this->user->hasPermission('access', 'pages/gallerydashboard')) {		


				$pages[] = array(


					'name'	   => $this->language->get('text_gallerydashboard'),


					'href'     => $this->url->link('pages/gallerydashboard', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);					


			}


			


			//faq start


			


			if ($this->user->hasPermission('access', 'pages/faqcategory')) {		


				$pages[] = array(


					'name'	   => $this->language->get('text_faqcat'),


					'href'     => $this->url->link('pages/faqcategory', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);					


			}


			if ($this->user->hasPermission('access', 'pages/faq')) {		


				$pages[] = array(


					'name'	   => $this->language->get('text_faq'),


					'href'     => $this->url->link('pages/faq', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);					


			}	


					


			


			


			/* Faq end*/





			/* Newsletter Subscribers */	


			


			if ($this->user->hasPermission('access', 'pages/newssubscribers')) {


				$pages[] = array(


					'name'	   => $this->language->get('text_newssubscribe'),


					'href'     => $this->url->link('pages/newssubscribers', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);	


			}





			


			


			if ($this->user->hasPermission('access', 'pages/testimonial')) {


				$pages[] = array(


					'name'	   => $this->language->get('text_testimonial'),


					'href'     => $this->url->link('pages/testimonial', 'token=' . $this->session->data['token'], true),


					'children' => array()		


				);	


			}


			


			


			


			/* Testimonials  */


			


			/* Newsletter Subscribers end */


			


			if ($pages) {					


				$data['menus'][] = array(


					'id'       => 'menu-pages',


					'icon'	   => 'fa fa-comments-o', 


					'name'	   => $this->language->get('text_pages'),


					'href'     => '',


					'children' => $pages


				);		


			}


			
$blogdashbord = array();
		
			if ($this->user->hasPermission('access', 'tmdblog/blogdashboard')) {		
				$blogdashbord[] = array(
					'name'	   => $this->language->get('text_blogdashboard'),
					'href'     => $this->url->link('tmdblog/blogdashboard', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);					
			}	
					
			if ($blogdashbord) {					
				$data['menus'][] = array(
					'id'       => 'menu-extension',
					'icon'	   => 'fa fa-tachometer', 
					'name'	   => $this->language->get('text_blogdashboard'),
					'href'     => '',
					'children' => $blogdashbord
				);		
			}

			


			// Extension


			$extension = array();


			


			if ($this->user->hasPermission('access', 'extension/extension')) {		


				$extension[] = array(


					'name'	   => $this->language->get('text_extension'),


					'href'     => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true),


					'children' => array()


				);


			}





		/*


				


		if ($extension) {					


			$data['menus'][] = array(


				'id'       => 'menu-extension',


				'icon'	   => 'fa-print', 


				'name'	   => $this->language->get('text_extension'),


				'href'     => '',


				'children' => $extension


			);		


		}





		*/


			// Stats


			$data['text_complete_status'] = $this->language->get('text_complete_status');


			$data['text_processing_status'] = $this->language->get('text_processing_status');


			$data['text_other_status'] = $this->language->get('text_other_status');


			$data['username'] = $this->language->get('username');


	


					


			return $this->load->view('common/column_left', $data);


		}


	}


}


