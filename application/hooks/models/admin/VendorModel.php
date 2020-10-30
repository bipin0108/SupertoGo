<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class VendorModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }
	
	private $Vendor = 's_vendor';

	public function get_all_vendor()
	{
		$this->db->select('*');
		$this->db->from($this->Vendor);
		$this->db->where('type','vendor');
		$this->db->where('is_show','1');
		$this->db->order_by("vendor_id","desc");

		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}

	public function add_vendor($params)
	{  
 		$res = $this->db->insert($this->Vendor, $params); 
		if($res == 1)
			return $this->db->insert_id();
		else
			return false;
 	}
 	
 	public function get_vendor_by_id($vendor_id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Vendor);
		$this->db->where("vendor_id",$vendor_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_vendor_by_id($vendor_id,$params)
	{
		$res = $this->db->update($this->Vendor, $params ,['vendor_id' => $vendor_id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_vendorimage($vendor_id)
	{  
 		$this->db->select('profile_image');
		$this->db->from($this->Vendor);
		$this->db->where("vendor_id",$vendor_id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->profile_image;
		 } else {
			 return false;
		 }
   	}

}
