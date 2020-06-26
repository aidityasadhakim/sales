<?php $this->load->view('layouts/header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <?php echo $title; ?> </h1>
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
                <h5 class="card-title m-0"><?php echo $title; ?></h5>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="post">
                  <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-3">
                      <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo (isset($start_date)) ? $start_date : '' ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="end_date" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-3">
                      <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo (isset($end_date)) ? $end_date : '' ?>" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-info" name="submit" value="view">Submit</button>
                </form>
                <br><br>
                <?php if (isset($claims)): ?>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="data-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal Transaksi</th>
                          <th>Kode Transaksi</th>
                          <th>Nama Pelanggan</th>
                          <th>Keterangan</th>
                          <th>Pembayaran</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $sumClaim = 0; foreach ($claims as $key => $value): ?>
                          <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo date('d F Y', strtotime($value['transaction_date'])) ?></td>
                            <td><?php echo $value['code']; ?></td>
                            <td><?php echo getDataColumn('customers', 'id', $value['customer_id'], 'name'); ?></td>
                            <td><?php echo $value['note'] ?></td>
                            <td><?php echo ($value['is_cash'] == 1) ? 'Lunas' : 'Utang' ?></td>
                            <td>Rp. <?php echo number_format($value['total']) ?></td>
                          </tr>
                        <?php $sumSale += $value['total']; endforeach ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6"><strong>Total Piutang</strong></td>
                          <td><strong>Rp. <?php echo number_format($sumClaim) ?></strong></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                <?php endif ?>
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
  <!-- /.content-wrapper -->
<?php $this->load->view('layouts/footer'); ?>