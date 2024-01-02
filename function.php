<?php
session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");

//menambah data barang
if(isset($_POST['addnewbarang'])){
    $tahun = $_POST['tahun'];
    $bulan = $_POST['bulan'];
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $jenisbarang = $_POST['jenisbarang'];
    $hargabarang = $_POST['hargabarang'];
    $jumlahbarang = $_POST['jumlahbarang'];
    $total_hargabarang = $_POST['total_hargabarang'];

    $total_hargabarang = $hargabarang * $jumlahbarang;

    $adddtotable = mysqli_query($conn,"insert into stock (tahun, bulan, idbarang, namabarang, deskripsi, jenisbarang, hargabarang, jumlahbarang, total_hargabarang) values('$tahun ','$bulan','$idbarang','$namabarang','$deskripsi','$jenisbarang', '$hargabarang', '$jumlahbarang', '$total_hargabarang')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

// BARANG MASUK
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $jumlahmasuk = $_POST['jumlahmasuk'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['jumlahbarang'];
    $tambahkanjumlahbarangsekarangdenganjumlahmasuk = $stocksekarang+$jumlahmasuk;

    $addtomasuk = mysqli_query($conn,"insert into masuk(idbarang, keterangan, jumlahmasuk) values('$barangnya', '$keterangan', '$jumlahmasuk')");
    $updatestockmasuk = mysqli_query($conn, "update stock set jumlahbarang = '$tambahkanjumlahbarangsekarangdenganjumlahmasuk' where idbarang = '$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

// BARANG KELUAR
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $jumlahkeluar = $_POST['jumlahkeluar'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['jumlahbarang'];
    $tambahkanjumlahbarangsekarangdenganjumlahmasuk = $stocksekarang-$jumlahkeluar;

    $addtokeluar = mysqli_query($conn,"insert into keluar(idbarang, keterangan, jumlahkeluar) values('$barangnya', '$keterangan', '$jumlahkeluar')");
    $updatestockmasuk = mysqli_query($conn, "update stock set jumlahbarang = '$tambahkanjumlahbarangsekarangdenganjumlahmasuk' where idbarang = '$barangnya'");
    if($addtokeluar&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}

//Update info barang EDIT
if(isset($_POST['updatebarang'])){
    $idbarang = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "update stock set namabarang = '$namabarang', deskripsi = '$deskripsi' where idbarang = '$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Menghapus barang dari stock   
if(isset($_POST['hapusbarang'])){
$idb = $_POST['idb'];

$hapus = mysqli_query($conn, "delete from stock where idbarang = '$idb'");
if($hapus){
header('location:index.php');
} else {
echo 'Gagal';
header('location:index.php');
}
}

?>