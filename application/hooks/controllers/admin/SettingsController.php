<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SettingsController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
		$data['page'] = 'settings/smartcrop_setting';
		$this->load->view('admin/template',$data);
	}

	public function update_settings()
	{
		$this->adminmodel->CSRFVerify();
		$query = $this->db->get('s_settings');
		$data['settings'] = $query->result(); 

		$this->form_validation->set_rules('fcm_api_key','FCM api Key','required');
		$this->form_validation->set_rules('msg91_senderid','SMS Sender ID','required');
		$this->form_validation->set_rules('msg91_authkey','SMS Auth Key','required');
		$this->form_validation->set_rules('plot_subscription_price','Plot Activation Fee','required|numeric');
		$this->form_validation->set_rules('buyer_subscription_price','Buyer Subscription Fee','required|numeric');
		
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)
		{  
			//error
		}
		else
		{
			$this->mastermodel->setSetting("fcm_api_key",$_REQUEST['fcm_api_key']);
			$this->mastermodel->setSetting("msg91_senderid",$_REQUEST['msg91_senderid']);
			$this->mastermodel->setSetting("msg91_authkey",$_REQUEST['msg91_authkey']);
			$this->mastermodel->setSetting("plot_subscription_price",$_REQUEST['plot_subscription_price']);
			$this->mastermodel->setSetting("buyer_subscription_price",$_REQUEST['buyer_subscription_price']);
			
			$this->session->set_flashdata('success', 'Setting has been changed Successfully.');
			redirect('admin/settings');
		}
		
		$data['page'] = 'settings/smartcrop_setting';
		$this->load->view('admin/template',$data);
	}

}

