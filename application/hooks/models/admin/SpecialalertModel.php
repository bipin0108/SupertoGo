<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SpecialalertModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Special_alert = 's_special_alert';

	public function get_all_special_alert()
	{	
		$this->db->from($this->Special_alert);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_special_alert($params)
	{  
 		$res = $this->db->insert($this->Special_alert, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_special_alert_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Special_alert);
		$this->db->where("id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_special_alert_by_id($id,$params)
	{
		$res = $this->db->update($this->Special_alert, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

}
