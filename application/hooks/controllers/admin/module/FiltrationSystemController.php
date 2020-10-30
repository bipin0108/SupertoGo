<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FiltrationSystemController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/FiltrationSystemModel','filtrationsystemmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/filtrationsystem/list_filtrationsystem';
		$this->load->view('admin/template',$data);
	}

	public function create_filtrationsystem()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/filtrationsystem/add_filtrationsystem';
		$this->load->view('admin/template',$data);
	}

 	public function add_filtrationsystem()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Filtration System Name in English','required|trim|is_unique[s_filtration_system.en_name]');
		$this->form_validation->set_rules('hi_name','Filtration System Name in Hindi','required|trim|is_unique[s_filtration_system.hi_name]');
		$this->form_validation->set_rules('mr_name','Filtration System Name in Marathi','required|trim|is_unique[s_filtration_system.mr_name]');
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
			
			$check = $this->filtrationsystemmodel->add_filtrationsystem($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Filtration System has been added Successfully..');
				redirect('admin/filtration-system-list');
			}
		}
		$data['page'] = 'module/filtrationsystem/add_filtrationsystem';
		$this->load->view('admin/template',$data);
  	}

	public function edit_filtrationsystem()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/filtrationsystem/edit_filtrationsystem';
		$data['filtrationsystem'] = $this->filtrationsystemmodel->get_filtrationsystem_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_filtrationsystem()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['filtrationsystem'] = $this->filtrationsystemmodel->get_filtrationsystem_by_id($id); 

	    if($_REQUEST['en_name'] != $data['filtrationsystem']['en_name']) {
		   $is_unique =  '|is_unique[s_filtration_system.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Filtration System Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['filtrationsystem']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_filtration_system.mr_name]';
		} else {
		   $is_unique1 =  '';
		}
		$this->form_validation->set_rules('mr_name','Filtration System Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['filtrationsystem']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_filtration_system.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Filtration System Name in Hindi','required|trim'.$is_unique2);
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
			
			$check = $this->filtrationsystemmodel->update_filtrationsystem_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Filtration System has been updated Successfully..');
				redirect('admin/filtration-system-list');
			}
		}
		$data['page'] = 'module/filtrationsystem/edit_filtrationsystem';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_filtrationsystem()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_filtration_system");
			$this->session->set_flashdata('success', 'Filtration System has been Successfully Deleted.');
			redirect('admin/filtration-system-list');
		}
	}

}

