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
                <h5 class="m-0">Form Tambah <?php echo getLabelUnitType($type) ?></h5>
              </div>
              <form class="form-horizontal" method="post" onsubmit="return validatePeriodOnSubmit()">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <legend>Data Pemilik</legend>
                      <div class="form-group row">
                        <label for="transaction_date" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                        <div class="col-sm-6">
                          <input type="date" name="transaction_date" class="form-control" id="transaction_date" value="<?php echo date('Y-m-d') ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="period" class="col-sm-3 col-form-label">Periode Tagihan</label>
                        <div class="col-sm-5">
                          <input type="month" name="period" class="form-control" id="period" value="<?php echo date('Y-m') ?>" required>
                        </div>
                      </div>
                      <?php if ($type == 1): ?>
                      <div class="form-group row">
                        <label for="unit_id" class="col-sm-3 col-form-label">Kode Unit</label>
                        <div class="col-sm-6">
                          <select name="unit_id" class="form-control" id="unit_id" required>
                            <option value="">--Pilih Apartemen--</option>
                            <?php foreach ($units as $key => $value): ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['code'].' / '.$value['owner'].' / '.$value['tower'].'-'.$value['floor'].$value['blok'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="owner_name" class="col-sm-3 col-form-label">Nama Pemilik</label>
                        <div class="col-sm-4">
                          <input type="text" name="owner_name" class="form-control" id="owner_name" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="tower" class="col-sm-3 col-form-label">Tower</label>
                        <div class="col-sm-2">
                          <input type="text" name="tower" class="form-control" id="tower" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="floor" class="col-sm-3 col-form-label">Lantai</label>
                        <div class="col-sm-2">
                          <input type="text" name="floor" class="form-control" id="floor" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="blok" class="col-sm-3 col-form-label">Blok</label>
                        <div class="col-sm-2">
                          <input type="text" name="blok" class="form-control" id="blok" readonly>
                        </div>
                      </div>
                      <?php else: ?>
                      <div class="form-group row">
                        <label for="unit_id" class="col-sm-3 col-form-label">Kode Unit</label>
                        <div class="col-sm-6">
                          <select name="unit_id" class="form-control" id="unit_id" required>
                            <option value="">--Pilih Rumah--</option>
                            <?php foreach ($units as $key => $value): ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['code'].' / '.$value['owner'].' / '.$value['type'].'-'.$value['blok'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="owner_name" class="col-sm-3 col-form-label">Nama Pemilik</label>
                        <div class="col-sm-4">
                          <input type="text" name="owner_name" class="form-control" id="owner_name" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-2">
                          <input type="text" name="type" class="form-control" id="type" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="blok" class="col-sm-3 col-form-label">Blok</label>
                        <div class="col-sm-2">
                          <input type="text" name="blok" class="form-control" id="blok" readonly>
                        </div>
                      </div>
                      <?php endif ?>
                    </div>
                    <div class="col">
                      <legend>Total Tagihan</legend>
                      <div class="form-group row">
                        <label for="el_total_price" class="col-sm-3 col-form-label">Tagihan Listrik</label>
                        <div class="col-sm-6">
                          <input type="text" name="el_total_price" class="form-control el_total_price" id="el_total_price" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_total_price" class="col-sm-3 col-form-label">Tagihan Air</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_total_price" class="form-control water_total_price" id="water_total_price" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cs_total_price" class="col-sm-3 col-form-label">Tagihan Kebersihan &amp; Keamanan</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_total_price" class="form-control cs_total_price" id="cs_total_price" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cabletv_total_price" class="col-sm-3 col-form-label">Tagihan TV Kabel</label>
                        <div class="col-sm-6">
                          <input type="text" name="cabletv_total_price" class="form-control cabletv_total_price" id="cabletv_total_price" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="sf_total_price" class="col-sm-3 col-form-label">Sinking Fund</label>
                        <div class="col-sm-6">
                          <input type="text" name="sf_total_price" class="form-control sf_total_price" id="sf_total_price" value="0" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                  <legend></legend>
                  <div class="row">
                    <div class="col">
                      <legend>Tagihan Listrik</legend>
                      <div class="form-group row">
                        <label for="el_last_used" class="col-sm-3 col-form-label">Pemakaian Bulan Lalu</label>
                        <div class="col-sm-6">
                          <input type="text" name="el_last_used" class="form-control" id="el_last_used" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="el_used" class="col-sm-3 col-form-label">Pemakaian Bulan Ini</label>
                        <div class="col-sm-6">
                          <input type="text" name="el_used" class="form-control" id="el_used" value="0" onblur="validateElPrice()" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="el_total_used" class="col-sm-3 col-form-label">Total Pemakaian</label>
                        <div class="col-sm-6">
                          <input type="text" name="el_total_used" class="form-control" id="el_total_used" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="el_rate" class="col-sm-3 col-form-label">Tarif Per KWH</label>
                        <div class="col-sm-6">
                          <input type="text" name="el_rate" class="form-control" id="el_rate" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="abonemen" class="col-sm-3 col-form-label">Abonemen</label>
                        <div class="col-sm-6">
                          <input type="text" name="abonemen" class="form-control" id="abonemen" value="0" onblur="validateElPrice()" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="ppju" class="col-sm-3 col-form-label">PPJU</label>
                        <div class="col-sm-6">
                          <input type="text" name="ppju" class="form-control" id="ppju" value="0" onblur="validateElPrice()" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="ppn" class="col-sm-3 col-form-label">PPN</label>
                        <div class="col-sm-6">
                          <input type="text" name="ppn" class="form-control" id="ppn" value="0" onblur="validateElPrice()" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="el_subtotal_price" class="col-sm-3 col-form-label">Total Tagihan Listrik</label>
                        <div class="col-sm-6">
                          <input type="text" name="el_subtotal_price" class="form-control el_total_price" id="el_subtotal_price" value="0" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <legend>Tagihan Air</legend>
                      <div class="form-group row">
                        <label for="water_last_used" class="col-sm-3 col-form-label">Pemakaian Bulan Lalu</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_last_used" class="form-control" id="water_last_used" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_used" class="col-sm-3 col-form-label">Pemakaian Bulan Ini</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_used" class="form-control" id="water_used" value="0" onblur="validateWaterPrice()" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_total_used" class="col-sm-3 col-form-label">Total Pemakaian</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_total_used" class="form-control" id="water_total_used" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_rate" class="col-sm-3 col-form-label">Tarif Per Kubik</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_rate" class="form-control" id="water_rate" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="water_subtotal_price" class="col-sm-3 col-form-label">Total Tagihan Air</label>
                        <div class="col-sm-6">
                          <input type="text" name="water_subtotal_price" class="form-control water_total_price" id="water_subtotal_price" value="0" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <legend>Kebersihan &amp; Keamanan</legend>
                      <div class="form-group row">
                        <label for="cs_area" class="col-sm-3 col-form-label">Luas Unit</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_area" class="form-control" id="cs_area" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cs_rate" class="col-sm-3 col-form-label">Tarif Per M2</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_rate" class="form-control" id="cs_rate" value="0" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="cs_subtotal_price" class="col-sm-3 col-form-label">Total Tagihan</label>
                        <div class="col-sm-6">
                          <input type="text" name="cs_subtotal_price" class="form-control cs_total_price" id="cs_subtotal_price" value="0" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="unit_type" value="<?php echo $type ?>" id="unit_type">
                  <button type="submit" class="btn btn-info" name="submit" value="add" id="btn-submit-trans">Submit</button>
                  <a href="<?php echo base_url('mansion') ?>" class="btn btn-default float-right">Cancel</a>
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