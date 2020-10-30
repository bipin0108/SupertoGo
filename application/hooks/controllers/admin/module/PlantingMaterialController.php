<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PlantingMaterialController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/PlantingMaterialModel','plantingmaterialmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/plantingmaterial/list_plantingmaterial';
		$this->load->view('admin/template',$data);
	}

	public function create_plantingmaterial()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/plantingmaterial/add_plantingmaterial';
		$this->load->view('admin/template',$data);
	}

 	public function add_plantingmaterial()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Planting Material Name in English','required|trim|is_unique[s_planting_material.en_name]');
		$this->form_validation->set_rules('hi_name','Planting Material Name in Hindi','required|trim|is_unique[s_planting_material.hi_name]');
		$this->form_validation->set_rules('mr_name','Planting Material Name in Marathi','required|trim|is_unique[s_planting_material.mr_name]');
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
			
			$check = $this->plantingmaterialmodel->add_plantingmaterial($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Planting Material has been added Successfully..');
				redirect('admin/planting-material-list');
			}
		}
		$data['page'] = 'module/plantingmaterial/add_plantingmaterial';
		$this->load->view('admin/template',$data);
  	}

	public function edit_plantingmaterial()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/plantingmaterial/edit_plantingmaterial';
		$data['plantingmaterial'] = $this->plantingmaterialmodel->get_plantingmaterial_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_plantingmaterial()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['plantingmaterial'] = $this->plantingmaterialmodel->get_plantingmaterial_by_id($id); 

	    if($_REQUEST['en_name'] != $data['plantingmaterial']['en_name']) {
		   $is_unique =  '|is_unique[s_planting_material.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Planting Material Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['plantingmaterial']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_planting_material.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Planting Material Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['plantingmaterial']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_planting_material.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Planting Material Name in Hindi','required|trim'.$is_unique2);
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
			
			$check = $this->plantingmaterialmodel->update_plantingmaterial_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Planting Material has been updated Successfully..');
				redirect('admin/planting-material-list');
			}
		}
		$data['page'] = 'module/plantingmaterial/edit_plantingmaterial';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_plantingmaterial()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_planting_material");
			$this->session->set_flashdata('success', 'Planting Material has been Successfully Deleted.');
			redirect('admin/planting-material-list');
		}
	}

}

