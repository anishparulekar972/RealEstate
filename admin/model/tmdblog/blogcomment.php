<?php
class ModelTmdblogBlogcomment extends Model {
	public function addBlogcomment($data) {
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "blogcomment SET  sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', comment = '" . $this->db->escape($data['comment']) . "', blog_id= '" . (int)$data['blog_id'] . "', property_agent_id = '" . (int)$data['property_agent_id'] . "', date_added = NOW()");

		$comment_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blogcomment SET image = '" . $this->db->escape($data['image']) . "' WHERE comment_id = '" . (int)$comment_id . "'");
		}
		
		return $comment_id;
	}

	public function editBlogcomment($comment_id, $data) {
		

		$this->db->query("UPDATE " . DB_PREFIX . "blogcomment SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', comment = '" .  $this->db->escape($data['comment']) . "', blog_id= '" . (int)$data['blog_id'] . "',  property_agent_id = '" . (int)$data['property_agent_id'] . "' WHERE comment_id = '" . (int)$comment_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "blogcomment SET image = '" . $this->db->escape($data['image']) . "' WHERE comment_id = '" . (int)$comment_id . "'");
		}
		$this->cache->delete('blogcomment');
		
		
	}

	public function deleteBlogcomment($comment_id) {
		


		$this->db->query("DELETE FROM " . DB_PREFIX . "blogcomment WHERE comment_id = '" . (int)$comment_id . "'");
		$this->cache->delete('blogcomment');
		
	}

	

	public function getBlogcomment($comment_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "blogcomment WHERE comment_id = '" . (int)$comment_id . "'");

		return $query->row;
	}

	public function getTmdblogcommentes($data = array()) {
		$sql = "SELECT *, bc.image as commentimage, bc.status as cstatus, CONCAT(c.agentname) AS cname FROM " . DB_PREFIX . "blogcomment bc left join " . DB_PREFIX . "blog b on(bc.blog_id = b.blog_id) left join " . DB_PREFIX . "property_agent c on (bc.property_agent_id = c.property_agent_id)";			
		$sql .= " GROUP BY bc.comment_id";

		$sort_data = array(
			'bc.comment_id',
			
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY bc.comment_id";
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

	
	public function getTotalTmdblogcomment() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blogcomment");

		return $query->row['total'];
	}
	

}
