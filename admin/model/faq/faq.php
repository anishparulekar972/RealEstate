<?php
class ModelfaqFaq extends Model {
	public function addfaq($data) {
		
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "faq SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$faq_id = $this->db->getLastId();

		foreach ($data['faq_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET faq_id = '" . (int)$faq_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		if(isset($data['categories'])){
			foreach($data['categories'] as $fcategory_id){
				$this->db->query("INSERT INTO ".DB_PREFIX."faq_2_category SET fcategory_id = '".(int)$fcategory_id."',faq_id = '" . (int)$faq_id . "'");
			}
		}

		

		return $faq_id;
	}

	public function editfaq($faq_id, $data) {
		
		

		$this->db->query("UPDATE " . DB_PREFIX . "faq SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE faq_id = '" . (int)$faq_id . "'");

	
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE faq_id = '" . (int)$faq_id . "'");

		foreach ($data['faq_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET faq_id = '" . (int)$faq_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_2_category WHERE faq_id = '" . (int)$faq_id . "'");
		
		if(isset($data['categories'])){
			foreach($data['categories'] as $fcategory_id){
				$this->db->query("INSERT INTO ".DB_PREFIX."faq_2_category SET fcategory_id = '".(int)$fcategory_id."',faq_id = '" . (int)$faq_id . "'");
			}
		}
		
		$this->cache->delete('faq');

	
	}

	public function deletefaq($faq_id){
		

		$this->db->query("DELETE FROM " . DB_PREFIX . "faq WHERE faq_id = '" . (int)$faq_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE faq_id = '" . (int)$faq_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_2_category WHERE faq_id = '" . (int)$faq_id . "'");
		
		$this->cache->delete('faq');

	
	}

	public function getfaq($faq_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq c LEFT JOIN " . DB_PREFIX . "faq_description cd2 ON (c.faq_id = cd2.faq_id) WHERE c.faq_id = '" . (int)$faq_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getFAQs($data = array()){
		$sql = "SELECT *,(SELECT GROUP_CONCAT(DISTINCT spc.fcategory_id SEPARATOR ',') FROM ".DB_PREFIX."faq_2_category spc WHERE f.faq_id = spc.faq_id GROUP BY spc.faq_id) as fcategory_ids FROM ".DB_PREFIX."faq f LEFT JOIN ".DB_PREFIX."faq_description fd ON(f.faq_id = fd.faq_id) ";

		if(!empty($data['filter_category'])){
			$sql .=" LEFT JOIN ".DB_PREFIX."faq_2_category f2c ON(f.faq_id = f2c.faq_id)";
		}
		
		$sql .=" WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if(!empty($data['filter_name'])){
			$sql .= " AND fd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if(!empty($data['filter_category'])){
		  $sql .=" AND f2c.fcategory_id = '".(int)$data['filter_category']."'";
		}
		
		if(isset($data['filter_status'])){
		  $sql .=" AND f.status = '".(int)$data['filter_status']."'";
		}
		

		$sql .= " GROUP BY f.faq_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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

	public function getfaqDescriptions($faq_id){
		$faq_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_description WHERE faq_id = '" . (int)$faq_id . "'");

		foreach($query->rows as $result){
			$faq_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description' 	   => $result['description'],
			);
		}

		return $faq_description_data;
	}
	
	public function getfaqcategories($faq_id){
		$faq_categories_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_2_category WHERE faq_id = '" . (int)$faq_id . "'");

		foreach($query->rows as $result){
			$faq_categories_data[] = $result['fcategory_id'];
		}

		return $faq_categories_data;
	}
	
	public function getTotalCategories(){
		$sql = "SELECT * FROM ".DB_PREFIX."faq f LEFT JOIN ".DB_PREFIX."faq_description fd ON(f.faq_id = fd.faq_id) ";

		if(!empty($data['filter_category'])){
			$sql .=" LEFT JOIN ".DB_PREFIX."faq_2_category f2c ON(f.faq_id = f2c.faq_id)";
		}
		
		$sql .=" WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if(!empty($data['filter_name'])){
			$sql .= " AND fd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if(!empty($data['filter_category'])){
		  $sql .=" AND f2c.fcategory_id = '".(int)$data['filter_category']."'";
		}
		
		if(isset($data['filter_status'])){
		  $sql .=" AND f.status = '".(int)$data['filter_status']."'";
		}

		$sql .= " GROUP BY f.faq_id";
		
		$query = $this->db->query($sql);

		return count($query->rows);
	}
}