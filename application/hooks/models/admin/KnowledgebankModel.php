	<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KnowledgebankModel extends CI_Model
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
	
	public function get_all_kb_topic($crop_id)
	{	
		$this->db->from($this->Topic);
		$this->db->where("crop_id",$crop_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_kb_topic($params)
	{  
 		$res = $this->db->insert($this->Topic, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
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

	public function update_kb_topic($id,$params)
	{
		$res = $this->db->update($this->Topic, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function check_unique($field_name,$field_val,$crop_id)
	{
		$this->db->select('*');
		$this->db->from($this->Topic);
		$this->db->where("crop_id",$crop_id);
		$this->db->where($field_name,$field_val);
  		$query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		 } else {
			 return false;
		 }
	}

	public function check_edit_unique($field_name,$field_val,$crop_id,$id)
	{
		$this->db->select('*');    
		$this->db->from($this->Topic);
        $this->db->where("crop_id",$crop_id);
        $this->db->where($field_name,$field_val);
        $this->db->where('id != ',$id,FALSE);
        $query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		} else {
			 return false;
		}
	}

	public function check_unique_subtopic($field_name,$field_val,$topic_id)
	{
		$this->db->select('*');
		$this->db->from($this->Subtopic);
		$this->db->where("topic_id",$topic_id);
		$this->db->where($field_name,$field_val);
  		$query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		 } else {
			 return false;
		 }
	}

	public function check_edit_unique_subtopic($field_name,$field_val,$topic_id,$id)
	{
		$this->db->select('*');    
		$this->db->from($this->Subtopic);
        $this->db->where("topic_id",$topic_id);
        $this->db->where($field_name,$field_val);
        $this->db->where('id != ',$id,FALSE);
        $query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		} else {
			 return false;
		}
	}

	public function get_all_kb_subtopic($topic_id)
	{
		$this->db->from($this->Subtopic);
		$this->db->where("topic_id",$topic_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function add_kb_subtopic($params)
	{
		$res = $this->db->insert($this->Subtopic, $params); 
		$id = $this->db->insert_id();
		if($res == 1)
			return $id;
		else
			return $id;
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

	public function update_kb_subtopic($id,$params)
	{
		$res = $this->db->update($this->Subtopic, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_pdf($id)
	{
		$this->db->select('pdf_file');
		$this->db->from($this->Subtopic);
		$this->db->where("id",$id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->pdf_file;
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

   	//subtopic photo
   	public function add_kb_subtopic_photo($photo_param)
	{  
 		$res = $this->db->insert($this->Subtopic_photo, $photo_param); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	//subtopic video
 	public function add_kb_subtopic_video($video_param)
	{  
 		$res = $this->db->insert($this->Subtopic_video, $video_param); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_photos_by_subtopic($subtopic_id)
 	{
 		$this->db->from($this->Subtopic_photo);
		$this->db->where("subtopic_id",$subtopic_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
 	}

 	public function get_videos_by_subtopic($subtopic_id)
 	{
 		$this->db->from($this->Subtopic_video);
		$this->db->where("subtopic_id",$subtopic_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
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

 	public function check_unique_technical($field_name,$field_val,$subtopic_id)
	{
		$this->db->select('*');
		$this->db->from($this->Technical);
		$this->db->where("subtopic_id",$subtopic_id);
		$this->db->where($field_name,$field_val);
		$query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		 } else {
			 return false;
		 }
	}

	public function check_unique_edit_technical($field_name,$field_val,$subtopic_id,$id)
	{
		$this->db->select('*');    
		$this->db->from($this->Technical);
		$this->db->where("subtopic_id",$subtopic_id);
		$this->db->where($field_name,$field_val);
		$this->db->where('id != ',$id,FALSE);
        $query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		} else {
			 return false;
		}
	}

	public function add_technical($params)
	{  
 		$res = $this->db->insert($this->Technical, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_technical_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->Technical);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
	}

	public function update_technical($id,$params)
	{
		$res = $this->db->update($this->Technical, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_main_admin()
	{
		$created_by=$this->session->userdata[SESSION_ADMIN]['created_by'];
		if($created_by == 0)
		{
			$creater_id = $this->session->userdata[SESSION_ADMIN]['admin_id'];
		}
		else
		{
			$this->db->select("*");
			$this->db->from('s_admin');
			$this->db->where("admin_id",$created_by);
			$result=$this->db->get();
			$user = $result->row_array();
			$creater_id = $user['admin_id'];
		}	
		return $creater_id;
	}	
 	//control measure
 	public function get_all_control_measure($technical_id)
	{
		$this->db->from($this->ControlMeasure);
		$this->db->where("technical_id",$technical_id);
		$this->db->where("created_by_id",$this->get_main_admin());
		$this->db->where("created_by_type",'Admin');
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
		$this->db->where("created_by_id",$this->get_main_admin());
		$this->db->where("created_by_type",'Admin');
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
		$this->db->where("created_by_id",$this->get_main_admin());
		$this->db->where("created_by_type",'Admin');
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

}
