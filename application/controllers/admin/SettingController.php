<?php defined('BASEPATH') OR exit('No direct script access allowed');
class SettingController extends MY_Controller{
 	public function __construct() {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('setting',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
		$data['page'] = 'setting/setting';
		$this->load->view('admin/template',$data);
	}

	public function update_setting()
	{
		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('delivery_charge',lang('Delivery Charge'),'required|numeric'); 
		$this->form_validation->set_rules('currency',lang('Currency'),'required|trim'); 
		$this->form_validation->set_rules('min_cart_price',lang('Min Cart Price'),'required|numeric'); 
		$this->form_validation->set_rules('android_version_user',lang('Android Version User'),'required|numeric'); 
		$this->form_validation->set_rules('ios_version_user',lang('IOS Version User'),'required|numeric'); 
		$this->form_validation->set_rules('android_version_driver',lang('Android Version Driver'),'required|numeric'); 
		$this->form_validation->set_rules('ios_version_driver',lang('IOS Version Driver'),'required|numeric');
		$this->form_validation->set_rules('stripe_pk_test',lang('Test Publish Key'),'required|trim');
		$this->form_validation->set_rules('stripe_sk_test',lang('Test Secret Key'),'required|trim');
		$this->form_validation->set_rules('stripe_pk_live',lang('Live Publish Key'),'required|trim');
		$this->form_validation->set_rules('stripe_sk_live',lang('Live Secret Key'),'required|trim');
		$this->form_validation->set_rules('is_stripe',lang('Is Stripe'),'required|trim');

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('numeric', lang('form_validation_alpha_numeric'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//error
		}else{
			$this->m_general->setSetting("delivery_charge",$_REQUEST['delivery_charge']);
			$this->m_general->setSetting("currency",$_REQUEST['currency']);
			$this->m_general->setSetting("min_cart_price",$_REQUEST['min_cart_price']);
			$this->m_general->setSetting("emergency_message",$_REQUEST['emergency_message']);
			$this->m_general->setSetting("android_version_user",$_REQUEST['android_version_user']);
			$this->m_general->setSetting("ios_version_user",$_REQUEST['ios_version_user']);
			$this->m_general->setSetting("android_version_driver",$_REQUEST['android_version_driver']);
			$this->m_general->setSetting("ios_version_driver",$_REQUEST['ios_version_driver']);
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/setting');
		}
		
		$data['page'] = 'setting/setting';
		$this->load->view('admin/template',$data);
	}


//end
}

