<?php defined('BASEPATH') OR exit('No direct script access allowed');
class OrderController extends MY_Controller
{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->adminmodel->CSRFVerify();
		$this->load->model('admin/OrderModel', 'ordermodel');
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('order',$site_lang); 
    }

    // Complete Order
 	public function index(){
 		$data['page'] = 'order/complete_order';
		$this->load->view('admin/template',$data);
	}
	public function complete_order_list_ajax(){
		$list = $this->ordermodel->complete_order_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();
			$button  = '<div class="text-nowrap">';
			$button .= '<a data-toggle="tooltip" data-placement="top" title="View Order" href="'.base_url('admin/order-view/'.$orders->order_id).'" data-row="'.htmlspecialchars(json_encode($orders),ENT_QUOTES).'" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>'; 
			$button .= '</div>';
			$row[] = $orders->order_id; 
			$row[] = $orders->order_no;
			$row[] = $orders->order_date; 
			$row[] = $orders->user; 
			$row[] = $orders->delivery_boy; 
			$row[] = $this->m_general->getSetting('currency').number_format($orders->grand_price,2); 
			$row[] = $orders->status_name;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ordermodel->complete_order_count_all(),
			"recordsFiltered" => $this->ordermodel->complete_order_count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
		exit;
	}
	public function complete_order_save_pdf(){ 	
		$this->load->library('mpdf');
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/order/complete_order_pdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('CompleteOrder'.date('dmY_His').'.pdf','D');
	}
	public function complete_order_save_excel(){ 	
	 	$this->db->select("
			tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.order_date,
			tbl_orders.grand_price, 
			tbl_orders.is_cancel,
			tbl_orders.cancel_by,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) delivery_boy,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.status_id",5);
		$this->db->where("tbl_orders.is_cancel",0); 
	    	
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
	    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, 'Order ID');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, 'Date');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, 'User');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, 'Delivery Boy');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, 'Price');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1, 'Order Status');
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
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
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rows, $val->order_no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rows, $val->order_date); 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rows, $val->user);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rows, $val->delivery_boy);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rows, $this->m_general->getSetting('currency').number_format($val->grand_price,2));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $rows, $val->status_name);
            $rows++; 
        }
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $file='CompleteOrder'.date('dmY_His').'.xls';
	  	header('Content-Type: application/vnd.ms-excel');
	  	header("Content-Disposition: attachment; filename=\"$file\"");
	  	$object_writer->save('php://output');
	}

	// Order Running
	public function running_order_list(){
 		$data['page'] = 'order/running_order';
		$this->load->view('admin/template',$data);
	}
	public function running_order_list_ajax(){
		$list = $this->ordermodel->running_order_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();
			$button  = '<div class="text-nowrap">';
			$button .= '<a data-toggle="tooltip" data-placement="top" title="View Order" href="'.base_url('admin/order-view/'.$orders->order_id).'" data-row="'.htmlspecialchars(json_encode($orders),ENT_QUOTES).'" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>'; 
			$button .= '</div>';
			$row[] = $orders->order_id; 
			$row[] = $orders->order_no;
			$row[] = $orders->order_date; 
			$row[] = $orders->user; 
			$row[] = $orders->delivery_boy; 
			$row[] = $this->m_general->getSetting('currency').number_format($orders->grand_price,2); 
			$row[] = $orders->status_name; 
			$row[] = $button; 
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ordermodel->running_order_count_all(),
			"recordsFiltered" => $this->ordermodel->running_order_count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
		exit;
	}
	public function running_order_save_pdf(){ 	
		$this->load->library('mpdf');
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/order/running_order_pdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('RunningOrder'.date('dmY_His').'.pdf','D');
	}
	public function running_order_save_excel(){ 	
	 	$this->db->select("
			tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.order_date,
			tbl_orders.grand_price, 
			tbl_orders.is_cancel,
			tbl_orders.cancel_by,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) delivery_boy,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.status_id > 1");
		$this->db->where("tbl_orders.status_id < 5");
		$this->db->where("tbl_orders.is_cancel",0); 
	    	
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
	    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, 'Order ID');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, 'Date');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, 'User');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, 'Delivery Boy');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, 'Order Status');
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
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
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rows, $val->order_no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rows, $val->order_date); 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rows, $val->user);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rows, $val->delivery_boy);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rows, $this->m_general->getSetting('currency').number_format($val->grand_price,2));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $rows, $val->status_name);
            $rows++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $file='RunningOrder'.date('dmY_His').'.xls';
	  	header('Content-Type: application/vnd.ms-excel');
	  	header("Content-Disposition: attachment; filename=\"$file\"");
	  	$object_writer->save('php://output');
	}

	// Order Pending
	public function pending_order_list(){
 		$data['page'] = 'order/pending_order';
		$this->load->view('admin/template',$data);
	}
	public function pending_order_list_ajax(){
		$list = $this->ordermodel->pending_order_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();
			$button  = '<div class="text-nowrap">';
			$button .= '<a data-toggle="tooltip" data-placement="top" title="View Order" href="'.base_url('admin/order-view/'.$orders->order_id).'" data-row="'.htmlspecialchars(json_encode($orders),ENT_QUOTES).'" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>'; 
			$button .= '<button data-toggle="tooltip" data-placement="top" title="Assign Driver" data-row="'.htmlspecialchars(json_encode($orders),ENT_QUOTES).'" class="btn btn-sm btn-primary near_by_driver_btn" style="margin-right: 5px;"><i class="fa fa-truck"></i></button>';
			$button .= '<button data-toggle="tooltip" data-placement="top" title="Order Cancel" data-row="'.htmlspecialchars(json_encode($orders),ENT_QUOTES).'" class="btn btn-sm btn-danger cancel" style="margin-right: 5px;"><i class="fa fa-times"></i></button>';
			$button .= '</div>';
			$row[] = $orders->order_id;
			$row[] = $orders->order_no;
			$row[] = $orders->order_date; 
			$row[] = $orders->user; 
			$row[] = $this->m_general->getSetting('currency').number_format($orders->grand_price,2); 
			$row[] = $orders->status_name;
			$row[] = $button;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ordermodel->pending_order_count_all(),
			"recordsFiltered" => $this->ordermodel->pending_order_count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
		exit;
	}
	public function pending_order_save_pdf(){ 	
		$this->load->library('mpdf');
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/order/pending_order_pdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('PendingOrder'.date('dmY_His').'.pdf','D');
	}
	public function pending_order_save_excel(){ 	
	 	$this->db->select("
			tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.order_date,
			tbl_orders.grand_price, 
			tbl_orders.is_cancel,
			tbl_orders.cancel_by,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.status_id",1);
		$this->db->where("tbl_orders.is_cancel",0); 
	    $this->db->where("tbl_orders.db_id",0);
		$this->db->where("TIMESTAMPDIFF(MINUTE,tbl_orders.created_at,CURRENT_TIMESTAMP) >= 3");
		// $this->db->where(" (SELECT COUNT(*) FROM tbl_db_temp_request WHERE order_id = tbl_orders.order_id AND db_id = 0) = 1 ", NULL, FALSE);

	    if(!empty($this->input->post('from')) && !empty($this->input->post('to'))){
			$from =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('from'))));
			$to =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('to'))));
			$this->db->where('tbl_orders.order_date >= "'.$from. '"');
			$this->db->where('tbl_orders.order_date <= "'.$to.'"');
		}
		 
	    $this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
	    $query=$this->db->get();
	    $this->load->library('excel');
		$objPHPExcel = new PHPExcel();
	    $result = $query->result();
		$objPHPExcel->setActiveSheetIndex();
	    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, 'Order ID');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, 'Date'); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, 'User');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, 'Price');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, 'Order Status');
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
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
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rows, $val->order_no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rows, $val->order_date); 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rows, $val->user);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rows, $this->m_general->getSetting('currency').number_format($val->grand_price,2));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rows, $val->status_name);
            $rows++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $file='PendingOrder'.date('dmY_His').'.xls';
	  	header('Content-Type: application/vnd.ms-excel');
	  	header("Content-Disposition: attachment; filename=\"$file\"");
	  	$object_writer->save('php://output');
	}

	// Order Cancelled
	public function cancelled_order_list(){
 		$data['page'] = 'order/cancelled_order';
		$this->load->view('admin/template',$data);
	}
	public function cancelled_order_list_ajax(){
		$list = $this->ordermodel->cancelled_order_get_datatables();
		$data = array();
		$no = $_POST['start'];
		$cnt = 0;
		foreach ($list as $orders) {
			$cnt += 1;
			$row = array ();
			$button  = '<div class="text-nowrap">';
			$button .= '<a data-toggle="tooltip" data-placement="top" title="View Order" href="'.base_url('admin/order-view/'.$orders->order_id).'" data-row="'.htmlspecialchars(json_encode($orders),ENT_QUOTES).'" class="btn btn-sm btn-info" style="margin-right: 5px;"><i class="fa fa-eye"></i></a>'; 
			$button .= '</div>';
			$row[] = $orders->order_id;
			$row[] = $orders->order_no;
			$row[] = $orders->order_date; 
			$row[] = $orders->user; 
			$row[] = $orders->delivery_boy; 
			$row[] = $this->m_general->getSetting('currency').number_format($orders->grand_price,2); 
			$row[] = $orders->cancel_by; 
			$row[] = $button; 
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ordermodel->cancelled_order_count_all(),
			"recordsFiltered" => $this->ordermodel->cancelled_order_count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
		exit;
	}
	public function cancelled_order_save_pdf(){ 	
		$this->load->library('mpdf');
		$mpdf = new \Mpdf\Mpdf();
       	$html = $this->load->view('admin/order/cancelled_order_pdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('CancelledOrder'.date('dmY_His').'.pdf','D');
	}
	public function cancelled_order_save_excel() { 	
	 	$this->db->select("
			tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.order_date,
			tbl_orders.grand_price, 
			tbl_orders.is_cancel,
			tbl_orders.cancel_by,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) delivery_boy,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.is_cancel",1); 
	    	
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
	    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, 'Order ID');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, 'Date'); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, 'User');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, 'Delivery Boy');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, 'Price');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1, 'Order Status');
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
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
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $rows, $val->order_no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $rows, $val->order_date); 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $rows, $val->user);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $rows, $val->delivery_boy);
	    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $rows, $this->m_general->getSetting('currency').number_format($val->grand_price,2));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $rows, $val->status_name);
            $rows++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $file='CancelledOrder'.date('dmY_His').'.xls';
	  	header('Content-Type: application/vnd.ms-excel');
	  	header("Content-Disposition: attachment; filename=\"$file\"");
	  	$object_writer->save('php://output');
	}

	public function order_view($order_id){
		$output = array();
	    $order = $this->m_general->getRow("SELECT * FROM tbl_orders WHERE order_id=?",array($order_id));
	    if(!empty($order)){
	    	$user = $this->m_general->getRow("SELECT * FROM tbl_users WHERE user_id=?",array($order['user_id']));
			$output['order_id'] = $order['order_id'];
			$output['username'] = $user['first_name'].' '.$user['last_name'];
			$output['email'] = $user['email'];
			$output['mobile'] = $user['mobile'];
			$output['order_no'] = $order['order_no'];
			$output['order_date'] = $order['order_date'];
			$output['order_time'] = $order['order_time'];
			$output['address'] = $order['address'];
			$output['lat'] = $order['lat'];
			$output['lon'] = $order['lon'];
			$output['delivery_charge'] = number_format($order['delivery_charge'],2);
			$output['promocode'] = $order['promocode'];
			$output['promocode_price'] = number_format($order['promocode_price'],2);
			$output['sub_total'] = number_format($order['sub_total'],2);
			$output['grand_price'] = number_format($order['grand_price'],2);
			$items = $this->m_general->getRows("SELECT * FROM tbl_order_item WHERE order_id=?",array($order['order_id']));
	        $output['item_count'] = count($items);
			$order_status = $this->m_general->getRow("SELECT * FROM tbl_order_status WHERE status_id=?",array($order['status_id']));
	        $output['delivery_date'] = $order['delivery_date'];
	        $output['delivery_time'] = $order['delivery_time'];
	        $output['status_id'] = $order_status['status_id'];
			$output['order_status'] = $order_status['status_name'];
			$output['is_cancel'] = $order['is_cancel'];
			$output['cancel_by'] = $order['cancel_by'];
			$output['currency'] = $this->m_general->getSetting('currency');
			$items = $this->m_general->getRows("SELECT * FROM tbl_order_item WHERE order_id=?",array($order_id));
			
			$arr = array();
			foreach ($items as $item) {
				$product_item  = $this->m_general->getRow("SELECT * FROM tbl_product_item WHERE item_id=?",array($item['item_id']));
				$item['product_id'] = $product_item['product_id'];
				$item['brand_id'] = $product_item['brand_id'];
				$item['weight'] = $product_item['weight'];
				$item['unit'] = $product_item['unit'];
				$arr[$item['store_id']][] = $item;	
			}

			
			$output['store'] = array();
	    	if(!empty($arr)){
				$arr_key = array_keys($arr);
				$ix = 0;
				$sub_total = 0;
				foreach ($arr_key as $store_id) {
					$store = $this->m_general->getRow("SELECT * FROM tbl_store WHERE store_id=?",array($store_id)); 
		            $output['store'][$ix]['store_id'] = $store['store_id'];
		            $output['store'][$ix]['name'] = $store['name'];
		            $output['store'][$ix]['store_icon'] = !empty($store['store_icon'])?base_url('/uploads/store/').$store['store_icon']:'';
		            $products = $arr[$store_id];
		            foreach ($products as $idx => $rw) {
		                $total_price = number_format(($rw['price'] * $rw['item_count']),2);
		                $sub_total += $total_price;
		                $output['store'][$ix]['product'][$idx]['product_id'] = $rw['product_id'];
		                $output['store'][$ix]['product'][$idx]['name'] = $rw['name'];
		                $brand = $this->m_general->getRow("SELECT * FROM tbl_brand WHERE brand_id=?",array($rw['brand_id']));
		                $output['store'][$ix]['product'][$idx]['brand'] = !empty($brand['name'])?$brand['name']:'';
		                $product = $this->m_general->getRow("SELECT * FROM tbl_product WHERE product_id=?",array($rw['product_id']));
		                $image = !empty($product['image'])?base_url('/uploads/product/').$product['image']:'';
		                $output['store'][$ix]['product'][$idx]['image'] = $image;
		                $output['store'][$ix]['product'][$idx]['item_id'] = $rw['item_id'];
		                $output['store'][$ix]['product'][$idx]['weight'] = $rw['weight'];
		                $output['store'][$ix]['product'][$idx]['unit'] = $rw['unit'];
		                $output['store'][$ix]['product'][$idx]['price'] = number_format($rw['price'], 2);
		                $output['store'][$ix]['product'][$idx]['item_count'] = $rw['item_count'];
		                $output['store'][$ix]['product'][$idx]['total_price'] = $total_price;
		                $output['store'][$ix]['product'][$idx]['currency'] = $this->m_general->getSetting('currency');
		            }
				}
				$ix++;
			}
	    }
		$data['order'] = $output;
		$data['page'] = 'order/order_view';
		$this->load->view('admin/template',$data);
	}

	public function get_order_detail_by_orderID_ajax(){
		$order_id = $_POST['order_id'];
		$res= $this->ordermodel->get_orderdetails($order_id);
		echo json_encode($res);
	}

	// Order Cancel
	public function order_cancel(){
		$order_id = $_REQUEST['order_id'];
		$order = $this->m_general->getRow("SELECT * FROM tbl_orders WHERE order_id=?",array($order_id));
		$user = $this->m_general->getRow("SELECT * FROM tbl_users WHERE user_id=?",array($order['user_id']));
		if(!empty($order['db_id'])){
			$driver = $this->m_general->getRow("SELECT * FROM tbl_delivery_boy WHERE db_id=?",array($order['db_id']));
		}
	 	$data = array(
	    	'is_cancel'=>1,
	    	'cancel_by'=>'Cancelled by '.APP_NAME
	    );
	    $this->m_general->updateRow('tbl_orders', $data, array('order_id'=>$order_id));
	 	echo true;
	}

	// Get near by driver
	public function get_nearby_driver_ajax(){
		$distance = $this->m_general->getSetting('distance');
		$lat = !empty($_REQUEST['lat'])?$_REQUEST['lat']:0;
		$lon = !empty($_REQUEST['lon'])?$_REQUEST['lon']:0;
		

		$sql = "SELECT 
			db_id, mobile, GROUP_CONCAT(last_name,' ',first_name) name, device_token
	        FROM tbl_delivery_boy
	        WHERE status = 'Active'";

		// $sql = "SELECT 
		// 	db_id, mobile, GROUP_CONCAT(last_name,' ',first_name) name, device_token, (
	 //            6371 * acos (
	 //              cos ( radians(".$lat.") )
	 //              * cos( radians( lat ) )
	 //              * cos( radians( lon ) - radians(".$lon.") )
	 //              + sin ( radians(".$lat.") )
	 //              * sin( radians( lat ) )
	 //            )
	 //        ) AS distance
	 //        FROM tbl_delivery_boy
	 //        WHERE is_online=1 AND status = 'Active'
	 //        HAVING distance < ? 
	 //        ORDER BY distance LIMIT 10";

	 	$driver = $this->m_general->getRows($sql,array($distance));
		echo json_encode($driver);
		exit;
	}

	// Assign driver
	public function assign_driver_to_order_ajax(){
		$order_id = $_REQUEST['order_id'];
		$db_id = $_REQUEST['db_id'];
		$device_token = $_REQUEST['device_token'];
 			
		// Delete temp request
    	$this->m_general->deleteRows('tbl_db_temp_request',array('order_id'=>$order_id));

		// Assign driver
        $order_assign_prm = array('db_id'=>$db_id,'status_id'=>2);
    	$this->m_general->updateRow('tbl_orders',$order_assign_prm,array('order_id'=>$order_id));

		// Status History
		$order_status_prm = array(
            'order_id'=>$order_id,
            'status_id' => 2
        );
        $check = $this->m_general->getRow("SELECT * FROM tbl_order_status_history WHERE order_id=? AND status_id=2",array($order_id));
        if(empty($check)){
            $status_history_id = $this->m_general->insertRow('tbl_order_status_history', $order_status_prm);
        }

		// Send notificaiton to driver
		$message = "New request is assign to you by ".APP_NAME.".";
		$msg = array(
            "body"=>$message,
            "code" => "101",
            "sound"=>"default",
            "order_id"=>$order_id
        );
		$this->push_notification($device_token, $msg);
		// Add notification
        $notify_prm = array(
            'db_id' => $db_id,
            'order_id' => $order_id,
            'message' => $message,
            'type' => 1
        );
        $notify_id = $this->m_general->insertRow('tbl_notification_list', $notify_prm);


        // Get order
    	$order = $this->m_general->getRow("SELECT * FROM tbl_orders WHERE order_id=:order_id",array('order_id'=>$order_id));

    	// Get driver
    	$driver = $this->m_general->getRow("SELECT * FROM tbl_delivery_boy WHERE status='Active' AND db_id=:db_id",array('db_id'=>$db_id));
        $driver_name = $driver['first_name'];

    	// Get user
    	$user = $this->m_general->getRow("SELECT * FROM tbl_users WHERE user_id=?",array($order['user_id']));

        $message = "Your order has been accepted by $driver_name.";
		$msg = array(
            "body"=>$message,
            "code" => "101",
            "sound"=>"default",
            "order_id"=>$order_id
        );
        $this->push_notification($user['device_token'], $msg);
        $notify_prm = array(
            'user_id' => $order['user_id'],
            'order_id' => $order_id,
            'message' => $message,
            'type' => 0
        );
        $notify_id = $this->m_general->insertRow('tbl_notification_list', $notify_prm);
		$this->session->set_flashdata('success', 'Driver has been assigned Successfully..');
		echo true;	
	}

}

