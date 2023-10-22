<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class DatabaseConnection {
    private $mysqli;

    public function __construct($configFile) {
        include_once($configFile);
        $this->mysqli = $mysqli;
    }

    public function fetchDataFromDatabase($table) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM $table");
        return $result;
    }
}

// Create a database connection using the config file
$databaseConnection = new DatabaseConnection("config.php");

// Fetch all pelanggan data from the database
$result = $databaseConnection->fetchDataFromDatabase("Pelanggan");
?>

<html>
<head>
    <title>Pelanggan Management</title>
</head>

<body bgcolor="#007fff">
<a href="add_pelanggan.php"><button>Add New Pelanggan</button></a>
<a href="index.php"><button>Halaman Utama</button></a><br/><br/>

<table width='80%' border=1 style="background-color:#FFFFE0;">
    <tr>
        <th>Id Pembelian</th>
        <th>Id Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>Id Barang</th>
        <th>Qty</th>
        <th>Tanggal Pesan</th>
        <th>Id Pengguna</th>
        <th>Action</th>
    </tr>
    <?php
    while ($pelanggan_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$pelanggan_data['IdPembelian']."</td>";
        echo "<td>".$pelanggan_data['IdPelanggan']."</td>";
        echo "<td>".$pelanggan_data['NimPelanggan']."</td>";
        echo "<td>".$pelanggan_data['IdBarang']."</td>";
        echo "<td>".$pelanggan_data['Qty']."</td>";
        echo "<td>".$pelanggan_data['TanggalPesan']."</td>";
        echo "<td>".$pelanggan_data['IdPengguna']."</td>";
        echo "<td><a href='edit_pelanggan.php?id=".$pelanggan_data['IdPelanggan']."'>Edit</a> | <a href='delete_pelanggan.php?id=".$pelanggan_data['IdPelanggan']."'>Delete</a></td></tr>";
    }
    ?>
</table>
</body>
</html>
