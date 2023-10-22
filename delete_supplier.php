<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SupplierDeleter {
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
            return "Error deleting Supplier: " . mysqli_error($this->mysqli);
        }
    }
}

// Create database connection using config file
include_once("config.php");

$supplierDeleter = new SupplierDeleter($mysqli);

$id = $_GET['id'];

$message = $supplierDeleter->deleteSupplier($id);
?>
