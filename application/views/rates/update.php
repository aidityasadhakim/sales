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
                <h5 class="m-0">Form Ubah Tarif</h5>
              </div>
              <form class="form-horizontal" method="post">
                <div class="card-body">
                <?php if($this->session->flashdata('msg')): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">X</button>
                      <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                <?php endif; ?>
                  <?php foreach ($rates as $key => $value): ?>
                  <div class="form-group row">
                    <label for="amount" class="col-sm-2 col-form-label"><?php echo $value['name'] ?></label>
                    <div class="col-sm-2">
                      <input type="hidden" name="id[]" class="form-control" id="id" value="<?php echo $value['id'] ?>">
                      <input type="text" name="amount[]" class="form-control" id="amount" value="<?php echo $value['amount'] ?>" required>
                    </div>
                  </div>
                  <?php endforeach ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="submit" value="edit">Submit</button>
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