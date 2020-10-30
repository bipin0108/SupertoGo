<?php 
  $obj=&get_instance();
  if(empty($_GET)){}else{
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
table{border-collapse: collapse;}
.tableHeader, td, th{
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
      <th>#</th>
      <th><?=lang('Txn ID');?></th>
      <th><?=lang('Order ID');?></th>
      <th><?=lang('Payment Date');?></th> 
      <th><?=lang('Payment Time');?></th>
      <th><?=lang('Last4');?></th>
      <th><?=lang('Exp Month');?></th> 
      <th><?=lang('Exp Year');?></th> 
      <th><?=lang('Brand');?></th> 
      <th><?=lang('Country');?></th> 
      <th><?=lang('Payment By');?></th> 
      <th><?=lang('Card Type');?></th> 
      <th><?=lang('Status');?></th> 
		</tr>
	</thead>
	<tbody>	
    <?php 
      $idx = 1;
      foreach ($result as $row) { 
       ?>
      <tr>
        <td><?=$idx++;?></td>
        <td><?=$row->txn_id;?></td>
        <td><?=$row->order_no;?></td>
        <td><?=$row->payment_date;?></td>
        <td><?=$row->payment_time;?></td>
        <td><?=$row->exp_month;?></td>
        <td><?=$row->exp_year;?></td>
        <td><?=$row->brand;?></td>
        <td><?=$row->country;?></td>
        <td><?=$row->payment_by;?></td>
        <td><?=$row->card_type;?></td>
        <td><?=$row->status;?></td>
      </tr>
    <?php } ?>
    
  </tbody>

</table>
</div>

</body>
</html>