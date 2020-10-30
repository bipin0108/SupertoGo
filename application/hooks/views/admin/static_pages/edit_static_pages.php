<?php
$obj=&get_instance();
// $id = $_REQUEST['id'];
$id = $this->uri->segment(3);
$static_pages=$obj->staticpagemodel->get_static_pages_by_id($id); 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Pages
    </h1>
  </section>
  <!-- start add category form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo $static_pages['page_title']; ?></h3>
          </div>
          <?php if(!empty($this->session->flashdata('success'))): ?>
          <div class="alert alert-success">
              <button class="close" data-close="alert"></button>
              <span> <?php echo $this->session->flashdata('success'); ?> </span>
          </div>
          <?php endif ?> 
         
          <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
              <button class="close" data-close="alert"></button>
              <span><?php echo $this->session->flashdata('error') ?></span>
          </div>
          <?php endif ?>
          <!-- START add theater form -->
          <?php echo form_open_multipart('admin/update-static-pages'); ?>
            <div class="box-body">
              <div class="col-md-12">
                <input type="hidden" name="id" value="<?php echo $static_pages['id']; ?>" >
                 <div class="form-group">
                      <label>Page Title</label>
                      <input type="text" name="page_title" disabled value="<?php echo $static_pages['page_title']; ?>" class="form-control" placeholder="Page Title" autocomplete="off">
                  </div>

                  <div class="form-group">
                      <label>Page Detail</label>
                      <textarea name="page_detail" id="page_detail" class="form-control" placeholder="Description" autocomplete="off"><?php echo $static_pages['page_detail']; ?></textarea><?php echo form_error('page_detail'); ?>
                  </div>
                  
              </div>
              <div class="col-md-6">
                
              </div> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-md btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add theater form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add category form -->
</div>
<script src="<?=base_url('public');?>/components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    CKEDITOR.replace('page_detail');
    //Add text editor
    // $("#article_desc").wysihtml5();

     var date = new Date();
      date.setDate(date.getDate());

      //Date picker
      $('.date').datepicker({
        autoclose: true,
        startDate: date,
        "setDate": date
      })
    });
</script>