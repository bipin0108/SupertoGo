<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SpecialalertController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/SpecialalertModel','specialalertmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'specialalert/list_specialalert';
		$this->load->view('admin/template',$data);
	}

	public function create_special_alert()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'specialalert/add_specialalert';
		$this->load->view('admin/template',$data);
	}

	public function add_special_alert()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_title','Title in English','required|trim|is_unique[s_special_alert.en_title]');
		$this->form_validation->set_rules('hi_title','Title in Hindi','required|trim|is_unique[s_special_alert.hi_title]');
		$this->form_validation->set_rules('mr_title','Title in Marathi','required|trim|is_unique[s_special_alert.mr_title]');
		$this->form_validation->set_rules('en_description','Description in English','required|trim');
		$this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_title' => ucfirst($_REQUEST['en_title']), 
				'en_description' => $_REQUEST['en_description'],
				'hi_title' => $_REQUEST['hi_title'], 
				'hi_description' => $_REQUEST['hi_description'],
				'mr_title' => $_REQUEST['mr_title'], 
				'mr_description' => $_REQUEST['mr_description'],
			);

			$check = $this->specialalertmodel->add_special_alert($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Special Alert has been added Successfully..');
				redirect('admin/special-alert-list');
			}
		}
		$data['page'] = 'specialalert/add_specialalert';
		$this->load->view('admin/template',$data);
  	}

  	public function edit_special_alert()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'specialalert/edit_specialalert';
		$data['specialalert'] = $this->specialalertmodel->get_special_alert_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_special_alert()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['specialalert'] = $this->specialalertmodel->get_special_alert_by_id($id); 

		if($_REQUEST['en_title'] != $data['specialalert']['en_title']) {
	       $is_unique =  '|is_unique[s_special_alert.en_title]';
	    } else {
	       $is_unique =  '';
	    }
		$this->form_validation->set_rules('en_title','Title in English','required|trim'.$is_unique);

		if($_REQUEST['hi_title'] != $data['specialalert']['hi_title']) {
	       $is_unique1 =  '|is_unique[s_special_alert.hi_title]';
	    } else {
	       $is_unique1 =  '';
	    }
		$this->form_validation->set_rules('hi_title','Title in Hindi','required|trim'.$is_unique1);

		if($_REQUEST['mr_title'] != $data['specialalert']['mr_title']) {
	       $is_unique2 =  '|is_unique[s_special_alert.mr_title]';
	    } else {
	       $is_unique2 =  '';
	    }
		$this->form_validation->set_rules('mr_title','Title in Marathi','required|trim'.$is_unique2);

		$this->form_validation->set_rules('en_description','Description in English','required|trim');
		$this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_title' => ucfirst($_REQUEST['en_title']), 
				'en_description' => $_REQUEST['en_description'],
				'hi_title' => $_REQUEST['hi_title'], 
				'hi_description' => $_REQUEST['hi_description'],
				'mr_title' => $_REQUEST['mr_title'], 
				'mr_description' => $_REQUEST['mr_description'],
			);

			$check = $this->specialalertmodel->update_special_alert_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Special Alert has been updated Successfully..');
				redirect('admin/special-alert-list');
			}
		}
		$data['page'] = 'specialalert/edit_specialalert';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_special_alert()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_special_alert");
			$this->session->set_flashdata('success', 'Special Alert has been Successfully Deleted.');
			redirect('admin/special-alert-list');
		}
	}

	

}

	