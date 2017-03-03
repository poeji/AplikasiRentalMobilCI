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

  <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data Mobil <strong><?php echo $edit->type; ?></strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

           <?php echo form_open_multipart('mobil/edit'); ?>
              <input type="hidden" name="id" value="<?php echo $edit->idmobil; ?>">
              <div class="box-body">

                <?php if(validation_errors() != false) { ?>
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo validation_errors(); ?>
                </div>
                <?php } ?>

                <div class="form-group">
                  <label for="merk">Type Mobil</label>
                  <input type="text" name="type" id="type" class="form-control" placeholder="Type Mobil" value="<?php echo $edit->type; ?>">
                </div>
                <div class="form-group">
                <label>Merk Mobil</label>
                <option value="" selected="selected"></option>
                <select class="form-control select2" name="idmerk" id="idmerk" style="width: 100%;">
                  <?php
                  $no = 1;
                  foreach($list as $row) {
                  ?> 
                    <option value="<?php echo $row->idmerk; ?>" <?php if($edit->idmerk == $row->idmerk) { ?>selected="selected"<?php } ?> ><?php echo $row->namamerk; ?></option>
                  <?php
                  $no++; }
                  ?> 
                </select>
              </div>
              <div class="form-group">
                  <label for="merk">Tahun Mobil</label>
                  <input type="text" name="tahun" id="tahun" class="form-control" placeholder="Tahun Mobil" 
                  value="<?php echo $edit->tahunproduksi; ?>">
                </div>
              <div class="form-group">
                  <label for="merk">No. Plat Mobil</label>
                  <input type="text" name="plat" id="plat" class="form-control" placeholder="No. Plat Mobil" value="<?php echo $edit->platnomer; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Jumlah Kursi</label>
                  <input type="text" name="kursi" id="kursi" class="form-control" placeholder="Jumlah Kursi" value="<?php echo $edit->kursi; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Tarif Sewa /Jam</label>
                  <input type="text" name="tarif" id="tarif" class="form-control" placeholder="Tarif Sewa /Jam" value="<?php echo $edit->tarif; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">Tarif Overtime /Jam</label>
                  <input type="text" name="lembur" id="lembur" class="form-control" placeholder="Tarif Overtime /Jam" value="<?php echo $edit->lembur; ?>">
                </div>
                <div class="form-group">
                  <label for="merk">No. Rangka Mobil</label>
                  <input type="text" name="rangka" id="rangka" class="form-control" placeholder="No. Rangka Mobil" value="<?php echo $edit->norangka; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Foto Mobil</label>
                  <input type="file" id="foto" name="foto">
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