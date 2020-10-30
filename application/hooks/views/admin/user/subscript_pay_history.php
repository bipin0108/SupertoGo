<?php 
  $uid = $this->session->userdata[SESSION_ADMIN]['admin_id'];
  $role_permission = $this->mastermodel->getPermission('User',$uid); 
?>

<link rel="stylesheet" href="<?=base_url('public');?>/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<?php
  $obj=&get_instance();
  $payment=$obj->usermodel->get_subscription_payment_history();
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Webinar Payment History</h1>
      <br>
    </section>
    <!-- Main content --> 
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
           <div class="box box-primary">
            <div class="box-header">
              <?php if(!empty($this->session->flashdata('success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('success'); ?> </span>
              </div>
              <?php endif ?>
              </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Plot Name</th>
                    <th>Transaction ID</th>
                    <th>Payment Type</th>
                    <th>Price</th>
                    <th>From Date</th>
                    <th>To Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                if(!empty($payment)){ 
                  $i = 1;
                ?>  
                <?php foreach($payment as $row) { ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("d M, Y h:i A",strtotime($row->created_at)); ?></td>
                    <td><?php echo $row->user_name; ?></td>
                    <td><?php echo $row->plot_name; ?></td>
                    <td><?php echo $row->txn_id; ?></td>
                    <td><?php echo $row->payment_type; ?></td>
                    <td><?php echo $row->price; ?></td>
                    <td><?php echo date("d M, Y ",strtotime($row->from_date)); ?></td>
                    <td><?php echo date("d M, Y ",strtotime($row->to_date)); ?></td>
                  </tr>                  
                <?php } ?>    
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<!-- DataTables -->
<script src="<?=base_url('public');?>/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public');?>/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#table").DataTable();
  });
</script>


