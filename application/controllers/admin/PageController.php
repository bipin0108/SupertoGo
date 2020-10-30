<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PageController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('page',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'page/list'; 
 		$data['pages'] = $this->m_general->getRows("SELECT * FROM tbl_pages"); 
		$this->load->view('admin/template',$data);
	}
 

	public function edit_page(){
		$this->adminmodel->CSRFVerify();
		$page_id = $this->uri->segment(3);
		$data['page'] = 'page/edit';
		$data['pages'] = $this->m_general->getRow("SELECT * FROM tbl_pages WHERE page_id=?",array($page_id)); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_page(){
  		$this->adminmodel->CSRFVerify();
  		$page_id = $_REQUEST['id'];
		$data['pages'] = $this->m_general->getRow("SELECT * FROM tbl_pages WHERE page_id=?",array($page_id)); 
	   	if($_REQUEST['title'] != $data['pages']['title']) {
		   $is_unique = '|is_unique[tbl_pages.title]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('title',lang('Title'),'required|trim'.$is_unique);

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params = array(
				'title' => ucwords($_REQUEST['title']),
				'description' => $_REQUEST['description']
			);
			$check = $this->m_general->updateRow('tbl_pages',$params,array("page_id"=>$page_id));
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/page-list');
		}
		$data['page'] = 'page/edit';
		$this->load->view('admin/template',$data);
  	}

}



