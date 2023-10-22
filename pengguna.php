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

// Fetch all pengguna data from the database
$result = $databaseConnection->fetchDataFromDatabase("pengguna");
?>

<html>
<head>    
    <title>Pengguna Management</title>
</head>

<body bgcolor="#007fff">
<a href="add_pengguna.php">Add New Pengguna</a>
<a href="index.php">Index</a><br/><br/>

    <table width='80%' border=1 style="background-color:#FFFFE0;">

    <tr>
        <th>Id Pengguna</th> <th>Nama Pengguna</th> <th>Password</th> <th>Hak Akses</th> <th>Action</th>
    </tr>
    <?php  
    while ($pengguna_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$pengguna_data['IdPengguna']."</td>";
        echo "<td>".$pengguna_data['NamaPengguna']."</td>";
        echo "<td>".$pengguna_data['Password']."</td>";
        echo "<td>".$pengguna_data['HakAkses']."</td>";
        echo "<td><a href='edit_pengguna.php?id=".$pengguna_data['IdPengguna']."'>Edit</a> | <a href='delete_pengguna.php?id=".$pengguna_data['IdPengguna']."'>Delete</a></td></tr>";
    }
    ?>
    </table>
</body>
</html>
