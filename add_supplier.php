<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SupplierController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addSupplier($nama_supplier, $alamat_supplier, $id_akses) {
        $query = "INSERT INTO supplier (NamaSupplier, AlamatSupplier, IdAkses) VALUES('$nama_supplier', '$alamat_supplier', '$id_akses')";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: supplier.php");
            exit;
        } else {
            return "Error adding Supplier: " . mysqli_error($this->mysqli);
        }
    }
}

include_once("config.php");

if (isset($_POST['Submit'])) {
    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $id_akses = $_POST['id_akses'];

    $supplierController = new SupplierController($mysqli);
    $message = $supplierController->addSupplier($nama_supplier, $alamat_supplier, $id_akses);

    echo $message;
}
?>

<html>
<head>
    <title>Add Supplier</title>
</head>

<body>
<a href="supplier.php">Go to Supplier List</a>
<br/><br/>

<form action="add_supplier.php" method="post" name="form1">
    <table width="25%" border="0">
        <tr> 
            <td>Nama Supplier</td>
            <td><input type="text" name="nama_supplier"></td>
        </tr>
        <tr> 
            <td>Alamat Supplier</td>
            <td><input type="text" name="alamat_supplier"></td>
        </tr>
        <tr> 
            <td>Id Akses</td>
            <td><input type="text" name="id_akses"></td>
        </tr>
        <tr> 
            <td></td>
            <td><input type="submit" name="Submit" value="Add Supplier"></td>
        </tr>
    </table>
</form>
</body>
</html>
