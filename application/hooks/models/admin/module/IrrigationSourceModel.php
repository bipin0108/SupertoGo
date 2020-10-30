<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IrrigationSourceModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Irrigation_source = 's_irrigation_source';
	public function get_all_irrigationsource()
	{	
		$this->db->from($this->Irrigation_source);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_irrigationsource($params)
	{  
 		$res = $this->db->insert($this->Irrigation_source, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_irrigationsource_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Irrigation_source);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_irrigationsource_by_id($id,$params)
	{
		$res = $this->db->update($this->Irrigation_source, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
