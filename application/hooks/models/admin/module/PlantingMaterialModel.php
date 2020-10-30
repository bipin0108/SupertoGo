<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PlantingMaterialModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Planting_material = 's_planting_material';

	public function get_all_plantingmaterial()
	{	
		$this->db->from($this->Planting_material);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_plantingmaterial($params)
	{  
 		$res = $this->db->insert($this->Planting_material, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_plantingmaterial_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Planting_material);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_plantingmaterial_by_id($id,$params)
	{
		$res = $this->db->update($this->Planting_material, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
