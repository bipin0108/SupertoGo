<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MasterController extends CI_Controller
{
 	public function get_city_of_state_ajax()
	{
		$state_id = $_REQUEST['state_id'];
		$this->db->where('state_id', $state_id);
		$query = $this->db->get('s_city');
		$output = '<option value="">Select City</option>';
		if(isset($_REQUEST['city_id']))
		{
			$city_id = $_REQUEST['city_id'];
			foreach($query->result() as $row)
			{
				if($city_id == $row->city_id)
				{
					$selected = 'selected';
				}
				else{
					$selected = '';
				}
				$output .= '<option value="'.$row->city_id.'" '.$selected.'>'.$row->name.'</option>';
			}
		}
		else
		{
			foreach($query->result() as $row)
			{
				$output .= '<option value="'.$row->city_id.'" >'.$row->name.'</option>';
			}
		}
		
		echo $output;
	}

	public function download_pdf()
	{
		$topic_id = $this->uri->segment(3);
		$pdf_file = $this->uri->segment(4);
		$this->load->helper('download');
		$data = file_get_contents('uploads/knowledge_bank/'.$topic_id."/".$pdf_file);
		force_download($file_name, $data);
	}

	public function get_pincode_ajax()
	{
		if(!empty($_POST["keyword"])) 
		{
			$sql_pincode ="SELECT * FROM s_pincode WHERE pincode like '" . $_POST["keyword"] . "%' ";
			$result = $this->m_general->getRows($sql_pincode);
			$output = "";
			if(!empty($result)) 
			{
				foreach($result as $val) 
				{	
					$pincode = $val["pincode"];
					$office = $val["office"];
					$taluka = $val["taluka"];
					$district = $val["district"];
					$state = $val["state"];
					$address = $pincode.',' .$office.',' .$taluka.',' .$district.',' .$state;
					$output .= '<option value="'.$address.'" >'.$address.'</option>';
				}
			} 
			echo $output;	
		}
	}
//end	
}    