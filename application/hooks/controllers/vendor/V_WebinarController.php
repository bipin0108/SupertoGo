<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_WebinarController extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->v_vendormodel->not_logged_in();
		$this->load->model('admin/WebinarModel','webinarmodel');
	}

	public function index()
    {
    	$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_webinar/list_v_webinar';
		$this->load->view('vendor/template',$data);
    }

     public function view_webinar()
    {
        $this->v_vendormodel->CSRFVerify();
        $id = $this->uri->segment(3);
        $data['webinar'] = $this->webinarmodel->get_webinar_by_id($id); 
        $data['page'] = 'v_webinar/view_v_webinar';
        $this->load->view('vendor/template',$data);
    }

//end    
}	