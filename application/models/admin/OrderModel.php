<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OrderModel extends CI_Model
{
  	public function __construct()
    {
        parent::__construct();
    }

    // Complete Order
	public function get_all_complete_order(){
		$column_order = array(null, 'tbl_orders.order_no'); 
		$column_search = array('tbl_orders.order_no');  
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
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id');
		$this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id');	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id');
		 
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
	public function complete_order_get_datatables(){
		$this->get_all_complete_order();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	public function complete_order_count_filtered(){
		$this->get_all_complete_order();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function complete_order_count_all(){
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
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
		$this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id','left');	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
		$this->db->get();
		return $this->db->count_all_results();
	}

	// Running Order
	public function get_all_running_order(){
		$column_order = array(null, 'tbl_orders.order_no'); 
		$column_search = array('tbl_orders.order_no');  
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
	public function running_order_get_datatables(){
		$this->get_all_running_order();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function running_order_count_filtered(){
		$this->get_all_running_order();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function running_order_count_all(){
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
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
		$this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id','left');	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
		$this->db->get();
		return $this->db->count_all_results();
	}

	// Pending Order
	public function get_all_pending_order(){
		$column_order = array(null, 'tbl_orders.order_no'); 
		$column_search = array('tbl_orders.order_no');  
		$this->db->select("
			tbl_orders.*,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user, 
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.status_id",1);
		$this->db->where("tbl_orders.is_cancel",0);
		$this->db->where("tbl_orders.db_id",0);
		$this->db->where("TIMESTAMPDIFF(MINUTE,tbl_orders.created_at,CURRENT_TIMESTAMP) >= 3");
		$this->db->where(" (SELECT COUNT(*) FROM tbl_db_temp_request WHERE order_id = tbl_orders.order_id AND db_id = 0) = 1 ", NULL, FALSE);
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left'); 
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
	public function pending_order_get_datatables(){
		$this->get_all_pending_order();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function pending_order_count_filtered(){
		$this->get_all_pending_order();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function pending_order_count_all(){
		$this->db->select("
			tbl_orders.*,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			tbl_city.name city_name,
			tbl_order_status.status_name
		");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.status_id",1);
		$this->db->where("tbl_orders.is_cancel",0); 
		$this->db->where("tbl_orders.db_id",0);
		$this->db->where("TIMESTAMPDIFF(MINUTE,tbl_orders.created_at,CURRENT_TIMESTAMP) >= 3");
		$this->db->where(" (SELECT COUNT(*) FROM tbl_db_temp_request WHERE order_id = tbl_orders.order_id AND db_id = 0) = 1 ", NULL, FALSE);
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left'); 	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
		$this->db->get();
		return $this->db->count_all_results();
	}

	// Cancelled Order
	public function get_all_cancelled_order(){
		$column_order = array(null, 'tbl_orders.order_no'); 
		$column_search = array('tbl_orders.order_no');  
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
	public function cancelled_order_get_datatables(){
		$this->get_all_cancelled_order();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get(); 
		return $query->result();
	}
	public function cancelled_order_count_filtered(){
		$this->get_all_pending_order();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function cancelled_order_count_all(){
		$this->db->select("tbl_orders.order_id,
			tbl_orders.order_no,
			tbl_orders.user_id,
			tbl_orders.city_id,
			tbl_orders.is_cancel,
			tbl_orders.order_date,
			tbl_orders.created_at,
			CONCAT(tbl_users.first_name,' ',tbl_users.last_name) user,
			CONCAT(tbl_delivery_boy.first_name,' ',tbl_delivery_boy.last_name) delivery_boy,
			tbl_city.name city_name,
			tbl_order_status.status_name");
		$this->db->order_by("tbl_orders.order_id","desc");
		$this->db->where("tbl_orders.is_cancel",1); 
		$this->db->from('tbl_orders'); 
		$this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
		$this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
		$this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id','left');	
		$this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
		$this->db->get();
		return $this->db->count_all_results();
	}

	public function get_orderdetails($order_id){	
		$sql = "SELECT DISTINCT o.order_id,
			CONCAT(db.first_name,' ',db.last_name) delivery_boy,
			(SELECT GROUP_CONCAT(status_history_id SEPARATOR',') FROM tbl_order_status_history WHERE FIND_IN_SET(status_id, o.status_id) ) AS status	
			FROM tbl_orders as o
			LEFT JOIN tbl_delivery_boy as db on o.db_id = db.db_id
			WHERE o.order_id = ?";
		$query = $this->db->query($sql,array($order_id));	
		if($query->num_rows() > 0){
			$result = $query->row();
			$sql1 = "SELECT DATE_FORMAT(osh.created_at,'%d %M, %Y %h:%i %p') created_at,os.status_name 
			FROM tbl_order_status_history osh 
			LEFT JOIN tbl_order_status os ON osh.status_id = os.status_id 
			WHERE FIND_IN_SET(os.status_id, ?) AND osh.order_id = ?
			GROUP BY osh.status_id";
			$query1 = $this->db->query($sql1,array($result->status,$order_id));	
			$result->order_status = $query1->result();

			$sql2 = "SELECT * FROM tbl_order_item WHERE order_id=?";
			$query1 = $this->db->query($sql2,array($order_id));	
			$result->products = $query1->result();
			return $result;
		}else{
			return false;
		}
	}

}
