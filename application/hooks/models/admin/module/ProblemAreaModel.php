<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProblemAreaModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Problem_area = 's_problem_area';

	public function get_all_problemarea()
	{	
		$this->db->from($this->Problem_area);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_problemarea($params)
	{  
 		$res = $this->db->insert($this->Problem_area, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_problemarea_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Problem_area);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_problemarea_by_id($id,$params)
	{
		$res = $this->db->update($this->Problem_area, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
