
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      PT. Dhiya Properti Utama
    </div>
    <!-- Default to the left -->
    <strong>Hak Cipta &copy; 2020 <a href="https://vickypriyadi.com">Oktaviani Studios</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets') ?>/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';

    $(function () {
        bsCustomFileInput.init();
        $("#data-table").DataTable();

        $(".select2").select2({
          theme: 'bootstrap4'
        });

        $('.towerField').change(function(event) {
          var id = $(this).val();
          $.ajax({
            url: 'getFloor/' + id,
            type: 'GET'
          })
          .done(function(data) {
            $('.floorField').empty();
            $('.floorField').html(data);
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
        });
        $('.towerUpdateField').change(function(event) {
          var id = $(this).val();
          $.ajax({
            url: '../getFloor/' + id,
            type: 'GET'
          })
          .done(function(data) {
            $('.floorUpdateField').empty();
            $('.floorUpdateField').html(data);
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
        });
        $('#type').change(function(event) {
          var type = $(this).val();
          $.ajax({
            url: base_url + '/unit/getOwners',
            type: 'POST',
            data: {type: type}
          })
          .done(function(data) {
            $('#owner_id').empty();
            $('#owner_id').html(data);
            $('#owner_id').select2();
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
        });

    });
</script>
</body>
</html>
