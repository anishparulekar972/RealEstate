<?php
class ModelTmdblogBlog extends Model {
	public function addBlog($data) {
		

		$this->db->query("INSERT INTO " . DB_PREFIX . "blog SET  sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', blogcoment = '" . (int)$data['blogcoment'] . "', user_id = '" . (int)$data['user_id'] . "', date_modified = NOW(), date_added = NOW()");

		$blog_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_id = '" . (int)$blog_id . "'");
		}
		
		if (isset($data['blog_category'])) {
			foreach ($data['blog_category'] as $tmdblogcategory_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_tmdblogcategory SET blog_id = '" . (int)$blog_id . "', tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");
			}
		}
		
		foreach ($data['blog_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_description SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		

		// Set which layout to use with this blog
		
		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblog_url_alias SET query = 'blog_id=" . (int)$blog_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('blog');

		

		return $blog_id;
	}

	public function editBlog($blog_id, $data) {
	
		$this->db->query("UPDATE " . DB_PREFIX . "blog SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', blogcoment = '" . (int)$data['blogcoment'] . "',  user_id = '" . (int)$data['user_id'] . "', date_modified = NOW() WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blog SET image = '" . $this->db->escape($data['image']) . "' WHERE blog_id = '" . (int)$blog_id . "'");
		}
		
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_tmdblogcategory WHERE blog_id = '" . (int)$blog_id . "'");

		if (isset($data['blog_category'])) {
			foreach ($data['blog_category'] as $tmdblogcategory_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "blog_to_tmdblogcategory SET blog_id = '" . (int)$blog_id . "', tmdblogcategory_id = '" . (int)$tmdblogcategory_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($data['blog_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "blog_description SET blog_id = '" . (int)$blog_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		

		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblog_url_alias WHERE query = 'blog_id=" . (int)$blog_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "tmdblog_url_alias SET query = 'blog_id=" . (int)$blog_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('blog');
		
		
	}

	public function deleteBlog($blog_id) {
		

		$this->db->query("DELETE FROM " . DB_PREFIX . "blog WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "blog_to_tmdblogcategory WHERE blog_id = '" . (int)$blog_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "tmdblog_url_alias WHERE query = 'blog_id=" . (int)$blog_id . "'");

		$this->cache->delete('blog');

		
	}

	

	public function getBlog($blog_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "tmdblog_url_alias WHERE query = 'blog_id=" . (int)$blog_id . "') AS keyword FROM " . DB_PREFIX . "blog b left join " . DB_PREFIX . "blog_description bd ON (b.blog_id = bd.blog_id) WHERE b.blog_id = '" . (int)$blog_id . "'");

		return $query->row;
	}

	public function getTmdBlogcategories($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "blog a LEFT JOIN " . DB_PREFIX . "blog_description ad ON (a.blog_id = ad.blog_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND a.status = '" . (int)$data['filter_status'] . "'";
			}
			
			
			if (!empty($data['filter_date_added'])) {
				$sql .= " AND DATE(a.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
			}
			
		$sql .= " GROUP BY ad.blog_id";

		$sort_data = array(
			'ad.name',
			'a.status',
			'a.date_added',
			'a.sort_order',
			'a.viewed'
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

	public function getBlogDescriptions($blog_id) {
		$blog_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_description WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description'],
				'tag'              => $result['tag']
			);
		}

		return $blog_description_data;
	}

	

	public function getBlogStores($blog_id) {
		$blog_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_store WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_store_data[] = $result['store_id'];
		}

		return $blog_store_data;
	}



	public function getTotalTmdBlog($data = array()) {
		
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog a LEFT JOIN " . DB_PREFIX . "blog_description ad ON (a.blog_id = ad.blog_id)";
		
		$sql .= " WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND a.status = '" . (int)$data['filter_status'] . "'";
			}
			
			
			if (!empty($data['filter_date_added'])) {
				$sql .= " AND DATE(a.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
			}
			
			
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getBlogBlogcategories($blog_id) {
		$blog_blogcategory_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blog_to_tmdblogcategory WHERE blog_id = '" . (int)$blog_id . "'");

		foreach ($query->rows as $result) {
			$blog_blogcategory_data[] = $result['tmdblogcategory_id'];
		}

		return $blog_blogcategory_data;
	}
	
	public function getComments($blog_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "blogcomment  where blog_id = '". (int)$blog_id ."'");

		return $query->rows;
	}
	
	public function deleteComment($comment_id){
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "blogcomment WHERE comment_id = '" . (int)$comment_id . "'");
	}
	
	
	public function getRecentBlogs() {
	
		$query = $this->db->query("SELECT *,   b.blog_id as blogid FROM ".DB_PREFIX."blog b left join ".DB_PREFIX."blog_description bd on(b.blog_id = bd.blog_id) left join ".DB_PREFIX."blogcomment bc on(b.blog_id = bc.blog_id) GROUP BY b.blog_id ORDER BY b.date_added DESC LIMIT 0,5");
		
		return $query->rows;
	}
	
	public function gettotalcomment($blog_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blogcomment where blog_id = '".$blog_id."'");
		return $query->row['total'];
	}
		
}
