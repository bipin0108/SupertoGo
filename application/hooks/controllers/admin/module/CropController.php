<?php defined('BASEPATH') OR exit('No direct script access allowed');
class CropController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/module/CropModel','cropmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'module/crop/list_crop';
		$this->load->view('admin/template',$data);
	}

	public function create_crop()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'module/crop/add_crop';
		$this->load->view('admin/template',$data);
	}

 	public function add_crop()
 	{
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_crop_name','Crop Name in English','required|trim|is_unique[s_crops.en_crop_name]');
		$this->form_validation->set_rules('mr_crop_name','Crop Name in Marathi','required|trim|is_unique[s_crops.mr_crop_name]');
		$this->form_validation->set_rules('hi_crop_name','Crop Name in Hindi','required|trim|is_unique[s_crops.hi_crop_name]');
		
		
		if (empty($_FILES['crop_image']['name'])){
			$this->form_validation->set_rules('crop_image','Crop Image','required');
		}
		//mandi grade
		if(!empty($_REQUEST['mandi_val'])){
			$mandi_arr = explode(',',$_REQUEST['mandi_val']);
			foreach ($mandi_arr as $idx => $mandi){
				if(!empty($_REQUEST['en_mgrade_'.$idx])){
					$this->form_validation->set_rules('hi_mgrade_'.$idx,'Grade in Hindi','required|trim');
					$this->form_validation->set_rules('mr_mgrade_'.$idx,'Grade in Marathi','required|trim');
					$this->form_validation->set_rules('en_mspeci_'.$idx,'Specification in Marathi','required|trim');
					$this->form_validation->set_rules('hi_mspeci_'.$idx,'Specification in Marathi','required|trim');
					$this->form_validation->set_rules('mr_mspeci_'.$idx,'Specification in Marathi','required|trim');
				}
			}
		}
		//farm grade
		if(!empty($_REQUEST['farm_val'])){
			$mandi_arr = explode(',',$_REQUEST['farm_val']);
			foreach ($mandi_arr as $idx => $mandi){
				if(!empty($_REQUEST['en_fspeci_'.$idx])){
					$this->form_validation->set_rules('hi_fspeci_'.$idx,'Specification in Marathi','required|trim');
					$this->form_validation->set_rules('mr_fspeci_'.$idx,'Specification in Marathi','required|trim');
				}
			}
		}

		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_crop_name' => ucfirst($_REQUEST['en_crop_name']), 
				'mr_crop_name' => $_REQUEST['mr_crop_name'], 
				'hi_crop_name' => $_REQUEST['hi_crop_name'], 
			);
			if (!empty($_FILES['crop_image']['name']))
			{

				if (!is_dir('./uploads/crop/')) {
					mkdir('./uploads/crop/', 0777, TRUE);
				}

			    $config['upload_path']   = './uploads/crop/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$new_name = rand().'_'.str_replace(' ', '', $_FILES["crop_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('crop_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$img_file = $this->upload->data(); 
					$params['crop_image'] = $new_name;

					$configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  $img_file['full_path'],
		              'maintain_ratio'  =>  false,
		              'width'           =>  250,
		              'height'          =>  250,
		            );
		            $this->load->library('image_lib', $configer); 
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();
				}
			}
			
			$crop_id = $this->cropmodel->add_crop($params);
			if($crop_id)
			{
				if(!empty($_REQUEST['mandi_val']))
				{
					$mandi_arr = explode(',',$_REQUEST['mandi_val']);
					foreach ($mandi_arr as $val) {
						if($_REQUEST['en_mgrade_'.$val])
						$mandi_param = array(
							'crop_id' => $crop_id, 
							'en_grade' => $_REQUEST['en_mgrade_'.$val],
							'hi_grade' => $_REQUEST['hi_mgrade_'.$val],
							'mr_grade' => $_REQUEST['mr_mgrade_'.$val],
							'en_specification' => $_REQUEST['en_mspeci_'.$val],
							'hi_specification' => $_REQUEST['hi_mspeci_'.$val],
							'mr_specification' => $_REQUEST['mr_mspeci_'.$val],
						);
						$this->cropmodel->add_crop_mandi_rate($mandi_param);
					}	
				}
					
				if(!empty($_REQUEST['farm_val']))
				{
					$farm_arr = explode(',',$_REQUEST['farm_val']);
					foreach ($farm_arr as $val) {
						$farm_param = array(
							'crop_id' => $crop_id, 
							'en_specification' => $_REQUEST['en_fspeci_'.$val],
							'hi_specification' => $_REQUEST['hi_fspeci_'.$val],
							'mr_specification' => $_REQUEST['mr_fspeci_'.$val],
						);
						
						$this->cropmodel->add_crop_farm_rate($farm_param);
					}	
				}	
				$this->session->set_flashdata('success', 'Crop has been added Successfully..');
				redirect('admin/crop-list');
			}
		}
		$data['page'] = 'module/crop/add_crop';
		$this->load->view('admin/template',$data);
  	}

	public function edit_crop()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'module/crop/edit_crop';
		$data['crop'] = $this->cropmodel->get_crop_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_crop()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];

		$data['crop'] = $this->cropmodel->get_crop_by_id($id); 
	    if($_REQUEST['en_crop_name'] != $data['crop']['en_crop_name']) {
	       $is_unique =  '|is_unique[s_crops.en_crop_name]';
	    } else {
	       $is_unique =  '';
	    }
		$this->form_validation->set_rules('en_crop_name','Crop Name in English','required|trim'.$is_unique);

		if($_REQUEST['hi_crop_name'] != $data['crop']['hi_crop_name']) {
	       $is_unique3 =  '|is_unique[s_crops.hi_crop_name]';
	    } else {
	       $is_unique3 =  '';
	    }
		$this->form_validation->set_rules('hi_crop_name','Crop Name in Hindi','required|trim'.$is_unique2);

		if($_REQUEST['mr_crop_name'] != $data['crop']['mr_crop_name']) {
	       $is_unique2 =  '|is_unique[s_crops.mr_crop_name]';
	    } else {
	       $is_unique2 =  '';
	    }
	    $this->form_validation->set_rules('mr_crop_name','Crop Name in Marathi','required|trim'.$is_unique1);

	    //mandi grade
		if(!empty($_REQUEST['mandi_val'])){
			$mandi_arr = explode(',',$_REQUEST['mandi_val']);
			foreach ($mandi_arr as $idx => $mandi){
				if(!empty($_REQUEST['en_mgrade_'.$idx])){
					$this->form_validation->set_rules('hi_mgrade_'.$idx,'Grade in Hindi','required|trim');
					$this->form_validation->set_rules('mr_mgrade_'.$idx,'Grade in Marathi','required|trim');
					$this->form_validation->set_rules('en_mspeci_'.$idx,'Specification in Marathi','required|trim');
					$this->form_validation->set_rules('hi_mspeci_'.$idx,'Specification in Marathi','required|trim');
					$this->form_validation->set_rules('mr_mspeci_'.$idx,'Specification in Marathi','required|trim');
				}
			}
		}

		//farm grade
		if(!empty($_REQUEST['farm_val'])){
			$farm_arr = explode(',',$_REQUEST['farm_val']);
			foreach ($farm_arr as $idx => $farm){
				if(!empty($_REQUEST['en_fspeci_'.$idx])){
					$this->form_validation->set_rules('hi_fspeci_'.$idx,'Specification in Marathi','required|trim');
					$this->form_validation->set_rules('mr_fspeci_'.$idx,'Specification in Marathi','required|trim');
				}
			}
		}
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_crop_name' => ucfirst($_REQUEST['en_crop_name']), 
				'mr_crop_name' => $_REQUEST['mr_crop_name'], 
				'hi_crop_name' => $_REQUEST['hi_crop_name'],
			);

			if (!empty($_FILES['crop_image']['name']))
			{

				if (!is_dir('./uploads/crop/')) {
					mkdir('./uploads/crop/', 0777, TRUE);
				}

				$image_name = $this->cropmodel->get_cropimage($id);
				if($image_name != '')
				{
					$path = './uploads/crop/'.$image_name;
					@unlink($path);
				}
			
				$config['upload_path']   = './uploads/crop/';
				$config['allowed_types'] = 'jpg|png|jpeg'; 
				$new_name = rand().'_'.str_replace(' ', '', $_FILES["crop_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('crop_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$img_file = $this->upload->data(); 
					$params['crop_image'] = $new_name;
					
					$configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  $img_file['full_path'],
		              'maintain_ratio'  =>  false,
		              'width'           =>  250,
		              'height'          =>  250,
		            );
		            $this->load->library('image_lib', $configer); 
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();

				}
			}
			//update existing mandi grade
			$mandigrade = $this->cropmodel->mandi_rate_by_crop($id);	
			if(count($mandigrade) > 0){
				foreach ($mandigrade as $mrow) {
					$mid=$mrow->id;
					$mandiparam = array(
							'en_grade' => $_REQUEST['m_en_grade_'.$mid],
							'hi_grade' => $_REQUEST['m_hi_grade_'.$mid],
							'mr_grade' => $_REQUEST['m_mr_grade_'.$mid],
							'en_specification' => $_REQUEST['m_en_specification_'.$mid],
							'hi_specification' => $_REQUEST['m_hi_specification_'.$mid],
							'mr_specification' => $_REQUEST['m_mr_specification_'.$mid]
							 );
					$this->cropmodel->update_mandigrade_by_id($mid,$mandiparam);
				}	
			}
			
			//die;

			//update existing farm grade
			$farmgrade = $this->cropmodel->farm_rate_by_crop($id);
			if(count($farmgrade) > 0){
				foreach ($farmgrade as $frow) {
					$fid=$frow->id;
					$farmparam = array(
							'en_specification' => $_REQUEST['f_en_specification_'.$fid],
							'hi_specification' => $_REQUEST['f_hi_specification_'.$fid],
							'mr_specification' => $_REQUEST['f_mr_specification_'.$fid]
							 );
					$this->cropmodel->update_farmgrade_by_id($fid,$farmparam);
				}
			}	

			//new mandi value
			if(!empty($_REQUEST['mandi_val'])){
				$mandi_arr = explode(',',$_REQUEST['mandi_val']);
				foreach ($mandi_arr as $val) {
					$mandi_param = array(
						'crop_id' => $id, 
						'en_grade' => $_REQUEST['en_mgrade_'.$val],
						'hi_grade' => $_REQUEST['hi_mgrade_'.$val],
						'mr_grade' => $_REQUEST['mr_mgrade_'.$val],
						'en_specification' => $_REQUEST['en_mspeci_'.$val],
						'hi_specification' => $_REQUEST['hi_mspeci_'.$val],
						'mr_specification' => $_REQUEST['mr_mspeci_'.$val],
					);
					
					$this->cropmodel->add_crop_mandi_rate($mandi_param);
				}		
			}
			

			//new farm value
			if(!empty($_REQUEST['farm_val'])){
				$farm_arr = explode(',',$_REQUEST['farm_val']);
				foreach ($farm_arr as $val) {
					$farm_param = array(
						'crop_id' => $id, 
						'en_specification' => $_REQUEST['en_fspeci_'.$val],
						'hi_specification' => $_REQUEST['hi_fspeci_'.$val],
						'mr_specification' => $_REQUEST['mr_fspeci_'.$val],
					);	
					$this->cropmodel->add_crop_farm_rate($farm_param);
				}
			}		
			
			$check = $this->cropmodel->update_crop_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Crop has been updated Successfully..');
				redirect('admin/crop-list');
			}
		}
		$data['page'] = 'module/crop/edit_crop';
		$this->load->view('admin/template',$data);
  	}

  	public function trash_crop()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{

			$id = $_REQUEST['id'];
			$image_name = $this->cropmodel->get_cropimage($id);
			if($image_name != '')
			{
				$path = './uploads/crop/'.$image_name;
				@unlink($path);
			}

			$this->db->where('crop_id', $id);
			$this->db->delete("s_variety");

			$this->db->where('crop_id', $id);
			$this->db->delete("s_rate_of_farm");

			$this->db->where('crop_id', $id);
			$this->db->delete("s_rate_of_mandi");

			$this->db->where('crop_id', $id);
			$this->db->delete("s_crops");

			$this->session->set_flashdata('success', 'Crop has been Successfully Deleted.');
			redirect('admin/crop-list');
		}
	}

	

}

