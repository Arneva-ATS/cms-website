<?php
$sql=mysql_query("select * from menu where publish='N' and status_menu='user'");
while($data=mysql_fetch_array($sql)){
echo"<li><a href='$data[link]' title='$data[nama_menu]'><b>$data[nama_menu]</b></b></a></li>";
}
?>