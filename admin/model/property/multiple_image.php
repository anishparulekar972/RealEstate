<?php
class ModelPropertymultipleimage extends Model {
	public function addMultipleImages($data, $album_photos_id) {
		
		$photo_info = $this->getPhoto($album_photos_id);
		if($photo_info) {
			// P_UPloader Files
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
				$last_sort_order = $this->getLastSortOrderMultipleImages($album_photos_id);
				
				$j = $last_sort_order + 1; 
				foreach($upload_files as $image) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "album_photos SET album_id = '" . $this->db->escape($photo_info['album_id']) . "', images = '" . $this->db->escape('upload/'. $image) . "', sort_order = '" . $this->db->escape($j) . "'");
					$album_photos_id = $this->db->getLastId();
					
					$this->db->query("DELETE FROM " . DB_PREFIX . "album_photo_description WHERE album_photos_id = '" . (int)$album_photos_id . "'");
					foreach ($data['photo_description'] as $language_id => $value) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "album_photo_description SET album_photos_id = '" . (int)$album_photos_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',  description = '" . $this->db->escape($value['description']) . "'");
					}
					
					
					$j++;
				}
			}
		}
	}
	
	public function getMultipleImages($album_photos_id) {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."album_photos WHERE album_photos_id = '". (int)$album_photos_id ."' ORDER BY sort_order ASC ");
		
		return $query->rows;
	}
	

	
	public function getPhoto($album_photos_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "album_photos ap LEFT JOIN ". DB_PREFIX ."album_photo_description apd ON(ap.album_photos_id = apd.album_photos_id) WHERE language_id = '". $this->config->get('config_language_id') ."' AND ap.album_photos_id='". (int)$album_photos_id ."'");
		
		return $query->row;	
	}
	
	public function getLastSortOrderMultipleImages($album_photos_id) {
		$query = $this->db->query("SELECT sort_order FROM " . DB_PREFIX . "album_photos WHERE album_photos_id = '". (int)$album_photos_id ."' ORDER BY sort_order DESC LIMIT 0,1");
		
		if(!empty($query->row['sort_order'])) {
			$total = $query->row['sort_order'];
		}else{
			$total = 0;	
		}
		
		return $total;
	}
	
	public function getMainImage($album_photos_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "album_photos WHERE album_photos_id = '". (int)$album_photos_id ."' ORDER BY sort_order ASC LIMIT 0,1");
		
		return $query->row;
	}
}
