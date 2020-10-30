<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SoilTypeController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/SoilTypeModel','soiltypemodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/soiltype/list_soiltype';
		$this->load->view('admin/template',$data);
	}

	public function create_soiltype()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/soiltype/add_soiltype';
		$this->load->view('admin/template',$data);
	}

 	public function add_soiltype()
 	{
 		$this->adminmodel->CSRFVerify();
		
		$this->form_validation->set_rules('en_name','Soil Type Name in English','required|trim|is_unique[s_soil_type.en_name]');
		$this->form_validation->set_rules('hi_name','Soil Type Name in Hindi','required|trim|is_unique[s_soil_type.hi_name]');
		$this->form_validation->set_rules('mr_name','Soil Type Name in Marathi','required|trim|is_unique[s_soil_type.mr_name]');

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
			
			$check = $this->soiltypemodel->add_soiltype($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Soil Type has been added Successfully..');
				redirect('admin/soil-type-list');
			}
		}
		$data['page'] = 'module/soiltype/add_soiltype';
		$this->load->view('admin/template',$data);
  	}

	public function edit_soiltype()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/soiltype/edit_soiltype';
		$data['soiltype'] = $this->soiltypemodel->get_soiltype_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_soiltype()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['soiltype'] = $this->soiltypemodel->get_soiltype_by_id($id); 

	    if($_REQUEST['en_name'] != $data['soiltype']['en_name']) {
		   $is_unique =  '|is_unique[s_soil_type.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Soil Type Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['soiltype']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_soil_type.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Soil Type Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['soiltype']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_soil_type.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Soil Type Name in Hindi','required|trim'.$is_unique2);


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
			
			$check = $this->soiltypemodel->update_soiltype_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Soil Type has been updated Successfully..');
				redirect('admin/soil-type-list');
			}
		}
		$data['page'] = 'module/soiltype/edit_soiltype';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_soiltype()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_soil_type");
			$this->session->set_flashdata('success', 'Soil Type has been Successfully Deleted.');
			redirect('admin/soil-type-list');
		}
	}

}

