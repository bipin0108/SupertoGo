<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_SubadminController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->v_vendormodel->not_logged_in();
		$this->load->model('vendor/V_SubadminModel','v_subadminmodel');
    }

 	public function index()
 	{
 		$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_subadmin/list_v_subadmin';
		$this->load->view('vendor/template',$data);
	}

	public function create_vendor_subadmin()
	{
		$this->v_vendormodel->CSRFVerify();
		$data['page'] = 'v_subadmin/add_v_subadmin';
		$this->load->view('vendor/template',$data);
	}

 	public function add_vendor_subadmin()
 	{
 		$this->v_vendormodel->CSRFVerify();
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|is_unique[s_vendor.email]|valid_email');
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
				'role_id' => '1', 
				'address' => $_REQUEST['address'], 
				'pincode' => $_REQUEST['pincode'], 
				'village' => $_REQUEST['village'], 
				'district' => $_REQUEST['district'], 
				'city' => $_REQUEST['city'], 
				'state' => $_REQUEST['state'], 
				'type' => 'subadmin',
				'profile_image' => '',
				'created_by' => $this->session->userdata[SESSION_VENDOR]['vendor_id'],
			);
			
			$insert_id = $this->v_subadminmodel->add_vendor_subadmin($params);
			if(isset($insert_id))
			{
				$this->db->select('*');
				$query = $this->db->get('s_permission_vendor');
				$permission = $query->result();
				foreach($permission as $row)
				{
					$permission_param = array(
						'user_id' => $insert_id, 
						'permission_id' => $row->permission_id, 
					);
					$this->db->set($permission_param);
    				$this->db->insert('s_role_permission_vendor');
				}
				$this->session->set_flashdata('success', 'Subadmin has been added Successfully..');
				redirect('vendor/vendor-subadmin-list');
			}
		}
		$data['page'] = 'v_subadmin/add_v_subadmin';
		$this->load->view('vendor/template',$data);
  	}

	public function edit_vendor_subadmin()
	{
		$this->v_vendormodel->CSRFVerify();
		$subadmin_id = $this->uri->segment(3);
		$data['page'] = 'v_subadmin/edit_v_subadmin';
		$data['subadmin'] = $this->v_subadminmodel->get_vendor_subadmin_by_id($subadmin_id); 
		$this->load->view('vendor/template',$data);
  	}

  	public function update_vendor_subadmin()
  	{
  		$this->v_vendormodel->CSRFVerify();
  		$vendor_id = $_REQUEST['vendor_id'];
  		$data['subadmin'] = $this->v_subadminmodel->get_vendor_subadmin_by_id($vendor_id); 


		$this->form_validation->set_rules('name','Name','required|trim');
		
	    if($_REQUEST['email'] != $data['subadmin']['email']) {
	       $is_unique =  '|is_unique[s_vendor.email]';
	    } else {
	       $is_unique =  '';
	    }

		$this->form_validation->set_rules('email','Email','required|trim|valid_email'.$is_unique);
		$this->form_validation->set_rules('password','Password','required|trim');

		if($_REQUEST['mobile'] != $data['subadmin']['mobile']) {
	       $m_is_unique =  '|is_unique[s_vendor.mobile]';
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
			
			$check = $this->v_subadminmodel->update_vendor_subadmin_by_id($vendor_id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Subadmin has been updated Successfully..');
				redirect('vendor/vendor-subadmin-list');
			}
		}
		$data['page'] = 'v_subadmin/edit_v_subadmin';
		$this->load->view('vendor/template',$data);
  	}
  	
	public function trash_vendor_subadmin()
	{ 
		$this->v_vendormodel->CSRFVerify();
		if(!empty($_REQUEST['vendor_id']))
		{
			$vendor_id = $_REQUEST['vendor_id'];
			$image_name = $this->v_subadminmodel->get_vendor_subadminimage($vendor_id);
			if($image_name != 'default_user.jpg')
			{
				$path = './uploads/vendor_profiles/'.$image_name;
				unlink($path);
			}
			$this->db->where('vendor_id', $vendor_id);
			$this->db->delete("s_vendor");

			$this->db->where('user_id', $vendor_id);
			$this->db->delete("s_role_permission_vendor");

			$this->session->set_flashdata('success', 'Subadmin has been Successfully Deleted.');
			redirect('vendor/vendor-subadmin-list');
		}
	}

	//update role permission
	public function vendor_role_permission(){
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
  				$this->db->update('s_role_permission_vendor', $params ,['role_permission_id' => $pid ] );
  			}
  			$this->session->set_flashdata('success', 'Permission has been changed successfully.');
  			redirect('vendor/vendor-subadmin-list');
  		}
  		$data['page'] = 'v_subadmin/v_subadmin_role_permission';
		$this->load->view('vendor/template',$data);
  	}
  	//end

  	public function vendor_subadmin_active_deactive_ajax()
  	{
  		$vendor_id = $_REQUEST['vendor_id'];
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
		$check = $this->v_subadminmodel->update_vendor_subadmin_by_id($vendor_id,$params);
		if($check)
		{
			echo true;
		}
  	}
}

