<?php
if (isset($_GET['id'])){
    $query = "SELECT foto FROM berita WHERE id_berita='$_GET[id]'";
    $hasil = mysql_query($query);
    $data  = mysql_fetch_array($hasil);

		echo "berita/$data[foto]";
}
else{
		echo "http://baznaspayakumbuh.com/header/header.jpg";
}
?>

