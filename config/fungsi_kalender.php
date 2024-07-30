<?php
function buatkalender($tanggal,$bulan,$tahun) {      
  $bulanan=array(1=>"Januari","Februari","Maret","April",
                    "Mei","Juni","Juli","Agustus","September", 
                    "Oktober","November","Desember");
  $bln=date("n");
  $thn=date("Y");

  $jmlhari = date("t",mktime(0,0,0,$bulan,1,$tahun));
  $haritglsatu = date("w",mktime(0,0,0,$bulan,1,$tahun));

  $kalender = "<table cellspacing=0 cellpadding=1 2px  
               border=1 style='border:1pt solid #006699; padding:0px; font-size:14px; font-family:calibri;' width=100%>\n";
  $kalender .= "<tr style='border:1pt solid;'>
               <td colspan=7 style='border:1pt solid;'><center>$bulanan[$bln], $thn </center>
               </td></tr>\n";

  $kalender .= "<tr class=tr_judul>
                <td><b>M</b></td><td><b>S</b></td><td><b>S</b></td><td><b>R</b></td>
                <td><b>K</b></td><td><b>J</b></td><td><b>S</b></td></tr>\n";
  $a 	  = 1;
  $adabaris   = TRUE;
  $mulaicetak = 0;
  while ($adabaris) {
    $kalender .= "<tr align=center class=tr_terang>";
    for ($i = 0; $i < 7; $i++ ) {
      if ($mulaicetak < $haritglsatu) {
        $kalender .= "<td>&nbsp;</td>";
        $mulaicetak++;
      } 
      elseif ($a <= $jmlhari) {
        $tt = $a;
        if ($a == $tanggal) { 
          $tt = "<a href='home.php?id=11' title='Lihat Jadwal' style='text-decoration:none'><span style='color: blue; font-weight: bold; 
                 font-size: larger; text-decoration: blink;'>
                 $tt</span></a>"; 
        }
        if ($i == 0) { 
          $tt = "<font color=\"#FF0000\">$tt</font>"; 
        }
        $kalender .= "<td bgcolor=#e4d135>$tt</td>";
        $a++;
      } 
      else {
        $kalender .= "<td>&nbsp;</td>";
      }
    }
    $kalender .= "</tr>\n";
    if ($a <= $jmlhari) { 
      $adabaris = TRUE; 
    } 
    else { 
      $adabaris = FALSE; 
    }
  }
  $kalender .= "</table>\n";
  return $kalender;
}
?>
