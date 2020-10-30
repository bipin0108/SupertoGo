<?php defined('BASEPATH') OR exit('No direct script access allowed');
class StaticpageController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/StaticPageModel','staticpagemodel');
    }

	public function index() 
	{
		$data['page'] = 'static_pages/list_static_pages';
		$this->load->view('admin/template',$data);
	}

	public function edit_staticpages()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'static_pages/edit_static_pages';
		$this->load->view('admin/template',$data);
  	}

  	public function update_static_pages()
  	{
		// print_r($_REQUEST);die;
		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('page_detail','Page Detail','required');
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)
		{  
			//error
		}
		else
		{
			$params = array(
				'page_detail' => $_REQUEST['page_detail'], 
			);

			$check = $this->staticpagemodel->update_static_pages_by_id($_REQUEST['id'] ,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Page Detail has been updated Successfully..');
				redirect('admin/list-static-pages');
			}
		}
		$data['page'] = 'static_pages/edit_static_pages';
		$this->load->view('admin/template',$data);
  	}
	
}
