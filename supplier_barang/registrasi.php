<?php
require "functions.php";
if (isset($_POST["registrasi"])) {
    // ambil input user untuk registrasi ...
    // apabila register berhasil maka ......
    if (registrasi($_POST)>0) {
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>selamat!</strong> anda berhasil melakukan registrasi  .
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' onclick='exit()'></button>
      </div>
        <script>
        function exit(){
          document.location.href='index.php';
          };
        </script>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>registrasi gagal!</strong> silahkan coba lagi .
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
}

if (isset($_POST["login"])) {
 header("Location:login.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Page </title>
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
            <h2 class="text-center p-1">Halaman Registrasi</h2>
            <div class="col-7 border border-success rounded-2 border-3 p-3">
                <!-- form Regitrasi -->
            <form method="post">
                <!-- username  -->
                <div class="mb-3">
                <label for="username" id="username" class="form-label">Nama lengkap</label>
                <input type="text" name="username" class="form-control" id="username">
                </div>
                <!-- email -->
                <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
                </div>
                <!-- password -->
                <div class="mb-3">
                <label for="password" id="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                 </div>
                <!-- password verification  -->
                <div class="mb-3">
                <label for="password2" class="form-label">Password verification</label>
                <input type="password" name="password2" class="form-control" id="password2">
                </div>
                <!-- password verifikation -->
                <button type="submit" name="registrasi" class="btn btn-success">Registrasi</button>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>
                <!-- akhir form Registrasi  -->
            </div>
        </div>
    </div>
    <!-- AKHIR Registrasi  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>