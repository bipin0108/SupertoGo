<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/UserModel','usermodel');
		$this->load->model('vendor/V_AdvisoryModel','v_advisorymodel');
    }

 	public function list_farmer()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/list_farmer';
		$this->load->view('admin/template',$data);
	}

	public function farmer_profile()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/farmer_profile';
		$this->load->view('admin/template',$data);
	}

	public function view_advisory_request()
	{
		$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'user/view_advisory';
		$this->load->view('admin/template',$data);
	}

	public function buyer_list()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/list_buyer';
		$this->load->view('admin/template',$data);	
	}

	public function buyer_crop_rate_list()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/list_buyer_rate';
		$this->load->view('admin/template',$data);	
	}

	public function subscription_payment_history()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'user/subscript_pay_history';
		$this->load->view('admin/template',$data);
	}

//end
}

	