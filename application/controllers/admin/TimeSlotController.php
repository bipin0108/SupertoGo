<?php defined('BASEPATH') OR exit('No direct script access allowed');
class TimeSlotController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('time_slot',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'time_slot/list'; 
 		$date = date("Y-m-d", strtotime("-1 day"));
 		
 		$data['time_slot'] = $this->m_general->getRows("SELECT * FROM tbl_time_slot WHERE slot_date > ? ORDER BY slot_date DESC",array($date)); 
		$this->load->view('admin/template',$data);
	}

	public function create_time_slot(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'time_slot/add';
		$this->load->view('admin/template',$data);
	}

 	public function add_time_slot(){
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('slot_date',lang('Slot Date'),'required');
		$this->form_validation->set_message('required', lang('form_validation_required')); 
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	

			$from_hour = $_REQUEST['from_hour'];
			$from_min = $_REQUEST['from_min'];
			$before_midday = $_REQUEST['before_midday'];
			$to_hour = $_REQUEST['to_hour'];
			$to_min = $_REQUEST['to_min'];
			$after_midday = $_REQUEST['after_midday'];
			
			$dates = $_REQUEST['slot_date'];
			$dates = explode(',', $dates);

			$count = count($from_hour);

			foreach ($dates as $date) {
				for ($i=0; $i < $count ; $i++) { 
					$full_time = $from_hour[$i].":".$from_min[$i].' '.$before_midday[$i].' to '.$to_hour[$i].":".$to_min[$i].' '.$after_midday[$i];
					if(!empty($from_hour[$i])){
						$params = array(
							'slot_date' => date('Y-m-d',strtotime($date)),
							'from_hour' => $from_hour[$i],
							'from_min' => $from_min[$i],
							'before_midday' => $before_midday[$i],
							'to_hour' => $to_hour[$i],
							'to_min' =>  $to_min[$i],
							'after_midday' => $after_midday[$i],
							'full_time' => $full_time,
						);
						$slot_id = $this->m_general->insertRow('tbl_time_slot',$params);
					}
				}
				
			}
		
			$this->session->set_flashdata('success', lang('add_success'));
			redirect('admin/time-slot-list');
			
		}
		$data['page'] = 'time_slot/add';
		$this->load->view('admin/template',$data);
  	}

	public function trash_time_slot(){ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$slot_id = $_REQUEST['id'];
			$this->m_general->deleteRows('tbl_time_slot',array('slot_id'=>$slot_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/time-slot-list');
		}
	}
}



