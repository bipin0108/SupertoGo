<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubadminController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/SubadminModel','subadminmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'subadmin/list_subadmin';
		$this->load->view('admin/template',$data);
	}

	public function create_subadmin()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'subadmin/add_subadmin';
		$this->load->view('admin/template',$data);
	}

 	public function add_subadmin()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|is_unique[s_admin.email]|valid_email');
		$this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
		$this->form_validation->set_rules('mobile','Mobile No.','required|trim|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('pincode','Pincode','required|trim|trim|numeric|min_length[6]|max_length[6]');
		$this->form_validation->set_rules('village','Village','required|trim');
		$this->form_validation->set_rules('district','District','required|trim');
		$this->form_validation->set_rules('city','City','required|trim');
		$this->form_validation->set_rules('state','State','required|trim');
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'name' => ucfirst($_REQUEST['name']), 
				'email' => $_REQUEST['email'], 
				'password' => $_REQUEST['password'], 
				'mobile' => $_REQUEST['mobile'], 
				'role_id' => '	1', 
				'pincode' => $_REQUEST['pincode'], 
				'village' => $_REQUEST['village'], 
				'district' => $_REQUEST['district'], 
				'city' => $_REQUEST['city'], 
				'state' => $_REQUEST['state'], 
				'address' => $_REQUEST['address'], 
				'type' => 'subadmin',
				'profile_image' => '',
				'created_by' => $this->session->userdata[SESSION_ADMIN]['admin_id'],
			);
			
			$insert_id = $this->subadminmodel->add_subadmin($params);
			if(isset($insert_id))
			{
				$this->db->select('*');
				$query = $this->db->get('s_permission');
				$permission = $query->result();
				foreach($permission as $row)
				{
					$permission_param = array(
						'user_id' => $insert_id, 
						'permission_id' => $row->permission_id, 
					);
					$this->db->set($permission_param);
    				$this->db->insert('s_role_permission');
				}
				$this->session->set_flashdata('success', 'Subadmin has been added Successfully..');
				redirect('admin/subadmin-list');
			}
		}
		$data['page'] = 'subadmin/add_subadmin';
		$this->load->view('admin/template',$data);
  	}

	public function edit_subadmin()
	{
		$this->adminmodel->CSRFVerify();
		$subadmin_id = $this->uri->segment(3);
		$data['page'] = 'subadmin/edit_subadmin';
		$data['subadmin'] = $this->subadminmodel->get_subadmin_by_id($subadmin_id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_subadmin()
  	{
  		$this->adminmodel->CSRFVerify();
  		$admin_id = $_REQUEST['admin_id'];
  		$data['subadmin'] = $this->subadminmodel->get_subadmin_by_id($admin_id); 


		$this->form_validation->set_rules('name','Name','required|trim');
		$original_value = $this->db->query("SELECT email FROM s_admin WHERE admin_id = ".$admin_id)->row()->email ;

	    if($_REQUEST['email'] != $original_value) {
	       $is_unique =  '|is_unique[s_admin.email]';
	    } else {
	       $is_unique =  '';
	    }
		$this->form_validation->set_rules('email','Email','required|trim|valid_email'.$is_unique);
		$this->form_validation->set_rules('password','Password','required|trim');
		$m_original_value = $this->db->query("SELECT mobile FROM s_admin WHERE admin_id = ".$admin_id)->row()->mobile ;
	    if($_REQUEST['mobile'] != $m_original_value) {
	       $m_is_unique =  '|is_unique[s_admin.mobile]';
	    } else {
	       $m_is_unique =  '';
	    }
		$this->form_validation->set_rules('mobile','Mobile Number','required|trim|numeric|min_length[10]|max_length[10]'.$m_is_unique);
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('pincode','Pincode','required|trim|trim|numeric|min_length[6]|max_length[6]');
		$this->form_validation->set_rules('village','Village','required|trim');
		$this->form_validation->set_rules('district','District','required|trim');
		$this->form_validation->set_rules('city','City','required|trim');
		$this->form_validation->set_rules('state','State','required|trim');
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'name' => ucfirst($_REQUEST['name']), 
				'email' => $_REQUEST['email'], 
				'password' => $_REQUEST['password'], 
				'mobile' => $_REQUEST['mobile'], 
				'pincode' => $_REQUEST['pincode'], 
				'village' => $_REQUEST['village'], 
				'district' => $_REQUEST['district'], 
				'city' => $_REQUEST['city'], 
				'state' => $_REQUEST['state'], 
				'address' => $_REQUEST['address'], 
			);
			
			$check = $this->subadminmodel->update_subadmin_by_id($admin_id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Subadmin has been updated Successfully..');
				redirect('admin/subadmin-list');
			}
		}
		$data['page'] = 'subadmin/edit_subadmin';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_subadmin()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['admin_id']))
		{
			$admin_id = $_REQUEST['admin_id'];
			$image_name = $this->subadminmodel->get_subadminimage($admin_id);
			if($image_name != 'default_user.jpg')
			{
				$path = './uploads/profiles/'.$image_name;
				unlink($path);
			}
			$this->db->where('admin_id', $admin_id);
			$this->db->delete("s_admin");

			$this->db->where('user_id', $admin_id);
			$this->db->delete("s_role_permission");

			$this->session->set_flashdata('success', 'Subadmin has been Successfully Deleted.');
			redirect('admin/subadmin-list');
		}
	}

	//update role permission
	public function role_permission(){
  		if(!empty($_POST)){
  			
  			$pids = $_POST['pids'];
  			$is_add = $_POST['is_add'];
  			$is_edit = $_POST['is_edit'];
  			$is_view = $_POST['is_view'];
  			$is_delete = $_POST['is_delete'];
  			$count = count($pids);
  			for ($i=0; $i < $count; $i++) { 
  				$params['is_add'] = $is_add[$i];
  				$params['is_edit'] = $is_edit[$i];
  				$params['is_view'] = $is_view[$i];
  				$params['is_delete'] = $is_delete[$i];
  				$pid = $pids[$i];
  				$this->db->update('s_role_permission', $params ,['role_permission_id' => $pid ] );
  			}
  			$this->session->set_flashdata('success', 'Permission has been changed successfully.');
  			redirect('admin/subadmin-list');
  		}
  		$data['page'] = 'subadmin/subadmin_role_permission';
		$this->load->view('admin/template',$data);
  	}
  	//end

  	public function subadmin_active_deactive_ajax()
  	{
  		$admin_id = $_REQUEST['admin_id'];
		$is_value = $_REQUEST['is_value'];
		if($is_value == '1')
		{
			$val = '0';
		}
		else
		{
			$val = '1';
		}
		$params = array(
			'is_active'=>$val,
		);
		$check = $this->subadminmodel->update_subadmin_by_id($admin_id,$params);
		if($check)
		{
			echo true;
		}
  	}
}

