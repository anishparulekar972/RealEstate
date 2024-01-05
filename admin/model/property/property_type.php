<?php
class ModelPropertyPropertyType extends Model{
	public function addPropertyType($data){ 
		$sql="INSERT INTO " . DB_PREFIX . "property_type set sort_order='".(int) $data['sort_order']."',status='".(int)$data['status']."', date_added=now()";
		$this->db->query($sql);
		$property_type_id=$this->db->getLastId();
		
	foreach ($data['Property_description'] as $language_id => $value){
		$this->db->query("INSERT INTO " . DB_PREFIX . "property_type_description SET property_type_id ='" . (int)$property_type_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name'])."',description='". $this->db->escape($value['description'])."'"); 
		}
		return $property_type_id;
	}
	public function getPropertyTypes($data){
		$sql="select * from " . DB_PREFIX . "property_type p left join " . DB_PREFIX . "property_type_description pd on p.property_type_id=pd.property_type_id where pd.language_id='".$this->config->get('config_language_id')."'";
		
		$sort_data = array(
			'name',
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data))
		{
			$sql .= " ORDER BY " . $data['sort'];
		} 
		else 
		{
			$sql .= " ORDER BY name";
		}
		if (isset($data['order']) && ($data['order'] == 'DESC')) 
		{
			$sql .= " DESC";
		} 
		else 
		{
			$sql .= " ASC";
		}
		if (isset($data['start']) || isset($data['limit'])) 
		{
		if ($data['start'] < 0) 
		{
		$data['start'] = 0;
		}
		if ($data['limit'] < 1) 
		{
		$data['limit'] = 20;
		}
		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query=$this->db->query($sql);
		
		return $query->rows;		
	}	
	public function DeleteProperty($property_type_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "property_type WHERE property_type_id = '" . (int)$property_type_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "property_type_description WHERE property_type_id = '" . (int)$property_type_id . "'");
		$this->cache->delete('property_type_id');
	}
	public function getPropertyType($property_type_id){
		$sql="select * from " . DB_PREFIX . "property_type where property_type_id='".$property_type_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}
	public function getTypeDescription($property_type_id){
		$property_descriptio_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."property_type_description WHERE property_type_id = '" .(int)$property_type_id . "'");
		foreach ($query->rows as $result) 
		{
			$property_descriptio_data[$result['language_id']] = array(
			'name'            => $result['name'],
			'description'      => $result['description'],
			);
		}
		return $property_descriptio_data;
	}
									
	public function editPropertyType($property_type_id,$data){
		$sql="update " . DB_PREFIX . "property_type set
		sort_order='".(int)$data['sort_order']."',status='".(int)$data['status']."',date_modified=now() where property_type_id='".$property_type_id."'";
		$this->db->query($sql);
		$this->db->query("delete from " . DB_PREFIX . "property_type_description where  property_type_id = '" . (int)$property_type_id . "'");
	
	foreach ($data['Property_description'] as $language_id => $value){
		$this->db->query("INSERT INTO " . DB_PREFIX . "property_type_description SET property_type_id = '" . (int)$property_type_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',description  = '" . $this->db->escape($value['description']) . "'");
	 }
  }
	
	
	public function getTotalPropertyType() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "property_type");

		return $query->row['total'];
	}
	
	
	
}