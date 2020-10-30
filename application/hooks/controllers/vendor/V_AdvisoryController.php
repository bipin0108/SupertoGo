<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_AdvisoryController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->v_vendormodel->not_logged_in();
		$this->load->model('vendor/V_AdvisoryModel','v_advisorymodel');
        $this->load->model('admin/MoleculeModel','moleculemodel');
        $this->load->model('admin/module/ProblemAreaModel','problemareamodel');
        $this->load->model('admin/module/CropModel','cropmodel');
        $this->load->model('admin/KnowledgebankModel','knowledgebankmodel');
        $this->load->model('admin/UserModel','usermodel');
    }

    public function list_advisory_request_mainvendor()
    {
    	$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_advisory/list_advisory_main';
		$this->load->view('vendor/template',$data);
    }

    public function list_assigned_advisory_request_mainvendor()
    {
        $this->v_vendormodel->CSRFVerify();
        $data['page'] = 'v_advisory/list_assigned_advisory_main';
        $this->load->view('vendor/template',$data);
    }

    public function list_advisory_request_subvendor()
    {
        $this->v_vendormodel->CSRFVerify();
        $data['page'] = 'v_advisory/list_advisory_subvendor';
        $this->load->view('vendor/template',$data);
    }

    public function today_follow_up_request()
    {
        // echo "hksjd";
        // die;
        $this->v_vendormodel->CSRFVerify();
        $data['page'] = 'v_advisory/list_todayfollowup';
        $this->load->view('vendor/template',$data);
    }

    public function view_advisory_request()
    {
    	$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_advisory/view_advisory';
		$this->load->view('vendor/template',$data);
    }

    public function change_advisory_request_status()
    {
        $params = array(
                'status' => $_REQUEST['status'],
            );
        $advisory_id= $_REQUEST['advisory_id'];
        $check = $this->v_advisorymodel->update_advisory_request($advisory_id,$params);
        if($check)
        {
            $this->session->set_flashdata('success', 'Requset Status has been updated Successfully..');
            redirect('vendor/view-advisory-request/'.$advisory_id);
        } 
    }

    public function change_advisory_followup_status()
    {
        $params = array(
                'status' => 'Followup',
                'follow_up_date' => date('Y-m-d',strtotime(str_replace('/', '-', $_REQUEST['follow_up_date']))),
            );
        $advisory_id= $_REQUEST['advisory_id'];
        $check = $this->v_advisorymodel->update_advisory_request($advisory_id,$params);
        if($check)
        {
            $this->session->set_flashdata('success', 'Requset Status has been updated Successfully..');
            redirect('vendor/view-advisory-request/'.$advisory_id);
        } 
    }

    public function get_problem_type_of_activity_ajax()
    {
        $activity_type = $_REQUEST['activity_type'];
        $en_problem_area = $_REQUEST['problem_area'];

        $this->db->distinct();
        $this->db->select('en_problem_type');
        $this->db->where('activity_type', $activity_type);
        $this->db->where('en_problem_area', $en_problem_area);
        $query = $this->db->get('s_molecule');
        $output = '<option value="">Select Problem Type</option>';
        foreach($query->result() as $row)
        {
            if(!empty($row->en_problem_type)){
                $output .= '<option value="'.$row->en_problem_type.'" >'.$row->en_problem_type.'</option>';
            }
        }
        echo $output;
    }

    public function get_problem_of_problem_type_ajax()
    {
        $activity_type = $_REQUEST['activity_type'];
        $problem_type = $_REQUEST['problem_type'];
        $en_problem_area = $_REQUEST['problem_area'];

        $this->db->distinct();
        $this->db->select('en_problem');
        $this->db->where('activity_type', $activity_type);
        $this->db->where('en_problem_area', $en_problem_area);
        $this->db->where('en_problem_type', $problem_type);
        $query = $this->db->get('s_molecule');
        $output = '<option value="">Select Problem</option>';
        foreach($query->result() as $row)
        {
            if(!empty($row->en_problem)){
                $output .= '<option value="'.$row->en_problem.'" >'.$row->en_problem.'</option>';
            }
        }
        echo $output;
    }

    public function find_solution_ajax()
    {
        $activity_type = $_REQUEST['activity_type'];
        $en_problem_type = $_REQUEST['problem_type'];
        $en_problem_area = $_REQUEST['problem_area'];
        $en_problem = $_REQUEST['problem'];

        $this->db->select('*');
        $this->db->where('activity_type', $activity_type);
        $this->db->where('en_problem_area', $en_problem_area);
        $this->db->where('en_problem_type', $en_problem_type);
        $this->db->where('en_problem', $en_problem);
        $query = $this->db->get('s_molecule');
        $solution = $query->result();
        $output = '';
        if(count($solution) > 0)
        {
            $output .='<table class="table table-bordered"><tbody>';
            $output .='<tr style="background-color:#333;color:#fff"><th></th><th>Chemical list</th><th>Quantity</th></tr>';
            foreach($solution as $sol) 
            {
                if(!empty($sol->en_brand))
                {
                    $brand = '['.$sol->en_brand.']';
                }
                else{
                    $brand = '';
                }
                $output .= '<tr>';
                $output .= '<td><input type="checkbox"  class="ch-chemical" id="cchq_'.$sol->id.'" data-i="'.$sol->id.'"></td>';
                $output .= '<td>'.$sol->en_technical_name.' '.$brand.'</td>';
                $output .= '<td><input type="number" id="dose_'.$sol->id.'" value="'.$sol->en_dose.'"> '.$sol->en_unit.'</td>';
                $output .= '</tr>';
            }            
            $output .='</tbody><table>';
            $output .='';
        }
        else
        {
            $output = 'Chemicals not avialable for this selection!';
        }
        echo $output;
    }

    //add chemicals
    public function add_solution_ajax()
    {
        $chem1_arr = explode(',',$_REQUEST['chem1_arr']);
        $dosage_arr = explode(',',$_REQUEST['dosage_arr']);
        $btn_id = $_REQUEST['btn_id'];
        $date = $_REQUEST['date'];
        $this->db->select('activity_type,en_problem,en_technical_name,en_brand,en_dose,en_unit');
        $this->db->where_in('id', $chem1_arr);
        $query = $this->db->get('s_molecule');
        $solution = $query->result();
        $count = count($solution);
        $output = '';
        if($count > 0){
            if($btn_id=='add_solution'){
                foreach ($solution as $idx=>$sol) {
                    if(!empty($sol->en_brand))
                    {
                        $brand = '['.$sol->en_brand.']';
                    }
                    else{
                        $brand = '';
                    }
                    $output .= '<tr id="">
                        <td >'.$date.'
                        <input id="" type="hidden"
                            data-date="'.$date.'"
                            data-activity_type="'.$sol->activity_type.'"
                            data-problem="'.$sol->en_problem.'"
                            data-chemical="'.$sol->en_technical_name.' '.$brand.'"
                            data-dosage="'.$dosage_arr[$idx].''.$sol->en_unit.'"
                        ></td>
                        <td>'.$sol->activity_type.'</td>
                        <td>'.$sol->en_problem.'</td>
                        <td>'.$sol->en_technical_name.' '.$brand.'</td>
                        <td>'.$dosage_arr[$idx].''.$sol->en_unit.'</td>
                        <td><button class="btn btn-primary remove"><i class="fa fa-trash"></i></button></td>
                    </tr>';
                }
            }
            else
            {   $chemical = '';
                foreach ($solution as $idx=>$sol){
                    if(!empty($sol->en_brand))
                    {
                        $brand = '['.$sol->en_brand.']';
                    }
                    else{
                        $brand = '';
                    }
                    $sol_count =  $count-1;
                    $plus_sign = "";
                    if($idx != $sol_count){$plus_sign = '+ ';}
                    $chemical .= $sol->en_technical_name.' '.$brand.' '.$dosage_arr[$idx].''.$sol->en_unit.' '.$plus_sign;
                }
                $output .= '<tr id="">
                    <td>'.$date.'
                        <input id="" type="hidden"
                        data-date="'.$date.'"
                        data-activity_type="'.$sol->activity_type.'"
                        data-problem="'.$sol->en_problem.'"
                        data-chemical="'.$chemical.'"
                        data-dosage="-"
                        ></td>
                    <td>'.$sol->activity_type.'</td>
                    <td>'.$sol->en_problem.'</td>
                    <td>'.$chemical.'</td>
                    <td>-</td>
                    <td><button class="btn btn-primary remove"><i class="fa fa-trash"></i></button></td>
                </tr>';
            }
        }
        echo $output;
    }

    public function save_message_ajax()
    {
        $params = array(
            'advisory_id' => $_REQUEST['advisory_id'], 
            'vendor_id' => $this->session->userdata[SESSION_VENDOR]['vendor_id'],
            'farmer_id' => $_REQUEST['farmer_id'],
            'message' => $_REQUEST['message'],
            'send_by' => 'vendor',
        );

        $advisory_id= $_REQUEST['advisory_id'];
        $response = $this->v_advisorymodel->get_response_by_advisory($advisory_id);
        if(count($response) == 0)
        {
            $this->v_advisorymodel->update_advisory_request($advisory_id,array('status' => 'Ongoing'));
        }
        $check = $this->v_advisorymodel->add_message($params);
        echo $check;
    }

    public function topic_by_crop_ajax()
    {
        $crop_val = $_REQUEST['crop_val'];
        $topic = $this->knowledgebankmodel->get_all_kb_topic($crop_val);
        $output = '<option value="">Select Topic</option>';
        foreach($topic as $row)
        {
            $output .= '<option value="'.$row->id.'" >'.$row->en_name.'</option>';
        }
        echo $output;
    }

    public function subtopic_by_topic_ajax()
    {
        $topic_val = $_REQUEST['topic_val'];
        $subtopic = $this->knowledgebankmodel->get_all_kb_subtopic($topic_val);
        $output = '<option value="">Select Topic</option>';
        foreach($subtopic as $row)
        {
            $output .= '<option value="'.$row->id.'" >'.$row->en_title.'</option>';
        }
        echo $output;
    }
//end    
}    