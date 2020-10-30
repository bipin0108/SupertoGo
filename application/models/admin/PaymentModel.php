<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PaymentModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }

    // payment Driver
	public function get_all_payment_driver(){
		$column_order = array(null, 'tbl_orders.order_no'); 
		$column_search = array('tbl_orders.order_no');  
		$this->db->select("
			tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.order_date,
			tbl_orders.grand_price, 
			tbl_orders.adjust_amt, 
			tbl_orders.is_cancel,
			tbl_orders.cancel_by,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) delivery_boy,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.db_id!=",0);
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
		$this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id','left');	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
		 
		if(!empty($this->input->post('from')) && !empty($this->input->post('to'))){
			$from =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('from'))));
			$to =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('to'))));
			$this->db->where('tbl_orders.order_date >= "'.$from. '"');
			$this->db->where('tbl_orders.order_date <= "'.$to.'"');
		}

		$i = 0;
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
	}
	public function payment_driver_get_datatables(){
		$this->get_all_payment_driver();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function payment_driver_count_filtered(){
		$this->get_all_payment_driver();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function payment_driver_count_all(){
		$this->db->select("
			tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.order_date,
			tbl_orders.grand_price, 
			tbl_orders.adjust_amt, 
			tbl_orders.is_cancel,
			tbl_orders.cancel_by,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) delivery_boy,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.is_cancel",0); 
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
		$this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id','left');	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
		$this->db->get();
		return $this->db->count_all_results();
	}

	// payment Txn
	public function get_all_payment_txn(){
		$column_order = array(null, 'tbl_payment.order_id', 'tbl_payment.txn_id', 'tbl_payment.status', 'tbl_payment.payment_date', 'tbl_payment.payment_time', 'tbl_payment.last4', 'tbl_payment.brand', 'tbl_payment.exp_month', 'tbl_payment.exp_year', 'tbl_payment.country', 'tbl_payment.card_type', 'tbl_payment.payment_by'); 
		$column_search = array('tbl_payment.order_id', 'tbl_payment.txn_id', 'tbl_payment.status', 'tbl_payment.payment_date', 'tbl_payment.payment_time', 'tbl_payment.last4', 'tbl_payment.brand', 'tbl_payment.exp_month', 'tbl_payment.exp_year', 'tbl_payment.country', 'tbl_payment.card_type', 'tbl_payment.payment_by');  
		$this->db->select("*");
		$this->db->order_by("tbl_payment.created_at","desc"); 
		$this->db->from('tbl_payment'); 
		$this->db->join('tbl_orders','tbl_payment.order_id = tbl_orders.order_id','left');
		 
		if(!empty($this->input->post('from')) && !empty($this->input->post('to'))){
			$from =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('from'))));
			$to =  date('Y-m-d', strtotime(str_replace('', '-', $this->input->post('to'))));
			$this->db->where('tbl_payment.payment_date >= "'.$from. '"');
			$this->db->where('tbl_payment.payment_date <= "'.$to.'"');
		}

		$i = 0;
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
	}
	public function payment_txn_get_datatables(){
		$this->get_all_payment_txn();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function payment_txn_count_filtered(){
		$this->get_all_payment_txn();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function payment_txn_count_all(){
		$this->db->select("*");
		$this->db->order_by("tbl_payment.created_at","desc"); 
		$this->db->from('tbl_payment'); 
		$this->db->join('tbl_orders','tbl_payment.order_id = tbl_orders.order_id','left');
		$this->db->get();
		return $this->db->count_all_results();
	}
	
}

