<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="./kumpulan_css/daftar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bodyy">
    <div class="kontainer-1">
        <h1 class="mb-4">Welcome, Create your <br> account 🚀</h1>
        <form action="halaman-daftar.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="username">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pw">
                </div>
                <div class="tombol " class="d-flex">
                <button type="submit" name="submit" class="daftar">Daftar</button>
                <a href="halaman-login.php" class="login">Login</a>
                </div>
        </form>
    </div>

    <?php
        include "koneksi.php";
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $pw = $_POST['pw'];

            // Periksa apakah email sudah ada
            $email_check_query = "SELECT * FROM tabel_admin WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($connect, $email_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) { // jika email sudah ada
                echo "<script>alert('Email sudah digunakan, silakan gunakan email lain.')</script>";
            } else {
                // Jika email belum ada, lakukan insert data
                $sql = "INSERT INTO tabel_admin (email, username, pw) VALUES ('$email', '$username', '$pw')";
                mysqli_query($connect, $sql);
                echo "<script>alert('Anda Berhasil Mendaftar')</script>";
                echo "<meta http-equiv='refresh' content='1;url=halaman-login-admin.php'>";
            }
        }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>