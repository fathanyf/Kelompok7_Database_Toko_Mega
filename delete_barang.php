<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class BarangController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deleteBarang($id) {
        $query = "DELETE FROM barang WHERE IdBarang=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: barang.php");
            exit;
        } else {
            echo "Error deleting Barang: " . mysqli_error($this->mysqli);
        }
    }
}

// Create a database connection using the config file
include_once("config.php");

$barangController = new BarangController($mysqli);

$id = $_GET['id'];

$message = $barangController->deleteBarang($id);
?>

