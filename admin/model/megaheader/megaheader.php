<?php class ModelMegaheaderMegaheader extends Model {
	public function addMegaheader($data) { 
		if(empty($data['header_information'])) {
			$data['header_information']='';
		}
		
		if(empty($data['header_manufacturer'])) {
			$data['header_manufacturer']='';
		}
		
		if(empty($data['product_category'])) {
			$data['product_category']='';
		}
		
		if(empty($data['product_product'])) {
			$data['product_product']='';
		}
		
		if(empty($data['productsetting']))
		{
			$data['productsetting']='';
		}
		
		if(empty($data['patternimage']))
		{
			$data['patternimage']='';
		}
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "megaheader` SET type = '" . $data['type'] . "', bgimagetype = '" . $data['bgimagetype'] . "', patternimage = '" . $this->db->escape($data['patternimage']) ."', row = '" . $data['row'] . "', col = '" . $data['col'] . "',status = '" . $data['status'] . "',  enable = '" . $data['enable'] . "', showicon = '" . $data['showicon'] . "', url = '" . $this->db->escape($data['url']) . "', sort_order = '" . (int)$data['sort_order'] . "', title_icon = '" . $data['title_icon'] . "', open = '" . (int)$data['open'] . "',  productsetting='".serialize($data['productsetting'])."',categories='".serialize($data['product_category'])."', products='".serialize($data['product_product'])."', informations='".serialize($data['header_information'])."',manufactures='".serialize($data['header_manufacturer'])."',image='".$this->db->escape($data['image'])."'");

		$megaheader_id = $this->db->getLastId();
		
		if (isset($data['customcode_description'])) { 
				
			foreach ($data['customcode_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_cuscode_desc SET megaheader_id = '" . (int)$megaheader_id . "', language_id = '" . (int)$language_id . "', customcode = '" . $this->db->escape($value['customcode']) . "'");
		}
		}

		foreach ($data['megaheader_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_description SET megaheader_id = '" . (int)$megaheader_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "'");
		}

			if (isset($data['custom_type'])) {
		
			foreach ($data['custom_type'] as $custom_type) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_custom_type SET megaheader_id = '" . (int)$megaheader_id . "', custurl = '" . $this->db->escape($custom_type['custurl']) . "', sort_order = '" . (int)$custom_type['sort_order'] . "'");
			
				$megaheader_cname_id = $this->db->getLastId();
				
				foreach ($custom_type['megaheader_ctype_desc'] as $language_id => $megaheader_ctype_desc) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_ctype_desc SET megaheader_cname_id = '" . (int)$megaheader_cname_id . "', language_id = '" . (int)$language_id . "', megaheader_id = '" . (int)$megaheader_id . "',  custname = '" .  $this->db->escape($megaheader_ctype_desc['custname']) . "'");
				}
				
				}
				
			}	
		//// new changes  27-10-2016///
		if (isset($data['meagaheader_store'])) {
			foreach ($data['meagaheader_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "meagaheader_to_store SET megaheader_id = '" . (int)$megaheader_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		//// new changes  27-10-2016///
		

		return $megaheader_id;
	}

	public function editMegaheader($megaheader_id, $data) {
		
		//print_r($data); die();
		if(empty($data['header_information']))
		{
			$data['header_information']='';
		}
		
		if(empty($data['header_manufacturer']))
		{
			$data['header_manufacturer']='';
		}
		
		if(empty($data['product_category']))
		{
			$data['product_category']='';
		}
		if(empty($data['product_product']))
		{
			$data['product_product']='';
		}
		if(empty($data['productsetting']))
		{
			$data['productsetting']='';
		}
		if(empty($data['patternimage']))
		{
			$data['patternimage']='';
		}

		$this->db->query("UPDATE `" . DB_PREFIX . "megaheader` SET type = '" . $data['type'] . "', bgimagetype = '" . $data['bgimagetype'] . "', patternimage='".$this->db->escape($data['patternimage']). "', row = '" . $data['row'] . "',col = '" . $data['col'] . "',  status = '" . $data['status'] . "', url = '" . $this->db->escape($data['url']) . "', title_icon = '" . $data['title_icon'] . "', open = '" . (int)$data['open'] . "', productsetting='".serialize($data['productsetting'])."', enable = '" . $data['enable'] . "', showicon = '" . $data['showicon'] . "', sort_order = '" . (int)$data['sort_order'] . "', categories='".serialize($data['product_category'])."', products='".serialize($data['product_product'])."', informations='".serialize($data['header_information'])."', manufactures='".serialize($data['header_manufacturer'])."',image='".$this->db->escape($data['image'])."' WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_cuscode_desc WHERE megaheader_id = '" . (int)$megaheader_id . "'");		
		
		if (isset($data['customcode_description'])) {
				
			foreach ($data['customcode_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_cuscode_desc SET megaheader_id = '" . (int)$megaheader_id . "', language_id = '" . (int)$language_id . "', customcode = '" . $this->db->escape($value['customcode']) . "'");
		}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_description WHERE megaheader_id = '" . (int)$megaheader_id . "'");

		foreach ($data['megaheader_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_description SET megaheader_id = '" . (int)$megaheader_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "'");
		}
				
		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_custom_type WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_ctype_desc WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		
		if(empty($data['custom_type']))
		{
			$data['custom_type']='';
		}
		
		if ($data['custom_type']) {
		foreach ($data['custom_type'] as $custom_type) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_custom_type SET megaheader_id = '" . (int)$megaheader_id . "', custurl = '" . $this->db->escape($custom_type['custurl']) . "', sort_order = '" . (int)$custom_type['sort_order'] . "'");
			
				$megaheader_cname_id = $this->db->getLastId();
				
				foreach ($custom_type['megaheader_ctype_desc'] as $language_id => $megaheader_ctype_desc) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "megaheader_ctype_desc SET megaheader_cname_id = '" . (int)$megaheader_cname_id . "', language_id = '" . (int)$language_id . "', megaheader_id = '" . (int)$megaheader_id . "',  custname = '" .  $this->db->escape($megaheader_ctype_desc['custname']) . "'");
				}
				
				}
		}
		//// new changes  27-10-2016///
		$this->db->query("DELETE FROM " . DB_PREFIX . "meagaheader_to_store WHERE megaheader_id = '" . (int)$megaheader_id . "'");

		if (isset($data['meagaheader_store'])) {
			foreach ($data['meagaheader_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "meagaheader_to_store SET megaheader_id = '" . (int)$megaheader_id . "', store_id = '" . (int)$store_id . "'");
			}
		}		//// new changes  27-10-2016///
		

		
	}

	public function deleteMegaheader($megaheader_id) {
		

		$this->db->query("DELETE FROM `" . DB_PREFIX . "megaheader` WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_description WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_custom_type WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_cuscode_desc WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "megaheader_ctype_desc WHERE megaheader_id = '" . (int)$megaheader_id . "'");
		
		
	}
	public function getMegaheadercustoms($megaheader_id) {
		$megaheader_custom_data = array();

		$megaheader_custom_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megaheader_custom_type WHERE megaheader_id = '" . (int)$megaheader_id . "' ORDER BY sort_order ASC");

		foreach ($megaheader_custom_query->rows as $megaheader_desc) {
			$megaheader_custom_description_data = array();

			$megaheader_custom_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megaheader_ctype_desc WHERE megaheader_cname_id = '" . (int)$megaheader_desc['megaheader_cname_id'] . "' AND megaheader_id = '" . (int)$megaheader_desc['megaheader_id'] . "'");

			foreach ($megaheader_custom_description_query->rows as $megaheader_ctype_desc) {
				$megaheader_custom_description_data[$megaheader_ctype_desc['language_id']] = array('custname' => $megaheader_ctype_desc['custname']);
			}

			$megaheader_custom_data[] = array(
				'megaheader_ctype_desc' => $megaheader_custom_description_data,
				'custurl'                     => $megaheader_desc['custurl'],
				'sort_order'               => $megaheader_desc['sort_order']
			);
		}

		return $megaheader_custom_data;
	}

	public function getMegaheader($megaheader_id) { 
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "megaheader` o LEFT JOIN " . DB_PREFIX . "megaheader_description od ON (o.megaheader_id = od.megaheader_id) WHERE o.megaheader_id = '" . (int)$megaheader_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		

		return $query->row;
	}

	public function getMegaheaders($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "megaheader` o LEFT JOIN " . DB_PREFIX . "megaheader_description od ON (o.megaheader_id = od.megaheader_id) WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND od.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}

		$sort_data = array(
			'od.title',
			'o.type',
			'o.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.title";
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

	public function getMegaheaderDescriptions($megaheader_id) {
		$megaheader_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megaheader_description WHERE megaheader_id = '" . (int)$megaheader_id . "'");

		foreach ($query->rows as $result) {
			$megaheader_data[$result['language_id']] = array(
			'title' => $result['title'],
			);
		}

		return $megaheader_data;
	}
        
	
	public function getTotalMegaheaders($data = array()) {
		$sql = "SELECT COUNT(*) as total FROM `" . DB_PREFIX . "megaheader` o LEFT JOIN " . DB_PREFIX . "megaheader_description od ON (o.megaheader_id = od.megaheader_id) WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_title'])) {
			$sql .= " AND od.title LIKE '" . $this->db->escape($data['filter_title']) . "%'";
		}

        $query = $this->db->query($sql);

		return $query->row['total'];
	}
	public function getCustomcodeDescriptions($megaheader_id) {
		
		$megaheader_customcode_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megaheader_cuscode_desc WHERE megaheader_id = '" . (int)$megaheader_id . "'");

		foreach ($query->rows as $result) {
			$megaheader_customcode_data[$result['language_id']] = array(
				'customcode'             => $result['customcode']
			);
		}

		return $megaheader_customcode_data;
	}
	//// new changes  27-10-2016///
	public function getmegaStores($megaheader_id) {
		$meagheader_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "meagaheader_to_store WHERE megaheader_id = '" . (int)$megaheader_id . "'");

		foreach ($query->rows as $result) {
			$meagheader_store_data[] = $result['store_id'];
		}

		return $meagheader_store_data;
	}
	//// new changes  27-10-2016///
}