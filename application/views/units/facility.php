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
                <h5 class="m-0">Form Fasilitas Unit</h5>
              </div>
              <form class="form-horizontal" method="post">
                <div class="card-body">
                  <?php if($this->session->flashdata('msg')): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                  <?php endif; ?>
                  <div class="form-group row">
                    <label for="tower" class="col-sm-2 control-label">Tower</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="tower" value="<?php echo getTowerByFloorId($row['tower_id'], 'name'); ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="unit" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="unit" value="<?php echo getDataColumn('towers', 'id', $row['tower_id'], 'name').$row['name']; ?>" readonly>
                    </div>
                  </div>
                  <legend>Fasilitas</legend>
                  <div class="form-check">
                    <div class="row">
                      <?php foreach ($facilities as $key => $value): ?>
                      <div class="col-sm-3">
                        <input type="checkbox" class="form-check-input" name="facility_ids[]" value="<?php echo $value['id'] ?>"<?php echo (checkedFacilityUnit($row['id'], $value['id'])) ? ' checked' : '' ?>>
                        <label class="form-check-label"><?php echo $value['name'] ?></label>
                      </div>
                      <?php endforeach ?>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="unit_id" value="<?php echo $row['id'] ?>">
                  <button type="submit" class="btn btn-info" name="submit" value="add">Submit</button>
                  <a href="<?php echo base_url('unit') ?>" class="btn btn-default float-right">Cancel</a>
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
