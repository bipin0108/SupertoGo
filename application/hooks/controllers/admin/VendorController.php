<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class VendorController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/VendorModel','vendormodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'vendor/list_vendor';
		$this->load->view('admin/template',$data);
	}

	public function create_vendor()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'vendor/add_vendor';
		$this->load->view('admin/template',$data);
	}

	public function randomPassword() {
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 9; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

	public function generate_referralcode($pre)
	{
		$promocode = $pre.$this->randomPassword();
		$this->db->where("promocode",$promocode);
		$query = $this->db->get('s_vendor');
		if($query->num_rows() > 0){
			$this->generate_referralcode();
		}else{
			return $promocode;
		}
	}

 	public function add_vendor()
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
				//'promocode'=> $this->generate_referralcode('V'),
				'promocode'=> 'V'.$_REQUEST['mobile'],
				'password' => $_REQUEST['password'], 
				'mobile' => $_REQUEST['mobile'], 
				'role_id' => '0', 
				'address' => $_REQUEST['address'], 
				'pincode' => $_REQUEST['pincode'], 
				'village' => $_REQUEST['village'], 
				'district' => $_REQUEST['district'],
				'city' => ucfirst($_REQUEST['city']), 
				'state' => ucfirst($_REQUEST['state']), 
				'profile_image' => '',
				'type' => 'vendor',
				'created_by' => '0',
			);
			
			$insert_id = $this->vendormodel->add_vendor($params);
			if(isset($insert_id))
			{
				$this->db->select('*');
				$query = $this->db->get('s_permission_vendor');
				$vendor_permission = $query->result();
				foreach($vendor_permission as $row)
				{
					$permission_param = array(
						'user_id' => $insert_id, 
						'permission_id' => $row->permission_id, 
						'is_add' => 1,
						'is_edit' => 1,
						'is_view' => 1,
						'is_delete' => 1,
					);
					$this->db->set($permission_param);
    				$this->db->insert('s_role_permission_vendor');
				}
				$this->session->set_flashdata('success', 'Vendor has been added Successfully..');
				redirect('admin/vendor-list');
			}
		}
		$data['page'] = 'vendor/add_vendor';
		$this->load->view('admin/template',$data);
  	}

	public function edit_vendor()
	{
		$this->adminmodel->CSRFVerify();
		$vendor_id = $this->uri->segment(3);
		$data['page'] = 'vendor/edit_vendor';
		$data['vendor'] = $this->vendormodel->get_vendor_by_id($vendor_id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_vendor()
  	{
  		$this->adminmodel->CSRFVerify();
  		$vendor_id = $_REQUEST['vendor_id'];
  		$data['vendor'] = $this->vendormodel->get_vendor_by_id($vendor_id); 


		$this->form_validation->set_rules('name','Name','required|trim');
		
	    if($_REQUEST['email'] !=$data['vendor']['email']) {
	       $is_unique =  '|is_unique[s_admin.email]';
	    } else {
	       $is_unique =  '';
	    }
		$this->form_validation->set_rules('email','Email','required|trim|valid_email'.$is_unique);
		$this->form_validation->set_rules('password','Password','required|trim');
		
	    if($_REQUEST['mobile'] != $data['vendor']['mobile']) {
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
			
			$check = $this->vendormodel->update_vendor_by_id($vendor_id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Vendor has been updated Successfully..');
				redirect('admin/vendor-list');
			}
		}
		$data['page'] = 'vendor/edit_vendor';
		$this->load->view('admin/template',$data);
  	}

  	public function trash_vendor()
  	{
  		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['vendor_id']))
		{
			$vendor_id = $_REQUEST['vendor_id'];
			
			$this->db->where('user_id', $vendor_id);
            $this->db->delete("s_role_permission_vendor");			

			$this->db->where('vendor_id', $vendor_id);
            $this->db->delete("s_vendor");

			//$check = $this->vendormodel->update_vendor_by_id($vendor_id,$params);
			$this->session->set_flashdata('success', 'Vendor has been deleted Successfully..');
			redirect('admin/vendor-list');
		}
  	}
  	
	public function vendor_active_deactive_ajax()
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
		$check = $this->vendormodel->update_vendor_by_id($vendor_id,$params);
		if($check)
		{
			echo true;
		}
  	}
}

