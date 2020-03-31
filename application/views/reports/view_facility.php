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
                <h5 class="m-0">Data Fasilitas Kamar <?php if (isset($type)) echo ($type == 1) ? 'Developer' : 'Owner' ?></h5>
              </div>
              <div class="card-body">
                <form class="form-inline" method="post">
                  <label class="sr-only" for="type">Pengelola</label>
                  <select name="type" class="form-control mb-2" id="type" required>
                    <option value="">--Pilih Pengelola--</option>
                    <option value="1"<?php if (isset($type)) echo ($type == 1) ? ' selected' : '' ?>>Developer</option>
                    <option value="2"<?php if (isset($type)) echo ($type == 2) ? ' selected' : '' ?>>Owner</option>
                  </select>

                  <button type="submit" class="btn btn-primary mb-2 ml-sm-2" name="submit" value="view">Lihat Laporan</button>
                </form>
                <?php if (isset($units)): ?>
                <div class="table-responsive">
                  <table class="table table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kepemilikan</th>
                        <th>Unit</th>
                        <?php foreach ($facilities as $key => $value): ?>
                        <th><?php echo $value['name'] ?></th>
                        <?php endforeach ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($units as $key => $value): ?>
                      <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo getDataColumn('owners', 'id', $value['owner_id'], 'name'); ?></td>
                        <td>
                          Tower: <strong><?php echo getTowerByFloorId($value['tower_id'], 'name'); ?></strong><br>
                          Lantai: <strong><?php echo getDataColumn('towers', 'id', $value['tower_id'], 'name'); ?></strong><br>
                          Unit: <strong><?php echo $value['name'] ?></strong>
                        </td>
                        <?php foreach ($facilities as $key => $valueFac): ?>
                        <td class="text-center"><?php echo (checkedFacilityUnit($value['id'], $valueFac['id'])) ? 'V' : '' ?></td>
                        <?php endforeach ?>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('layouts/footer'); ?>
