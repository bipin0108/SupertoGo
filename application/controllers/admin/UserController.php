<?php defined('BASEPATH') OR exit('No direct script access allowed');
class UserController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('user',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/list';
 		$data['user'] = $this->m_general->getRows("SELECT * FROM tbl_users WHERE 1 ORDER BY user_id DESC"); 
		$this->load->view('admin/template',$data);
	}
}