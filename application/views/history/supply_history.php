<?php $this->load->view('layouts/header') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Riwayat - <?php echo getDataColumn('items', 'id', $item_id, 'name') ?></h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Riwayat Mutasi Stok - <?php echo getDataColumn('items', 'id', $item_id, 'name') ?></h5>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="data-table-sale">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if($history): ?>
                            <?php $i = 1 ?>
                            <?php foreach($history as $history): ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= date('d F Y', strtotime($history['transaction_date']))?></td>
                                    <td><?= $history['qty'] ?></td>
                                    <td><?= $history['status'] == 'increase' ? 'Tambah' : 'Kurang' ?></td>
                                    <td><?= $history['keterangan'] ?></td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        <?php else: ?>
                        <?php endif ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
            <div class="card-footer">
                  <a href="<?php echo base_url('stok') ?>" class="btn btn-default float-right">Cancel</a>
                </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<?php $this->load->view('layouts/footer') ?>