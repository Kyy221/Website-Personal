<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda</title>

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

      .content {
        top: 50%;
        width: 100%;
        text-align: center;
        color: white;
        position: absolute;
        transform: translateY(-50%);
      }

      .content h1 {
        font-family: "Fantasy, Monospace";
        font-size: 80px;
        margin-top: 80px;
      }

      .content p {
        font-family: "Fantasy, Monospace";
        margin: 20px auto;
        font-weight: 100;
        line-height: 25px;
      }

      button {
        width: 200px;
        margin: 20px 10px;
        padding: 15px 0;
        text-align: center;
        text-transform: uppercase;
        font-weight: bold;
        color: aqua;
        background-color: black;
        border: 3px solid aqua;
        position: relative;
        cursor: pointer;
        border-radius: 10px;
        overflow: hidden;
      }

      span {
        height: 100%;
        width: 0;
        left: 0;
        bottom: 0;
        z-index: -1;
        position: absolute;
        border-radius: 10px;
        background-color:aqua;
      }

      button:hover span {
        width: 100%;
      }

      button:hover {
        border: 3px solid black;
      }
     </style>
  </head>
  
  <body>
    <div class="main">
      <div class="navbar">
        <label class="logo">KYY'S ALEXANDERIA SCHOOL</label>
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
      <div class="content">
        <h1>Rifky Khoirul Imdad</h1>
        <p>Selamat Datang di Website Rifky Khoirul Imdad</p><br>XII SIJA 1</br>
        <div>
          <button type="button"><span></span>Tampilkan Lebih Banyak</button>
        </div>
      </div>
    </div>
  </body>
</html>