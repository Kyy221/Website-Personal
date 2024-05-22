<?php
$server     = "localhost";
$user       = "root";
$password   = "";
$db         = "rifky";

$koneksi = mysqli_connect($server,$user,$password,$db);
if (!$koneksi) {
    die("<div style='text-align: center;'><h3 style='color: white;'>KONEKSI TIDAK BERHASIL<h3></div>");
} else {
    echo "<div style='textd-align: center;'><h3 style='color: white;'> <h3></div>";
}
?>