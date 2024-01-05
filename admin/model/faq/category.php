<?php
class Modelfaqcategory extends Model {
	public function addCategory($data) {
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "fcategory SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$fcategory_id = $this->db->getLastId();

		foreach ($data['category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fcategory_description SET fcategory_id = '" . (int)$fcategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if(isset($data['keyword'])){
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'fcategory_id=" . (int)$fcategory_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		if(isset($data['category_store'])){
			foreach($data['category_store'] as $store_id){
			  $this->db->query("INSERT INTO " . DB_PREFIX . "fcategory_to_store SET fcategory_id = '" .(int)$fcategory_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		return $fcategory_id;
	}

	public function editCategory($fcategory_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "fcategory SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE fcategory_id = '" . (int)$fcategory_id . "'");

	
		$this->db->query("DELETE FROM " . DB_PREFIX . "fcategory_description WHERE fcategory_id = '" . (int)$fcategory_id . "'");

		foreach ($data['category_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fcategory_description SET fcategory_id = '" . (int)$fcategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "fcategory_to_store WHERE fcategory_id = '" . (int)$fcategory_id . "'");
		
		if(isset($data['category_store'])){
			foreach($data['category_store'] as $store_id){
			  $this->db->query("INSERT INTO " . DB_PREFIX . "fcategory_to_store SET fcategory_id = '" .(int)$fcategory_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'fcategory_id=" . (int)$fcategory_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'fcategory_id=" . (int)$fcategory_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('fcategory');
	}

	public function deleteCategory($fcategory_id){
		

		$this->db->query("DELETE FROM " . DB_PREFIX . "fcategory WHERE fcategory_id = '" . (int)$fcategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "faq_2_category WHERE fcategory_id = '" . (int)$fcategory_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "fcategory_description WHERE fcategory_id = '" . (int)$fcategory_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "fcategory_to_store WHERE fcategory_id = '" . (int)$fcategory_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'fcategory_id=" . (int)$fcategory_id . "'");

		$this->cache->delete('fcategory');
	}

	public function getCategory($fcategory_id){
		$query = $this->db->query("SELECT *,(SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'fcategory_id=" . (int)$fcategory_id . "') AS keyword  FROM " . DB_PREFIX . "fcategory c LEFT JOIN " . DB_PREFIX . "fcategory_description cd2 ON (c.fcategory_id = cd2.fcategory_id) WHERE c.fcategory_id = '" . (int)$fcategory_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getCategories($data = array()) {
		
		$sql = "SELECT * FROM ".DB_PREFIX."fcategory f LEFT JOIN ".DB_PREFIX."fcategory_description fd ON(f.fcategory_id = fd.fcategory_id) WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if(!empty($data['filter_name'])){
			$sql .= " AND fd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY f.fcategory_id";

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

	public function getCategoryDescriptions($fcategory_id) {
		$fcategory_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fcategory_description WHERE fcategory_id = '" . (int)$fcategory_id . "'");

		foreach ($query->rows as $result) {
			$fcategory_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
			);
		}

		return $fcategory_description_data;
	}

	public function getCategoryStores ($fcategory_id) {
		$fcategory_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fcategory_to_store WHERE fcategory_id = '" . (int)$fcategory_id . "'");

		foreach ($query->rows as $result) {
			$fcategory_store_data[] = $result['store_id'];
		}

		return $fcategory_store_data;
	}

	public function getTotalCategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fcategory f LEFT JOIN ".DB_PREFIX."fcategory_description fd ON(f.fcategory_id = fd.fcategory_id) WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		

		return $query->row['total'];
	}
}