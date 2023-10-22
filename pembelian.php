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

// Create database connection using config file
$databaseConnection = new DatabaseConnection("config.php");

// Fetch all pembelian data from the database
$result = $databaseConnection->fetchDataFromDatabase("pembelian");
?>

<html>
<head>    
    <title>Pembelian Management</title>
</head>

<body bgcolor="#007fff">
<a href="add_pembelian.php"><button>Add New Pembelian</button></a>
<a href="index.php"><button>Halaman Utama</button></a><br/><br/>

    <table width='80%' border=1 style="background-color:#FFFFE0;">

    <tr>
        <th>ID Pembelian</th> <th>Jumlah Pembelian</th> <th>Harga Pembelian</th> <th>Action</th>
    </tr>
    <?php  
    while ($pembelian_data = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$pembelian_data['IdPembelian']."</td>";
    echo "<td>".$pembelian_data['JumlahPembelian']."</td>";
    echo "<td>".$pembelian_data['HargaBeli']."</td>";
    echo "<td><a href='edit_pembelian.php?id=".$pembelian_data['IdPembelian']."'>Edit</a> | <a href='delete_pembelian.php?id=".$pembelian_data['IdPembelian']."'>Delete</a></td></tr>";
    }
    ?>
    </table>
</body>
</html>
