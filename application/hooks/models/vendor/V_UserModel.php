<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_UserModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Users = 's_users';

	public function get_all_farmer()
	{	
		$vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select('s_users.*');
		$this->db->order_by("s_users.user_id","desc");
		$this->db->from($this->Users);
		$this->db->where('s_users.parent_id',$vendor_id);

		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_all_farmer_by_subvendor()
	{	
		$vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select('s_users.*');
		$this->db->order_by("s_users.user_id","desc");
		$this->db->from($this->Users);
		$this->db->where('s_users.assign_subvendor_id',$vendor_id);

		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function update_farmer($user_id,$params)
	{
		$res = $this->db->update($this->Users, $params ,['user_id' => $user_id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}
//end
}


