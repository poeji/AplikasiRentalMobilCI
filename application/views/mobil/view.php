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
              <h3 class="box-title">Data Mobil</h3>
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
                  <th>Merk</th>
                  <th>Type</th>
                  <th>Plat Nomer</th>
                  <th>Tarif /jam</th>
                  <th>Overtime /jam</th>
                  <th>Kursi</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  foreach($mobil as $row) {
                  ?>         
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row->type; ?></td>
                      <td><?php echo $row->type; ?></td>
                      <td><?php echo $row->platnomer; ?></td>
                      <td><?php echo number_format($row->tarif); ?></td>
                      <td><?php echo number_format($row->lembur); ?></td>
                      <td><?php echo $row->kursi; ?></td>
                      <td><?php echo ucfirst($row->stmobil); //echo $this->fungsi->status($row->stmobil); ?></td>
                      <td>
                        <button type="submit" class="btn btn-primary" onclick="location.href='<?=base_url()?>mobil/edit/<?php echo $row->idmobil; ?>'"><i class="fa fa-fw fa-edit"></i>Edit</button>
                        <button type="submit" class="btn btn-danger" onclick="if(confirm('Apakah anda yakin akan menghapus <?php echo $row->type; ?>?')) window.location.href='<?=base_url()?>mobil/hapus/<?php echo $row->idmobil; ?>';"><i class="fa fa-fw fa-trash-o"></i>Delete</button>
                      </td>
                    </tr>
                <?php
                  $no++; }
                ?> 
                </tbody>
                <tfoot>
                <tr>
                 <th>No.</th>
                  <th>Nama Merk</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>