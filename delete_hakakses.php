<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class HakAksesController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function deleteHakAkses($id) {
        $query = "DELETE FROM hakakses WHERE IdAkses=$id";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: hakakses.php");
            exit;
        } else {
            echo "Error deleting Hak Akses: " . mysqli_error($this->mysqli);
        }
    }
}

// Create database connection using config file
include_once("config.php");

$hakaksesController = new HakAksesController($mysqli);

$id = $_GET['id'];

$message = $hakaksesController->deleteHakAkses($id);
?>
