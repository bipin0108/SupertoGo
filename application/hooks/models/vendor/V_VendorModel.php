<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class V_VendorModel extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    }
	
	private $Vendor = 's_vendor';
	
	public function is_logged_in()
	{  
 		if(isset($this->session->userdata[SESSION_VENDOR]['logged_in']) == 'TRUE' ){
			redirect(base_url('vendor/dashboard'));
		} 
  	}
 	public function not_logged_in()
	{  
 		if(isset($this->session->userdata[SESSION_VENDOR]['logged_in']) != 'TRUE' ){
			redirect('vendor/login');
		} 
  	}
  	
	//use
  	public function GetVendorData()
	{  
 		$this->db->select("*");
		$this->db->from($this->Vendor);
		$this->db->where("vendor_id",$this->session->userdata[SESSION_VENDOR]['vendor_id']);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row_array();
		}else{
			return  array();
		}
   	}

	function update_profile_data($vendor_id)
	{
		$name = trim(ucfirst($_REQUEST['name']));
		$email = $_REQUEST['email'];
		$data = array(
            'name' => $name,
            'email' => $email,            
        );
		$this->db->where('vendor_id', $vendor_id);
        return $this->db->update($this->Vendor, $data);
	}
 	
 // 	public function SMTP_Config(){
		
	// 	$config = Array(
	// 				'protocol' => 'smtp',
	// 				'smtp_host' => 'mail.yourhost.com',
	// 				'smtp_port' => 587,
	// 				'smtp_Vendor' => 'Vendor@domain.com',
	// 				'smtp_pass' => 'password',
	// 				'mailtype' => 'text/html',
	// 				'newline' => '\r\n',
	// 				'charset' => 'utf-8'
	// 		);
	// 	$this->load->library('email', $config);		
	// }

	//vendor login
	function can_login($email, $password)  
	{  
		$this->db->select("*");
		$this->db->from($this->Vendor);
		$this->db->where("email",$email);
		$this->db->where("password",$password);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row_array();
		}else{
			return  array();
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

 	public function get_profileimage($vendor_id)
	{  
 		$this->db->select('profile_image');
		$this->db->from($this->Vendor);
		$this->db->where("vendor_id",$vendor_id);
		$query = $this->db->get();
		if ($query){
			 return $query->row()->profile_image;
		 } else {
			 return false;
		 }
   	}   

 
 }
