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
              <form class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="transaction_date" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                    <div class="col-sm-4">
                      <input type="date" name="transaction_date" class="form-control" id="transaction_date" required value="<?php echo date('Y-m-d') ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="total" class="col-sm-2 col-form-label">Jumlah Tagihan</label>
                    <div class="col-sm-3">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" name="total" class="form-control number" id="total" value="<?php echo $row['total'] ?>" readonly required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="cash" class="col-sm-2 col-form-label">Jumlah Bayar</label>
                    <div class="col-sm-3">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" name="cash" class="form-control number" id="cash" value="0" autofocus required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="changes" class="col-sm-2 col-form-label">Kembalian</label>
                    <div class="col-sm-3">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" name="changes" class="form-control number" id="changes" readonly required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="method_id" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                    <div class="col-sm-3">
                      <select name="method_id" class="form-control select2" id="method_id" required>
                        <option value="">--Pilih Pembayaran--</option>
                        <?php foreach ($methods as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info btn-submit" name="submit" value="add">Submit</button>
                  <a href="<?php echo base_url('service') ?>" class="btn btn-default float-right">Cancel</a>
                </div>
              </form>
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
<script type="text/javascript">
  $(function() {

    $(document).keydown(function(e) {

      var self = $(':focus'),
          
          form = self.parents('form:eq(0)'),
          focusable;

      focusable = form.find('input,a,select,button,textarea,div[contenteditable=true]').filter(':visible');

      function enterKey(){
        if (e.which === 13 && !self.is('textarea,div[contenteditable=true]')) {

          if ($.inArray(self, focusable) && (!self.is('a,button'))){
            e.preventDefault();
          } 

          focusable.eq(focusable.index(self) + (e.shiftKey ? -1 : 1)).focus();

          return false;
        }
      }
      if (e.shiftKey) { enterKey() } else { enterKey() }
    });

    function trimLeadZero(s) {
      return s.replace(/^0+/, "");
    }

    function validateCash() {
      var total = $('#total').val();
      var cash = $('#cash').val();
      var changes = parseInt(cash) - parseInt(total);
      if (parseInt(changes) < 0) {
        $('.btn-submit').prop('disabled', 'disabled');
      }
      else{
        $('.btn-submit').removeAttr('disabled');
      }
      $('#changes').val(changes);
    }

    $(document).on("keyup", "#cash", function(e){
      var s;
      if($(this).val().trim().length === 0){
          $(this).val(0);
          s = 0;
      }
      else {
        var s = trimLeadZero($(this).val());
        $(this).val(s);
      }
      if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 8 && $(this).val() != '')) {
        validateCash();
      }
    });

  });
</script>