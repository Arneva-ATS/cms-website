<?php
if (isset($_GET['id'])){
    $query = "SELECT judul FROM berita WHERE id_berita='$_GET[id]'";
    $hasil = mysql_query($query);
    $data  = mysql_fetch_array($hasil);
    
    if(isset($data)) {
      echo "$data[judul]";
    } 
    else{
        echo "Baznas Kota Payakumbuh ";
    }
}
else{
     echo "Baznas Kota Payakumbuh ";
}
?>
