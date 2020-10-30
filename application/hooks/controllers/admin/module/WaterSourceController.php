<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WaterSourceController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/WaterSourceModel','watersourcemodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/watersource/list_watersource';
		$this->load->view('admin/template',$data);
	}

	public function create_watersource()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/watersource/add_watersource';
		$this->load->view('admin/template',$data);
	}

 	public function add_watersource()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Water Source Name in English','required|trim|is_unique[s_water_source.en_name]');
		$this->form_validation->set_rules('hi_name','Water Source Name in Hindi','required|trim|is_unique[s_water_source.hi_name]');
		$this->form_validation->set_rules('mr_name','Water Source Name in Marathi','required|trim|is_unique[s_water_source.mr_name]');

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$user=$this->adminmodel->GetUserData();
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'hi_name' => $_REQUEST['hi_name'],
				'mr_name' => $_REQUEST['mr_name'], 
			);
			
			$check = $this->watersourcemodel->add_watersource($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Water Source has been added Successfully..');
				redirect('admin/water-source-list');
			}
		}
		$data['page'] = 'module/watersource/add_watersource';
		$this->load->view('admin/template',$data);
  	}

  	public function edit_watersource()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/watersource/edit_watersource';
		$data['watersource'] = $this->watersourcemodel->get_watersource_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_watersource()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['watersource'] = $this->watersourcemodel->get_watersource_by_id($id); 

		if($_REQUEST['en_name'] != $data['watersource']['en_name']) {
		   $is_unique =  '|is_unique[s_water_source.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Water Source Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['watersource']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_water_source.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Water Source Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['watersource']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_water_source.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Water Source Name in Hindi','required|trim'.$is_unique2);

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
			
			$check = $this->watersourcemodel->update_watersource_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Water Source has been updated Successfully..');
				redirect('admin/water-source-list');
			}
		}
		$data['page'] = 'module/watersource/edit_watersource';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_watersource()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_water_source");
			$this->session->set_flashdata('success', 'Water Source has been Deleted Successfully.');
			redirect('admin/water-source-list');
		}
	}

	

}

	