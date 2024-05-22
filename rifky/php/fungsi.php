<?php
    function tambah_data($data){
        include "koneksi.php";
        if(isset($_POST['proses'])){
            $id_kelas=$_POST['id_kelas'];
            $nisn=$_POST['nisn'];
            $nama_siswa=$_POST['nama_siswa'];
            $jenkel=$_POST['jenkel'];
            $tempat_lahir=$_POST['tempat_lahir'];
            $tanggal_lahir=$_POST['tanggal_lahir'];
            $alamat=$_POST['alamat'];
            mysqli_query($koneksi, "insert into siswa values ('','$id_kelas','$nisn','$nama_siswa','$jenkel','$tempat_lahir','$tanggal_lahir','$alamat')");
            echo "<div style='text-align: center;'><h3 style='color: white;'>Data Berhasil Di Simpan<h3></div>";
        }
        else{
        echo "Id kelas tidak ada";
        }
    }
?>

<?php
    function tampil_data($showActions){
        include "koneksi.php";
        $sql = "SELECT siswa.id_siswa, siswa.nisn, siswa.nama_siswa, siswa.jenkel, siswa.tempat_lahir, siswa.tanggal_lahir, siswa.alamat, kelas.nama_kelas FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas";
        $query = mysqli_query($koneksi, $sql);

        if (isset($_GET['search'])) {
            $search = mysqli_real_escape_string($koneksi, $_GET['search']);
            $sql = "SELECT siswa.id_siswa, siswa.nisn, siswa.nama_siswa, siswa.jenkel, siswa.tempat_lahir, siswa.tanggal_lahir, siswa.alamat, kelas.nama_kelas FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                    WHERE nisn LIKE '%$search%' OR nama_siswa LIKE '%$search%'";
            $searching = true; // Flag to indicate that a search is performed
        } else {
            $searching = false; // Flag to indicate no search is performed
        }
        $query = mysqli_query($koneksi, $sql);
    
        $ulang = 1;
        while ($baris = mysqli_fetch_array($query))
        {
            echo"
            <tr>
                <td>$ulang</td>
                <td>$baris[nisn]</td>
                <td>$baris[nama_siswa]</td>
                <td>$baris[jenkel]</td>
                <td>$baris[tempat_lahir]</td>
                <td>$baris[tanggal_lahir]</td>
                <td>$baris[alamat]</td>
                <td>$baris[nama_kelas]</td>";
                if($showActions) { // Tampilkan aksi jika $showActions bernilai true
                    echo "
                    <td>
                        <a href='edit.php?id_siswa=$baris[id_siswa]'>Edit</a> | <a href='fungsi.php?aksi=delete&id_siswa=$baris[id_siswa]' onclick='return confirmDelete()'>Delete</a>
                    </td>";
                }
            echo "</tr>";
            $ulang++;
        }
    }    
?>

<?php
    function update_data($data){
        include "koneksi.php";
        $id_siswa = $data['id_siswa'];
        $nisn = $data['nisn'];
        $nama_siswa = $data['nama_siswa'];
        $jenkel = $data['jenkel'];
        $tempat_lahir = $data['tempat_lahir'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $alamat = $data['alamat'];
        $id_kelas = $data['id_kelas'];
    
        $query = "UPDATE siswa SET 
                  nisn='$nisn',
                  nama_siswa='$nama_siswa', 
                  jenkel='$jenkel', 
                  tempat_lahir='$tempat_lahir', 
                  tanggal_lahir='$tanggal_lahir', 
                  alamat='$alamat', 
                  id_kelas='$id_kelas' 
                  WHERE id_siswa='$id_siswa'";
    
        if(mysqli_query($koneksi, $query)){
            header("Location: tampil.php?update_success=true");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    }
?>

<?php
    if(isset($_POST['update'])){
        update_data($_POST);
    }
?>

<?php
    function delete_data($id_siswa){
        include "koneksi.php";
        $query = "DELETE FROM siswa WHERE id_siswa='$id_siswa'";
        if(mysqli_query($koneksi, $query)){
            header("Location: tampil.php?delete_success=true");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($koneksi);
        }
    }

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'delete'){
        $id_siswa = $_GET['id_siswa'];
        delete_data($id_siswa);
    }
?>

<script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus data siswa?");
    }
</script>