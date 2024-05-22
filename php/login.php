<?php
    session_start();
    include "koneksi.php";

    $error_message = ""; // Variabel untuk menyimpan pesan kesalahan

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $query = mysqli_query($koneksi, $sql);
        $count = mysqli_num_rows($query);
        if($count == 1){
            $_SESSION['loggedin'] = true;
            echo "<script>playSuccessSound();</script>";
            echo "<script>setTimeout(function() { window.location.href = 'tampil.php'; }, 500);</script>"; // Redirect setelah 1 detik
        }else{
            $error_message = "Login gagal, Username atau Password salah";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Login User</title>
        <style>

            @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

            * {
                margin: 0;
                padding: 0;
                text-decoration: none;
                box-sizing: border-box;
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
                justify-content: center;
                align-items: center;
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

            .login-container {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 300px;
                text-align: center;
                margin: 0 auto; /* Untuk memusatkan kontainer secara horizontal */
            }

            .login-container h2 {
                margin-bottom: 10px;
            }

            .login-container input[type="text"], 
            .login-container input[type="password"] {
                width: 90%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .password-container {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .password-container input[type="password"], 
            .password-container input[type="text"] {
                width: 90%;
                padding-right: 40px; /* Tambahkan padding untuk ruang ikon mata */
            }

            .password-container .toggle-password {
                position: absolute;
                right: 35px; /* Posisikan ikon mata di dalam input */
                cursor: pointer;
            }

            .login-container .button-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .login-container button {
                width: 48%;
                padding: 10px;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                margin: 0 auto; /* Untuk memusatkan kontainer secara horizontal */
            }

            .login-container button[type="submit"] {
                background-color: black;
                color: aqua;
                border: 2px solid aqua;
            }

            .login-container button[type="submit"]:hover {
                background-color: aqua;
                color: black;
                border: 2px solid black;
            }

            .login-container button.back-button {
                background-color: #f44336;
                color: #fff;
            }

            .login-container button.back-button:hover {
                background-color: #d32f2f;
            }

            .error {
                color: red;
                font-size: 14px; /* Ukuran font pesan kesalahan */
                margin-top: 10px;
            }

            .success {
                color: green;
                font-size: 14px;
                margin-top: 10px;
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
            
            <br>
            <br>
            <div class="login-container">
                <h2>FORM LOGIN USER</h2>
                <?php if ($error_message != ""): ?>
                    <div class="error"><?php echo $error_message; ?></div>
                <?php elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <div class="success">Login berhasil</div>
                <?php endif; ?>
                    <div>
                        <form action="login.php" method="post">
                            <input type="text" name="username" placeholder="Username" required>
                            <div class="password-container">
                                <input type="password" name="password" placeholder="Password" required>
                                <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                            </div>
                            <div class="button-container">
                                <button type="submit" name="login">Login</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>

        <audio id="error-sound" src="wrong.mp3" preload="auto"></audio>
        <audio id="success-sound" src="correct.mp3" preload="auto"></audio> <!-- Audio untuk suara sukses -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
        <script>
            function playErrorSound() {
                const errorSound = document.getElementById('error-sound');
                errorSound.play();
            }

            function playSuccessSound() {
                const successSound = document.getElementById('success-sound');
                successSound.play();
            }

            function togglePassword() {
                const passwordInput = document.querySelector('.password-container input');
                const toggleIcon = document.querySelector('.toggle-password');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            }

            <?php if ($error_message != ""): ?>
                playErrorSound();
            <?php endif; ?>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                playSuccessSound();
            <?php endif; ?>
        </script>
    </body>
</html>