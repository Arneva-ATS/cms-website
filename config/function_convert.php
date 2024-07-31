<?php

function convert_id_kategori_berita($id){
    include "koneksi.php";
    $sql = mysqli_query($koneksi,"select * from kategori_berita where id_kategori = '".$id."'");
    $data = mysqli_fetch_array($sql);
    return $data['nama_kategori'];
}

function convert_id_kategori_gallery($id){
    include "koneksi.php";
    $sql = mysqli_query($koneksi,"select * from kategori_galeri where id_kategori = '".$id."'");
    $data = mysqli_fetch_array($sql);
    return $data['judul'];
}