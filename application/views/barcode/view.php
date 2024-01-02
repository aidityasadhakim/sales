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
                            <?php if ($this->session->flashdata('msg')) : ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <?php echo $this->session->flashdata('msg'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <button type="button" class="btn btn-primary" id="scanner-button">
                                Scan
                            </button>
                            <div class="d-flex flex-column">
                                <div id="qr-reader" class="md-w-50 my-2"></div>
                                <div id="qr-reader-results" style="display:none;">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td width="30%"><strong>Nama barang: </strong></td>
                                                <td id="item-name"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Keterangan: </strong></td>
                                                <td id="item-note"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Harga Jual: </strong></td>
                                                <td id="item-saleprice"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Harga Modal: </strong></td>
                                                <td id="item-buyprice"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sisa Stok: </strong></td>
                                                <td id="item-stock"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
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
<script>
    $(function() {

        var lastResult = 0;

        function getItem(id) {
            $.ajax({
                url: "<?php echo base_url('barcode/getitemdata') ?>", // Replace with your API endpoint
                method: "POST",
                contentType: "application/json", // Set content type to JSON
                data: JSON.stringify({
                    id: lastResult
                }), // Convert data to JSON string
                success: function(data) {
                    // Handle the successful response
                    data = JSON.parse(data);
                    $("#item-name").html(data.item.name);
                    $("#item-note").html(data.item.note);
                    $("#item-saleprice").html(data.item.salePrice);
                    $("#item-buyprice").html(data.item.buyPrice);
                    $("#item-stock").html(data.item.stock);
                    $("#qr-reader-results").show();
                    console.log(JSON.parse(data));
                },
                error: function(error) {
                    // Handle errors
                    console.error("Error:", error);
                }
            });
        }

        $("#scanner-button").on("click", function() {
            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    getItem();
                    html5QrcodeScanner.clear();
                }
            }
            console.log("Hello")
            var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
                fps: 10,
            });
            html5QrcodeScanner.render(onScanSuccess);
        })

    })
</script>