<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_AdvisoryModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }
	
	private $Advisory = 's_advisory';
	private $Advisory_response = 's_advisory_response';

	public function get_advisory_request_mainvendor($ad_status)
	{
		$vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select("s_advisory.*, 
			s_farmer_plot.plot_name, s_farmer_plot.first_irrigation_date,
			CONCAT(s_users.first_name,' ',s_users.last_name) as farmer_name,
			s_crops.en_crop_name as crop_name,
			s_problem_area.en_name as problem_area_name");
		$this->db->from('s_advisory');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_advisory.plot_id');
		$this->db->join('s_users','s_users.user_id = s_advisory.farmer_id');
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id');
		$this->db->join('s_problem_area','s_problem_area.id = s_advisory.problem_area_id');
		$this->db->where('s_advisory.status',$ad_status);
		$this->db->where('s_advisory.vendor_id',$vendor_id);
//		$this->db->where('s_users.assign_subvendor_id',0);
		$this->db->where('s_users.parent_id',$vendor_id);
		
		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}

	public function get_assigned_advisory_request_mainvendor($ad_status)
	{
		$vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select("s_advisory.*, 
			s_farmer_plot.plot_name, s_farmer_plot.first_irrigation_date,
			CONCAT(s_users.first_name,' ',s_users.last_name) as farmer_name,
			s_crops.en_crop_name as crop_name,
			s_problem_area.en_name as problem_area_name");
		$this->db->from('s_advisory');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_advisory.plot_id');
		$this->db->join('s_users','s_users.user_id = s_advisory.farmer_id');
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id');
		$this->db->join('s_problem_area','s_problem_area.id = s_advisory.problem_area_id');
		$this->db->where('s_advisory.status',$ad_status);
		$this->db->where('s_advisory.vendor_id != ',0,FALSE);
		$this->db->where('s_users.assign_subvendor_id !=',0,FALSE);
		$this->db->where('s_users.parent_id',$vendor_id);
		
		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}

	public function get_advisory_request_subvendor($ad_status)
	{
		$vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select("s_advisory.*, 
			s_farmer_plot.plot_name, s_farmer_plot.first_irrigation_date, 
			CONCAT(s_users.first_name,' ',s_users.last_name) as farmer_name,
			s_crops.en_crop_name as crop_name,
			s_problem_area.en_name as problem_area_name");
		$this->db->from('s_advisory');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_advisory.plot_id');
		$this->db->join('s_users','s_users.user_id = s_advisory.farmer_id');
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id');
		$this->db->join('s_problem_area','s_problem_area.id = s_advisory.problem_area_id');
		$this->db->where('s_advisory.status',$ad_status);
		$this->db->where('s_advisory.vendor_id',$vendor_id);
		
		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}


	public function get_advisory_request_by_farmer($farmer_id)
	{
		$this->db->select("s_advisory.*, 
			s_farmer_plot.plot_name, s_farmer_plot.first_irrigation_date, 
			CONCAT(s_users.first_name,' ',s_users.last_name) as farmer_name,
			s_crops.en_crop_name as crop_name,
			s_problem_area.en_name as problem_area_name");
		$this->db->from('s_advisory');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_advisory.plot_id');
		$this->db->join('s_users','s_users.user_id = s_advisory.farmer_id');
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id');
		$this->db->join('s_problem_area','s_problem_area.id = s_advisory.problem_area_id');
		$this->db->where('s_advisory.farmer_id',$farmer_id);
		
		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function today_follow_up_request_mainvendor()
	{
		$vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select("s_advisory.*, 
			s_farmer_plot.plot_name, s_farmer_plot.first_irrigation_date,
			CONCAT(s_users.first_name,' ',s_users.last_name) as farmer_name,
			s_crops.en_crop_name as crop_name,
			s_problem_area.en_name as problem_area_name");
		$this->db->from('s_advisory');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_advisory.plot_id');
		$this->db->join('s_users','s_users.user_id = s_advisory.farmer_id');
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id');
		$this->db->join('s_problem_area','s_problem_area.id = s_advisory.problem_area_id');
		$this->db->where('s_advisory.status','Followup');
		$this->db->where('s_advisory.vendor_id',$vendor_id);
		$this->db->where('s_advisory.follow_up_date',date('Y-m-d'));
		$this->db->where('s_users.parent_id',$vendor_id);
		
		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}

	public function today_follow_up_request_subvendor()
	{
		$vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
		$this->db->select("s_advisory.*, 
			s_farmer_plot.plot_name, s_farmer_plot.first_irrigation_date, 
			CONCAT(s_users.first_name,' ',s_users.last_name) as farmer_name,
			s_crops.en_crop_name as crop_name,
			s_problem_area.en_name as problem_area_name");
		$this->db->from('s_advisory');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_advisory.plot_id');
		$this->db->join('s_users','s_users.user_id = s_advisory.farmer_id');
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id');
		$this->db->join('s_problem_area','s_problem_area.id = s_advisory.problem_area_id');
		$this->db->where('s_advisory.status','Followup');
		$this->db->where('s_advisory.follow_up_date',date('Y-m-d'));
		$this->db->where('s_advisory.vendor_id',$vendor_id);
		
		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->result();	
			return $result;
		}else{
			return  array();
		}
	}

	public function view_advisory_request_by_id($advisory_id)
	{
		$this->db->select("s_advisory.*, 
			s_farmer_plot.*,s_advisory.status as advisory_status,
			CONCAT(s_users.first_name,' ',s_users.last_name) as farmer_name, 
			CONCAT(s_users.village,' ',s_users.city,' ',s_users.district,' ',s_users.state,' ',s_users.pincode) as farmer_address,s_users.user_id as farmer_id,
			s_users.profile_pic as farmer_profile,
			s_users.mobile as farmer_mobile,
			s_crops.en_crop_name as crop_name,
			s_problem_area.en_name as problem_area_name");

		$this->db->from('s_advisory');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_advisory.plot_id');
		$this->db->join('s_users','s_users.user_id = s_advisory.farmer_id');
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id');
		$this->db->join('s_problem_area','s_problem_area.id = s_advisory.problem_area_id');
		$this->db->where('s_advisory.advisory_id',$advisory_id);

		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->row();	
			return $result;
		}else{
			return  array();
		}
	}

	public function update_advisory_request($advisory_id,$params)
	{
		$res = $this->db->update($this->Advisory, $params ,['advisory_id' => $advisory_id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

	public function get_response_by_advisory($advisory_id)
	{
		$this->db->select('*');
		$this->db->from($this->Advisory_response);
		$this->db->where('advisory_id',$advisory_id);
		$this->db->order_by("created_at","desc");
		$query = $this->db->get();
 		if ($query) {
			 return $query->result_array();
		} else {
			 return false;
		}
	}

	public function add_message($params)
	{  
 		$res = $this->db->insert($this->Advisory_response, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}

//end	
}	