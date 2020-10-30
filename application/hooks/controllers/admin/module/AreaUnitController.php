<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AreaUnitController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/AreaUnitModel','areaunitmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/areaunit/list_areaunit';
		$this->load->view('admin/template',$data);
	}

	public function create_areaunit()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/areaunit/add_areaunit';
		$this->load->view('admin/template',$data);
	}

 	public function add_areaunit()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Unit Name in English','required|trim|is_unique[s_plot_area_unit.en_name]');
		$this->form_validation->set_rules('hi_name','Unit Name in Hindi','required|trim|is_unique[s_plot_area_unit.hi_name]');
		$this->form_validation->set_rules('mr_name','Unit Name in Marathi','required|trim|is_unique[s_plot_area_unit.mr_name]');
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'mr_name' => ucfirst($_REQUEST['mr_name']), 
				'hi_name' => ucfirst($_REQUEST['hi_name']), 
			);
			
			$check = $this->areaunitmodel->add_areaunit($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Unit has been added Successfully..');
				redirect('admin/area-unit-list');
			}
		}
		$data['page'] = 'module/areaunit/add_areaunit';
		$this->load->view('admin/template',$data);
  	}

	public function edit_areaunit()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/areaunit/edit_areaunit';
		$data['areaunit'] = $this->areaunitmodel->get_areaunit_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_areaunit()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['areaunit'] = $this->areaunitmodel->get_areaunit_by_id($id); 

	    if($_REQUEST['en_name'] != $data['areaunit']['en_name']) {
	       $is_unique =  '|is_unique[s_plot_area_unit.en_name]';
	    } else {
	       $is_unique =  '';
	    }
		$this->form_validation->set_rules('en_name','Unit Name in English','required|trim'.$is_unique);

		if($_REQUEST['hi_name'] != $data['areaunit']['hi_name']) {
	       $is_unique2 =  '|is_unique[s_plot_area_unit.hi_name]';
	    } else {
	       $is_unique2 =  '';
	    }
		$this->form_validation->set_rules('hi_name','Unit Name in Hindi','required|trim'.$is_unique2);
		
		if($_REQUEST['mr_name'] != $data['areaunit']['mr_name']) {
	       $is_unique1 =  '|is_unique[s_plot_area_unit.mr_name]';
	    } else {
	       $is_unique1 =  '';
	    }
		$this->form_validation->set_rules('mr_name','Unit Name in Marathi','required|trim'.$is_unique1);

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'mr_name' => ucfirst($_REQUEST['mr_name']), 
				'hi_name' => ucfirst($_REQUEST['hi_name']), 
			);
			
			$check = $this->areaunitmodel->update_areaunit_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Unit has been updated Successfully..');
				redirect('admin/area-unit-list');
			}
		}
		$data['page'] = 'module/areaunit/edit_areaunit';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_areaunit()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_plot_area_unit");
			$this->session->set_flashdata('success', 'Unit has been Successfully Deleted.');
			redirect('admin/area-unit-list');
		}
	}

}

