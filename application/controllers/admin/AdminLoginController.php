<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminLoginController extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index() 
	{
		$this->adminmodel->is_logged_in();
		$this->session->set_userdata('site_lang',  "spanish");
		$this->load->view('admin/login/Login_template');
	}
	//admin login
	public function authlogincheck()
	{
		$this->adminmodel->is_logged_in();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');  
		$this->form_validation->set_rules('password', 'Password', 'required'); 
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == FALSE)  
		{  
			$this->load->view('admin/login/Login_template');
		}  
		else  
		{  
			$email = $this->input->post('email');  
			$password = $this->input->post('password');  
			$user = $this->adminmodel->can_login($email, $password);
			if($user == TRUE)  
			{   
				if($user['is_active'] == '1')
				{ 
					$userdata = [
						'admin_id'  => $user['admin_id'],
						'name'     => $user['name'],
						'email'     => $user['email'],
						'mobile'     => $user['mobile'],
						'logged_in' => 'TRUE'
					];
					$this->session->set_userdata(SESSION_ADMIN,$userdata);
					redirect('admin/dashboard'); 
				}
				else
				{
					$this->session->set_flashdata('error', 'Sorry, you are not allowed to access this panel!!');  
					$this->load->view('admin/login/Login_template');
				}			
			}  
			else  
			{  
				$this->session->set_flashdata('error', 'Invalid Email and Password');  
				$this->load->view('admin/login/Login_template');
			}  
		}
	}
	//logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}

	public function switchLang($language = "") {
	    $this->session->set_userdata('site_lang', $language);
	    redirect('admin');
	}
	public function user_profile()
	{
		$data['profile'] = "user_profile";
		$data['page'] = "login/user_profile";
 		$this->load->view('admin/template', $data);
 	}

	public function change_photo()
	{
		if(!empty($_FILES['avatar_img'])){

			$image_name = $this->adminmodel->get_profileimage($_REQUEST['admin_id']);
			if($image_name != '')
			{
				$path = './uploads/profiles/original/'.$image_name;
				@unlink($path);
				$t_path = './uploads/profiles/thumbnail/'.$image_name;
				@unlink($t_path);
			}

			$original_path = './uploads/profiles/original/';
			$thumb_path = './uploads/profiles/thumbnail/';
			$new_file_name = rand().'_'.str_replace(' ', '', $_FILES["avatar_img"]['name']);
			$this->upload_img_with_thumb($original_path,$thumb_path,'avatar_img',$new_file_name);
			
			$data = array('profile_image'=>$new_file_name);
			$admin_id = $_REQUEST['admin_id'];
			$this->db->where('admin_id', $admin_id);
        	$this->db->update('s_admin', $data);
			$this->session->set_flashdata('img_success', 'Profile image has been updated Successfully.');
			redirect('admin/profile');
		}
		$data['page'] = "login/user_profile";
		$this->load->view('admin/template', $data);	
	}

 	public function user_update_profile_data()
	{ 
		$this->form_validation->set_rules('name', 'Name', 'required');  
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');  
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//error
		}
		else
		{
			$admin_id = $_REQUEST['admin_id'];
			$this->adminmodel->update_profile_data($admin_id);
			$check = $this->adminmodel->update_profile_data($admin_id);
			if($check)
			{
				$this->session->set_flashdata('success', 'Profile has been updated Successfully.');
				redirect('admin/profile');
			}
		} 
		$data['page'] = "login/user_profile";
		$this->load->view('admin/template', $data); 
 	}


	public function change_admin_profile_password_update()
	{
		$this->load->library('form_validation');  
		$this->form_validation->set_rules('old_pwd', 'Current Password', 'required');  
		$this->form_validation->set_rules('new_pwd', 'New Password', 'required|min_length[8]|alpha_numeric');  
		$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'required|matches[new_pwd]');  
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			// error
		}
		else
		{
			$old_pwd = $this->input->post('old_pwd');
			$admin_id = $this->input->post('admin_id');
			$this->db->where('admin_id',$admin_id);
			$q = $this->db->get('s_admin');
			$get_user = $q->row();
			if($old_pwd == $get_user->password)
			{
				$update_data = array('password'=>$this->input->post('new_pwd'));
				$this->db->where('admin_id', $admin_id);
	        	$this->db->update('s_admin', $update_data);
				$this->session->set_flashdata('pwd_success', 'Your password has been Successfully updated.');
				redirect('admin/profile');
			}
			else
			{
				$this->session->set_flashdata('pwd_error', 'Old password is wrong. Please try again.');
				
			}	
		} 

		$data['page'] = "login/user_profile";
 		$this->load->view('admin/template', $data); 
  	}

  	public function i_forgot_my_password(){
		$this->adminmodel->is_logged_in();
		if(!empty($_POST)){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$date = date('Y-m-d H:i:s',time());
				$time = date("H:i:s",strtotime($date));
				$min15 = strtotime("+15 minutes",strtotime($time));
				$temp_expiry = date('H:i:s', $min15);

				$temp_password = $this->randomPassword();
				$email = $_POST['email'];
				$check = $this->adminmodel->IfExistEmail($email);
				if(!$check){
					$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! You enter a Wrong email ID.</h4>Please try again or later.');
				}else{

					$subject = "SmartCrop Reset Password";
					$key = $this->encrypt_decrypt('encrypt', $email);
					$link = "<a style='padding: 8px 12px; background-color: #3c8dbc; border-color: #367fa9; border-radius: 2px; font-size: 14px; color:#FFFFFF;text-decoration: none;display: inline-block;' class='btn btn-primary' href='".base_url()."admin/reset-password/".$key."'>Click To Reset password</a>";
					$description = "Your password will be expire in 15 Minutes. <br/>Your temp password is :- $temp_password" ;
					$message = "Welcome to SmartCrop,<br/>" .
					"You have requested for password reset. $description<br/>" .
					"<p>$link</p>" .  
					"Click On This Link to Reset Password <br/>" .
					base_url() . "admin/reset-password/" . $key . "<br/>" .
					"Thank you,<br/>";

					if($this->sendemail($email, $subject, $message, $key)){
						$this->adminmodel->updateData($email,array("temp_password"=>$temp_password,"temp_expiry"=>$temp_expiry ));
						$this->session->set_flashdata('success', '<h4><i class="icon fa fa-check"></i> Success! A Reset password has been sent to your email account.</h4>Please check your mailbox and click to link reset new password.');
						redirect('admin/login/');
					}else{
						$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! Email not sent successfully.</h4>Please try again or later.');	
					}
				}
			}
		}
		$this->load->view('admin/login/forgot_password_template');
	}

	public function reset_password($key){
		$this->adminmodel->is_logged_in();
		$email = $this->encrypt_decrypt('decrypt',$key);
		$id = $this->adminmodel->get_id_by_email($email);
		if(!empty($_POST)){
			$this->form_validation->set_rules('temp_password', 'Tepm Password', 'required'); 
			$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]'); 
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$result = $this->adminmodel->_checkResetPassword($email, $_POST['temp_password']);
				if($result){
					if($result->is_expiry == 1){
						$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! Your temp password has been expire.</h4>Please try again or later.');
					}else{
						$params = array('password'=>$_POST['new_password'],'temp_password'=>'');
						$this->adminmodel->update_reset_password($params, $id);
						$this->session->set_flashdata('success', '<h4><i class="icon fa fa-check"></i> Success! Your password is reset successfully.</h4>Please you can login now.');
						redirect('admin/login/');
					}
					
				}else{
					$this->session->set_flashdata('error', '<h4><i class="icon fa fa-ban"></i> Error! Something went wrong.</h4>Please try again or later.');
				}
			}
		}
		$this->load->view('admin/login/reset_password_template');
	}

	//encrypt/decrypt
	function encrypt_decrypt($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'SmartCropSecretKeyForResetPasswordkey';
		$secret_iv = 'SmartCropSecretKeyForResetPasswordiv';
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}

//end
}

