<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SupplierController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function updateSupplier($id, $nama_supplier, $alamat_supplier, $id_akses) {
        $query = "UPDATE supplier SET NamaSupplier='$nama_supplier', AlamatSupplier='$alamat_supplier', IdAkses='$id_akses' WHERE IdSupplier=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: supplier.php");
            exit;
        } else {
            return "Error updating Supplier: " . mysqli_error($this->mysqli);
        }
    }

    public function getSupplierData($id) {
        $result = mysqli_query($this->mysqli, "SELECT * FROM supplier WHERE IdSupplier=$id");
        return mysqli_fetch_assoc($result);
    }
}

// Create database connection using config file
include_once("config.php");

$supplierController = new SupplierController($mysqli);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $id_akses = $_POST['id_akses'];

    $message = $supplierController->updateSupplier($id, $nama_supplier, $alamat_supplier, $id_akses);
}

$id = $_GET['id'];

$supplier_data = $supplierController->getSupplierData($id);

if (!$supplier_data) {
    echo "Supplier data not found.";
    exit;
}

$nama_supplier = $supplier_data['NamaSupplier'];
$alamat_supplier = $supplier_data['AlamatSupplier'];
$id_akses = $supplier_data['IdAkses'];
?>

<html>
<head>
    <title>Edit Supplier</title>
</head>

<body>
<a href="supplier.php">Go to Supplier List</a>
<br/><br/>

<form name="update_supplier" method="post" action="edit_supplier.php">
    <table border="0">
        <tr> 
            <td>Nama Supplier</td>
            <td><input type="text" name="nama_supplier" value="<?php echo $nama_supplier; ?>"></td>
        </tr>
        <tr> 
            <td>Alamat Supplier</td>
            <td><input type="text" name="alamat_supplier" value="<?php echo $alamat_supplier; ?>"></td>
        </tr>
        <tr> 
            <td>Id Akses</td>
            <td><input type="text" name="id_akses" value="<?php echo $id_akses; ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
            <td><input type="submit" name="update" value="Update Supplier"></td>
        </tr>
    </table>
</form>
</body>
</html>
