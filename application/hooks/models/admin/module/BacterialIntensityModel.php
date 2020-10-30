<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BacterialIntensityModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Bacterial_blight_intensity = 's_bacterial_blight_intensity';

	public function get_all_bacterialintensity()
	{	
		$this->db->from($this->Bacterial_blight_intensity);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_bacterialintensity($params)
	{  
 		$res = $this->db->insert($this->Bacterial_blight_intensity, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_bacterialintensity_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Bacterial_blight_intensity);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_bacterialintensity_by_id($id,$params)
	{
		$res = $this->db->update($this->Bacterial_blight_intensity, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
