<?php
  include "koneksi.php";
  if(isset($_GET['id_siswa'])){
    $id=$_GET['id_siswa'];
    $sql="SELECT siswa.id_siswa,siswa.id_kelas, siswa.nisn, siswa.nama_siswa, siswa.jenkel, siswa.tempat_lahir, siswa.tanggal_lahir, siswa.alamat, kelas.nama_kelas FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE siswa.id_siswa=$id";
    $query=mysqli_query($koneksi, $sql);
    while ($data=mysqli_fetch_array($query)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        body {
            width: 100%;
            height: 124vh;
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
</head>

  <body>
      <br>
      <br>
      <form action="fungsi.php" method="post">
        <h3>Edit Data Siswa</h3>
        <table>
          <tr>
            <td>NISN</td>
            <td>:</td>
            <td><input type="text" name="nisn" value="<?php echo $data['nisn']; ?>"></td>
          </tr>
          <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td><input type="text" name="nama_siswa" value="<?php echo $data['nama_siswa']; ?>"></td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><input type="radio" name="jenkel" value="Laki - Laki" <?php if($data['jenkel']=="Laki - Laki") echo "checked"; ?>> Laki - Laki
                <input type="radio" name="jenkel" value="Perempuan" <?php if($data['jenkel']=="Perempuan") echo "checked"; ?>> Perempuan</td>
          </tr>
          <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><input type="text" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>"></td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>"></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea cols="19" rows="5" name="alamat"><?php echo $data['alamat']; ?></textarea></td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><select name="id_kelas">
            <?php
            $query_kelas=mysqli_query($koneksi, "SELECT * FROM kelas");
            while ($data_kelas=mysqli_fetch_array($query_kelas)) {
                if($data_kelas['id_kelas']==$data['id_kelas']){
                    echo "<option value='$data_kelas[id_kelas]' selected>$data_kelas[nama_kelas]</option>";
                }else{
                    echo "<option value='$data_kelas[id_kelas]'>$data_kelas[nama_kelas]</option>";
                }
            }
            ?>
            </select></td>
          </tr>
          <tr>
            <td colspan="3">
              <input type="hidden" name="id_siswa" value="<?php echo $data['id_siswa']; ?>">
              <input type="submit" name="update" value="Update" />
            </td>
            <td colspan="3">
              <input type="reset" value="Batal" onclick="window.location.href='tampil.php'" />
            </td>
          </tr>
        </table>
    </form>
</body>
</html>

<?php
    }
  }
?>