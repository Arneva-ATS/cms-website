<?php
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
if(empty($_SESSION['id_user'])){
echo"<center>Dilarang Akses Langsung !</center>";
}else{
//--------------------------------------------------------------------------START OF CONTENT----------------------------------------------------
if($_GET['menu']=='home'){
$tgl=date("D,d-M-Y | H:i:s");
echo"<h3 style='border-bottom:1px solid #000;'>Welcome</h3> Selamat Datang <b>$_SESSION[nama]</b> <br> Anda Login Sebagai : <b> ".ucwords($_SESSION[status_user])." </b><br> Silahkan Olah Modul Disamping ! <br> Tanggal Akses Anda : $tgl";

}
if($_GET['menu']==''){
$tgl=date("D,d-M-Y | H:i:s");
echo"<h3 style='border-bottom:1px solid #000;'>Welcome</h3> Selamat Datang <b>$_SESSION[nama]</b> <br> Anda Login Sebagai : <b> ".ucwords($_SESSION[status_user])." </b><br> Silahkan Olah Modul Disamping ! <br> Tanggal Akses Anda : $tgl";
}

if($_GET['menu']=='menu'){
$no=1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN MENU </b> </legend></fieldset>
<a href='?menu=tambah_menu'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#00923f style='color:#fff;'><td>No</td><td>Nama Menu</td><td>Link</td><td>Aktif</td><td>Publish</td><td>Status Menu</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysql_query("select * from menu");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[nama_menu]</td><td>$data[link]</td><td>$data[aktif]</td><td>$data[publish]</td><td>$data[status_menu]</td><td><a href='?menu=edit_menu&id=$data[id_menu]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_menu&id=$data[id_menu]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_menu] ini ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table><br><br>
<font size=2><b>Catatan</b></font> <br>
<font size=2><b>&bull; untuk admin : aktif=Y, Publish=N dan Status Menu=Admin</b></font><br>
<font size=2><b>&bull; untuk user : Aktif=Y, publish=Y dan Status Menu=Admin</b></font><br>
<font size=2><b>&bull; untuk client  : Aktif=Y, publish=N dan Status Menu=User</b></font><br>
";
}

if($_GET['menu']=='tambah_menu'){
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH MENU </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_menu'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Nama Menu</td><td><input type=text name='nama_menu'></td></tr>
<tr><td>Link Menu</td><td><input type=text name='link'></td></tr>
<tr><td>Aktif Menu</td><td><input type=radio name='aktif' value='Y' checked>Y<input type=radio name='aktif' value='N'>N</td></tr>
<tr><td>Publish Menu</td><td><input type=radio name='publish' value='Y' checked>Y<input type=radio name='publish' value='N'>N</td></tr>
<tr><td>Status Menu</td><td><input type=radio name='status_menu' value='admin' checked>admin<input type=radio name='status_menu' value='user'>user</td></tr>
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cancel onclick=self.history.back();></td></tr>
</table>
</form>
";
}

if($_GET['menu']=='edit_menu'){
$data=mysql_fetch_array(mysql_query("select * from menu where id_menu='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT MENU </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_menu'>
<input type=hidden name='id_menu' value='$data[id_menu]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>ID Menu</td><td><input type=text name='id_menu' value='$data[id_menu]' size=1 disabled></td></tr>
<tr><td>Nama Menu</td><td><input type=text name='nama_menu' value='$data[nama_menu]'></td></tr>
<tr><td>Link Menu</td><td><input type=text name='link' value='$data[link]'></td></tr>";
if($data['aktif']=='Y'){
echo"<tr><td>Aktif Menu</td><td><input type=radio name='aktif' value='Y' checked>Y<input type=radio name='aktif' value='N'>N</td></tr>";
}else{
echo"<tr><td>Aktif Menu</td><td><input type=radio name='aktif' value='Y'>Y<input type=radio name='aktif' value='N' checked>N</td></tr>";
}
if($data['publish']=='Y'){
echo"<tr><td>Publish Menu</td><td><input type=radio name='publish' value='Y' checked>Y<input type=radio name='publish' value='N'>N</td></tr>";
}else{
echo"<tr><td>Publish Menu</td><td><input type=radio name='publish' value='Y'>Y<input type=radio name='publish' value='N' checked>N</td></tr>";
}
if($data['status_menu']=='admin'){
echo"<tr><td>Status Menu</td><td><input type=radio name='status_menu' value='admin' checked>admin<input type=radio name='status_menu' value='user'>user</td></tr>";
}else{
echo"<tr><td>Status Menu</td><td><input type=radio name='status_menu' value='admin'>admin<input type=radio name='status_menu' value='user' checked>user</td></tr>";
}
echo"<tr><td></td><td><input type=submit value=simpan> <input type=button value=cancel onclick=self.history.back();></td></tr>
</table>
</form>
";
}


if($_GET['menu']=='kontak'){
$data=mysql_fetch_array(mysql_query("select * from kontak where id_kontak='1'"));
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

$data=mysql_fetch_array(mysql_query("select * from profil where id_profile='1'"));
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
<tr bgcolor=#00923f style='color:#fff;'><td>ID Galeri</td><td>Foto</td><td>Keterangan</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysql_query("select * from galeri limit $posisi,$batas");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
$isi=$data['keterangan'];
$isian=substr($isi,0,100);
$isian=substr($isi,0,strrpos($isian," "));
echo"<tr bgcolor=$warna><td>$no</td><td><img src='../galeri/small_$data[foto]' width=150></td><td>$isian...</td><td><a href='?menu=edit_galeri&id=$data[id_galeri]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_galeri&id=$data[id_galeri]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[foto] ini ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";

$query=mysql_num_rows(mysql_query("select * from galeri"));
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
$data=mysql_fetch_array(mysql_query("select * from galeri where id_galeri='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_galeri' enctype='multipart/form-data'>
<input type=hidden name='id_galeri' value='$data[id_galeri]'>
<table width=100% border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Id Galeri</td><td><input type=text name='id_galeri' value='$data[id_galeri]' size=1 disabled></td></tr>";
echo"<tr><td>Kategori</td><td><select name='id_kategori'>";
$query=mysql_query("select * from kategori_galeri");
while($rows=mysql_fetch_array($query)){
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
$query=mysql_query("select * from kategori_galeri");
while($rows=mysql_fetch_array($query)){
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
<tr bgcolor=#00923f style='color:#fff;'><td>ID Kategori</td><td>Judul</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysql_query("select * from kategori_galeri limit $posisi,$batas");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[judul]</td><td><a href='?menu=edit_kategori_galeri&id=$data[id_kategori]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_kategori_galeri&id=$data[id_kategori]\" onclick=\"return confirm('Yakin Mau Hapus $data[judul] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysql_num_rows(mysql_query("select * from kategori_galeri"));
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
$data=mysql_fetch_array(mysql_query("select * from kategori_galeri where id_kategori='$_GET[id]'"));
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
<tr bgcolor=#00923f style='color:#fff;'><td>ID Kategori</td><td>Nama Kategori</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysql_query("select * from kategori limit $posisi,$batas");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[nama_kategori]</td><td><a href='?menu=edit_kategori_berita&id=$data[id_kategori]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_kategori_berita&id=$data[id_kategori]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_kategori] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysql_num_rows(mysql_query("select * from kategori"));
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
$data=mysql_fetch_array(mysql_query("select * from kategori where id_kategori='$_GET[id]'"));
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
<tr bgcolor=#00923f style='color:#fff;'><td>ID Agenda</td><td>Nama Agenda</td><td>Tanggal Agenda</td><td>Foto</td><td>Keterangan</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysql_query("select * from agenda order by id_agenda DESC limit $posisi,$batas");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
$isi=$data['keterangan'];
$isian=substr($isi,0,250);
$isian=substr($isi,0,strrpos($isian," "));
echo"<tr bgcolor=$warna><td>$no</td><td>$data[nama_agenda]</td><td>$data[tanggal_agenda]</td><td><img src='../agenda/small_$data[foto]' width=100></td><td>$isian...</td><td><a href='?menu=edit_agenda&id=$data[id_agenda]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_agenda&id=$data[id_agenda]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_agenda] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysql_num_rows(mysql_query("select * from agenda"));
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
<tr><td valign=top>Foto</td><td><input type=file name='foto'></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=50 id='loko'></textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back()></td></tr>
</table>
</form>
";
}

if($_GET['menu']=='edit_agenda'){
$data=mysql_fetch_array(mysql_query("select * from agenda where id_agenda='$_GET[id]'"));
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

echo"</select>

</td></tr>
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
<tr bgcolor=#00923f style='color:#fff;'><td>No</td><td>Username</td><td>Email</td><td>Status User</td><td>Edit</td><td>Hapus</td></tr>";
$sql=mysql_query("select * from user limit $posisi,$batas");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[username]</td><td>$data[email]</td><td>$data[status_user]</td><td><a href='?menu=edit_user&id=$data[id_user]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_user&id=$data[id_user]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama] ?');\"><input type=button value=Hapus></a></td></tr>";
$no++;
}
echo"</table>";

echo"<br> Halaman : ";
$query=mysql_num_rows(mysql_query("select * from user"));
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
$data=mysql_fetch_array(mysql_query("select * from user where id_user='$_GET[id]'"));
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
<tr bgcolor=#00923f style='color:#fff;'><td>No</td><td>Judul</td><td>Foto</td><td>Tanggal</td><td>User</td><td>Edit</td><td>Hapus</td></tr>
";
if($_SESSION['status_user']=='admin'){

$tampil="select * from berita order by id_berita DESC limit $posisi,$batas";

}else{
$tampil="select * from berita where id_user='$_SESSION[id_user]' order by id_berita DESC limit $posisi,$batas";
}

$hasil=mysql_query($tampil);

$no=$posisi+1;
while ($data=mysql_fetch_array($hasil)){
$isi=htmlentities($data['keterangan']);
$isian=substr($isi,0,80);
$isian=substr($isi,0,strrpos($isian," "));

if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
echo "<tr bgcolor=$warna><td>$no</td><td>$data[judul]</td><td><img src='../berita/small_$data[foto]' width=50></td><td>$data[tgl]</td><td>$data[username]</td><td><a href='?menu=edit_berita&id=$data[id_berita]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_berita&id=$data[id_berita]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[judul] ?');\"><input type=button value=Hapus></a></td></tr>";
  $no++;
}
echo "</table><br>";

echo"Halaman : ";

if($_SESSION['status_user']=='admin'){
$tampil2="select * from berita";
}else{
$tampil2="select * from berita where id_user='$_SESSION[id_user]'";
}

$hasil2=mysql_query($tampil2);
$jmldata=mysql_num_rows($hasil2);

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
$sql=mysql_query("select * from kategori");
while($data=mysql_fetch_array($sql)){
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
$data=mysql_fetch_array(mysql_query("select * from berita where id_berita='$_GET[id]'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_berita' enctype='multipart/form-data'>
<input type=hidden name='id_berita' value='$data[id_berita]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Kategori Berita</td><td><select name='id_kategori'>";
$query=mysql_query("select * from kategori");
while($rows=mysql_fetch_array($query)){
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

if($_GET['menu']=='module'){

$no=1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN MODULE </b> </legend></fieldset>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#00923f style='color:#fff;'><td>ID Module</td><td>Nama Module</td><td>Status</td><td>Aktifkan</td><td>Blok</td></tr>";
$sql=mysql_query("select * from module");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
echo"<tr bgcolor=$warna><td>$no</td><td>$data[module]</td><td>$data[status]</td><td><a href='aksi.php?act=aktifkan&id=$data[id_module]'><input type=button value='Aktifkan'></a></td><td><a href='aksi.php?act=blok&id=$data[id_module]'><input type=button value='Blok'></a></td></tr>";
$no++;
}
echo"</table><br><br>";
echo"<b><font size=2> Catatan : <br> &bull; untuk menggaktifkan/menonaktifkan modul sebelah kanan user bisa memilih aktifkan/blok</font></b>";


}

if($_GET['menu']=='identitas'){
$data=mysql_fetch_array(mysql_query("select * from identitas_web where id_identitas='1'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT IDENTITAS WEB </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_identitas' enctype='multipart/form-data'>
<input type=hidden name='id_identitas' value='$data[id_identitas]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>";
echo"
<tr><td>Id Identitas</td><td><input type=text name='id_identitas' value='$data[id_identitas]' size=1 disabled></td></tr>
<tr><td>Title</td><td><input type=text name='title' value='$data[title]' size=40></td></tr>
<tr><td valign=top>Header Web</td><td><img src='../header/$data[header]' width=200></td></tr>
<tr><td>Header</td><td><input type=file name='header'> )* Ukuran Header : 800px x 360px </td></tr>
<tr><td>Footer</td><td><input type=text name='footer' value='$data[footer]' size=50></td></tr>
<tr><td></td><td><input type=submit value=Simpan> <input type=button value=Cancel onclick=self.history.back();></td></tr>
";

echo"</table></form>";
}


if($_GET['menu']=='files'){
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN FILES </b> </legend></fieldset>
<a href='?menu=tambah_files'><input type=submit value='Tambah'></a><p></p>";
echo"<table border=1 cellpadding=4 cellspacing=0 width=100% style='border-collapse:collapse;'>
<tr bgcolor=#00923f style='color:#fff;'><td>Kode Files</td><td>Judul Files</td><td>External Link</td><td>Files</td><td>Hapus</td></tr>";
$no=1;
$batas=10;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}
$sql=mysql_query("select * from files limit $posisi,$batas");
while($data=mysql_fetch_array($sql)){
if(($no%2)==0){
$warna="#e4d135";
}else{
$warna="#fff";
}
echo"<tr bgcolor='$warna'><td>$no</td><td>$data[judul_files]</td><td>$data[link]</td><td><a href='../files/$data[nama_files]' target='_blank'>$data[nama_files]</a></td><td><a href=\"aksi.php?act=hapus_files&id=$data[id_files]&nama_files=$data[nama_files]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_files]?');\"><input type='button' value='Hapus'></a></td></tr>";
$no++;
}
echo"</table>";

$query=mysql_num_rows(mysql_query("select * from files"));
$jum=ceil($query/$batas);

echo"<br> halaman : ";

for($i=1;$i<=$jum;$i++)
if($i != $halaman){
echo"<a href='?menu=files&halaman=$i'> $i |</a>";
}else{
echo"<b> $i |</b>";
}
}

if($_GET['menu']=='tambah_files'){

echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH FILES </b> </legend></fieldset>";
echo"
<form method=POST action='aksi.php?act=tambah_files' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Judul Files</td><td><input type=text name='judul_files'></td></tr>
<tr><td>External Link</td><td><input type=text name='link'> )* jika diambil dari web lain !</td></tr>
<tr><td>Tambah Files</td><td><input type=file name='nama_files'></td></tr>
<tr><td></td><td><input type=submit value=Tambah> <input type=button value=Cencel onclick=self.history.back();></td></tr>
</table>
</form>
";

echo"<p><i>Jika Diambil dari website lain , masukan link dari website lain ke external link, dan tambah file dikosongkan. </i></p>";
echo"<p><i>Jika Diambil dari Komputer , Upload file dengan mengklik tambah files, external link di kosongkan. </i></p>";
}

//--------------------------------------------------------------------------END OF CONTENT------------------------------------------------------
}
?>