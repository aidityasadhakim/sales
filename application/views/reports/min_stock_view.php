<?php $this->load->view('layouts/header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <?php echo $title; ?> </h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0"><?php echo $title; ?></h5>
              </div>
              <div class="card-body">

                <form class="form-horizontal" method="post">

                  <div style="padding-bottom: 16px" class="row">
                    <div class="col-lg-6">
                      <select name="category_id" class="form-control select2" id="category_id">
                        <option value="">--Pilih Tipe Barang--</option>
                        <?php foreach ($categories as $key => $value): ?>
                          <option value="<?php echo $value['type'] ?>"
                            <?php if (isset($selected_type)): ?>
                              <?php if($selected_type == $value['type']): ?> selected="selected"<?php endif; ?>
                            <?php endif ?>>
                            
                            <?php echo $value['type'] ?>
                          </option>
                        <?php endforeach ?>
                      </select>
                    </div>

                    <button type="submit" class="btn btn-info" name="submit_filter" value="">Submit</button>
                  </div>


                </form>
                
                <div class="table-responsive">
                  <table class="table table-bordered" id="data-table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Sisa Stok</th>
                        <th>Tipe</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($items as $key => $value): ?>
                        <tr>
                          <td><?php echo $key + 1; ?></td>
                          <td><?php echo $value['code'] ?></td>
                          <td><?php echo $value['name']; ?></td>
                          <td><?php echo $value['stock'] ?></td>
                          <td><?php echo $value['type'] ?></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('layouts/footer'); ?>