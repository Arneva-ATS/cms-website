<?php
session_start();
include"config/koneksi.php";
include"config/fungsi_kalender.php";
date_default_timezone_set("Asia/Jakarta");
$identitas=mysql_fetch_array(mysql_query("select * from identitas_web where id_identitas='1'"));
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?php echo"$identitas[title]"; ?></title>

<meta name="robots" content="index, follow">
<meta name="description" content="<?php include"dina_metadeskripsi.php";?>">
<meta name="keywords" content="Baznas,Kota,Payakumbuh">
<meta http-equiv="Copyright" content="dibuat oleh Muhammad Rifqi">
<meta name="author" content="dibuat oleh Muhammad Rifqi">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">


<script type="text/javascript">
SyntaxHighlighter.all();
SyntaxHighlighter.config.clipboardSwf = 'js/clipboard.swf';
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fcd3edf355bb9fa"></script>

<style>
body{background-color:#00923f;}
</style>
<link href="style.css" rel="stylesheet" type="text/css"  media="screen"/>
<link href="profil/Logo-BAZNAS.png" rel="shortcut icon">

<link href="css/fancybox.css" rel="stylesheet" type="text/css" />
<link href="css/tipsy.css" rel="stylesheet" type="text/css" />

<script src="<?php echo "js/jquery-1.4.js" ?>" type="text/javascript"></script>
<script src="<?php echo "js/jquery.fancybox.js" ?>" type="text/javascript"></script>
<script src="<?php echo "js/jquery.mousewhell.js" ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("a#galeri").fancybox({
				'titlePosition'	: 'inside'
			});
		});
  </script>

<link href="https://plus.google.com/107826540385849092473" rel="author">
<link href="https://plus.google.com/107826540385849092473" rel="publisher">

<meta property="og:title" content="<?php include"dina_title.php";?>">
<meta property="og:description" content="<?php include"dina_metadeskripsi.php";?>">
<meta property="og:image" content="<?php include"dina_image.php";?>">

<meta itemprop="name" content="<?php include"dina_title.php";?>">
<meta itemprop="image" content="<?php include"dina_image.php";?>">
<meta itemprop="description" content="<?php include"dina_metadeskripsi.php";?>">

<script type="text/javascript">
function mulai(){
var tgl = new Date();	
var jam = tgl.getHours();	
var mnt = tgl.getMinutes();	
var dtk = tgl.getSeconds();
document.getElementById("jam").innerHTML=jam+":"+mnt+":"+dtk;
}
setInterval(mulai,1000);
//jangan pake petik dua
</script>

</head>

<body>

<!-- wrapper -->
<div id="#">
  <table width="850" border="0" bgcolor="#fff" align="center">
    <tr>
      <td height="219" colspan="2"><div align="center"><a href='index.php'><img src="header/<?php echo"$identitas[header]";?>" width="100%" height="400" /></a></div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#e4d135">
      
      <ul id="nav">
      <?php include"menu_user.php";?>
      </ul>
      
      </td>

     <tr>
     <td colspan=2>
     <script>
    (function() {
    var cx = '017552740668707674516:-mt_oebvkqw';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
   '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
    })();
    </script>
    <gcse:search></gcse:search>
     </td>
     </tr>

    </tr>
    <tr>
      <td width="70%" height="721" valign="top">
      <div style="margin-top:30px; margin-left:10px; margin-right:20px;">

      <?php 
      include"config/jam.php";
      ?>

      <?php 
      include"content_user.php";
      ?>


     </div></td>
      <td width="35%" valign="top">
      
      <?php include"kanan.php"; ?>
      
      </td>
    </tr>
    <tr>
      <td height="30" colspan="2" bgcolor="#009933" align="center"><font color="#fff"><b><?php echo"$identitas[footer] ";?></b></font></td>
    </tr>
  </table>
</div>
</body>
</html>