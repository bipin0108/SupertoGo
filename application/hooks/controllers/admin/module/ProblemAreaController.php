<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProblemAreaController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/ProblemAreaModel','problemareamodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/problemarea/list_problemarea';
		$this->load->view('admin/template',$data);
	}

	public function create_problemarea()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/problemarea/add_problemarea';
		$this->load->view('admin/template',$data);
	}

 	public function add_problemarea()
 	{
 		$this->adminmodel->CSRFVerify();
		
		$this->form_validation->set_rules('en_name','Problem Name in English','required|trim|is_unique[s_problem_area.en_name]');
		$this->form_validation->set_rules('hi_name','Problem Name in Hindi','required|trim|is_unique[s_problem_area.hi_name]');
		$this->form_validation->set_rules('mr_name','Problem Name in Marathi','required|trim|is_unique[s_problem_area.mr_name]');
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//error
		}
		else
		{	
			
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'hi_name' => $_REQUEST['hi_name'],
				'mr_name' => $_REQUEST['mr_name'], 
			);
			
			$check = $this->problemareamodel->add_problemarea($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Problem has been added Successfully..');
				redirect('admin/problem-area-list');
			}
		}
		$data['page'] = 'module/problemarea/add_problemarea';
		$this->load->view('admin/template',$data);
  	}

	public function edit_problemarea()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/problemarea/edit_problemarea';
		$data['problemarea'] = $this->problemareamodel->get_problemarea_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_problemarea()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['problemarea'] = $this->problemareamodel->get_problemarea_by_id($id); 

	    if($_REQUEST['en_name'] != $data['problemarea']['en_name']) {
		   $is_unique =  '|is_unique[s_problem_area.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Problem Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['problemarea']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_problem_area.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Problem Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['problemarea']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_problem_area.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Problem Name in Hindi','required|trim'.$is_unique2);
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
			
			$check = $this->problemareamodel->update_problemarea_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Problem has been updated Successfully..');
				redirect('admin/problem-area-list');
			}
		}
		$data['page'] = 'module/problemarea/edit_problemarea';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_problemarea()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_problem_area");
			$this->session->set_flashdata('success', 'Problem has been Successfully Deleted.');
			redirect('admin/problem-area-list');
		}
	}

}

