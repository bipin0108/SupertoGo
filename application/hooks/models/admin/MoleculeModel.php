<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MoleculeModel extends CI_Model
{
  	public function __construct()
    {
            parent::__construct();
    } 
	
	private $Molecule = 's_molecule';
	private $Activity = 's_activity_type';
	
	private $_molecule_batchImport;

	public function get_all_activity()
	{
		$this->db->select('en_act_name,slug');
		$this->db->from($this->Activity);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}
	
	public function get_molecule_by_activity_type($activity_type)
	{	
		$this->db->from($this->Molecule);
		$this->db->where("activity_type",$activity_type);
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return array();
		}
	}

	public function setBatch_molecule($batchImport)
	{
        $this->_molecule_batchImport = $batchImport;
    }

    public function add_molecule()
    {
        $data = $this->_molecule_batchImport;
        $res = $this->db->insert_batch($this->Molecule, $data);
        if(isset($res))
			return true;
		else
			return false;
    }
 	
 	public function get_molecule_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->Molecule);
		$this->db->where("id",$id);
		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return array();
		 }
   	}

	public function update_molecule($id,$params)
	{
		$res = $this->db->update($this->Molecule, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		else
			return false;
	}

	public function get_activity_type($slug)
	{
		$this->db->select('en_act_name');
		$this->db->from($this->Activity);
		$this->db->where('slug',$slug);
		$query = $this->db->get();
		if($query){
			return $query->row()->en_act_name;
		}else{
			return false;
		}
	}

//end	
}	