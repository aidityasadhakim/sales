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
                <h5 class="m-0">Form Tambah Gambar Unit Tower <?php echo getTowerByFloorId($row['tower_id'], 'name'); ?> - <?php echo getDataColumn('towers', 'id', $row['tower_id'], 'name').$row['name']; ?></h5>
              </div>
              <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <?php if($this->session->flashdata('error')): ?>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      <?php echo $this->session->flashdata('error'); ?>
                  </div>
                  <?php endif; ?>
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 control-label">Label</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Keterangan" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="image" class="col-sm-2 control-label">Gambar</label>
                    <div class="col-sm-4">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="userfile" id="image">
                        <label class="custom-file-label" for="image"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="submit" value="add">Submit</button>
                  <a href="<?php echo base_url('unit/photos/'.$row['id']) ?>" class="btn btn-default float-right">Cancel</a>
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
