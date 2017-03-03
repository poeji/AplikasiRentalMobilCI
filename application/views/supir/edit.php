<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datepicker/datepicker3.css">
  <!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
     //Date picker
    $('#datepicker').datepicker({ autoclose: true, dateFormat: 'yy-mm-dd' });
      //dateFormat: 'yy-mm-dd'
//}{
     //// autoclose: true,
     // dateFormat: 'yy-mm-dd'
    //});
  });
</script>

  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Supir <strong><?php echo $edit->namasupir; ?></strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('supir/edit'); ?>
           <input type="hidden" name="id" value="<?php echo $edit->idsupir; ?>">

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                  <label for="merk">Nama Supir</label>
                  <input type="text" name="namasupir" id="namasupir" class="form-control" placeholder="Nama Supir" value="<?php echo $edit->namasupir; ?>">
                </div>
              <div class="form-group">
                  <label for="merk">Tanggal Lahir</label>
                  <input type="text" name="tgllahir" id="datepicker" class="form-control" placeholder="Tanggal Lahir" 
                  value="<?php echo $edit->tgllahir; ?>" data-date-format="yyyy-mm-dd">
                </div>
              <div class="form-group">
                  <label for="merk">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="<?php echo $edit->alamat; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">No. KTP</label>
                  <input type="text" name="noktp" id="noktp" class="form-control" placeholder="No. KTP" value="<?php echo $edit->noktp; ?>">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
          
          <!-- /.box -->

          
          <!-- /.box -->

          <!-- Input addon -->
          
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        
        <!--/.col (right) -->
      </div>