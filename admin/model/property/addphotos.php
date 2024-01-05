<?php
class ModelPropertyaddphotos extends Model {
	public function addaddphotos($data) { 
		
          $upload_files = array();
			if($data['uploader_count']) {
				$uploader_count = $data['uploader_count']-1;
				for($i = 0; $i<=$uploader_count; $i++){
					if(isset($data['uploader_'.$i.'_tmpname']) && trim($data['uploader_'.$i.'_status'])== 'done') {
						$upload_files[] = htmlentities(stripslashes($data['uploader_'.$i.'_tmpname']));
					}
				}
			}
			if(!empty($upload_files)) {
				foreach($upload_files as $image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "album_photos SET album_id = '" .$data['album_id'] . "',sort_order = '" . (int)$data['sort_order'] . "',image = '" . $this->db->escape('catalog/gallery/'. $image) . "'");
					$album_photos_id = $this->db->getLastId();
					foreach ($data['photo_description'] as $language_id => $value) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "album_photo_description SET album_photos_id = '" . (int)$album_photos_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',  description = '" . $this->db->escape($value['description']) . "'");
				}
					
			}
		}
		
	}
 public function editaddphotos($album_photos_id, $data) {
		
		$this->db->query("UPDATE " . DB_PREFIX . "album_photos SET 
		album_id = '" . (int)$data['album_id'] . "',sort_order = '" . (int)$data['sort_order'] . "' WHERE album_photos_id = '" . (int)$album_photos_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "album_photos SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE album_photos_id = '" . (int)$album_photos_id . "'");
		}
		
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "album_photo_description WHERE album_photos_id = '" . (int)$album_photos_id . "'");
		foreach ($data['photo_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "album_photo_description SET album_photos_id = '" . (int)$album_photos_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',  description = '" . $this->db->escape($value['description']) . "'");
		}
	}
	public function editMultipleImages($data, $album_photos_id, $album_id) {
	}
 public function DeleteAddPhotos($album_photos_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "album_photos WHERE album_photos_id = '" . (int)$album_photos_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "album_photo_description WHERE album_photos_id = '" . (int)$album_photos_id . "'");
	}	
 public function getaddphotos($album_photos_id){
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "album_photos where album_photos_id='".$album_photos_id."'");
	return $query->row;	
	}
 public function getaddphotoss($data = array()){
		$sql = "SELECT *,apd.name as adname,apd.name as album_name  FROM " . DB_PREFIX . "album_photos as ap Left join " .DB_PREFIX. "album_photo_description apd on(ap.album_photos_id=apd.album_photos_id) WHERE apd.language_id='".$this->config->get('config_language_id')."' AND apd.language_id='".$this->config->get('config_language_id')."' AND ap.album_id>0";
		
		if (isset($data['filter_albumname']) && $data['filter_albumname'] !== null) {
			$sql .= " AND ap.album_id = '" . (int)$data['filter_albumname'] . "'";
		}
		if (isset($data['filter_profile']) && $data['filter_profile'] !== null) {
			$sql .= " AND ap.profile_id = '" . (int)$data['filter_profile'] . "'";
		}
		
		$sort_data = array(
			'ap.album_id',
			'ap.profile_id',
			'ap.sort_order'
		);
		
	  if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY ap.album_id";	
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
 public function getphotoDescriptions($album_photos_id) {
		$album_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "album_photo_description WHERE album_photos_id = '" . (int)$album_photos_id . "'");
		
		foreach ($query->rows as $result) {
			$album_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description']
			);
		}
		
		return $album_description_data;
	}	
	
	public function getnameImages($album_photos_id) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."album_photos WHERE album_photos_id = '". (int)$album_photos_id ."' ORDER BY sort_order ASC ");
		
		return $query->rows;
	}
	

 public function getTotaladdphotossByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "album_photos WHERE image_id = '" . (int)$image_id . "'");

		return $query->row['total'];
	}
 
 public function getTotaladdphotoss($data = array()) {
     
	$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "album_photos as ap Left join " .DB_PREFIX. "album_photo_description apd on(ap.album_photos_id=apd.album_photos_id) WHERE apd.language_id='".$this->config->get('config_language_id')."' AND apd.language_id='".$this->config->get('config_language_id')."' AND ap.album_id>0";

		if (isset($data['filter_albumname']) && $data['filter_albumname'] !== null) {
			$sql .= " AND ap.album_id = '" . (int)$data['filter_albumname'] . "'";
		}
		if (isset($data['filter_profile']) && $data['filter_profile'] !== null) {
			$sql .= " AND ap.profile_id = '" . (int)$data['filter_profile'] . "'";
		}
	$query = $this->db->query($sql);


		return $query->row['total'];
	}	
}
?>