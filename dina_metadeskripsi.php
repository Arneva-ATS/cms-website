<?php    
if (isset($_GET['id'])){
    $query = "SELECT keterangan FROM berita WHERE id_berita='$_GET[id]'";
    $hasil = mysql_query($query);
    $data  = mysql_fetch_array($hasil);

    // Tampilkan hanya sebagian isi berita
    $isi_berita = htmlentities(strip_tags($data['keterangan'])); // membuat paragraf pada isi berita dan mengabaikan tag html
    $isi = substr($isi_berita,0,180); // ambil sebanyak 180 karakter
    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
		echo "$isi";
}
else{
      echo "Di Buat Oleh Muhammad Rifki !";
}
?>
