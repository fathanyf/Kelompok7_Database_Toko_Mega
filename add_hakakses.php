<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class HakAksesController {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function addHakAkses($nama_akses, $keterangan) {
        $query = "INSERT INTO hakakses (NamaAkses, Keterangan) VALUES('$nama_akses', '$keterangan')";
        $result = mysqli_query($this->mysqli, $query);

        if ($result) {
            header("Location: hakakses.php");
            exit;
        } else {
            return "Error adding Hak Akses: " . mysqli_error($this->mysqli);
        }
    }
}

include_once("config.php");

if (isset($_POST['Submit'])) {
    $nama_akses = $_POST['nama_akses'];
    $keterangan = $_POST['keterangan'];

    $hakaksesController = new HakAksesController($mysqli);
    $message = $hakaksesController->addHakAkses($nama_akses, $keterangan);

    echo $message;
}
?>

<html>
<head>
    <title>Add Hak Akses</title>
</head>

<body>
<a href="hakakses.php">Go to Hak Akses List</a>
<br/><br/>

<form action="add_hakakses.php" method="post" name="form1">
    <table width="25%" border="0">
        <tr> 
            <td>Nama Akses</td>
            <td><input type="text" name="nama_akses"></td>
        </tr>
        <tr> 
            <td>Keterangan</td>
            <td><input type="text" name="keterangan"></td>
        </tr>
        <tr> 
            <td></td>
            <td><input type="submit" name="Submit" value="Add Hak Akses"></td>
        </tr>
    </table>
</form>
</body>
</html>
