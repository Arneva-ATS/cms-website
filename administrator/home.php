<?php
session_start();
include"../config/koneksi.php";
if(empty($_SESSION['id_user'])){
echo"
<body style='background:url(img/background-login.png); background-size:cover;'>
<center><img src='img/logo.png' width='180'></center><br>
<table style='background-color:#ff0000; color: #fff;' align=center width=400 cellpadding=10 cellspacing=0>
<tr><td align=center>PASTIKAN USERNAME DAN PASSWORD ANDA SESUAI !</td></tr>
<tr><td align=center><a href='index.php' style='text-decoration:none; color:#fff;'><b>SILAHKAN KLIK <u>ULANGI</u> UNTUK KEMBALI KE MENU UTAMA !</b></a></td></tr>
</table>
</body>
";

}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS - RKI</title>
<link href="style_admin.css" rel="stylesheet" type="text/css">

<script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>

  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>


<style>
a{text-decoration:none;}
a:hover{background-color:#CC9900; color:#000000;}
a:visited{color:#000000;}
body{background:url('img/background-login.png'); background-size: cover; }
</style>
</head>
<body style="font-family: calibri; font-size: 16px;">

<table width="1024" border="0" align="center" style="border-collapse:collapse; background-color:#FFFFFF; outline:1pt solid #fff;">
  <tr>
    <td colspan="2" valign="top"><h1>DASHBOARD</h1></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Selamat Datang : <?php echo "<b>".ucwords($_SESSION['nama'])."</b> | <a href=\"logout.php\" onclick=\"return confirm('Yakin Mau Keluar Aplikasi?');\">Keluar</a>"; ?></td>
  </tr>
  <tr>
    <td width="175" height="172" valign="top">
	<?php
	echo"<ul id='nav'>";
	include"menu_panel.php";
	echo"</ul>";
	?>    </td>
    <td width="750" valign="top"> <div style="margin-left:7px; margin-bottom:30px;"> <?php include"content.php";?> </div></td>
  </tr>
  <tr valign="top">
    <td colspan="2" align="center" bgcolor="white"><font color="black">Copyright &copy; by CMS - RKI All Right Reserved </font></td>
  </tr>
</table>

</body>
</html>
<?php } ?>
