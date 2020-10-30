<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $Users = 's_users';
	private $Buyer_rate = 's_buyer_rate';
	private $Farmer_plot = 's_farmer_plot';
	private $Plot_schedule = 's_plot_schedules';
	private $Weekly_images = 's_weekly_images';
	private $Subscription_history = 's_plot_subscription_history';
	
	public function get_all_farmer()
	{	
		$this->db->select('s_users.*,s_vendor.name as vendor_name');
		$this->db->order_by('s_users.user_id','desc');
		$this->db->from($this->Users);
		$this->db->join('s_vendor','s_vendor.vendor_id=s_users.parent_id');
		$this->db->where('s_users.user_type','Farmer');
		
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_farmer_by_id($farmer_id)
	{
		$this->db->select('s_users.*,s_vendor.name as vendor_name');
		$this->db->order_by('s_users.user_id','desc');
		$this->db->from($this->Users);
		$this->db->join('s_vendor','s_vendor.vendor_id=s_users.parent_id');
		$this->db->where('s_users.user_id',$farmer_id);
		
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_plot_of_farmer($farmer_id)
	{
		$this->db->select('plot_name,plot_id');
		$this->db->order_by('plot_id','desc');
		$this->db->from($this->Farmer_plot);
		$this->db->where('user_id',$farmer_id);

		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_plot_detail($plot_id)
	{
		/*$this->db->select('s_farmer_plot.*,
				s_crops.en_crop_name as crop_name,
				s_variety.en_name as variety_name,
				s_plot_area_unit.en_name as plot_area_unit_name,
				s_spacing_unit.en_name as spacing_unit_name,
				s_planting_method.en_name as planting_method,
				s_planting_material.en_name as planting_material,
				s_irrigation_source.en_name as irrigation_source_name,
				s_filtration_system.en_name as filtration_system_name,
				s_fertigation_equipment.en_name as fertigation_equipment_name,
				s_soil_type.en_name as soli_type,
				s_water_source.en_name as water_source
				');
		$this->db->from($this->Farmer_plot);
		$this->db->join('s_crops','s_crops.crop_id = s_farmer_plot.crop_id','left');
		$this->db->join('s_variety','s_variety.variety_id = s_farmer_plot.variety_id','left');
		$this->db->join('s_plot_area_unit','s_plot_area_unit.id = s_farmer_plot.plot_area_unit_id','left');
		$this->db->join('s_spacing_unit','s_spacing_unit.id = s_farmer_plot.spacing_unit_id','left');
		$this->db->join('s_planting_method','s_planting_method.id = s_farmer_plot.planting_method_id','left');
		$this->db->join('s_planting_material','s_planting_material.id = s_farmer_plot.planting_material_id','left');
		$this->db->join('s_irrigation_source','s_irrigation_source.id = s_farmer_plot.irrigation_source_ids','left');
		$this->db->join('s_filtration_system','s_filtration_system.id = s_farmer_plot.filtration_system_ids','left');
		$this->db->join('s_fertigation_equipment','s_fertigation_equipment.id = s_farmer_plot.fertigation_equipment_ids','left');
		$this->db->join('s_soil_type','s_soil_type.id = s_farmer_plot.soil_type_id','left');
		$this->db->join('s_water_source','s_water_source.id = s_farmer_plot.water_source_id');
		$this->db->where('s_farmer_plot.plot_id',$plot_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result;
		}else{
			return  array();
		}*/

		// Get farmer plot
		$plots = $this->m_general->getRow("
			SELECT fp.*,
			c.en_crop_name crop_name,
			if(v.en_name IS NULL,'',v.en_name) AS variety_name,
			if(au.en_name IS NULL,'',au.en_name) AS plot_area_unit_name,
			if(su.en_name IS NULL,'',su.en_name) AS spacing_unit_name,
			if(st.en_name IS NULL,'',st.en_name) AS soli_type,
			if(ws.en_name IS NULL,'',ws.en_name) AS water_source,
			if(pme.en_name IS NULL,'',pme.en_name) AS planting_method,
			if(pma.en_name IS NULL,'',pma.en_name) AS planting_material,
			if(bi.en_name IS NULL,'',bi.en_name) AS bacterial_name
			FROM s_farmer_plot fp
			LEFT JOIN s_crops c ON fp.crop_id = c.crop_id
			LEFT JOIN s_variety v ON fp.variety_id = v.variety_id
			LEFT JOIN s_plot_area_unit au ON fp.plot_area_unit_id = au.id
			LEFT JOIN s_spacing_unit su ON fp.spacing_unit_id = su.id
			LEFT JOIN s_planting_method pme ON fp.planting_method_id = pme.id
			LEFT JOIN s_planting_material pma ON fp.planting_material_id = pma.id
			LEFT JOIN s_soil_type st ON fp.soil_type_id = st.id
			LEFT JOIN s_water_source ws ON fp.water_source_id = ws.id
			LEFT JOIN s_bacterial_blight_intensity bi ON fp.bacterial_blight_intensity_id = bi.id
			WHERE fp.plot_id=? ORDER BY fp.plot_id DESC",array($plot_id));


		$is = $this->m_general->getRow("
			SELECT GROUP_CONCAT(en_name SEPARATOR ', ') irrigation_source_name
			FROM s_irrigation_source 
			WHERE FIND_IN_SET(id,?)",
			array($plots['irrigation_source_ids']));
		$plots['irrigation_source_name'] = $is['irrigation_source_name'];
		$fs = $this->m_general->getRow("
			SELECT GROUP_CONCAT(en_name SEPARATOR ', ') filtration_system_name
			FROM s_filtration_system 
			WHERE FIND_IN_SET(id,?)",
			array($plots['filtration_system_ids']));
		$plots['filtration_system_name'] = $fs['filtration_system_name'];
		$fe = $this->m_general->getRow("
			SELECT GROUP_CONCAT(en_name SEPARATOR ', ') fertigation_equipment_name
			FROM s_fertigation_equipment 
			WHERE FIND_IN_SET(id,?)",
			array($plots['fertigation_equipment_ids']));
		$plots['fertigation_equipment_name'] = $fe['fertigation_equipment_name'];

		$soil_type_images = explode(',',$plots['soil_type_images']);
		$soil_images = array();
		foreach($soil_type_images as $simg){
			array_push($soil_images,base_url()."uploads/plots/soil_images/".$simg);
		}
		$plots['soil_type_images'] = !empty($plots['soil_type_images'])?$soil_images:array();
		if(!empty($plots['soil_type_docs'])){
			$plots['soil_type_docs'] = base_url()."uploads/plots/soil_docs/".$plots['soil_type_docs'];
		}else{
			$plots['soil_type_docs'] = '';
		}

		$water_source_images = explode(',',$plots['water_source_images']);
		$water_images = array();
		foreach($water_source_images as $wimg){
			array_push($water_images,base_url()."uploads/plots/water_images/".$wimg);
		}
		$plots['water_source_images'] = !empty($plots['water_source_images'])?$water_images:array();

		if(!empty($plots['water_source_docs'])){
			$plots['water_source_docs'] = base_url()."uploads/plots/water_docs/".$plots['water_source_docs'];
		}else{
			$plots['water_source_docs'] = '';
		}
			
		return $plots;
		
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

	public function get_schedule_by_plot($plot_id)
	{
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$this->db->from($this->Plot_schedule);
		$this->db->where('plot_id',$plot_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_subscription_by_plot($plot_id)
	{
		$this->db->select('subscription_id');
		$this->db->order_by('id','desc');
		$this->db->group_by('subscription_id');
		$this->db->from($this->Weekly_images);
		$this->db->where('plot_id',$plot_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$array = $query->result_array();
			$arr = array_column($array,"subscription_id");
			return $arr;
		}else{
			return array();
		}
	}

	public function get_weekly_image_by_plot($plot_id,$subscription_id)
	{
		$this->db->select('*');
		$this->db->from($this->Weekly_images);
		$this->db->where('plot_id',$plot_id);
		$this->db->where('subscription_id',$subscription_id);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	

	public function get_advisory_request_by_farmer($farmer_id,$plot_id)
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
		$this->db->where('s_advisory.plot_id',$plot_id);
		
		$query = $this->db->get();	
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_all_buyer()
	{	
		$this->db->select('s_users.*');
		$this->db->order_by('s_users.user_id','desc');
		$this->db->from($this->Users);
		$this->db->where('s_users.user_type','Buyer');
		
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_buyer_rate($buyer_id)
	{	
		$this->db->select('s_buyer_rate.*,
						s_crops.en_crop_name as crop_name');
		$this->db->from($this->Buyer_rate);
		$this->db->join('s_users','s_users.user_id = s_buyer_rate.user_id');
		$this->db->join('s_crops','s_crops.crop_id = s_buyer_rate.crop_id');
		$this->db->order_by('s_buyer_rate.id','desc');
		$this->db->where('s_buyer_rate.user_id',$buyer_id);
		
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}

	}

	public function get_buyer_name($buyer_id)
	{
		$this->db->select('first_name,middle_name,last_name');
		$this->db->from($this->Users);
		$this->db->where('user_id',$buyer_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->first_name." ".$result->middle_name." ".$result->last_name;
		}else{
			return false;
		}
	}

	public function get_subscription_payment_history()
	{
		$this->db->select('s_plot_subscription_history.*,
			CONCAT(s_users.first_name," ",s_users.middle_name," ",s_users.last_name) as user_name,
			s_farmer_plot.plot_name as plot_name
			');
		$this->db->from($this->Subscription_history);
		$this->db->join('s_users','s_users.user_id = s_plot_subscription_history.user_id');
		$this->db->join('s_farmer_plot','s_farmer_plot.plot_id = s_plot_subscription_history.plot_id');
		$this->db->order_by('s_plot_subscription_history.subscription_id', 'desc');
		
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


