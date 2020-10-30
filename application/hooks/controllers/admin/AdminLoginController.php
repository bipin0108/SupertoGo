<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminLoginController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index() 
	{
		$this->adminmodel->is_logged_in();
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
						'type'  => $user['type'],
						'role_id'  => $user['role_id'],
						'name'     => $user['name'],
						'email'     => $user['email'],
						'mobile'     => $user['mobile'],
						'created_by'     => $user['created_by'],
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
				$path = './uploads/profiles/'.$image_name;
				@unlink($path);
			}

			$config['upload_path']   = './uploads/profiles/'; 
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
				$admin_id = $_REQUEST['admin_id'];
				$this->db->where('admin_id', $admin_id);
	        	$this->db->update('s_admin', $data);
				$this->session->set_flashdata('img_success', 'Profile image has been updated Successfully.');
				redirect('admin/profile');
			} 

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

}

