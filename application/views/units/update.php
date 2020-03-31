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
                <h5 class="m-0">Form Ubah Unit</h5>
              </div>
              <form class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="tower_id" class="col-sm-2 control-label">Tower</label>
                    <div class="col-sm-4">
                      <select name="tower_id" class="form-control towerField" id="tower_id">
                        <option>---Pilih Tower---</option>
                        <?php foreach ($towers as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"<?php echo ($value['id'] == getTowerByFloorId($row['tower_id'], 'id')) ? ' selected' : '' ?>><?php echo $value['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="floor_id" class="col-sm-2 control-label">Lantai</label>
                    <div class="col-sm-4">
                      <select name="floor_id" class="form-control floorField" id="floor_id">
                        <option>---Pilih Lantai---</option>
                        <?php foreach ($floors as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"<?php echo ($value['id'] == $row['tower_id']) ? ' selected' : '' ?>><?php echo $value['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 control-label">Nama Unit</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Unit" required value="<?php echo $row['name'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="type" class="col-sm-2 control-label">Pengelola</label>
                    <div class="col-sm-4">
                      <select name="type" class="form-control" id="type">
                        <option value="1"<?php echo ($row['type'] == 1) ? ' selected' : '' ?>>Developer</option>
                        <option value="2"<?php echo ($row['type'] == 2) ? ' selected' : '' ?>>Owner</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="owner_id" class="col-sm-2 control-label">Kepemilikan</label>
                    <div class="col-sm-4">
                      <select name="owner_id" class="form-control" id="owner_id" required>
                        <?php foreach ($owners as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
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
