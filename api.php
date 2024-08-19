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
		$id_dekopin = isset($_GET['id_dekopin']) ? $_GET['id_dekopin'] : '';
        $sql = mysqli_query($koneksi,"select * from berita where id_dekopin='$id_dekopin' limit $posisi,$batas");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_berita"=> $data['id_berita'],
                "id_kategori"=> convert_id_kategori_berita($data['id_kategori']),
                "judul"=> $data['judul'],
                "judul_seo"=> $data['judul_seo'],
                "keterangan"=> $data['keterangan'],
                "foto"=> "berita/".$data['foto'],
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


    if($_GET['act'] == 'gallery'){

        $batas=10;
        $halaman=$_GET['halaman'];
		$id_dekopin = isset($_GET['id_dekopin']) ? $_GET['id_dekopin'] : '';
        if(empty($halaman)){
            $posisi=0;
            $halaman=1;
        }else{
            $posisi=($halaman-1)*$batas;
        }
        $sql = mysqli_query($koneksi,"select * from galeri where id_dekopin='$id_dekopin' limit $posisi,$batas");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_galeri"=> $data['id_galeri'],
                "id_kategori"=> convert_id_kategori_gallery($data['id_kategori']),
                "foto"=> "galeri/small_".$data['foto'],
                "keterangan"=> $data['keterangan']
            );
        }
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
		$id_dekopin = isset($_GET['id_dekopin']) ? $_GET['id_dekopin'] : '';
        $halaman=$_GET['halaman'];
        if(empty($halaman)){
            $posisi=0;
            $halaman=1;
        }else{
            $posisi=($halaman-1)*$batas;
        }
        $sql = mysqli_query($koneksi,"select * from agenda where id_dekopin='$id_dekopin' limit $posisi,$batas");
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

	if($_GET['act'] == 'pengurus'){

        $batas=10;
		$id_dekopin = isset($_GET['id_dekopin']) ? $_GET['id_dekopin'] : '';
        $halaman=$_GET['halaman'];
        if(empty($halaman)){
            $posisi=0;
            $halaman=1;
        }else{
            $posisi=($halaman-1)*$batas;
        }
        $sql = mysqli_query($koneksi,"select * from pengurus where id_dekopin='$id_dekopin' limit $posisi,$batas");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_pengurus"=> $data['id'],
                "nama"=> $data['nama'],
                "jabatan"=> $data['jabatan'],
                "no"=> $data['no'],
            );
        }
        echo json_encode($row);
    }
	if($_GET['act'] == 'notaris'){

        $batas=10;
		$id_dekopin = isset($_GET['id_dekopin']) ? $_GET['id_dekopin'] : '';
        $halaman=$_GET['halaman'];
        if(empty($halaman)){
            $posisi=0;
            $halaman=1;
        }else{
            $posisi=($halaman-1)*$batas;
        }
        $sql = mysqli_query($koneksi,"select * from notaris where id_dekopin='$id_dekopin' limit $posisi,$batas");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_notaris"=> $data['id'],
                "nama"=> $data['nama'],
                "alamat"=> $data['alamat'],
                "no"=> $data['no'],
            );
        }
        echo json_encode($row);
    }
	if($_GET['act'] == 'profil'){
		$id_dekopin = isset($_GET['id_dekopin']) ? $_GET['id_dekopin'] : '';
        $sql = mysqli_query($koneksi,"select * from profil where id_dekopin='$id_dekopin'");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_profile" => $data['id_profile'],
                "foto"=> '/profil/'. $data['foto'],
				"nama_dekopin"=> $data['nama_dekopin'],
                "identitas_kami"=> $data['identitas_kami'],
				"visi"=> $data['visi'],
                "misi"=> $data['misi'],
                "deskripsi_utama"=> $data['deskripsi_utama'],
                "deskripsi_sec_1"=> $data['deskripsi_sec_1'],
                "deskripsi_sec_2"=> $data['deskripsi_sec_2'],
            );
        }
        echo json_encode($row);
    }
	if($_GET['act'] == 'kontak'){
		$id_dekopin = isset($_GET['id_dekopin']) ? $_GET['id_dekopin'] : '';
        $sql = mysqli_query($koneksi,"select * from kontak where id_dekopin='$id_dekopin'");
        $row = array();
        while($data = mysqli_fetch_assoc($sql)){
            $row[] = array(
                "id_kontak" => $data['id_kontak'],
				"lokasi"=> $data['lokasi'],
				"nomor_telepon"=> $data['nomor_telepon'],
				"email"=> $data['email'],
            );
        }
        echo json_encode($row);
    }
?>
