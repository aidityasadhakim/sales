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
              <form class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="transaction_date" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-4">
                      <input type="date" name="transaction_date" class="form-control" id="transaction_date" required readonly value="<?php echo date('Y-m-d') ?>">
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_customer" name="is_customer" value="1">
                        <label class="form-check-label" for="is_customer">Pelanggan</label>
                      </div>
                    </div>
                  </div> -->
                  <div class="form-group row">
                    <label for="customer_id" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-4">
                      <input type="text" name="name" class="form-control" id="name" required >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-5">
                      <input type="number" name="phone" class="form-control" id="phone" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tipe_hp" class="col-sm-2 col-form-label">Tipe HP</label>
                    <div class="col-sm-5">
                      <input type="text" name="tipe_hp" class="form-control" id="tipe_hp" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kerusakan" class="col-sm-2 col-form-label">Kerusakan</label>
                    <div class="col-sm-5">
                      <input type="text" name="kerusakan" class="form-control" id="kerusakan" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="kelengkapan" class="col-sm-2 col-form-label">Kelengkapan</label>
                    <div class="col-sm-5">
                      <input type="text" name="kelengkapan" class="form-control" id="kelengkapan" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="note" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-5">
                      <input type="text" name="note" class="form-control" id="note" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="penerima" class="col-sm-2 col-form-label">Penerima</label>
                    <div class="col-sm-5">
                      <input type="text" name="penerima" class="form-control" id="penerima" >
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="<?php echo base_url('service') ?>" class="btn btn-default float-right">Cancel</a>
                  <button type="submit" class="btn btn-info btn-submit" name="submit" value="add">Submit</button>
                </div>
              </form>
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

