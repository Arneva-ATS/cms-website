<?php
if($_SESSION['status_user']=='superadmin'){
	echo "<li><a href='?menu=user' title='User/Pengguna'> &#187 User/Pengguna</b></a></li>";
	echo "<li><a href='?menu=dekopin' title='List Dekopin'> &#187 List Dekopin</b></a></li>";
}else{
	echo "<li><a href='?menu=home' title='Home'> &#187 Home</b></a></li>";
	echo "<li><a href='?menu=profil' title='Profil'> &#187 Profil</b></a></li>";
	echo "<li><a href='?menu=pengurus' title='Pengurus'> &#187 Pengurus</b></a></li>";
	echo "<li><a href='?menu=galeri' title='Galeri'> &#187 Galeri</b></a></li>";
	echo "<li><a href='?menu=kontak' title='Kontak'> &#187 Kontak</b></a></li>";
	echo "<li><a href='?menu=kategori_berita' title='Kategori Berita'> &#187 Kategori Berita</b></a></li>";
	echo "<li><a href='?menu=kategori_galeri' title='Kategori Galeri'> &#187 Kategori Galeri</b></a></li>";
	echo "<li><a href='?menu=agenda' title='Agenda'> &#187 Agenda</b></a></li>";
	echo "<li><a href='?menu=notaris' title='Notaris'> &#187 Notaris</b></a></li>";
	echo "<li><a href='?menu=user' title='User/Pengguna'> &#187 User/Pengguna</b></a></li>";
	echo "<li><a href='?menu=berita' title='Berita'> &#187 Berita</b></a></li>";
}

?>
