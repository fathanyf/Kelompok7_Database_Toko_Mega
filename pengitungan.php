<!DOCTYPE html>
<html>
<head>
    <title>Total Sum</title>
</head>
<body bgcolor="007fff">
    <h1>Jumlah Hitungan</h1>
    <a href="index.php"><button>Halaman Utama</button></a>
    <?php
    
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'tokomega';

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

   
    $penjualan_query = "SELECT SUM(JumlahPenjualan) AS total_penjualan FROM penjualan";
    $penjualan_result = mysqli_query($conn, $penjualan_query);


    $pembelian_query = "SELECT SUM(JumlahPembelian) AS total_pembelian FROM pembelian";
    $pembelian_result = mysqli_query($conn, $pembelian_query);


    $pelanggan_query = "SELECT SUM(Qty) AS total_qty FROM pelanggan";
    $pelanggan_result = mysqli_query($conn, $pelanggan_query);

   
    $harga_jual_query = "SELECT SUM(HargaJual) AS total_harga_jual FROM penjualan";
    $harga_jual_result = mysqli_query($conn, $harga_jual_query);


    $harga_beli_query = "SELECT SUM(HargaBeli) AS total_harga_beli FROM pembelian";
    $harga_beli_result = mysqli_query($conn, $harga_beli_query);
    ?>

    <table border="1" style="background-color:#FFFFE0;">
        <tr>
            <th>Category</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Total Penjualan</td>
            <td><?php echo mysqli_fetch_assoc($penjualan_result)['total_penjualan']; ?></td>
        </tr>
        <tr>
            <td>Total Pembelian</td>
            <td><?php echo mysqli_fetch_assoc($pembelian_result)['total_pembelian']; ?></td>
        </tr>
        <tr>
            <td>Total Qty</td>
            <td><?php echo mysqli_fetch_assoc($pelanggan_result)['total_qty']; ?></td>
        </tr>
        <tr>
            <td>Total Harga Jual</td>
            <td><?php echo mysqli_fetch_assoc($harga_jual_result)['total_harga_jual']; ?></td>
        </tr>
        <tr>
            <td>Total Harga Beli</td>
            <td><?php echo mysqli_fetch_assoc($harga_beli_result)['total_harga_beli']; ?></td>
        </tr>
    </table>

    <?php

    mysqli_close($conn);
    ?>

</body>
</html>
