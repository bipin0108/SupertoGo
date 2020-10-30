<?php 
  $obj=&get_instance();
  if(empty($_GET)){}else{
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
        
    if(!empty($_GET['from']) && !empty($_GET['to'])){
      $from =  date('Y-m-d', strtotime(str_replace('', '-', $_GET['from'])));
      $to =  date('Y-m-d', strtotime(str_replace('', '-', $_GET['to'])));
      $this->db->where('tbl_orders.order_date >= "'.$from. '"');
      $this->db->where('tbl_orders.order_date <= "'.$to.'"');
    }

    $this->db->from('tbl_orders'); 
    $this->db->join('tbl_users','tbl_users.user_id = tbl_orders.user_id','left');
    $this->db->join('tbl_city','tbl_city.city_id = tbl_orders.city_id','left');
    $this->db->join('tbl_delivery_boy','tbl_delivery_boy.db_id = tbl_orders.db_id','left');  
    $this->db->join('tbl_order_status','tbl_order_status.status_id = tbl_orders.status_id','left');
    $query=$this->db->get();
    $result = $query->result();
   
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to SupertoGo</title>
</head>

<style>
table 
{
  border-collapse: collapse;
}

.tableHeader, td, th
{
  border: 0px; 
}
table, td, th 
{
  border: 1px solid black;
}
th
{
  background-color: #e4e7e5; 
}

</style>
<body>
<div>
<table style="width: 100%">
	<thead>
		<tr>
      <th><?=lang('Order ID');?></th>
      <th><?=lang('Date');?></th>
      <th><?=lang('User');?></th> 
      <th><?=lang('Delivery Boy');?></th>
      <th><?=lang('Delivery Boy');?></th>
      <th><?=lang('Order Status');?></th> 
      <th><?=lang('Price');?></th> 
      <th><?=lang('Driver Amt');?></th> 
      <th><?=lang('Admin Amt');?></th> 
		</tr>
	</thead>
	<tbody>	
    <?php 
      foreach ($result as $row) { 
        $price = $row->grand_price;
        $adjust_amt = $row->adjust_amt;
        if(!empty($adjust_amt)){
          $driver_amt = floatval($adjust_amt*(30/100));
          $admin_amt = floatval($adjust_amt*(70/100));
        }else{
          $driver_amt = floatval($price*(30/100));
          $admin_amt = floatval($price*(70/100));
        }
       ?>
      <tr>
        <td><?=$row->order_no;?></td>
        <td><?=$row->order_date;?></td>
        <td><?=$row->user;?></td>
        <td><?=$row->delivery_boy;?></td>
        <td><?=$row->status_name;?></td>
        <td><?=$this->m_general->getSetting('currency').number_format($adjust_amt,2);?></td>
        <td><?=$this->m_general->getSetting('currency').number_format($price,2);?></td>
        <td><?=$this->m_general->getSetting('currency').number_format($driver_amt,2);?></td>
        <td><?=$this->m_general->getSetting('currency').number_format($admin_amt,2);?></td>
      </tr>
    <?php } ?>
    
  </tbody>

</table>
</div>

</body>
</html>