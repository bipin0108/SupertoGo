<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?=lang('Product');?>
      <a href="<?php echo base_url('admin/product-list/'); ?>" class="btn btn-primary pull-right" > <i class="fa fa-angle-double-left" aria-hidden="true"></i>  <?=lang('Back to List');?></a>
    </h1>
  </section>
  <!-- start add intensity form -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?=lang('Edit');?>
            </h3>
          </div>
          
          <!-- START add intensity form -->
          <?php echo form_open_multipart('admin/update-product'); ?>
            <div class="box-body">
              <?php if(!empty($this->session->flashdata('success'))): ?>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span> <?php echo $this->session->flashdata('success'); ?> </span>
              </div>
              <?php endif ?> 
              <?php if($this->session->flashdata('error')): ?>
              <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span><?php echo $this->session->flashdata('error') ?></span>
              </div>
              <?php endif ?>
              <div class="col-xs-12 col-md-6">
                <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" >
                <div class="form-group">
                  <label><?=lang('Name');?></label>
                  <input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control" placeholder="<?=lang('Name');?>" autocomplete="off">
                  <?php echo form_error('name'); ?>
                </div>
                <div class="form-group">
                  <label><?=lang('Category');?></label>
                  <select class="form-control" name="cat_id">
                    <option value=""><?=lang('Category');?></option>
                    <?php foreach ($category as $row) { ?>
                      <option <?= ($row['cat_id'] == $product['cat_id'])?'selected':''; ?> value="<?php echo $row['cat_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php }  ?>
                  </select>
                  <?php echo form_error('cat_id'); ?>
                </div>
                <div class="form-group">
                  <label><?=lang('Store');?></label>
                  <select class="form-control select2" id="store_id" name="store_ids[]" multiple="multiple" data-placeholder="<?=lang('Store');?>" style="width: 100%;">
                    <?php foreach ($store as $row) { ?>
                      <option value="<?php echo $row['store_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php }  ?>
                  </select>
                  <?php echo form_error('store_ids[]'); ?>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div id="product_detail"></div>  
                <br>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <a data-magnify="gallery" data-caption="" href="<?php echo base_url('uploads/product/'.$product['image']); ?>"><img class="img-responsive" style="height:100px;" src="<?php echo base_url('uploads/product/'.$product['image']); ?>"></a>
                </div>
                <div class="form-group">
                  <label><?=lang('Image');?></label>
                  <input type="file" class="form-control" name="image" accept=".png,.jpg,.jpeg" >
                  <?php echo form_error('image'); ?>
                </div>
                <div class="form-group">
                  <label><?=lang('Description');?></label>
                  <textarea name="description" class="form-control"><?php echo $product['description']; ?></textarea>
                  <?php echo form_error('description'); ?>
                </div> 
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" value="<?=lang('Save');?>" class="btn btn-primary">
            </div>
          <?php form_close();  ?>
          <!-- END add intensity form -->
        </div>
      </div> 
    </div>
  </section>    
  <!-- end add intensity form -->
</div>

<!--  Add Brand Modal -->
<div class="modal fade in" id="modalBrandAdd">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add Brand</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-6">
          <div class="form-group">
            <label for="brand">Brand Name</label>
            <input type="text" id="brand" placeholder="Enter Brand Name" class="form-control" name="brand">
            <div class="brand_error" style="display: none;"><span class="error" style="color:red;">Please enter brand name.</span></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="ladda-button btn btn-primary brand_add" data-style="zoom-out"><span class="ladda-label">Save</span><span class="ladda-spinner"></span></button>
      </div>
    </div>
  </div>
</div>


<script>
  function product_detail(store_ids){
    $('#product_detail').html("");
    if(store_ids.length > 0){
      for (var i = 0; i < store_ids.length; i++) {
        let store_id = store_ids[i];
        $.post("<?=base_url('admin/ajax/getCityByStoreId/');?>"+store_id, {product_id:'<?php echo $product['product_id'] ?>'}, function(res){
          var product_detail = res.product_detail;
          if(product_detail.length > 0){
            product_detail = product_detail[0];
            let keys = Object.keys(product_detail);
            for (var j = 0; j < keys.length; j++) {
              var i_key = keys[j];
              var i_val = product_detail[i_key];
              let pro_html = "";
              pro_html += '<h4>'+i_key+'</h4>';
              pro_html += '<div class="box-body table-responsive no-padding">\
              <table class="table table-hover">\
                <thead>\
                  <th><?=lang('City');?></th>\
                  <th><?=lang('Brand');?></th>\
                  <th><?=lang('Weight');?></th>\
                  <th><?=lang('Unit');?></th>\
                  <th><?=lang('Qty');?></th>\
                  <th><?=lang('Price');?></th>\
                  <th><?=lang('Action');?></th>\
                </thead>\
                <tbody>';

              let sub_keys = Object.keys(i_val);
              for (var k = 0; k < sub_keys.length; k++) {
                var j_key = sub_keys[k];
                var j_val = product_detail[i_key][j_key];

                var city = j_val;
                  for (var l = 0; l < city.length; l++) {
                    pro_html += '<tr class="city'+city[l].city_id+'">';
                      if(l == 0){
                        pro_html += '<td style="vertical-align: middle;">\
                          '+city[l].city_name+'\
                          <input type="hidden" name="item_id[]" value="'+city[l].item_id+'" />\
                          <input type="hidden" name="store_id[]" value="'+city[l].store_id+'" />\
                          <input type="hidden" name="city_id[]" value="'+city[l].city_id+'" />\
                        </td>';
                      }else{
                        pro_html += '<td style="vertical-align: middle;">\
                          <input type="hidden" name="item_id[]" value="'+city[l].item_id+'" />\
                          <input type="hidden" name="store_id[]" value="'+city[l].store_id+'" />\
                          <input type="hidden" name="city_id[]" value="'+city[l].city_id+'" />\
                        </td>';
                      }
                      pro_html += '<td>\
                        <select class="form-control brand" name="brand_id[]" >\
                          <option value=""><?=lang('Brand');?></option>';
                          var brand = res.brand;  
                          for(var ix = 0; ix<brand.length; ix++){
                            pro_html += '<option '+ ((brand[ix].brand_id == city[l].brand_id) ? "selected" : "") +' value="'+ brand[ix].brand_id +'">'+ brand[ix].name +'</option>'; 
                          }
                        pro_html += '</select>\
                      </td>\
                      <td><input type="text" class="form-control" name="weight[]" value="'+city[l].weight+'" placeholder="<?=lang('Weight');?>"></td>\
                      <td>\
                        <select class="form-control" name="unit[]" >\
                          <option value=""><?=lang('Unit');?></option> \
                          <option '+ ((city[l].unit == "Lbs") ? "selected" : "") +' value="Lbs">Lbs</option>\
                          <option '+ ((city[l].unit == "Ltr") ? "selected" : "") +' value="Ltr">Ltr</option>\
                          <option '+ ((city[l].unit == "Pcs") ? "selected" : "") +' value="Pcs">Pcs</option>\
                          <option '+ ((city[l].unit == "gms") ? "selected" : "") +' value="gms">gms</option>\
                          <option '+ ((city[l].unit == "Kg")  ? "selected" : "") +' value="Kg">Kg</option>\
                          <option '+ ((city[l].unit == "oz")  ? "selected" : "") +' value="oz">oz</option>\
                          <option '+ ((city[l].unit == "ml")  ? "selected" : "") +' value="ml">ml</option>\
                          <option '+ ((city[l].unit == "Packet") ? "selected" : "") +' value="Packet">Packet</option>\
                        </select>\
                      </td>\
                      <td><input type="text" class="form-control" name="qty[]" value="'+city[l].qty+'" placeholder="<?=lang('Qty');?>"></td>\
                      <td><input type="text" class="form-control" name="price[]" value="'+city[l].price+'" placeholder="<?=lang('Price');?>"></td>';
                      if(l == 0){
                        pro_html += '<td><a tabindex="-1" href="javascript:;" class="btn btn-sm btn-primary add" data-store_id="'+city[l].store_id+'" data-city_id="'+city[l].city_id+'"><i class="fa fa-plus"></i></a></td>';
                      }else{
                        pro_html += '<td><a tabindex="-1" href="javascript:;" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></a></td>';
                      }
                    pro_html += '</tr>';
                  }
                }
                pro_html += '</tbody>\
                </table>\
              </div>';
              $('#product_detail').append(pro_html);
            }
          }else{
            let pro_html = "";
            pro_html += '<h4>'+res.store_name+'</h4>\
            <div class="box-body table-responsive no-padding">\
              <table class="table table-hover">\
                <thead>\
                  <th><?=lang('City');?></th>\
                  <th><?=lang('Brand');?></th>\
                  <th><?=lang('Weight');?></th>\
                  <th><?=lang('Unit');?></th>\
                  <th><?=lang('Qty');?></th>\
                  <th><?=lang('Price');?></th>\
                  <th><?=lang('Action');?></th>\
                </thead>\
                <tbody>';
                  var city = res.data;
                  for (var n = 0; n < city.length; n++) {
                    var city_id = city[n].city_id;
                    pro_html += '<tr  class="city'+city_id+'">\
                      <td style="vertical-align: middle;">\
                        '+city[n].name+'\
                        <input type="hidden" name="item_id[]" value="0" />\
                        <input type="hidden" name="store_id[]" value="'+store_id+'" />\
                        <input type="hidden" name="city_id[]" value="'+city_id+'" />\
                      </td>\
                      <td>\
                        <select class="form-control brand" name="brand_id[]" >\
                          <option value=""><?=lang('Brand');?></option>';
                          var brand = res.brand; 
                          for(var ix = 0; ix<brand.length; ix++){
                            pro_html += '<option value="'+ brand[ix].brand_id +'">'+ brand[ix].name +'</option>';
                          }
                        pro_html += '</select>\
                      </td>\
                      <td><input type="text" class="form-control" name="weight[]" placeholder="<?=lang('Weight');?>"></td>\
                      <td>\
                        <select class="form-control" name="unit[]" >\
                          <option value=""><?=lang('Unit');?></option> \
                          <option value="Lbs">Lbs</option>\
                          <option value="Ltr">Ltr</option>\
                          <option value="Pcs">Pcs</option>\
                          <option value="gms">gms</option>\
                          <option value="Kg">Kg</option>\
                          <option value="oz">oz</option>\
                          <option value="ml">ml</option>\
                          <option value="Packet">Packet</option>\
                        </select>\
                      </td>\
                      <td><input type="text" class="form-control" name="qty[]" placeholder="<?=lang('Qty');?>"></td>\
                      <td><input type="text" class="form-control" name="price[]" placeholder="<?=lang('Price');?>"></td>\
                      <td><a tabindex="-1" href="javascript:;" class="btn btn-sm btn-primary add" data-store_id="'+store_id+'" data-city_id="'+city_id+'"><i class="fa fa-plus"></i></a></td>\
                    </tr>';
                  }
                pro_html += '</tbody>\
              </table>\
            </div>';
            $('#product_detail').append(pro_html);
          }
        });   
      }
    }
  }

  $(document).ready(function(){
    $('.select2').select2().on('select2:select', function (event) {
      product_detail($(this).val());
    }).on('select2:unselect', function (event) {
      product_detail($(this).val());
    });
    
    setTimeout(function(){
      $('.select2').select2().val(<?php echo json_encode(explode(',', $product['store_ids'])); ?>).trigger('change');
    }, 200);

    product_detail(<?php echo json_encode(explode(',', $product['store_ids'])); ?>);

    $(document).on('click', '.add', function(){
      var $this = $(this);
      var city_id = $this.data('city_id'); 
      var store_id = $this.data('store_id'); 
      var city_html = '<tr class="city'+city_id+'">\
        <td style="vertical-align: middle;">\
          <input type="hidden" name="item_id[]" value="0" />\
          <input type="hidden" name="store_id[]" value="'+store_id+'" />\
          <input type="hidden" name="city_id[]" value="'+city_id+'" />\
        </td>\
        <td>\
          <select class="form-control brand" name="brand_id[]" >\
            <option value=""><?=lang('Brand');?></option>\
          </select>\
        </td>\
        <td><input type="text" class="form-control" name="weight[]" placeholder="<?=lang('Weight');?>"></td>\
        <td>\
          <select class="form-control" name="unit[]" >\
            <option value=""><?=lang('Unit');?></option> \
            <option value="Lbs">Lbs</option>\
            <option value="Ltr">Ltr</option>\
            <option value="Pcs">Pcs</option>\
            <option value="gms">gms</option>\
            <option value="Kg">Kg</option>\
            <option value="oz">oz</option>\
            <option value="ml">ml</option>\
            <option value="Packet">Packet</option>\
          </select>\
        </td>\
        <td><input type="text" class="form-control" name="qty[]" placeholder="<?=lang('Qty');?>"></td>\
        <td><input type="text" class="form-control" name="price[]" placeholder="<?=lang('Price');?>"></td>\
        <td><a tabindex="-1" href="javascript:;" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></a></td>\
      </tr>';
      $(city_html).insertAfter($this.closest("tbody").find('.city'+city_id).last());
      $.post("<?=base_url('admin/ajax/getBrand');?>",function (data) {
        var lenght = data.length;
        var brand_html = "<option value=''>Select Brand</option>";
        for(var i = 0; i<lenght; i++){
          brand_html += "<option value='"+ data[i].brand_id +"'>"+ data[i].name +"</option>";
        }
        $this.closest("tbody").find('.city'+city_id).last().find('.brand').html(brand_html);
      });
    });

    $(document).on('click', '.remove', function(){
      $(this).parent('td').parent('tr').remove();
    });

    $(document).on('click', '.brand_add', function(){
      var val = $("#brand").val();
      if(val == ""){
        $(".brand_error").show();
      }else{
        $(this).attr("disabled",true);
        $(".brand_error").hide();
        $.post("<?=base_url('admin/ajax/addBrand/');?>"+val,function(res){
          if(res.status){
            getBrand();
            setTimeout(function() {
              brand.val(res.brand_id).trigger("change");
              $("#brand").val('');
              $("#modalBrandAdd").modal('hide');
            }, 500);
          }
        });
      }
    });

  });
</script>
