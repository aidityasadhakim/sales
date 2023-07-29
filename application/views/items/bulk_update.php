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
                                    <label for="transaction_date" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="transaction_date" class="form-control" id="transaction_date" required readonly value="<?php echo date('Y-m-d') ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-2 col-form-label">Harga Jual</label>
                                    <div class="col-sm-2">
                                        <div class="input-group mb-2">
                                            <input type="text" name="price" class="form-control" id="price" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price-non" class="col-sm-2 col-form-label">Harga Jual</label>
                                    <div class="col-sm-2">
                                        <div class="input-group mb-2">
                                            <input type="text" name="price-non" class="form-control" id="price-non" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                    <div class="col-sm-3">
                                        <select name="status" class="form-control" id="status" required>
                                            <option value="up">Naik</option>
                                            <option value="down">Turun</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="is_all" name="is_all" value="1">
                                            <label class="form-check-label" for="is_all">Semua Item</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="table-responsive" id="item_table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="55%">Nama Barang</th>
                                                <th width="5%">Harga Jual</th>
                                                <th width="15%">Harga Jual Non Pelanggan</th>
                                                <th width="10%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr-input-field">
                                                <td>
                                                    <select name="item_ids[]" class="form-control select-product item-id" required>
                                                    </select>
                                                </td>
                                                <td>
                                                    <p class="item-price form-control number disabled"></p>
                                                </td>
                                                <td>
                                                    <p class="item-price-non form-control number"></p>
                                                </td>
                                                <td>&nbsp;</td>

                                            </tr>
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>Total Seluruh</strong></td>
                                                <td colspan="2"><input type="text" name="total" class="form-control" id="total" readonly required></td>
                                            </tr>
                                            <tr id="tr-cash">
                                                <td colspan="3" class="text-right"><strong>Bayar</strong></td>
                                                <td colspan="2"><input type="text" name="cash" class="form-control number" id="cash" required value="0"></td>
                                            </tr>
                                            <tr id="tr-changes">
                                                <td colspan="3" class="text-right"><strong>Kembalian</strong></td>
                                                <td colspan="2"><input type="text" name="changes" class="form-control" id="changes" readonly required></td>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                </div>
                                <p>
                                    <button type="button" id="item-add" class="btn btn-primary">Tambah Barang</button>
                                </p>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-submit" name="submit" value="add">Submit</button>
                                <a href="<?php echo base_url('sale') ?>" class="btn btn-default float-right">Cancel</a>
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
        var base_url = '<?php echo base_url(); ?>';
        $('.select-product').select2({
            allowClear: true,
            width: '100%',
            placeholder: '--Pilih Barang--',
            minimumInputLength: 2,
            delay: 250,
            ajax: {
                url: base_url + '/sale/getAllItems',
                dataType: "json",
                type: "POST",
                data: function(params) {

                    var arr = $.map(
                        $(".item-id option:selected"),
                        function(n) {
                            return n.value;
                        }
                    );

                    var queryParameters = {
                        term: params.term,
                        uid: arr,
                        page: params.page || 1
                    }
                    return queryParameters;
                },
                cache: true
            }
        })

        $("#item-add").click(function() {
            $('.select-product').select2('destroy');
            var rowCount = $('table tbody tr').length;
            var tr = $('tbody tr:last').closest('.tr-input-field');
            var clone = tr.clone();
            clone.find(':text').val('');
            clone.find('select').val('');
            tr.after(clone);

            if (rowCount == 1) {
                $("table tbody tr:last td:last-child").append('<a href="#" class="remove_field btn btn-danger">X</a>');
            }


            $('.select-product').select2({
                allowClear: true,
                width: '100%',
                placeholder: '--Pilih Barang--',
                minimumInputLength: 2,
                ajax: {
                    url: base_url + '/sale/getAllItems',
                    dataType: "json",
                    type: "POST",
                    delay: 250,
                    data: function(params) {

                        var arr = $.map(
                            $(".item-id option:selected"),
                            function(n) {
                                return n.value;
                            }
                        );

                        var queryParameters = {
                            term: params.term,
                            uid: arr,
                            page: params.page || 1
                        }
                        return queryParameters;
                    },
                    cache: true
                }
            })
            // disabledOption();

        });

        $('table tbody').on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('tr').remove();
        });

        $(document).keydown(function(e) {

            var self = $(':focus'),

                form = self.parents('form:eq(0)'),
                focusable;

            focusable = form.find('input,a,select,button,textarea,div[contenteditable=true]').filter(':visible');

            function enterKey() {
                if (e.which === 13 && !self.is('textarea,div[contenteditable=true]')) {

                    if ($.inArray(self, focusable) && (!self.is('a,button'))) {
                        e.preventDefault();
                    }

                    focusable.eq(focusable.index(self) + (e.shiftKey ? -1 : 1)).focus();

                    return false;
                }
            }
            if (e.shiftKey) {
                enterKey()
            } else {
                enterKey()
            }
        });

        function trimLeadZero(s) {
            return s.replace(/^0+/, "");
        }

        function disabledOption() {
            var rowCount = $('table tbody tr').length;
            if (rowCount > 0) {
                $(".item-id option").removeAttr('disabled');
                var arr = $.map(
                    $(".item-id option:selected"),
                    function(n) {
                        return n.value;
                    }
                );

                $('.item-id option').filter(function() {
                    return $.inArray($(this).val(), arr) > -1;
                }).attr("disabled", "disabled");
            }

            $(".item-id").each(function(index, listItem) {
                $(this).find("option[value='" + $(this).find('option[disabled]:selected').val() + "']").removeAttr('disabled');
            });

        }

        $(document).on("change", ".item-id", function() {
            var obj = this;
            var id = $(this).val();

            if ($('#is_customer').prop('checked')) {
                var is_customer = 1;
            } else {
                var is_customer = 0;
            }


            // disabledOption();

            $.ajax({
                    url: base_url + 'item/getDataProduct',
                    type: 'POST',
                    data: {
                        'id': id,
                        'is_customer': is_customer
                    },
                    dataType: 'json'
                })
                .done(function(data) {
                    var price = data.salePrice;
                    var price_non = data.salePriceNon;
                    $(obj).closest('tr').find('.item-price').text(price);
                    $(obj).closest('tr').find('.item-price-non').text(price_non);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });

        });

        $(document).on("keyup", ".qty", function(e) {
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 8 && $(this).val() != '')) {
                var obj = this;
                var qty = $(this).val();
                var qtyAvailable = $(this).closest('tr').find('.qty-available').val();
                var price = $(obj).closest('tr').find('.price').val();
                if (parseInt(qty) > parseInt(qtyAvailable)) {
                    alert('Stok Kurang');
                    $('.btn-submit').prop('disabled', 'disabled');
                } else {
                    var subtotal = parseInt(price) * parseInt(qty);
                    $(obj).closest('tr').find('.subtotal').val(subtotal);
                    sumGrandTotal();
                    validateCash();
                }
            }
        });

        $(document).on("keyup", ".price", function(e) {
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 8 && $(this).val() != '')) {
                var obj = this;
                var price = $(this).val();
                var qty = $(obj).closest('tr').find('.qty').val();
                var subtotal = parseInt(price) * parseInt(qty);
                $(obj).closest('tr').find('.subtotal').val(subtotal);
                sumGrandTotal();
                validateCash();
            }
        });

        $(document).on("keyup", "#cash", function(e) {
            var s;
            if ($(this).val().trim().length === 0) {
                $(this).val(0);
                s = 0;
            } else {
                var s = trimLeadZero($(this).val());
                $(this).val(s);
            }
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode >= 8 && $(this).val() != '')) {
                validateCash();
            }
        });

        $('#is_all').click(function(event) {
            if ($(this).prop('checked')) {
                $('#item_table').hide();
                $('.item-id').removeAttr('required');
                $('#item-add').hide();
            } else {
                $('#item_table').show();
                $('.item-id').prop('required', 'required');
                $('#item-add').show();
            }
            validateCash();
        });

        function resetItem() {
            $('.item-id').val('').trigger('change');
        }

        $(".status").select2({
            minimumResultsForSearch: -1
        });

        $('form').submit(function() {
            $('button[type=submit]', this).hide();
        });
    });
</script>