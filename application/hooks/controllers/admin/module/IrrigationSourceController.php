<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IrrigationSourceController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/IrrigationSourceModel','irrigationsourcemodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/irrigationsource/list_irrigationsource';
		$this->load->view('admin/template',$data);
	}

	public function create_irrigationsource()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/irrigationsource/add_irrigationsource';
		$this->load->view('admin/template',$data);
	}

 	public function add_irrigationsource()
 	{
 		$this->adminmodel->CSRFVerify();
		
		$this->form_validation->set_rules('en_name','Irrigation Source Name in English','required|trim|is_unique[s_irrigation_source.en_name]');
		$this->form_validation->set_rules('hi_name','Irrigation Source Name in Hindi','required|trim|is_unique[s_irrigation_source.hi_name]');
		$this->form_validation->set_rules('mr_name','Irrigation Source Name in Marathi','required|trim|is_unique[s_irrigation_source.mr_name]');

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
			
			$check = $this->irrigationsourcemodel->add_irrigationsource($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Irrigation Source has been added Successfully..');
				redirect('admin/irrigation-source-list');
			}
		}
		$data['page'] = 'module/irrigationsource/add_irrigationsource';
		$this->load->view('admin/template',$data);
  	}

  	public function edit_irrigationsource()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/irrigationsource/edit_irrigationsource';
		$data['irrigationsource'] = $this->irrigationsourcemodel->get_irrigationsource_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_irrigationsource()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['irrigationsource'] = $this->irrigationsourcemodel->get_irrigationsource_by_id($id); 

		if($_REQUEST['en_name'] != $data['irrigationsource']['en_name']) {
		   $is_unique =  '|is_unique[s_irrigation_source.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Irrigation Source Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['irrigationsource']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_irrigation_source.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Irrigation Source Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['irrigationsource']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_irrigation_source.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Irrigation Source Name in Hindi','required|trim'.$is_unique2);
		
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
			
			$check = $this->irrigationsourcemodel->update_irrigationsource_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Irrigation Source has been updated Successfully..');
				redirect('admin/irrigation-source-list');
			}
		}
		$data['page'] = 'module/irrigationsource/edit_irrigationsource';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_irrigationsource()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_irrigation_source");
			$this->session->set_flashdata('success', 'Irrigation Source has been Deleted Successfully.');
			redirect('admin/irrigation-source-list');
		}
	}

	

}

	