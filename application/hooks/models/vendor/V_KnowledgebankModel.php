<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_KnowledgebankModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $Topic = 's_kb_topic';
	private $Subtopic = 's_kb_subtopic';
	private $Subtopic_photo = 's_kb_subtopic_photo';
	private $Subtopic_video = 's_kb_subtopic_video';
	private $Technical = 's_kb_technical_tbl';
	private $ControlMeasure = 's_kb_control_measure';

	public function get_kb_topic_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Topic);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
   	}

   	public function get_kb_subtopic_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->Subtopic);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
	}

	//technical name as category
 	public function get_all_technical($subtopic_id)
 	{
 		$this->db->from($this->Technical);
		$this->db->where("subtopic_id",$subtopic_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
 	}

 	public function get_main_vendor()
	{
		$created_by=$this->session->userdata[SESSION_VENDOR]['created_by'];
		if($created_by == 0)
		{
			$creater_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		}
		else
		{
			$this->db->select("*");
			$this->db->from('s_vendor');
			$this->db->where("vendor_id",$created_by);
			$result=$this->db->get();
			$user = $result->row_array();
			$creater_id = $user['vendor_id'];
		}	
		return $creater_id;
	}	

 	//control measure
 	public function get_all_control_measure($technical_id)
	{
		$this->db->from($this->ControlMeasure);
		$this->db->where("technical_id",$technical_id);
		$this->db->where("created_by_id",$this->get_main_vendor());
		$this->db->where("created_by_type",'Vendor');
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function check_unique_control_measure($field_name,$field_val,$technical_id)
	{
		$this->db->select('*');
		$this->db->from($this->ControlMeasure);
		$this->db->where("technical_id",$technical_id);
		$this->db->where($field_name,$field_val);
		$this->db->where("created_by_id",$this->get_main_vendor());
		$this->db->where("created_by_type",'Vendor');
		$query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		 } else {
			 return false;
		 }
	}

	public function check_unique_edit_control_measure($field_name,$field_val,$technical_id,$id)
	{
		$this->db->select('*');    
		$this->db->from($this->ControlMeasure);
		$this->db->where("technical_id",$technical_id);
		$this->db->where($field_name,$field_val);
		$this->db->where("created_by_id",$this->get_main_vendor());
		$this->db->where("created_by_type",'Vendor');
        $this->db->where('id != ',$id,FALSE);
        $query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		} else {
			 return false;
		}
	}

	public function add_control_measure($params)
	{  
 		$res = $this->db->insert($this->ControlMeasure, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_control_measure_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->ControlMeasure);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
	}

	public function update_control_measure($id,$params)
	{
		$res = $this->db->update($this->ControlMeasure, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}
//end
}
