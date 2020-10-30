<?php defined('BASEPATH') OR exit('No direct script access allowed');
class CategoryController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('category',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'category/list';
 		$data['category'] = $this->m_general->getRows("SELECT * FROM tbl_category WHERE 1  ORDER BY cat_id DESC"); 
		$this->load->view('admin/template',$data);
	}

	public function create_category(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'category/add';
		$this->load->view('admin/template',$data);
	}

 	public function add_category(){
 		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
		$this->form_validation->set_rules('name',lang('Category Name'),'required|trim|is_unique[tbl_category.name]');
	 	$this->form_validation->set_rules('image', '', 'callback_file_check');

	 	$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params['name'] = ucwords($_REQUEST['name']);
			if (!empty($_FILES['image']['name'])) {
	            $path = './uploads/category/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["image"]['name']);
	            $this->fileUpload($path, 'image', $new_file_name);
	            $params['image'] = $new_file_name;
	        }
			$id = $this->m_general->insertRow('tbl_category',$params);
			if($id){
				$this->session->set_flashdata('success', lang('add_success'));
				redirect('admin/category-list');
			}
		}
		$data['page'] = 'category/add'; 
		$this->load->view('admin/template',$data);
  	}

  	public function file_check($str){
        $allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', lang('image_type'));
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', lang('image_required'));
            return false;
        }
    }

	public function edit_category(){
		$this->adminmodel->CSRFVerify();
		$cat_id = $this->uri->segment(3);
		$data['page'] = 'category/edit';
		$data['category'] = $this->m_general->getRow("SELECT * FROM tbl_category WHERE cat_id=?",array($cat_id)); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_category(){
  		$this->adminmodel->CSRFVerify();
  		$this->load->helper('file');
  		$cat_id = $_REQUEST['id'];
		$data['category'] = $this->m_general->getRow("SELECT * FROM tbl_category WHERE cat_id=?",array($cat_id)); 
	   	if($_REQUEST['name'] != $data['category']['name']) {
		   $is_unique = '|is_unique[tbl_category.name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('name',lang('Category Name'),'required|trim'.$is_unique);

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params['name'] = ucfirst($_REQUEST['name']);
			if (!empty($_FILES['image']['name'])) {
				$img = $this->m_general->getRow('SELECT * FROM tbl_category WHERE cat_id=?',array($cat_id));
				if(!empty($img['image'])){
					@unlink('./uploads/category/'.$img['image']);
				}
	            $path = './uploads/category/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["image"]['name']);
	            $this->fileUpload($path, 'image', $new_file_name, 266, 180);
	            $params['image'] = $new_file_name;
	        }
			$this->m_general->updateRow('tbl_category',$params,array("cat_id"=>$cat_id));
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/category-list');
		}
		$data['page'] = 'category/edit';
		$this->load->view('admin/template',$data);
  	}

	public function trash_category(){ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$cat_id = $_REQUEST['id'];
			$img = $this->m_general->getRow('SELECT * FROM tbl_category WHERE cat_id=?',array($cat_id));
			if(!empty($img['image'])){
				@unlink('./uploads/category/'.$img['image']);
			}
			$this->m_general->deleteRows('tbl_category',array('cat_id'=>$cat_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/category-list');
		}
	}

}



