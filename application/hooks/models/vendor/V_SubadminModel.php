<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_SubadminModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }
	
	private $Vendor = 's_vendor';

	public function get_all_vendor_subadmin()
	{
		$session_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select('s_vendor.*,s_role_vendor.name as role_name');
		$this->db->from('s_vendor');
		$this->db->join('s_role_vendor','s_role_vendor.role_id=s_vendor.role_id');
		$this->db->where('s_vendor.created_by',$session_id);

		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}

	public function add_vendor_subadmin($params)
	{  
 		$res = $this->db->insert($this->Vendor, $params); 
		if($res == 1)
			return $this->db->insert_id();
		else
			return false;
 	}
 	
 	public function get_vendor_subadmin_by_id($vendor_id) 
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

	public function update_vendor_subadmin_by_id($vendor_id,$params)
	{
		$res = $this->db->update($this->Vendor, $params ,['vendor_id' => $vendor_id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_vendor_subadminimage($vendor_id)
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

   	public function get_vendor_role_permission_by_user($user_id)
	{
		
		$this->db->select('s_role_permission_vendor.*,s_permission_vendor.permission_name');
		$this->db->from('s_role_permission_vendor');
		$this->db->join('s_permission_vendor','s_permission_vendor.permission_id=s_role_permission_vendor.permission_id');
		$this->db->where('s_role_permission_vendor.user_id',$user_id);	
		
		$query=$this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

}
