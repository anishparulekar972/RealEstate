<?php


class ModelPropertyUnits extends Model{	


	public function addOrderStatus($data){


		foreach ($data['property_unit'] as $language_id => $value){

		if (!empty($property_unit_id)){
			$this->db->query("INSERT INTO " . DB_PREFIX . "property_unit SET property_unit_id = '" . (int)$property_unit_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			}

		else{

			$this->db->query("INSERT INTO " . DB_PREFIX . "property_unit SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			$property_unit_id = $this->db->getLastId();
			}


		}


		$this->cache->delete('property_unit');


		return $property_unit_id;


	}


	public function editpropertystatus($property_unit_id, $data){


		$this->db->query("DELETE FROM " . DB_PREFIX . "property_unit WHERE property_unit_id = '" . (int)$property_unit_id . "'");


		foreach ($data['property_unit'] as $language_id => $value){


			$this->db->query("INSERT INTO " . DB_PREFIX . "property_unit SET property_unit_id = '" . (int)$property_unit_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");


		}


		$this->cache->delete('property_unit');


	}


	public function deletepropertystatus($property_unit_id){


		$this->db->query("DELETE FROM " . DB_PREFIX . "property_unit WHERE property_unit_id = '" . (int)$property_unit_id . "'");


		$this->cache->delete('property_unit');


	}


  public function getOrderStatus($property_unit_id){


		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_unit WHERE property_unit_id = '" . (int)$property_unit_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");


		return $query->row;


	}
	public function getpropertyunits(){


		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_unit WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' and property_unit_id<>0");


		return $query->rows;


	}





	public function getpropertystatusouto($data){


		$sql="SELECT * FROM " . DB_PREFIX . "property_unit where property_unit_id<>0 and language_id = '" . (int)$this->config->get('config_language_id') . "'";


		if (isset($data['filter_name']))


		{$sql .=" and name like '".$this->db->escape($data['filter_name'])."%'";


		}


		$sort_data = array(


		'name',


		'sort_order',


		);


		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {


		$sql .= " ORDER BY " . $data['sort'];


		} else {


		$sql .= " ORDER BY name";


		}


  	if (isset($data['order']) && ($data['order'] == 'DESC')) {


		$sql .= " DESC";


		} else {


		$sql .= " ASC";


		}





		if (isset($data['start']) || isset($data['limit'])) {


		if ($data['start'] < 0) {


		$data['start'] = 0;


		}


		if ($data['limit'] < 1) {


		$data['limit'] = 20;


		}


		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];


		}


		$query = $this->db->query($sql);


		return $query->rows;


	}








	public function getpropertystatus($data = array()){


		if ($data){


		$sql = "SELECT * FROM " . DB_PREFIX . "property_unit WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";


		$sort_data = array(


		'name',


		'sort_order',


		);


		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 


		{


		 $sql .= " ORDER BY " . $data['sort'];


		} 


		else


		{


		$sql .= " ORDER BY name";


		}


		if (isset($data['order']) && ($data['order'] == 'DESC')) 


		{


		$sql .= " DESC";


		} 


		else 


		{


		$sql .= " ASC";


		}


		if (isset($data['start']) || isset($data['limit'])) 


		{


		if ($data['start'] < 0) 


		{


		$data['start'] = 0;


		}





		if ($data['limit'] < 1) {


		$data['limit'] = 20;


		}





		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];


		}


		$query = $this->db->query($sql);


		return $query->rows;


		} 


		else{


			$property_status_data = $this->cache->get('property_unit.' . (int)$this->config->get('config_language_id'));


			if (!$property_status_data){


			$query = $this->db->query("SELECT property_unit_id, name FROM " . DB_PREFIX . "property_unit WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");


			$property_status_data = $query->rows;


			$this->cache->set('property_unit.' . (int)$this->config->get('config_language_id'), $property_status_data);


			}


			return $property_status_data;


	 }


 }





	public function getpropertystatusDescriptions($property_unit_id){


		$property_status_data = array();


		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "property_unit WHERE property_unit_id = '" . (int)$property_unit_id . "'");


		foreach ($query->rows as $result) 


		{


			$property_status_data[$result['language_id']] = array('name' => $result['name']);


		}


			return $property_status_data;


	}





  public function getTotalOrderStatuses(){


		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "property_unit WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");


		return $query->row['total'];


	}


	


	


	





}