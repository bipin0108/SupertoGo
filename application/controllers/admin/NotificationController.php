<?php defined('BASEPATH') OR exit('No direct script access allowed');
class NotificationController extends MY_Controller
{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->adminmodel->CSRFVerify();
		$this->load->model('admin/NotificationModel', 'notificationmodel');
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('notification',$site_lang); 
    }

    // User
 	public function index(){
 		$data['page'] = 'notification/user_list';
		$this->load->view('admin/template',$data);
	}
	public function user_list_ajax(){
		$list = $this->notificationmodel->user_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();
			$row[] = $orders->user_id;
			$row[] = $orders->name;
			$row[] = $orders->email; 
			$row[] = $orders->mobile; 
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->notificationmodel->user_count_all(),
			"recordsFiltered" => $this->notificationmodel->user_count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
		exit;
	}

	public function send_notification(){
		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('id[]',lang('User'),'required|trim');
		$this->form_validation->set_rules('msg',lang('Message'),'required|trim');
		$this->form_validation->set_message('required', lang('form_validation_required'));
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	

			$ids = $_POST['id'];
			$msg = $_POST['msg'];
			$action = $_POST['action'];
			if($action == 'user'){
				$user = $this->m_general->getRow("SELECT GROUP_CONCAT(device_token) device_token FROM tbl_users WHERE user_id IN ?",array($ids));
				$path = "admin/notification-user-list";
			}else{
				$user = $this->m_general->getRow("SELECT GROUP_CONCAT(device_token) device_token FROM tbl_users WHERE db_id IN ?",array($ids));
				$path = "admin/notification-delivery-boy-list";
			}
			
			$device_token = '"'.implode('","', explode(',', $user['device_token'])).'"'; 

			$msg = array(
			    "title"=>"SupertoGo",
			    "body"=>$msg,
			);
			
			$result = $this->push_notification($device_token, $msg); 
			$this->session->set_flashdata('success', lang('add_success'));
			redirect($path);
		}
		$data['page'] = 'notification/user_list'; 
		$this->load->view('admin/template',$data);
	}


	// Delivery Boy
 	public function delivery_boy_list(){
 		$data['page'] = 'notification/delivery_boy_list';
		$this->load->view('admin/template',$data);
	}
	public function delivery_boy_list_ajax(){
		$list = $this->notificationmodel->delivery_boy_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();
			$row[] = $orders->db_id;
			$row[] = $orders->name;
			$row[] = $orders->email; 
			$row[] = $orders->mobile; 
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->notificationmodel->delivery_boy_count_all(),
			"recordsFiltered" => $this->notificationmodel->delivery_boy_count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
		exit;
	}

}

