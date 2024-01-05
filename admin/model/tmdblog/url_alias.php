<?php
class ModelTmdBlogUrlAlias extends Model {
	public function getUrlAlias($keyword) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tmdblog_url_alias WHERE keyword = '" . $this->db->escape($keyword) . "'");

		return $query->row;
	}
}