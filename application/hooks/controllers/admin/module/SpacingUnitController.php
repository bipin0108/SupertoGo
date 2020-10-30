<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SpacingUnitController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/SpacingUnitModel','spacingunitmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/spacingareaunit/list_spacingunit';
		$this->load->view('admin/template',$data);
	}

	public function create_spacingunit()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/spacingareaunit/add_spacingunit';
		$this->load->view('admin/template',$data);
	}

 	public function add_spacingunit()
 	{
 		$this->adminmodel->CSRFVerify();

		$this->form_validation->set_rules('en_name','Spacing Area Unit Name in English','required|trim|is_unique[s_spacing_unit.en_name]');
		$this->form_validation->set_rules('hi_name','Spacing Area Unit Name in Hindi','required|trim|is_unique[s_spacing_unit.hi_name]');
		$this->form_validation->set_rules('mr_name','Spacing Area Unit Name in Marathi','required|trim|is_unique[s_spacing_unit.mr_name]');
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
			
			$check = $this->spacingunitmodel->add_spacingunit($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Spacing Area Unit has been added Successfully..');
				redirect('admin/spacing-area-unit-list');
			}
		}
		$data['page'] = 'module/spacingareaunit/add_spacingunit';
		$this->load->view('admin/template',$data);
  	}

	public function edit_spacingunit()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/spacingareaunit/edit_spacingunit';
		$data['spacingunit'] = $this->spacingunitmodel->get_spacingunit_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_spacingunit()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['spacingunit'] = $this->spacingunitmodel->get_spacingunit_by_id($id); 

	   if($_REQUEST['en_name'] != $data['spacingunit']['en_name']) {
		   $is_unique =  '|is_unique[s_spacing_unit.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Spacing Area Unit Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['spacingunit']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_spacing_unit.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Spacing Area Unit Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['spacingunit']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_spacing_unit.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Spacing Area Unit Name in Hindi','required|trim'.$is_unique2);
		
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
			
			$check = $this->spacingunitmodel->update_spacingunit_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Spacing Area Unit has been updated Successfully..');
				redirect('admin/spacing-area-unit-list');
			}
		}
		$data['page'] = 'module/spacingareaunit/edit_spacingunit';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_spacingunit()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_spacing_unit");
			$this->session->set_flashdata('success', 'Spacing Area Unit has been Deleted Successfully.');
			redirect('admin/spacing-area-unit-list');
		}
	}

}

