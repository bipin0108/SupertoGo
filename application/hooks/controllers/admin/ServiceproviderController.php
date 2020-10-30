<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ServiceproviderController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/ServiceproviderModel','serviceprovidermodel');
    }

 	public function service_provider_list()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'serviceprovider/list_service_provider';
		$this->load->view('admin/template',$data);	
	}

	//category
	public function service_provider_category_list()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'serviceprovider/list_servicepro_cat';
		$this->load->view('admin/template',$data);	
	}

	public function create_service_provider_category()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'serviceprovider/add_servicepro_cat';
		$this->load->view('admin/template',$data);
	}

 	public function add_service_provider_category()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_name','Category Name in English','required|trim|is_unique[s_service_provider_category.en_name]');
		$this->form_validation->set_rules('hi_name','Category Name in Hindi','required|trim|is_unique[s_service_provider_category.hi_name]');
		$this->form_validation->set_rules('mr_name','Category Name in Marathi','required|trim|is_unique[s_service_provider_category.mr_name]');
		if (empty($_FILES['cat_image']['name'])){
			$this->form_validation->set_rules('cat_image','Category Image','required');
		}
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

			if (!empty($_FILES['cat_image']['name']))
			{

				if (!is_dir('./uploads/serviceprovider_cat/')) {
					mkdir('./uploads/serviceprovider_cat/', 0777, TRUE);
				}

			    $config['upload_path']   = './uploads/serviceprovider_cat/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$new_name = rand().'_'.str_replace(' ', '', $_FILES["cat_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cat_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$img_file = $this->upload->data(); 
					$params['cat_image'] = $new_name;
				}
			}
			
			$check = $this->serviceprovidermodel->add_service_provider_category($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Category has been added Successfully..');
				redirect('admin/service-provider-category-list');
			}
		}
		$data['page'] = 'serviceprovider/add_servicepro_cat';
		$this->load->view('admin/template',$data);
  	}



	public function edit_service_provider_category()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'serviceprovider/edit_servicepro_cat';
		$data['category'] = $this->serviceprovidermodel->get_service_provider_category_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_service_provider_category()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['category'] = $this->serviceprovidermodel->get_service_provider_category_by_id($id); 

	    if($_REQUEST['en_name'] != $data['category']['en_name']) {
		   $is_unique =  '|is_unique[s_service_provider_category.en_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_name','Category Name in English','required|trim'.$is_unique);

		if($_REQUEST['mr_name'] != $data['category']['mr_name']) {
		   $is_unique1 =  '|is_unique[s_service_provider_category.mr_name]';
		} else {
		   $is_unique1 =  '';	
		}
		$this->form_validation->set_rules('mr_name','Category Name in Marathi','required|trim'.$is_unique1);

		if($_REQUEST['hi_name'] != $data['category']['hi_name']) {
		   $is_unique2 =  '|is_unique[s_service_provider_category.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Category Name in Hindi','required|trim'.$is_unique2);
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

			if (!empty($_FILES['cat_image']['name']))
			{
				if($data['category']['cat_image'] != '')
				{
					$path = './uploads/serviceprovider_cat/'.$data['category']['cat_image'];
					@unlink($path);
				}
			
				$config['upload_path']   = './uploads/serviceprovider_cat/';
				$config['allowed_types'] = 'jpg|png|jpeg'; 
				$new_name = rand().'_'.str_replace(' ', '', $_FILES["cat_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cat_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$img_file = $this->upload->data(); 
					$params['cat_image'] = $new_name;
				}
			}
			
			$check = $this->serviceprovidermodel->update_service_provider_category_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Category has been updated Successfully..');
				redirect('admin/service-provider-category-list');
			}
		}
		$data['page'] = 'serviceprovider/edit_servicepro_cat';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_service_provider_category()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$data['category'] = $this->serviceprovidermodel->get_service_provider_category_by_id($id); 
			if($data['category']['cat_image'] != '')
			{
				$path = './uploads/serviceprovider_cat/'.$data['category']['cat_image'];
				@unlink($path);
			}
			$this->db->where('id', $id);
			$this->db->delete("s_service_provider_category");
			$this->session->set_flashdata('success', 'Category has been Successfully Deleted.');
			redirect('admin/service-provider-category-list');
		}
	}



	//suggested category
	public function service_provider_suggested_category_list()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'serviceprovider/list_servicepro_suggcat';
		$this->load->view('admin/template',$data);	
	}

	public function trash_service_provider_suggested_category()
	{
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_service_provider_suggested_cat");
			$this->session->set_flashdata('success', 'Suggested Category has been Successfully Deleted.');
			redirect('admin/service-provider-suggested-category-list');
		}
	}

//end
}

	