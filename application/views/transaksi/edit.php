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
    $('#tglsewa').datepicker({ autoclose: true, dateFormat: 'yy-mm-dd' });
    $('#tglkembali').datepicker({ autoclose: true, dateFormat: 'yy-mm-dd' });
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
              <h3 class="box-title">Edit Data Transaksi <?php echo $edit->namapelanggan; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open('transaksi/edit'); ?>
           <input type="hidden" name="id" value="<?php echo $edit->idtransaksi; ?>">

              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>
                <div class="form-group">
                  <label for="merk">Tanggal Sewa</label>
                  <input type="text" name="tglsewa" id="tglsewa" class="form-control" placeholder="Tanggal Sewa" 
                  value="<?php echo $edit->tglsewa; ?>" data-date-format="yyyy-mm-dd" />
                </div>
                <div class="form-group">
                  <label for="merk">Tanggal Kembali</label>
                  <input type="text" name="tglkembali" id="tglkembali" class="form-control" placeholder="Tanggal Kembali" 
                  value="<?php if($edit->tglkembali != NULL && $edit->tglkembali != '0000-00-00') { echo $edit->tglkembali; } ?>" data-date-format="yyyy-mm-dd" />
                </div>
                <div class="form-group">
                  <label for="merk">Nama Pelanggan</label>
                  <input type="text" name="namapelanggan" id="namapelanggan" class="form-control" placeholder="Nama Pelanggan" 
                  value="<?php echo $edit->namapelanggan; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">No. KTP</label>
                  <input type="text" name="noktp" id="noktp" class="form-control" placeholder="No. KTP" 
                  value="<?php echo $edit->noktp; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">No. HP</label>
                  <input type="text" name="nohp" id="nohp" class="form-control" placeholder="No. HP" 
                  value="<?php echo $edit->nohp; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" 
                  value="<?php echo $edit->alamat; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Jumlah Hari</label>
                  <input type="text" name="selisih" id="selisih" class="form-control" placeholder="Jumlah Hari" 
                  value="<?php echo $edit->selisih; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Total</label>
                  <input type="text" name="total" id="total" class="form-control" placeholder="Total" 
                  value="<?php echo $edit->total; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" 
                  value="<?php echo $edit->alamat; ?>">
                </div>

                <div class="form-group">
                  <label>Type Mobil</label>
                  
                  <select class="form-control select2" name="idmobil" id="idmobil" style="width: 100%;">
                  <option value="" selected="selected">--- Pilih</option>
                    <?php
                    $no = 1;
                    foreach($mobil as $row) {
                    ?> 
                      <option value="<?php echo $row->idmobil; ?>" <?php if($edit->idmobil == $row->idmobil) { ?>selected="selected"<?php } ?> ><?php echo $row->type; ?></option>
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
                      <option value="<?php echo $row->idsupir; ?>"  <?php if($edit->idsupir == $row->idsupir) { ?>selected="selected"<?php } ?>><?php echo $row->namasupir; ?></option>
                    <?php
                    $no++; }
                    ?> 
                  </select>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  
                  <select class="form-control select2" name="sttransaksi" id="sttransaksi" style="width: 100%;">
                  <option value="" selected="selected">--- Pilih</option>
                  <option value="mulai" <?php if($edit->sttransaksi == "mulai") { ?>selected="selected"<?php } ?>>Mulai</option>
                  <option value="selesai" <?php if($edit->sttransaksi == "selesai") { ?>selected="selected"<?php } ?>>Selesai</option>
                  </select>
                </div>
              
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Update</button>
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