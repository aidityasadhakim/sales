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
                <h5 class="m-0">Form Ubah Apartemen</h5>
              </div>
              <form class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="code" class="col-sm-2 col-form-label">Kode Apartemen</label>
                    <div class="col-sm-3">
                      <input type="text" name="code" class="form-control" id="code" value="<?php echo $row['code'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tower" class="col-sm-2 col-form-label">Tower</label>
                    <div class="col-sm-1">
                      <input type="text" name="tower" class="form-control" id="tower" value="<?php echo $row['tower'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="floor" class="col-sm-2 col-form-label">Lantai</label>
                    <div class="col-sm-1">
                      <input type="text" name="floor" class="form-control" id="floor" value="<?php echo $row['floor'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="blok" class="col-sm-2 col-form-label">Blok</label>
                    <div class="col-sm-1">
                      <input type="text" name="blok" class="form-control" id="blok" value="<?php echo $row['blok'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="owner" class="col-sm-2 col-form-label">Nama Pemilik</label>
                    <div class="col-sm-3">
                      <input type="text" name="owner" class="form-control" id="owner" value="<?php echo $row['owner'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="area" class="col-sm-2 col-form-label">Luas Area</label>
                    <div class="col-sm-2">
                      <div class="input-group mb-3">
                        <input type="text" name="area" class="form-control" id="area" value="<?php echo $row['area'] ?>" required>
                        <div class="input-group-append">
                          <span class="input-group-text">M2</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="electricity" class="col-sm-2 col-form-label">Pemakaian Listrik</label>
                    <div class="col-sm-2">
                      <input type="text" name="electricity" class="form-control" id="electricity" value="<?php echo $row['electricity_used'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="water" class="col-sm-2 col-form-label">Pemakaian Air</label>
                    <div class="col-sm-2">
                      <input type="text" name="water" class="form-control" id="water" value="<?php echo $row['water_used'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="date_used" class="col-sm-2 col-form-label">Tanggal Pemakaian</label>
                    <div class="col-sm-3">
                      <input type="date" name="date_used" class="form-control" id="date_used" value="<?php echo $row['date_used'] ?>" required>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="submit" value="edit">Submit</button>
                  <a href="<?php echo base_url('residence') ?>" class="btn btn-default float-right">Cancel</a>
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