<?php
class ModelPropertyCustomer extends Model {
	public function addCustomer($data) {
		$sql="INSERT INTO " . DB_PREFIX . "customer set
			 firstname = '" . $this->db->escape($data['firstname']) . "',
			 lastname = '" . $this->db->escape($data['lastname']) . "', 
			 email = '" . $this->db->escape($data['email']) . "',
			 telephone = '" . $this->db->escape($data['telephone']) . "',
			 fax = '" . $this->db->escape($data['fax']) . "',
			 newsletter = '" . (int)$data['newsletter'] . "', 
			 salt = '" . $this->db->escape($salt = token(9)) . "',
			 password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',
			 status = '" . (int)$data['status'] . "', 
			 approved = '" . (int)$data['approved'] . "',
			 safe = '" . (int)$data['safe'] . "',
			 plans_id='". $data['plans_id']."', date_added = NOW()";
		$this->db->query($sql);
	}
	public function editCustomer($customer_id, $data) {
		$sql="update " . DB_PREFIX . "customer set
			 firstname = '" . $this->db->escape($data['firstname']) . "',
			 lastname = '" . $this->db->escape($data['lastname']) . "', 
			 email = '" . $this->db->escape($data['email']) . "',
			 telephone = '" . $this->db->escape($data['telephone']) . "',
			 fax = '" . $this->db->escape($data['fax']) . "',
			 newsletter = '" . (int)$data['newsletter'] . "', 
			 salt = '" . $this->db->escape($salt = token(9)) . "',
			 password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',
			 status = '" . (int)$data['status'] . "', 
			 approved = '" . (int)$data['approved'] . "',
			 safe = '" . (int)$data['safe'] . "',
			 plans_id='". $data['plans_id']."', 
			 date_modified=now() where customer_id='".$customer_id."'";
		$this->db->query($sql);
	}

	public function getCustomer($customer_id) {
		$sql="select * from " . DB_PREFIX . "customer where customer_id='".$customer_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}	
	
	public function deleteCustomer($customer_id){
		$sql="delete  from " . DB_PREFIX . "customer where customer_id='".$customer_id."'";
		$query=$this->db->query($sql);
	}
	
	public function getCustomers($data){
		$sql="select * from " . DB_PREFIX . "customer where customer_id<>0 ";
			
		if (isset($data['filter_firstname'])){
		 	$sql .=" and firstname like '".$this->db->escape($data['filter_firstname'])."%'";
		}
		
		$sort_data = array(
		'firstname',
		'lastname',
		'email'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		 	$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY firstname";
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
		}
		$query = $this->db->query($sql);
		return $query->rows;	
	}
		
	public function getTotalCustomers($data){
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer where customer_id<>0";
		if (isset($data['filter_firstname'])){
		 	$sql .=" and firstname like '".$this->db->escape($data['filter_firstname'])."%'";
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
}
