<?php
class ModelPropertygallery extends Model {

	public function addgallery($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "album SET sort_order = '" . (int)$data['sort_order'] . "',
		status = '" . (int)$data['status'] . "',date_modified = NOW(), date_added = NOW()");
		$album_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "album SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE album_id = '" . (int)$album_id . "'");
		}
		
		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'album_id=" . (int)$album_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		foreach ($data['album_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "album_description SET album_id = '" . (int)$album_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',  description = '" . $this->db->escape($value['description']) . "'");
		}
	}
	public function getgallarieid($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "album a LEFT JOIN " . DB_PREFIX . "album_description ad ON (a.album_id = ad.album_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'AND a.type = '2'";
			$query = $this->db->query($sql);
			return $query->rows;
		}
		
	public function editgallery($album_id, $data){
		$this->db->query("UPDATE " . DB_PREFIX . "album SET sort_order = '" . (int)$data['sort_order'] . "',status = '" . (int)$data['status'] . "',
		date_modified = NOW() WHERE album_id = '" . (int)$album_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "album SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE album_id = '" . (int)$album_id . "'");
		}
		
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'album_id=" . (int)$album_id . "'");

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'album_id=" . (int)$album_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "album_description WHERE album_id = '" . (int)$album_id . "'");

		foreach ($data['album_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "album_description SET album_id = '" . (int)$album_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
	
	}
	public function getProject($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "album a LEFT JOIN " . DB_PREFIX . "album_description ad ON (a.album_id = ad.album_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'AND a.type = '1'";
			$query = $this->db->query($sql);
			return $query->rows;
	}
		
	public function getgallery($album_id){
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'album_id=" . (int)$album_id . "') AS keyword FROM " . DB_PREFIX . "album WHERE album_id = '" .(int)$album_id ."'");
		return $query->row;
	}
	
	
	
	
	public function getgallaries($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "album a LEFT JOIN " . DB_PREFIX . "album_description ad ON (a.album_id = ad.album_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (!empty($data['filter_profile'])) {
			$sql .= " AND a.profile_id LIKE '" . $this->db->escape($data['filter_profile']) . "%'";
		}
		
		if (!empty($data['filter_status'])) {
			$sql .= " AND a.status LIKE '" . $this->db->escape($data['filter_status']) . "%'";
		}
		
		if (!empty($data['filter_type'])) {
			$sql .= " AND a.type LIKE '" . $this->db->escape($data['filter_type']) . "%'";
		}
		
		$sort_data = array(
			'ad.name',
			'a.profile_id',
			'a.type'
		);
		
		$sql .= " GROUP BY a.album_id ORDER BY name";
		
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
	
	public function deletegallery($album_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "album WHERE album_id = '" . (int)$album_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "album_description WHERE album_id = '" . (int)$album_id . "'");
	} 
				
	public function getgalleryDescriptions($album_id) {
		$album_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "album_description WHERE album_id = '" . (int)$album_id . "'");
		
		foreach ($query->rows as $result) {
			$album_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}
		
		return $album_description_data;
	}	
	
	public function getTotalgallaries() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "album");
		
		return $query->row['total'];
	}	
		
	public function getTotalgallariesByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "album WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}
	
	public function getRecentGallery() {
	

	$query = $this->db->query("SELECT * FROM ".DB_PREFIX."album a left join ".DB_PREFIX."album_description ad on(a.album_id = ad.album_id) GROUP BY a.album_id ORDER BY a.date_added DESC LIMIT 0,5");
		
		return $query->rows;
		
	}

	public function getTotalalbum($album_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "album_photos where album_id = '".$album_id."'");
		return $query->row['total'];
	}
}
?>