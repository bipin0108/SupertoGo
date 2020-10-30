<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BacterialIntensityController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/BacterialIntensityModel','bacterialintensitymodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/bacterialintensity/list_bacterialintensity';
		$this->load->view('admin/template',$data);
	}

	public function create_bacterialintensity()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/bacterialintensity/add_bacterialintensity';
		$this->load->view('admin/template',$data);
	}

 	public function add_bacterialintensity()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Bacterial Intensity Name in English','required|trim|is_unique[s_bacterial_blight_intensity.en_name]');
		$this->form_validation->set_rules('hi_name','Bacterial Intensity Name in Hindi','required|trim|is_unique[s_bacterial_blight_intensity.hi_name]');
		$this->form_validation->set_rules('mr_name','Bacterial Intensity Name in Marathi','required|trim|is_unique[s_bacterial_blight_intensity.mr_name]');
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
			
			$check = $this->bacterialintensitymodel->add_bacterialintensity($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Bacterial Intensity has been added Successfully..');
				redirect('admin/bacterial-intensity-list');
			}
		}
		$data['page'] = 'module/bacterialintensity/add_bacterialintensity';
		$this->load->view('admin/template',$data);
  	}

	public function edit_bacterialintensity()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/bacterialintensity/edit_bacterialintensity';
		$data['bacterialintensity'] = $this->bacterialintensitymodel->get_bacterialintensity_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_bacterialintensity()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['bacterialintensity'] = $this->bacterialintensitymodel->get_bacterialintensity_by_id($id); 

	   if($_REQUEST['en_name'] != $data['bacterialintensity']['en_name']) {
		   $is_unique =  '|is_unique[s_bacterial_blight_intensity.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Bacterial Intensity Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['bacterialintensity']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_bacterial_blight_intensity.mr_name]';
		} else {
		   $is_unique1 =  '';
		}
		$this->form_validation->set_rules('mr_name','Bacterial Intensity Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['bacterialintensity']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_bacterial_blight_intensity.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Bacterial Intensity Name in Hindi','required|trim'.$is_unique2);
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
			
			$check = $this->bacterialintensitymodel->update_bacterialintensity_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Bacterial Intensity has been updated Successfully..');
				redirect('admin/bacterial-intensity-list');
			}
		}
		$data['page'] = 'module/bacterialintensity/edit_bacterialintensity';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_bacterialintensity()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_bacterial_blight_intensity");
			$this->session->set_flashdata('success', 'Bacterial Intensity has been Successfully Deleted.');
			redirect('admin/bacterial-intensity-list');
		}
	}

}

