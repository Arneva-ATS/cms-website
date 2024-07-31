<?php
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
if(empty($_SESSION['id_user'])){
echo"<center>Dilarang Akses Langsung !</center>";
}else{
//--------------------------------------------------------------------------START OF CONTENT----------------------------------------------------
if($_GET['menu']=='home'){
$tgl=date("D,d-M-Y | H:i:s");
echo"<h3 style='border-bottom:1px solid #000;'>Welcome</h3> Selamat Datang <b>$_SESSION[nama]</b> <br> Anda Login Sebagai : <b> ".ucwords($_SESSION['status_user'])." </b><br> Silahkan Olah Modul Disamping ! <br> Tanggal Akses Anda : $tgl";

}
if($_GET['menu']==''){
$tgl=date("D,d-M-Y | H:i:s");
echo"<h3 style='border-bottom:1px solid #000;'>Welcome</h3> Selamat Datang <b>$_SESSION[nama]</b> <br> Anda Login Sebagai : <b> ".ucwords($_SESSION['status_user'])." </b><br> Silahkan Olah Modul Disamping ! <br> Tanggal Akses Anda : $tgl";
}

if($_GET['menu']=='kontak'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from kontak where id_kontak='1'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN KONTAK </b> </legend></fieldset>
<form method=POST action='aksi.php?act=input_kontak'>
<input type=hidden name='id_kontak' value='$data[id_kontak]'>
<table>
<tr><td valign=top> Kontak : </td><td><textarea name='keterangan' cols=55 rows=20 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick='javascript:history.go(-1)'></td></tr>
</table>
</form>
";


}

if($_GET['menu']=='profil'){

$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from profil where id_profile='1'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN PROFIL </b> </legend></fieldset>
<form method=POST action='aksi.php?act=input_profil' enctype='multipart/form-data'>
<input type=hidden name='id_profile' value='$data[id_profile]'>
<table>
<tr><td valign=top> Struktur Organisasi : </td><td><img src='../profil/small_$data[foto]' width=400></td></tr>
<tr><td> Upload Foto Struktur Organisasi : </td><td><input type=file name='foto'></td></tr>
<tr><td valign=top> Keterangan : </td><td><textarea name='keterangan' cols=55 rows=20 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick='javascript:history.go(-1)'></td></tr>
</table>
</form>
";


}

if($_GET['menu']=='galeri'){
$batas=20;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}
$no=$posisi+1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN GALERI </b> </legend></fieldset>
<a href='?menu=tambah_galeri'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Galeri</td><td>Foto</td><td>Keterangan</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysqli_query($koneksi,"select * from galeri limit $posisi,$batas");
while($data=mysqli_fetch_array($sql)){
if(($no%2)==0){
$warna="#dedede";
}else{
$warna="#fff";
}
$isi=$data['keterangan'];
$isian=substr($isi,0,100);
$isian=substr($isi,0,strrpos($isian," "));
if(file_exists('../galeri/small_'.$data['foto'].'')){
  $gbr = '../galeri/small_'.$data['foto'].'';
}else{
  $gbr = '../galeri/default.jpg';
}
echo"<tr bgcolor=$warna><td>$no</td><td><img src='$gbr' width=150></td><td>$isian...</td><td><a href='?menu=edit_galeri&id=$data[id_galeri]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_galeri&id=$data[id_galeri]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[foto] ini ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";

$query=mysqli_num_rows(mysqli_query($koneksi,"select * from galeri"));
$jumlah=ceil($query/$batas);

for($i=1;$i<=$jumlah;$i++){
if($i != $halaman){
echo"<a href='?menu=galeri&halaman=$i'> $i | </a>";
}else{
echo"<b> $i | </b>";
}
}

echo"<br><br><font size=2><b>Catatan: Sertakan Foto Berupa JPG/JPEG</b></font>";

}

if($_GET['menu']=='edit_galeri'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from galeri where id_galeri='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_galeri' enctype='multipart/form-data'>
<input type=hidden name='id_galeri' value='$data[id_galeri]'>
<table width=100% border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Id Galeri</td><td><input type=text name='id_galeri' value='$data[id_galeri]' size=1 disabled></td></tr>";
echo"<tr><td>Kategori</td><td><select name='id_kategori'>";
$query=mysqli_query($koneksi,"select * from kategori_galeri");
while($rows=mysqli_fetch_array($query)){
if($rows['id_kategori']==$data['id_kategori'])
{
echo"<option value='$rows[id_kategori]' selected>$rows[judul]</option>";
}
else
{
echo"<option value='$rows[id_kategori]'>$rows[judul]</option>";
}
}
echo"</td></tr>
<tr><td valign=top>Foto</td><td><img src='../galeri/small_$data[foto]' width=150></td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'> )* Foto Harus Berintensitas Jpg</td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td valign=top></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=javascript:history.go(-1)></td></tr>
</table>
</form>
";
}

if($_GET['menu']=='tambah_galeri'){

echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_galeri' enctype='multipart/form-data'>
<table width=100% border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>";
echo"<tr><td>Kategori</td><td><select name='id_kategori'>";
$query=mysqli_query($koneksi,"select * from kategori_galeri");
while($rows=mysqli_fetch_array($query)){
echo"<option value='$rows[id_kategori]'>$rows[judul]</option>";
}
echo"</td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'> )* Foto Harus Berintensitas Jpg </td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 id='loko'></textarea></td></tr>
<tr><td valign=top></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=javascript:history.go(-1)></td></tr>
</table>
</form>
";

}

if($_GET['menu']=='kategori_galeri'){
$batas=20;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$no=$posisi+1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> KATEGORI GALERI </b> </legend></fieldset>
<a href='?menu=tambah_kategori_galeri'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Kategori</td><td>Judul</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysqli_query($koneksi,"select * from kategori_galeri limit $posisi,$batas");
while($data=mysqli_fetch_array($sql)){
if(($no%2)==0){
$warna="#dedede";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[judul]</td><td><a href='?menu=edit_kategori_galeri&id=$data[id_kategori]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_kategori_galeri&id=$data[id_kategori]\" onclick=\"return confirm('Yakin Mau Hapus $data[judul] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysqli_num_rows(mysqli_query($koneksi,"select * from kategori_galeri"));
$jumlah=ceil($query/$batas);

for($i=1;$i<=$jumlah;$i++){
if($i != $halaman){
echo"<a href='?menu=kategori_galeri&halaman=$i'> $i | </a>";
}else{
echo"<b> $i | </b>";
}
}
}

if($_GET['menu']=='edit_kategori_galeri'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from kategori_galeri where id_kategori='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT KATEGORI GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_kategori_galeri'>
<input type=hidden name='id_kategori' value='$data[id_kategori]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>ID kategori galeri</td><td><input type=text name='id_kategori' value='$data[id_kategori]' size=1 disabled></td></tr>
<tr><td>Judul galeri</td><td><input type=text name='judul' value='$data[judul]'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";
}

if($_GET['menu']=='tambah_kategori_galeri'){

echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH KATEGORI GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_kategori_galeri'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Judul galeri</td><td><input type=text name='judul'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";



}


if($_GET['menu']=='kategori_berita'){
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$no=$posisi+1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> KATEGORI BERITA </b> </legend></fieldset>
<a href='?menu=tambah_kategori_berita'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Kategori</td><td>Nama Kategori</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysqli_query($koneksi,"select * from kategori_berita limit $posisi,$batas");
while($data=mysqli_fetch_array($sql)){
if(($no%2)==0){
$warna="#dedede";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[nama_kategori]</td><td><a href='?menu=edit_kategori_berita&id=$data[id_kategori]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_kategori_berita&id=$data[id_kategori]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_kategori] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysqli_num_rows(mysqli_query($koneksi,"select * from kategori_berita"));
$jumlah=ceil($query/$batas);

for($i=1;$i<=$jumlah;$i++){
if($i != $halaman){
echo"<a href='?menu=kategori_berita&halaman=$i'> $i | </a>";
}else{
echo"<b> $i | </b>";
}
}
}

if($_GET['menu']=='tambah_kategori_berita'){

echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH KATEGORI BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_kategori_berita'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Nama Kategori</td><td><input type=text name='nama_kategori'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";



}

if($_GET['menu']=='edit_kategori_berita'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from kategori_berita where id_kategori='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT KATEGORI BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_kategori_berita'>
<input type=hidden name='id_kategori' value='$data[id_kategori]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>ID kategori</td><td><input type=text name='id_kategori' value='$data[id_kategori]' size=1 disabled></td></tr>
<tr><td>Nama Kategori</td><td><input type=text name='nama_kategori' value='$data[nama_kategori]'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";
}

if($_GET['menu']=='agenda'){

$batas=20;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$no=$posisi+1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN AGENDA </b> </legend></fieldset>
<a href='?menu=tambah_agenda'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Agenda</td><td>Nama Agenda</td><td>Tanggal Agenda</td><td>Foto</td><td>Keterangan</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysqli_query($koneksi,"select * from agenda order by id_agenda DESC limit $posisi,$batas");
while($data=mysqli_fetch_array($sql)){
if(($no%2)==0){
$warna="#dedede";
}else{
$warna="#fff";
}
if(file_exists('../agenda/small_'.$data['foto'].'')){
  $agd = '../agenda/small_'.$data['foto'].'';
}else{
  $agd = '../agenda/default.jpg';
}
$isi=$data['keterangan'];
$isian=substr($isi,0,250);
$isian=substr($isi,0,strrpos($isian," "));
echo"<tr bgcolor=$warna><td>$no</td><td>$data[nama_agenda]</td><td>$data[tanggal_agenda]</td><td><img src='$agd' width=100></td><td>$isian...</td><td><a href='?menu=edit_agenda&id=$data[id_agenda]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_agenda&id=$data[id_agenda]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_agenda] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysqli_num_rows(mysqli_query($koneksi,"select * from agenda"));
$jumlah=ceil($query/$batas);

for($i=1;$i<=$jumlah;$i++){
if($i != $halaman){
echo"<a href='?menu=agenda&halaman=$i'> $i | </a>";
}else{
echo"<b> $i | </b>";
}
}
}

if($_GET['menu']=='tambah_agenda'){
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH AGENDA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_agenda' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 width=100% style='border-collapse:collapse;'>
<tr><td>Nama Agenda</td><td><input type=text name='nama_agenda'></td></tr>
<tr><td>Tanggal Agenda</td><td>

<select name='tanggal_agenda'>";
$tgl=date("d");
for($i=1;$i<=31;$i++){
if($i == $tgl){
echo"<option value='$i' selected>$i</option>";
}else{
echo"<option value='$i'>$i</option>";
}
}
echo"</select>

<select name='bulan_agenda'>";
$nm_bln=array(1=> "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

$bln=date("m");
for($i=1;$i<=12;$i++){
if($i == $bln){
echo"<option value='$i' selected>$nm_bln[$i]</option>";
}else{
echo"<option value='$i'>$nm_bln[$i]</option>";
}
}

echo"</select>

<select name='tahun_agenda'>";

$thn=date("Y");
for($i=2012;$i<=2025;$i++){
if($i == $thn){
echo"<option value='$i' selected>$i</option>";
}else{
echo"<option value='$i'>$i</option>";
}
}

echo"</select>

</td></tr>

<tr><td>Tanggal Selesai</td><td>

<select name='tanggal_selesai'>";
$tgl=date("d");
for($i=1;$i<=31;$i++){
if($i == $tgl){
echo"<option value='$i' selected>$i</option>";
}else{
echo"<option value='$i'>$i</option>";
}
}
echo"</select>

<select name='bulan_selesai'>";
$nm_bln=array(1=> "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

$bln=date("m");
for($i=1;$i<=12;$i++){
if($i == $bln){
echo"<option value='$i' selected>$nm_bln[$i]</option>";
}else{
echo"<option value='$i'>$nm_bln[$i]</option>";
}
}

echo"</select>

<select name='tahun_selesai'>";

$thn=date("Y");
for($i=2012;$i<=2025;$i++){
if($i == $thn){
echo"<option value='$i' selected>$i</option>";
}else{
echo"<option value='$i'>$i</option>";
}
}

echo"</select>

</td></tr>
<tr><td valign=top>Jam Agenda</td><td><input type=time name='jam'></td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=50 id='loko'></textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back()></td></tr>
</table>
</form>
";
}

if($_GET['menu']=='edit_agenda'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from agenda where id_agenda='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT AGENDA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_agenda' enctype='multipart/form-data'>
<input type=hidden name='id_agenda' value='$data[id_agenda]'>
<table border=1 cellpadding=5 cellspacing=0 width=100% style='border-collapse:collapse;'>
<tr><td>Id Agenda</td><td><input type=text name='id_agenda' value='$data[id_agenda]' size=1 disabled></td></tr>
<tr><td>Nama Agenda</td><td><input type=text name='nama_agenda' value='$data[nama_agenda]'></td></tr>
<tr><td>Tanggal Agenda</td><td>

<select name='tanggal_agenda'>";
$tgl=substr($data['tanggal_agenda'],8,2);
for($i=1;$i<=31;$i++){
if($i == $tgl){
echo"<option value='$i' selected>$i</option>";
}else{
echo"<option value='$i'>$i</option>";
}
}
echo"</select>

<select name='bulan_agenda'>";
$nm_bln=array(1=> "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

$bln=substr($data['tanggal_agenda'],5,2);
for($i=1;$i<=12;$i++){
if($i == $bln){
echo"<option value='$i' selected>$nm_bln[$i]</option>";
}else{
echo"<option value='$i'>$nm_bln[$i]</option>";
}
}

echo"</select>

<select name='tahun_agenda'>";

$thn=substr($data['tanggal_agenda'],0,4);
for($i=2012;$i<=2025;$i++){
if($i == $thn){
echo"<option value='$i' selected>$i</option>";
}else{
echo"<option value='$i'>$i</option>";
}
}

echo"</select>";


echo "<tr><td>Tanggal Selesai</td><td>

<select name='tanggal_selesai'>";
$tgl_sls=substr($data['tanggal_selesai'],8,2);
  for($i=1;$i<=31;$i++){
  if($i == $tgl_sls){
  echo"<option value='$i' selected>$i</option>";
  }else{
  echo"<option value='$i'>$i</option>";
  }
}
echo"</select>

<select name='bulan_selesai'>";
$nm_bln_sls=array(1=> "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

$bln_sls=substr($data['tanggal_selesai'],5,2);
for($i=1;$i<=12;$i++){
if($i == $bln_sls){
echo"<option value='$i' selected>$nm_bln_sls[$i]</option>";
}else{
echo"<option value='$i'>$nm_bln_sls[$i]</option>";
}
}


echo"</select>

<select name='tahun_selesai'>";

$thn_sls=substr($data['tanggal_selesai'],0,4);
for($i=2012;$i<=2025;$i++){
  if($i == $thn_sls){
  echo"<option value='$i' selected>$i</option>";
  }else{
  echo"<option value='$i'>$i</option>";
  }
}
echo"</select>

</td></tr>
<tr><td valign=top>Jam Agenda</td><td><input type=time name='jam' value='$data[jam]'></td></tr>";

echo"</td></tr>
<tr><td valign=top>Foto</td><td><img src='../agenda/small_$data[foto]' width=100></td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=50 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back()></td></tr>
</table>
</form>
";


}

if($_GET['menu']=='user'){

$batas=20;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$no=$posisi+1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN USER </b> </legend></fieldset>
<a href='?menu=tambah_user'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>No</td><td>Username</td><td>Email</td><td>Status User</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysqli_query($koneksi,"select * from user limit $posisi,$batas");
while($data=mysqli_fetch_array($sql)){
if(($no%2)==0){
$warna="#dedede";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[username]</td><td>$data[email]</td><td>$data[status_user]</td><td><a href='?menu=edit_user&id=$data[id_user]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_user&id=$data[id_user]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysqli_num_rows(mysqli_query($koneksi,"select * from user"));
$jumlah=ceil($query/$batas);

for($i=1;$i<=$jumlah;$i++){
if($i != $halaman){
echo"<a href='?menu=user&halaman=$i'> $i | </a>";
}else{
echo"<b> $i | </b>";
}
}


}

if($_GET['menu']=='edit_user'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from user where id_user='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT USER </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_user' enctype='multipart/form-data'>
<input type=hidden name='id_user' value='$data[id_user]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Id User</td><td><input type=text name='id_user' value='$data[id_user]' size=1 disabled></td></tr>
<tr><td>Username</td><td><input type=text name='username' value='$data[username]'></td></tr>
<tr><td>Nama</td><td><input type=text name='nama' value='$data[nama]'></td></tr>
<tr><td>Password</td><td><input type=password name='password'></td></tr>
<tr><td>Email</td><td><input type=text name='email' value='$data[email]'></td></tr>
<tr><td>Alamat</td><td><textarea name='alamat' cols=50 id='loko'> $data[alamat]</textarea></td></tr>
<tr><td>Tanggal_lahir</td><td>

<select name='tanggal_lahir'>";
$tgl=substr($data['tanggal_lahir'],8,2);
for($i=1;$i<=31;$i++){
if($i == $tgl){
echo"<option value='$i' selected>$i</option>'";
}else{
echo"<option value='$i'>$i</option>'";
}
}
echo"</select><select name='bulan_lahir'>";
$nm_bln=array(1=> "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln=substr($data['tanggal_lahir'],5,2);
for($i=1;$i<=12;$i++){
if($i == $bln){
echo"<option value='$i' selected>$nm_bln[$i]</option>'";
}else{
echo"<option value='$i'>$nm_bln[$i]</option>'";
}
}
echo"</select><select name='tahun_lahir'>";

$thn=substr($data['tanggal_lahir'],0,4);
for($i=1930;$i<=2025;$i++){
if($i == $thn){
echo"<option value='$i' selected>$i</option>'";
}else{
echo"<option value='$i'>$i</option>'";
}
}
echo"</select></td></tr>
<tr><td valign=top>Foto</td><td><img src='akun/small_$data[foto]' width=150></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'></td></tr>";
if($data['status_user']=='admin'){
echo"<tr><td>Status User</td><td><input type=radio name='status_user' value='admin' checked>admin<input type=radio name='status_user' value='user'>user</td></tr>";
}else{
echo"<tr><td>Status User</td><td><input type=radio name='status_user' value='admin'>admin<input type=radio name='status_user' value='user' checked>user</td></tr>";
}
echo"
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";
}

if($_GET['menu']=='tambah_user'){

echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH USER </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_user' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Username</td><td><input type=text name='username'></td></tr>
<tr><td>Nama</td><td><input type=text name='nama'></td></tr>
<tr><td>Password</td><td><input type=password name='password'></td></tr>
<tr><td>Email</td><td><input type=email name='email'></td></tr>
<tr><td>Alamat</td><td><textarea name='alamat' cols=50 id='loko'></textarea></td></tr>
<tr><td>Tanggal_lahir</td><td>

<select name='tanggal_lahir'>";
$tgl=date("d");
for($i=1;$i<=31;$i++){
if($i == $tgl){
echo"<option value='$i' selected>$i</option>'";
}else{
echo"<option value='$i'>$i</option>'";
}
}
echo"</select><select name='bulan_lahir'>";
$nm_bln=array(1=> "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln=date("m");
for($i=1;$i<=12;$i++){
if($i == $bln){
echo"<option value='$i' selected>$nm_bln[$i]</option>'";
}else{
echo"<option value='$i'>$nm_bln[$i]</option>'";
}
}
echo"</select><select name='tahun_lahir'>";

$thn=date("Y");
for($i=1930;$i<=2025;$i++){
if($i == $thn){
echo"<option value='$i' selected>$i</option>'";
}else{
echo"<option value='$i'>$i</option>'";
}
}
echo"</select></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'></td></tr>";
echo"<tr><td>Status User</td><td><input type=radio name='status_user' value='admin' checked>admin<input type=radio name='status_user' value='user'>user</td></tr>";
echo"
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";

}

if($_GET['menu']=='berita'){

$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman))
{
	$posisi=0;
	$halaman=1;
}
else
{
	$posisi = ($halaman-1) * $batas;
}
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN BERITA </b> </legend></fieldset>
<a href='?menu=tambah_berita'><input type=button value=Tambah></a><br><br>
<table border=1 cellpadding=4 cellspacing=0 width=100% style='border-collapse:collapse;'>
<tr bgcolor=#006699 style='color:#fff;'><td>No</td><td>Judul</td><td>Foto</td><td>Tanggal</td><td>User</td><td>Edit</td><td>Hapus</td></tr>
";
if($_SESSION['status_user']=='admin'){

$tampil="select * from berita order by id_berita DESC limit $posisi,$batas";

}else{
$tampil="select * from berita where id_user='$_SESSION[id_user]' order by id_berita DESC limit $posisi,$batas";
}

$hasil=mysqli_query($koneksi,$tampil);

$no=$posisi+1;
while ($data=mysqli_fetch_array($hasil)){
$isi=htmlentities($data['keterangan']);
$isian=substr($isi,0,80);
$isian=substr($isi,0,strrpos($isian," "));

if(($no%2)==0){
$warna="#dedede";
}else{
$warna="#fff";
}

if(file_exists('../berita/small_'.$data['foto'].'')){
  $brt = '../berita/small_'.$data['foto'].'';
}else{
  $brt = '../berita/default.jpg';
}

echo "<tr bgcolor=$warna><td>$no</td><td>$data[judul]</td><td><img src='".$brt."' width=50></td><td>$data[tgl]</td><td>$data[username]</td><td><a href='?menu=edit_berita&id=$data[id_berita]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_berita&id=$data[id_berita]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[judul] ?');\"><input type=button value=Hapus></a></td></tr>";
  $no++;
}
echo "</table><br>";

echo"Halaman : ";

if($_SESSION['status_user']=='admin'){
$tampil2="select * from berita";
}else{
$tampil2="select * from berita where id_user='$_SESSION[id_user]'";
}

$hasil2=mysqli_query($tampil2);
$jmldata=mysqli_num_rows($hasil2);

$jmlhalaman=ceil($jmldata/$batas);

if($halaman > 1)
{
	$previous=$halaman-1;
	echo "<A HREF=?menu=berita&halaman=1> awal </A>
        <A HREF=?menu=berita&halaman=$previous> sebelumnya </A>  ";
}
else
{
	echo " Awal | Sebelumnya | ";
}

$angka=($halaman > 3 ? " ... " : " ");
for($i=$halaman-2;$i<$halaman;$i++)
{
  if ($i < 1)
      continue;
  $angka .= "<a href=?menu=berita&halaman=$i> &nbsp; $i  &nbsp; </A> ";
}

$angka .= " <b style='background-color:#e4d135'>&nbsp; $halaman &nbsp;  </b> ";
for($i=$halaman+1;$i<($halaman+3);$i++)
{
  if ($i > $jmlhalaman)
      break;
  $angka .= "<a href=?menu=berita&halaman=$i> &nbsp; $i  &nbsp; </A> ";
}

$angka .= ($halaman+2<$jmlhalaman ? " ...
          <a href=?menu=berita&halaman=$jmlhalaman> &nbsp; $jmlhalaman </A> " : " ");

echo " &nbsp; $angka &nbsp; ";

}

if($_GET['menu']=='tambah_berita'){
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_berita' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Kategori Informasi</td><td><select name='id_kategori'>";
$sql=mysqli_query($koneksi,"select * from kategori");
while($data=mysqli_fetch_array($sql)){
echo"<option value='$data[id_kategori]'>$data[nama_kategori]</option>";
}
echo"</select></td></tr>";
echo"
<tr><td>Judul</td><td><input type=text name='judul' size=40></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 rows=20 id='loko'></textarea></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'> )* sertakan dengan foto.</td></tr>
<tr><td></td><td><input type=submit value=Simpan> <input type=button value=Cancel onclick=self.history.back();></td></tr>
";



echo"</table>
<br>
<i> <b>!</b> untuk menambahkan kategori informasi silahkan pilih menu <b> kategori informasi </b> dan pilih <b>tambah</b></i>
";
}

if($_GET['menu']=='edit_berita'){
$data=mysqli_fetch_array(mysqli_query($koneksi,"select * from berita where id_berita='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_berita' enctype='multipart/form-data'>
<input type=hidden name='id_berita' value='$data[id_berita]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Kategori Berita</td><td><select name='id_kategori'>";
$query=mysqli_query($koneksi,"select * from kategori");
while($rows=mysqli_fetch_array($query)){
if($rows['id_kategori']==$data['id_kategori']){
echo"<option value='$rows[id_kategori]' selected>$rows[nama_kategori]</option>";
}else{
echo"<option value='$rows[id_kategori]'>$rows[nama_kategori]</option>";
}
}
echo"</select></td></tr>";
echo"
<tr><td>Judul</td><td><input type=text name='judul' value='$data[judul]' size=40></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 rows=20 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td valign=top>Foto</td><td><img src='../berita/small_$data[foto]'></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'> )* jika foto tidak di ganti, kosongkan saja.</td></tr>
<tr><td></td><td><input type=submit value=Simpan> <input type=button value=Cancel onclick=self.history.back();></td></tr>
";



echo"</table>
";
}

//--------------------------------------------------------------------------END OF CONTENT------------------------------------------------------
}
?>
