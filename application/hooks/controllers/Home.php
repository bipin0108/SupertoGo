<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller 
{
	public function __construct()
    {
		parent::__construct();
		// $this->adminmodel->not_logged_in();
    }

	public function index()
	{	
		$data['page'] = 'index';
		$this->load->view('frontend/template',$data);
	}

	public function login()
	{	
		$this->is_logged_in();
		if(!empty($_POST)){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_type', 'User Type', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'required');  
			$this->form_validation->set_rules('pin', 'Pin', 'required'); 
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;"><span>','</span></div>');
			
			if($this->form_validation->run() == FALSE)  
			{  
				//Error
			}  
			else  
			{  
				$user_type = $this->input->post('user_type');
				$mobile = $this->input->post('mobile');  
				$pin = $this->input->post('pin');  
				$sql = "SELECT * FROM s_users WHERE user_type = ? AND mobile = ? AND pin = ? ";
				$user = $this->m_general->getRow($sql,array($user_type,$mobile,$pin));

				if($user == TRUE)  
				{    
					if(empty($user['is_verify'])){
						$this->session->set_flashdata('v_error', '<h6><i class="icon fa fa-ban"></i> Error! Your mobile number is not verified yet.</h6>Please verify your mobile number.');	
					}else{
						$userdata = [
							'id'  => $user['user_id'],
							'name' 	=> $user['first_name']." ".$user['last_name'],
							'mobile' => $user['mobile'],
							'user_type' => $user['user_type'],
							'logged_in' => 'TRUE'
						];
						$this->session->set_userdata(SESSION_USER,$userdata);
						redirect('dashboard');  
					}
				}  
				else  
				{  
					$this->session->set_flashdata('error', '<h6><i class="icon fa fa-ban"></i> Error! Invalid User Type, Mobile No. and Pin.</h6>Please try again or later.'); 
				}  
			}
		}
		$data['page'] = 'login';
		$this->load->view('frontend/login',$data);
	}

	public function sign_up()
	{	
		$data['page'] = 'signup';
		$this->load->view('frontend/signup',$data);
	}

	public function register()
	{	
		$this->is_logged_in();
		if(!empty($_POST)){ 
			$this->form_validation->set_rules('first_name', 'First Name', 'required'); 
			$this->form_validation->set_rules('middle_name', 'Middle Name', 'required'); 
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');  
			$this->form_validation->set_rules('mobile', 'Mobile Number','required|is_unique[s_users.mobile]|regex_match[/^[0-9]{10}$/]'); 
			$this->form_validation->set_rules('pin', 'Pin', 'required|min_length[6]|max_length[6]');
			$this->form_validation->set_rules('re-pin', 'Confirm Pin', 'required|matches[pin]');
			$this->form_validation->set_rules('referral_moblie', 'Referral Moblie No', 'required|callback_referral_no_check'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error 
			}
			else
			{
				
				$otp = $this->generateOTP();
				$message = "Hello ".ucfirst(trim($_REQUEST['first_name']))." ".ucfirst(trim($_REQUEST['last_name']))."! You have register to the SMARTCROP. ".$otp." is your mobile number verification code.";
				if($this->send_otp($_REQUEST['mobile'], $message, $otp)){

					$data = array(
						'first_name' => ucfirst(trim($_REQUEST['first_name'])),
						'middle_name' => ucfirst(trim($_REQUEST['middle_name'])),
						'last_name'  => ucfirst(trim($_REQUEST['last_name'])),
						'mobile'  => trim($_REQUEST['mobile']),
						'pin' => $_REQUEST['pin'],
						'otp_code' => $otp,
						'referral_code' => $_REQUEST['referral_moblie'],
						'created_at' => date('Y-m-d H:i:s', time()),
						'updated_at' => date('Y-m-d H:i:s', time())
					);
					$id = $this->m_general->insertRow('s_users', $data);
					if(!empty($id))
					{
						redirect('verification');
					}
				}
			}

		}
		$data['page'] = 'signup';
		$this->load->view('frontend/signup',$data);
	}

	public function verification()
	{	
		$this->is_logged_in();
		if(!empty($_POST)){ 
			$this->form_validation->set_rules('otp', 'Verification Code', 'required|callback_otp_check'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$data = array(
					'is_active' => '1',
					'is_verify' => '1',
					'updated_at' => date('Y-m-d H:i:s', time())
				);
				$id = $this->m_general->updateRow('s_users',$data,array('otp_code'=>$_REQUEST['otp']));
				if(!empty($id))
				{
					$this->session->set_flashdata('success', '<h6>Your Mobile number is verified successfully.</h6>');
					redirect('login');
				}
			}
		}
		$data['page'] = 'verification';
		$this->load->view('frontend/verification',$data);
	}

	public function forgot()
	{	
		$this->is_logged_in();
		if(!empty($_POST)){
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]|callback_referral_no_check'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$otp = $this->generateOTP();
				$message = "Welcome to SMARTCROP! You have requested for reset pin. ".$otp." is your new pin verification code.";
				if($this->send_otp($_REQUEST['mobile'], $message, $otp)){
					$data = array(
						'otp_code' => $otp,
						'updated_at' => date('Y-m-d H:i:s', time())
					);
					$id = $this->m_general->updateRow('s_users',$data,array('mobile'=>$_REQUEST['mobile']));
					if(!empty($id))
					{
						redirect('confirm-otp');
					}
				}
			}
		}
		$data['page'] = 'forgot_password';
		$this->load->view('frontend/forgot_password',$data);
	}

	public function confirm_otp()
	{	
		$this->is_logged_in();
		if(!empty($_POST)){ 
			$this->form_validation->set_rules('otp', 'Verification Code', 'required|callback_otp_check'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$sql = "SELECT * FROM s_users WHERE otp_code = ? ";
				$check = $this->m_general->getRow($sql,array($_POST['otp']));
				$this->session->set_flashdata('success', '<h6>Now You can reset your pin.</h6>');
				redirect('reset-password/'.$check['user_id']);
			}
		}
		$data['page'] = 'confirm_otp';
		$this->load->view('frontend/confirm_otp',$data);
	}

	public function reset_password($id){

		$this->is_logged_in();
		if(!empty($_POST)){
			$this->form_validation->set_rules('new_pin', 'New Pin', 'required|min_length[6]|max_length[6]'); 
			$this->form_validation->set_rules('confirm_pin', 'Confirm Pin', 'required|matches[new_pin]'); 
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
			if($this->form_validation->run() == false)  
			{  
				//Error
			}
			else
			{
				$data = array(
					'pin' => $_REQUEST['new_pin'],
					'updated_at' => date('Y-m-d H:i:s', time())
				);
				$id = $this->m_general->updateRow('s_users',$data,array('user_id'=>$id));
				if(!empty($id))
				{
					$this->session->set_flashdata('success', '<h6><i class="icon fa fa-check"></i> Success! Your pin is reset successfully.</h6>Please you can login now.');
					redirect('login');
				}
			}
		}

		$data['page'] = 'reset_password';
		$this->load->view('frontend/reset_password',$data);
	}

	public function referral_no_check($referral_no) 
	{
    	// callback function to perform terminal login  
    	$sql = "SELECT * FROM s_users WHERE mobile = ? ";
		$check = $this->m_general->getRow($sql,array($referral_no));
        if (!empty($check)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('referral_no_check', 'Invalid {field}.');
            return FALSE;
        }
    }

    public function otp_check($otp) 
	{
    	// callback function to perform terminal verification  
    	$sql = "SELECT * FROM s_users WHERE otp_code = ? ";
		$check = $this->m_general->getRow($sql,array($otp));
        if (!empty($check)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('otp_check', 'Invalid {field}.');
            return FALSE;
        }
    }

	public function about_us()
	{	
		$data['page'] = 'about_us';
		$this->load->view('frontend/template',$data);
	}

	public function contact()
	{	
		$data['page'] = 'contact';
		$this->load->view('frontend/template',$data);
	}

	public function dashboard()
	{	
		if (empty($this->session->userdata[SESSION_USER]['id'])) {
			redirect('login');
		}
		// profile
		$id = $this->session->userdata[SESSION_USER]['id'];
		$profile = "SELECT * FROM s_users WHERE user_id = ? ";
		$data['user'] = $this->m_general->getRow($profile,array($id));
		if($data['user']['birth_date'] != '0000-00-00'){
			$data['age']=$this->age_calculate($data['user']['birth_date']);
		}else{
			$data['age']='';
		}
		// plots
		$plots = "SELECT f.* ,c.en_crop_name as crop_name,v.en_name as variety_name ,p.en_name as 	plot_area_unit ,su.en_name as spacing_unit ,pm.en_name as planting_method ,m.en_name as planting_material ,st.en_name as soil_type ,ws.en_name as water_source
		    FROM s_farmer_plot as f 
		    LEFT JOIN s_crops as c ON f.crop_id = c.crop_id
		    LEFT JOIN s_variety as v ON f.variety_id = v.variety_id
		    LEFT JOIN s_plot_area_unit as p ON f.plot_area_unit_id = p.id
		    LEFT JOIN s_spacing_unit as su ON f.spacing_unit_id = su.id
		    LEFT JOIN s_planting_method as pm ON f.planting_method_id = pm.id
		    LEFT JOIN s_planting_material as m ON f.planting_material_id = m.id
		    LEFT JOIN s_soil_type as st ON f.soil_type_id = st.id
		    LEFT JOIN s_water_source as ws ON f.water_source_id = ws.id
		    ORDER BY f.plot_id ASC";
		$data['plots'] = $this->m_general->getRows($plots);

		// crops
		$crops = "SELECT * FROM s_crops";
		$data['crops'] = $this->m_general->getRows($crops);

		$data['page'] = 'dashboard';
		$this->load->view('frontend/template',$data);
	}

	public function update_profile()
  	{
  		// profile
  		$id = $_REQUEST['id'];
		$profile = "SELECT * FROM s_users WHERE user_id = ? ";
		$data['user'] = $this->m_general->getRow($profile,array($id));
		$data['age']=$this->age_calculate($data['user']['birth_date']);
		// plots
		$plots = "SELECT * FROM s_plot_area_unit ORDER BY id ASC";
		$data['plots'] = $this->m_general->getRows($plots);

		$this->form_validation->set_rules('first_name', 'First Name', 'required'); 
		$this->form_validation->set_rules('middle_name', 'Middle Name', 'required'); 
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');  
		$this->form_validation->set_rules('gender', 'Gender', 'required');  
		$this->form_validation->set_rules('birth_date', 'Date of Birth', 'required'); 
		$this->form_validation->set_rules('pincode', 'Pincode', 'required');  
		$this->form_validation->set_rules('city','City','required');  
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('district','District','required');  
		$this->form_validation->set_rules('village','Village','required'); 
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)
		{  
			//error
		}
		else
		{
			$params = array(
				'first_name' => trim($_REQUEST['first_name']),
				'middle_name' => trim($_REQUEST['middle_name']),
				'last_name' => trim($_REQUEST['last_name']),
				'gender' => trim($_REQUEST['gender']), 
				'birth_date' => trim($_REQUEST['birth_date']),
				'pincode' => trim($_REQUEST['pincode']),
				'city' => trim($_REQUEST['city']),
				'state' => trim($_REQUEST['state']),
				'district' => trim($_REQUEST['district']),
				'village' => trim($_REQUEST['village']),
			);

			if(!empty($_FILES['profile_image']['name'])){
				$img = time()."_".$_FILES['profile_image']['name'];
				$config['upload_path']   = './uploads/user_profiles/';
				$config['allowed_types'] = 'jpg|png|jpeg'; 
				$config['file_name'] = $img;
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('profile_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				$params['profile_image'] = $img;
				$img_file = $this->upload->data();
			}
			$check = $this->m_general->updateRow('s_users',$params,array('user_id'=>$id));
			if($check)
			{
				$this->session->set_flashdata('update_success', 'Profile has been updated Successfully..');
				redirect('dashboard');
			}
		}
		redirect('dashboard');
		$data['page'] = 'dashboard';
		$this->load->view('frontend/template',$data);
  	}

  	public function create_plot()
	{	
		// crops
		$crops = "SELECT * FROM s_crops";
		$data['crops'] = $this->m_general->getRows($crops);

		// plot_area_unit
		$plot_area_unit = "SELECT * FROM s_plot_area_unit";
		$data['plot_area_unit'] = $this->m_general->getRows($plot_area_unit);

		// spacing_unit
		$spacing_unit = "SELECT * FROM s_spacing_unit";
		$data['spacing_unit'] = $this->m_general->getRows($spacing_unit);

		// planting_method
		$planting_method = "SELECT * FROM s_planting_method";
		$data['planting_method'] = $this->m_general->getRows($planting_method);

		// planting_material
		$planting_material = "SELECT * FROM s_planting_material";
		$data['planting_material'] = $this->m_general->getRows($planting_material);

		// Irrigation Source
		$irrigation_source = "SELECT * FROM s_irrigation_source";
		$data['irrigation_source'] = $this->m_general->getRows($irrigation_source);

		// filtration_system
		$filtration_system = "SELECT * FROM s_filtration_system";
		$data['filtration_system'] = $this->m_general->getRows($filtration_system);

		// fertigation_equipment
		$fertigation_equipment = "SELECT * FROM s_fertigation_equipment";
		$data['fertigation_equipment'] = $this->m_general->getRows($fertigation_equipment);

		// soil_type
		$soil_type = "SELECT * FROM s_soil_type";
		$data['soil_type'] = $this->m_general->getRows($soil_type);

		// water_source
		$water_source = "SELECT * FROM s_water_source";
		$data['water_source'] = $this->m_general->getRows($water_source);

		// bacterial_blight_intensity
		$bacterial_blight_intensity = "SELECT * FROM s_bacterial_blight_intensity";
		$data['bacterial_blight_intensity'] = $this->m_general->getRows($bacterial_blight_intensity);

		if(!empty($_POST)){
			$this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric|max_length[6]|min_length[6]');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required');
			$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

			if($this->form_validation->run() == false)
			{  
				//error
			}
			else
			{

				$params['plot_name'] = $_REQUEST['ploatname'];
				$params['crop_id'] = $_REQUEST['crops'];
				$params['variety_id'] = $_REQUEST['variety'];
				$params['area_of_plot'] = $_REQUEST['areaofploat'];
				$params['plot_area_unit_id'] = $_REQUEST['areaunit'];
				$params['pincode'] = $_REQUEST['pincode'];
				$params['state'] = $_REQUEST['state'];
				$params['district'] = $_REQUEST['district'];
				$params['city'] = $_REQUEST['city'];
				$params['village'] = $_REQUEST['village'];
				$params['row_to_row_distance'] = $_REQUEST['row2rowdist'];
				$params['plant_to_plant_distance'] = $_REQUEST['plant2plantdist'];
				$params['spacing_unit_id'] = $_REQUEST['spacingunit'];
				$params['num_of_plant'] = $_REQUEST['no_of_plants'];
				$params['planting_date'] = $_REQUEST['planting_date'];
				$params['age_of_plant'] = $this->age_calculate($_REQUEST['planting_date']);
				$params['planting_method_id'] = $_REQUEST['plantingmethod'];
				$params['planting_material_id'] = $_REQUEST['plantingmaterial'];
				$params['defoliation_date'] = $_REQUEST['defoliation_date'];
				$params['first_irrigation_date'] = $_REQUEST['first_irrigation_date'];
				$params['last_year_average_plant_kg'] = $_REQUEST['last_year_average_plant_kg'];
				$params['this_year_expected_average_plant_kg'] = $_REQUEST['this_year_expected_average_plant_kg'];
				if (!empty($_REQUEST['irrigation_source'])) {
					$irs_count = count($_REQUEST['irrigation_source']);
					$arr=array();
					for($i = 0; $i < $irs_count; $i++){
						$irrigation_source_ids = $_REQUEST['irrigation_source'][$i];
						array_push($arr,$irrigation_source_ids);
					}
					$params['irrigation_source_ids'] = implode(',', $arr);
				}

				$params['irrigation_type'] = $_REQUEST['irrigation_type'];

				if (!empty($_REQUEST['number_of_laterals_per_plant'])) {
					$params['num_of_laterals_per_plant'] = $_REQUEST['number_of_laterals_per_plant'];
				}
				if (!empty($_REQUEST['lateral_type'])) {
					$params['lateral_type'] = $_REQUEST['lateral_type'];
				}
				if (!empty($_REQUEST['dripper_spacing'])) {
					$params['dripper_spacing_cm'] = $_REQUEST['dripper_spacing'];
				}
				if (!empty($_REQUEST['number_of_drippers_per_plant'])) {
					$params['num_of_drippers_per_plant'] = $_REQUEST['number_of_drippers_per_plant'];
				}
				if (!empty($_REQUEST['dripper_discharge'])) {
					$params['dripper_discharge_liter_hour'] = $_REQUEST['dripper_discharge'];
				}
				if (!empty($_REQUEST['filtration_system'])) {
					$fs_count = count($_REQUEST['filtration_system']);
					$arr=array();
					for($i = 0; $i < $fs_count; $i++){
						$filtration_system_ids = $_REQUEST['filtration_system'][$i];
						array_push($arr,$filtration_system_ids);
					}
					$params['filtration_system_ids'] = implode(',', $arr);
				}
				if (!empty($_REQUEST['fertigation_equipment'])) {
					$fe_count = count($_REQUEST['fertigation_equipment']);
					$arr=array();
					for($i = 0; $i < $fe_count; $i++){
						$fertigation_equipment_ids = $_REQUEST['fertigation_equipment'][$i];
						array_push($arr,$fertigation_equipment_ids);
					}
					$params['fertigation_equipment_ids'] = implode(',', $arr);
				}

				$params['mulching_type'] = $_REQUEST['mulching_type'];
				if (!empty($_REQUEST['paper_width'])) {
					$params['paper_width_in_meter'] = $_REQUEST['paper_width'];
				}
				if (!empty($_REQUEST['paper_thickness'])) {
					$params['paper_thickness_in_micro'] = $_REQUEST['paper_thickness'];
				}

				$params['soil_type_id'] = $_REQUEST['soiltype'];
				$params['water_source_id'] = $_REQUEST['water_source'];
				$params['prevalent_disease'] = $_REQUEST['prevalent_disease'];

				if (!empty($_REQUEST['bacterial_blight_intensity_id'])) {
					$params['bacterial_blight_intensity_id'] = $_REQUEST['bacterial_blight_intensity_id'];
				}
				if (!empty($_REQUEST['num_of_plant_affected'])) {
					$params['num_of_plant_affected'] = $_REQUEST['num_of_plant_affected'];
				}
				
				$this->load->library('upload');

				// Soil_image
				if(!empty($_FILES['soil_images']['name'][0]))
				{
				$arr=array();
				$mul_img_config['upload_path'] = './uploads/plots/soil_images/';
				$mul_img_config['allowed_types'] = 'jpg|png|jpeg'; 

				$files=$_FILES['soil_images'];

				$filesCount = count($_FILES['soil_images']['name']);

				for($i = 0; $i < $filesCount; $i++){
				$_FILES['soil_images']['name'] = $files['name'][$i];
				$_FILES['soil_images']['type'] = $files['type'][$i];
				$_FILES['soil_images']['tmp_name'] = $files['tmp_name'][$i];
				$_FILES['soil_images']['error'] = $files['error'][$i];
				$_FILES['soil_images']['size'] = $files['size'][$i];

				$img_name = time()."_".$_FILES['soil_images']['name'];
				$mul_img_config['file_name'] = $img_name;

				$this->upload->initialize($mul_img_config);
				$this->upload->do_upload('soil_images');

				array_push($arr,$img_name);
				}
				$params['soil_type_images'] = implode(',', $arr);

				}

				// Soil_docs
				if(!empty($_FILES['soil_docs']['name'][0]))
				{
				$arr=array();
				$mul_img_config['upload_path'] = './uploads/plots/soil_docs/';
				$mul_img_config['allowed_types'] = 'docx|doc'; 

				$files=$_FILES['soil_docs'];

				$filesCount = count($_FILES['soil_docs']['name']);

				for($i = 0; $i < $filesCount; $i++){
				$_FILES['soil_docs']['name'] = $files['name'][$i];
				$_FILES['soil_docs']['type'] = $files['type'][$i];
				$_FILES['soil_docs']['tmp_name'] = $files['tmp_name'][$i];
				$_FILES['soil_docs']['error'] = $files['error'][$i];
				$_FILES['soil_docs']['size'] = $files['size'][$i];

				$img_name = time()."_".$_FILES['soil_docs']['name'];
				$mul_img_config['file_name'] = $img_name;

				$this->upload->initialize($mul_img_config);
				$this->upload->do_upload('soil_docs');

				array_push($arr,$img_name);
				}
				$params['soil_type_docs'] = implode(',', $arr);

				}

				// water_images
				if(!empty($_FILES['water_images']['name'][0]))
				{
				$arr=array();
				$mul_img_config['upload_path'] = './uploads/plots/water_images/';
				$mul_img_config['allowed_types'] = 'jpg|png|jpeg'; 

				$files=$_FILES['water_images'];

				$filesCount = count($_FILES['water_images']['name']);

				for($i = 0; $i < $filesCount; $i++){
				$_FILES['water_images']['name'] = $files['name'][$i];
				$_FILES['water_images']['type'] = $files['type'][$i];
				$_FILES['water_images']['tmp_name'] = $files['tmp_name'][$i];
				$_FILES['water_images']['error'] = $files['error'][$i];
				$_FILES['water_images']['size'] = $files['size'][$i];

				$img_name = time()."_".$_FILES['water_images']['name'];
				$mul_img_config['file_name'] = $img_name;

				$this->upload->initialize($mul_img_config);
				$this->upload->do_upload('water_images');

				array_push($arr,$img_name);
				}
				$params['water_source_images'] = implode(',', $arr);

				}

				// water_docs
				if(!empty($_FILES['water_docs']['name'][0]))
				{
				$arr=array();
				$mul_img_config['upload_path'] = './uploads/plots/water_docs/';
				$mul_img_config['allowed_types'] = 'docx|doc'; 

				$files=$_FILES['water_docs'];

				$filesCount = count($_FILES['water_docs']['name']);

				for($i = 0; $i < $filesCount; $i++){
				$_FILES['water_docs']['name'] = $files['name'][$i];
				$_FILES['water_docs']['type'] = $files['type'][$i];
				$_FILES['water_docs']['tmp_name'] = $files['tmp_name'][$i];
				$_FILES['water_docs']['error'] = $files['error'][$i];
				$_FILES['water_docs']['size'] = $files['size'][$i];

				$img_name = time()."_".$_FILES['water_docs']['name'];
				$mul_img_config['file_name'] = $img_name;

				$this->upload->initialize($mul_img_config);
				$this->upload->do_upload('water_docs');

				array_push($arr,$img_name);
				}
				$params['water_source_docs'] = implode(',', $arr);

				}
				$id = $this->m_general->insertRow('s_farmer_plot', $params);
				if(!empty($id))
				{
					$this->session->set_flashdata('success', 'Plot has been created Successfully..');
					redirect('dashboard');
				}
			}

		}
		$data['page'] = 'create_plot';
		$this->load->view('frontend/template',$data);
	}

	public function get_crop(){
		$crop_id=$_REQUEST['crop_id'];
		$output = '<option value="" disabled selected hidden>Select Crops</option>';
		if (!empty($crop_id)) {
			foreach ($crop_id as $id => $val) {
				$sql = "SELECT * FROM s_crops WHERE crop_id = ? ";
				$crop = $this->m_general->getRow($sql,array($val));
				$output .='<option value="'.$crop['crop_id'].'">'.$crop['en_crop_name'].'</option>';
			}
		}

		echo $output;
	}

	public function get_variety(){
		$crop_id=$_REQUEST['crop_id'];
		$output = '<option value="" disabled selected hidden>Select Variety</option>';
		if (!empty($crop_id)) {
			$sql = "SELECT * FROM s_variety WHERE crop_id = ? ";
			$variety = $this->m_general->getRows($sql,array($crop_id));
			foreach ($variety as $id => $val) {
				$output .='<option value="'.$val['variety_id'].'">'.$val['en_name'].'</option>';
			}
		}

		echo $output;
	}

	public function get_age_of_plant(){
		$planting_date=$_REQUEST['planting_date'];
		$age_of_plant=$this->age_calculate($planting_date);
		echo $age_of_plant;
	}

	public function get_age_of_user(){
		$birth_date=$_REQUEST['birth_date'];
		$age_of_user=$this->age_calculate($birth_date);
		echo $age_of_user;
	}

	public function not_found(){
		$data['page'] = '404';
		$this->load->view('frontend/template',$data);
	}

	public function is_logged_in()
	{  
 		if( !empty($this->session->userdata[SESSION_USER]) && isset($this->session->userdata[SESSION_USER]['logged_in']) == 'TRUE' ){
			redirect('/');
		}
  	}

  	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
