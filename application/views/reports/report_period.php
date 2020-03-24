<?php 
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data Laporan ".getLabelUnitType($unit_type).' '.date('F Y', strtotime($period)).".xls");
 ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h2>Laporan Tagihan <?php echo date('F Y', strtotime($period)); ?></h2>
<h3>
<?php if ($unit_type == 1): ?>
Apartemen Pandan Wangi Residence
<?php else: ?>
Perumahan Pandan Wangi Mansion
<?php endif ?>    
</h3>
<table border="1">
<thead>
  <tr>
    <th>No</th>
    <th>Pemilik/Penyewa</th>
    <?php if ($unit_type == 1): ?>
    <th>Tower</th>
    <th>Lantai</th>
    <th>Blok</th>
    <?php else: ?>
    <th>Type</th>
    <th>Blok</th>
    <?php endif ?>
    <th>Total Listrik</th>
    <th>Total Air</th>
    <th>Total Kebersihan &amp; Keamanan</th>
    <th>Total TV Kabel</th>
    <th>Total Sinking Fund</th>
    <th>Denda</th>
    <th>Total Keseluruhan</th>
    <th>Status</th>
  </tr>
</thead>
<tbody>
  <?php foreach ($datas as $key => $value): ?>
  <tr>
    <td><?php echo $key + 1 ?></td>
    <?php if ($unit_type == 1): ?>
    <td><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'owner'); ?></td>
    <td><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'tower'); ?></td>
    <td><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'floor'); ?></td>
    <td><?php echo getDataColumn('residences', 'id', $value['unit_id'], 'blok'); ?></td>
    <?php else: ?>
    <td><?php echo getDataColumn('mansions', 'id', $value['unit_id'], 'owner'); ?></td>
    <td><?php echo getDataColumn('mansions', 'id', $value['unit_id'], 'type'); ?></td>
    <td><?php echo getDataColumn('mansions', 'id', $value['unit_id'], 'blok'); ?></td>
    <?php endif ?>
    <td><?php echo $value['el_total_price'] ?></td>
    <td><?php echo $value['water_total_price'] ?></td>
    <td><?php echo $value['cs_total_price'] ?></td>
    <td><?php echo $value['cabletv_total_price'] ?></td>
    <td><?php echo $value['sf_total_price'] ?></td>
    <td><?php echo $value['fine'] ?></td>
    <td><?php echo $value['grand_total'] ?></td>
    <td>
      <?php if ($value['payment_status'] == 1): ?>
        Sudah dibayar.
      <?php else: ?>
        Belum dibayar.
      <?php endif ?>
    </td>
  </tr>
  <?php 
  endforeach 
  ?>
</tbody>
</table>
</body>
</html>