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


$databaseConnection = new DatabaseConnection("config.php");


$result = $databaseConnection->fetchDataFromDatabase("supplier");
?>

<html>
<head>    
    <title>Supplier Management</title>
</head>

<body bgcolor="#007fff">
<a href="add_supplier.php"><button>Add New Supplier</button></a>
<a href="index.php"><button>Halaman Utama</button></a><br/><br/>

<table width='80%' border=1 style="background-color:#FFFFE0;">

    <tr>
        <th>Id Supplier</th> <th>Nama Supplier</th> <th>Alamat Supplier</th> <th>IdAkses</th> <th>Action</th>
    </tr>
    <?php  
    while ($supplier_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$supplier_data['IdSupplier']."</td>";
        echo "<td>".$supplier_data['NamaSupplier']."</td>";
        echo "<td>".$supplier_data['AlamatSupplier']."</td>";
        echo "<td>".$supplier_data['IdAkses']."</td>";
        echo "<td><a href='edit_supplier.php?id=".$supplier_data['IdSupplier']."'>Edit</a> | <a href='delete_supplier.php?id=".$supplier_data['IdSupplier']."'>Delete</a></td></tr>";
    }
    ?>
</table>
</body>
</html>
