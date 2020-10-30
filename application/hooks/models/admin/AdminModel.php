<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

  	public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }
	
	private $Admin = 's_admin';
	
	public function is_logged_in()
	{  
 		if(isset($this->session->userdata[SESSION_ADMIN]['logged_in']) == 'TRUE' ){
			redirect(base_url('admin/dashboard'));
		} 
  	}
 	public function not_logged_in()
	{  
 		if(isset($this->session->userdata[SESSION_ADMIN]['logged_in']) != 'TRUE' ){
			redirect('admin/login');
		} 
  	}
  	
	//use
  	public function GetUserData()
	{  
 		$this->db->select("*");
		$this->db->from($this->Admin);
		$this->db->where("admin_id",$this->session->userdata[SESSION_ADMIN]['admin_id']);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row_array();
		}else{
			return false;
		}
   	}

	function update_profile_data($admin_id)
	{
		$name = trim(ucfirst($_REQUEST['name']));
		$email = $_REQUEST['email'];
		$data = array(
            'name' => $name,
            'email' => $email,            
        );
		$this->db->where('admin_id', $admin_id);
        return $this->db->update($this->Admin, $data);
	}
 	
 // 	public function SMTP_Config(){
		
	// 	$config = Array(
	// 				'protocol' => 'smtp',
	// 				'smtp_host' => 'mail.yourhost.com',
	// 				'smtp_port' => 587,
	// 				'smtp_Admin' => 'Admin@domain.com',
	// 				'smtp_pass' => 'password',
	// 				'mailtype' => 'text/html',
	// 				'newline' => '\r\n',
	// 				'charset' => 'utf-8'
	// 		);
	// 	$this->load->library('email', $config);		
	// }

	//admin login
	function can_login($email, $password)  
	{  
		$this->db->select("*");
		$this->db->from($this->Admin);
		$this->db->where("email",$email);
		$this->db->where("password",$password);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row_array();
		}else{
			return false;
		}
	}

	public function CSRFVerify()
	{ 
		error_reporting(0);
		$headers = apache_request_headers();
 		$csrf_token = $headers['Authkey'];
		 
		if($this->security->get_csrf_hash() === $csrf_token){
			return;
		}else{
			echo json_encode([ 'code' => 400, 'error' => 'Bad request ,Unknown User!' ]);
			die;
		}
 	}

 	public function get_profileimage($admin_id)
	{  
 		$this->db->select('profile_image');
		$this->db->from($this->Admin);
		$this->db->where("admin_id",$admin_id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->profile_image;
		 } else {
			 return false;
		 }
   	}   

 
 }
