<?php


class ControllerExtensionDashboardProperties extends Controller {


	private $error = array();





		public function dashboard() {

		$this->load->language('extension/dashboard/properties');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		$this->load->model('property/property');

		$online_total = $this->model_property_property->getTotalProperty($data);

		if ($online_total > 1000000000000) {

			$data['total'] = round($online_total / 1000000000000, 1) . 'T';


		} elseif ($online_total > 1000000000) {


			$data['total'] = round($online_total / 1000000000, 1) . 'B';


		} elseif ($online_total > 1000000) {


			$data['total'] = round($online_total / 1000000, 1) . 'M';


		} elseif ($online_total > 1000) {


			$data['total'] = round($online_total / 1000, 1) . 'K';


		} else {

			$data['total'] = $online_total;


		}
	


		return $this->load->view('extension/dashboard/properties_info', $data);


	}


}


