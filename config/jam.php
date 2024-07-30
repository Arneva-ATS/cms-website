<?php
date_default_timezone_set("Asia/Jakarta");
$tgl=date("d-m-Y");
$jam=date("H");
if($jam < 10 and $jam >= 00){
$cek="Pagi";
}

elseif($jam < 15 and $jam >= 10){
$cek="Siang";
}

elseif($jam < 18 and $jam >= 15){
$cek="Sore";
}

elseif($jam < 24 and $jam >= 18){
$cek="Malam";
}

echo" <p><img src='images/clock.jpg' width='20' align=left hspace=10> <font color=black> $tgl, <span id='jam'></span>, Selamat $cek Pengunjung. </font> </p>";
?>