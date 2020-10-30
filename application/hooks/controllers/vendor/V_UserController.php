<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_UserController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->v_vendormodel->not_logged_in();
		$this->load->model('vendor/V_UserModel','v_usermodel');
		$this->load->model('admin/UserModel','usermodel');
		$this->load->model('vendor/V_SubadminModel','v_subadminmodel');
    }

 	public function list_farmer()
 	{
 		$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_farmer/list_v_farmer';
		$this->load->view('vendor/template',$data);
	}

	public function farmer_profile()
	{
		$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_farmer/farmer_profile';
		$this->load->view('vendor/template',$data);
	}

	public function assign_farmer_to_subvendor()
	{
			$user_id = $_REQUEST['user_id'];
			$sub_vendor_id = $_REQUEST['sub_vendor'];
			$current_vendor_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];

			if($current_vendor_id == $sub_vendor_id){
				$assign_vendor_id = 0;
			}else{
				$assign_vendor_id = $_REQUEST['sub_vendor'];
			}
			
		    $params = array('assign_subvendor_id' => $assign_vendor_id);

			$updateData = array(
			   'vendor_id'=>$sub_vendor_id
			);
			$this->db->where('farmer_id', $user_id);
			$this->db->update('s_advisory_response', $updateData); 

			$this->db->where('farmer_id', $user_id);
			$this->db->update('s_advisory', $updateData); 


			$check = $this->v_usermodel->update_farmer($user_id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Farmer has been assigned to Subvendor Successfully..');
				redirect('vendor/farmer-list');
			}

	}

}

	