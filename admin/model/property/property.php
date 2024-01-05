<?php
class ModelPropertyProperty extends Model{

	public function addProperty($data){
		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

	    $this->load->model('property/custom_field');
		$customer_group_info = $this->model_property_custom_field->getCustomField($customer_group_id);

		$sql= $this->db->query("INSERT INTO " . DB_PREFIX . "property set area_type='" .$data['area_type']."',image='" . $data['image_thumb'] . "',video='" . $data['video'] . "',country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',city='" .  $this->db->escape($data['city']) . "',pincode='" . $data['pincode'] ."',local_area='" . $this->db->escape($data['local_area']) ."',latitude='" . $data['latitude'] . "',longitude='" . $data['longitude'] . "',neighborhood='" . $data['neighborhood'] . "',area='" .(int) $data['area'] . "',approved='" .(int)$data['approved'] . "',bedrooms='" .(int) $data['bedrooms'] ."',bathrooms='" .(int) $data['bathrooms'] ."',roomcount='" .(int) $data['roomcount'] ."',Parkingspaces='" .(int) $data['Parkingspaces'] ."',builtin='" .(int) $data['builtin'] ."',price='" . (int) $data['price'] ."',property_status_id='" . (int) $data['property_status_id'] . "',property_agent_id='" . (int) $data['property_agent_id'] . "',sort_order='" . (int) $data['sort_order'] . "',custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "',status='" . (int) $data['status'] . "', date_added=now()");
		$property_id = $this->db->getLastId();

		foreach ($data['Property_description'] as $language_id => $value){
			$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_description SET property_id ='" . (int) $property_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($value['name']) . "',description='" . $this->db->escape($value['description']) . "',meta_title='" . $this->db->escape($value['meta_title']) . "',meta_description='" . $this->db->escape($value['meta_description']) . "',meta_keyword='" . $this->db->escape($value['meta_keyword']) . "',tag='" . $this->db->escape($value['tag']) . "'");
		}

		if (isset($data['images_tab'])){
			foreach ($data['images_tab'] as $images_tab){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_images SET property_id = '" . (int) $property_id . "',image = '" . $this->db->escape($images_tab['image']) . "', title = '" . $this->db->escape($images_tab['title']) . "', alt = '" . $this->db->escape($images_tab['alt']) . "'");
			}
		}

		if (isset($data['features'])){
			foreach ($data['features'] as $feature_id){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_feature SET property_id = '" . (int) $property_id . "',feature_id = '" . (int)$feature_id . "'");
			}
		}

		if (!empty($data['nearestplace'])){
			foreach ($data['nearestplace'] as $key=>$value){
				if(!empty($value)){
					$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_neareast_place SET property_id = '" . (int) $property_id . "',nearest_place_id='" . $this->db->escape($key) . "',destinies='" . $this->db->escape($value) ."'");
				}
			}
		}

		if (isset($data['category_id'])){
			foreach ($data['category_id'] as $category_id){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_to_category SET property_id = '" . (int) $property_id . "',category_id='" . $category_id . "'");
			}
		}

		return $property_id;

	}

	public function getPropertyName($property_id){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_description WHERE property_id = '" . (int) $property_id . "'");

		return $query->row;

	}

	public function getAgent($property_agent_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_agent WHERE property_agent_id = '" . (int) $property_agent_id . "'");
		return $query->row;
	}

	public function getPropertyStatus($property_status_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_status WHERE property_status_id = '" . (int) $property_status_id . "' and language_id='" . $this->config->get('config_language_id') . "'");
		return $query->row;
	}

	public function getNearestplaceid($property_id,$nearest_place_id){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_neareast_place  WHERE property_id = '" .$property_id . "' and nearest_place_id='".$nearest_place_id."'");

		if(isset($query->row['destinies'])){

			return $query->row['destinies'];

		} else {

			return '';

		}

	}

	public function getPropertys($data){

		$sql = "select *from " . DB_PREFIX . "property p left join " . DB_PREFIX . "property_description ppd on p.property_id=ppd.property_id where ppd.language_id='" . $this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])){

			$sql .= " and ppd.name like '" . $this->db->escape($data['filter_name']) . "%'";

		}

		if (isset($data['filter_status'])){

			$sql .= " and p.status like '" . $this->db->escape($data['filter_status']) . "%'";

		}

		///    

		if (!empty($data['filter_propertystatus'])){

			$sql .= "and p.property_status_id like '" .$this->db->escape($data['filter_propertystatus']) . "%'";

		} 

		if (!empty($data['filter_agent'])){

			$sql .= "and p.property_agent_id like '" .$this->db->escape($data['filter_agent']) . "%'";

		}

		

		if (!empty($data['filter_price_from'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_from']) . "%'";

		}

		if (!empty($data['filter_price_to'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_to']) . "%'";

		}

		$sort_data = array(

			'ppd.name',

			'p.status',

			'p.property_status_id',

			'p.price',

			'p.date_added',

			'p.property_agent_id',

		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){

			$sql .= " ORDER BY " . $data['sort'];

		} else {

			$sql .= " ORDER BY p.property_id";}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {

			$sql .= " DESC";

		} else {

			$sql .= " ASC";

		}

		if (isset($data['start']) || isset($data['limit'])){

			if ($data['start'] < 0){

				$data['start'] = 0;

			}

			if ($data['limit'] < 1){

				$data['limit'] = 20;

			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];

		}

		$query = $this->db->query($sql);

		return $query->rows;



	}

	public function deleteProperty($property_id){

		$this->db->query("DELETE FROM " . DB_PREFIX . "property WHERE property_id = '" . (int)$property_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "property_description WHERE property_id = '" . (int)$property_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "property_images WHERE property_id = '" . (int)$property_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "property_to_category WHERE property_id = '" . (int)$property_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "property_neareast_place WHERE property_id = '" . (int)$property_id . "'");

		$this->cache->delete('property');

	}

	public function getPropertyEdit($property_id){

		$sql = "select * from " . DB_PREFIX . "property where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->row;

	}

	public function getPropertyDescription($property_id){

		$property_descriptio_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_description WHERE property_id = '" . (int) $property_id . "'");

		foreach ($query->rows as $result){

			$property_descriptio_data[$result['language_id']] = array(

				'name' => $result['name'],

				'description' => $result['description'],

				'meta_title' => $result['meta_title'],

				'meta_description' => $result['meta_description'],

				'meta_keyword' => $result['meta_keyword'],

				'tag' => $result['tag']

			);

		}

		return $property_descriptio_data;

	}

	public function getPropertyImages($property_id){

		$sql = "select * from " . DB_PREFIX . "property_images where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->rows;

	}

	public function getpropertycategory($property_id){

		$sql = "select * from " . DB_PREFIX . "property_to_category where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->rows;

	}

	public function getpropertycategoryid($property_id){

		$category_id = array();

		$sql   = "select * from " . DB_PREFIX . "property_to_category where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		foreach ($query->rows as $result){

			$category_id[] = $result['category_id'];

		}

		return $category_id;

	}

	public function getpropertyneareastplace($property_id){

		$sql = "select * from " . DB_PREFIX . "property_neareast_place where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		return $query->rows;

	}

	public function getpropertyfeature($property_id){

		$feature_id = array();

		$sql   = "select * from " . DB_PREFIX . "property_feature where property_id='" . $property_id . "'";

		$query = $this->db->query($sql);

		foreach ($query->rows as $result){

			$feature_id[] = $result['feature_id'];

		}

			return $feature_id;

	}

	public function editProperty($property_id, $data){	

		///input
		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

	    $this->load->model('property/custom_field');
		$customer_group_info = $this->model_property_custom_field->getCustomField($customer_group_id);


		$sql = "update " . DB_PREFIX . "property set area_type='" .$data['area_type']."', image='" . $data['image_thumb'] . "',custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "',

		video='" . $data['video'] . "',country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',city='" . $this->db->escape($data['city']) . "',pincode='" . $data['pincode'] . "',local_area='" . $this->db->escape($data['local_area']). "',approved='" .(int)$data['approved'] . "',latitude='" . $data['latitude'] . "',longitude='" . $data['longitude'] . "',price='" . (int) $data['price'] . "',neighborhood='" . $data['neighborhood'] . "',area='" .(int) $data['area'] . "',bedrooms='" .(int) $data['bedrooms'] . "',bathrooms='" .(int) $data['bathrooms'] . "',roomcount='" .(int) $data['roomcount'] . "',Parkingspaces='" .(int) $data['Parkingspaces'] . "',builtin='" .(int) $data['builtin'] . "',property_status_id='" . (int) $data['property_status_id'] . "',property_agent_id='" . (int) $data['property_agent_id'] . "',sort_order='" . (int) $data['sort_order'] . "',sort_order='" . (int) $data['sort_order'] . "',status='" . (int) $data['status'] . "',date_modified=now() where property_id='" . $property_id . "'";

		$this->db->query($sql);$this->db->query("delete from " . DB_PREFIX . "property_description where  property_id = '" . (int) $property_id . "'");

		foreach ($data['Property_description'] as $language_id => $value){

			$this->db->query("INSERT INTO " . DB_PREFIX . "property_description SET property_id = '" . (int) $property_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($value['name']) . "',	description = '" . $this->db->escape($value['description']) . "',

			meta_title = '" . $this->db->escape($value['meta_title']) . "',meta_description = '" . $this->db->escape($value['meta_description']) . "',meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "',                                  

			tag = '" . $this->db->escape($value['tag']) . "'");

		}

		$this->db->query("delete from " . DB_PREFIX . "property_neareast_place where  property_id = '" . (int) $property_id . "'");

		

		if (!empty($data['nearestplace'])){

			foreach ($data['nearestplace'] as $key=>$value){

				if(!empty($value)){

					$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_neareast_place SET property_id = '" . (int) $property_id . "',nearest_place_id='" . $this->db->escape($key) . "',destinies='" . $this->db->escape($value) ."'");

				}

			}

		}



		$this->db->query("delete from " . DB_PREFIX . "property_feature where  property_id = '" . (int) $property_id . "'");

		

		if (isset($data['features'])){

			foreach ($data['features'] as $feature_id){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_feature SET property_id = '" . (int) $property_id . "',feature_id = '" . (int)$feature_id . "'");

			}

		}

		$this->db->query("delete from " . DB_PREFIX . "property_to_category where  property_id = '" . (int) $property_id . "'");

		if (isset($data['category_id'])){

			foreach ($data['category_id'] as $category_id){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_to_category SET property_id = '" . (int) $property_id . "',category_id='" . $category_id . "'");

			}

		}

		$this->db->query("delete from " . DB_PREFIX . "property_images where property_id = '" .(int) $property_id . "'");

			if (isset($data['images_tab'])){

			foreach ($data['images_tab'] as $images_tab){

				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "property_images SET property_id = '" . (int) $property_id . "',image = '" . $this->db->escape($images_tab['image']) . "', title = '" . $this->db->escape($images_tab['title']) . "', alt = '" . $this->db->escape($images_tab['alt']) . "'");

			}

		}

	}

	public function approve($property_id){
		$this->db->query("UPDATE " . DB_PREFIX . "property SET approved = '1' WHERE property_id = '" . (int)$property_id . "'");

		/// Property Approve To Mail ///
		
		$this->load->model('property/mail');
		$this->load->model('property/property');
		$type = 'property_approved_mail';
		
		$mailinfo = $this->model_property_mail->getMailInfo($type);
		$property_info = $this->model_property_property->getProperty($property_id);
		if(isset($property_info['property_agent_id'])) {
			$agent_info = $this->model_property_property->getAgent($property_info['property_agent_id']);
		}
		
	if(!empty($agent_info['agentname'])){
		if(!empty($mailinfo['message'])){
			if(isset($mailinfo['type'])){
			$find = array(
				'{agentname}',										
				'{emails}',		
				'{contact}',								
				'{propertyname}',										
				'{country_id}',
				'{zone_id}'								
			);

			if(isset($property_info['name'])) {
				$propertyname = $property_info['name'];
			} else {
				$propertyname='';
			}
			
			if(isset($agent_info['agentname'])) {
				$agentname = $agent_info['agentname'];
			} else {
				$agentname='';
			}

			if(isset($agent_info['contact'])) {
				$contact = $agent_info['contact'];
			} else {
				$contact='';
			}
			
			if(isset($agent_info['email'])) {
				$emails = $agent_info['email'];
			} else {
				$emails='';
			}

			$this->load->model('localisation/country');
			$country_info = $this->model_localisation_country->getCountry($property_info['country_id']);
			if(isset($country_info['name'])) {
				$countryname = $country_info['name'];
			} else {
				$countryname='';
			}

			$this->load->model('localisation/zone');
			$zone_info = $this->model_localisation_zone->getZone($property_info['zone_id']);
			if(isset($zone_info['name'])) {
				$zonename = $zone_info['name'];
			} else {
				$zonename='';
			}

			$replace = array(
				'agentname'	=> $agentname,
				'emails'	=> $emails,
				'contact'	=> $contact,
				'propertyname'=> $propertyname,
				'country_id'=> $countryname,
				'zone_id'=> $zonename,
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

	}



	public function Disapprove($property_id){

		$this->db->query("UPDATE " . DB_PREFIX . "property SET approved = '0' WHERE property_id = '" . (int)$property_id . "'");

	}



	public function getTotalProperty($data) {

		$sql = "SELECT COUNT(DISTINCT p.property_id) AS total FROM " . DB_PREFIX . "property p LEFT JOIN " . DB_PREFIX . "property_description ppd ON (p.property_id = ppd.property_id)";

		$sql .= " WHERE ppd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (isset($data['filter_name'])){

			$sql .= " and ppd.name like '" . $this->db->escape($data['filter_name']) . "%'";

		}

		if (isset($data['filter_status'])){

			$sql .= " and p.status like '" . $this->db->escape($data['filter_status']) . "%'";

		}

		///   

		if (isset($data['filter_agent'])){

			$sql .= "and p.property_agent_id like '" .$this->db->escape($data['filter_agent']) . "%'";

		}

		if (isset($data['filter_propertystatus'])){

			$sql .= "and p.property_status_id like '" .$this->db->escape($data['filter_propertystatus']) . "%'";

		}   

		if (isset($data['filter_price_from'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_from']) . "%'";

		}

		if (isset($data['filter_price_to'])){

			$sql .= "and p.price like '" .$this->db->escape($data['filter_price_to']) . "%'";

		}

		$query = $this->db->query($sql);

		return $query->row['total'];

	}

	

	// Extra Fields End

	public function getProperty($product_id) {

		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "property p LEFT JOIN " . DB_PREFIX . "property_description pd ON (p.property_id = pd.property_id) WHERE p.property_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");



		return $query->row;

	}	

}