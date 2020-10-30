<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FiltrationSystemModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Filtration_system = 's_filtration_system';

	public function get_all_filtrationsystem()
	{	
		$this->db->from($this->Filtration_system);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_filtrationsystem($params)
	{  
 		$res = $this->db->insert($this->Filtration_system, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_filtrationsystem_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Filtration_system);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_filtrationsystem_by_id($id,$params)
	{
		$res = $this->db->update($this->Filtration_system, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
