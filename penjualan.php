<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create database connection using config file
include_once("config.php");

// Fetch all penjualan data from the database
$result = mysqli_query($mysqli, "SELECT * FROM penjualan");
?>

<html>
<head>    
    <title>Penjualan Management</title>
</head>

<body>
<body bgcolor="007fff">
<a href="add_penjualan.php">Add New Penjualan</a>
<a href="index.php">Index</a><br/><br/>

    <table width='80%' border=1 style="background-color:#FFFFE0;">

    <tr>
        <th>ID Penjualan</th> <th>Jumlah Penjualan</th> <th>Harga Penjualan</th> <th>Action</th>
    </tr>
    <?php  
    while ($penjualan_data = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$penjualan_data['IdPenjualan']."</td>";
    echo "<td>".$penjualan_data['JumlahPenjualan']."</td>";
    echo "<td>".$penjualan_data['HargaJual']."</td>";
    echo "<td><a href='edit_penjualan.php?id=".$penjualan_data['IdPenjualan']."'>Edit</a> | <a href='delete_penjualan.php?id=".$penjualan_data['IdPenjualan']."'>Delete</a></td></tr>";
    }
    ?>
    </table>
</body>
</html>