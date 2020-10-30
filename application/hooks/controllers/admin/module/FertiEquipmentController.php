<?php defined('BASEPATH') OR exit('No direct script access allowed');
class FertiEquipmentController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/FertiEquipmentModel','fertiequipmentmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/ferti_equip/list_fertiequip';
		$this->load->view('admin/template',$data);
	}

	public function create_fertiequipment()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/ferti_equip/add_fertiequip';
		$this->load->view('admin/template',$data);
	}

 	public function add_fertiequipment()
 	{

 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Equipment Name in English','required|trim|is_unique[s_fertigation_equipment.en_name]');
		$this->form_validation->set_rules('hi_name','Equipment Name in Hindi','required|trim|is_unique[s_fertigation_equipment.hi_name]');
		$this->form_validation->set_rules('mr_name','Equipment Name in Marathi','required|trim|is_unique[s_fertigation_equipment.mr_name]');

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'hi_name' => $_REQUEST['hi_name'],
				'mr_name' => $_REQUEST['mr_name'], 
			);
			$check = $this->fertiequipmentmodel->add_fertiequipment($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Equipment has been added Successfully..');
				redirect('admin/fertigation-equipment-list');
			}
		}
		$data['page'] = 'module/ferti_equip/add_fertiequip';
		$this->load->view('admin/template',$data);
  	}

	public function edit_fertiequipment()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/ferti_equip/edit_fertiequip';
		$data['equip'] = $this->fertiequipmentmodel->get_fertiequipment_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_fertiequipment()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['equip'] = $this->fertiequipmentmodel->get_fertiequipment_by_id($id); 
		
		if($_REQUEST['en_name'] != $data['equip']['en_name']) {
		   $is_unique =  '|is_unique[s_fertigation_equipment.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Equipment Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['equip']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_fertigation_equipment.mr_name]';
		} else {
		   $is_unique1 =  '';
		}
		$this->form_validation->set_rules('mr_name','Equipment Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['equip']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_fertigation_equipment.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Equipment Name in Hindi','required|trim'.$is_unique2);
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'hi_name' => $_REQUEST['hi_name'],
				'mr_name' => $_REQUEST['mr_name'], 
			);

			$check = $this->fertiequipmentmodel->update_fertiequipment_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Equipment has been updated Successfully..');
				redirect('admin/fertigation-equipment-list');
			}
		}
		$data['page'] = 'module/ferti_equip/edit_fertiequip';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_fertiequipment()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_fertigation_equipment");
			$this->session->set_flashdata('success', 'Equipment has been Successfully Deleted.');
			redirect('admin/fertigation-equipment-list');
		}
	}

	

}

