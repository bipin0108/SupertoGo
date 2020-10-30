<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SoilTypeModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Soil_type = 's_soil_type';

	public function get_all_soiltype()
	{	
		$this->db->from($this->Soil_type);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_soiltype($params)
	{  
 		$res = $this->db->insert($this->Soil_type, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_soiltype_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Soil_type);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_soiltype_by_id($id,$params)
	{
		$res = $this->db->update($this->Soil_type, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
