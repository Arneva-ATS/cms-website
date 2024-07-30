<?php
if($_SESSION['status_user']=='admin'){
$sql=mysqli_query($koneksi,"select * from menu where aktif='Y' and status_menu='admin'");
}else{
$sql=mysqli_query($koneksi,"select * from menu where publish='Y' and status_menu='admin'");
}
while($data=mysqli_fetch_array($sql)){
echo"<li><a href='$data[link]' title='$data[nama_menu]'> &#187 $data[nama_menu]</b></a></li>";
}
?>
