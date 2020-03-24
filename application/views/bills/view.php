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
                <h5 class="m-0">Data Tagihan <?php echo getLabelUnitType($type) ?></h5>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="post">
                <?php if ($type == 1): ?>
                  <div class="form-group row">
                    <label for="unit_id" class="col-sm-2 col-form-label">Kode Unit</label>
                    <div class="col-sm-4">
                      <select name="unit_id" class="form-control select2" id="unit_id" required>
                        <option value="">--Pilih Apartemen--</option>
                        <?php 
                        $selected = '';
                        foreach ($units as $key => $value): 
                          if (isset($unit_id)) {
                            $selected = ($unit_id == $value['id']) ? ' selected' : '';
                          }
                        ?>
                        <option value="<?php echo $value['id'] ?>"<?php echo $selected ?>><?php echo $value['code'].' / '.$value['owner'].' / '.$value['tower'].'-'.$value['floor'].$value['blok'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="form-group row">
                    <label for="unit_id" class="col-sm-2 col-form-label">Kode Unit</label>
                    <div class="col-sm-4">
                      <select name="unit_id" class="form-control select2" id="unit_id" required>
                        <option value="">--Pilih Rumah--</option>
                        <?php foreach ($units as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['code'].' / '.$value['owner'].' / '.$value['type'].'-'.$value['blok'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                <?php endif; ?>
                  <div class="form-group row">
                    <label for="btn-submit-trans" class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
                    </div>
                  </div>
                </form>

                <?php if($this->session->flashdata('msg')): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                <?php endif; ?>

                <?php if (isset($bills)): ?>
                <div class="table-responsive">
                  <table class="table table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Total Listrik</th>
                        <th>Total Air</th>
                        <th>Total Kebersihan &amp; Keamanan</th>
                        <th>Total TV Kabel</th>
                        <th>Total Sinking Fund</th>
                        <th>Denda</th>
                        <th>Total Keseluruhan</th>
                        <th>Status</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $grand_total = 0; foreach ($bills as $key => $value): ?>
                      <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo date('F Y', strtotime($value['period'])) ?></td>
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
                        <td>
                          <?php if ($value['payment_status'] == 1): ?>
                            <a href="<?php echo base_url('bill/cetak/'.$value['id']) ?>" class="btn btn-primary" target="_blank">Cetak Bukti Pembayaran</a>
                          <?php else: ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-warning">Cetak Surat</button>
                              <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                                <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-1px, 37px, 0px);">
                                  <a class="dropdown-item" href="#" target="_blank">Penagihan</a>
                                  <a class="dropdown-item" href="#" target="_blank">Peringatan</a>
                                  <a class="dropdown-item" href="#" target="_blank">Pemutusan</a>
                                </div>
                              </button>
                            </div>
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