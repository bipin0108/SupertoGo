<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PaymentController extends MY_Controller
{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->adminmodel->CSRFVerify();
		$this->load->model('admin/PaymentModel', 'paymentmodel');
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('payment',$site_lang); 
    }

    // payment Driver
 	public function index(){
 		$data['page'] = 'payment/payment_driver';
		$this->load->view('admin/template',$data);
	}
	public function payment_driver_list_ajax(){
		$list = $this->paymentmodel->payment_driver_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();

			$price = $orders->grand_price;
			$adjust_amt = $orders->adjust_amt;
			if(!empty($adjust_amt)){
				$driver_amt = floatval($adjust_amt*(30/100));
				$admin_amt = floatval($adjust_amt*(70/100));
			}else{
				$driver_amt = floatval($price*(30/100));
				$admin_amt = floatval($price*(70/100));
			}
			$row[] = $orders->order_id;
			$row[] = $orders->order_no;
			$row[] = $orders->order_date; 
			$row[] = $orders->user; 
			$row[] = $orders->delivery_boy; 
			$row[] = $orders->status_name; 
			$row[] = $this->m_general->getSetting('currency').number_format($adjust_amt,2); 
			$row[] = $this->m_general->getSetting('currency').number_format($price,2); 
			$row[] = $this->m_general->getSetting('currency').number_format($driver_amt,2); 
			$row[] = $this->m_general->getSetting('currency').number_format($admin_amt,2); 
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->paymentmodel->payment_driver_count_all(),
			"recordsFiltered" => $this->paymentmodel->payment_driver_count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
		exit;
	}
	public function payment_driver_save_pdf(){ 	
		$this->load->library('mpdf');
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/payment/payment_driver_pdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('paymentDriver'.date('dmY_His').'.pdf','D');
	}
	public function payment_driver_save_excel(){ 	
	 	$this->db->select("
			tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.order_date,
			tbl_orders.grand_price, 
			tbl_orders.is_cancel,
			tbl_orders.cancel_by,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user_name,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) delivery_boy_name,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.db_id!=",0);  
	    	
	    if(!empty($this->input->post('from')) && !empty($this->input->post('to'))){
			$from =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('from'))));
			$to =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('to'))));
			$this->db->where('tbl_orders.order_date >= "'.$from. '"');
			$this->db->where('tbl_orders.order_date <= "'.$to.'"');
		}

	    $this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
		$this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id','left');	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
	    $query=$this->db->get();
	    $this->load->library('excel');
		$objPHPExcel = new PHPExcel();
	    $result = $query->result();
		$objPHPExcel->setActiveSheetIndex();
	    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, lang('Order ID'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, lang('Date'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, lang('User'));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, lang('Delivery Boy'));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, lang('Order Status'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1, lang('Adjust Amt'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,1, lang('Price'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,1, lang('Driver Amt'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,1, lang('Admin Amt'));
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
		$col = 'A';
		while(true){
		    $tempCol = $col++;
		    $objPHPExcel->getActiveSheet()->getColumnDimension($tempCol)->setAutoSize(true);
		    if($tempCol == $objPHPExcel->getActiveSheet()->getHighestDataColumn()){
		        break;
		    }
		}
        $rows = 2;
        foreach ($result as $val){
        	$price = $val->grand_price;
			$adjust_amt = $val->adjust_amt;
			if(!empty($adjust_amt)){
				$driver_amt = floatval($adjust_amt*(30/100));
				$admin_amt = floatval($adjust_amt*(70/100));
			}else{
				$driver_amt = floatval($price*(30/100));
				$admin_amt = floatval($price*(70/100));
			}

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rows, $val->order_no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rows, $val->order_date); 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rows, $val->user);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rows, $val->delivery_boy);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rows, $val->status_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $rows, $this->m_general->getSetting('currency').number_format($adjust_amt,2));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $rows, $this->m_general->getSetting('currency').number_format($price,2));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $rows, $this->m_general->getSetting('currency').number_format($driver_amt,2));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $rows, $this->m_general->getSetting('currency').number_format($admin_amt,2));
            $rows++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $file='paymentDriver'.date('dmY_His').'.xls';
	  	header('Content-Type: application/vnd.ms-excel');
	  	header("Content-Disposition: attachment; filename=\"$file\"");
	  	$object_writer->save('php://output');
	}


	// payment Txn
 	public function payment_txn_list(){
 		$data['page'] = 'payment/payment_txn';
		$this->load->view('admin/template',$data);
	}
	public function payment_txn_list_ajax(){
		$list = $this->paymentmodel->payment_txn_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();

			$row[] = $orders->payment_id;
			$row[] = $orders->txn_id;
			$row[] = $orders->order_id;
			$row[] = $orders->payment_date; 
			$row[] = $orders->payment_time; 
			$row[] = $orders->last4; 
			$row[] = $orders->exp_month; 
			$row[] = $orders->exp_year; 
			$row[] = $orders->brand; 
			$row[] = $orders->country; 
			$row[] = $orders->payment_by; 
			$row[] = $orders->card_type; 
			$row[] = $orders->status; 
			$data[] = $row;
		}

		$output = array( "draw" => $_POST['draw'], "recordsTotal" =>
$this->paymentmodel->payment_txn_count_all(), "recordsFiltered" =>
$this->paymentmodel->payment_txn_count_filtered(), "data" => $data, ); echo
json_encode($output); exit; } public function payment_txn_save_pdf(){ 	
$this->load->library('mpdf'); $mpdf = new \Mpdf\Mpdf(); $html =
$this->load->view('admin/payment/payment_txn_pdf',[],true);
$mpdf->WriteHTML($html);
$mpdf->Output('paymentTxn'.date('dmY_His').'.pdf','D'); } public function
payment_txn_save_excel(){ 	 $this->db->select("*");
$this->db->order_by("tbl_payment.created_at","desc"); 
$this->db->from('tbl_payment'); 
$this->db->join('tbl_orders','tbl_payment.order_id =
tbl_orders.order_id','left'); if(!empty($this->input->post('from')) &&
!empty($this->input->post('to'))){ $from =  date('Y-m-d',
strtotime(str_replace('', '-', $this->input->post('from')))); $to = 
date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('to'))));
$this->db->where('tbl_payment.payment_date >= "'.$from. '"');
$this->db->where('tbl_payment.payment_date <= "'.$to.'"'); }
$query=$this->db->get(); $this->load->library('excel'); $objPHPExcel = new
PHPExcel(); $result = $query->result(); $objPHPExcel->setActiveSheetIndex();
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, lang('Txn
ID')); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1,
lang('Order ID'));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, lang('Payment
Date')); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1,
lang('Payment Time'));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1,
lang('Last4'));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1, lang('Exp
Month')); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,1,
lang('Exp Year'));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,1,
lang('Brand'));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,1,
lang('Country'));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,1, lang('Payment
By')); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,1,
lang('Card Type'));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11,1,
lang('Status'));
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
$col = 'A'; while(true){ $tempCol = $col++;
$objPHPExcel->getActiveSheet()->getColumnDimension($tempCol)->setAutoSize(true);
if($tempCol == $objPHPExcel->getActiveSheet()->getHighestDataColumn()){ break;
} } $rows = 2; foreach ($result as $val){ 
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rows,
$val->txn_id); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,
$rows, $val->order_no); 
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rows,
$val->payment_date);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rows,
$val->payment_time);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rows,
$val->last4); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,
$rows, $val->exp_month);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $rows,
$val->exp_year); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,
$rows, $val->brand);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $rows,
$val->country); $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,
$rows, $val->payment_by);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $rows,
$val->card_type);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $rows,
$val->status); $rows++; } $object_writer =
PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$file='paymentTxn'.date('dmY_His').'.xls'; header('Content-Type:
application/vnd.ms-excel'); header("Content-Disposition: attachment;
filename=\"$file\""); $object_writer->save('php://output'); }

}

