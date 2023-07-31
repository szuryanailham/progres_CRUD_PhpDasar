<?php
require "functions.php";
session_start();

if (!isset($_SESSION["login"])) {
  header("Location:login.php");
  exit;
};

// melakukan pagination ...........
$JumlahPerPage = 5 ;
$JumlahSemuaData = count(query("SELECT * FROM stock_barang"));
$jumlahHalaman = ceil($JumlahSemuaData /$JumlahPerPage);
// cek halaman aktif ....
$halamanAktif =((isset($_GET["halaman"]))?$_GET["halaman"]:1);
//  mulai hitung mulai data yang ditampilkan ....
//  1 / 0
// 2  / 5
// 3 / 14 
$dataMulai = ($JumlahPerPage * $halamanAktif) - $JumlahPerPage;
// mencoba menampilkan 5 sampel barang dari database ....
$barang = query("SELECT * FROM stock_barang LIMIT $dataMulai ,$JumlahPerPage");


// melakukan pencarian 
if (isset($_POST["search"])) {
$barang = search($_POST["keyword"]);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- css costum -->
    <link rel="stylesheet" href="css/index.css">
    <!-- boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
  <body>
   <!-- container  -->
    <div class="container-fluid">
        <div class="row p-3">
            <!-- plus button -->
            <div class="col-2">
            <a href="tambah.php">
            <button class="btn btn-success ms-5" type="submit"><i class="bi bi-plus-lg"></i></button>
            </a>
            </div>
              <!-- akhir pluss button -->

                <!-- judul page -->
            <div class="col-8">
            <h3 class="text-center">List barang toko indoJaya</h3>
            </div>
            <!-- akhir judul page -->
            
            <div class="col-2">
            <!-- log out button -->
            <button class="btn btn-danger" style="font-weight: bold;" type="submit"><a href="logout.php">Log Out</a></button>
            <!-- akhir log out button -->
            </div>
        </div>

       <!-- row ke-dua -->
        <div class="row">
             <!-- input pencarian -->
           <form method="post" action="">
           <div class="col-4 offset-4 mt-2">
           <div class="input-group mb-3">
            <input type="text" class="form-control" name="keyword" placeholder="cari barang ......" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-success" type="submit" name="search" id="button-addon2">Search</button>
            </div>
           </div>
           </form>
            <!-- akhir input pencarian -->

               <!-- pagination icon -->
               <nav aria-label="Page navigation example">
              <ul class="pagination">
                <?php if ($halamanAktif > 1):?>
                  <li class="page-item">
                  <a class="page-link" href="?halaman=<?=$halamanAktif-1?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php endif; ?>
               <!-- looping foreach  -->
               <?php for ($i = 1; $i <= $jumlahHalaman;$i++) : ?>
                <!-- memberi tanda halaman aktif -->
                <?php if ($i == $halamanAktif) :?>
                   <li class="page-item active"><a class="page-link" href="?halaman=<?=$i?>"><?=$i?></a></li>
                <?php else: ?>
                  <li class="page-item"><a class="page-link" href="?halaman=<?=$i?>"><?=$i?></a></li>
                  <?php endif; ?>
                <?php  endfor ; ?>
               <!-- akhir looping  -->
                <?php if($halamanAktif < $jumlahHalaman): ?>
                  <li class="page-item">
                  <a class="page-link" href="?halaman=<?=$halamanAktif+1?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                <?php endif; ?>
              </ul>
            </nav>
            <!-- akhir pagination icon -->
        </div>
   

        <!-- TABEL DATA -->
        <div class="row">
        <div class="col">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Action </th>
            <th scope="col">nama barang</th>
            <th scope="col">Harga barang</th>
            <th scope="col">Jenis barang</th>
            <th scope="col">tanggal datang </th>
            <th scope="col">foto barang </th>
            </tr>
        </thead>
        <tbody>
           
                <?php $i = 1 ?>
               <?php foreach($barang as $item): ?>
                <tr>
                 <th scope="row"><?=$item["id_barang"]?></th>
                 <!-- action  --> 
                 <td>
                  <!-- button edit -->
                <button class="btn btn-warning" type="submit"><a style="color:white" href="update.php?id_barang=<?=$item["id_barang"]?>"><i class="bi bi-pencil"></i></a></button>
                  <!-- button delete -->
                  <button class="btn btn-danger" type="submit"><a style="color:white" href="hapus.php?id_barang=<?=$item["id_barang"]?>"><i class="bi bi-trash3-fill"></i></a></button>
                 </td>                                
                 <!-- akhir action -->
                <!-- nama barang -->
                <td><?=$item["nama_barang"]?></td>
                <!-- harga barang -->
                <td><?=$item["harga_barang"]?></td>
                <!-- jenis barang  -->
                <td><?=$item["jenis_barang"]?></td>
                <!-- tanggal data -->
                <td><?=$item["tgl_datang"]?></td>
                <!-- gambar barang -->
                <td>
                    <img class="img-limit" src="img/<?=$item["foto_barang"]?>" alt="<?=$item["nama_barang"]?>">
                </td>
                </tr>
                <?php endforeach?>
           
        </tbody>
</table>
        </div>
        </div>
        <!-- AKHIR TABEL DATA -->
    </div>
   <!-- akhir container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>