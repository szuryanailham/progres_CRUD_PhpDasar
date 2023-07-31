<?php 
require 'functions.php';

session_start();

if (!isset($_SESSION["login"])) {
  header("Location:login.php");
  exit;
};

$id = $_GET["id_barang"];

if (hapus($id)>0) {
    echo"<script>
    alert('data anda berhasil dihapus');
    document.location.href = 'index.php';
    </script>";
}else{
    echo"<script>
    alert('data gagal dihapus');
    document.location.href = 'index.php';
    </script>";
}


?>

