<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CropModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 
	
	private $Crop = 's_crops';
	private $Mandi_rate = 's_rate_of_mandi';
	private $Farm_rate = 's_rate_of_farm';

	public function get_all_crop()
	{	
		$this->db->from($this->Crop);
		$this->db->order_by("crop_id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_crop($params)
	{  
 		$res = $this->db->insert($this->Crop, $params); 
 		$id = $this->db->insert_id();
		if($res == 1)
			return $id;
		else
			return '';
 	}

 	public function add_crop_mandi_rate($params)
	{  
 		$res = $this->db->insert($this->Mandi_rate, $params); 
 		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function add_crop_farm_rate($params)
	{  
 		$res = $this->db->insert($this->Farm_rate, $params); 
 		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_crop_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Crop);
		$this->db->where("crop_id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			return $query->row_array();
		} else {
			return array();
		}
   	}

   	public function mandi_rate_by_crop($id)
   	{
   		$this->db->select('*');
		$this->db->from($this->Mandi_rate);
		$this->db->where("crop_id",$id);
		$query = $this->db->get();
 		if ($query) {
			return $query->result();
		} else {
			return array();
		}
   	}

   	public function farm_rate_by_crop($id)
   	{
   		$this->db->select('*');
		$this->db->from($this->Farm_rate);
		$this->db->where("crop_id",$id);
		$query = $this->db->get();
 		if ($query) {
			return $query->result();
		} else {
			return array();
		}
   	}

   	public function update_crop_by_id($id,$params)
	{
		$res = $this->db->update($this->Crop, $params ,['crop_id' => $id ] ); 
		if($res == 1){
			return true;
		} else {
			return false;
		}
	}

	public function update_mandigrade_by_id($id,$params)
	{
		$res = $this->db->update($this->Mandi_rate, $params ,['id' => $id ] ); 
		if($res == 1){
			return true;
		} else {
			return false;
		}
	}

	public function update_farmgrade_by_id($id,$params)
	{
		$res = $this->db->update($this->Farm_rate, $params ,['id' => $id ] ); 
		if($res == 1){
			return true;
		} else {
			return false;
		}
	}

	public function get_cropimage($id)
	{  
 		$this->db->select('crop_image');
		$this->db->from($this->Crop);
		$this->db->where("crop_id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->crop_image;
		 } else {
			 return false;
		 }
   	}   

}
