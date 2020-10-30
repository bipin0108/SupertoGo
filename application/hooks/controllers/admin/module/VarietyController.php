<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class VarietyController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/CropModel','cropmodel');
		$this->load->model('admin/module/VarietyModel','varietymodel');
    }

 	public function index($crop_id)
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['crop_id'] = $crop_id;
 		$data['page'] = 'module/variety/list_variety';
		$this->load->view('admin/template',$data);
	}

	public function create_variety($crop_id)
	{
		$this->adminmodel->CSRFVerify();
		$data['crop_id'] = $crop_id;
		$data['page'] = 'module/variety/add_variety';
		$this->load->view('admin/template',$data);
	}

	public function add_variety()
 	{
 		$this->adminmodel->CSRFVerify();
 		$ch_unique = $this->varietymodel->check_unique_variety('en_name',$_REQUEST['en_name'],$_REQUEST['crop_id']); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_variety.en_name]';
		} else {
		   $is_unique =  '';
		}
 		$this->form_validation->set_rules('en_name','Variety Name in English','required|trim'.$is_unique);

 		$ch_unique1 = $this->varietymodel->check_unique_variety('hi_name',$_REQUEST['hi_name'],$_REQUEST['crop_id']); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_variety.hi_name]';
		} else {
		   $is_unique1 =  '';
		}

		$this->form_validation->set_rules('hi_name','Variety Name in Hindi','required|trim'.$is_unique1);

		$ch_unique2 = $this->varietymodel->check_unique_variety('mr_name',$_REQUEST['mr_name'],$_REQUEST['crop_id']); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_variety.mr_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('mr_name','Variety Name in Marathi','required|trim'.$is_unique2);

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
				'crop_id' => $_REQUEST['crop_id'],
			);

			$check = $this->varietymodel->add_variety($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Variety has been added Successfully..');
				redirect('admin/variety-list/'.$_REQUEST['crop_id']);
			}
		}
		$data['crop_id'] =  $_REQUEST['crop_id'];
		$data['page'] = 'module/variety/add_variety';
		$this->load->view('admin/template',$data);
  	}

  	public function edit_variety()
	{
		$this->adminmodel->CSRFVerify();
		$variety_id = $this->uri->segment(3);
		$data['variety'] = $this->varietymodel->get_variety_by_id($variety_id); 
		$data['page'] = 'module/variety/edit_variety';
		$this->load->view('admin/template',$data);
  	}

  	public function update_variety()
  	{
  		$this->adminmodel->CSRFVerify();
  		$variety_id = $_REQUEST['variety_id'];
		$data['variety'] = $this->varietymodel->get_variety_by_id($variety_id); 

		$ch_unique = $this->varietymodel->check_unique_edit_variety('en_name',$_REQUEST['en_name'],$_REQUEST['crop_id'],$variety_id); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_variety.en_name]';
		} else {
		   $is_unique =  '';
		}
 		$this->form_validation->set_rules('en_name','Variety Name in English','required|trim'.$is_unique);

 		$ch_unique1 = $this->varietymodel->check_unique_edit_variety('hi_name',$_REQUEST['hi_name'],$_REQUEST['crop_id'],$variety_id); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_variety.hi_name]';
		} else {
		   $is_unique1 =  '';
		}

		$this->form_validation->set_rules('hi_name','Variety Name in Hindi','required|trim'.$is_unique1);

		$ch_unique2 = $this->varietymodel->check_unique_edit_variety('mr_name',$_REQUEST['mr_name'],$_REQUEST['crop_id'],$variety_id); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_variety.mr_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('mr_name','Variety Name in Marathi','required|trim'.$is_unique2);

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
			
			$check = $this->varietymodel->update_variety_by_id($variety_id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Variety has been updated Successfully..');
				redirect('admin/variety-list/'.$_REQUEST['crop_id']);
			}
		}
		$data['page'] = 'module/variety/edit_variety';
		$this->load->view('admin/template',$data);
  	}

	public function trash_variety()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['variety_id']))
		{
			$variety_id = $_REQUEST['variety_id'];
			$crop_id = $_REQUEST['crop_id'];
			
			$this->db->where('variety_id', $variety_id);
			$this->db->delete("s_variety");

			$this->session->set_flashdata('success', 'Variety has been Successfully Deleted.');
			redirect('admin/variety-list/'.$_REQUEST['crop_id']);
		}
	}

}

