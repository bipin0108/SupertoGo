<?php defined('BASEPATH') OR exit('No direct script access allowed');
class BrandController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('brand',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'brand/list'; 
 		$data['brand'] = $this->m_general->getRows("SELECT * FROM tbl_brand WHERE 1 ORDER BY brand_id DESC"); 
		$this->load->view('admin/template',$data);
	}

	public function create_brand(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'brand/add';
		$this->load->view('admin/template',$data);
	}

 	public function add_brand(){
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('name',lang('Brand Name'),'required|trim|is_unique[tbl_brand.name]');

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params = array(
				'name' => ucfirst($_REQUEST['name']) 
			);
			$id = $this->m_general->insertRow('tbl_brand',$params);
			if($id){
				$this->session->set_flashdata('success', lang('add_success'));
				redirect('admin/brand-list');
			}
		}
		$data['page'] = 'brand/add';
		$this->load->view('admin/template',$data);
  	}

	public function edit_brand(){
		$this->adminmodel->CSRFVerify();
		$brand_id = $this->uri->segment(3);
		$data['page'] = 'brand/edit';
		$data['brand'] = $this->m_general->getRow("SELECT * FROM tbl_brand WHERE brand_id=?",array($brand_id)); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_brand(){
  		$this->adminmodel->CSRFVerify();
  		$brand_id = $_REQUEST['id'];
		$data['brand'] = $this->m_general->getRow("SELECT * FROM tbl_brand WHERE brand_id=?",array($brand_id)); 
	   	if($_REQUEST['name'] != $data['brand']['name']) {
		   $is_unique = '|is_unique[tbl_brand.name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('name',lang('Brand Name'),'required|trim'.$is_unique);

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params = array(
				'name' => ucwords($_REQUEST['name'])
			);
			$check = $this->m_general->updateRow('tbl_brand',$params,array("brand_id"=>$brand_id));
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/brand-list');
		}
		$data['page'] = 'brand/edit';
		$this->load->view('admin/template',$data);
  	}

	public function trash_brand(){ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$brand_id = $_REQUEST['id'];
			$this->m_general->deleteRows('tbl_brand',array('brand_id'=>$brand_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/brand-list');
		}
	}

}



