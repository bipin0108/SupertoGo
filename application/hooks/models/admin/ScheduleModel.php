<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 
	
	private $Light_Soil_Schedule = 's_light_soil_schedule';
	private $Medheavy_Soil_Schedule = 's_medheavy_soil_schedule';
	private $_lightsoil_batchImport;
	private $_medheavysoil_batchImport;

	public function get_lightsoil_schedule_by_month($month)
	{	
		$this->db->from($this->Light_Soil_Schedule);
		$this->db->where("month",$month);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function setBatch_lightsoil_schedule($batchImport) {
        $this->_lightsoil_batchImport = $batchImport;
    }

    public function add_lightsoil_schedule() {
        $data = $this->_lightsoil_batchImport;
        $res = $this->db->insert_batch($this->Light_Soil_Schedule, $data);
        if(isset($res))
			return true;
		else
			return false;
    }
 	
 	public function get_lightsoil_schedule_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Light_Soil_Schedule);
		$this->db->where("id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_lightsoil_schedule($id,$params)
	{
		$res = $this->db->update($this->Light_Soil_Schedule, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_medheavysoil_schedule_by_month($month)
	{	
		$this->db->from($this->Medheavy_Soil_Schedule);
		$this->db->where("month",$month);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function setBatch_medheavysoil_schedule($batchImport) {
        $this->_medheavysoil_batchImport = $batchImport;
    }

    public function add_medheavysoil_schedule() {
    	$data = $this->_medheavysoil_batchImport;
        $res = $this->db->insert_batch($this->Medheavy_Soil_Schedule, $data);
        if(isset($res))
			return true;
		else
			return false;
    }
 	
 	public function get_medheavysoil_schedule_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Medheavy_Soil_Schedule);
		$this->db->where("id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_medheavysoil_schedule($id,$params)
	{
		$res = $this->db->update($this->Medheavy_Soil_Schedule, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

}
