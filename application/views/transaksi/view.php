<link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">

<!-- DataTables -->
<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>


<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php if($this->session->flashdata('info')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('info'); ?>
              </div>
            <?php } ?>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Pelanggan</th>
                  <th>Tgl Sewa</th>
                  <th>Tgl Kembali</th>
                  <th>Mobil</th>
                  <th>Supir</th>
                  <th>Hari</th>
                  <th>Biaya</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  foreach($transaksi as $row) {

                    if($row->namasupir) {
                      $spr = $row->namasupir;
                    } else {
                      $spr = "<b>Lepas Kunci</b>";
                    }
                  ?>         
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row->namapelanggan; ?></td>
                      <td><?php echo $this->fungsi->DateToIndo($row->tglsewa); ?></td>
                      <td><?php if($row->tglkembali != NULL && $row->tglkembali != '0000-00-00') { echo $this->fungsi->DateToIndo($row->tglkembali); } ?></td>
                      <td><?php echo $row->type; ?></td>
                      <td><?php echo $spr; ?></td>
                      <td><?php echo $row->selisih; ?></td>
                      <td><?php print number_format($row->total); ?></td>
                      <td>
                      <?php 
                      if($row->sttransaksi == "mulai") {
                        echo "<span class='bg-red'><font size=3px>&nbsp;".ucfirst($row->sttransaksi)."&nbsp;</font></span>";
                      } elseif($row->sttransaksi == "selesai") {
                        echo "<span class=\"bg-green\"><font size=3px>&nbsp;".ucfirst($row->sttransaksi)."&nbsp;</font></span>";
                      }
                      ?>
                      </td>

                      <td>
                        <button type="button" class="btn btn-primary" onclick="location.href='<?=base_url()?>transaksi/edit/<?php echo $row->idtransaksi; ?>'"><i class="fa fa-fw fa-edit"></i>Edit</button>

                        <?php /*<button type="button" class="btn btn-warning" onclick="if(confirm('Apakah anda yakin Transaksi <?php echo $row->namapelanggan; ?> akan di update menjadi selesai?')) window.location.href='<?=base_url()?>transaksi/updatestatus/<?php echo $row->idtransaksi; ?>';"><i class="fa fa-fw fa-check-circle"></i>Status</button>*/ ?>

                        <button type="button" class="btn btn-danger" onclick="if(confirm('Apakah anda yakin akan menghapus <?php echo $row->namapelanggan; ?>?')) window.location.href='<?=base_url()?>transaksi/hapus/<?php echo $row->idtransaksi; ?>';"><i class="fa fa-fw fa-trash-o"></i>Delete</button>
                        <?php if($row->total) { ?>
                        <button type="button" class="btn btn-success" onclick="window.location.href='<?=base_url()?>transaksi/pdf/<?php echo $row->idtransaksi; ?>';"><i class="fa fa-fw fa-file-pdf-o"></i>PDF</button>
                        <?php } ?>
                      </td>
                    </tr>
                <?php
                  $no++; }
                ?> 
                </tbody>
                <tfoot>
                <tr>
                 <th>No.</th>
                  <th>Nama Pelanggan</th>
                  <th>Tgl Sewa</th>
                  <th>Tgl Kembali</th>
                  <th>Mobil</th>
                  <th>Supir</th>
                  <th>Hari</th>
                  <th>Biaya</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>