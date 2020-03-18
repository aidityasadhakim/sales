
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
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    function validateElPrice() {
        var last_used = $('#el_last_used').val();
        var used = $('#el_used').val();
        var rate = $('#el_rate').val();
        var abonemen = $('#abonemen').val();
        var ppju = $('#ppju').val();
        var ppn = $('#ppn').val();

        var total_used = parseInt(used) - parseInt(last_used);
        var total_price = parseInt(rate) * parseInt(total_used) + (parseInt(abonemen) + parseInt(ppju) + parseInt(ppn));

        $('#el_total_used').val(total_used);
        $('.el_total_price').val(total_price);
    }
    function validateWaterPrice() {
        var last_used = $('#water_last_used').val();
        var used = $('#water_used').val();
        var rate = $('#water_rate').val();

        var total_used = parseInt(used) - parseInt(last_used);
        var total_price = parseInt(rate) * parseInt(total_used);

        $('#water_total_used').val(total_used);
        $('.water_total_price').val(total_price);
    }

    $(function () {
        $('#unit_id').change(function(event) {
            var unit_type = $('#unit_type').val();
            var unit_id = $(this).val();
            var period = $('#period').val();
            $.ajax({
                url: base_url + 'transaction/getData',
                type: 'POST',
                dataType: 'json',
                data: {unit_id: unit_id, unit_type: unit_type, period: period},
            })
            .done(function(data) {
                $('#owner_name').val(data.unit.owner);
                if (unit_type == 1) {
                    $('#tower').val(data.unit.tower);
                    $('#floor').val(data.unit.floor);
                    $('#blok').val(data.unit.blok);
                    $('#water_rate').val(data.rate[1].amount);
                    $('#cs_rate').val(data.rate[3].amount);
                }
                else {
                    $('#type').val(data.unit.type);
                    $('#blok').val(data.unit.blok);
                    $('#water_rate').val(data.rate[2].amount);
                    $('#cs_rate').val(data.rate[4].amount);
                }

                if (data.bill.length == 0) {
                    $('#el_last_used').val(0);
                    $('#water_last_used').val(0);
                }
                else {
                    $('#el_last_used').val(data.bill.el_used);
                    $('#water_last_used').val(data.bill.water_used);
                }

                $('#cs_area').val(data.unit.area);
                $('#cs_rate').val(data.rate[5].amount);

                $('#el_rate').val(data.rate[0].amount);
                $('.cs_total_price').val(data.unit.area * data.rate[5].amount);
                $('#cabletv_total_price').val(data.rate[5].amount);
                $('#sf_total_price').val(data.rate[6].amount);
                console.log(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
        });

        $('#btn-submit-trans').click(function(e) {
            e.preventDefault();

            var unit_type = $('#unit_type').val();
            var unit_id = $('#unit_id').val();
            var period = $('#period').val();
            $.ajax({
                url: base_url + 'transaction/checkPeriod',
                type: 'POST',
                dataType: 'html',
                data: {unit_id: unit_id, unit_type: unit_type, period: period},
            })
            .done(function(data) {
                if (data == 0) {
                    console.log('submiy hey');
                    $('#form-transaction').submit();
                }
                else {
                    alert('Data dengan periode ini sudah ada!');
                    return false;
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });


        $('input[type=checkbox]').change(function() {
            var total = 0;
            var formatter = new Intl.NumberFormat('en-US', {
              style: 'currency',
              currency: 'IDR',
              maximumSignificantDigits: 3
            });
            console.log('checked');
            $('input[type=checkbox]').each(function() {
                if (this.checked == true) {
                    var amount = $(this).data('amount');
                    total = total + amount;
                }
            });
            $('.grand_total').html('<strong>' + formatter.format(total) + '</strong>');
        });

        $("#data-table").DataTable();
    });
</script>
</body>
</html>
