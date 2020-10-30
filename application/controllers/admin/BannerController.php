<?php defined('BASEPATH') OR exit('No direct script access allowed');
class BannerController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('banner',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'banner/list'; 
 		$data['banner'] = $this->m_general->getRows("SELECT * FROM tbl_banner WHERE 1 ORDER BY banner_id DESC"); 
		$this->load->view('admin/template',$data);
	}

	public function create_banner(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'banner/add';
		$this->load->view('admin/template',$data);
	}

 	public function add_banner(){
 		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
	 	$this->form_validation->set_rules('image', '', 'callback_file_check');
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	

			$count = $this->m_general->count('tbl_banner');
			if($count >= 3){
				$this->session->set_flashdata('error', lang('image_max3'));
			}else{
				if (!empty($_FILES['image']['name'])) {
		            $path = './uploads/banner/';
		            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["image"]['name']);
		            $this->fileUpload($path, 'image', $new_file_name, 266, 180);
		            $params['image'] = $new_file_name;
		        }
				$id = $this->m_general->insertRow('tbl_banner',$params);
				if($id){
					$this->session->set_flashdata('success', lang('add_success'));
					redirect('admin/banner-list');
				}
			}

		}
		$data['page'] = 'banner/add';
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

	public function trash_banner(){ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$banner_id = $_REQUEST['id'];
			$banner = $this->m_general->getRow('SELECT * FROM tbl_banner WHERE banner_id=?',array($banner_id));
			if(!empty($banner['image'])){
				@unlink('./uploads/banner/'.$banner['image']);
			}
			$this->m_general->deleteRows('tbl_banner',array('banner_id'=>$banner_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/banner-list');
		}
	}

}



