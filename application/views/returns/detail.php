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
                <p>
                  <a href="<?php echo base_url('retur') ?>" class="btn btn-default">Kembali</a>
                </p>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tbody>
                        <tr>
                          <td><strong>Tanggal Transaksi</strong></td>
                          <td><?php echo date('d F Y', strtotime($rowRetur['transaction_date'])) ?></td>
                        </tr>
                        <tr>
                          <td><strong>Keterangan</strong></td>
                          <td><?php echo $rowRetur['note'] ?></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <hr>
                <h5>Data Penjualan</h5>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tbody>
                        <tr>
                          <td><strong>Kode Transaksi</strong></td>
                          <td>: <?php echo $rowNota['code'] ?></td>
                        </tr>
                        <tr>
                          <td><strong>Tanggal Transaksi</strong></td>
                          <td><?php echo date('d F Y', strtotime($rowNota['transaction_date'])) ?></td>
                        </tr>
                        <tr>
                          <td><strong>Pelanggan</strong></td>
                          <td><?php echo $rowNota['c_name'] ?></td>
                        </tr>
                        <tr>
                          <td><strong>Keterangan</strong></td>
                          <td><?php echo $rowNota['note'] ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Harga</strong></td>
                          <td>Rp. <?php echo number_format($rowNota['total']) ?></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($resDetailNota as $key => $value): ?>
                        <tr>
                          <td><?php echo $key+1 ?></td>
                          <td><?php echo $value['name'] ?></td>
                          <td>Rp. <?php echo number_format($value['price']) ?></td>
                          <td><?php echo $value['qty'] ?></td>
                          <td>Rp. <?php echo number_format($value['price'] * $value['qty']) ?></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3" class="text-right"><strong>Total Biaya</strong></td>
                        <td colspan="2">Rp. <?php echo number_format($rowNota['total']) ?></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><strong>Jumlah Bayar</strong></td>
                        <td colspan="2">Rp. <?php echo number_format($rowNota['cash']) ?></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><strong>Kembalian</strong></td>
                        <td colspan="2">Rp. <?php echo number_format($rowNota['changes']) ?></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
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