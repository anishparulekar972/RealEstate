<?php


class ControllerExtensionDashboardCustomerstatus extends Controller {

	public function dashboard() {

		$this->load->language('extension/dashboard/customerstatus');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['text_enable'] = $this->language->get('text_enable');
		$data['text_disable'] = $this->language->get('text_disable');
		$data['column_name'] = $this->language->get('column_name');
     	$data['column_image'] = $this->language->get('column_image');
		$data['column_property_status'] = $this->language->get('column_property_status');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_view'] = $this->language->get('column_view');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_status'] = $this->language->get('column_status');
		

		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_approve'] = $this->language->get('button_approve');
		$data['token'] = $this->session->data['token'];
		$this->load->model('property/property');
		$this->load->model('tool/image');
		$this->load->model('property/property_status');
		$filter_data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 5
			);

		$url='';

	  $results=$this->model_property_property->getPropertys($filter_data);
	  
		foreach($results as $result){
			if (!$result['approved']) {
				$approve = $this->url->link('property/property/approve', 'token=' . $this->session->data['token'] . '&property_id=' . $result['property_id'] . $url, true);

			} else {
				$approve = '';


			}

			if ($result['status']){

				$status = $this->language->get('text_enable');

			} else {

				$status = $this->language->get('text_disable');

			}


			if (is_file(DIR_IMAGE . $result['image'])){

				$image = $this->model_tool_image->resize($result['image'], 40, 40);

			} else {

				$image = $this->model_tool_image->resize('no_image.png', 40, 40);


			}


			$propertstatus_info=$this->model_property_property_status->getOrderStatus($result['property_status_id']);


			if(isset($propertstatus_info['name'])){


				$property_status=$propertstatus_info['name'];         


			} else {


				$property_status='';


			}


			$data['propertys'][]=array(


				'property_id'		=>$result['property_id'],


				'property_status' 	=>$property_status,


				'image' 			=> $image,


				'name'				=>$result['name'],


				'price'				=>$result['price'],


				'sort_order'		=>$result['sort_order'],


				'status'			=>$status,


				'approve'			=>$approve,


				'edit'				=> $this->url->link('property/property/edit', 'token=' . $this->session->	data['token'] . '&property_id=' .$result['property_id'] . $url, true)


			);


		}


		return $this->load->view('extension/dashboard/customerstatus_info', $data);


	}


	


}


