<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ScheduleController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/ScheduleModel','schedulemodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'schedule/list_schedule_light_soil';
		$this->load->view('admin/template',$data);
	}

	public function create_lightsoil_schedule($month)
	{
		$this->adminmodel->CSRFVerify();
		$data['month'] = $month;
		$data['page'] = 'schedule/add_schedule_light_soil';
		$this->load->view('admin/template',$data);
	}

 	public function add_lightsoil_schedule()
 	{
		$this->adminmodel->CSRFVerify();
 		$month = trim($_REQUEST['month']);
 		
 		$this->load->library('excel');

		if(isset($_FILES["schedule_file"]["name"]))
		{
			$path = $_FILES["schedule_file"]["tmp_name"];
			$objPHPExcel = PHPExcel_IOFactory::load($path);

		    //$data = array();
            $scheduledata = array();
			foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
			{
				$worksheetTitle = $worksheet->getTitle();
				if($worksheetTitle == $month)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=4; $row<=$highestRow; $row++)
					{
						if(!empty($worksheet->getCellByColumnAndRow(0,$row)->getValue()))
						{

							$s_data['month'] = $month;
							$s_data['en_stage'] = !empty($worksheet->getCellByColumnAndRow(0,$row)->getValue())?$worksheet->getCellByColumnAndRow(0,$row)->getValue():'';
							$s_data['mr_stage'] = !empty($worksheet->getCellByColumnAndRow(1,$row)->getValue())?$worksheet->getCellByColumnAndRow(1,$row)->getValue():'';
							$s_data['hi_stage'] = !empty($worksheet->getCellByColumnAndRow(2,$row)->getValue())?$worksheet->getCellByColumnAndRow(2,$row)->getValue():'';
							$s_data['s_day'] = !empty($worksheet->getCellByColumnAndRow(3,$row)->getValue())?$worksheet->getCellByColumnAndRow(3,$row)->getValue():'';
							$s_data['en_activity_type']= !empty($worksheet->getCellByColumnAndRow(4,$row)->getValue())?$worksheet->getCellByColumnAndRow(4,$row)->getValue():'';
							$s_data['mr_activity_type']= !empty($worksheet->getCellByColumnAndRow(5,$row)->getValue())?$worksheet->getCellByColumnAndRow(5,$row)->getValue():'';
							$s_data['hi_activity_type']= !empty($worksheet->getCellByColumnAndRow(6,$row)->getValue())?$worksheet->getCellByColumnAndRow(6,$row)->getValue():'';
							$s_data['en_problem_type']= !empty($worksheet->getCellByColumnAndRow(7,$row)->getValue())?$worksheet->getCellByColumnAndRow(7,$row)->getValue():'';
							$s_data['mr_problem_type']= !empty($worksheet->getCellByColumnAndRow(8,$row)->getValue())?$worksheet->getCellByColumnAndRow(8,$row)->getValue():'';
							$s_data['hi_problem_type']= !empty($worksheet->getCellByColumnAndRow(9,$row)->getValue())?$worksheet->getCellByColumnAndRow(9,$row)->getValue():'';
							$s_data['en_problem']= !empty($worksheet->getCellByColumnAndRow(10,$row)->getValue())?$worksheet->getCellByColumnAndRow(10,$row)->getValue():'';
							$s_data['mr_problem']= !empty($worksheet->getCellByColumnAndRow(11,$row)->getValue())?$worksheet->getCellByColumnAndRow(11,$row)->getValue():'';
							$s_data['hi_problem']= !empty($worksheet->getCellByColumnAndRow(12,$row)->getValue())?$worksheet->getCellByColumnAndRow(12,$row)->getValue():'';
							$s_data['en_technical_name']= !empty($worksheet->getCellByColumnAndRow(13,$row)->getValue())?$worksheet->getCellByColumnAndRow(13,$row)->getValue():'';
							$s_data['mr_technical_name']= !empty($worksheet->getCellByColumnAndRow(14,$row)->getValue())?$worksheet->getCellByColumnAndRow(14,$row)->getValue():'';
							$s_data['hi_technical_name']= !empty($worksheet->getCellByColumnAndRow(15,$row)->getValue())?$worksheet->getCellByColumnAndRow(15,$row)->getValue():'';
							$s_data['en_brand_name']= !empty($worksheet->getCellByColumnAndRow(16,$row)->getValue())?$worksheet->getCellByColumnAndRow(16,$row)->getValue():'';
							$s_data['mr_brand_name']= !empty($worksheet->getCellByColumnAndRow(17,$row)->getValue())?$worksheet->getCellByColumnAndRow(17,$row)->getValue():'';
							$s_data['hi_brand_name']= !empty($worksheet->getCellByColumnAndRow(18,$row)->getValue())?$worksheet->getCellByColumnAndRow(18,$row)->getValue():'';
							$s_data['en_qty']= !empty($worksheet->getCellByColumnAndRow(19,$row)->getValue())?$worksheet->getCellByColumnAndRow(19,$row)->getValue():'';
							$s_data['mr_qty']= !empty($worksheet->getCellByColumnAndRow(20,$row)->getValue())?$worksheet->getCellByColumnAndRow(20,$row)->getValue():'';
							$s_data['hi_qty']= !empty($worksheet->getCellByColumnAndRow(21,$row)->getValue())?$worksheet->getCellByColumnAndRow(21,$row)->getValue():'';
							$s_data['en_unit']= !empty($worksheet->getCellByColumnAndRow(22,$row)->getValue())?$worksheet->getCellByColumnAndRow(22,$row)->getValue():'';
							$s_data['mr_unit']= !empty($worksheet->getCellByColumnAndRow(23,$row)->getValue())?$worksheet->getCellByColumnAndRow(23,$row)->getValue():'';
							$s_data['hi_unit']= !empty($worksheet->getCellByColumnAndRow(24,$row)->getValue())?$worksheet->getCellByColumnAndRow(24,$row)->getValue():'';
							$s_data['en_per']= !empty($worksheet->getCellByColumnAndRow(25,$row)->getValue())?$worksheet->getCellByColumnAndRow(25,$row)->getValue():'';
							$s_data['mr_per']= !empty($worksheet->getCellByColumnAndRow(26,$row)->getValue())?$worksheet->getCellByColumnAndRow(26,$row)->getValue():'';
							$s_data['hi_per']= !empty($worksheet->getCellByColumnAndRow(27,$row)->getValue())?$worksheet->getCellByColumnAndRow(27,$row)->getValue():'';
							$s_data['en_remark']= !empty($worksheet->getCellByColumnAndRow(28,$row)->getValue())?$worksheet->getCellByColumnAndRow(28,$row)->getValue():'';
							$s_data['mr_remark']= !empty($worksheet->getCellByColumnAndRow(29,$row)->getValue())?$worksheet->getCellByColumnAndRow(29,$row)->getValue():'';
							$s_data['hi_remark']= !empty($worksheet->getCellByColumnAndRow(30,$row)->getValue())?$worksheet->getCellByColumnAndRow(30,$row)->getValue():'';

							array_push($scheduledata,$s_data);
						}
						
					}
					
					$this->schedulemodel->setBatch_lightsoil_schedule($scheduledata);
					$check = $this->schedulemodel->add_lightsoil_schedule();
					if($check)
					{
						$this->session->set_flashdata('success', 'Schedule has been added Successfully..');
						redirect('admin/light-soil-schedule-list');
					}	
				}
				else
				{
					$this->session->set_flashdata('error1', 'You have Not Sheet of "'.$month.'" Name!!');
					$data['month'] = $month;
					$data['page'] = 'schedule/add_schedule_light_soil';
					$this->load->view('admin/template',$data);
				}
			}
		}	
			
		$data['month'] = $month;
		$data['page'] = 'schedule/add_schedule_light_soil';
		$this->load->view('admin/template',$data);
  	}

  	
	public function edit_lightsoil_schedule()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'schedule/edit_schedule_light_soil';
		$data['schedule'] = $this->schedulemodel->get_lightsoil_schedule_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_lightsoil_schedule()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['schedule'] = $this->schedulemodel->get_lightsoil_schedule_by_id($id);
		
		$this->form_validation->set_rules('en_stage','Stage in English','required|trim');
		$this->form_validation->set_rules('hi_stage','Stage in Hindi','required|trim');
		$this->form_validation->set_rules('mr_stage','Stage in Marathi','required|trim');
		$this->form_validation->set_rules('s_day','Day','required|trim');

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_stage' => ucfirst($_REQUEST['en_stage']), 
				'hi_stage' => $_REQUEST['hi_stage'],
				'mr_stage' => $_REQUEST['mr_stage'], 
				's_day' => $_REQUEST['s_day'],
				'en_activity_type' => $_REQUEST['en_activity_type'],
				'hi_activity_type' => $_REQUEST['hi_activity_type'],
				'mr_activity_type' => $_REQUEST['mr_activity_type'],
				'en_problem_type' => $_REQUEST['en_problem_type'],
				'hi_problem_type' => $_REQUEST['hi_problem_type'],
				'mr_problem_type' => $_REQUEST['mr_problem_type'],
				'en_problem' => $_REQUEST['en_problem'],
				'hi_problem' => $_REQUEST['hi_problem'],
				'mr_problem' => $_REQUEST['mr_problem'],
				'en_technical_name' => $_REQUEST['en_technical_name'],
				'hi_technical_name' => $_REQUEST['hi_technical_name'],
				'mr_technical_name' => $_REQUEST['mr_technical_name'],
				'en_brand_name' => $_REQUEST['en_brand_name'],
				'hi_brand_name' => $_REQUEST['hi_brand_name'],
				'mr_brand_name' => $_REQUEST['mr_brand_name'],
				'en_qty' => $_REQUEST['en_qty'],
				'hi_qty' => $_REQUEST['hi_qty'],
				'mr_qty' => $_REQUEST['mr_qty'],
				'en_unit' => $_REQUEST['en_unit'],
				'hi_unit' => $_REQUEST['hi_unit'],
				'mr_unit' => $_REQUEST['mr_unit'],
				'en_per' => $_REQUEST['en_per'],
				'hi_per' => $_REQUEST['hi_per'],
				'mr_per' => $_REQUEST['mr_per'],
				'en_remark' => $_REQUEST['en_remark'],
				'hi_remark' => $_REQUEST['hi_remark'],
				'mr_remark' => $_REQUEST['mr_remark'],
			);

			$check = $this->schedulemodel->update_lightsoil_schedule($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Schedule has been updated Successfully..');
				redirect('admin/light-soil-schedule-list');
			}
		}
		$data['page'] = 'schedule/edit_schedule_light_soil';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_lightsoil_schedule()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['month']))
		{
			$month = $_REQUEST['month'];
			$this->db->where('month', $month);
			$this->db->delete("s_light_soil_schedule");
			$this->session->set_flashdata('success', 'Schedule has been Successfully Deleted.');
			redirect('admin/light-soil-schedule-list');
		}
	}

	public function medheavysoil_schedule_list()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'schedule/list_schedule_medheavy_soil';
		$this->load->view('admin/template',$data);
	}

	public function create_medheavysoil_schedule($month)
	{
		$this->adminmodel->CSRFVerify();
		$data['month'] = $month;
		$data['page'] = 'schedule/add_schedule_medheavy_soil';
		$this->load->view('admin/template',$data);
	}

	public function add_medheavysoil_schedule()
	{
		$this->adminmodel->CSRFVerify();
 		$month = trim($_REQUEST['month']);
 		
		$this->load->library('excel');
		if(isset($_FILES["schedule_file"]["name"]))
		{
			$path = $_FILES["schedule_file"]["tmp_name"];
			$objPHPExcel = PHPExcel_IOFactory::load($path);

            //$data = array();
            $scheduledata = array();
			foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
			{
				$worksheetTitle = $worksheet->getTitle();
				if($worksheetTitle == $month)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=4; $row<=$highestRow; $row++)
					{
						if(!empty($worksheet->getCellByColumnAndRow(0, $row)->getValue()))
						{
							$s_data['month'] = $month;
							$s_data['en_stage'] = !empty($worksheet->getCellByColumnAndRow(0,$row)->getValue())?$worksheet->getCellByColumnAndRow(0,$row)->getValue():'';
							$s_data['mr_stage'] = !empty($worksheet->getCellByColumnAndRow(1,$row)->getValue())?$worksheet->getCellByColumnAndRow(1,$row)->getValue():'';
							$s_data['hi_stage'] = !empty($worksheet->getCellByColumnAndRow(2,$row)->getValue())?$worksheet->getCellByColumnAndRow(2,$row)->getValue():'';
							$s_data['s_day'] = !empty($worksheet->getCellByColumnAndRow(3,$row)->getValue())?$worksheet->getCellByColumnAndRow(3,$row)->getValue():'';
							$s_data['en_activity_type']= !empty($worksheet->getCellByColumnAndRow(4,$row)->getValue())?$worksheet->getCellByColumnAndRow(4,$row)->getValue():'';
							$s_data['mr_activity_type']= !empty($worksheet->getCellByColumnAndRow(5,$row)->getValue())?$worksheet->getCellByColumnAndRow(5,$row)->getValue():'';
							$s_data['hi_activity_type']= !empty($worksheet->getCellByColumnAndRow(6,$row)->getValue())?$worksheet->getCellByColumnAndRow(6,$row)->getValue():'';
							$s_data['en_problem_type']= !empty($worksheet->getCellByColumnAndRow(7,$row)->getValue())?$worksheet->getCellByColumnAndRow(7,$row)->getValue():'';
							$s_data['mr_problem_type']= !empty($worksheet->getCellByColumnAndRow(8,$row)->getValue())?$worksheet->getCellByColumnAndRow(8,$row)->getValue():'';
							$s_data['hi_problem_type']= !empty($worksheet->getCellByColumnAndRow(9,$row)->getValue())?$worksheet->getCellByColumnAndRow(9,$row)->getValue():'';
							$s_data['en_problem']= !empty($worksheet->getCellByColumnAndRow(10,$row)->getValue())?$worksheet->getCellByColumnAndRow(10,$row)->getValue():'';
							$s_data['mr_problem']= !empty($worksheet->getCellByColumnAndRow(11,$row)->getValue())?$worksheet->getCellByColumnAndRow(11,$row)->getValue():'';
							$s_data['hi_problem']= !empty($worksheet->getCellByColumnAndRow(12,$row)->getValue())?$worksheet->getCellByColumnAndRow(12,$row)->getValue():'';
							$s_data['en_technical_name']= !empty($worksheet->getCellByColumnAndRow(13,$row)->getValue())?$worksheet->getCellByColumnAndRow(13,$row)->getValue():'';
							$s_data['mr_technical_name']= !empty($worksheet->getCellByColumnAndRow(14,$row)->getValue())?$worksheet->getCellByColumnAndRow(14,$row)->getValue():'';
							$s_data['hi_technical_name']= !empty($worksheet->getCellByColumnAndRow(15,$row)->getValue())?$worksheet->getCellByColumnAndRow(15,$row)->getValue():'';
							$s_data['en_brand_name']= !empty($worksheet->getCellByColumnAndRow(16,$row)->getValue())?$worksheet->getCellByColumnAndRow(16,$row)->getValue():'';
							$s_data['mr_brand_name']= !empty($worksheet->getCellByColumnAndRow(17,$row)->getValue())?$worksheet->getCellByColumnAndRow(17,$row)->getValue():'';
							$s_data['hi_brand_name']= !empty($worksheet->getCellByColumnAndRow(18,$row)->getValue())?$worksheet->getCellByColumnAndRow(18,$row)->getValue():'';
							$s_data['en_qty']= !empty($worksheet->getCellByColumnAndRow(19,$row)->getValue())?$worksheet->getCellByColumnAndRow(19,$row)->getValue():'';
							$s_data['mr_qty']= !empty($worksheet->getCellByColumnAndRow(20,$row)->getValue())?$worksheet->getCellByColumnAndRow(20,$row)->getValue():'';
							$s_data['hi_qty']= !empty($worksheet->getCellByColumnAndRow(21,$row)->getValue())?$worksheet->getCellByColumnAndRow(21,$row)->getValue():'';
							$s_data['en_unit']= !empty($worksheet->getCellByColumnAndRow(22,$row)->getValue())?$worksheet->getCellByColumnAndRow(22,$row)->getValue():'';
							$s_data['mr_unit']= !empty($worksheet->getCellByColumnAndRow(23,$row)->getValue())?$worksheet->getCellByColumnAndRow(23,$row)->getValue():'';
							$s_data['hi_unit']= !empty($worksheet->getCellByColumnAndRow(24,$row)->getValue())?$worksheet->getCellByColumnAndRow(24,$row)->getValue():'';
							$s_data['en_per']= !empty($worksheet->getCellByColumnAndRow(25,$row)->getValue())?$worksheet->getCellByColumnAndRow(25,$row)->getValue():'';
							$s_data['mr_per']= !empty($worksheet->getCellByColumnAndRow(26,$row)->getValue())?$worksheet->getCellByColumnAndRow(26,$row)->getValue():'';
							$s_data['hi_per']= !empty($worksheet->getCellByColumnAndRow(27,$row)->getValue())?$worksheet->getCellByColumnAndRow(27,$row)->getValue():'';
							$s_data['en_remark']= !empty($worksheet->getCellByColumnAndRow(28,$row)->getValue())?$worksheet->getCellByColumnAndRow(28,$row)->getValue():'';
							$s_data['mr_remark']= !empty($worksheet->getCellByColumnAndRow(29,$row)->getValue())?$worksheet->getCellByColumnAndRow(29,$row)->getValue():'';
							$s_data['hi_remark']= !empty($worksheet->getCellByColumnAndRow(30,$row)->getValue())?$worksheet->getCellByColumnAndRow(30,$row)->getValue():'';

							array_push($scheduledata,$s_data);
						}

						
					}	
				}
			}
			$this->schedulemodel->setBatch_medheavysoil_schedule($scheduledata);
			$check = $this->schedulemodel->add_medheavysoil_schedule();
			if($check)
			{
				$this->session->set_flashdata('success', 'Schedule has been added Successfully..');
				redirect('admin/medheavy-soil-schedule-list');
			}
		}	
		$data['month'] = $month;
		$data['page'] = 'schedule/add_schedule_medheavy_soil';
		$this->load->view('admin/template',$data);
	}

	public function edit_medheavysoil_schedule()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'schedule/edit_schedule_medheavy_soil';
		$data['schedule'] = $this->schedulemodel->get_medheavysoil_schedule_by_id($id); 
		$this->load->view('admin/template',$data);
	}

	public function update_medheavysoil_schedule()
	{
		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['schedule'] = $this->schedulemodel->get_medheavysoil_schedule_by_id($id);
		
		$this->form_validation->set_rules('en_stage','Stage in English','required|trim');
		$this->form_validation->set_rules('hi_stage','Stage in Hindi','required|trim');
		$this->form_validation->set_rules('mr_stage','Stage in Marathi','required|trim');
		$this->form_validation->set_rules('s_day','Day','required|trim');

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_stage' => ucfirst($_REQUEST['en_stage']), 
				'hi_stage' => $_REQUEST['hi_stage'],
				'mr_stage' => $_REQUEST['mr_stage'], 
				's_day' => $_REQUEST['s_day'],
				'en_activity_type' => $_REQUEST['en_activity_type'],
				'hi_activity_type' => $_REQUEST['hi_activity_type'],
				'mr_activity_type' => $_REQUEST['mr_activity_type'],
				'en_problem_type' => $_REQUEST['en_problem_type'],
				'hi_problem_type' => $_REQUEST['hi_problem_type'],
				'mr_problem_type' => $_REQUEST['mr_problem_type'],
				'en_problem' => $_REQUEST['en_problem'],
				'hi_problem' => $_REQUEST['hi_problem'],
				'mr_problem' => $_REQUEST['mr_problem'],
				'en_technical_name' => $_REQUEST['en_technical_name'],
				'hi_technical_name' => $_REQUEST['hi_technical_name'],
				'mr_technical_name' => $_REQUEST['mr_technical_name'],
				'en_brand_name' => $_REQUEST['en_brand_name'],
				'hi_brand_name' => $_REQUEST['hi_brand_name'],
				'mr_brand_name' => $_REQUEST['mr_brand_name'],
				'en_qty' => $_REQUEST['en_qty'],
				'hi_qty' => $_REQUEST['hi_qty'],
				'mr_qty' => $_REQUEST['mr_qty'],
				'en_unit' => $_REQUEST['en_unit'],
				'hi_unit' => $_REQUEST['hi_unit'],
				'mr_unit' => $_REQUEST['mr_unit'],
				'en_per' => $_REQUEST['en_per'],
				'hi_per' => $_REQUEST['hi_per'],
				'mr_per' => $_REQUEST['mr_per'],
				'en_remark' => $_REQUEST['en_remark'],
				'hi_remark' => $_REQUEST['hi_remark'],
				'mr_remark' => $_REQUEST['mr_remark'],
			);

			$check = $this->schedulemodel->update_medheavysoil_schedule($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Schedule has been updated Successfully..');
				redirect('admin/medheavy-soil-schedule-list');
			}
		}
		$data['page'] = 'schedule/edit_schedule_medheavy_soil';
		$this->load->view('admin/template',$data);
	}

	public function trash_medheavysoil_schedule()
	{
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['month']))
		{
			$month = $_REQUEST['month'];
			$this->db->where('month', $month);
			$this->db->delete("s_medheavy_soil_schedule");
			$this->session->set_flashdata('success', 'Schedule has been Successfully Deleted.');
			redirect('admin/medheavy-soil-schedule-list');
		}
	}

	

}

