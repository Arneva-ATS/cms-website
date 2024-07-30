<?php
$data=mysql_num_rows(mysql_query("select * from module where module='pencarian' and status='Y'"));
if($data > 0){
?>
<div style="width:99%; margin-top:10px; border:1px solid #00923f; margin-right:3px; text-align: center;">
<div style="height:30px; background-color:#00923f; text-align:center; color:#FFFFFF; border:1px solid #009933; padding:5px;"><b><img src='profil/icon_search.png' width=25 style='float:left;'>PENCARIAN INFORMASI</b></div><br>
<form method="post" action="hasil-pencarian.html"><input type="search" name="cari" placeholder="Pencarian Informasi...."> &nbsp; <input type="image" src="profil/icon_search.png" width=20></form>
</div>
<?php
}
?>

<?php
$data=mysql_num_rows(mysql_query("select * from module where module='kalender' and status='Y'"));
if($data > 0){
?>

<div style="width:99%; margin-top:10px; border:1px solid #00923f; margin-right:3px;">
<div style="height:30px; background-color:#00923f; text-align:left; color:#FFFFFF; border:1px solid #009933; padding:3px;"><b><img src='profil/kalender-icon.jpg' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp; KALENDER</b></div>

<?php
$tanggal=date("d");
$bulan=date("m");
$tahun=date("Y");
echo buatkalender($tanggal,$bulan,$tahun);
?>

</div>
 
<?php 
}
?> 


<?php
$data=mysql_num_rows(mysql_query("select * from module where module='Agenda' and status='Y'"));
if($data > 0){
?>
      
<div style="width:99%; margin-top:10px; border:1px solid #00923f; margin-right:3px;">
<div style="height:30px; background-color:#00923f; text-align:left; color:#FFFFFF; border:1px solid #009933; padding:5px;"><b><img src='profil/agenda.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp AGENDA</b></div>
<?php 
$sql=mysql_query("select *,date_format(tanggal_agenda,'%d-%m-%Y') as tgl_agenda from agenda order by id_agenda DESC limit 5");
echo"<ul id='agenda'>";
while($data=mysql_fetch_array($sql)){
echo"<li><b><a href='agenda-$data[id_agenda].html'><u>$data[nama_agenda]</u></a></b> dilaksanakan pada (<b>$data[tgl_agenda]</b>)</li><hr style='opacity:0.5;'>";
}
echo"</ul>";
?>        
</div>

<?php } ?>
      
      
<?php
$data=mysql_num_rows(mysql_query("select * from module where module='Berita_teratas' and status='Y'"));
if($data > 0){
?>
      
<div style="width:99%; margin-top:10px; border:1px solid #00923f; margin-right:3px;"><div style="height:30px; background-color:#00923f; text-align:left; color:#FFFFFF; border:1px solid #009933; padding:5px;"><b><img src='profil/buku_icon.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; &nbsp  INFORMASI TERATAS</b></div>
<?php

$sql=mysql_query("select * from berita order by hits DESC limit 5");
echo"<ul>";
while($data=mysql_fetch_array($sql)){
echo"
<li><a href='berita-$data[id_berita]-$data[judul_seo].html'><u>$data[judul]</u></a> ($data[hits]) </li><hr>";
}
echo"</ul>";
?>  
</div>
<?php } ?>      


<?php
$data=mysql_num_rows(mysql_query("select * from module where module='Partner' and status='Y'"));
if($data > 0){
?>
      
<div style="width:99%; margin-top:10px; border:1px solid #00923f; margin-right:3px; text-align:center;"><div style="height:30px; background-color:#00923f; text-align:left; color:#FFFFFF; border:1px solid #009933; padding:5px;"><b><img src='profil/partner.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; PARTNER</b></div>

<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FMega-Piranti%2F189501697901846%3Fref%3Dhl&amp;width=200&amp;height=270&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:290px;" allowTransparency="true"></iframe>
</div>

<?php } ?>



<?php
$data=mysql_num_rows(mysql_query("select * from module where module='google_map' and status='Y'"));
if($data > 0){
?>
      
<div style="width:99%; margin-top:10px; border:1px solid #00923f; margin-right:3px; text-align:center;"><div style="height:30px; background-color:#00923f; text-align:left; color:#FFFFFF; border:1px solid #009933; padding:5px;"><b><img src='profil/mp.png' width=25 style='float:left;' hspace=5> &nbsp; &nbsp; GOOGLE MAP BAZNAS</b></div>

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15959.111639484094!2d100.6232936!3d-0.2578745!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2ab52a70e9d645%3A0x31bfa24cffa22d4a!2sSouth+Payakumbuh%2C+Payakumbuh+City%2C+West+Sumatra!5e0!3m2!1sen!2sid!4v1413728470100" width="220" height="290" frameborder="0" style="border:0"></iframe>

</div>

<?php } ?>



<?php
$data=mysql_num_rows(mysql_query("select * from module where module='iklan' and status='Y'"));
if($data > 0){
?>
      
<div style="width:99%; margin-top:10px; border:1px solid #00923f; margin-right:3px; text-align:center;"><div style="height:30px; background-color:#00923f; text-align:left; color:#FFFFFF; border:1px solid #009933; padding:5px;"><b><img src='profil/logo-default.jpg' width=30 style='float:left;' hspace=5> &nbsp; &nbsp; IKLAN </b></div>


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Education -->
<ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-1360820438175801"
     data-ad-slot="7063409574"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</div>

<?php } ?>


















