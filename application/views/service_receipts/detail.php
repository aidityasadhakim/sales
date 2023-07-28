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
                <button type="button" onclick="window.close()" class="btn btn-default">Kembali</button>
              </p>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <td width="30%"><strong>Tanggal Transaksi</strong></td>
                    <td>: <?php echo date('d F Y', strtotime($row['transaction_date'])); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nama Pelanggan</strong></td>
                    <td>: <?php echo $row['customer_name']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nomor Handphone</strong></td>
                    <td>: <?php echo $row['phone_number']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Tipe HP</strong></td>
                    <td>: <?php echo $row['phone_type']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kerusakan</strong></td>
                    <td>: <?php echo $row['damage']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kelengkapan</strong></td>
                    <td>: <?php echo $row['attribute']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Penerima</strong></td>
                    <td>: <?php echo $row['recipient']; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Keterangan</strong></td>
                    <td>: <?php echo $row['note']; ?></td>
                  </tr>
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