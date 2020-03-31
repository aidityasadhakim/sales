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
                <h5 class="m-0">Data Transaksi <?php echo getLabelUnitType($type) ?></h5>
              </div>
              <div class="card-body">
                <?php if($this->session->flashdata('msg')): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                <?php endif; ?>
                <p>
                  <a href="<?php echo base_url('transaction/add/'.$type) ?>" class="btn btn-primary">Tambah</a>
                </p>
                <div class="table-responsive">
                  <table class="table table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Unit</th>
                        <th>Periode</th>
                        <th>Total Listrik</th>
                        <th>Total Air</th>
                        <th>Total Kebersihan &amp; Keamanan</th>
                        <th>Total TV Kabel</th>
                        <th>Total Sinking Fund</th>
                        <th>Total Keseluruhan</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($transactions as $key => $value): ?>
                      <tr>
                        <td><?php echo $key+1 ?></td>
                        <td>DPUB-<?php echo $value['id']; ?></td>
                        <td>
                          Pemilik: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'owner'); ?></strong>
                          <br>
                          Tower: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'tower'); ?></strong>
                          <br>
                          Lantai: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'floor'); ?></strong>
                          <br>
                          Blok: <strong><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'blok'); ?></strong>
                          <br>
                        </td>
                        <td><?php echo date('F Y', strtotime($value['period'])) ?></td>
                        <td>Rp. <?php echo number_format($value['el_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['water_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['cs_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['cabletv_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['sf_total_price']) ?></td>
                        <td>Rp. <?php echo number_format($value['grand_total']) ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url('transaction/update/'.$value['id']) ?>" class="btn btn-success">Ubah</a>
                            <a href="<?php echo base_url('transaction/delete/'.$value['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                          </div>
                        </td>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('layouts/footer'); ?>