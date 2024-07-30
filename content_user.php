<?php
error_reporting(0);
if($_GET['menu']==''){

$sql=mysql_query("select * from berita order by id_berita DESC limit 5");
while($data=mysql_fetch_array($sql)){
$isi=$data['keterangan'];
$isian=substr($isi,0,300);
$isian=substr($isi,0,strrpos($isian," "));
if($data['foto']!=''){
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; <u> <a href='berita-$data[id_berita]-$data[judul_seo].html' class='tooltip'>$data[judul]   
    <span>
        <img class='callout' src='images/callout.gif' />
        <img src='berita/small_$data[foto]' style='float:right;' width=100> 
        $data[judul]
    </span> 
</a> </u></h3>
&nbsp; &nbsp; &nbsp; <i> di publish tanggal : $data[tgl]</i>
</td></tr>

<tr><td align=justify><div class='label bottom'><p>$data[judul]</p><img src='berita/small_$data[foto]' align=left hspace=15 border=1 width=200></div> $isian.... (<a href='berita-$data[id_berita]-$data[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($data[hits])</td></tr>
</table>
<hr>";
}else{
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; <a href='berita-$data[id_berita]-$data[judul_seo].html' class='tooltip'><u>$data[judul]   <span>
        <img class='callout' src='images/callout.gif' />
        $data[judul]
    </span> 
 </u></a></h3>
&nbsp; &nbsp; &nbsp; <i> di publish tanggal : $data[tgl]</i>
</td></tr>
<tr><td align=justify>$isian.... (<a href='berita-$data[id_berita]-$data[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($data[hits]) </td></tr>
</table>
<hr>";
}
}
echo"<br>";
$a=mysql_num_rows(mysql_query("select * from module where module='berita_sebelumnya' and status='Y'"));
if($a>0){
echo"<div style='width:100%;'><div style='width:45%; float:left; margin-left:10px; border-right:1px solid #00923f;'><div style='background-color:#00923f; color:#fff; height:30px;'><b><img src='profil/folder.png' width=25 style='float:left;' hspace=2> &nbsp; &nbsp; Informasi Sebelumnya.</b></div>";
echo"<ul>";
$sebelum=mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 5,6");		 
	while($s=mysql_fetch_array($sebelum)){
	   echo "<li>  <a href='berita-$s[id_berita]-$s[judul_seo].html'><u>$s[judul]</u></a></li><br>";
	}
echo"</ul>";
echo"</div><div style='width:45%;float:left; margin-left:10px;border-left:1px solid #00923f;'><div style='background-color:#00923f; color:#fff; height:30px;'><b><img src='profil/kategori.jpg' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; Kategori Informasi.</b></div>";
}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------|
$b=mysql_num_rows(mysql_query("select * from module where module='kategori_berita' and status='Y'"));
if($b>0){
echo"<ul>";
$sebelum=mysql_query("SELECT *,count(berita.id_kategori) as jml,kategori.id_kategori as ids FROM kategori left join berita on berita.id_kategori=kategori.id_kategori group by kategori.id_kategori order by kategori.id_kategori DESC limit 10");		 
	while($s=mysql_fetch_array($sebelum)){
	   echo "<li>  <a href='kategori-$s[ids]-$s[nama_kategori].html'><u>$s[nama_kategori]</u>($s[jml])</a></li><br>";
	}
echo"</ul>";

echo"</div></div>";
}


}if($_GET['menu']=='detail_kategori'){

$data=mysql_fetch_array(mysql_query("select * from kategori where id_kategori='$_GET[id]'"));
echo"<h3>Kategori : $data[nama_kategori]</h3>";


$query=mysql_query("select * from berita where id_kategori='$_GET[id]'");
$cek=mysql_num_rows($query);
if($cek>0){

while($rows=mysql_fetch_array($query)){
$isi=$rows['keterangan'];
$isian=substr($isi,0,300);
$isian=substr($isi,0,strrpos($isian," "));
if($rows['foto']!=''){
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; <u> <a href='berita-$rows[id_berita]-$rows[judul_seo].html'>$rows[judul]</a> </u></h3></td></tr>
<tr><td align=justify><img src='berita/small_$rows[foto]' align=left hspace=15 border=1 width=200> $isian.... (<a href='berita-$rows[id_berita]-$rows[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($rows[hits])</td></tr>
</table>
<hr>";
}else{
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; <a href='berita-$rows[id_berita]-$rows[judul_seo].html'><u>$rows[judul]</u></a></h3></td></tr>
<tr><td align=justify>$isian.... (<a href='berita-$rows[id_berita]-$rows[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($rows[hits]) </td></tr>
</table>
<hr>";
}
}

}else{
echo"Kategori = <b> $data[nama_kategori]</b> Masih Belum Ada !";
}


}if($_GET['menu']=='profile'){
$data=mysql_fetch_array(mysql_query("select * from profil where id_profile='1'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> PROFIL BAZNAS KOTA PAYAKUMBUH</b> </legend></fieldset>
<table width=100%><tr><td align=left><img src='profil/$data[foto]' border=1 style='padding:5px;' width=600></td></tr><tr><td align=left>$data[keterangan]</td></tr></table>";



}if($_GET['menu']=='kontak'){
$data=mysql_fetch_array(mysql_query("select * from kontak where id_kontak='1'"));
echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> KONTAK KAMI </b> </legend></fieldset>
<table width=100%><tr><td align=justify>$data[keterangan]</td></tr></table>";

}

if($_GET['menu']=='news'){
echo" <fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> INDEXS INFORMASI </b> </legend></fieldset>";
$sql=mysql_query("select * from berita order by id_berita DESC limit 10");
while($data=mysql_fetch_array($sql)){
$isi=$data['keterangan'];
$isian=substr($isi,0,300);
$isian=substr($isi,0,strrpos($isian," "));
if($data['foto']!=''){
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; <a href='berita-$data[id_berita]-$data[judul_seo].html'> <u>$data[judul]</u> </a> </h3>
&nbsp; &nbsp; &nbsp; <i> di publish tanggal : $data[tgl]</i>
</td></tr>
<tr><td align=justify><div class='label bottom'><p>$data[judul]</p> <img src='berita/small_$data[foto]' align=left hspace=15 border=1 width=200></div> $isian.... (<a href='berita-$data[id_berita]-$data[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($data[hits]) </td></tr>
</table>
<hr>";
}else{
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=2> &nbsp; &nbsp; <u><a href='berita-$data[id_berita]-$data[judul_seo].html'> $data[judul]<a/></u></h3>&nbsp; &nbsp; &nbsp; <i> di publish tanggal : $data[tgl]</i> </td></tr>
<tr><td align=justify>$isian.... (<a href='berita-$data[id_berita]-$data[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($data[hits]) </td></tr>
</table>
<hr>";
}
}

}if($_GET['menu']=='detail_agenda'){
$data=mysql_fetch_array(mysql_query("select * from agenda where id_agenda='$_GET[id]'"));
$isinya=nl2br($data[keterangan]);

echo"
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> AGENDA BAZNAS KOTA PAYAKUMBUH </b> </legend></fieldset>
<h3><img src='profil/agenda.png' width=25 style='float:left;' hspace=2> &nbsp; &nbsp; <u>$data[nama_agenda]</u></h3>
$isinya
<p><img src='agenda/small_$data[foto]' width=100% style='padding:5px; border:1px solid #000;'></p>
";
}

if($_GET['menu']=='detailberita'){

echo"<div class='section'>    
                   <div class='addthis_toolbox addthis_default_style'>
                  <a class='addthis_button_preferred_1'></a>
                  <a class='addthis_button_preferred_2'></a>
                  <a class='addthis_button_preferred_3'></a>
                  <a class='addthis_button_preferred_4'></a>
                  <a class='addthis_button_compact'></a>
                  <a class='addthis_counter addthis_bubble_style'></a>
</div>
<script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f8aab4674f1896a'></script><br>";

$data=mysql_fetch_array(mysql_query("select * from berita where id_berita='$_GET[id]'"));
if($data['foto'] != ''){
$dt="<img src='berita/small_$data[foto]' align=left hspace=15 border=1>$data[keterangan]";
}else{
$dt="$data[keterangan]";
}

echo"
<p><i>di poskan oleh : $data[username], tanggal: $data[tgl], dibaca : ($data[hits])x .</i></p>
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=2> &nbsp; &nbsp; <u> $data[judul] </u></h3></td></tr>
<tr><td align=justify>$dt</td></tr>
</table>
";
mysql_query("update berita set hits=hits+1 where id_berita='$_GET[id]'");

echo "<br> <div class='fb-like' data-href='http://baznaspayakumbuh.com/berita-$data[id_berita]-$data[judul_seo].html' 
        data-send='true' data-show-faces='true' data-width='600'></div>";

echo "<br/><br/>
<div class='fbkomluar'>
<div class='fbkomdalam'>
<div class='fb-comments' data-href='http://baznaspayakumbuh.com/berita-$data[id_berita]-$data[judul_seo].html' data-num-posts='2' data-width='600'></div></div></div>";


}

if($_GET['menu']=='cari'){
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> HASIL PENCARIAN </b> </legend></fieldset>";
$sql=mysql_query("select * from berita where judul LIKE '%$_POST[cari]%' order by id_berita DESC");
while($data=mysql_fetch_array($sql)){
$isi=$data['keterangan'];
$isian=substr($isi,0,300);
$isian=substr($isi,0,strrpos($isian," "));
if($data['foto']!=''){
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp;  <a href='berita-$data[id_berita]-$data[judul_seo].html'> <u>$data[judul]</u> </a> </h3></td></tr>
<tr><td align=justify><div class='label bottom'><p>$data[judul]</p><img src='berita/small_$data[foto]' align=left hspace=15 border=1 width=200></div> $isian.... (<a href='berita-$data[id_berita]-$data[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($data[hits]) </td></tr>
</table>
<hr>";
}else{
echo"
<table>
<tr><td><h3> <img src='profil/newspaper.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; <u><a href='berita-$data[id_berita]-$data[judul_seo].html'>$data[judul]<a/></u></h3></td></tr>
<tr><td align=justify> $isian.... (<a href='berita-$data[id_berita]-$data[judul_seo].html'><u>selengkapnya</u></a>) dibaca ($data[hits]) </td></tr>
</table>
<hr>";
}
}
}

if($_GET['menu']=='galeri'){
$kolom=1;
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> GALERI BAZNAS KOTA PAYAKUMBUH </b> </legend></fieldset>
<table width=100%><tr>";
$sql=mysql_query("select * from galeri order by id_galeri DESC limit 15");
$i=0;
while($data=mysql_fetch_array($sql)){
if($i > $kolom){
echo"</tr><tr>";
$i=0;
}
echo"<td valign=top width=50%><a id='galeri' href='galeri/$data[foto]'><img src='galeri/small_$data[foto]' style='border:1pt solid #000; padding:5px;' hspace=5px>  </a><br>$data[keterangan]</td>";
$i++;
}
echo"</tr></table>";
}

if($_GET['menu']=='file'){
echo"<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> FILES BAZNAS KOTA PAYAKUMBUH </b> </legend></fieldset>";
$sql=mysql_query("select * from files order by id_files DESC limit 20");
while($data=mysql_fetch_array($sql)){
echo"<p><img src='images/folder.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; <a href='download.php?file=$data[nama_files]'><u>$data[nama_files]</u></a></p>";
}


}
?>