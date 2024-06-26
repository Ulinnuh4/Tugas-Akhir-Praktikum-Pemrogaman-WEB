<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="./kumpulan_css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        *{
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: "Poppins";
        }
        .kontainer-1{
            width: 25%;
            background: #ebebeb;
            margin: 130px auto 0 auto;
            padding: 10px 20px;
            box-shadow:inset 7px 7px 10px #d6d6d6,
                        inset -7px -7px 14px #fff;
            border-radius: 10px;
        }
        .kontainer-1 h1{
            font-weight: 700;
        }
        .bodyy{
            background-color: #efefef;
        }
        .daftar{
            border: none;
            background-color: #4d92ed;
            padding: 4px 20px;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
        }
        input{
            background: #cecece;
            box-shadow:inset 2px 2px 5px #b5b5b5,
                        inset -7px -7px 14px #fff;
        }
    </style>
  </head>
  <body class="bodyy">
    <div class="kontainer-1">
        <h1 class="text-center mb-5">Welcome</h1>
        <form action="halaman-login-admin.php" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="username">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="pw">
                </div>
                <div>
                    <p>Belum punya akun ? daftar <a href="halaman-daftar.php">Disini</a></p>
                </div>
                <div class="tombol">
                <button type="submit" name="submit" class="daftar my-2">Login</button>
                </div>
        </form>
        <?php
        session_start();
        include "koneksi.php";
        $error_message = "";

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $pw = $_POST['pw'];
            $query = mysqli_query($connect, "select * from tabel_admin where username = '$username' and pw = '$pw'");
            
            $akunadmin = mysqli_num_rows($query);
            $data_user = mysqli_fetch_assoc($query);
            if($akunadmin==1){
                $_SESSION['username']=$data_user['username'];
                echo "<script>alert('Login sukses')</script>";
                echo "<meta http-equiv='refresh' content='1;url=dashboard.php'>";
            }
            else{
                echo "<div class='alert alert-danger'>Password atau Username salah</div?";
            }
           
            
    }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>


