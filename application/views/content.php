<style type="text/css">
  .gambar {
    height: 100px !important;
    width: 130px !important;
  }
</style>

<div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Report Mobil</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php
                  $no = 1;
                  foreach($mobil as $row) {
                  ?>  
                      <li>
                        <img src="<?=base_url()?>/img/<?php echo $row->foto; ?>" alt="User Image" class="gambar">
                        <a class="users-list-name" href="#"><?php echo $row->type; ?></a>
                        <p><?php echo $row->platnomer; ?></p>
                        <span class="users-list-date"><?php echo ucfirst($row->stmobil); ?></span>
                      </li>
                  <?php } ?>

                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?=base_url()?>mobil" class="uppercase">Lihat Semua Mobil</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>