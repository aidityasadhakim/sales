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
                <h5 class="m-0">Data Laporan Per Periode <?php echo (isset($unit_type)) ? getLabelUnitType($unit_type) : '' ?></h5>
              </div>
              <div class="card-body">
                <form class="form-inline" method="post">
                  <div class="form-group mb-2">
                    <label for="period" class="sr-only">Periode</label>
                    <input type="month" class="form-control" name="period" id="period" value="<?php echo (isset($period)) ? $period : '' ?>" required>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="unit_type" class="sr-only">Tipe</label>
                    <select name="unit_type" class="form-control select2" id="unit_type" required>
                        <option value="">--Pilih Tipe--</option>
                        <option value="1"<?php if (isset($unit_type)) echo ($unit_type == 1) ? ' selected' : '' ?>>Apartemen</option>
                        <option value="2"<?php if (isset($unit_type)) echo ($unit_type == 2) ? ' selected' : '' ?>>Mansion</option>
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2" name="submit" value="view">Lihat Laporan</button>
                  &nbsp;
                  <button type="submit" class="btn btn-success mb-2" name="submit" value="download">Download Laporan</button>
                </form>

                <?php if (isset($datas)): ?>
                <div class="table-responsive">
                  <table class="table table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Unit</th>
                        <th>Total Listrik</th>
                        <th>Total Air</th>
                        <th>Total Kebersihan &amp; Keamanan</th>
                        <th>Total TV Kabel</th>
                        <th>Total Sinking Fund</th>
                        <th>Denda</th>
                        <th>Total Keseluruhan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($datas as $key => $value): ?>
                      <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td>
                          <?php if ($unit_type == 1): ?>
                          Pemilik: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'owner'); ?></strong>
                          <br>
                          Tower: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'tower'); ?></strong>
                          <br>
                          Lantai: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'floor'); ?></strong>
                          <br>
                          Blok: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'blok'); ?></strong>
                          <br>
                          <?php else: ?>
                          Pemilik: <strong><?php echo getDataColumn('mansions', 'id', $value['unit_id'], 'owner'); ?></strong>
                          <br>
                          Tipe: <strong><?php echo getDataColumn('mansions', 'id', $value['unit_id'], 'type'); ?></strong>
                          <br>
                          Blok: <strong><?php echo getDataColumn('mansions', 'id', $value['unit_id'], 'blok'); ?></strong>
                          <br>
                          <?php endif ?>
                        </td>
                        <td><a href="#" class="detail-payment" data-id="<?php echo $value['id'] ?>" data-type="el">Rp. <?php echo number_format($value['el_total_price']) ?></a></td>
                        <td><a href="#" class="detail-payment" data-id="<?php echo $value['id'] ?>" data-type="water">Rp. <?php echo number_format($value['water_total_price']) ?></a></td>
                        <td>Rp. <?php echo number_format($value['cs_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['cabletv_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['sf_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['fine']) ?></td>
                        <td>Rp. <?php echo number_format($value['grand_total']) ?></td>
                        <td>
                          <?php if ($value['payment_status'] == 1): ?>
                            <span class="badge badge-success">Sudah dibayar.</span>
                          <?php else: ?>
                            <span class="badge badge-warning">Belum dibayar.</span>
                          <?php endif ?>
                        </td>
                      </tr>
                      <?php 
                      endforeach 
                      ?>
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

  <div class="modal fade" id="modal-lg-detail-payment">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Tagihan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body-detail-payment">
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php $this->load->view('layouts/footer'); ?>