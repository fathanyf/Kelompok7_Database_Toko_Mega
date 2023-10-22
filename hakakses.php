<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once("config.php");


$result = mysqli_query($mysqli, "SELECT * FROM hakakses");
?>

<html>
<head>    
    <title>Hak Akses Management</title>
</head>

<body bgcolor="#007fff">
<a href="add_hakakses.php"><button>Add New Hak Akses</button></a>
<a href="index.php"><button>Halaman Utama</button></a><br/><br/>

    <table width='80%' border=1 style="background-color:#FFFFE0;">

    <tr>
        <th>Id Akses</th> <th>Nama Akses</th> <th>Keterangan</th> <th>Action</th>
    </tr>
    <?php  
    while ($hakakses_data = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$hakakses_data['IdAkses']."</td>";
    echo "<td>".$hakakses_data['NamaAkses']."</td>";
    echo "<td>".$hakakses_data['Keterangan']."</td>";
    echo "<td><a href='edit_hakakses.php?id=".$hakakses_data['IdAkses']."'>Edit</a> | <a href='delete_hakakses.php?id=".$hakakses_data['IdAkses']."'>Delete</a></td></tr>";
    }
    ?>
    </table>
</body>
</html>

