<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MasterModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    } 
	
	private $State = 's_state';
	private $City = 's_city';
	private $Role = 's_role';
	private $Permission = 's_permission';
	private $S_role_permission = 's_role_permission';
	private $Role_vendor = 's_role_vendor';
	private $Permission_vendor = 's_permission_vendor';
	private $S_role_permission_vendor = 's_role_permission_vendor';
	private $Settings = 's_settings';

	public function get_all_state()
	{
		$this->db->select('state_id, state_name');
		$query = $this->db->get($this->State);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_all_city()
	{
		$this->db->select('city_id,name');
		$query = $this->db->get($this->City);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_all_role()
	{
		$this->db->select('role_id, name');
		$query = $this->db->get($this->Role);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function get_all_vendor_role()
	{
		$this->db->select('role_id, name');
		$query = $this->db->get($this->Role_vendor);
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	//get subadmin permission
	public function getPermission($role,$uid){
		$role_id = $this->getRoleIdByName($role);

		$this->db->select("*");
		$this->db->from($this->S_role_permission);
		$this->db->where("user_id",$uid);
		$this->db->where("permission_id",$role_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result;
		}else{
			return array();
		}
	}

	public function getRoleIdByName($role_name){

		$this->db->select("permission_id");
		$this->db->from($this->Permission);
		$this->db->where("permission_name",$role_name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row()->permission_id;
		}else{
			return false;
		}
	}


	//get vendor subadmin permission
	public function getPermission_vendor($role,$uid){
		$role_id = $this->getRoleIdByName_vendor($role);
		$this->db->select("*");
		$this->db->from($this->S_role_permission_vendor);
		$this->db->where("user_id",$uid);
		$this->db->where("permission_id",$role_id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result;
		}else{
			return array();
		}
	}

	public function getRoleIdByName_vendor($role_name){
		$this->db->select("permission_id");
		$this->db->from($this->Permission_vendor);
		$this->db->where("permission_name",$role_name);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->permission_id;
		}else{
			return false;
		}
	}


	

   	//setting
	public function getSetting($key){

        $this->db->select("s_val");
        $this->db->from($this->Settings);
        $this->db->where("s_key",$key);
    	$query = $this->db->get();

		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->s_val;
		}else{
			return false;
		}
    }

    public function setSetting($key,$val){
        $this->db->where("s_key",$key);
   		$this->db->update($this->Settings,array("s_val"=>$val));
		return true;
    }

    //get field value by id and table name
    public function get_field_val($id_name,$id_val,$tbl_name,$field)
    {
    	$this->db->select($field);
        $this->db->from($tbl_name);
        $this->db->where($id_name,$id_val);
    	$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->$field;
		}else{
			return false;
		}
    }

    //get stage
    public function get_stage($first_irrigation_date,$soil_type)
	{	

		$date1=date_create($first_irrigation_date);
        $date2=date_create($current_date);
        $diff=date_diff($date1,$date2);
        $day = $diff->format("%a");

        if($soil_type == 'light'){
			switch ($day) {
			case ($day >= 0 && $day<= 60):
			$stage = 'Flowering and Fruit Setting';
			break;
			case ($day >= 61 && $day<= 160):
			$stage = 'Fruit Development';
			break;
			case ($day >= 161 && $day<= 200):
			$stage = 'Maturity and Harvesting';
			break;
			case ($day >= 201 && $day<= 335):
			$stage = 'Storage';
			break;
			case ($day >= 336 && $day<= 365):
			$stage = 'Stress';
			break;
			default:
			$stage = '-';
			break;
			}	
		}
		if($soil_type == 'medheavy'){
			switch ($day) {
			case ($day >= 0 && $day<= 60):
			$stage = 'Flowering and Fruit Setting';
			break;
			case ($day >= 61 && $day<= 160):
			$stage = 'Fruit Development';
			break;
			case ($day >= 161 && $day<= 210):
			$stage = 'Maturity and Harvesting';
			break;
			case ($day >= 211 && $day<= 305):
			$stage = 'Storage';
			break;
			case ($day >= 306 && $day<= 365):
			$stage = 'Stress';
			break;
			default:
			$stage = '-';
			break;
			}
		}
		return $stage;
	}

//end
}
