<?php defined('BASEPATH') OR exit('No direct script access allowed');
class CityController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('city',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'city/list'; 
 		$data['city'] = $this->m_general->getRows("SELECT * FROM tbl_city WHERE 1 ORDER BY city_id DESC"); 
		$this->load->view('admin/template',$data);
	}

	public function create_city(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'city/add';
		$this->load->view('admin/template',$data);
	}

 	public function add_city(){
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('name',lang('City Name'),'required|trim|is_unique[tbl_city.name]');

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params = array(
				'name' => ucfirst($_REQUEST['name']) 
			);
			$id = $this->m_general->insertRow('tbl_city',$params);
			if($id){
				$this->session->set_flashdata('success', lang('add_success'));
				redirect('admin/city-list');
			}
		}
		$data['page'] = 'city/add';
		$this->load->view('admin/template',$data);
  	}

	public function edit_city(){
		$this->adminmodel->CSRFVerify();
		$city_id = $this->uri->segment(3);
		$data['page'] = 'city/edit';
		$data['city'] = $this->m_general->getRow("SELECT * FROM tbl_city WHERE city_id=?",array($city_id)); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_city(){
  		$this->adminmodel->CSRFVerify();
  		$city_id = $_REQUEST['id'];
		$data['city'] = $this->m_general->getRow("SELECT * FROM tbl_city WHERE city_id=?",array($city_id)); 
	   	if($_REQUEST['name'] != $data['city']['name']) {
		   $is_unique = '|is_unique[tbl_city.name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('name',lang('City Name'),'required|trim'.$is_unique);

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params = array(
				'name' => ucwords($_REQUEST['name'])
			);
			$check = $this->m_general->updateRow('tbl_city',$params,array("city_id"=>$city_id));
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/city-list');
		}
		$data['page'] = 'city/edit';
		$this->load->view('admin/template',$data);
  	}

	public function trash_city(){ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$city_id = $_REQUEST['id'];
			$this->m_general->deleteRows('tbl_city',array('city_id'=>$city_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/city-list');
		}
	}

}



