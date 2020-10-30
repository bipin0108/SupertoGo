<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NotificationModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }

    // User
	public function get_all_user(){ 
		$column_search = array('tbl_users.first_name','tbl_users.last_name','tbl_users.email','tbl_users.mobile');  
		$this->db->select("
			tbl_users.user_id,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) name,
			tbl_users.email,
			tbl_users.mobile
		");
		$this->db->order_by("tbl_users.user_id","desc"); 
		$this->db->from('tbl_users'); 

		$i = 0;
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
	}
	public function user_get_datatables(){
		$this->get_all_user();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function user_count_filtered(){
		$this->get_all_user();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function user_count_all(){
		$this->db->select("
			tbl_users.user_id,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) name,
			tbl_users.email,
			tbl_users.mobile
		");
		$this->db->order_by("tbl_users.user_id","desc"); 
		$this->db->from('tbl_users'); 
		$this->db->get();
		return $this->db->count_all_results();
	}

	// Delivery Boy
	public function get_all_delivery_boy(){ 
		$column_search = array('tbl_delivery_boy.first_name','tbl_delivery_boy.last_name','tbl_delivery_boy.email','tbl_delivery_boy.mobile');  
		$this->db->select("
			tbl_delivery_boy.db_id,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) name,
			tbl_delivery_boy.email,
			tbl_delivery_boy.mobile
		");
		$this->db->order_by("tbl_delivery_boy.db_id","desc"); 
		$this->db->from('tbl_delivery_boy'); 

		$i = 0;
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
	}
	public function delivery_boy_get_datatables(){
		$this->get_all_delivery_boy();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function delivery_boy_count_filtered(){
		$this->get_all_delivery_boy();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function delivery_boy_count_all(){
		$this->db->select("
			tbl_delivery_boy.db_id,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) name,
			tbl_delivery_boy.email,
			tbl_delivery_boy.mobile
		");
		$this->db->order_by("tbl_delivery_boy.db_id","desc"); 
		$this->db->from('tbl_delivery_boy'); 
		$this->db->get();
		return $this->db->count_all_results();
	}
	
}

