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
                <h5 class="m-0">Data Fasilitas</h5>
              </div>
              <div class="card-body">
                <?php if($this->session->flashdata('msg')): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                <?php endif; ?>
                <p>
                  <a href="<?php echo base_url('facility/add') ?>" class="btn btn-primary">Tambah</a>
                </p>
                <div class="table-responsive">
                  <table class="table table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Fasilitas</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($facilities as $key => $value): ?>
                      <tr>
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url('facility/update/'.$value['id']) ?>" class="btn btn-success">Ubah</a>
                            <a href="<?php echo base_url('facility/delete/'.$value['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
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
