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

// Fetch all barang data from the database
$result = $databaseConnection->fetchDataFromDatabase("barang");
?>

<html>
<head>    
    <title>Barang Management</title>
</head>

<body bgcolor="#007fff">
<a href="add_barang.php"><button>Add New Barang</button></a>
<a href="index.php"><button>Halaman Utama</button></a><br/><br/>

    <table width='80%' border=1 style="background-color:#FFFFE0;">

    <tr>
        <th>Id Barang</th> <th>Nama Barang</th> <th>Keterangan</th> <th>Satuan</th> <th>No HP</th> <th>Alamat</th> <th>IdPengguna</th> <th>IdAkses</th> <th>Action</th>
    </tr>
    <?php  
    while ($barang_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$barang_data['IdBarang']."</td>";
        echo "<td>".$barang_data['NamaBarang']."</td>";
        // echo "<td>".$barang_data['NamaDepan']."</td>";
        // echo "<td>".$barang_data['NamaBelakang']."</td>";
        echo "<td>".$barang_data['Keterangan']."</td>";
        echo "<td>".$barang_data['Satuan']."</td>";
        echo "<td>".$barang_data['NoHp']."</td>";
        echo "<td>".$barang_data['Alamat']."</td>";
        echo "<td>".$barang_data['IdPengguna']."</td>";
        echo "<td>".$barang_data['IdAkses']."</td>";
        echo "<td><a href='edit_barang.php?id=".$barang_data['IdBarang']."'>Edit</a> | <a href='delete_barang.php?id=".$barang_data['IdBarang']."'>Delete</a></td></tr>";
    }
    ?>
    </table>
</body>
</html>
