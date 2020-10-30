<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PlantingMethodModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Planting_method = 's_planting_method';

	public function get_all_plantingmethod()
	{	
		$this->db->from($this->Planting_method);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_plantingmethod($params)
	{  
 		$res = $this->db->insert($this->Planting_method, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_plantingmethod_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Planting_method);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_plantingmethod_by_id($id,$params)
	{
		$res = $this->db->update($this->Planting_method, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
