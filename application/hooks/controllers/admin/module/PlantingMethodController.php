<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PlantingMethodController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/PlantingMethodModel','plantingmethodmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/plantingmethod/list_plantingmethod';
		$this->load->view('admin/template',$data);
	}

	public function create_plantingmethod()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/plantingmethod/add_plantingmethod';
		$this->load->view('admin/template',$data);
	}

 	public function add_plantingmethod()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Planting Method Name in English','required|trim|is_unique[s_planting_method.en_name]');
		$this->form_validation->set_rules('hi_name','Planting Method Name in Hindi','required|trim|is_unique[s_planting_method.hi_name]');
		$this->form_validation->set_rules('mr_name','Planting Method Name in Marathi','required|trim|is_unique[s_planting_method.mr_name]');
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
			
			$check = $this->plantingmethodmodel->add_plantingmethod($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Planting Method has been added Successfully..');
				redirect('admin/planting-method-list');
			}
		}
		$data['page'] = 'module/plantingmethod/add_plantingmethod';
		$this->load->view('admin/template',$data);
  	}

	public function edit_plantingmethod()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/plantingmethod/edit_plantingmethod';
		$data['plantingmethod'] = $this->plantingmethodmodel->get_plantingmethod_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_plantingmethod()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['plantingmethod'] = $this->plantingmethodmodel->get_plantingmethod_by_id($id); 

		if($_REQUEST['en_name'] != $data['plantingmethod']['en_name']) {
		   $is_unique =  '|is_unique[s_planting_method.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Planting Method Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['plantingmethod']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_planting_method.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Planting Method Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['plantingmethod']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_planting_method.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Planting Method Name in Hindi','required|trim'.$is_unique2);
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
			
			$check = $this->plantingmethodmodel->update_plantingmethod_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Planting Method has been updated Successfully..');
				redirect('admin/planting-method-list');
			}
		}
		$data['page'] = 'module/plantingmethod/edit_plantingmethod';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_plantingmethod()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_planting_method");
			$this->session->set_flashdata('success', 'Planting Method has been Successfully Deleted.');
			redirect('admin/planting-method-list');
		}
	}

}

