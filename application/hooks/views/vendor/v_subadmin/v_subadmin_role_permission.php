<?php 
$obj=&get_instance();
$user_id = $this->uri->segment(3);
$role_permission=$obj->v_subadminmodel->get_vendor_role_permission_by_user($user_id); 
?> 
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Role Permission
       <div class="pull-right">
        <a href="<?php echo base_url('vendor/vendor-subadmin-list'); ?>" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-backward"></i> Back</a>
      </div>
    </h1>
  </section>
  <!-- start add subadmin form -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Permission</h3>
          </div>
          <form method="post" action="<?php echo base_url('vendor/vendor-subadmin-role-permission/'.$user_id) ?>">
            <input type="hidden" name="uid" value="<?php echo $user_id; ?>">
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>All</th>
                    <th>Is Add</th>
                    <th>Is Edit</th>
                    <th>Is View</th>
                    <th>Is Delete</th>
                  </tr>
                </thead>
                <tbody>
                	<?php if(!empty($role_permission)){  $i = 1; ?>
		            	<?php foreach($role_permission as $row) { 

		            		$all = 0;
		            		if(!empty($row->is_add) && !empty($row->is_edit) && !empty($row->is_view) && !empty($row->is_delete)){
		            			$all=1;
		            		}

		            		?>
		                    <tr>
		                      <td>
		                        <?php echo $i++; ?> <input type="hidden" name="pids[]" value="<?php echo $row->role_permission_id; ?>" >
		                      </td>
		                      <td><?php echo $row->permission_name ?></td>
		                      <td><input  class="all" type="checkbox"  <?php echo !empty($all)?'checked':''; ?>></td>
		                      <td>
		                        <input class="checkbox"  type="checkbox" <?php echo !empty($row->is_add)?'checked':''; ?>>
		                        <input class="add" type="hidden" name="is_add[]" value="<?php echo $row->is_add ?>">
		                      </td>
		                      <td>
		                        <input class="checkbox"  type="checkbox" <?php echo !empty($row->is_edit)?'checked':''; ?>>
		   			           <input class="edit" type="hidden" name="is_edit[]" value="<?php echo $row->is_edit ?>">
		                      </td>
		                      <td>
		                        <input class="checkbox"  type="checkbox" <?php echo !empty($row->is_view)?'checked':''; ?>>
		                        <input class="view" type="hidden" name="is_view[]" value="<?php echo $row->is_view ?>">
		                      </td>
		                      <td>	
		                        <input class="checkbox"  type="checkbox" <?php echo !empty($row->is_delete)?'checked':''; ?>>
		                        <input class="delete" type="hidden" name="is_delete[]" value="<?php echo $row->is_delete ?>">
		                      </td>
		                    </tr>
                		<?php } ?>	
                	<?php } ?>
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="Save" class="btn btn-sm btn-primary">
            </div>
          </form>
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add subadmin form -->
</div>
<script type="text/javascript">
$(".checkbox").on('change', function(){
    if(this.checked){
      $(this).next('input').val(1);
    }else{
       $(this).next('input').val(0);
    }
  });

  $(".all").on('change', function(){
    if(this.checked){
      $(this).closest('tr').find('.add').val(1);
      $(this).closest('tr').find('.edit').val(1);
      $(this).closest('tr').find('.view').val(1);
      $(this).closest('tr').find('.delete').val(1);
      $(this).closest('tr').find('.checkbox').prop('checked',true);
    }else{
      $(this).closest('tr').find('.add').val(0);
      $(this).closest('tr').find('.edit').val(0);
      $(this).closest('tr').find('.view').val(0);
      $(this).closest('tr').find('.delete').val(0);
      $(this).closest('tr').find('.checkbox').prop('checked',false);
    }    
  });
</script>