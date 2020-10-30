<?php defined('BASEPATH') OR exit('No direct script access allowed');

class FertiEquipmentModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 
	
	private $Fertigation_equipment = 's_fertigation_equipment';

	
	public function get_all_fertiequipment()
	{	
		$this->db->from($this->Fertigation_equipment);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_fertiequipment($params)
	{  
 		$res = $this->db->insert($this->Fertigation_equipment, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_fertiequipment_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Fertigation_equipment);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_fertiequipment_by_id($id,$params)
	{
		$res = $this->db->update($this->Fertigation_equipment, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_fertiequipmentimage($id)
	{  
 		$this->db->select('equip_image');
		$this->db->from($this->Fertigation_equipment);
		$this->db->where("id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->equip_image;
		 } else {
			 return false;
		 }
   	}   

}
