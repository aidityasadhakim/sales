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
                  <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-3">
                      <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo (isset($start_date)) ? $start_date : date('Y-m-d') ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="end_date" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-3">
                      <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo (isset($end_date)) ? $end_date : date('Y-m-d') ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="transaction_type" class="col-sm-2 col-form-label">Tunai/Utang</label>
                    <div class="col-sm-3">
	                    <select name="transaction_type" class="form-control select2" id="transaction_type">
	                        <option value=""
	                        	<?php if (isset($transaction_type)) echo ($transaction_type == '') ? ' selected="selected"' : '' ?>>
	                        Semua</option>
	                        <option value="1"
	                        	<?php if (isset($transaction_type)) echo ($transaction_type == '1') ? ' selected="selected"' : '' ?>>
	                        Tunai</option>
	                        <option value="0"
	                        	<?php if (isset($transaction_type)) echo ($transaction_type == '0') ? ' selected="selected"' : '' ?>>
	                        Utang</option>
	                  	</select>
                  	</div>
                  </div>
                  <button type="submit" class="btn btn-info" name="submit" value="view">Submit</button>
                </form>
                <br><br>
                <?php if (isset($stocks)): ?>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="data-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Kode</th>
                          <th>Terjual</th>
                          <th>Harga</th>
                          <th>Total Harga</th>
                          <th>Status Pembayaran</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
	                        $totalSale = 0;
	                        foreach ($stocks as $key => $value): 
                        ?>
                          <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value['item_name']; ?></td>
                            <td><?php echo $value['item_code']; ?></td>
                            <td><?php echo $value['quantity']; ?></td>
                            <td>Rp. <?php echo number_format($value['item_price']) ?></td>
                            <td>Rp. <?php echo number_format($value['quantity'] * $value['item_price']) ?></td>
                            <td>
                            	<p style="<?php if($value['is_cash']) echo 'color:green'; else echo 'color:red'?>">
                            		<?php if($value['is_cash']) echo "LUNAS"; else echo "PIUTANG"; ?>
                            	</p>
                            </td>
                          </tr>
                        <?php 
	                        $totalSale += $value['quantity'] * $value['item_price'];
                        	endforeach 
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="table-responsive mt-5">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td><strong>Total</strong></td>
                          <td><strong>Rp. <?php echo number_format($totalSale) ?></strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php endif ?>
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