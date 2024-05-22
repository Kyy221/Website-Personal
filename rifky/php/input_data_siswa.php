<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Input Data Siswa</title>
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

      form {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(105, 105, 105, 0.1);
        border-radius: 8px;
      }

      h3 {
        text-align: center;
        color: #333;
      }

      table {
        width: 100%;
      }

      table tr {
        margin-bottom: 10px;
      }

      table td {
        padding: 8px;
      }

      input[type="text"],
      input[type="date"],
      textarea {
        width: 130%;
        padding: 8px;
        box-sizing: border-box;
        margin-bottom: 10px;
      }

      input[type="radio"] {
        margin-right: 5px;
      }

      input[type="submit"],
      input[type="reset"] {
        background-color: black;
        color: aqua;
        padding: 10px 20px;
        border: 2px solid aqua;
        border-radius: 10px;
        cursor: pointer;
      }

      input[type="submit"]:hover,
      input[type="reset"]:hover {
        background-color: aqua;
        color: black;
        border: 2px solid black;
        border-radius: 10px;
      }

      h2 {
        text-align: center;
        color: #333;
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
    </style>

    <script>
    function confirmSubmit() {
      return confirm("Apakah Anda yakin ingin simpan data siswa?");
    }

    function confirmReset() {
      return confirm("Apakah Anda yakin ingin batalkan pengisian data siswa?");
    }
    </script>
    
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

    <form action="" method="post" onsubmit="return confirmSubmit()">
      <h3>TAMBAH DATA SISWA</h3>
      <table>
        <tr>
          <td>NISN</td>
          <td>:</td>
          <td><input type="text" name="nisn" /></td>
        </tr>
        <tr>
          <td>Nama Siswa</td>
          <td>:</td>
          <td><input type="text" name="nama_siswa" /></td>
        </tr>
        <tr>
          <td>Jenis Kelamin</td>
          <td>:</td>
          <td>
            <input type="radio" name="jenkel" value="Laki - Laki" />Laki - Laki
            <input type="radio" name="jenkel" value="Perempuan" />Perempuan
          </td>
        </tr>
        <tr>
          <td>Tempat Lahir</td>
          <td>:</td>
          <td><input type="text" name="tempat_lahir" /></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td>:</td>
          <td><input type="date" name="tanggal_lahir" /></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><textarea cols="19" rows="5" name="alamat"></textarea></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>
            <select name="id_kelas">
            <?php
            include "koneksi.php";
            $query=mysqli_query($koneksi, "select * from kelas");
            while ($data=mysqli_fetch_array($query))
              {
                ?>
                <option value="<?php echo $data['id_kelas']?>"><?php echo $data['nama_kelas']?></option>
                <?php
              }
              ?>
              </select>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <input type="submit" name="proses" value="Simpan" />
          </td>
          <td colspan="3">
            <input type="reset" name="proses" value="Batal" onclick="return confirmReset()" />
          </td>
        </tr>
      </table>
    </form>

    <?php
    include "fungsi.php";
    if(isset($_POST['proses'])){
      tambah_data($_POST);
    }
    ?>
  </body>
</html>