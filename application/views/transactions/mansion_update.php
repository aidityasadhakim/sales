<?php $this->load->view('layouts/header'); ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title; ?></h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Form Ubah <?php echo getLabelUnitType($type) ?></h5>
              </div>
              <form class="form-horizontal" method="post" id="form-transaction">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <legend>Data Pemilik</legend>
                      <div class="form-group row">
                        <label for="transaction_date" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                        <div class="col-sm-6">
                          <input type="date" name="transaction_date" class="form-control" id="transaction_date" value="<?php echo $row['transaction_date'] ?>" required readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="period" class="col-sm-3 col-form-label">Periode Tagihan</label>
                        <div class="col-sm-5">
                          <input type="month" name="period" class="form-control" id="period" value="<?php echo date('Y-m', strtotime($row['period'])) ?>" required readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="unit_id" class="col-sm-3 col-form-label">Kode Unit</label>
                        <div class="col-sm-6">
                          <input type="text" name="unit_id" class="form-control" id="owner_name" value="<?php echo $unit['code'] ?>" readonly required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="owner_name" class="col-sm-3 col-form-label">Nama Pemilik</label>
                        <div class="col-sm-4">
                          <input type="text" name="owner_name" class="form-control" id="owner_name" value="<?php echo $unit['owner'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-2">
                          <input type="text" name="type" class="form-control" id="type" value="<?php echo $unit['type'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="blok" class="col-sm-3 col-form-label">Blok</label>
                        <div class="col-sm-2">
                          <input type="text" name="blok" class="form-control" id="blok" value="<?php echo $unit['blok'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <legend>Total Tagihan</legend>
                      <div class="form-group row">
                        <label for="water_total_price" class="col-sm-3 col-form-label">Tagihan Air</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_total_price" class="form-control water_total_price" id="water_total_price" value="<?php echo $row['water_total_price'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cs_total_price" class="col-sm-3 col-form-label">Tagihan Kebersihan &amp; Keamanan</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_total_price" class="form-control cs_total_price" id="cs_total_price" value="<?php echo $row['cs_total_price'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cabletv_total_price" class="col-sm-3 col-form-label">Tagihan TV Kabel</label>
                        <div class="col-sm-6">
                          <input type="text" name="cabletv_total_price" class="form-control cabletv_total_price" id="cabletv_total_price" value="<?php echo $row['cabletv_total_price'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="sf_total_price" class="col-sm-3 col-form-label">Sinking Fund</label>
                        <div class="col-sm-6">
                          <input type="text" name="sf_total_price" class="form-control sf_total_price" id="sf_total_price" value="<?php echo $row['sf_total_price'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <legend></legend>
                  <div class="row">
                    <div class="col">
                      <legend>Tagihan Air</legend>
                      <div class="form-group row">
                        <label for="water_last_used" class="col-sm-3 col-form-label">Pemakaian Bulan Lalu</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_last_used" class="form-control" id="water_last_used" value="<?php echo $row['water_last_used'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_used" class="col-sm-3 col-form-label">Pemakaian Bulan Ini</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_used" class="form-control" id="water_used" value="<?php echo $row['water_used'] ?>" onblur="validateWaterPrice()" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_total_used" class="col-sm-3 col-form-label">Total Pemakaian</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_total_used" class="form-control" id="water_total_used" value="<?php echo $row['water_total_used'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_rate" class="col-sm-3 col-form-label">Tarif Per Kubik</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_rate" class="form-control" id="water_rate" value="<?php echo $row['water_rate'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="abonemen" class="col-sm-3 col-form-label">Abonemen</label>
                        <div class="col-sm-6">
                          <input type="text" name="abonemen" class="form-control" id="abonemen" value="<?php echo $row['abonemen'] ?>" onblur="validateWaterPrice()" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_subtotal_price" class="col-sm-3 col-form-label">Total Tagihan Air</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_subtotal_price" class="form-control water_total_price" id="water_subtotal_price" value="<?php echo $row['water_total_price'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <legend>Kebersihan &amp; Keamanan</legend>
                      <div class="form-group row">
                        <label for="cs_area" class="col-sm-3 col-form-label">Luas Unit</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_area" class="form-control" id="cs_area" value="<?php echo $row['cs_area'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cs_rate" class="col-sm-3 col-form-label">Tarif Per M2</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_rate" class="form-control" id="cs_rate" value="<?php echo $row['cs_rate'] ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cs_subtotal_price" class="col-sm-3 col-form-label">Total Tagihan</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_subtotal_price" class="form-control cs_total_price" id="cs_subtotal_price" value="<?php echo $row['cs_total_price'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="edit" value="edit" id="btn-submit-trans">Submit</button>
                  <a href="<?php echo base_url('transaction/index/'.$type) ?>" class="btn btn-default float-right">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('layouts/footer'); ?>