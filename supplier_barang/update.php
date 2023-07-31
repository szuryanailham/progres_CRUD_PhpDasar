<?php
require "functions.php"; 

$id=$_GET["id_barang"];

session_start();

if (!isset($_SESSION["login"])) {
  header("Location:login.php");
  exit;
};

//  panggil query dengan barang tersebut .....
$barang = query("SELECT * FROM stock_barang WHERE id_barang =$id")[0];
// ketika update button diklik maka .....
if (isset($_POST["update"])) {
  if (update($_POST)>0) {
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>selamat!</strong>  data berhasil di inputkan .
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' onclick='exit()'></button>
  </div>
    <script>
    function exit(){
      document.location.href='index.php';
      };
    </script>
  ";
  }else{
    echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>mohon maaf !</strong>  data  gagal diupdate .
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' onclick='exit()'></button>
  </div>
  ";
  }

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>form update</title>
    <link rel="stylesheet" href="css/tambah.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="img/style.css">
    <style>
      label {
         font-weight: bold;
}
.old-img{
  margin:2px ;
}
.new-img{
  margin-top: 7px ;
}
    </style> 
  </head>
  <body>
    <!-- judul page -->
    <div class="container">
      <h3 class="text-center p-2">update stock barang</h3>
      <div class="row justify-content-center">
        <div class="col-6 border border-success border border-2 p-3 mt-2">
        <!-- form tambah -->
        <form action="" method="post" enctype="multipart/form-data">
          <!-- id_barang -->
        <div class="mb-3">
          <input  type="text" name="id_barang" class="form-control" id="id_barang"  value="<?=$barang["id_barang"];?>" hidden>
          <input  type="text" name="gambar_lama" class="form-control" id="id_barang"  value="<?=$barang["foto_barang"];?>" hidden>
        </div>
        <!-- nama barang -->
          <div class="mb-3">
           <label for="nama_barang" class="form-label">Nama barang</label>
          <input  type="text" name="nama_barang" class="form-control" id="nama_barang"  value="<?=$barang["nama_barang"];?>" required>
        </div>
        <!-- harga barang -->
        <div class="mb-3">
           <label for="harga_barang" class="form-label">harga barang</label>
          <input  type="number" name="harga_barang" class="form-control" id="harga_barang" value="<?=$barang["harga_barang"];?>" required>
        </div>
        <!-- jenis barang -->
        <div class="mb-3">
        <label for="harga_barang" class="form-label">jenis barang</label>
        <select name="jenis_barang" class="form-select"  value="<?=$barang["jenis_barang"];?>">
          <option value="makanan">makanan</option>
          <option value="minuman">minuman</option>
          <option value="sembako">sembako</option>
        </select>
        <div id="emailHelp" class="form-text">mohon ulangi pemilihan jenis saat update barang!!</div>
        </div>
        <!-- tgl_datang -->
        <div class="mb-3">
           <label for="tgl_datang" class="form-label">Tanggal Datang</label>
          <input  type="date" name="tgl_datang" class="form-control" id="tgl_datang" value="<?=$barang["tgl_datang"];?>" required>
        </div>
        <!-- foto barang -->
        <div class="mb-3">
          <!-- gambar barang lama  -->
          <div class="old-img" >
          <img class="img-limit" src="img/<?=$barang["foto_barang"]?>" alt="<?=$barang["nama_barang"]?>">
          </div>
          <input type="file" name="gambar" class="form-control new-img" id="gambar">
        </div>
        <button class="btn btn-success mx-auto" name="update" type="submit">Update</button>
        </form>
        <!-- akhir form tambah -->
        </div>
      </div>
    </div>
    <!-- akhir judul page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>