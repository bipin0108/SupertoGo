<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AreaUnitModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Plot_area_unit = 's_plot_area_unit';

	public function get_all_areaunit()
	{	
		$this->db->from($this->Plot_area_unit);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_areaunit($params)
	{  
 		$res = $this->db->insert($this->Plot_area_unit, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_areaunit_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Plot_area_unit);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_areaunit_by_id($id,$params)
	{
		$res = $this->db->update($this->Plot_area_unit, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
