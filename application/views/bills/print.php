<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        /*@font-face {
            font-family: 'saxMono';
            src: url('https://book.pgp-group.id/assets/back/fonts/saxMono.woff2') format('woff2'),
                url('https://book.pgp-group.id/assets/back/fonts/saxMono.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }*/

        * {
            font-family: Arial;
            letter-spacing: 3px;
            font-size: 11px;
        }

        img {
            float: left;
            margin: 10px;
        }
        h2  {
            padding-top: 1.5em;
            margin: 0;
        }
        h5  {
            margin: 0;
        }
        .clear {
            clear: both;
        }
        h4 {
            text-align: center;
            text-decoration: underline;
        }
        .invoice {
            border-collapse: collapse;
            border: 1px solid black;
        }
        .invoice thead tr th, .invoice tbody tr td {
            padding: 5px;
            text-align: center;
        }
        @media print {
          html, body {
            height: 100%;
          }
          .full {
            height: 100%;
            margin-top: -35%;
            -webkit-transform: scale(.8,.50);
          }
      }
    </style>
</head>
<body>
<?php if ($row['unit_type'] == 1): ?>
<h2 align="center">Apartemen Pandan Wangi Residence <br>Kwitansi</h2>
<?php else: ?>
<h2 align="center">Perumahan Pandan Wangi Mansion <br>Kwitansi</h2>  
<?php endif ?>
<br><br>
<table>
  <tr>
    <td>Nama Pemilik/Penyewa</td>
    <td width="30%">: <?php echo $unit['owner']; ?></td>
    <td>Bulan Pemakaian</td>
    <td>: <?php echo date('F Y', strtotime($row['period'])) ?></td>
  </tr>
  <tr>
    <td>
    <?php if ($row['unit_type'] == 1): ?>
      Tower/Lantai/Blok
    <?php else: ?>
      Type/Blok
    <?php endif ?>
    </td>
    <td>
      :
    <?php 
    if ($row['unit_type'] == 1): 
      echo $unit['tower'].'/'.$unit['floor'].'/'.$unit['blok'];
    else: 
      echo $unit['type'].'/'.$unit['blok'];
    endif 
    ?>
    </td>
    <td>Bulan Pembayaran</td>
    <td>: <?php echo date('F Y', strtotime($row['paid_at'])) ?></td>
  </tr>
</table>
<table border="1" class="invoice">
  <thead>
    <tr>
      <th rowspan="3">Tgl Catat</th>
      <th colspan="10" align="center">Listrik</th>
    </tr>
    <tr>
      <th rowspan="2">Daya</th>
      <th colspan="2">Meter</th>
      <th colspan="3">Pemakaian</th>
      <th rowspan="2">PPJU</th>
      <th rowspan="2">PPN</th>
      <th rowspan="2">Jumlah (Rp)</th>
      <th rowspan="2">Denda 5%</th>
    </tr>
    <tr>
      <th>Awal</th>
      <th>Akhir</th>
      <th>Meter</th>
      <th>Fasum</th>
      <th>Harga</th>
    </tr>
  </thead>
  <tbody>
    <td><?php echo $row['transaction_date'] ?></td>
    <td>1300</td>
    <td><?php echo $row['el_last_used'] ?></td>
    <td><?php echo $row['el_used'] ?></td>
    <td><?php echo $row['el_total_used'] ?></td>
    <td><?php echo $row['pasum'] ?></td>
    <td><?php echo $row['el_total_used']*$row['el_rate']+$row['pasum'] ?></td>
    <td><?php echo $row['ppju'] ?></td>
    <td><?php echo $row['ppn'] ?></td>
    <td><?php echo $row['el_total_price'] ?></td>
    <td><?php echo $row['fine'] ?></td>
  </tbody>
  <thead>
    <tr>
      <th rowspan="3">Tgl Catat</th>
      <th colspan="7" align="center">Air</th>
      <th>Pengelolaan</th>
      <th rowspan="3">TV Kabel</th>
      <th rowspan="3">Jumlah (Rp)</th>
    </tr>
    <tr>
      <th colspan="2" align="center">Angka</th>
      <th colspan="2" align="center">Pemakaian</th>
      <th colspan="2" rowspan="2">Abonemen (Rp)</th>
      <th rowspan="2">Subtotal</th>
      <th rowspan="2">Keamanan &amp; Kebersihan</th>
    </tr>
    <tr>
      <th>Awal</th>
      <th>Akhir</th>
      <th>M<sup>3</sup></th>
      <th>(Rp)</th>
    </tr>
  </thead>
  <tbody>
    <td><?php echo $row['transaction_date'] ?></td>
    <td><?php echo $row['water_last_used'] ?></td>
    <td><?php echo $row['water_used'] ?></td>
    <td><?php echo $row['water_used'] ?></td>
    <td><?php echo $row['water_total_price'] ?></td>
    <td colspan="2"><?php echo $row['abonemen'] ?></td>
    <td><?php echo $row['water_total_price'] + $row['abonemen'] ?></td>
    <td><?php echo $row['cs_total_price'] ?></td>
    <td><?php echo $row['cabletv_total_price'] ?></td>
    <td><?php echo $row['water_total_price'] + $row['abonemen'] + $row['cs_total_price'] + $row['cabletv_total_price'] ?></td>
  </tbody>
</table>
<br> <br>
<table>
  <tbody>
    <tr>
      <td width="45%" valign="top">
        Catatan:<br>
        <ol>
          <li>Batas Akhir Pembayaran tanggal 15 bulan berjalan.</li>
          <li>Denda keterlambatan 5% dari total tagihan per tanggal 16.</li>
          <li>Pemutusan sementara per tanggal 20 bulan berjalan</li>
          <li>Tunggakan sampai 3 bulan akan dicabut meteran KWH, untuk pengaktifan dihitung sesuai pasang baru.</li>
          <li>Kwitansi ini sah jika dibubuhi cap lunas &amp; paraf pengelola.</li>
        </ol>
      </td>
      <td valign="top" align="center">Administrasi</td>
      <td valign="top" align="center">
        Total Tagihan <br><br>
        Rp. <?php echo number_format($row['grand_total']) ?>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>