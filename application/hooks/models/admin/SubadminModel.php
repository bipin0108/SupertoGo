<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubadminModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }
	
	private $Admin = 's_admin';

	public function get_all_subadmin()
	{
		$session_id = $this->session->userdata[SESSION_ADMIN]['admin_id'];
		$this->db->select('*');
		$this->db->from($this->Admin);
		$this->db->order_by("admin_id","desc");
		$this->db->where("created_by",$session_id);
		
  		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}

	public function add_subadmin($params)
	{  
 		$res = $this->db->insert($this->Admin, $params); 
		if($res == 1)
			return $this->db->insert_id();
		else
			return false;
 	}
 	
 	public function get_subadmin_by_id($admin_id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Admin);
		$this->db->where("admin_id",$admin_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_subadmin_by_id($admin_id,$params)
	{
		$res = $this->db->update($this->Admin, $params ,['admin_id' => $admin_id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_subadminimage($admin_id)
	{  
 		$this->db->select('profile_image');
		$this->db->from($this->Admin);
		$this->db->where("admin_id",$admin_id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->profile_image;
		 } else {
			 return false;
		 }
   	} 

   	public function get_role_permission_by_user($user_id)
	{
		$this->db->select('created_by');
		$this->db->from($this->Admin);
		$this->db->where("admin_id",$user_id);
		$created_by = ($this->db->get())->row()->created_by;

		$this->db->select('type');
		$this->db->from($this->Admin);
		$this->db->where("admin_id",$created_by);
		$type = ($this->db->get())->row()->type;
		
		$this->db->select('s_role_permission.*,s_permission.permission_name');
		$this->db->from('s_role_permission');
		$this->db->join('s_permission','s_permission.permission_id=s_role_permission.permission_id');
		$this->db->where('s_role_permission.user_id',$user_id);	
		
		$query=$this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

}
