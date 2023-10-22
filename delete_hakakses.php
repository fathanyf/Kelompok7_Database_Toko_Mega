<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class HakAksesDeleter {
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
            return "Error deleting Hak Akses: " . mysqli_error($this->mysqli);
        }
    }
}

include_once("config.php");

$hakAksesDeleter = new HakAksesDeleter($mysqli);

$id = $_GET['id'];

$message = $hakAksesDeleter->deleteHakAkses($id);
?>

