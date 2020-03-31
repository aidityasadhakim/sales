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
                <h5 class="m-0">Data Mansion</h5>
              </div>
              <div class="card-body">
                <?php if($this->session->flashdata('msg')): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                <?php endif; ?>
                <p>
                  <a href="<?php echo base_url('mansion/add') ?>" class="btn btn-primary">Tambah</a>
                </p>
                <div class="table-responsive">
                  <table class="table table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Lokasi Unit</th>
                        <th>Pemilik</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($mansions as $key => $value): ?>
                      <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $value['code']; ?></td>
                        <td>
                          Tipe: <strong><?php echo $value['type']; ?></strong>
                          <br>
                          Blok : <strong><?php echo $value['blok']; ?></strong>    
                        </td>
                        <td><?php echo $value['owner'] ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url('mansion/update/'.$value['id']) ?>" class="btn btn-success">Ubah</a>
                            <a href="<?php echo base_url('mansion/delete/'.$value['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
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