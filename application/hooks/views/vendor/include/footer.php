<footer class="main-footer">
     <strong>Copyright © Smart Crop 2019</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<script src="<?=base_url('public')?>/components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url('public')?>/components/PACE/pace.min.js"></script>
<script src="<?=base_url('public')?>/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url('public')?>/components/fastclick/lib/fastclick.js"></script>
<script src="<?=base_url('public')?>/dist/js/adminlte.min.js"></script>
<script src="<?=base_url('public')?>/dist/js/demo.js"></script>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay.min.js"></script>
<script src="<?=base_url('public');?>/loadingoverlap/loadingoverlay_progress.min.js"></script>
<script src="<?=base_url('public')?>/components/moment/min/moment.min.js"></script>

<script src="<?=base_url('public')?>/components/select2/dist/js/select2.full.min.js"></script>
<!-- <script src="<?=base_url('public')?>/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

<script src="<?=base_url('public')?>/plugins/timepicker/bootstrap-timepicker.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js" ></script> -->
  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
    $(document).ajaxStart(function () {
      Pace.restart();
    });
    $(document).ready(function(){
      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
      });
      var activeTab = localStorage.getItem('activeTab');
      if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
      }
    });
  </script>
</body>
</html>
