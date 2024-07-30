<?php

session_start();
include"../config/koneksi.php";
include"../config/fungsi_seo.php";
include"../config/fungsi_thumb.php";

if($_GET['act']=='input_profil'){
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$tipe_file= $_FILES['foto']['type'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;
if(empty($lokasi_file)){
mysqli_query($koneksi,"update profil set keterangan='$_POST[keterangan]' where id_profile='$_POST[id_profile]'");
}else{

if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('home.php?menu=profil')</script>";
}else{
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from profil where id_profile='$_POST[id_profile]'"));
unlink("../profil/$data[foto]");
unlink("../profil/small_$data[foto]");
UploadImage($nama_lain);
mysqli_query($koneksi,"update profil set foto='$nama_lain',keterangan='$_POST[keterangan]' where id_profile='$_POST[id_profile]'");
}

}
header('location:home.php?menu=profil');
}

if($_GET['act']=='input_kontak'){
mysqli_query($koneksi,"update kontak set keterangan='$_POST[keterangan]' where id_kontak='$_POST[id_kontak]'");
header('location:home.php?menu=kontak');


}

if($_GET['act']=='edit_galeri'){
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$tipe_file=$_FILES['foto']['type'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;
if(empty($lokasi_file)){
mysqli_query($koneksi,"update galeri set id_kategori='$_POST[id_kategori]',keterangan='$_POST[keterangan]' where id_galeri='$_POST[id_galeri]'");
}else{
UploadGaleri($nama_lain);
mysqli_query($koneksi,"update galeri set id_kategori='$_POST[id_kategori]',foto='$nama_lain',keterangan='$_POST[keterangan]' where id_galeri='$_POST[id_galeri]'");
}
header('location:home.php?menu=galeri');
}

if($_GET['act']=='tambah_galeri'){
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$tipe_file==$_FILES['foto']['type'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;
if(empty($lokasi_file)){
mysqli_query($koneksi,"insert into galeri(id_kategori,keterangan)values('$_POST[id_kategori]','$_POST[keterangan]')");
}else{
UploadGaleri($nama_lain);
mysqli_query($koneksi,"insert into galeri(id_kategori,foto,keterangan)values('$_POST[id_kategori]','$nama_lain','$_POST[keterangan]')");
}
header('location:home.php?menu=galeri');
}

if($_GET['act']=='hapus_galeri'){
mysqli_query($koneksi,"delete from galeri where id_galeri='$_GET[id]'");
unlink("../galeri/$_GET[foto]");
unlink("../galeri/small_$_GET[foto]");
header('location:home.php?menu=galeri');
}

if($_GET['act']=='tambah_menu'){
mysqli_query($koneksi,"insert into menu(nama_menu,link,aktif,publish,status_menu)values('$_POST[nama_menu]','$_POST[link]','$_POST[aktif]','$_POST[publish]','$_POST[status_menu]')");
header('location:home.php?menu=menu');
}

if($_GET['act']=='edit_menu'){
mysqli_query($koneksi,"update menu set nama_menu='$_POST[nama_menu]',link='$_POST[link]',aktif='$_POST[aktif]',publish='$_POST[publish]',status_menu='$_POST[status_menu]' where id_menu='$_POST[id_menu]'");
header('location:home.php?menu=menu');
}

if($_GET['act']=='hapus_menu'){
mysqli_query($koneksi,"delete from menu where id_menu='$_GET[id]'");
header('location:home.php?menu=menu');
}

if($_GET['act']=='edit_kategori_galeri'){
mysqli_query($koneksi,"update kategori_galeri set judul='$_POST[judul]' where id_kategori='$_POST[id_kategori]'");
header('location:home.php?menu=kategori_galeri');
}


if($_GET['act']=='tambah_kategori_galeri'){
mysqli_query($koneksi,"insert into kategori_galeri(judul)values('$_POST[judul]')");
header('location:home.php?menu=kategori_galeri');
}

if($_GET['act']=='hapus_kategori_galeri'){
mysqli_query($koneksi,"delete from kategori_galeri where id_kategori='$_GET[id]'");
header('location:home.php?menu=kategori_galeri');
}

if($_GET['act']=='tambah_kategori_berita'){
mysqli_query($koneksi,"insert into kategori(nama_kategori)values('$_POST[nama_kategori]')");
header('location:home.php?menu=kategori_berita');
}

if($_GET['act']=='edit_kategori_berita'){
mysqli_query($koneksi,"update kategori set nama_kategori='$_POST[nama_kategori]' where id_kategori='$_POST[id_kategori]'");
header('location:home.php?menu=kategori_berita');
}

if($_GET['act']=='hapus_kategori_berita'){
mysqli_query($koneksi,"delete from kategori where id_kategori='$_GET[id]'");
header('location:home.php?menu=kategori_berita');
}

if($_GET['act']=='tambah_agenda'){
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$tipe_file==$_FILES['foto']['type'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;
if(empty($lokasi_file)){
mysqli_query($koneksi,"insert into agenda(nama_agenda,tanggal_agenda,keterangan)values('$_POST[nama_agenda]','$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]','$_POST[keterangan]')");
}else{
UploadAgenda($nama_lain);
mysqli_query($koneksi,"insert into agenda(nama_agenda,tanggal_agenda,foto,keterangan)values('$_POST[nama_agenda]','$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]','$nama_lain','$_POST[keterangan]')");
}
header('location:home.php?menu=agenda');
}

if($_GET['act']=='hapus_agenda'){
mysqli_query($koneksi,"delete from agenda where id_agenda='$_GET[id]'");
unlink("../agenda/$_GET[foto]");
unlink("../agenda/small_$_GET[foto]");
header('location:home.php?menu=agenda');
}


if($_GET['act']=='edit_agenda'){
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$tipe_file==$_FILES['foto']['type'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;
if(empty($lokasi_file)){
mysqli_query($koneksi,"update agenda set nama_agenda='$_POST[nama_agenda]',tanggal_agenda='$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]',keterangan='$_POST[keterangan]' where id_agenda='$_POST[id_agenda]'");
}else{
UploadAgenda($nama_lain);
mysqli_query($koneksi,"update agenda set nama_agenda='$_POST[nama_agenda]',tanggal_agenda='$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]',foto='$nama_lain',keterangan='$_POST[keterangan]' where id_agenda='$_POST[id_agenda]'");
}
header('location:home.php?menu=agenda');
}

if($_GET['act']=='edit_user'){
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;
if(empty($lokasi_file) and empty($_POST['password'])){
mysqli_query($koneksi,"update user set username='$_POST[username]',nama='$_POST[nama]',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
}elseif(empty($_POST['password'])){
UploadFoto($nama_lain);
mysqli_query($koneksi,"update user set username='$_POST[username]',nama='$_POST[nama]',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',foto='$nama_lain',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
}elseif(empty($lokasi_file)){
$password=md5($_POST['password']);
mysqli_query($koneksi,"update user set username='$_POST[username]',nama='$_POST[nama]',password='$password',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
}else{
$password=md5($_POST['password']);
UploadFoto($nama_lain);
mysqli_query($koneksi,"update user set username='$_POST[username]',nama='$_POST[nama]',password='$password',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',foto='$nama_lain',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
}
header('location:home.php?menu=user');
}

if($_GET['act']=='tambah_user'){
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;
if(empty($lokasi_file)){
$password=md5($_POST['password']);
mysqli_query($koneksi,"insert into user(username,nama,password,email,alamat,tanggal_lahir,status_user)values('$_POST[username]','$_POST[nama]','$password','$_POST[email]','$_POST[alamat]','$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]','$_POST[status_user]')");
}else{
UploadFoto($nama_lain);
$password=md5($_POST['password']);
mysqli_query($koneksi,"insert into user(username,nama,password,email,alamat,tanggal_lahir,foto,status_user)values('$_POST[username]','$_POST[nama]','$password','$_POST[email]','$_POST[alamat]','$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]','$nama_lain','$_POST[status_user]')");
}
header('location:home.php?menu=user');
}

if($_GET['act']=='hapus_user'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from user where id_user='$_GET[id]'"));
if($data['foto']==''){
mysqli_query($koneksi,"delete from user where id_user='$_GET[id]'");
}else{
mysqli_query($koneksi,"delete from user where id_user='$_GET[id]'");
unlink("akun/$_GET[foto]");
unlink("akun/small_$_GET[foto]");
}
header('location:home.php?menu=user');

}if($_GET['act']=='tambah_berita'){
$tgl=date("Y-m-d");
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$tipe_file=$_FILES['foto']['type'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;

$judul_seo      = seo_title($_POST['judul']);

if(empty($lokasi_file)){
mysqli_query($koneksi,"insert into berita(id_kategori,judul,judul_seo,keterangan,foto,tgl,id_user,username,hits)values('".$_POST['id_kategori']."','$_POST[judul]','$judul_seo','$_POST[keterangan]','','$tgl','$_SESSION[id_user]','$_SESSION[username]','0')");
}else{
if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('home.php?menu=tambah_berita')</script>";
}else{
UploadBerita($nama_lain);
mysqli_query($koneksi,"insert into berita(id_kategori,judul,judul_seo,keterangan,foto,tgl,id_user,username,hits)values('".$_POST['id_kategori']."','$_POST[judul]','$judul_seo','$_POST[keterangan]','$nama_lain','$tgl','$_SESSION[id_user]','$_SESSION[username]','0')");
}
}
header('location:home.php?menu=berita');
}

if($_GET['act']=='edit_berita'){
$tgl=date("Y-m-d");
$lokasi_file=$_FILES['foto']['tmp_name'];
$nama_file=$_FILES['foto']['name'];
$tipe_file=$_FILES['foto']['type'];
$acak=rand(00000,99999);
$nama_lain=$acak.$nama_file;

$judul_seo      = seo_title($_POST['judul']);

if(empty($lokasi_file)){
mysqli_query($koneksi,"update berita set id_kategori='$_POST[id_kategori]',judul='$_POST[judul]',judul_seo='$judul_seo',keterangan='$_POST[keterangan]',tgl='$tgl',id_user='$_SESSION[id_user]',username='$_SESSION[username]' where id_berita='$_POST[id_berita]'");
}else{
if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('home.php?menu=edit_berita')</script>";
}else{
UploadBerita($nama_lain);
mysqli_query($koneksi,"update berita set id_kategori='$_POST[id_kategori]',judul='$_POST[judul]',judul_seo='$judul_seo',keterangan='$_POST[keterangan]',foto='$nama_lain',tgl='$tgl',id_user='$_SESSION[id_user]',username='$_SESSION[username]' where id_berita='$_POST[id_berita]'");
}
}
header('location:home.php?menu=berita');
}

if($_GET['act']=='hapus_berita'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from berita where id_berita='$_GET[id]'"));
if($data['foto']==''){
mysqli_query($koneksi,"delete from berita where id_berita='$_GET[id]'");
}else{
mysqli_query($koneksi,"delete from berita where id_berita='$_GET[id]'");
unlink("../berita/$_GET[foto]");
unlink("../berita/small_$_GET[foto]");
}
header('location:home.php?menu=berita');
}

if($_GET['act']=='aktifkan'){
mysqli_query($koneksi,"update module set status='Y' where id_module='$_GET[id]'");
header('location:home.php?menu=module');
}

if($_GET['act']=='blok'){
mysqli_query($koneksi,"update module set status='N' where id_module='$_GET[id]'");
header('location:home.php?menu=module');
}

if($_GET['act']=='edit_identitas'){
$lokasi_file=$_FILES['header']['tmp_name'];
$nama_file=$_FILES['header']['name'];
if(empty($lokasi_file)){
mysqli_query($koneksi,"update identitas_web set title='$_POST[title]',footer='$_POST[footer]' where id_identitas='$_POST[id_identitas]'");
}else{
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from identitas_web where id_identitas='$_POST[id_identitas]'"));
unlink("../header/$data[header]");
move_uploaded_file($lokasi_file,"../header/$nama_file");
mysqli_query($koneksi,"update identitas_web set title='$_POST[title]',header='$nama_file',footer='$_POST[footer]' where id_identitas='$_POST[id_identitas]'");
}
header('location:home.php?menu=identitas');
}

if($_GET['act']=='tambah_files'){
$lokasi_file=$_FILES['nama_files']['tmp_name'];
$nama_file=$_FILES['nama_files']['name'];
if(!empty($lokasi_file)){
move_uploaded_file($lokasi_file,"../files/$nama_file");
mysqli_query($koneksi,"insert into files(judul_files,link,nama_files,hits)values('$_POST[judul_files]','-','$nama_file','1')");
}else{
mysqli_query($koneksi,"insert into files(judul_files,link,nama_files,hits)values('$_POST[judul_files]','$_POST[link]','','1')");
}
header('location:home.php?menu=files');
}

if($_GET['act']=='hapus_files'){
$cek=mysqli_fetch_array(mysqli_query($koneksi,"select * from files where id_files='$_GET[id]'"));
if($cek['nama_files']==''){
mysqli_query($koneksi,"delete from files where id_files='$_GET[id]'");
}else{
mysqli_query($koneksi,"delete from files where id_files='$_GET[id]'");
unlink("../files/$_GET[nama_files]");
}
header('location:home.php?menu=files');
}
?>
