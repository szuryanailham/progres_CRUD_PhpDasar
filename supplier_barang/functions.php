<?php
// menyambungkan dengan mysqli
// nama server // nama user //sandi // namadatabase .....
$conn = mysqli_connect("localhost","root","","supplier_barang");

// membuat function query 
function query($query){
    global $conn;
    // ambil data semua data dari database....
    $result = mysqli_query($conn,$query);
    // siapkan variable wadah  database .....
    $rows = [];
    // pindah database ke  varibale wadah
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
};

// function tambah data ......
function tambah($data){
    global $conn;
    $nama_barang = $data["nama_barang"];
    $harga_barang = $data["harga_barang"];
    $jenis_barang = $data["jenis_barang"];
    $tgl_datang = $data["tgl_datang"];
    $gambar = aploud();

    if(!$gambar){
        return false;
    }

    // buat query requies 
    $query = "INSERT INTO stock_barang VALUES ('','$nama_barang','$harga_barang','$jenis_barang'
               ,'$tgl_datang','$gambar')";
    mysqli_query($conn,$query);
    // cek apakah data berhasil di insert 
    return mysqli_affected_rows($conn);
}

// function aploud gambar .........
function aploud(){
    $nama_file = $_FILES["gambar"]["name"];
    $ukuran = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmp_penyimpanan = $_FILES["gambar"]["tmp_name"];

    // seleksi apakah user aploud file atau tidak ....
    if ($error === 4) {
        echo "<script>
        alert('Aploud gambar terlebih dahulu .......');
        </script>";
        return false;
    }
    // seleksi apakah user mengploud file jenis gambar ; 
    $ekstensiFileValid = ["jpg","jpeg","png","pdf"];
    $ekstensiFile = explode('.',$nama_file);
    $ekstensiFile = strtolower(end($ekstensiFile));
    if (!in_array($ekstensiFile,$ekstensiFileValid)) {
        echo "<script>
        alert('jenis file anda tidak sesuai .......');
        </script>";
        return false;
    }
    // seleksi ukuran gambar..........
    if($ukuran > 1000000){
        echo "<script>
        alert('ukuran file anda terlalu besar  .......');
        </script>";
        return false;
    }; 
    // acak nama file gambar ......
    $namaFileBaru = uniqid();
    $namaFileBaru.= ".";
    $namaFileBaru.=$ekstensiFile;
    // ubah penyimpanan ke local ...
    move_uploaded_file($tmp_penyimpanan,"img/".$namaFileBaru); 
    return $namaFileBaru;
}
// function hapus barang .....
function hapus($id){
global $conn;
mysqli_query($conn,"DELETE FROM stock_barang WHERE id_barang = $id");

return mysqli_affected_rows($conn);
}

// function update barang ......
function update($data){
global $conn;
// ambil data dari $data maka ...
$id = $data["id_barang"];
$nama = htmlspecialchars($data["nama_barang"]);
$harga = htmlspecialchars($data["harga_barang"]);
$jenis = htmlspecialchars($data["jenis_barang"]);
$tgl = htmlspecialchars($data["tgl_datang"]);
$gambarLama = htmlspecialchars($data["gambar_lama"]);

// cek apakah user menganti foto atau tidak ....
if ($_FILES["gambar"]["error"] === 4) {
   $gambar = $gambarLama;
}else{
    $gambar = aploud();
}
// $gambar = htmlspecialchars($data["gambar_barang"]);

$query = "UPDATE Stock_barang SET nama_barang ='$nama',
                                  harga_barang = '$harga',
                                  jenis_barang = '$jenis',
                                 tgl_datang = '$tgl',
                                 foto_barang = '$gambar'
                                 WHERE id_barang = $id"; 
mysqli_query($conn,$query);
return mysqli_affected_rows($conn);
}; 
// search function .....
function search($keyword) {
    // lakukan pencarian update variable barang
    $query = "SELECT * FROM stock_barang WHERE id_barang LIKE '%$keyword%'
              OR nama_barang LIKE '%$keyword%'
              OR harga_barang LIKE '%$keyword%'
              OR jenis_barang LIKE '%$keyword%'
              OR tgl_datang LIKE '%$keyword%'";
    return query($query);
}
// membuat function registrasi ........
function registrasi($data){
    global $conn;

    $username = stripslashes(strtolower($data["username"])) ;
    $email    = stripslashes(strtolower($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 =mysqli_real_escape_string($conn,$data["password2"]);
    
    // cek apakah username sudah dipakai....
    $result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo"
        <script>
        alert('username anda sudah digunakan ...');
        </script>
    ";
    return false;
    }
    // cek apakah password dan password verifikasi sama ..... 
   if ($password !== $password2 ) {
    echo"
    <script>
    alert('password verifikasi anda salah');
    </script>
";
return false;
   }

//    enkprisi password user......
$password = password_hash($password ,PASSWORD_DEFAULT);
// masukan data kedalam database 
mysqli_query($conn,"INSERT INTO user VALUES('','$username','$email','$password')");
 return mysqli_affected_rows($conn);
}

// Funtion login .....

?>
