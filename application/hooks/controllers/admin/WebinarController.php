<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WebinarController extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/WebinarModel','webinarmodel');
    }

    public function index()
    {
    	$this->adminmodel->CSRFVerify();
 		$data['page'] = 'webinar/list_webinar';
		$this->load->view('admin/template',$data);
    }

    public function create_webinar()
    {
        $this->adminmodel->CSRFVerify();
        $data['page'] = 'webinar/add_webinar';
        $this->load->view('admin/template',$data);
    }

    public function add_webinar()
    {
        $this->adminmodel->CSRFVerify();
        $this->form_validation->set_rules('en_title','Title in English','required|trim|is_unique[s_webinar.en_title]');
        $this->form_validation->set_rules('en_description','Description in English','required|trim');
        $this->form_validation->set_rules('hi_title','Title in Hindi','required|trim|is_unique[s_webinar.hi_title]');
        $this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');
        $this->form_validation->set_rules('mr_title','Title in Marathi','required|trim|is_unique[s_webinar.mr_title]');
        $this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');
        $this->form_validation->set_rules('price','Price','required|trim|numeric');
        if(empty($_FILES['base_image']['name'])){
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
                'slug' => str_replace(' ', '-', strtolower($_REQUEST['en_title'])),
                'en_title' => ucfirst($_REQUEST['en_title']), 
                'hi_title' => $_REQUEST['hi_title'],
                'mr_title' => $_REQUEST['mr_title'],
                'en_description' => $_REQUEST['en_description'],
                'hi_description' => $_REQUEST['hi_description'],
                'mr_description' => $_REQUEST['mr_description'], 
                'price' => $_REQUEST['price'], 
            );
            $this->load->library('upload');
            if (!is_dir('./uploads/webinar/')) {
                mkdir('./uploads/webinar', 0777, TRUE);
            }
           
            if (!empty($_FILES['base_image']['name']))
            {
                $config['upload_path']   = './uploads/webinar/';
                $config['allowed_types'] = 'png|jpg|jpeg';
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
           
            $webinar_id = $this->webinarmodel->add_webinar($params);
            if($webinar_id)
            {
                if (!is_dir('./uploads/webinar/'.$webinar_id)) {
                    mkdir('./uploads/webinar/'.$webinar_id, 0777, TRUE);
                }
                $config['upload_path']   = './uploads/webinar/'.$webinar_id;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $photo_arr = explode(',',$_REQUEST['photo_val']);
                foreach ($photo_arr as $val) {
                    $photo_param = array(
                        'webinar_id' => $webinar_id, 
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
                    
                    $this->webinarmodel->add_webinar_photo($photo_param);
                }   

                $video_arr = explode(',',$_REQUEST['video_val']);
                foreach ($video_arr as $val) {
                    $video_param = array(
                        'webinar_id' => $webinar_id, 
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
                    
                    $this->webinarmodel->add_webinar_video($video_param);
                }   
                $this->session->set_flashdata('success', 'Webinar has been added Successfully..');
                redirect('admin/webinar-list/');
            }
        }
        
        $data['page'] = 'webinar/add_webinar';
        $this->load->view('admin/template',$data);
    }

    public function edit_webinar()
    {
        $this->adminmodel->CSRFVerify();
        $id = $this->uri->segment(3);
        $data['webinar'] = $this->webinarmodel->get_webinar_by_id($id); 
        $data['page'] = 'webinar/edit_webinar';
        $this->load->view('admin/template',$data);
    }

    public function update_webinar()
    {
        $this->adminmodel->CSRFVerify();
        $id = $_REQUEST['id'];

        $data['webinar'] = $this->webinarmodel->get_webinar_by_id($id); 
        
        if($_REQUEST['en_title'] != $data['webinar']['en_title']) {
           $is_unique =  '|is_unique[s_webinar.en_title]';
        } else {
           $is_unique =  '';
        }
        $this->form_validation->set_rules('en_title','Title in English','required|trim'.$is_unique);
        
        if($_REQUEST['hi_title'] != $data['webinar']['hi_title']) {
           $is_unique2 =  '|is_unique[s_webinar.hi_title]';
        } else {
           $is_unique2 =  '';
        }
        $this->form_validation->set_rules('hi_title','Title in Hindi','required|trim'.$is_unique2);
        
        if($_REQUEST['mr_title'] != $data['webinar']['mr_title']) {
           $is_unique3 =  '|is_unique[s_webinar.mr_title]';
        } else {
           $is_unique3 =  '';
        }
        $this->form_validation->set_rules('mr_title','Title in Marathi','required|trim'.$is_unique3);

        $this->form_validation->set_rules('en_description','Description in English','required|trim');
        $this->form_validation->set_rules('hi_description','Description in Hindi','required|trim');
        $this->form_validation->set_rules('mr_description','Description in Marathi','required|trim');
        $this->form_validation->set_rules('price','Price','required|trim|numeric');

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
                'price' => $_REQUEST['price'], 
            );

            $this->load->library('upload');

            if(!is_dir('./uploads/webinar/')) {
                mkdir('./uploads/webinar/', 0777, TRUE);
            }
            
            if(!empty($_FILES['base_image']['name']))
            {
                $base_image = $this->mastermodel->get_field_val('id',$id,'s_webinar','base_image');
                if($base_image != '')
                {
                    $path = './uploads/webinar/'.$base_image;
                    @unlink($path);
                }
                $config['upload_path']   = './uploads/webinar/';
                $config['allowed_types'] = 'png|jpg|jpeg';  
                $new_name = rand().'_'.str_replace(' ', '-', $_FILES['base_image']['name']);
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
            //video
            $remove_video_arr = explode(',',$_REQUEST['remove_video']);
            foreach($remove_video_arr as $remove_val){
                $this->db->where('id', $remove_val);
                $this->db->delete("s_webinar_video");
            }
            $video_arr = explode(',',$_REQUEST['video_val']);
            foreach ($video_arr as $val){
                $this->db->where('id',$_REQUEST['video_id_'.$val]);
                $this->db->delete("s_webinar_video");
                $video_param = array(
                    'webinar_id' => $id, 
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
                $this->webinarmodel->add_webinar_video($video_param);
            }   
            //photo 
            $config1['allowed_types'] = 'png|jpg|jpeg';
            $config1['upload_path']   = './uploads/webinar/'.$id.'/';
            $remove_photo_arr = explode(',',$_REQUEST['remove_photo']);
            foreach($remove_photo_arr as $remove_val) {
                $img_path = $this->mastermodel->get_field_val('id',$remove_val,'s_webinar_photo','img_path');
                if($img_path != '')
                {
                    $path = './uploads/webinar/'.$id.'/'.$img_path;
                    @unlink($path);
                }
                $this->db->where('id', $remove_val);
                $this->db->delete("s_webinar_photo");
            }
            $photo_arr = explode(',',$_REQUEST['photo_val']);
            foreach($photo_arr as $val){
                $photo_param = array(
                    'webinar_id' => $id,   
                    'en_photo_title' => $_REQUEST['en_photo_title_'.$val],
                    'hi_photo_title' => $_REQUEST['hi_photo_title_'.$val],
                    'mr_photo_title' => $_REQUEST['mr_photo_title_'.$val],
                );
                if(!empty($_FILES['photofile_'.$val]['name']))
                {
                    if($_REQUEST['image_name_'.$val] != '0'){
                        $path = './uploads/webinar/'.$id.'/'.$_REQUEST['image_name_'.$val];
                        @unlink($path);
                        $this->db->where('id',$_REQUEST['photo_id_'.$val]);
                        $this->db->delete("s_webinar_photo");
                    }
                    $new_name =rand().'_'.str_replace(' ', '-',$_FILES["photofile_".$val]['name']); 
                    $config1['file_name'] = $new_name; 
                    $this->upload->initialize($config1);
                    $this->upload->do_upload('photofile_'.$val);
                    $photo_param['img_path'] = $new_name;
                }
                else{
                    $this->db->where('id',$_REQUEST['photo_id_'.$val]);
                    $this->db->delete("s_webinar_photo");
                    $photo_param['img_path'] = $_REQUEST['image_name_'.$val];
                }
                $this->webinarmodel->add_webinar_photo($photo_param);
            }
            //subtopic
            $check = $this->webinarmodel->update_webinar($id,$params);
            if($check)
            {
                $this->session->set_flashdata('success', 'Webinar has been updated Successfully..');
                redirect('admin/webinar-list');
            }
        }
        $data['page'] = 'webinar/edit_webinar';
        $this->load->view('admin/template',$data);
    }

    public function trash_webinar()
    {
        $this->adminmodel->CSRFVerify();
        if(!empty($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];

            $base_image = $this->mastermodel->get_field_val('id',$id,'s_webinar','base_image');
            if($base_image != '')
            {
                $path = './uploads/webinar/'.$base_image;
                @unlink($path);
            }  

            $this->db->where('webinar_id', $id);
            $this->db->delete("s_webinar_photo");

            $this->db->where('webinar_id', $id);
            $this->db->delete("s_webinar_video");

            $this->db->where('webinar_id', $id);
            $this->db->delete("s_webinar_video_series");

            $webinar_path = './uploads/webinar/'.$id;
            $this->load->helper("file");
            @delete_files($webinar_path, true);
            @rmdir($webinar_path);

            $this->db->where('id', $id);
            $this->db->delete("s_webinar");
            
            $this->session->set_flashdata('success', 'Webinar has been Successfully Deleted.');
            redirect('admin/webinar-list/');
        }
    }

    public function webinar_video_list()
    {
        $this->adminmodel->CSRFVerify();
        $data['page'] = 'webinar/list_webinar_video';
        $this->load->view('admin/template',$data);
    }

    public function create_webinar_video()
    {
        $this->adminmodel->CSRFVerify();
        $webinar_id = $this->uri->segment(3);
        $data['webinar_id'] = $webinar_id;
        $data['page'] = 'webinar/add_webinar_video';
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

    public function add_webinar_video()
    {
        $this->adminmodel->CSRFVerify();
        $webinar_id = $_REQUEST['webinar_id'];

        $ch_unique_sub = $this->webinarmodel->check_unique_webinar_video('en_link',$_REQUEST['en_link'],$webinar_id); 
        if($ch_unique_sub == 1) {
           $is_unique =  '|is_unique[s_webinar_video_series.en_link]';
        } else {
           $is_unique =  '';
        }
        $this->form_validation->set_rules('en_link','Link in English','required|trim|callback_validnewsurl'.$is_unique);

        $ch_unique_sub1 = $this->webinarmodel->check_unique_webinar_video('hi_link',$_REQUEST['hi_link'],$webinar_id); 
        if($ch_unique_sub1 == 1) {
           $is_unique1 =  '|is_unique[s_webinar_video_series.hi_link]';
        } else {
           $is_unique1 =  '';
        }
        $this->form_validation->set_rules('hi_link','Link in Hindi','required|trim|callback_validnewsurl'.$is_unique1);

        $ch_unique_sub2 = $this->webinarmodel->check_unique_webinar_video('mr_link',$_REQUEST['mr_link'],$webinar_id); 
        if($ch_unique_sub2 == 1) {
           $is_unique2 =  '|is_unique[s_webinar_video_series.mr_link]';
        } else {
           $is_unique2 =  '';
        }
        $this->form_validation->set_rules('mr_link','Link in Marathi','required|trim|callback_validnewsurl'.$is_unique2);

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
                'webinar_id' => $_REQUEST['webinar_id'],
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
            $check = $this->webinarmodel->add_webinar_video_series($params);
            if($check)
            {
                $this->session->set_flashdata('success', 'Webinar Video has been added Successfully..');
                redirect('admin/webinar-video-list/'.$webinar_id);
            }
        }
        $data['webinar_id'] = $webinar_id;
        $data['page'] = 'webinar/add_webinar_video';
        $this->load->view('admin/template',$data);
    }

    public function edit_webinar_video()
    {
        $this->adminmodel->CSRFVerify();
        $id = $this->uri->segment(3);
        $data['video_series'] = $this->webinarmodel->get_webinar_video_series_by_id($id); 
        $data['page'] = 'webinar/edit_webinar_video';
        $this->load->view('admin/template',$data);    
    }

    public function update_webinar_video()
    {
        $this->adminmodel->CSRFVerify();

        $webinar_id = $_REQUEST['webinar_id'];
        $id = $_REQUEST['id'];
        

        $ch_unique_sub = $this->webinarmodel->check_edit_unique_webinar_video('en_link',$_REQUEST['en_link'],$webinar_id,$id); 
        if($ch_unique_sub == 1) {
           $is_unique =  '|is_unique[s_webinar_video_series.en_link]';
        } else {
           $is_unique =  '';
        }
        $this->form_validation->set_rules('en_link','Link in English','required|trim|callback_validnewsurl'.$is_unique);

        $ch_unique_sub1 = $this->webinarmodel->check_edit_unique_webinar_video('hi_link',$_REQUEST['hi_link'],$webinar_id,$id); 
        if($ch_unique_sub1 == 1) {
           $is_unique1 =  '|is_unique[s_webinar_video_series.hi_link]';
        } else {
           $is_unique1 =  '';
        }
        $this->form_validation->set_rules('hi_link','Link in Hindi','required|trim|callback_validnewsurl'.$is_unique1);

        $ch_unique_sub2 = $this->webinarmodel->check_edit_unique_webinar_video('mr_link',$_REQUEST['mr_link'],$webinar_id,$id); 
        if($ch_unique_sub2 == 1) {
           $is_unique2 =  '|is_unique[s_webinar_video_series.mr_link]';
        } else {
           $is_unique2 =  '';
        }
        $this->form_validation->set_rules('mr_link','Link in Marathi','required|trim|callback_validnewsurl'.$is_unique2);

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
            $check = $this->webinarmodel->update_webinar_video_series($id,$params);
            if($check)
            {
                $this->session->set_flashdata('success', 'Webinar Video has been updated Successfully..');
                redirect('admin/webinar-video-list/'.$webinar_id);
            }
        }
        $data['video_series'] = $this->webinarmodel->get_webinar_video_series_by_id($id); 
        $data['page'] = 'webinar/edit_webinar_video';
        $this->load->view('admin/template',$data);    
    }

    public function trash_webinar_video()
    {
        $this->adminmodel->CSRFVerify();
        if(!empty($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
            $webinar_id = $_REQUEST['webinar_id'];

            $this->db->where('id', $id);
            $this->db->delete("s_webinar_video_series");

            $this->session->set_flashdata('success', 'Webinar has been Successfully Deleted.');
            redirect('admin/webinar-video-list/'.$webinar_id);
        }
    }

    public function webinar_payment_history()
    {
        $this->adminmodel->CSRFVerify();
        $data['page'] = 'webinar/list_webinar_payment';
        $this->load->view('admin/template',$data);
    }

//end	
}
?>