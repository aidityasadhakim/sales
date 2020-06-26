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
                <?php if (isset($total_profit)): ?>
                  <hr>
                  <h4>Laba/Rugi Periode <?php echo date('d F Y', strtotime($start_date)) ?> - <?php echo date('d F Y', strtotime($end_date)) ?></h4>
                  <div class="table-responsive mt-10">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Total Penjualan</th>
                          <th>Total Pembelian</th>
                          <th>Laba (Rugi)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Rp. <?php echo number_format($total_sale) ?></td>
                          <td>Rp. <?php echo number_format($total_purchase) ?></td>
                          <td>
                            <?php if ($total_profit < 0): ?>
                              Rp. (<?php echo number_format($total_profit) ?>)
                            <?php else: ?>
                              Rp. <?php echo number_format($total_profit) ?>
                            <?php endif ?>
                          </td>
                        </tr>
                      </tbody>
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