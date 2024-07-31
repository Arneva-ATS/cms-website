<?php

    error_reporting(0);
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=utf-8");
	include "config/koneksi.php";
    include "config/function_convert.php";

    if($_GET['act'] == 'berita'){

        $batas=10;
        $halaman=$_GET['halaman'];
        if(empty($halaman)){
            $posisi=0;
            $halaman=1;
        }else{
            $posisi=($halaman-1)*$batas;
        }
        $sql = mysqli_query($koneksi,"select * from berita limit $posisi,$batas");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_berita"=> $data['id_berita'],
                "id_kategori"=> convert_id_kategori_berita($data['id_kategori']),
                "judul"=> $data['judul'],
                "judul_seo"=> $data['judul_seo'],
                "keterangan"=> $data['keterangan'],
                "foto"=> "berita/small_".$data['foto'],
                "tgl_publish"=> $data['tgl'],
                "id_user"=> $data['id_user'],
                "username"=> $data['username'],
                "hits"=> $data['hits']
            );
        }
        echo json_encode($row);
    }

    if($_GET['act'] == 'detailberita'){
        $sql = mysqli_query($koneksi,"select * from berita where id_berita = '".$_GET['id']."'");
        $data = mysqli_fetch_assoc($sql);
        $row = array(
            "id_berita"=> $data['id_berita'],
            "id_kategori"=> convert_id_kategori_berita($data['id_kategori']),
            "judul"=> $data['judul'],
            "judul_seo"=> $data['judul_seo'],
            "keterangan"=> $data['keterangan'],
            "foto"=> "berita/small_".$data['foto'],
            "tgl_publish"=> $data['tgl'],
            "id_user"=> $data['id_user'],
            "username"=> $data['username'],
            "hits"=> $data['hits']
        );
        echo json_encode($row);
    }


    if($_GET['act'] == 'detailgallery'){
        $sql = mysqli_query($koneksi,"select * from galeri where id_galeri = '".$_GET['id']."'");
        $data = mysqli_fetch_assoc($sql);
        $row = array(
            "id_galeri"=> $data['id_galeri'],
            "id_kategori"=> convert_id_kategori_gallery($data['id_kategori']),
            "foto"=> "galeri/small_".$data['foto'],
            "keterangan"=> $data['keterangan']
        );
        echo json_encode($row);
    }


    if($_GET['act'] == 'agenda'){

        $batas=10;
        $halaman=$_GET['halaman'];
        if(empty($halaman)){
            $posisi=0;
            $halaman=1;
        }else{
            $posisi=($halaman-1)*$batas;
        }
        $sql = mysqli_query($koneksi,"select * from agenda limit $posisi,$batas");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_agenda"=> $data['id_agenda'],
                "nama_agenda"=> $data['nama_agenda'],
                "tanggal_agenda"=> $data['tanggal_agenda'],
                "tanggal_selesai"=> $data['tanggal_selesai'],
                "jam"=> $data['jam'],
                "foto"=> "agenda/small_".$data['foto'],
                "keterangan"=> $data['keterangan']
            );
        }
        echo json_encode($row);
    }


?>