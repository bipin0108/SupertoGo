<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_VendorLoginController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index() 
	{
		$this->v_vendormodel->is_logged_in();
		$this->load->view('vendor/login/Login_template');
	}
	//vendor login
	public function authlogincheck()
	{
		$this->v_vendormodel->is_logged_in();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');  
		$this->form_validation->set_rules('password', 'Password', 'required'); 
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == FALSE)  
		{  
			$this->load->view('vendor/login/Login_template');
		}  
		else  
		{  
			$email = $this->input->post('email');  
			$password = $this->input->post('password');  
			$user = $this->v_vendormodel->can_login($email, $password);
			if($user == TRUE)  
			{   
				if($user['is_active'] == '1')
				{ 
					$userdata = [
						'vendor_id'  => $user['vendor_id'],
						'type'  => $user['type'],
						'role_id'  => $user['role_id'],
						'name'     => $user['name'],
						'email'     => $user['email'],
						'mobile'     => $user['mobile'],
						'created_by'     => $user['created_by'],
						'logged_in' => 'TRUE'
					];
					$this->session->set_userdata(SESSION_VENDOR,$userdata);
					redirect('vendor/dashboard'); 
				}
				else
				{
					$this->session->set_flashdata('error', 'Sorry, you are not allowed to access this panel!!');  
					$this->load->view('vendor/login/Login_template');
				}			
			}  
			else  
			{  
				$this->session->set_flashdata('error', 'Invalid Email and Password');  
				$this->load->view('vendor/login/Login_template');
			}  
		}
	}
	//logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('vendor/login');
	}
	public function user_profile()
	{
		$data['profile'] = "user_profile";
		$data['page'] = "login/user_profile";
 		$this->load->view('vendor/template', $data);
 	}

	public function change_photo()
	{
		if(!empty($_FILES['avatar_img'])){

			$image_name = $this->v_vendormodel->get_profileimage($_REQUEST['vendor_id']);

			if($image_name != '')
			{
				$path = './uploads/vendor_profiles/'.$image_name;
				@unlink($path);
			}

			$config['upload_path']   = './uploads/vendor_profiles/'; 
			$config['allowed_types'] = 'jpg|png|jpeg'; 
			$new_name = rand().'_'.str_replace(' ', '', $_FILES["avatar_img"]['name']);
			$config['file_name'] = $new_name; 
			
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('avatar_img')) 
			{
				$error = array('error' => $this->upload->display_errors());
		    	$this->session->set_flashdata('img_error',$error['error']);

			}
			else
			{ 
				$img_file = $this->upload->data(); 
				$data = array('profile_image'=>$new_name);
				$vendor_id = $_REQUEST['vendor_id'];
				$this->db->where('vendor_id', $vendor_id);
	        	$this->db->update('s_vendor', $data);
				$this->session->set_flashdata('img_success', 'Profile image has been updated Successfully.');
				redirect('vendor/profile');
			} 

		}
		$data['page'] = "login/user_profile";
		$this->load->view('vendor/template', $data);	
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
			$vendor_id = $_REQUEST['vendor_id'];
			$this->v_vendormodel->update_profile_data($vendor_id);
			$check = $this->v_vendormodel->update_profile_data($vendor_id);
			if($check)
			{
				$this->session->set_flashdata('success', 'Profile has been updated Successfully.');
				redirect('vendor/profile');
			}
		} 

		$data['page'] = "login/user_profile";
		$this->load->view('vendor/template', $data); 
		
 	}


	public function change_vendor_profile_password_update()
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
			$vendor_id = $this->input->post('vendor_id');
			$this->db->where('vendor_id',$vendor_id);
			$q = $this->db->get('s_vendor');
			$get_user = $q->row();
			if($old_pwd == $get_user->password)
			{
				$update_data = array('password'=>$this->input->post('new_pwd'));
				$this->db->where('vendor_id', $vendor_id);
	        	$this->db->update('s_vendor', $update_data);
				$this->session->set_flashdata('pwd_success', 'Your password has been Successfully updated.');
				redirect('vendor/profile');
			}
			else
			{
				$this->session->set_flashdata('pwd_error', 'Old password is wrong. Please try again.');
				
			}	
		} 

		$data['page'] = "login/user_profile";
 		$this->load->view('vendor/template', $data); 
  	}

}

