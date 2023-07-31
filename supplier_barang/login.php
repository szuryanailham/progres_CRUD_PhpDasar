<?php
require "functions.php";
session_start();

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE["id"];
   $key = $_COOKIE["key"];

//    ambil username berdasarkan id ....
$result = mysqli_query($conn,'SELECT username FROM user WHERE id_user = $id');
$row = mysqli_fetch_assoc($result);

// cocokan key dengan username ....
if ($key === hash('sha256',$row["username"])) {
    $_SESSION['login'] = true ;
}
}

if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
  }
if (isset($_POST["login"])) {
    // ketika login dilakukan maka........
    $username_login = $_POST["username_login"];
    $password_login = $_POST["password_login"];

    // cek apakah username ada di database ....
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username_login'");
    if (mysqli_num_rows($result) === 1) {
        // apakah password sesuai ......
        $row = mysqli_fetch_assoc($result);
    if (password_verify($password_login,$row["password"])) {
        // set login session ....
        $_SESSION["login"] = true;
        // set cookie ........
        if (isset($_POST["remember"])) {
        //   set coockie berdasarkan id ..
        setcookie('id',$row['id_user'],time()+60);
        // set cookie berdasarkan  key ....
        setcookie('key',hash('sha256',$row["username"]),time()+60);

        }


        header("Location: index.php");
        exit;
    }
    }
    $error = true;

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        label{
            font-weight: bold;
        }
        </style>
  </head>
  <body>
    <!--  Registrasi -->
    <div class="container ">
        <!-- judul -->
        <div class="row justify-content-center p-3">
            <h2 class="text-center p-1">Halaman Login </h2>
            <div class="col-6 border border-success rounded-2 border-3 p-3">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                     login anda gagal , silahkan ulangi kembali
                    </div>
                <?php endif ?>
                <!-- form Login -->
                <form method="post">
                <div class="mb-3">
                    <label for="username_login" class="form-label">Username :</label>
                    <input type="text" class="form-control" name="username_login" id="username_login">
                </div>
                <div class="mb-3">
                    <label for="password_login" class="form-label">Password</label>
                    <input type="password" name="password_login" class="form-control" id="password_login">
                </div>
                <!-- ketika user ingin menguanakan coockie -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <div class="d-flex justify-content-between mb-3">
                <p><a href="registrasi.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover mb-1">Sign up</a></p>
                <button type="submit" name="login" class="btn btn-success ms-1">Login</button>
                </div>
                </form>
                <!-- akhir form login  -->
                
            </div>
        </div>
    </div>
    <!-- AKHIR Registrasi  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>