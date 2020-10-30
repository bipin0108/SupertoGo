<?php defined('BASEPATH') OR exit('No direct script access allowed');
class DashboardController extends MY_Controller
{
	public function __construct()
    {
            parent::__construct();
			$this->adminmodel->not_logged_in();
			$this->load->model('admin/DashboardModel','dashboardmodel');
    }

	public function index() 
	{
		$data['page'] = 'dashboard/dashboard_template';
		$data['page_title'] = 'Dashboard';
		$this->load->view('admin/template', $data);
	}

	
}
