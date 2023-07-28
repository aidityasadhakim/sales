<!DOCTYPE html>
<html>

<head>
    <title>Cetak Nota Tanda Terima Servis</title>
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/normalize.css">
    <style>
        body.receipt .sheet {
            width: <?php echo $info['width']; ?>mm;
        }

        /* sheet size */
        @media print {
            body.receipt {
                width: <?php echo $info['width']; ?>mm
            }

            .btn-hide {
                display: none !important;
            }
        }

        /* fix for Chrome */

        * {
            font-size: 12px;
            padding: 0;
            margin: 0;
            font-family: 'Calibri';
            line-height: 23px;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .padding-5 {
            padding: 5mm;
        }

        .title {
            font-size: 14px;
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 12px;
            text-align: center;
            margin-bottom: 5px;
        }

        .regards {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .regards-text {
            display: flex;
            flex-direction: column;
        }

        hr {
            border-top: 1px solid #000;
            margin: 5px 0;
        }

        tfoot tr td:first-child {
            text-align: right;
            padding-right: 10px;
        }

        .header {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <script type="text/javascript">
        window.print();
    </script>
</head>

<body class="receipt">
    <p>
        <a href="<?php echo base_url('sale') ?>" class="btn-hide">Kembali</a>
    </p>
    <section class="sheet padding-5">
        <h3 class="title"><?php echo $info['title']; ?></h3>
        <h4 class="subtitle"><?php echo $info['address']; ?><br><?php echo $info['subtitle']; ?></h4>
        <hr>
        <div class="d-flex flex-column">
            <p class="header">TANDA TERIMA SERVIS</p>
            <p>No Nota: <?php echo 'IHSR' . $details['id']; ?></p>
            <div>
                <p class="left">Nama: <?= $details['customer_name'] ?></p>
                <p class="left">No Telp: <?= $details['phone_number'] ?></p>
                <p class="right"><?php echo date('d/m/Y', strtotime($details['transaction_date'])) ?></p>
            </div>
        </div>
        <div style="clear: both"></div>
        <hr>
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td width="25%" class="item-name">Tipe Hp</td>
                    <td width="5%">:</td>
                    <td><?= $details['phone_type'] ?></td>
                </tr>
                <tr>
                    <td width="25%" class="item-name">Kerusakan</td>
                    <td width="5%">:</td>
                    <td><?= $details['damage'] ?></td>
                </tr>
                <tr>
                    <td width="25%" class="item-name">Kelengkapan</td>
                    <td width="5%">:</td>
                    <td><?= $details['attribute'] ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td width="25%" class="item-name">Keterangan</td>
                    <td width="5%">:</td>
                    <td><?= $details['note'] ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="regards">
            <p style="font-size: 8px;line-height: 10px; width: 60%;">BARANG YANG TIDAK DIAMBIL LEWAT DARI 90 HARI DAN APABILA TERJADI KEHILANGAN BUKAN TANGGUNG JAWAB ISTANA HP</p>
            <div class="regards-text">
                <p>Hormat Kami,</p>
                <p><?= $details['recipient'] ?></p>
            </div>
        </div>
        <p>
            <button type="button" class="btn-hide" onclick="window.print()">Cetak</button>
        </p>
    </section>
</body>

</html>