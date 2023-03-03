<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Riwayat</h1>
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
                <h5 class="card-title m-0">Riwayat Tanda Terima Servis</h5>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="data-table-sale">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Penerima</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if($history): ?>
                            <?php $i = 1 ?>
                            <?php foreach($history as $history): ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= date('d F Y', strtotime($history['transaction_date']))?></td>
                                    <td><?= $history['name'] ?></td>
                                    <td><?= $history['phone'] ?></td>
                                    <td><?= $history['status'] ?></td>
                                    <td><?= $history['penerima'] ?></td>
                                    <td>
                                        <button id="myModal" type="button" class="btn btn-success detail" data-id="<?= $history['id'] ?>" data-toggle="modal" data-target="#exampleModal">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        <?php else: ?>
                        <?php endif ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </tfoot>
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

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <td width="30%"><strong>Tanggal Transaksi</strong></td>
                      <td class="transaction_date">: </td>
                    </tr>
                    <tr>
                      <td><strong>Nama Pelanggan</strong></td>
                      <td class="name">: </td>
                    </tr>
                    <tr>
                      <td><strong>Nomor HP</strong></td>
                      <td class="phone">: </td>
                    </tr>
                    <tr>
                      <td><strong>Tipe Hp</strong></td>
                      <td class="tipe_hp">: </td>
                    </tr>
                    <tr>
                      <td><strong>Kerusakan</strong></td>
                      <td class="kerusakan">: </td>
                    </tr>
                    <tr>
                      <td><strong>Kelengkapan</strong></td>
                      <td class="kelengkapan">: </td>
                    </tr>
                    <tr>
                      <td><strong>Keterangan</strong></td>
                      <td class="keterangan">: </td>
                    </tr>
                    <tr>
                      <td><strong>Status</strong></td>
                      <td class="status">: </td>
                    </tr>
                    <tr>
                      <td><strong>Penerima</strong></td>
                      <td class="penerima">: </td>
                    </tr>
                  </table>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- JQuery -->
<script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
    $(function(){

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });

        $('.detail').on('click', function(){
            const id = $(this).data('id');
            
            $.ajax({
                url: "<?php echo base_url('servicereceipts/getDataDetailById/')?>"+id,
                type: "POST",
                dataType:"json",
                success: function(data){
                    console.log(data.transaction_date);
                    $('.transaction_date').html(': '+data.transaction_date);
                    $('.name').html(': '+data.name);
                    $('.keterangan').html(': '+data.keterangan);
                    $('.tipe_hp').html(': '+data.tipe_hp);
                    $('.phone').html(': '+data.phone);
                    $('.kerusakan').html(': '+data.kerusakan);
                    $('.kelengkapan').html(': '+data.kelengkapan);
                    $('.status').html(': '+data.status);
                    $('.penerima').html(': '+data.penerima);
                }
            })
        });
    });
</script>