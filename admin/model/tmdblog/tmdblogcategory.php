<?php
class ModelTmdblogTmdblogcategory extends Model {
	public function addTmdblogcategory($data) {
		

		$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblogcategory SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$tmdblogcategory_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "tmdblogcategory SET image = '" . $this->db->escape($data['image']) . "' WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");
		}

		foreach ($data['tmdblogcategory_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblogcategory_description SET tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "tmdblogcategory_path` SET `tmdblogcategory_id` = '" . (int)$tmdblogcategory_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "tmdblogcategory_path` SET `tmdblogcategory_id` = '" . (int)$tmdblogcategory_id . "', `path_id` = '" . (int)$tmdblogcategory_id . "', `level` = '" . (int)$level . "'");

		

		if (isset($data['tmdblogcategory_store'])) {
			foreach ($data['tmdblogcategory_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblogcategory_to_store SET tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this tmdblogcategory
		
		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblog_url_alias SET query = 'tmdblogcategory_id=" . (int)$tmdblogcategory_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('tmdblogcategory');

		

		return $tmdblogcategory_id;
	}

	public function editTmdblogcategory($tmdblogcategory_id, $data) {
		

		$this->db->query("UPDATE " . DB_PREFIX . "tmdblogcategory SET parent_id = '" . (int)$data['parent_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "tmdblogcategory SET image = '" . $this->db->escape($data['image']) . "' WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblogcategory_description WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");

		foreach ($data['tmdblogcategory_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblogcategory_description SET tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE path_id = '" . (int)$tmdblogcategory_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $tmdblogcategory_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_path['tmdblogcategory_id'] . "' AND level < '" . (int)$tmdblogcategory_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_path['tmdblogcategory_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "tmdblogcategory_path` SET tmdblogcategory_id = '" . (int)$tmdblogcategory_path['tmdblogcategory_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "tmdblogcategory_path` SET tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "tmdblogcategory_path` SET tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "', `path_id` = '" . (int)$tmdblogcategory_id . "', level = '" . (int)$level . "'");
		}

		

		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblogcategory_to_store WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");

		if (isset($data['tmdblogcategory_store'])) {
			foreach ($data['tmdblogcategory_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblogcategory_to_store SET tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		

		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblog_url_alias WHERE query = 'tmdblogcategory_id=" . (int)$tmdblogcategory_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblog_url_alias SET query = 'tmdblogcategory_id=" . (int)$tmdblogcategory_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('tmdblogcategory');

		
	}

	public function deleteTmdblogcategory($tmdblogcategory_id) {
		

		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblogcategory_path WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblogcategory_path WHERE path_id = '" . (int)$tmdblogcategory_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteTmdblogcategory($result['tmdblogcategory_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblogcategory WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblogcategory_description WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblogcategory_to_store WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblog_url_alias WHERE query = 'tmdblogcategory_id=" . (int)$tmdblogcategory_id . "'");

		$this->cache->delete('tmdblogcategory');

		
	}

	public function repairTmdblogcategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblogcategory WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $tmdblogcategory) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory['tmdblogcategory_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "tmdblogcategory_path` WHERE tmdblogcategory_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "tmdblogcategory_path` SET tmdblogcategory_id = '" . (int)$tmdblogcategory['tmdblogcategory_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "tmdblogcategory_path` SET tmdblogcategory_id = '" . (int)$tmdblogcategory['tmdblogcategory_id'] . "', `path_id` = '" . (int)$tmdblogcategory['tmdblogcategory_id'] . "', level = '" . (int)$level . "'");

			$this->repairTmdblogcategories($tmdblogcategory['tmdblogcategory_id']);
		}
	}

	public function getTmdblogcategory($tmdblogcategory_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "tmdblogcategory_path cp LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description cd1 ON (cp.path_id = cd1.tmdblogcategory_id AND cp.tmdblogcategory_id != cp.path_id) WHERE cp.tmdblogcategory_id = c.tmdblogcategory_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.tmdblogcategory_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "tmdblog_url_alias WHERE query = 'tmdblogcategory_id=" . (int)$tmdblogcategory_id . "') AS keyword FROM " . DB_PREFIX . "tmdblogcategory c LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description cd2 ON (c.tmdblogcategory_id = cd2.tmdblogcategory_id) WHERE c.tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getTmdblogcategories($data = array()) {
		$sql = "SELECT cp.tmdblogcategory_id AS tmdblogcategory_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.image, c1.status, c1.date_added, c1.sort_order FROM " . DB_PREFIX . "tmdblogcategory_path cp LEFT JOIN " . DB_PREFIX . "tmdblogcategory c1 ON (cp.tmdblogcategory_id = c1.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory c2 ON (cp.path_id = c2.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description cd1 ON (cp.path_id = cd1.tmdblogcategory_id) LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description cd2 ON (cp.tmdblogcategory_id = cd2.tmdblogcategory_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND c1.status = '" . (int)$data['filter_status'] . "'";
			}
			
			
			if (!empty($data['filter_date_added'])) {
				$sql .= " AND DATE(c1.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
			}
			
		$sql .= " GROUP BY cp.tmdblogcategory_id";

		$sort_data = array(
			'name',
			'status',
			'date_added',
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

	public function getTmdblogcategoryDescriptions($tmdblogcategory_id) {
		$tmdblogcategory_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblogcategory_description WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");

		foreach ($query->rows as $result) {
			$tmdblogcategory_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description'],
				'tag'              => $result['tag']
			);
		}

		return $tmdblogcategory_description_data;
	}

	

	public function getTmdblogcategoryStores($tmdblogcategory_id) {
		$tmdblogcategory_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblogcategory_to_store WHERE tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");

		foreach ($query->rows as $result) {
			$tmdblogcategory_store_data[] = $result['store_id'];
		}

		return $tmdblogcategory_store_data;
	}



	public function getTotalTmdblogcategories($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "tmdblogcategory c1 LEFT JOIN " . DB_PREFIX . "tmdblogcategory_description cd2 on(c1.tmdblogcategory_id = cd2.tmdblogcategory_id)";
		
		$sql .= " WHERE cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND c1.status = '" . (int)$data['filter_status'] . "'";
			}
			
			
			if (!empty($data['filter_date_added'])) {
				$sql .= " AND DATE(c1.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
			}
			
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getBlogcount($tmdblogcategory_id){
	 $query = $this->db->query("select COUNT(*) AS total from ". DB_PREFIX ."blog_to_tmdblogcategory WHERE tmdblogcategory_id = '".$tmdblogcategory_id."'");
		
		return $query->row['total'];
	}	
}
