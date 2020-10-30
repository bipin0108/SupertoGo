<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MoleculeController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/MoleculeModel','moleculemodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'molecule/list_molecule';
		$this->load->view('admin/template',$data);
	}

	public function create_molecule($activity_type)
	{
		$this->adminmodel->CSRFVerify();
		$data['activity_type'] = $this->moleculemodel->get_activity_type($activity_type);
		$data['page'] = 'molecule/add_molecule';
		$this->load->view('admin/template',$data);
	}

 	public function add_molecule()
 	{
 		$this->adminmodel->CSRFVerify();
 		$activity_type = trim($_REQUEST['activity_type']);

 		$this->load->library('excel');
		if(isset($_FILES["molecule_file"]["name"]))
		{
			$path = $_FILES["molecule_file"]["tmp_name"];
			$objPHPExcel = PHPExcel_IOFactory::load($path);
            $moleculedata = array();
			foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
			{
				$worksheetTitle = $worksheet->getTitle();
				if($worksheetTitle == $activity_type)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=4; $row<=$highestRow; $row++)
					{
						if(!empty($worksheet->getCellByColumnAndRow(0, $row)->getValue())){
							
							$s_data['activity_type'] = $activity_type;
							$s_data['en_problem_type'] = !empty($worksheet->getCellByColumnAndRow(3,$row)->getValue())?$worksheet->getCellByColumnAndRow(3,$row)->getValue():'';
							$s_data['hi_problem_type'] = !empty($worksheet->getCellByColumnAndRow(4,$row)->getValue())?$worksheet->getCellByColumnAndRow(4,$row)->getValue():'';
							$s_data['mr_problem_type'] = !empty($worksheet->getCellByColumnAndRow(5,$row)->getValue())?$worksheet->getCellByColumnAndRow(5,$row)->getValue():'';
							$s_data['en_problem'] = !empty($worksheet->getCellByColumnAndRow(6,$row)->getValue())?$worksheet->getCellByColumnAndRow(6,$row)->getValue():'';
							$s_data['hi_problem'] = !empty($worksheet->getCellByColumnAndRow(7,$row)->getValue())?$worksheet->getCellByColumnAndRow(7,$row)->getValue():'';
							$s_data['mr_problem'] = !empty($worksheet->getCellByColumnAndRow(8,$row)->getValue())?$worksheet->getCellByColumnAndRow(8,$row)->getValue():'';
							$s_data['en_problem_area'] = !empty($worksheet->getCellByColumnAndRow(9,$row)->getValue())?$worksheet->getCellByColumnAndRow(9,$row)->getValue():'';
							$s_data['hi_problem_area'] = !empty($worksheet->getCellByColumnAndRow(10,$row)->getValue())?$worksheet->getCellByColumnAndRow(10,$row)->getValue():'';
							$s_data['mr_problem_area'] = !empty($worksheet->getCellByColumnAndRow(11,$row)->getValue())?$worksheet->getCellByColumnAndRow(11,$row)->getValue():'';
							$s_data['en_technical_name'] = !empty($worksheet->getCellByColumnAndRow(12,$row)->getValue())?$worksheet->getCellByColumnAndRow(12,$row)->getValue():'';
							$s_data['hi_technical_name'] = !empty($worksheet->getCellByColumnAndRow(13,$row)->getValue())?$worksheet->getCellByColumnAndRow(13,$row)->getValue():'';
							$s_data['mr_technical_name'] = !empty($worksheet->getCellByColumnAndRow(14,$row)->getValue())?$worksheet->getCellByColumnAndRow(14,$row)->getValue():'';
							$s_data['en_formulation'] = !empty($worksheet->getCellByColumnAndRow(15,$row)->getValue())?$worksheet->getCellByColumnAndRow(15,$row)->getValue():'';
							$s_data['hi_formulation'] = !empty($worksheet->getCellByColumnAndRow(16,$row)->getValue())?$worksheet->getCellByColumnAndRow(16,$row)->getValue():'';
							$s_data['mr_formulation'] = !empty($worksheet->getCellByColumnAndRow(17,$row)->getValue())?$worksheet->getCellByColumnAndRow(17,$row)->getValue():'';
							$s_data['en_dose'] = !empty($worksheet->getCellByColumnAndRow(18,$row)->getValue())?$worksheet->getCellByColumnAndRow(18,$row)->getValue():'';
							$s_data['hi_dose'] = !empty($worksheet->getCellByColumnAndRow(19,$row)->getValue())?$worksheet->getCellByColumnAndRow(19,$row)->getValue():'';
							$s_data['mr_dose'] = !empty($worksheet->getCellByColumnAndRow(20,$row)->getValue())?$worksheet->getCellByColumnAndRow(20,$row)->getValue():'';
							$s_data['en_unit'] = !empty($worksheet->getCellByColumnAndRow(21,$row)->getValue())?$worksheet->getCellByColumnAndRow(21,$row)->getValue():'';
							$s_data['hi_unit'] = !empty($worksheet->getCellByColumnAndRow(22,$row)->getValue())?$worksheet->getCellByColumnAndRow(22,$row)->getValue():'';
							$s_data['mr_unit'] = !empty($worksheet->getCellByColumnAndRow(23,$row)->getValue())?$worksheet->getCellByColumnAndRow(23,$row)->getValue():'';
							$s_data['en_per'] = !empty($worksheet->getCellByColumnAndRow(24,$row)->getValue())?$worksheet->getCellByColumnAndRow(24,$row)->getValue():'';
							$s_data['hi_per'] = !empty($worksheet->getCellByColumnAndRow(25,$row)->getValue())?$worksheet->getCellByColumnAndRow(25,$row)->getValue():'';
							$s_data['mr_per'] = !empty($worksheet->getCellByColumnAndRow(26,$row)->getValue())?$worksheet->getCellByColumnAndRow(26,$row)->getValue():'';
							$s_data['en_mode_of_action'] = !empty($worksheet->getCellByColumnAndRow(27,$row)->getValue())?$worksheet->getCellByColumnAndRow(27,$row)->getValue():'';
							$s_data['hi_mode_of_action'] = !empty($worksheet->getCellByColumnAndRow(28,$row)->getValue())?$worksheet->getCellByColumnAndRow(28,$row)->getValue():'';
							$s_data['mr_mode_of_action'] = !empty($worksheet->getCellByColumnAndRow(29,$row)->getValue())?$worksheet->getCellByColumnAndRow(29,$row)->getValue():'';
							$s_data['en_group'] = !empty($worksheet->getCellByColumnAndRow(30,$row)->getValue())?$worksheet->getCellByColumnAndRow(30,$row)->getValue():'';
							$s_data['hi_group'] = !empty($worksheet->getCellByColumnAndRow(31,$row)->getValue())?$worksheet->getCellByColumnAndRow(31,$row)->getValue():'';
							$s_data['mr_group'] = !empty($worksheet->getCellByColumnAndRow(32,$row)->getValue())?$worksheet->getCellByColumnAndRow(32,$row)->getValue():'';
							$s_data['en_safeness_for_honey_bee'] = !empty($worksheet->getCellByColumnAndRow(33,$row)->getValue())?$worksheet->getCellByColumnAndRow(33,$row)->getValue():'';
							$s_data['hi_safeness_for_honey_bee'] = !empty($worksheet->getCellByColumnAndRow(34,$row)->getValue())?$worksheet->getCellByColumnAndRow(34,$row)->getValue():'';
							$s_data['mr_safeness_for_honey_bee'] = !empty($worksheet->getCellByColumnAndRow(35,$row)->getValue())?$worksheet->getCellByColumnAndRow(35,$row)->getValue():'';
							$s_data['en_brand'] = !empty($worksheet->getCellByColumnAndRow(36,$row)->getValue())?$worksheet->getCellByColumnAndRow(36,$row)->getValue():'';
							$s_data['hi_brand'] = !empty($worksheet->getCellByColumnAndRow(37,$row)->getValue())?$worksheet->getCellByColumnAndRow(37,$row)->getValue():'';
							$s_data['mr_brand'] = !empty($worksheet->getCellByColumnAndRow(38,$row)->getValue())?$worksheet->getCellByColumnAndRow(38,$row)->getValue():'';
							$s_data['en_phi'] = !empty($worksheet->getCellByColumnAndRow(39,$row)->getValue())?$worksheet->getCellByColumnAndRow(39,$row)->getValue():'';
							$s_data['hi_phi'] = !empty($worksheet->getCellByColumnAndRow(40,$row)->getValue())?$worksheet->getCellByColumnAndRow(40,$row)->getValue():'';
							$s_data['mr_phi'] = !empty($worksheet->getCellByColumnAndRow(41,$row)->getValue())?$worksheet->getCellByColumnAndRow(41,$row)->getValue():'';
							$s_data['en_mrl'] = !empty($worksheet->getCellByColumnAndRow(42,$row)->getValue())?$worksheet->getCellByColumnAndRow(42,$row)->getValue():'';
							$s_data['hi_mrl'] = !empty($worksheet->getCellByColumnAndRow(43,$row)->getValue())?$worksheet->getCellByColumnAndRow(43,$row)->getValue():'';
							$s_data['mr_mrl'] = !empty($worksheet->getCellByColumnAndRow(44,$row)->getValue())?$worksheet->getCellByColumnAndRow(44,$row)->getValue():'';
							
							array_push($moleculedata,$s_data);
						}
					}
					$this->moleculemodel->setBatch_molecule($moleculedata);
					$check = $this->moleculemodel->add_molecule();
					if($check)
					{
						$this->session->set_flashdata('success', 'Molecule has been added Successfully..');
						redirect('admin/molecule-list');
					}	
				}
				else
				{
					$this->session->set_flashdata('error1', 'You have Not Sheet of "'.$activity_type.'" Name!!');
					$data['activity_type'] = $activity_type;
					$data['page'] = 'molecule/add_molecule';
					$this->load->view('admin/template',$data);
				}
			}
		}

		

			
		$data['activity_type'] = $activity_type;
		$data['page'] = 'molecule/add_molecule';
		$this->load->view('admin/template',$data);
  	}

  	
	public function edit_molecule()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'molecule/edit_molecule';
		$data['molecule'] = $this->moleculemodel->get_molecule_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_molecule()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['molecule'] = $this->moleculemodel->get_molecule_by_id($id);
		
		$this->form_validation->set_rules('en_problem_type','Problem Type','required|trim');
		$this->form_validation->set_rules('hi_problem_type','Problem Type','required|trim');
		$this->form_validation->set_rules('mr_problem_type','Problem Type','required|trim');
		$this->form_validation->set_rules('en_problem','Problem','required|trim');
		$this->form_validation->set_rules('hi_problem','Problem','required|trim');
		$this->form_validation->set_rules('mr_problem','Problem','required|trim');
		$this->form_validation->set_rules('en_problem_area','Problem Area','required|trim');
		$this->form_validation->set_rules('hi_problem_area','Problem Area','required|trim');
		$this->form_validation->set_rules('mr_problem_area','Problem Area','required|trim');
		$this->form_validation->set_rules('en_technical_name','Technical Name','required|trim');
		$this->form_validation->set_rules('hi_technical_name','Technical Name','required|trim');
		$this->form_validation->set_rules('mr_technical_name','Technical Name','required|trim');
		$this->form_validation->set_rules('en_formulation','Formulation','required|trim');
		$this->form_validation->set_rules('hi_formulation','Formulation','required|trim');
		$this->form_validation->set_rules('mr_formulation','Formulation','required|trim');
		$this->form_validation->set_rules('en_dose','Dose','required|trim');
		$this->form_validation->set_rules('hi_dose','Dose','required|trim');
		$this->form_validation->set_rules('mr_dose','Dose','required|trim');
		$this->form_validation->set_rules('en_unit','Unit','required|trim');
		$this->form_validation->set_rules('hi_unit','Unit','required|trim');
		$this->form_validation->set_rules('mr_unit','Unit','required|trim');
		$this->form_validation->set_rules('en_per','Per','required|trim');
		$this->form_validation->set_rules('hi_per','Per','required|trim');
		$this->form_validation->set_rules('mr_per','Per','required|trim');
		$this->form_validation->set_rules('en_mode_of_action','Mode of Action','required|trim');
		$this->form_validation->set_rules('hi_mode_of_action','Mode of Action','required|trim');
		$this->form_validation->set_rules('mr_mode_of_action','Mode of Action','required|trim');
		$this->form_validation->set_rules('en_group','Group','required|trim');
		$this->form_validation->set_rules('hi_group','Group','required|trim');
		$this->form_validation->set_rules('mr_group','Group','required|trim');
		$this->form_validation->set_rules('en_safeness_for_honey_bee','Safeness for Honey Bee','required|trim');
		$this->form_validation->set_rules('hi_safeness_for_honey_bee','Safeness for Honey Bee','required|trim');
		$this->form_validation->set_rules('mr_safeness_for_honey_bee','Safeness for Honey Bee','required|trim');
		$this->form_validation->set_rules('en_brand','Brand','required|trim');
		$this->form_validation->set_rules('hi_brand','Brand','required|trim');
		$this->form_validation->set_rules('mr_brand','Brand','required|trim');
		$this->form_validation->set_rules('en_phi','PHI','required|trim');
		$this->form_validation->set_rules('hi_phi','PHI','required|trim');
		$this->form_validation->set_rules('mr_phi','PHI','required|trim');
		$this->form_validation->set_rules('en_mrl','MRL','required|trim');
		$this->form_validation->set_rules('hi_mrl','MRL','required|trim');
		$this->form_validation->set_rules('mr_mrl','MRL','required|trim');

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_problem_type' => ucfirst($_REQUEST['en_problem_type']), 
				'hi_problem_type' => $_REQUEST['hi_problem_type'],
				'mr_problem_type' => $_REQUEST['mr_problem_type'], 
				'en_problem' => $_REQUEST['en_problem'],
				'hi_problem' => $_REQUEST['hi_problem'],
				'mr_problem' => $_REQUEST['mr_problem'],
				'en_problem_area' => $_REQUEST['en_problem_area'],
				'hi_problem_area' => $_REQUEST['hi_problem_area'],
				'mr_problem_area' => $_REQUEST['mr_problem_area'],
				'en_technical_name' => $_REQUEST['en_technical_name'],
				'hi_technical_name' => $_REQUEST['hi_technical_name'],
				'mr_technical_name' => $_REQUEST['mr_technical_name'],
				'en_formulation' => $_REQUEST['en_formulation'],
				'hi_formulation' => $_REQUEST['hi_formulation'],
				'mr_formulation' => $_REQUEST['mr_formulation'],
				'en_dose' => $_REQUEST['en_dose'],
				'hi_dose' => $_REQUEST['hi_dose'],
				'mr_dose' => $_REQUEST['mr_dose'],
				'en_unit' => $_REQUEST['en_unit'],
				'hi_unit' => $_REQUEST['hi_unit'],
				'mr_unit' => $_REQUEST['mr_unit'],
				'en_per' => $_REQUEST['en_per'],
				'hi_per' => $_REQUEST['hi_per'],
				'mr_per' => $_REQUEST['mr_per'],
				'en_mode_of_action' => $_REQUEST['en_mode_of_action'],
				'hi_mode_of_action' => $_REQUEST['hi_mode_of_action'],
				'mr_mode_of_action' => $_REQUEST['mr_mode_of_action'],
				'en_group' => ucfirst($_REQUEST['en_group']), 
				'hi_group' => $_REQUEST['hi_group'],
				'mr_group' => $_REQUEST['mr_group'], 
				'en_safeness_for_honey_bee' => $_REQUEST['en_safeness_for_honey_bee'],
				'hi_safeness_for_honey_bee' => $_REQUEST['hi_safeness_for_honey_bee'],
				'mr_safeness_for_honey_bee' => $_REQUEST['mr_safeness_for_honey_bee'],
				'en_brand' => $_REQUEST['en_brand'],
				'hi_brand' => $_REQUEST['hi_brand'],	
				'mr_brand' => $_REQUEST['mr_brand'],
				'en_phi' => $_REQUEST['en_phi'],
				'hi_phi' => $_REQUEST['hi_phi'],
				'mr_phi' => $_REQUEST['mr_phi'],
				'en_mrl' => $_REQUEST['en_mrl'],
				'hi_mrl' => $_REQUEST['hi_mrl'],
				'mr_mrl' => $_REQUEST['mr_mrl'],
			);

			$check = $this->moleculemodel->update_molecule($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'Molecule has been updated Successfully..');
				redirect('admin/molecule-list');
			}
		}
		$data['page'] = 'molecule/edit_molecule';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_molecule()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['activity_type']))
		{
			$activity_type = $_REQUEST['activity_type'];
			$this->db->where('activity_type', $activity_type);
			$this->db->delete("s_molecule");
			$this->session->set_flashdata('success', 'Molecule has been Successfully Deleted.');
			redirect('admin/molecule-list');
		}
	}
	
//end
}

