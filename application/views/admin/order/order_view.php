<style>
  @media print {
    .main-footer {
        display: none !important;
    }
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Order View</h1>
  </section>
  <!-- Main content -->
  <section class="content">
     <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="<?=base_url('public/images/favicon.jpeg');?>" alt="<?=APP_NAME;?>"  width="50px"> <?=APP_NAME;?> #<?=$order['order_no'];?>
            <small class="pull-right">Date: <?=$order['order_date'].' '.$order['order_time'];?><br>
              <?php if($order['is_cancel'] == '0') { ?>
                <h4><?=$order['order_status'];?></h4>
             <?php }else{ ?>
               <h4><?=$order['cancel_by'];?></h4>
             <?php }?>
              
            </small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
         
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?=$order['username'];?></strong><br>
            <?=$order['address'];?>
            Phone: <?=$order['mobile'];?><br>
            Email: <?=$order['email'];?>
          </address>
        </div>
        
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <?php 
            $store = $order['store'];
            $sub_total = 0;
            
            foreach ($store as $row) { 
              $products = $row['product'];
            ?>
              <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Weight</th>
              <th>Unit</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr><td colspan="7"><img src="<?=$row['store_icon']?>" alt="" width="50px"> <?=$row['name']?> </td></tr>
            <?php foreach ($products as $idx => $product) { 
              $total = ($product['price'] * $product['item_count']);
              $sub_total += $total; ?>
              <tr>
                <td><?=$idx+1;?></td>
                <td><?=$product['name'];?></td>
                <td><?=$product['weight'];?></td>
                <td><?=$product['unit'];?></td>
                <td><?=$product['currency'].$product['price'];?></td>
                <td><?=$product['item_count'];?></td>
                <td><?=$product['currency'].$total;?></td>
              </tr>
            <?php } ?>
            
            </tbody>
          </table>
          <?php } ?>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="<?=base_url('public/dist/img/credit/visa.png');?>" alt="Visa">
          <img src="<?=base_url('public/dist/img/credit/mastercard.png');?>" alt="Mastercard">
          <img src="<?=base_url('public/dist/img/credit/american-express.png');?>" alt="American Express">
          <img src="<?=base_url('public/dist/img/credit/paypal2.png');?>" alt="Paypal">

         <!--  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
 

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Subtotal:</th>
                <td><?=$order['currency'].$sub_total;?></td>
              </tr>
              <?php if(!empty($order['promocode'])){ ?>
                <tr>
                  <th>Promocode (<?=$order['promocode'];?>)</th>
                  <td><?=$order['currency'].$order['promocode_price'];?></td>
                </tr>
              <?php } ?>
              <tr>
                <th>Delivery Charge:</th>
                <td><?=$order['currency'].$order['delivery_charge'];?></td>
              </tr>
              <tr>
                <th>Grand Total:</th>
                <td><?=$order['currency'].$order['grand_price'];?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="javascript:;window.print();" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.row -->
    </section>
  <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
 



