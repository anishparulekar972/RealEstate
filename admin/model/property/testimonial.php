<?php
class ModelPropertyTestimonial extends Model {
	public function addtestimonial($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "testimonial SET name = '" . $this->db->escape($data['author']) . "',country = '" . $this->db->escape($data['country']) . "', image = '" . $this->db->escape($data['image']) . "', enquiry = '" . $this->db->escape(strip_tags($data['text'])) . "',status = '" . (int)$data['status'] . "', date = NOW()");
	
		//$this->cache->delete('product');
	}
	public function edittestimonial($testimonial_id, $data){
		$this->db->query("UPDATE " . DB_PREFIX . "testimonial SET name = '" . $this->db->escape($data['author']) . "', country = '" . $this->db->escape($data['country']) . "', image = '" . $this->db->escape($data['image']) . "', enquiry = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date = NOW() WHERE testimonial_id = '" . (int)$testimonial_id . "'");
			
		//$this->cache->delete('product');
	}
	
	public function deletetestimonial($testimonial_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "testimonial WHERE testimonial_id = '" . (int)$testimonial_id . "'");
		
		//$this->cache->delete('product');
	}
	
	public function gettestimonial($testimonial_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "testimonial WHERE testimonial_id = '".(int)$testimonial_id ."'");
		return $query->row;
	}
	
	public function gettestimonials($data = array()) {
	 
		$sql = "SELECT  r.testimonial_id, r.name, r.country,  r.status, r.date FROM " . DB_PREFIX . "testimonial r";
		$sort_data = array(
			'r.name',
			'r.status',
			'r.country',
			'r.date'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY r.date";	
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
	
	public function getTotaltestimonials($data) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "testimonial");
		
		return $query->row['total'];
	}
	
	public function getTotaltestimonialsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "testimonial WHERE status = '0'");
		
		return $query->row['total'];
	}	
}
?>