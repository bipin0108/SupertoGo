<?php defined('BASEPATH') OR exit('No direct script access allowed');
class StoreController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('store',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'store/list'; 
 		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1 ORDER BY store_id DESC"); 
		$this->load->view('admin/template',$data);
	}

	public function create_store(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'store/add';
		$data['city'] = $this->m_general->getRows("SELECT * FROM tbl_city WHERE 1");
		$this->load->view('admin/template',$data);
	}

 	public function add_store(){
 		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
		$this->form_validation->set_rules('name',lang('Store Name'),'required|trim|is_unique[tbl_store.name]');
		$this->form_validation->set_rules('city_ids[]',lang('City'),'required');
	 	$this->form_validation->set_rules('store_icon', '', 'callback_file_checkicon');
	 	$this->form_validation->set_rules('store_banner', '', 'callback_file_checkbanner');

	 	$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params['name'] = ucwords($_REQUEST['name']);
			$params['city_ids'] = implode(",", $_REQUEST['city_ids']);
			if (!empty($_FILES['store_icon']['name'])) {
	            $path = './uploads/store/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["store_icon"]['name']);
	            $this->fileUpload($path, 'store_icon', $new_file_name, 240, 86);
	            $params['store_icon'] = $new_file_name;
	        }
	        if (!empty($_FILES['store_banner']['name'])) {
	            $path = './uploads/store/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["store_banner"]['name']);
	            $this->fileUpload($path, 'store_banner', $new_file_name, 266, 180);
	            $params['store_banner'] = $new_file_name;
	        }
			$id = $this->m_general->insertRow('tbl_store',$params);
			if($id){
				$status = $_REQUEST['status'];
				$days = $_REQUEST['days'];
				$open_time = $_REQUEST['open_time'];
				$close_time = $_REQUEST['close_time'];
				$count = count($status);
				foreach ($status as $idx => $stat) {
					$data = array(
						'store_id'=>$id,
						'day'=>$days[$idx],
						'open_time'=>$open_time[$idx],
						'close_time'=>$close_time[$idx],
						'status'=>$status[$idx],
					);
					$time_id = $this->m_general->insertRow('tbl_store_time',$data);
				}
				$this->session->set_flashdata('success', lang('add_success'));
				redirect('admin/store-list');
			}
		}
		$data['page'] = 'store/add';
		$data['city'] = $this->m_general->getRows("SELECT * FROM tbl_city WHERE 1");
		$this->load->view('admin/template',$data);
  	}

  	public function file_checkicon($str){
        $allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png');
        $mime = get_mime_by_extension($_FILES['store_icon']['name']);
        if(isset($_FILES['store_icon']['name']) && $_FILES['store_icon']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_checkicon', lang('image_type'));
                return false;
            }
        }else{
            $this->form_validation->set_message('file_checkicon', lang('image_required'));
            return false;
        }
    }

    public function file_checkbanner($str){
        $allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png');
        $mime = get_mime_by_extension($_FILES['store_banner']['name']);
        if(isset($_FILES['store_banner']['name']) && $_FILES['store_banner']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_checkbanner', lang('image_type'));
                return false;
            }
        }else{
            $this->form_validation->set_message('file_checkbanner', lang('image_required'));
            return false;
        }
    }

    public function edit_store()
	{
		$this->adminmodel->CSRFVerify();
		$store_id = $this->uri->segment(3);
		$data['page'] = 'store/edit';
		$data['city'] = $this->m_general->getRows("SELECT * FROM tbl_city WHERE 1");
		$data['store'] = $this->m_general->getRow("SELECT * FROM tbl_store WHERE store_id=?",array($store_id));
		$data['store_time'] = $this->m_general->getRows("SELECT * FROM tbl_store_time WHERE store_id=?",array($store_id)); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_store()
  	{
		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
		$store_id = $_REQUEST['id'];
		$data['store'] = $this->m_general->getRow("SELECT * FROM tbl_store WHERE store_id=?",array($store_id));
		$is_unique = '';
	   	if($_REQUEST['name'] != $data['store']['name']) {
		   $is_unique = '|is_unique[tbl_store.name]';
		}
		$this->form_validation->set_rules('name',lang('Store Name'),'required'.$is_unique);
		$this->form_validation->set_rules('city_ids[]',lang('City'),'required');

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)
		{  
			//error
		}
		else
		{	
			$params['name'] = $_REQUEST['name'];
			$params['city_ids'] = implode(",", $_REQUEST['city_ids']);
			$img = $this->m_general->getRow('SELECT * FROM tbl_store WHERE store_id=?',array($store_id));
			if (!empty($_FILES['store_icon']['name'])) {
				if(!empty($img['store_icon'])){
					@unlink('./uploads/store/'.$img['store_icon']);
				}
	            $path = './uploads/store/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["store_icon"]['name']);
	            $this->fileUpload($path, 'store_icon', $new_file_name, 240, 86);
	            $params['store_icon'] = $new_file_name;
	        }
	        if (!empty($_FILES['store_banner']['name'])) {
				if(!empty($img['store_banner'])){
					@unlink('./uploads/store/'.$img['store_banner']);
				}
	            $path = './uploads/store/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["store_banner"]['name']);
	            $this->fileUpload($path, 'store_banner', $new_file_name, 266, 180);
	            $params['store_banner'] = $new_file_name;
	        }
		 	$this->m_general->updateRow('tbl_store',$params,array("store_id"=>$store_id));
	        $this->m_general->deleteRows('tbl_store_time',array('store_id'=>$store_id));
			$status = $_REQUEST['status'];
			$days = $_REQUEST['days'];
			$open_time = $_REQUEST['open_time'];
			$close_time = $_REQUEST['close_time'];
			$count = count($status);
			foreach ($status as $idx => $stat) {
				$prms = array(
					'store_id'=>$store_id,
					'day'=>$days[$idx],
					'open_time'=>$open_time[$idx],
					'close_time'=>$close_time[$idx],
					'status'=>$status[$idx],
				);
				$time_id = $this->m_general->insertRow('tbl_store_time',$prms);
			}
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/store-list');
		}
		$data['page'] = 'store/edit';
		$data['city'] = $this->m_general->getRows("SELECT * FROM tbl_city WHERE 1");
		$data['store_time'] = $this->m_general->getRows("SELECT * FROM tbl_store_time WHERE store_id=?",array($store_id)); 
		$this->load->view('admin/template',$data);
  	}

	public function trash_store(){
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$store_id = $_REQUEST['id'];
			$store = $this->m_general->getRow('SELECT * FROM tbl_store WHERE store_id=?',array($store_id));
			@unlink('./uploads/store/'.$store['store_icon']);
			@unlink('./uploads/store/'.$store['store_banner']);
			$this->m_general->deleteRows('tbl_store',array('store_id'=>$store_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/store-list');
		}
	}

}



