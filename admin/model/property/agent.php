<?php

class ModelPropertyAgent extends Model{

	public function addAgent($data){

		$sql="INSERT INTO " . DB_PREFIX . "property_agent set agentname='".$this->db->escape($data['agentname'])."',image='".$this->db->escape($data['image'])."',description='".$this->db->escape($data['description'])."',positions='".$this->db->escape($data['positions'])."',email='".$this->db->escape($data['email'])."',

		contact='".(int) $data['contact']."',sort_order='".(int) $data['sort_order']."',pincode='".(int) $data['pincode']."',address='".$this->db->escape($data['address'])."',	password='".$this->db->escape($data['password'])."',city='".$this->db->escape($data['city'])."',country_id='".$this->db->escape($data['country_id'])."',

		status='".(int)$data['status']."', date_added=now()";

		$this->db->query($sql);

	}



	public function getAgents($data){

		$sql="select * from " . DB_PREFIX . "property_agent where property_agent_id<>0";

		if (isset($data['filter_agentname'])){

			$sql .=" and agentname like '".$this->db->escape($data['filter_agentname'])."%'";

		}
		if (isset($data['filter_email'])){

			$sql .=" and email like '".$this->db->escape($data['filter_email'])."%'";

		}

		if (isset($data['filter_status'])){

			$sql .=" and status like '".$this->db->escape($data['filter_status'])."%'";

		}

		$sort_data = array(

			'agentname',

			'status'

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){

			$sql .= " ORDER BY " . $data['sort'];

		}else{

			$sql .= " ORDER BY agentname";

		}if (isset($data['order']) && ($data['order'] == 'DESC')){

			$sql .= " DESC";

		} 

		else {

			$sql .= " ASC";

		}

		if(isset($data['start']) || isset($data['limit'])) {

		if ($data['start'] < 0) 

		{

			$data['start'] = 0;

		}



		if ($data['limit'] < 1) 

		{

			$data['limit'] = 20;

		}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];

		}

		$query = $this->db->query($sql);

		return $query->rows;	

	}

	

	public function getpropertyform($property_agent_id){

		$sql="select * from " . DB_PREFIX . "property_agent where property_agent_id='".$property_agent_id."'";

		$query=$this->db->query($sql);

		return $query->row;

	}

	//// update or edit ////

	

	public function editAgent($property_agent_id,$data){

		$sql="update " . DB_PREFIX . "property_agent set agentname='".$this->db->escape($data['agentname'])."',	image='".$this->db->escape($data['image'])."',description='".$this->db->escape($data['description'])."',positions='".$this->db->escape($data['positions'])."',contact='".$this->db->escape($data['contact'])."',country_id='".(int) $data['country_id']."',

		status='".(int)$data['status']."',pincode='".$this->db->escape($data['pincode'])."',address='".$this->db->escape($data['address'])."',city='".$this->db->escape($data['city'])."',sort_order='".$this->db->escape($data['sort_order'])."',

		date_modified=now() where property_agent_id='".$property_agent_id."'";


		if ($data['password']) {
			$this->db->query("UPDATE " . DB_PREFIX . "property_agent SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', date_modified=now() WHERE property_agent_id = '" . (int)$property_agent_id . "'");
		}

		$query = $this->db->query($sql);

	}

	

	public function approve($property_agent_id){
		$this->db->query("UPDATE " . DB_PREFIX . "property_agent SET approved = '1' WHERE property_agent_id = '" . (int)$property_agent_id . "'");

	/// Agent Approve To Mail ///
		
		$this->load->model('property/mail');
		$this->load->model('property/agent');
		$type = 'agent_approved_mail';
		
		$mailinfo = $this->model_property_mail->getMailInfo($type);
		$agent_info = $this->model_property_agent->getpropertyform($property_agent_id);
		
		if(!empty($mailinfo['message'])){
			if(isset($mailinfo['type'])){
			$find = array(
				'{agentname}',
				'{email}',
				'{contact}',
				'{positions}',
				'{country_id}',
				'{zone_id}',
				
			);
			
			if(isset($agent_info['agentname'])) {
				$agentname = $agent_info['agentname'];
			} else {
				$agentname='';
			}
			
			if(isset($agent_info['email'])) {
				$emails = $agent_info['email'];
			} else {
				$emails='';
			}

			if(isset($agent_info['contact'])) {
				$contact = $agent_info['contact'];
			} else {
				$contact='';
			}

			if(isset($agent_info['positions'])) {
				$positions = $agent_info['positions'];
			} else {
				$positions='';
			}
			
			if(isset($agent_info['city'])) {
				$city = $agent_info['city'];
			} else {
				$city='';
			}

			$this->load->model('localisation/country');
			$country_info = $this->model_localisation_country->getCountry($agent_info['country_id']);
			if(isset($country_info['name'])) {
				$countryname = $country_info['name'];
			} else {
				$countryname='';
			}

			$this->load->model('localisation/zone');
			$zone_info = $this->model_localisation_zone->getZone($agent_info['zone_id']);
			if(isset($zone_info['name'])) {
				$zonename = $zone_info['name'];
			} else {
				$zonename='';
			}


			$replace = array(
				'agentname'	=> $agentname,
				'emails'	=> $emails,
				'contact'	=> $contact,
				'positions'	=> $positions,
				'country_id'=> $countryname,
				'zone_id'	=> $zonename,
				
			);
			

			$subject = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['subject']))));

			$message = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['message']))));
			
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($emails);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
					
		}
	}

	}



	public function Disapprove($property_agent_id){

		$this->db->query("UPDATE " . DB_PREFIX . "property_agent SET approved = '0' WHERE property_agent_id = '" . (int)$property_agent_id . "'");

	}



	//////// Select-edit ////////

	public function getAgent($property_agent_id){

		$sql="select * from " . DB_PREFIX . "property_agent where property_agent_id='".$property_agent_id."'";

		$query=$this->db->query($sql);

		return $query->row;

	}

	//// delete //////
/// 02 October 2018 ///
	public function deleteAgent($property_agent_id){

		$this->load->model('property/agent');
		$this->model_property_agent->getHideProperty($property_agent_id);

		$sql="delete  from " . DB_PREFIX . "property_agent where property_agent_id='".$property_agent_id."'";

		$query=$this->db->query($sql);

	}

	public function getHideProperty($property_agent_id) {
		$property_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."property_agent WHERE property_agent_id='".(int)$property_agent_id."'");
		foreach ($query->rows as $result) {
			$this->db->query("UPDATE " . DB_PREFIX . "property SET approved = '0' WHERE property_agent_id = '" . (int)$result['property_agent_id'] . "'");
	 	}
	}

	public function getAgentByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		return $query->row;
	}
	

/// 02 October 2018 ///

	public function getTotalAgent($data){

		$sql="SELECT COUNT(*) AS total from " . DB_PREFIX . "property_agent where property_agent_id<>0 ";

		if (isset($data['filter_agentname'])){

			$sql .=" and agentname like '".$this->db->escape($data['filter_agentname'])."%'";

		}
		if (isset($data['filter_email'])){

			$sql .=" and email like '".$this->db->escape($data['filter_email'])."%'";

		}

		if (isset($data['filter_status'])){

			$sql .=" and status like '".$this->db->escape($data['filter_status'])."%'";

		}

		$query = $this->db->query($sql);

			return $query->row['total'];	

	}

}