<?php
session_start();
include "../config/koneksi.php";

$username = htmlentities($_POST['username']);
$password = htmlentities(md5($_POST['password']));

if (!ctype_alnum($username) or !ctype_alnum($password)) {
	echo "
<body style='background:url(img/background-login.png); background-size:cover;'>
<center><img src='img/logo.png' width='180'></center><br>
<table style='background-color:#ff0000; color: #fff;' align=center width=400 cellpadding=10 cellspacing=0>
<tr><td align=center>PASTIKAN USERNAME DAN PASSWORD ANDA SESUAI !</td></tr>
<tr><td align=center><a href='index.php' style='text-decoration:none; color:#fff;'><b>SILAHKAN KLIK <u>ULANGI</u> UNTUK KEMBALI KE MENU UTAMA !</b></a></td></tr>
</table>
</body>
";
} else {

	$sql = mysqli_query($koneksi, "select * from user where username='" . $username . "' and password='" . $password . "'");
	$data = mysqli_fetch_array($sql);
	$cek = mysqli_num_rows($sql);
	if ($cek > 0) {
		$_SESSION['KCFINDER'] = array();
		$_SESSION['KCFINDER']['disabled'] = false;
		$_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/gambar";
		$_SESSION['KCFINDER']['uploadDir'] = "";
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['id_dekopin'] = $data['id_dekopin'];
		$_SESSION['status_user'] = $data['status_user'];

		header('location:home.php');
	} else {

		echo "
<body style='background:url(img/background-login.png); background-size:cover;'>
<center><img src='img/logo.png' width='180'></center><br>
<table style='background-color:#ff0000; color: #fff;' align=center width=400 cellpadding=10 cellspacing=0>
<tr><td align=center>PASTIKAN USERNAME DAN PASSWORD ANDA SESUAI !</td></tr>
<tr><td align=center><a href='index.php' style='text-decoration:none; color:#fff;'><b>SILAHKAN KLIK <u>ULANGI</u> UNTUK KEMBALI KE MENU UTAMA !</b></a></td></tr>
</table>
</body>
";
	}
}
