<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class StaticpageModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
				 
        } 
	
	private $Static_Page = 's_static_pages';
	//use
	public function get_all_static_pages() 
	{  
 		$this->db->select('*');
		$this->db->from($this->Static_Page);
  		$query = $this->db->get();
 		if ($query->num_rows() > 0) {
			 return $query->result();
		 } else {
			 return false;
		 }
   	}

   	public function get_static_pages_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Static_Page);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query->num_rows() > 0) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

	public function update_static_pages_by_id($id, $data)
	{
		$res = $this->db->update($this->Static_Page, $data ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

 }
