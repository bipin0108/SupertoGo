<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WebinarModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 

	private $Webinar = 's_webinar';
	private $Webinar_photo = 's_webinar_photo';
	private $Webinar_video = 's_webinar_video';
	private $Webinar_video_series = 's_webinar_video_series';
	private $Webinar_payment_history = 's_webinar_payment_history';
	

	public function get_all_webinar()
	{	
		$this->db->from($this->Webinar);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_webinar($params)
	{
		$res = $this->db->insert($this->Webinar, $params); 
		$id = $this->db->insert_id();
		if($res == 1)
			return $id;
		else
			return $id;
	}

	public function get_webinar_by_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->Webinar);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
	}

	public function update_webinar($id,$params)
	{
		$res = $this->db->update($this->Webinar, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	//subtopic photo
   	public function add_webinar_photo($photo_param)
	{  
 		$res = $this->db->insert($this->Webinar_photo, $photo_param); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	//subtopic video
 	public function add_webinar_video($video_param)
	{  
 		$res = $this->db->insert($this->Webinar_video, $video_param); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_photos_by_webinar($webinar_id)
 	{
 		$this->db->from($this->Webinar_photo);
		$this->db->where("webinar_id",$webinar_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
 	}

 	public function get_videos_by_webinar($webinar_id)
 	{
 		$this->db->from($this->Webinar_video);
		$this->db->where("webinar_id",$webinar_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
 	}

 	//sub video

 	public function get_all_sub_video($webinar_id)
 	{
 		$this->db->from($this->Webinar_video_series);
		$this->db->where("webinar_id",$webinar_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
 	}

 	public function check_unique_webinar_video($field_name,$field_val,$webinar_id)
	{
		$this->db->select('*');
		$this->db->from($this->Webinar_video_series);
		$this->db->where("webinar_id",$webinar_id);
		$this->db->where($field_name,$field_val);
  		$query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		 } else {
			 return false;
		 }
	}

	public function check_edit_unique_webinar_video($field_name,$field_val,$webinar_id,$id)
	{
		$this->db->select('*');    
		$this->db->from($this->Webinar_video_series);
        $this->db->where("webinar_id",$webinar_id);
        $this->db->where($field_name,$field_val);
        $this->db->where('id != ',$id,FALSE);
        $query = $this->db->get();
  		if($query->num_rows() > 0){
 			 return true;
		} else {
			 return false;
		}
	}

	//subtopic video
 	public function add_webinar_video_series($params)
	{  
 		$res = $this->db->insert($this->Webinar_video_series, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}

 	public function get_webinar_video_series_by_id($vedio_series_id)
 	{
 		$this->db->select('*');
		$this->db->from($this->Webinar_video_series);
		$this->db->where("id",$vedio_series_id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return false;
		 }
 	}

 	public function update_webinar_video_series($id,$params)
	{
		$res = $this->db->update($this->Webinar_video_series, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_webinar_payment_history()
	{

		$this->db->select('s_webinar_payment_history.*,
			CONCAT(s_users.first_name," ",s_users.middle_name," ",s_users.last_name) as user_name,
			s_webinar.en_title,s_webinar.hi_title,s_webinar.mr_title
			');
		$this->db->from($this->Webinar_payment_history);
		$this->db->join('s_users','s_users.user_id = s_webinar_payment_history.user_id');
		$this->db->join('s_webinar','s_webinar.id = s_webinar_payment_history.webinar_id');
		
		$this->db->order_by('s_webinar_payment_history.id', 'desc');

		$query = $this->db->get(); 
		
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}
	
//end
}
