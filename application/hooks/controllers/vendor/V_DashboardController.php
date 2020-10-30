<?php defined('BASEPATH') OR exit('No direct script access allowed');
class V_DashboardController extends CI_Controller
{
	public function __construct()
    {
            parent::__construct();
			$this->v_vendormodel->not_logged_in();
    }

	public function index() 
	{
		$data['page'] = 'dashboard/dashboard_template';
		$data['page_title'] = 'Dashboard';
		$this->load->view('vendor/template', $data);
	}
}
