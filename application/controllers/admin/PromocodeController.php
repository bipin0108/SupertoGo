<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PromocodeController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('promocode',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'promocode/list'; 
 		$data['promocode'] = $this->m_general->getRows("SELECT * FROM tbl_promocode WHERE 1 ORDER BY promo_id DESC"); 
		$this->load->view('admin/template',$data);
	}

	public function create_promocode(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'promocode/add';
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1");
		$this->load->view('admin/template',$data);
	}

 	public function add_promocode(){
 		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
		$this->form_validation->set_rules('promocode',lang('Promocode'),'required|trim|is_unique[tbl_promocode.promocode]');
		$this->form_validation->set_rules('discount_type',lang('Discount Type'),'required|trim'); 
		$this->form_validation->set_rules('discount',lang('Discount'),'required|trim'); 
		$this->form_validation->set_rules('min_price',lang('Min Price'),'required|trim'); 
		$this->form_validation->set_rules('start_date',lang('Start Date'),'required|trim'); 
		$this->form_validation->set_rules('end_date',lang('End Date'),'required|trim'); 
		$this->form_validation->set_rules('description',lang('Description'),'required|trim'); 

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params['promocode'] = $_REQUEST['promocode']; 
			$params['discount_type'] = $_REQUEST['discount_type']; 
			$params['discount'] = $_REQUEST['discount']; 
			$params['min_price'] = $_REQUEST['min_price']; 
			$params['start_date'] = $_REQUEST['start_date']; 
			$params['end_date'] = $_REQUEST['end_date']; 
			$params['description'] = $_REQUEST['description']; 
			$id = $this->m_general->insertRow('tbl_promocode',$params);
			$this->session->set_flashdata('success', lang('add_success'));
			redirect('admin/promocode-list');
		}
		$data['page'] = 'promocode/add';
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1");
		$this->load->view('admin/template',$data);
  	}

    public function edit_promocode()
	{
		$this->adminmodel->CSRFVerify();
		$promo_id = $this->uri->segment(3);
		$data['page'] = 'promocode/edit';
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1");
		$data['promocode'] = $this->m_general->getRow("SELECT * FROM tbl_promocode WHERE promo_id=?",array($promo_id));
		$this->load->view('admin/template',$data);
  	}

  	public function update_promocode()
  	{
		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
		$promo_id = $_REQUEST['id'];
		$data['promocode'] = $this->m_general->getRow("SELECT * FROM tbl_promocode WHERE promo_id=?",array($promo_id));
		$is_unique = '';
	   	if($_REQUEST['promocode'] != $data['promocode']['promocode']) {
		   $is_unique = '|is_unique[tbl_promocode.promocode]';
		}
		$this->form_validation->set_rules('promocode',lang('Promocode'),'required|trim'.$is_unique); 
		$this->form_validation->set_rules('discount_type',lang('Discount Type'),'required|trim'); 
		$this->form_validation->set_rules('discount',lang('Discount'),'required|trim'); 
		$this->form_validation->set_rules('min_price',lang('Min Price'),'required|trim'); 
		$this->form_validation->set_rules('start_date',lang('Start Date'),'required|trim'); 
		$this->form_validation->set_rules('end_date',lang('End Date'),'required|trim'); 
		$this->form_validation->set_rules('description',lang('Description'),'required|trim'); 

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false)
		{  
			//error
		}
		else
		{	
			$params['promocode'] = $_REQUEST['promocode'];
			$params['discount_type'] = $_REQUEST['discount_type']; 
			$params['discount'] = $_REQUEST['discount']; 
			$params['min_price'] = $_REQUEST['min_price']; 
			$params['start_date'] = $_REQUEST['start_date']; 
			$params['end_date'] = $_REQUEST['end_date']; 
			$params['description'] = $_REQUEST['description']; 
		 	$this->m_general->updateRow('tbl_promocode',$params,array("promo_id"=>$promo_id));
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/promocode-list');
		}
		$data['page'] = 'promocode/edit';
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1");
		$this->load->view('admin/template',$data);
  	}

	public function trash_promocode(){
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$promo_id = $_REQUEST['id'];
			$this->m_general->deleteRows('tbl_promocode',array('promo_id'=>$promo_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/promocode-list');
		}
	}

}



