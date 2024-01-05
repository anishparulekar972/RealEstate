<?php


class ModelLocalisationZone extends Model {


	public function addZone($data) {


		$this->db->query("INSERT INTO " . DB_PREFIX . "zone SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', country_id = '" . (int)$data['country_id'] . "'");





		$this->cache->delete('zone');


		


		return $this->db->getLastId();


	}





	public function editZone($zone_id, $data) {


		$this->db->query("UPDATE " . DB_PREFIX . "zone SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', country_id = '" . (int)$data['country_id'] . "' WHERE zone_id = '" . (int)$zone_id . "'");





		$this->cache->delete('zone');


	}





	public function deleteZone($zone_id) {


		$this->db->query("DELETE FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "'");





		$this->cache->delete('zone');


	}





	public function getZone($zone_id) {


		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "'");





		return $query->row;


	}


	


		public function getZonesid($data = array()) {





			$sql = "SELECT * FROM " . DB_PREFIX . "zone where zone_id<>0 ";


				if (isset($data['filter_zone']))

				{
				$sql .="and name like '".$this->db->escape($data['filter_zone'])."%'";

				}

		

				$sort_data = array(


				'name',


				'iso_code_2',


				'iso_code_3'


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


	





	public function getZones($data) {


		$sql = "SELECT *, z.name, c.name AS country FROM " . DB_PREFIX . "zone z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id) where z.zone_id<>0";
		

		if (isset($data['filter_name'])){
			$sql .= " and c.name like '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_zone'])){
			$sql .= " and z.name like '" . $this->db->escape($data['filter_zone']) . "%'";
		}


	 


	$sort_data = array(


			'c.name',


			'z.name',


			'z.code'


		);





		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {


			$sql .= " ORDER BY " . $data['sort'];


		} else {


			$sql .= " ORDER BY c.name";


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


	public function getTotalAddressesByZoneId($zone_id) {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE zone_id = '" . (int)$zone_id . "'");

			return $query->row['total'];
	}


	public function getZonesByCountryId($country_id) {


		$zone_data = $this->cache->get('zone.' . (int)$country_id);





		if (!$zone_data) {


			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int)$country_id . "' AND status = '1' ORDER BY name");





			$zone_data = $query->rows;





			$this->cache->set('zone.' . (int)$country_id, $zone_data);


		}





		return $zone_data;


	}





	public function getTotalZones($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "zone z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id) where z.zone_id<>0";

		if (isset($data['filter_name'])){
			$sql .= " and c.name like '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_zone'])){
			$sql .= " and z.name like '" . $this->db->escape($data['filter_zone']) . "%'";
		}
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}





	public function getTotalZonesByCountryId($country_id) {


		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int)$country_id . "'");





		return $query->row['total'];


	}





}