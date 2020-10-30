<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SpacingUnitModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Spacing_unit = 's_spacing_unit';

	public function get_all_spacingunit()
	{	
		$this->db->from($this->Spacing_unit);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_spacingunit($params)
	{  
 		$res = $this->db->insert($this->Spacing_unit, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_spacingunit_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Spacing_unit);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_spacingunit_by_id($id,$params)
	{
		$res = $this->db->update($this->Spacing_unit, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
