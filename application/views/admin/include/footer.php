  <footer class="main-footer">
     <strong>Copyright © <?=APP_NAME;?> 2020</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<script src="<?=base_url('public/components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('public/components/PACE/pace.min.js')?>"></script>
<script src="<?=base_url('public/components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?=base_url('public/components/fastclick/lib/fastclick.js')?>"></script>
<script src="<?=base_url('public/dist/js/adminlte.min.js')?>"></script>
<script src="<?=base_url('public/dist/js/demo.js')?>"></script>
<script src="<?=base_url('public/loadingoverlap/loadingoverlay.min.js');?>"></script>
<script src="<?=base_url('public/loadingoverlap/loadingoverlay_progress.min.js');?>"></script>
<script src="<?=base_url('public/components/moment/min/moment.min.js')?>"></script>
<script src="<?=base_url('public/components/select2/dist/js/select2.full.min.js')?>"></script>
<script src="<?=base_url('public/plugins/iCheck/icheck.min.js');?>"></script>
  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree();
    });
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
  <?php /* START Image popup Modal */ ?> 
  <script src="<?=base_url('public');?>/dist/js/jquery.magnify.js"></script>
  <script>
    $('[data-magnify]').magnify({
      headToolbar: [
        'close'
      ],
      initMaximized: true
    });
  </script>
  <script>
    $(document).ready(function() {
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    });
  </script>
  <?php /* END Image popup Modal */ ?> 
</body>
</html>
