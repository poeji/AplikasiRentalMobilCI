<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/select2/select2.min.css">
  <!-- Select2 -->
<script src="<?=base_url()?>assets/plugins/select2/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
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
              <h3 class="box-title">Tambah Data Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open('transaksi/add'); ?>

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>
                <div class="form-group">
                  <label for="merk">Tanggal Sewa</label>
                  <input type="text" name="tglsewa" id="datepicker" class="form-control" placeholder="Tanggal Sewa" 
                  value="<?php echo set_value('tglsewa'); ?>" data-date-format="yyyy-mm-dd" />
                </div>
                <div class="form-group">
                  <label for="merk">Nama Pelanggan</label>
                  <input type="text" name="namapelanggan" id="namapelanggan" class="form-control" placeholder="Nama Pelanggan" 
                  value="<?php echo set_value('namapelanggan'); ?>">
                </div>
                <div class="form-group">
                  <label for="merk">No. KTP</label>
                  <input type="text" name="noktp" id="noktp" class="form-control" placeholder="No. KTP" 
                  value="<?php echo set_value('noktp'); ?>">
                </div>
                <div class="form-group">
                  <label for="merk">No. HP</label>
                  <input type="text" name="nohp" id="nohp" class="form-control" placeholder="No. HP" 
                  value="<?php echo set_value('nohp'); ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" 
                  value="<?php echo set_value('alamat'); ?>">
                </div>

                <div class="form-group">
                  <label>Type Mobil</label>
                  
                  <select class="form-control select2" name="idmobil" id="idmobil" style="width: 100%;">
                  <option value="" selected="selected">--- Pilih</option>
                    <?php
                    $no = 1;
                    foreach($mobil as $row) {
                    ?> 
                      <option value="<?php echo $row->idmobil; ?>"><?php echo $row->type; ?></option>
                    <?php
                    $no++; }
                    ?> 
                  </select>
                </div>
                <div class="form-group">
                  <label>Supir</label>
                  
                  <select class="form-control select2" name="idsupir" id="idsupir" style="width: 100%;">
                  <option value="" selected="selected">--- Pilih</option>
                  <option value="0">Lepas Kunci</option>
                    <?php
                    $no = 1;
                    foreach($supir as $row) {
                    ?> 
                      <option value="<?php echo $row->idsupir; ?>"><?php echo $row->namasupir; ?></option>
                    <?php
                    $no++; }
                    ?> 
                  </select>
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