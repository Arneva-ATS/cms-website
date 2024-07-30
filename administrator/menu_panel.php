<?php
if($_SESSION['status_user']=='admin'){
$sql=mysql_query("select * from menu where aktif='Y' and status_menu='admin'");
}else{
$sql=mysql_query("select * from menu where publish='Y' and status_menu='admin'");
}
while($data=mysql_fetch_array($sql)){
echo"<li><a href='$data[link]' title='$data[nama_menu]'> &#187 $data[nama_menu]</b></a></li>";
}
?>