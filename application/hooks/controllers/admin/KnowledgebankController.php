<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KnowledgebankController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/KnowledgebankModel','knowledgebankmodel');
		$this->load->model('admin/module/CropModel','cropmodel');
		$this->load->model('admin/VendorModel','vendormodel');
		
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'knowledge_bank/list_kb_crop';
		$this->load->view('admin/template',$data);
	}

	public function kb_topic()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'knowledge_bank/list_kb_topic';
		$this->load->view('admin/template',$data);	
	}

	public function create_kb_topic($crop_id)
	{
		$this->adminmodel->CSRFVerify();
		$data['crop_id'] = $crop_id;
 		$data['page'] = 'knowledge_bank/add_kb_topic';
		$this->load->view('admin/template',$data);
	}

	public function add_kb_topic()
	{
		$this->adminmodel->CSRFVerify();
		$ch_unique = $this->knowledgebankmodel->check_unique('en_name',$_REQUEST['en_name'],$_REQUEST['crop_id']); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_kb_topic.en_name]';
		} else {
		   $is_unique =  '';
		}
 		$this->form_validation->set_rules('en_name','Topic Name in English','required|trim'.$is_unique);

 		$ch_unique2 = $this->knowledgebankmodel->check_unique('hi_name',$_REQUEST['hi_name'],$_REQUEST['crop_id']); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_topic.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_name','Topic Name in Hindi','required|trim'.$is_unique2);

		$ch_unique3 = $this->knowledgebankmodel->check_unique('mr_name',$_REQUEST['mr_name'],$_REQUEST['crop_id']); 
		if($ch_unique3 == 1) {
		   $is_unique3 =  '|is_unique[s_kb_topic.mr_name]';
		} else {
		   $is_unique3 =  '';
		}
		$this->form_validation->set_rules('mr_name','Topic Name in Marathi','required|trim'.$is_unique3);

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'hi_name' => $_REQUEST['hi_name'],
				'mr_name' => $_REQUEST['mr_name'], 
				'crop_id' => $_REQUEST['crop_id'],
				'slug' => str_replace(' ', '-', strtolower($_REQUEST['en_name']))
			);

			
			$check = $this->knowledgebankmodel->add_kb_topic($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Topic has been added Successfully..');
				redirect('admin/knowledge-bank-topic/'.$_REQUEST['crop_id']);
			}
		}
  		
  		$data['crop_id'] = $_REQUEST['crop_id'];
 		$data['page'] = 'knowledge_bank/add_kb_topic';
		$this->load->view('admin/template',$data);
	}

	public function edit_kb_topic()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(4);
		$data['crop_id'] = $this->uri->segment(3);
		$data['topic'] = $this->knowledgebankmodel->get_kb_topic_by_id($id); 
		$data['page'] = 'knowledge_bank/edit_kb_topic';
		$this->load->view('admin/template',$data);
	}

	public function update_kb_topic()
	{
		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
  		$data['topic'] = $this->knowledgebankmodel->get_kb_topic_by_id($id); 

  		$ch_unique = $this->knowledgebankmodel->check_edit_unique('en_name',$_REQUEST['en_name'],$_REQUEST['crop_id'],$id); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_kb_topic.en_name]';
		} else {
		   $is_unique =  '';
		}
 		$this->form_validation->set_rules('en_name','Topic Name in English','required|trim'.$is_unique);
		
		$ch_unique1 = $this->knowledgebankmodel->check_edit_unique('mr_name',$_REQUEST['mr_name'],$_REQUEST['crop_id'],$id); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_kb_topic.mr_name]';
		} else {
		   $is_unique1 =  '';
		}
 		$this->form_validation->set_rules('mr_name','Topic Name in Marathi','required|trim'.$is_unique1);

		$ch_unique2 = $this->knowledgebankmodel->check_edit_unique('hi_name',$_REQUEST['hi_name'],$_REQUEST['crop_id'],$id); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_topic.hi_name]';
		} else {
		   $is_unique2 =  '';
		}
 		$this->form_validation->set_rules('hi_name','Topic Name in Hindi','required|trim'.$is_unique2);

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_name' => ucfirst($_REQUEST['en_name']), 
				'hi_name' => $_REQUEST['hi_name'],
				'mr_name' => $_REQUEST['mr_name'], 
				'slug' => str_replace(' ', '-', strtolower($_REQUEST['en_name']))
			);
			
			$check = $this->knowledgebankmodel->update_kb_topic($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Topic has been updated Successfully..');
				redirect('admin/knowledge-bank-topic/'.$_REQUEST['crop_id']);
			}
		}
		$data['crop_id'] = $_REQUEST['crop_id'];
		$data['page'] = 'knowledge_bank/edit_kb_topic';
		$this->load->view('admin/template',$data);
	}

	public function trash_kb_topic()
	{
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			//
			$subtopic = $this->knowledgebankmodel->get_all_kb_subtopic($id);
			foreach ($subtopic as $s_topic) {
				//technical
				$technical = $this->knowledgebankmodel->get_all_technical($s_topic->id); 
				foreach ($technical as $row) {
					//contol measure
					$control_measure = $this->knowledgebankmodel->get_all_control_measure($row->id); 
					foreach ($control_measure as $cm) {
						if($cm->base_image != '')
						{
							$path = './uploads/control_measure/'.$cm->base_image;
							@unlink($path);
						}
						$this->db->where('id', $cm->id);
						$this->db->delete("s_kb_control_measure");
					}

					if($row->image != '')
					{
						$path = './uploads/control_measure/'.$row->image;
						@unlink($path);
					}
					$this->db->where('id', $row->id);
					$this->db->delete("s_kb_technical_tbl");
				}
				$this->db->where('subtopic_id', $s_topic->id);
				$this->db->delete("s_kb_subtopic_photo");

				$this->db->where('subtopic_id', $s_topic->id);
				$this->db->delete("s_kb_subtopic_video");

				$this->db->where('id', $s_topic->id);
				$this->db->delete("s_kb_subtopic");
			}

			$topic_path = './uploads/knowledge_bank/'.$id;
			$this->load->helper("file");
			@delete_files($topic_path, true);
			@rmdir($topic_path);

			$this->db->where('id', $id);
			$this->db->delete("s_kb_topic");

			$this->session->set_flashdata('success', 'Topic has been Deleted Successfully.');
			redirect('admin/knowledge-bank-topic/'.$_REQUEST['crop_id']);
		}
	}

	//sub topic
	public function kb_subtopic()
	{
		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'knowledge_bank/list_kb_subtopic';
		$this->load->view('admin/template',$data);	
	}

	public function create_kb_subtopic($topic_id)
	{	
		$this->adminmodel->CSRFVerify();
		$data['topic_id'] = $topic_id;
 		$data['page'] = 'knowledge_bank/add_kb_subtopic';
		$this->load->view('admin/template',$data);
	}

	public function add_kb_subtopic()
	{
		$this->adminmodel->CSRFVerify();

		$ch_unique_sub = $this->knowledgebankmodel->check_unique_subtopic('en_title',$_REQUEST['en_title'],$_REQUEST['topic_id']); 
		if($ch_unique_sub == 1) {
		   $is_unique =  '|is_unique[s_kb_subtopic.en_title]';
		} else {
		   $is_unique =  '';
		}
 		$this->form_validation->set_rules('en_title','Title in English','required|trim'.$is_unique);
 		$this->form_validation->set_rules('en_description','Description in English','required|trim');
 		$ch_unique_sub2 = $this->knowledgebankmodel->check_unique_subtopic('hi_title',$_REQUEST['hi_title'],$_REQUEST['topic_id']); 
		if($ch_unique_sub2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_subtopic.hi_title]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('hi_title','Title in Hindi','required|trim'.$is_unique2);
		$this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');
		$ch_unique_sub3 = $this->knowledgebankmodel->check_unique_subtopic('mr_title',$_REQUEST['mr_title'],$_REQUEST['topic_id']); 
		if($ch_unique_sub3 == 1) {
		   $is_unique3 =  '|is_unique[s_kb_subtopic.mr_title]';
		} else {
		   $is_unique3 =  '';
		}
		$this->form_validation->set_rules('mr_title','Title in Marathi','required|trim'.$is_unique3);
		$this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');
		/*if (empty($_FILES['en_pdf_file']['name'])){
			$this->form_validation->set_rules('en_pdf_file','PDF File in English','required');
		}
		if (empty($_FILES['hi_pdf_file']['name'])){
			$this->form_validation->set_rules('hi_pdf_file','PDF File in Hindi','required');
		}
		if (empty($_FILES['mr_pdf_file']['name'])){
			$this->form_validation->set_rules('mr_pdf_file','PDF File in Marathi','required');
		}
		$this->form_validation->set_rules('en_pdf_title','PDF Title in English','required|trim');
		$this->form_validation->set_rules('hi_pdf_title','PDF Title in Hindi','required|trim');
		$this->form_validation->set_rules('mr_pdf_title','PDF Title in Marathi','required|trim');

		$this->form_validation->set_rules('en_pdf_description','PDF Title in English','required|trim');
		$this->form_validation->set_rules('hi_pdf_description','PDF Title in Hindi','required|trim');
		$this->form_validation->set_rules('mr_pdf_description','PDF Title in Marathi','required|trim');*/

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'topic_id' => $_REQUEST['topic_id'],
				'slug' => str_replace(' ', '-', strtolower($_REQUEST['en_title'])),
				'en_title' => ucfirst($_REQUEST['en_title']), 
				'hi_title' => $_REQUEST['hi_title'],
				'mr_title' => $_REQUEST['mr_title'],
				'en_description' => $_REQUEST['en_description'],
				'hi_description' => $_REQUEST['hi_description'],
				'mr_description' => $_REQUEST['mr_description'], 
				'en_pdf_title' => $_REQUEST['en_pdf_title'],
				'hi_pdf_title' => $_REQUEST['hi_pdf_title'],
				'mr_pdf_title' => $_REQUEST['mr_pdf_title'],
				'en_pdf_description' => $_REQUEST['en_pdf_description'],
				'hi_pdf_description' => $_REQUEST['hi_pdf_description'],
				'mr_pdf_description' => $_REQUEST['mr_pdf_description'],
			);
			$topic_id = $_REQUEST['topic_id'];
			$this->load->library('upload');
			if (!is_dir('./uploads/knowledge_bank/'.$topic_id)) {
				mkdir('./uploads/knowledge_bank/'.$topic_id, 0777, TRUE);
			}
			$config['upload_path']   = './uploads/knowledge_bank/'.$topic_id.'/';
			$config['allowed_types'] = 'pdf';
			if (!empty($_FILES['en_pdf_file']['name']))
			{
				$new_name = 'en_'.rand().'_'.str_replace(' ', '-',$_FILES["en_pdf_file"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('en_pdf_file')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('en_pdf_file_error',$error['error']);
				}
				else
				{ 
					$params['en_pdf_file'] = $new_name;
				}
			}
			if (!empty($_FILES['hi_pdf_file']['name']))
			{
				$new_name = 'hi_'.rand().'_'.str_replace(' ', '-',$_FILES["hi_pdf_file"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('hi_pdf_file')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('hi_pdf_file_error',$error['error']);
				}
				else
				{ 
					$params['hi_pdf_file'] = $new_name;
				}
			}
			if (!empty($_FILES['mr_pdf_file']['name']))
			{
				$new_name ='mr_'.rand().'_'.str_replace(' ', '-', $_FILES["mr_pdf_file"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('mr_pdf_file')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('mr_pdf_file_error',$error['error']);
				}
				else
				{ 
					$params['mr_pdf_file'] = $new_name;
				}
			}
			$inserted_subtopic_id = $this->knowledgebankmodel->add_kb_subtopic($params);
			if($inserted_subtopic_id)
			{
				$config['allowed_types'] = 'png|jpg|jpeg';
				$photo_arr = explode(',',$_REQUEST['photo_val']);
				foreach ($photo_arr as $val) {
					$photo_param = array(
						'subtopic_id' => $inserted_subtopic_id, 
						'en_photo_title' => $_REQUEST['en_photo_title_'.$val],
						'hi_photo_title' => $_REQUEST['hi_photo_title_'.$val],
						'mr_photo_title' => $_REQUEST['mr_photo_title_'.$val],
					);
					if (!empty($_FILES['photofile_'.$val]['name']))
					{
						$new_name =rand().'_'.str_replace(' ', '-', $_FILES["photofile_".$val]['name']);	
						$config['file_name'] = $new_name; 
						$this->upload->initialize($config);
						$this->upload->do_upload('photofile_'.$val);
						$photo_param['img_path'] = $new_name;
					}
					
					$this->knowledgebankmodel->add_kb_subtopic_photo($photo_param);
				}	

				$video_arr = explode(',',$_REQUEST['video_val']);
				foreach ($video_arr as $val) {
					$video_param = array(
						'subtopic_id' => $inserted_subtopic_id, 
						'en_link' => $_REQUEST['en_link_'.$val],
						'en_id' => $_REQUEST['en_id_'.$val],
						'en_description' => $_REQUEST['en_description_'.$val],
						'hi_link' => $_REQUEST['hi_link_'.$val],
						'hi_id' => $_REQUEST['hi_id_'.$val],
						'hi_description' => $_REQUEST['hi_description_'.$val],
						'mr_link' => $_REQUEST['mr_link_'.$val],
						'mr_id' => $_REQUEST['mr_id_'.$val],
						'mr_description' => $_REQUEST['mr_description_'.$val],
					);
					
					$this->knowledgebankmodel->add_kb_subtopic_video($video_param);
				}	
				$this->session->set_flashdata('success', 'Sub Topic has been added Successfully..');
				redirect('admin/knowledge-bank-subtopic/'.$_REQUEST['topic_id']);
			}
		}
  		
  		$data['topic_id'] = $_REQUEST['topic_id'];
 		$data['page'] = 'knowledge_bank/add_kb_subtopic';
		$this->load->view('admin/template',$data);
	}

	public function edit_kb_subtopic()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(4);
		$data['topic_id'] = $this->uri->segment(3);
		$data['subtopic'] = $this->knowledgebankmodel->get_kb_subtopic_by_id($id); 
		$data['page'] = 'knowledge_bank/edit_kb_subtopic';
		$this->load->view('admin/template',$data);
	}

	public function update_kb_subtopic()
	{
		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
  		$data['subtopic'] = $this->knowledgebankmodel->get_kb_subtopic_by_id($id); 

  		$ch_unique = $this->knowledgebankmodel->check_edit_unique_subtopic('en_title',$_REQUEST['en_title'],$_REQUEST['topic_id'],$id); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_kb_subtopic.en_title]';
		} else {
		   $is_unique =  '';
		}
 		$this->form_validation->set_rules('en_title','Title in English','required|trim'.$is_unique);
 		$this->form_validation->set_rules('en_description','Description in English','required|trim');	

		$ch_unique2 = $this->knowledgebankmodel->check_edit_unique_subtopic('hi_title',$_REQUEST['hi_title'],$_REQUEST['topic_id'],$id); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_subtopic.hi_title]';
		} else {
		   $is_unique2 =  '';
		}
 		$this->form_validation->set_rules('hi_title','Title in Hindi','required|trim'.$is_unique2);
 		$this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');

		$ch_unique1 = $this->knowledgebankmodel->check_edit_unique_subtopic('mr_title',$_REQUEST['mr_title'],$_REQUEST['topic_id'],$id); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_kb_subtopic.mr_title]';
		} else {
		   $is_unique1 =  '';
		}
 		$this->form_validation->set_rules('mr_title','Title in Marathi','required|trim'.$is_unique1);
 		$this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');
 		/*$this->form_validation->set_rules('en_pdf_title','PDF Title in English','required|trim');
		$this->form_validation->set_rules('hi_pdf_title','PDF Title in Hindi','required|trim');
		$this->form_validation->set_rules('mr_pdf_title','PDF Title in Marathi','required|trim');

		$this->form_validation->set_rules('en_pdf_description','PDF Title in English','required|trim');
		$this->form_validation->set_rules('hi_pdf_description','PDF Title in Hindi','required|trim');
		$this->form_validation->set_rules('mr_pdf_description','PDF Title in Marathi','required|trim');*/

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'slug' => str_replace(' ', '-', strtolower($_REQUEST['en_title'])),
				'en_title' => ucfirst($_REQUEST['en_title']), 
				'hi_title' => $_REQUEST['hi_title'],
				'mr_title' => $_REQUEST['mr_title'],
				'en_description' => $_REQUEST['en_description'],
				'hi_description' => $_REQUEST['hi_description'],
				'mr_description' => $_REQUEST['mr_description'], 
				'en_pdf_title' => $_REQUEST['en_pdf_title'],
				'hi_pdf_title' => $_REQUEST['hi_pdf_title'],
				'mr_pdf_title' => $_REQUEST['mr_pdf_title'],
				'en_pdf_description' => $_REQUEST['en_pdf_description'],
				'hi_pdf_description' => $_REQUEST['hi_pdf_description'],
				'mr_pdf_description' => $_REQUEST['mr_pdf_description'],
			);

			$topic_id = $_REQUEST['topic_id'];
			$this->load->library('upload');
			if (!is_dir('./uploads/knowledge_bank/'.$topic_id)) {
				mkdir('./uploads/knowledge_bank/'.$topic_id, 0777, TRUE);
			}
			$config['upload_path']   = './uploads/knowledge_bank/'.$topic_id.'/';
			$config['allowed_types'] = 'pdf';
			if (!empty($_FILES['en_pdf_file']['name']))
			{
				$en_pdf_file = $this->mastermodel->get_field_val('id',$id,'s_kb_subtopic','en_pdf_file');
				if($en_pdf_file != '')
				{
					$path = './uploads/knowledge_bank/'.$topic_id.'/'.$en_pdf_file;
					@unlink($path);
				}
			  
				$new_name = 'en_'.rand().'_'.str_replace(' ', '-', $_FILES["en_pdf_file"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('en_pdf_file')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('en_pdf_file_error',$error['error']);
				}
				else
				{ 
					$params['en_pdf_file'] = $new_name;
				}
			}
			if (!empty($_FILES['hi_pdf_file']['name']))
			{
				$hi_pdf_file = $this->mastermodel->get_field_val('id',$id,'s_kb_subtopic','hi_pdf_file');
				if($hi_pdf_file != '')
				{
					$path = './uploads/knowledge_bank/'.$topic_id.'/'.$hi_pdf_file;
					@unlink($path);
				}
				$new_name = 'hi_'.rand().'_'.str_replace(' ', '-', $_FILES["hi_pdf_file"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('hi_pdf_file')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('hi_pdf_file_error',$error['error']);
				}
				else
				{ 
					$params['hi_pdf_file'] = $new_name;
				}
			}
			if (!empty($_FILES['mr_pdf_file']['name']))
			{
				$mr_pdf_file = $this->mastermodel->get_field_val('id',$id,'s_kb_subtopic','mr_pdf_file');
				if($mr_pdf_file != '')
				{
					$path = './uploads/knowledge_bank/'.$topic_id.'/'.$mr_pdf_file;
					@unlink($path);
				}
				$new_name ='mr_'.rand().'_'.str_replace(' ', '-', $_FILES["mr_pdf_file"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('mr_pdf_file')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('mr_pdf_file_error',$error['error']);
				}
				else
				{ 
					$params['mr_pdf_file'] = $new_name;
				}
			}
			//video
			$remove_video_arr = explode(',',$_REQUEST['remove_video']);
			foreach($remove_video_arr as $remove_val){
				$this->db->where('id', $remove_val);
				$this->db->delete("s_kb_subtopic_video");
			}
			$video_arr = explode(',',$_REQUEST['video_val']);
			foreach ($video_arr as $val){
				$this->db->where('id',$_REQUEST['video_id_'.$val]);
				$this->db->delete("s_kb_subtopic_video");
				$video_param = array(
					'subtopic_id' => $id, 
					'en_link' => $_REQUEST['en_link_'.$val],
					'en_id' => $_REQUEST['en_id_'.$val],
					'en_description' => $_REQUEST['en_description_'.$val],
					'hi_link' => $_REQUEST['hi_link_'.$val],
					'hi_id' => $_REQUEST['hi_id_'.$val],
					'hi_description' => $_REQUEST['hi_description_'.$val],
					'mr_link' => $_REQUEST['mr_link_'.$val],
					'mr_id' => $_REQUEST['mr_id_'.$val],
					'mr_description' => $_REQUEST['mr_description_'.$val],
				);
				$this->knowledgebankmodel->add_kb_subtopic_video($video_param);
			}	
			//photo	
			$config['allowed_types'] = 'png|jpg|jpeg';
			$remove_photo_arr = explode(',',$_REQUEST['remove_photo']);
			foreach($remove_photo_arr as $remove_val) {
				$img_path = $this->mastermodel->get_field_val('id',$remove_val,'s_kb_subtopic_photo','img_path');
				if($img_path != '')
				{
					$path = './uploads/knowledge_bank/'.$topic_id.'/'.$img_path;
					@unlink($path);
				}
				$this->db->where('id', $remove_val);
				$this->db->delete("s_kb_subtopic_photo");
			}
			$photo_arr = explode(',',$_REQUEST['photo_val']);
			foreach($photo_arr as $val){
				$photo_param = array(
					'subtopic_id' => $id, 	
					'en_photo_title' => $_REQUEST['en_photo_title_'.$val],
					'hi_photo_title' => $_REQUEST['hi_photo_title_'.$val],
					'mr_photo_title' => $_REQUEST['mr_photo_title_'.$val],
				);
				if(!empty($_FILES['photofile_'.$val]['name']))
				{
					if($_REQUEST['image_name_'.$val] != '0'){
						$path = './uploads/knowledge_bank/'.$topic_id.'/'.$_REQUEST['image_name_'.$val];
						@unlink($path);
						$this->db->where('id',$_REQUEST['photo_id_'.$val]);
						$this->db->delete("s_kb_subtopic_photo");
					}
					$new_name =rand().'_'.str_replace(' ', '-',$_FILES["photofile_".$val]['name']);	
					$config['file_name'] = $new_name; 
					$this->upload->initialize($config);
					$this->upload->do_upload('photofile_'.$val);
					$photo_param['img_path'] = $new_name;
				}
				else{
					$this->db->where('id',$_REQUEST['photo_id_'.$val]);
					$this->db->delete("s_kb_subtopic_photo");
					$photo_param['img_path'] = $_REQUEST['image_name_'.$val];
				}
				$this->knowledgebankmodel->add_kb_subtopic_photo($photo_param);
			}
			//subtopic
			$check = $this->knowledgebankmodel->update_kb_subtopic($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'SubTopic has been updated Successfully..');
				redirect('admin/knowledge-bank-subtopic/'.$_REQUEST['topic_id']);
			}
		}
		$data['topic_id'] = $_REQUEST['topic_id'];
		$data['page'] = 'knowledge_bank/edit_kb_subtopic';
		$this->load->view('admin/template',$data);
	}

	public function trash_kb_subtopic()
	{
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$topic_id = $_REQUEST['topic_id'];
			$id = $_REQUEST['id'];

			//control measure
			$technical = $this->knowledgebankmodel->get_all_technical($id); 
			foreach ($technical as $row) {
				//contol measure
				$control_measure = $this->knowledgebankmodel->get_all_control_measure($row->id); 
				foreach ($control_measure as $cm) {
					if($cm->base_image != '')
					{
						$path = './uploads/control_measure/'.$cm->base_image;
						@unlink($path);
					}
					$this->db->where('id', $cm->id);
					$this->db->delete("s_kb_control_measure");
				}

				if($row->image != '')
				{
					$path = './uploads/control_measure/'.$row->image;
					@unlink($path);
				}
				$this->db->where('id', $row->id);
				$this->db->delete("s_kb_technical_tbl");
			}

			$photos = $this->knowledgebankmodel->get_photos_by_subtopic($id);
			foreach($photos as $photo)
			{
				$path = './uploads/knowledge_bank/'.$topic_id.'/'.$photo->img_path;
				@unlink($path);
			}	

			$this->db->where('subtopic_id', $id);
			$this->db->delete("s_kb_subtopic_photo");

			$this->db->where('subtopic_id', $id);
			$this->db->delete("s_kb_subtopic_video");

			$subtopic = $this->knowledgebankmodel->get_kb_subtopic_by_id($id); 

			if($subtopic['en_pdf_file'] != '')
			{
				$path = './uploads/knowledge_bank/'.$topic_id.'/'.$subtopic['en_pdf_file'];
				@unlink($path);
			}
			if($subtopic['hi_pdf_file'] != '')
			{
				$path = './uploads/knowledge_bank/'.$topic_id.'/'.$subtopic['hi_pdf_file'];
				@unlink($path);
			}
			if($subtopic['mr_pdf_file'] != '')
			{
				$path = './uploads/knowledge_bank/'.$topic_id.'/'.$subtopic['mr_pdf_file'];
				@unlink($path);
			}
			
			$this->db->where('id', $id);
			$this->db->delete("s_kb_subtopic");
			$this->session->set_flashdata('success', 'SubTopic has been Successfully Deleted.');
			redirect('admin/knowledge-bank-subtopic/'.$topic_id);
		}
	}

	//technical name
	public function list_technical()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'knowledge_bank/list_technical';
		$this->load->view('admin/template',$data);
	}

	public function create_technical($subtopic_id)
	{
		$this->adminmodel->CSRFVerify();
		$data['subtopic_id'] = $subtopic_id;
 		$data['page'] = 'knowledge_bank/add_technical';
		$this->load->view('admin/template',$data);
	}

	public function add_technical()
	{
		$this->adminmodel->CSRFVerify();
		$ch_unique = $this->knowledgebankmodel->check_unique_technical('en_technical_name',$_REQUEST['en_technical_name'],$_REQUEST['subtopic_id']); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_kb_technical_tbl.en_technical_name]';
		} else {
		   $is_unique =  '';
		}

		$this->form_validation->set_rules('en_technical_name','Technical Name [English]','required|trim'.$is_unique);

		$ch_unique1 = $this->knowledgebankmodel->check_unique_technical('hi_technical_name',$_REQUEST['hi_technical_name'],$_REQUEST['subtopic_id']); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_kb_technical_tbl.hi_technical_name]';
		} else {
		   $is_unique1 =  '';
		}

		$this->form_validation->set_rules('hi_technical_name','Technical Name [Hindi]','required|trim'.$is_unique1);

		$ch_unique2 = $this->knowledgebankmodel->check_unique_technical('mr_technical_name',$_REQUEST['mr_technical_name'],$_REQUEST['subtopic_id']); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_technical_tbl.mr_technical_name]';
		} else {
		   $is_unique2 =  '';
		}

		$this->form_validation->set_rules('mr_technical_name','Technical Name [Marathi]','required|trim'.$is_unique2);

		if (empty($_FILES['image']['name'])){
			$this->form_validation->set_rules('image','Image','required');
		}

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'subtopic_id' => $_REQUEST['subtopic_id'],
				'en_technical_name' => ucfirst($_REQUEST['en_technical_name']),
				'hi_technical_name' => $_REQUEST['hi_technical_name'],
				'mr_technical_name' => $_REQUEST['mr_technical_name'],
			);
			$subtopic_id = $_REQUEST['subtopic_id'];
			$this->load->library('upload');
			if (!is_dir('./uploads/control_measure/')) {
				mkdir('./uploads/control_measure/', 0777, TRUE);
			}
			$config['upload_path']   = './uploads/control_measure/';
			$config['allowed_types'] = 'png|jpg|jpeg';
			if (!empty($_FILES['image']['name']))
			{
				$new_name = rand().'_'.str_replace(' ', '-',$_FILES["image"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('image_error',$error['error']);
				}
				else
				{ 
					$params['image'] = $new_name;
				}
			}
			
			$check = $this->knowledgebankmodel->add_technical($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Technical Name has been added Successfully..');
				redirect('admin/technical-list/'.$_REQUEST['subtopic_id']);
			}
		}
  		
  		$data['subtopic_id'] = $_REQUEST['subtopic_id'];
 		$data['page'] = 'knowledge_bank/add_technical';
		$this->load->view('admin/template',$data);
	}

	public function edit_technical()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(4);
		$data['subtopic_id'] = $this->uri->segment(3);
		$data['technical'] = $this->knowledgebankmodel->get_technical_by_id($id); 
		$data['page'] = 'knowledge_bank/edit_technical';
		$this->load->view('admin/template',$data);
	}

	public function update_technical()
	{
		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['technical'] = $this->knowledgebankmodel->get_technical_by_id($id); 

		$ch_unique = $this->knowledgebankmodel->check_unique_edit_technical('en_technical_name',$_REQUEST['en_technical_name'],$_REQUEST['subtopic_id'],$id); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_kb_technical_tbl.en_technical_name]';
		} else {
		   $is_unique =  '';
		}
	    $this->form_validation->set_rules('en_technical_name','Technical Name [English]','required|trim'.$is_unique);

	    $ch_unique1 = $this->knowledgebankmodel->check_unique_edit_technical('hi_technical_name',$_REQUEST['hi_technical_name'],$_REQUEST['subtopic_id'],$id); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_kb_technical_tbl.hi_technical_name]';
		} else {
		   $is_unique1 =  '';
		}
	    $this->form_validation->set_rules('hi_technical_name','Technical Name [Hindi]','required|trim'.$is_unique1);

	    $ch_unique2 = $this->knowledgebankmodel->check_unique_edit_technical('mr_technical_name',$_REQUEST['mr_technical_name'],$_REQUEST['subtopic_id'],$id);
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_technical_tbl.mr_technical_name]';
		} else {
		   $is_unique2 =  '';
		}
	    $this->form_validation->set_rules('mr_technical_name','Technical Name [Marathi]','required|trim'.$is_unique2);

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_technical_name' => ucfirst($_REQUEST['en_technical_name']),
				'hi_technical_name' => $_REQUEST['hi_technical_name'],
				'mr_technical_name' => $_REQUEST['mr_technical_name'],
			);

			$this->load->library('upload');
			
			$config['upload_path']   = './uploads/control_measure/';
			$config['allowed_types'] = 'png|jpg|jpeg';

			if (!empty($_FILES['image']['name']))
			{
				$base_image = $this->mastermodel->get_field_val('id',$id,'s_kb_technical_tbl','image');
				if($base_image != '')
				{
					$path = './uploads/control_measure/'.$base_image;
					@unlink($path);
				}
				$new_name =rand().'_'.str_replace(' ', '-', $_FILES["image"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('image_error',$error['error']);
				}
				else
				{ 
					$params['image'] = $new_name;
				}
			}
			
			$check = $this->knowledgebankmodel->update_technical($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Technical Name has been updated Successfully..');
				redirect('admin/technical-list/'.$_REQUEST['subtopic_id']);
			}
		}
		$data['subtopic_id'] = $_REQUEST['subtopic_id'];
		$data['page'] = 'knowledge_bank/edit_technical';
		$this->load->view('admin/template',$data);
	}

	public function trash_technical()
	{
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$subtopic_id = $_REQUEST['subtopic_id'];
			$id = $_REQUEST['id'];

			//control measure
			$control_measure = $this->knowledgebankmodel->get_all_control_measure($id); 
			foreach ($control_measure as $row) {
				if($row->base_image != '')
				{
					$path = './uploads/control_measure/'.$row->base_image;
					@unlink($path);
				}
				$this->db->where('id', $row->id);
				$this->db->delete("s_kb_control_measure");
			}

			$technical = $this->knowledgebankmodel->get_technical_by_id($id); 

			if($technical['image'] != '')
			{
				$path = './uploads/control_measure/'.$technical['image'];
				@unlink($path);
			}

			$this->db->where('id', $id);
			$this->db->delete("s_kb_technical_tbl");

			$this->session->set_flashdata('success', 'Technical Name has been Successfully Deleted.');
			redirect('admin/technical-list/'.$subtopic_id);
		}
	}

	public function get_main_admin()
	{
		$created_by=$this->session->userdata[SESSION_ADMIN]['created_by'];
		if($created_by == 0)
		{
			$creater_id = $this->session->userdata[SESSION_ADMIN]['admin_id'];
		}
		else
		{
			$this->db->select("*");
			$this->db->from('s_admin');
			$this->db->where("admin_id",$created_by);
			$result=$this->db->get();
			$user = $result->row_array();
			$creater_id = $user['admin_id'];
		}	
		return $creater_id;
	}

	//control measure
	public function list_control_measure()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'knowledge_bank/list_control_measure';
		$this->load->view('admin/template',$data);
	}

	public function create_control_measure($technical_id)
	{
		$this->adminmodel->CSRFVerify();
		$data['technical_id'] = $technical_id;
 		$data['page'] = 'knowledge_bank/add_control_measure';
		$this->load->view('admin/template',$data);
	}

	public function validnewsurl($url)
	{
		//$url = $_REQUEST['url'];
	    $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
	    if (!preg_match($pattern, $url))
	    {
			$this->form_validation->set_message('validnewsurl', 'The URL you entered is not correctly formatted.');
	        return FALSE;
	    }
		else 
		{
			return TRUE;
		}
	}

	public function add_control_measure()
	{
		$this->adminmodel->CSRFVerify();

		$ch_unique = $this->knowledgebankmodel->check_unique_control_measure('en_brand_name',$_REQUEST['en_brand_name'],$_REQUEST['technical_id']); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_kb_control_measure.en_brand_name]';
		} else {
		   $is_unique =  '';
		}
		$this->form_validation->set_rules('en_brand_name','Brand Name in English','required|trim'.$is_unique);

		$ch_unique1 = $this->knowledgebankmodel->check_unique_control_measure('hi_brand_name',$_REQUEST['hi_brand_name'],$_REQUEST['technical_id']); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_kb_control_measure.hi_brand_name]';
		} else {
		   $is_unique1 =  '';
		}
		$this->form_validation->set_rules('hi_brand_name','Brand Name in Hindi','required|trim'.$is_unique1);

		$ch_unique2 = $this->knowledgebankmodel->check_unique_control_measure('mr_brand_name',$_REQUEST['mr_brand_name'],$_REQUEST['technical_id']); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_control_measure.mr_brand_name]';
		} else {
		   $is_unique2 =  '';
		}
		$this->form_validation->set_rules('mr_brand_name','Brand Name in Marathi','required|trim'.$is_unique2);

		$this->form_validation->set_rules('en_company_name','Company Name in English','required|trim');
		$this->form_validation->set_rules('hi_company_name','Company Name in Hindi','required|trim');
		$this->form_validation->set_rules('mr_company_name','Company Name in Marathi','required|trim');

		$this->form_validation->set_rules('en_dose','Dose in English','required|trim');
		$this->form_validation->set_rules('hi_dose','Dose in Hindi','required|trim');
		$this->form_validation->set_rules('mr_dose','Dose in Marathi','required|trim');

		$this->form_validation->set_rules('en_cm_description','Description in English','required|trim');
 		$this->form_validation->set_rules('hi_cm_description','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_cm_description','Description in Marathi','required|trim');

		$this->form_validation->set_rules('en_link','URL Link in English','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('hi_link','URL Link in Hindi','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('mr_link','URL Link in Marathi','required|trim|callback_validnewsurl');
		
		$this->form_validation->set_rules('en_id','Description in English','required|trim');
 		$this->form_validation->set_rules('hi_id','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_id','Description in Marathi','required|trim');
		
		$this->form_validation->set_rules('en_description','Description in English','required|trim');
 		$this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');

		if (empty($_FILES['base_image']['name'])){
			$this->form_validation->set_rules('base_image','Base Image','required');
		}

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'technical_id' => $_REQUEST['technical_id'],
				'en_company_name' => ucfirst($_REQUEST['en_company_name']), 
				'hi_company_name' => $_REQUEST['hi_company_name'],
				'mr_company_name' => $_REQUEST['mr_company_name'],
				'en_brand_name' => ucfirst($_REQUEST['en_brand_name']),
				'hi_brand_name' => $_REQUEST['hi_brand_name'],
				'mr_brand_name' => $_REQUEST['mr_brand_name'],
				'en_dose' => $_REQUEST['en_dose'],
				'hi_dose' => $_REQUEST['hi_dose'],
				'mr_dose' => $_REQUEST['mr_dose'],
				'en_cm_description' => $_REQUEST['en_cm_description'],
				'hi_cm_description' => $_REQUEST['hi_cm_description'],
				'mr_cm_description' => $_REQUEST['mr_cm_description'],
				'en_link' => $_REQUEST['en_link'],
				'hi_link' => $_REQUEST['hi_link'],
				'mr_link' => $_REQUEST['mr_link'],
				'en_id' => $_REQUEST['en_id'],
				'hi_id' => $_REQUEST['hi_id'],
				'mr_id' => $_REQUEST['mr_id'],
				'en_description' => $_REQUEST['en_description'],
				'hi_description' => $_REQUEST['hi_description'],
				'mr_description' => $_REQUEST['mr_description'], 
				'created_by_type' => 'Admin',
                'created_by_id' => $this->get_main_admin(),
                'created_by_name' => $this->mastermodel->get_field_val('admin_id',$this->get_main_admin(),'s_admin','name')
			);
			$technical_id = $_REQUEST['technical_id'];
			$this->load->library('upload');
			if (!is_dir('./uploads/control_measure/')) {
				mkdir('./uploads/control_measure/', 0777, TRUE);
			}
			$config['upload_path']   = './uploads/control_measure/';
			$config['allowed_types'] = 'png|jpg|jpeg';
			if (!empty($_FILES['base_image']['name']))
			{
				$new_name = rand().'_'.str_replace(' ', '-',$_FILES["base_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('base_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('base_image_error',$error['error']);
				}
				else
				{ 
					$params['base_image'] = $new_name;
				}
			}

			$vendor = $this->vendormodel->get_all_vendor();
			// echo "<pre>";
			// print_r($vendor);
			// foreach ($vendor as $row) {
			// 	echo $row->name;
			// }
			// die;
			foreach ($vendor as $row) {
				$v_param = array(
					'technical_id' => $_REQUEST['technical_id'],
					'en_company_name' => ucfirst($_REQUEST['en_company_name']), 
					'hi_company_name' => $_REQUEST['hi_company_name'],
					'mr_company_name' => $_REQUEST['mr_company_name'],
					'en_brand_name' => ucfirst($_REQUEST['en_brand_name']),
					'hi_brand_name' => $_REQUEST['hi_brand_name'],
					'mr_brand_name' => $_REQUEST['mr_brand_name'],
					'en_dose' => $_REQUEST['en_dose'],
					'hi_dose' => $_REQUEST['hi_dose'],
					'mr_dose' => $_REQUEST['mr_dose'],
					'en_cm_description' => $_REQUEST['en_cm_description'],
					'hi_cm_description' => $_REQUEST['hi_cm_description'],
					'mr_cm_description' => $_REQUEST['mr_cm_description'],
					'en_link' => $_REQUEST['en_link'],
					'hi_link' => $_REQUEST['hi_link'],
					'mr_link' => $_REQUEST['mr_link'],
					'en_id' => $_REQUEST['en_id'],
					'hi_id' => $_REQUEST['hi_id'],
					'mr_id' => $_REQUEST['mr_id'],
					'en_description' => $_REQUEST['en_description'],
					'hi_description' => $_REQUEST['hi_description'],
					'mr_description' => $_REQUEST['mr_description'],
					'created_by_type' => 'Vendor',
	                'created_by_id' => $row->vendor_id,
	                'created_by_name' => $row->name 
				);
				$config1['upload_path']   = './uploads/control_measure/';
				$config1['allowed_types'] = 'png|jpg|jpeg';
				if (!empty($_FILES['base_image']['name']))
				{
					$vnew_name = rand().'_'.str_replace(' ', '-',$_FILES["base_image"]['name']);
					$config1['file_name'] = $vnew_name; 
					$this->upload->initialize($config1);
					if (!$this->upload->do_upload('base_image')) 
					{
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('base_image_error',$error['error']);
					}
					else
					{ 
						$v_param['base_image'] = $vnew_name;
					}
				}
				$this->knowledgebankmodel->add_control_measure($v_param);
			}

			$check = $this->knowledgebankmodel->add_control_measure($params);

			if($check)
			{
				$this->session->set_flashdata('success', 'Control Measure has been added Successfully..');
				redirect('admin/control-measure-list/'.$_REQUEST['technical_id']);
			}
		}
  		
  		$data['technical_id'] = $_REQUEST['technical_id'];
 		$data['page'] = 'knowledge_bank/add_control_measure';
		$this->load->view('admin/template',$data);
		
	}

	public function edit_control_measure()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(4);
		$data['technical_id'] = $this->uri->segment(3);
		$data['control_measure'] = $this->knowledgebankmodel->get_control_measure_by_id($id); 
		$data['page'] = 'knowledge_bank/edit_control_measure';
		$this->load->view('admin/template',$data);
	}

	public function update_control_measure()
	{
		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['control_measure'] = $this->knowledgebankmodel->get_control_measure_by_id($id); 

		$ch_unique = $this->knowledgebankmodel->check_unique_edit_control_measure('en_brand_name',$_REQUEST['en_brand_name'],$_REQUEST['technical_id'],$id); 
		if($ch_unique == 1) {
		   $is_unique =  '|is_unique[s_kb_control_measure.en_brand_name]';
		} else {
		   $is_unique =  '';
		}
	    $this->form_validation->set_rules('en_brand_name','Brand Name in English','required|trim'.$is_unique);

	    $ch_unique1 = $this->knowledgebankmodel->check_unique_edit_control_measure('hi_brand_name',$_REQUEST['hi_brand_name'],$_REQUEST['technical_id'],$id); 
		if($ch_unique1 == 1) {
		   $is_unique1 =  '|is_unique[s_kb_control_measure.hi_brand_name]';
		} else {
		   $is_unique1 =  '';
		}
	    $this->form_validation->set_rules('hi_brand_name','Brand Name in Hindi','required|trim'.$is_unique1);

	    $ch_unique2 = $this->knowledgebankmodel->check_unique_edit_control_measure('mr_brand_name',$_REQUEST['mr_brand_name'],$_REQUEST['technical_id'],$id); 
		if($ch_unique2 == 1) {
		   $is_unique2 =  '|is_unique[s_kb_control_measure.mr_brand_name]';
		} else {
		   $is_unique2 =  '';
		}
	    $this->form_validation->set_rules('mr_brand_name','Brand Name in Marathi','required|trim'.$is_unique2);
		
		$this->form_validation->set_rules('en_company_name','Company Name in English','required|trim');
		$this->form_validation->set_rules('hi_company_name','Company Name in Hindi','required|trim');
		$this->form_validation->set_rules('mr_company_name','Company Name in Marathi','required|trim');

		$this->form_validation->set_rules('en_dose','Dose in English','required|trim');
		$this->form_validation->set_rules('hi_dose','Dose in Hindi','required|trim');
		$this->form_validation->set_rules('mr_dose','Dose in Marathi','required|trim');

 		$this->form_validation->set_rules('en_cm_description','Description in English','required|trim');
 		$this->form_validation->set_rules('hi_cm_description','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_cm_description','Description in Marathi','required|trim');

		$this->form_validation->set_rules('en_link','URL Link in English','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('hi_link','URL Link in Hindi','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('mr_link','URL Link in Marathi','required|trim|callback_validnewsurl');
		
		$this->form_validation->set_rules('en_id','Description in English','required|trim');
 		$this->form_validation->set_rules('hi_id','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_id','Description in Marathi','required|trim');
		
		$this->form_validation->set_rules('en_description','Description in English','required|trim');
 		$this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');
		$this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_company_name' => ucfirst($_REQUEST['en_company_name']),
				'hi_company_name' => $_REQUEST['hi_company_name'],
				'mr_company_name' => $_REQUEST['mr_company_name'],
				'en_brand_name' => ucfirst($_REQUEST['en_brand_name']),
				'hi_brand_name' => $_REQUEST['hi_brand_name'],
				'mr_brand_name' => $_REQUEST['mr_brand_name'],
				'en_dose' => $_REQUEST['en_dose'],
				'hi_dose' => $_REQUEST['hi_dose'],
				'mr_dose' => $_REQUEST['mr_dose'],
				'en_cm_description' => $_REQUEST['en_cm_description'],
				'hi_cm_description' => $_REQUEST['hi_cm_description'],
				'mr_cm_description' => $_REQUEST['mr_cm_description'],
				'en_link' => $_REQUEST['en_link'],
				'hi_link' => $_REQUEST['hi_link'],
				'mr_link' => $_REQUEST['mr_link'],
				'en_id' => $_REQUEST['en_id'],
				'hi_id' => $_REQUEST['hi_id'],
				'mr_id' => $_REQUEST['mr_id'],
				'en_description' => $_REQUEST['en_description'],
				'hi_description' => $_REQUEST['hi_description'],
				'mr_description' => $_REQUEST['mr_description'], 
			);

			$this->load->library('upload');
			
			$config['upload_path']   = './uploads/control_measure/';
			$config['allowed_types'] = 'png|jpg|jpeg';

			if (!empty($_FILES['base_image']['name']))
			{
				$base_image = $this->mastermodel->get_field_val('id',$id,'s_kb_control_measure','base_image');
				if($base_image != '')
				{
					$path = './uploads/control_measure/'.$base_image;
					@unlink($path);
				}
				$new_name =rand().'_'.str_replace(' ', '-', $_FILES["base_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('base_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('base_image_error',$error['error']);
				}
				else
				{ 
					$params['base_image'] = $new_name;
				}
			}
			
			$check = $this->knowledgebankmodel->update_control_measure($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Control Measure has been updated Successfully..');
				redirect('admin/control-measure-list/'.$_REQUEST['technical_id']);
			}
		}
		$data['technical_id'] = $_REQUEST['technical_id'];
		$data['page'] = 'knowledge_bank/edit_control_measure';
		$this->load->view('admin/template',$data);
	}

	public function trash_control_measure()
	{
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$technical_id = $_REQUEST['technical_id'];
			$id = $_REQUEST['id'];

			$control_measure = $this->knowledgebankmodel->get_control_measure_by_id($id); 

			if($control_measure['base_image'] != '')
			{
				$path = './uploads/control_measure/'.$control_measure['base_image'];
				@unlink($path);
			}
			
			$this->db->where('id', $id);
			$this->db->delete("s_kb_control_measure");
			$this->session->set_flashdata('success', 'Control Measure has been Successfully Deleted.');
			redirect('admin/control-measure-list/'.$technical_id);
		}
	}

//end
}

	