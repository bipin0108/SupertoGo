<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_KnowledgebankController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->v_vendormodel->not_logged_in();
		$this->load->model('vendor/V_KnowledgebankModel','v_knowledgebankmodel');
        $this->load->model('admin/KnowledgebankModel','knowledgebankmodel');
		$this->load->model('admin/module/CropModel','cropmodel');
    }

    public function index()
    {
    	$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_knowledge_bank/list_vkb_crop';
		$this->load->view('vendor/template',$data);
    }

    public function kb_topic()
    {
        $this->v_vendormodel->CSRFVerify();
        $data['page'] = 'v_knowledge_bank/list_vkb_topic';
        $this->load->view('vendor/template',$data);  
    }

    public function vkb_subtopic()
    {
        $this->v_vendormodel->CSRFVerify();
        $data['page'] = 'v_knowledge_bank/list_vkb_subtopic';
        $this->load->view('vendor/template',$data); 
    }

    public function view_vkb_subtopic()
    {
        $this->v_vendormodel->CSRFVerify();
        $id = $this->uri->segment(4);
        $data['topic_id'] = $this->uri->segment(3);
        $data['subtopic'] = $this->v_knowledgebankmodel->get_kb_subtopic_by_id($id); 
        $data['page'] = 'v_knowledge_bank/view_vkb_subtopic';
        $this->load->view('vendor/template',$data);
    }

    //technical name
    public function list_technical()
    {
        $this->v_vendormodel->CSRFVerify();
        $data['page'] = 'v_knowledge_bank/list_vkb_technical';
        $this->load->view('vendor/template',$data);
    }

    //control measure
    public function list_control_measure()
    {
        $this->v_vendormodel->CSRFVerify();
        $data['page'] = 'v_knowledge_bank/list_vkb_control_measure';
        $this->load->view('vendor/template',$data);
    }

    public function create_control_measure($technical_id)
    {
        $this->v_vendormodel->CSRFVerify();
        $data['technical_id'] = $technical_id;
        $data['page'] = 'v_knowledge_bank/add_vkb_control_measure';
        $this->load->view('vendor/template',$data);
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

    public function get_main_vendor()
    {
        $created_by=$this->session->userdata[SESSION_VENDOR]['created_by'];
        if($created_by == 0)
        {
            $creater_id = $this->session->userdata[SESSION_VENDOR]['vendor_id'];
        }
        else
        {
            $this->db->select("*");
            $this->db->from('s_vendor');
            $this->db->where("vendor_id",$created_by);
            $result=$this->db->get();
            $user = $result->row_array();
            $creater_id = $user['vendor_id'];
        }   
        return $creater_id;
    }   

    public function add_control_measure()
    {
        $this->v_vendormodel->CSRFVerify();
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
                'created_by_type' => 'Vendor',
                'created_by_id' => $this->get_main_vendor(),
                'created_by_name' => $this->mastermodel->get_field_val('vendor_id',$this->get_main_vendor(),'s_vendor','name')

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
            
            $check = $this->v_knowledgebankmodel->add_control_measure($params);
            if($check)
            {
                $this->session->set_flashdata('success', 'Control Measure has been added Successfully..');
                redirect('vendor/control-measure-list/'.$_REQUEST['technical_id']);
            }
        }
        
        $data['technical_id'] = $_REQUEST['technical_id'];
        $data['page'] = 'v_knowledge_bank/add_vkb_control_measure';
        $this->load->view('vendor/template',$data);
        
    }

    public function edit_control_measure()
    {
        $this->v_vendormodel->CSRFVerify();
        $id = $this->uri->segment(4);
        $data['technical_id'] = $this->uri->segment(3);
        $data['control_measure'] = $this->v_knowledgebankmodel->get_control_measure_by_id($id); 
        $data['page'] = 'v_knowledge_bank/edit_vkb_control_measure';
        $this->load->view('vendor/template',$data);
    }

    public function update_control_measure()
    {
        $this->v_vendormodel->CSRFVerify();
        $id = $_REQUEST['id'];
        $data['control_measure'] = $this->v_knowledgebankmodel->get_control_measure_by_id($id); 

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
            
            $check = $this->v_knowledgebankmodel->update_control_measure($id,$params);
            if($check)
            {
                $this->session->set_flashdata('success', 'Control Measure has been updated Successfully..');
                redirect('vendor/control-measure-list/'.$_REQUEST['technical_id']);
            }
        }
        $data['technical_id'] = $_REQUEST['technical_id'];
        $data['page'] = 'v_knowledge_bank/edit_vkb_control_measure';
        $this->load->view('vendor/template',$data);
    }

    public function trash_control_measure()
    {
        $this->v_vendormodel->CSRFVerify();
        if(!empty($_REQUEST['id']))
        {
            $technical_id = $_REQUEST['technical_id'];
            $id = $_REQUEST['id'];

            $control_measure = $this->v_knowledgebankmodel->get_control_measure_by_id($id); 

            if($control_measure['base_image'] != '')
            {
                $path = './uploads/control_measure/'.$control_measure['base_image'];
                @unlink($path);
            }
            
            $this->db->where('id', $id);
            $this->db->delete("s_kb_control_measure");
            $this->session->set_flashdata('success', 'Control Measure has been Successfully Deleted.');
            redirect('vendor/control-measure-list/'.$technical_id);
        }
    }


 //end   
}    