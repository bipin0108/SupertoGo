<?php defined('BASEPATH') OR exit('No direct script access allowed');
class DeliveryBoyController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('delivery_boy',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'delivery_boy/list';
 		$data['user'] = $this->m_general->getRows("SELECT * FROM tbl_delivery_boy WHERE 1 ORDER BY db_id DESC"); 
		$this->load->view('admin/template',$data);
	}

	public function create_delivery_boy(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'delivery_boy/add';
		$this->load->view('admin/template',$data);
	}

 	public function add_delivery_boy(){
 		$this->adminmodel->CSRFVerify();
 		$this->form_validation->set_rules('first_name',lang('First Name'),'required|trim');
 		$this->form_validation->set_rules('last_name',lang('Last Name'),'required|trim');
 		$this->form_validation->set_rules('email',lang('Email'),'required|trim|is_unique[tbl_delivery_boy.email]');
 		$this->form_validation->set_rules('mobile',lang('Mobile'),'required|trim|is_unique[tbl_delivery_boy.mobile]');

 		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$password = $this->randomPassword();
			$params = array(
				'first_name' => ucfirst($_REQUEST['first_name']),
				'last_name' => ucfirst($_REQUEST['last_name']),
				'email' => $_REQUEST['email'],
				'mobile' => $_REQUEST['mobile'],
				'password' => $password
			);
			$id = $this->m_general->insertRow('tbl_delivery_boy',$params);
			if($id){

				$config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
               	);
        		$this->email->initialize($config);
        		$this->email->set_newline("\r\n");

				$message  = "-------------------------------------------<br/>";
				$message .= " Welcome to SupertoGo <br/>";
				$message .= "-------------------------------------------<br/><br/>";
				
				$message .= "Dear ".$_REQUEST['first_name']." ".$_REQUEST['last_name']." <br/><br/>";
				
				$message .= "Please check your email & password of your SupertoGo Delivery account,<br/><br/>";
				
				$message .= "For your information,<br/>";
				$message .= "<b>Email:</b> ".$_REQUEST['email']."<br/>";
				$message .= "<b>Password:</b> ".$password."<br/><br/>";

				$message .= "Sincerely,<br/>";
				$message .= "SupertoGo Team<br/>";
				$message .= "https://supertogo.online";

				$this->email->from('info@supertogo.online', 'SupertoGo Delivery'); 
	         	$this->email->to($_REQUEST['email']);
	         	$this->email->subject('Thnk you for joining to SupertoGo'); 
	         	$this->email->message($message); 

	         	if($this->email->send()) 
	         		$this->session->set_flashdata('success', lang('add_success'));
	         	else 
	         		$this->session->set_flashdata('error', lang('mail_error'));
				redirect('admin/delivery-boy-list');
			}

		}
		$data['page'] = 'delivery_boy/add';
		$this->load->view('admin/template',$data);
  	}
}