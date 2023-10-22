<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SupplierController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deleteSupplier($id) {
        $query = "DELETE FROM supplier WHERE IdSupplier=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: supplier.php");
            exit;
        } else {
            echo "Error deleting Supplier: " . mysqli_error($this->mysqli);
        }
    }
}

// Create database connection using config file
include_once("config.php");

$supplierController = new SupplierController($mysqli);

$id = $_GET['id'];

$message = $supplierController->deleteSupplier($id);
?>
