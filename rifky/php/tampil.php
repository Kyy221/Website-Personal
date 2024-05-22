<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>

      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

      * {
        margin: 0;
        padding: 0;
        text-decoration: none;
      }

      .main {
        width: 100%;
        height: 130vh;
        background-image: linear-gradient(
            rgba(0, 0, 0, 0.75),
            rgba(0, 0, 0, 0.75)
          ),
          url("/rifky/assets/bg_sekolah.jpg");
        background-size: cover;
        background-position: center;
      }

      .navbar {
        width: 85%;
        margin: auto;
        padding: 35px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .logo {
        font-family: "Fantasy, Monospace";
        font-size: 35px;
        color: white;
        font-weight: bold;
        cursor: pointer;
      }

      .navbar ul li {
        list-style: none;
        display: inline-block;
        margin: 0 20px;
        position: relative;
      }

      .navbar ul li a {
        color: rgb(255, 255, 255);
        text-transform: uppercase;
      }

      .navbar ul li::after {
        content: "";
        height: 3px;
        width: 0;
        background: aqua;
        position: absolute;
        left: 0;
        bottom: -5px;
        transition: 0.5s;
      }

      .navbar ul li:hover::after {
        width: 100%;
      }

      .data {
        position: absolute;
        top: 25%;
        left: 110px;
        max-width: 100%;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
      }

      h3 {
        text-align: center;
        color: #333;
      }

      table {
        width: 80vw;
        border-collapse: collapse;
        margin-top: 15px;
        background-color: #FFFFFF; /* Pastel blue background color */
      }

      th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
        color: black;
      }

      th {
        text-align: center;
        background-color: #00FFFF; /* Lighter blue for header */
      }

      tr:nth-child(even) {
        background-color: #FFFFFF; /* Slightly darker blue for even rows */
      }

      tr:hover {
        background-color: #00FFFF; /* Lighter blue on hover */
      }

      .buttons {
        display: flex;
        align-items: center; 
        color: black;
      }

      form {
        display: flex; 
        align-items: center; 
        margin-bottom: 10px;
      }

      button {
        padding: 7px 20px; 
        border: none;
        background-color: #00FFFF; 
        color: black;
        cursor: pointer;
        border-radius: 5px;
        margin-right: 10px; 
      }

      input[type=text] {
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        width: 220px;
        margin-right: 10px; 
      }

      label {
        margin-right: 7px; 
      }

      .search-container {
        display: flex;
        align-items: center;
      }

      .fa-search {
        font-size: 16px;
      }
    </style>
  </head>

  <body>
    <div class="main">
      <div class="navbar">
        <label class="logo">KYY'S ALEXANDERIA SCHOOL</label>
        <?php
          $showActions = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
        ?>
        <ul>
          <li><a href="/rifky/php/index.php">Beranda</a></li>
          <li><a href="/rifky/php/input_data_siswa.php">Input Data</a></li>
          <li><a href="/rifky/php/tampil.php">Data Siswa</a></li>
          <li>            
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
              <a href="logout.php">Logout</a>
            <?php else: ?>
              <a href="login.php">Login</a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
    <div class="data"> 
    <h3> DATA SISWA KYY'S ALEXANDERIA SCHOOL </h3>
    <br>
    <div>
    <table border=2>
        <tr>
            <th> No </th>
            <th> NISN </th>
            <th> Nama </th>
            <th> Jenis Kelamin </th>
            <th> Tempat Lahir </th>
            <th> Tanggal Lahir </th>
            <th> Alamat </th>
            <th> Kelas </th>
            <?php if($showActions): ?>
              <th> Aksi </th>
            <?php endif; ?>
        </tr>

<?php
  $searching = isset($_GET['search']);
  $cancel_clicked = isset($_GET['cancel_search']);
?>

  <form method="GET">
  <div class="search-container">
  <label for="search"><i class="fas fa-search"></i></label>
  <input type="text" id="search" name="search" placeholder="Cari berdasarkan NISN atau Nama">
  <button type="submit" class="search-button">Cari</button>
    
  <?php if ($searching && !$cancel_clicked) : ?>
    <button type="submit" class="back-button" name="cancel_search">Kembali</button>
  <?php endif; ?>
  </div>
  </form>

    <?php
      include "fungsi.php";
      tampil_data($showActions);
    ?>
  </div>
  </div>
  </body>
</html>