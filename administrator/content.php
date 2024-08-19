<?php
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
if (empty($_SESSION['id_user'])) {
	echo "<center>Dilarang Akses Langsung !</center>";
} else {
	//--------------------------------------------------------------------------START OF CONTENT----------------------------------------------------
	if ($_GET['menu'] == 'home') {
		$tgl = date("D,d-M-Y | H:i:s");
		echo "<h3 style='border-bottom:1px solid #000;'>Welcome</h3> Selamat Datang <b>$_SESSION[nama]</b> <br> Anda Login Sebagai : <b> " . ucwords($_SESSION['status_user']) . " </b><br> Silahkan Olah Modul Disamping ! <br> Tanggal Akses Anda : $tgl";
	}
	if ($_GET['menu'] == '') {
		$tgl = date("D,d-M-Y | H:i:s");
		echo "<h3 style='border-bottom:1px solid #000;'>Welcome</h3> Selamat Datang <b>$_SESSION[nama]</b> <br> Anda Login Sebagai : <b> " . ucwords($_SESSION['status_user']) . " </b><br> Silahkan Olah Modul Disamping ! <br> Tanggal Akses Anda : $tgl";
	}

	if ($_GET['menu'] == 'kontak') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from kontak where id_dekopin='". $_SESSION['id_dekopin']."'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN KONTAK </b> </legend></fieldset>
<form method=POST action='aksi.php?act=input_kontak'>
<input type=hidden name='id_kontak' value='$data[id_kontak]'>
<table>
<tr><td valign=top> Lokasi : </td><td><textarea name='lokasi' cols=55 rows=20 id='loko'>$data[lokasi]</textarea></td></tr>
<tr><td valign=top> Nomor Telepon : </td><td><textarea name='nomor_telepon' cols=55 rows=20 id='loko1'>$data[nomor_telepon]</textarea></td></tr>
<tr><td valign=top> Email : </td><td><textarea name='email' cols=55 rows=20 id='loko2'>$data[email]</textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick='javascript:history.go(-1)'></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'profil' && $_SESSION['status_user'] !== 'superadmin') {

		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from profil where id_dekopin='". $_SESSION['id_dekopin']."'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN PROFIL </b> </legend></fieldset>
<form method=POST action='aksi.php?act=input_profil' enctype='multipart/form-data'>
<input type=hidden name='id_profile' value='$data[id_profile]'>
<table>
<tr><td valign=top> Struktur Organisasi : </td><td><img src='../profil/small_$data[foto]' width=400></td></tr>
<tr><td> Upload Foto Struktur Organisasi : </td><td><input type=file name='foto'></td></tr>
<tr><td valign=top> Nama Dekopin: </td><td><textarea name='nama_dekopin' cols='55' rows='20'>$data[nama_dekopin]</textarea></td></tr>
<tr><td valign=top> Deskripsi Utama: </td><td><textarea name='deskripsi_utama' cols='55' rows='20'>$data[deskripsi_utama]</textarea></td></tr>
<tr><td valign=top> Visi : </td><td><textarea name='visi' cols='55' rows='20' id='loko'>$data[visi]</textarea></td></tr>
<tr><td valign=top> Misi : </td><td><textarea name='misi' cols='55' rows='20' id='loko1'>$data[misi]</textarea></td></tr>
<tr><td valign=top> Identitas Kami : </td><td><textarea name='identitas_kami' cols='55' rows='20' id='loko4'>$data[identitas_kami]</textarea></td></tr>
<tr><td valign=top> Deskripsi Section 1 : </td><td><textarea name='deskripsi_sec_1' cols='55' rows='20' id='loko2'>$data[deskripsi_sec_1]</textarea></td></tr>
<tr><td valign=top> Deskripsi Section 2 : </td><td><textarea name='deskripsi_sec_2' cols='55' rows='20'>$data[deskripsi_sec_2]</textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick='javascript:history.go(-1)'></td></tr>
</table>
</form>
";
	}
	if ($_GET['menu'] == 'pengurus' && $_SESSION['status_user'] !== 'superadmin') {

		// Query to fetch all pengurus data associated with id_dekopin
		$result = mysqli_query($koneksi, "SELECT * FROM pengurus WHERE id_dekopin='" . $_SESSION['id_dekopin'] . "'");
	
		echo "
		<fieldset style='border-bottom:0px;border-left:0px;border-right:0px;'>
			<legend><b> MANAJEMEN SUSUNAN PENGURUS </b></legend>
		</fieldset>
		<form method='POST' action='aksi.php?act=input_pengurus' enctype='multipart/form-data'>
			<table>
				<tr>
					<td valign='top'>Susunan Pengurus:</td>
					<td>
						<table  width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1 id='pengurusTable'>
							<thead>
								<tr bgcolor=#006699 style='color:#fff;'>
									<th>No</th>
									<th>Bidang / Jabatan</th>
									<th>Nama</th>
								</tr>
							</thead>
							<tbody>";
							
							// Loop through each row of the result set
							while ($row = mysqli_fetch_assoc($result)) {
								echo "

								<tr>
									<td hidden><input type='text' name='id_tabel[]' value='" . $row['id'] . "'></td>
									<td><input type='text' style='text-align: center;' name='no[]' value='" . $row['no'] . "'></td>
									<td><input type='text' style='text-align: center;' name='jabatan[]' value='" . $row['jabatan'] . "'></td>
									<td><input type='text' style='text-align: center;' name='nama[]' value='" . $row['nama'] . "'></td>
								</tr>";
							}
	
		echo "
							</tbody>
						</table>
						<button type='button' onclick='addRow()'>Tambah Baris</button>
					</td>
				</tr>
				<tr><td></td><td><input type='submit' value='Simpan'> <input type='button' value='Cancel' onclick='javascript:history.go(-1)'></td></tr>
			</table>
		</form>
		<script>
			function addRow() {
				var table = document.getElementById('pengurusTable').getElementsByTagName('tbody')[0];
				var newRow = table.insertRow();
	
				var cell1 = newRow.insertCell(0);
				var cell2 = newRow.insertCell(1);
				var cell3 = newRow.insertCell(2);

				cell1.innerHTML = \"<input type='text' name='no[]' value=''>\";
				cell2.innerHTML = \"<input type='text' name='jabatan[]' value=''>\";
				cell3.innerHTML = \"<input type='text' name='nama[]' value=''>\";
			}
		</script>
		";
	}
	
	if ($_GET['menu'] == 'notaris' && $_SESSION['status_user'] !== 'superadmin') {

		// Query to fetch all pengurus data associated with id_dekopin
		$result = mysqli_query($koneksi, "SELECT * FROM notaris WHERE id_dekopin='" . $_SESSION['id_dekopin'] . "'");
	
		echo "
		<fieldset style='border-bottom:0px;border-left:0px;border-right:0px;'>
			<legend><b> MANAJEMEN NOTARIS </b></legend>
		</fieldset>
		<form method='POST' action='aksi.php?act=input_notaris' enctype='multipart/form-data'>
			<table>
				<tr>
					<td valign='top'>Notaris:</td>
					<td>
						<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1 id='notarisTable'>
							<thead>
								<tr bgcolor=#006699 style='color:#fff;'>
									<th>No</th>
									<th>Nama</th>
									<th>Alamat</th>
								</tr>
							</thead>
							<tbody>";
							
							// Loop through each row of the result set
							while ($row = mysqli_fetch_assoc($result)) {
								echo "

								<tr>
									<td hidden><input type='text' name='id_tabel[]' value='" . $row['id'] . "'></td>
									<td><input type='text' style='text-align: center;' name='no[]' value='" . $row['no'] . "'></td>
									<td><input type='text' style='text-align: center;' name='nama[]' value='" . $row['nama'] . "'></td>
									<td><input type='text' name='alamat[]' value='" . $row['alamat'] . "'></td>
								</tr>";
							}
	
		echo "
							</tbody>
						</table>
						<button type='button' onclick='addRowNotaris()'>Tambah Baris</button>
					</td>
				</tr>
				<tr><td></td><td><input type='submit' value='Simpan'> <input type='button' value='Cancel' onclick='javascript:history.go(-1)'></td></tr>
			</table>
		</form>
		<script>
			function addRowNotaris() {
				var table = document.getElementById('notarisTable').getElementsByTagName('tbody')[0];
				var newRow = table.insertRow();
	
				var cell1 = newRow.insertCell(0);
				var cell2 = newRow.insertCell(1);
				var cell3 = newRow.insertCell(2);

				cell1.innerHTML = \"<input type='text' name='no[]' value=''>\";
				cell2.innerHTML = \"<input type='text' name='nama[]' value=''>\";
				cell3.innerHTML = \"<input type='text' name='alamat[]' value=''>\";
			}
		</script>
		";
	}
	if ($_GET['menu'] == 'galeri' && $_SESSION['status_user'] !== 'superadmin') {
		$batas = 20;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}
		$no = $posisi + 1;
		echo "<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN GALERI </b> </legend></fieldset>
<a href='?menu=tambah_galeri'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Galeri</td><td>Foto</td><td>Keterangan</td><td>Edit</td><td>Hapus</td></tr>";
		$sql = mysqli_query($koneksi, "select * from galeri where id_dekopin='". $_SESSION['id_dekopin']."' limit $posisi,$batas");
		while ($data = mysqli_fetch_array($sql)) {
			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}
			$isi = $data['keterangan'];
			$isian = substr($isi, 0, 100);
			$isian = substr($isi, 0, strrpos($isian, " "));
			if (file_exists('../galeri/small_' . $data['foto'] . '')) {
				$gbr = '../galeri/small_' . $data['foto'] . '';
			} else {
				$gbr = '../galeri/default.jpg';
			}
			echo "<tr bgcolor=$warna><td>$no</td><td><img src='$gbr' width=150></td><td>$isian...</td><td><a href='?menu=edit_galeri&id=$data[id_galeri]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_galeri&id=$data[id_galeri]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[foto] ini ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table>";

		echo "<br> Halaman : ";

		$query = mysqli_num_rows(mysqli_query($koneksi, "select * from galeri id_dekopin='". $_SESSION['id_dekopin']."'"));
		$jumlah = ceil($query / $batas);

		for ($i = 1; $i <= $jumlah; $i++) {
			if ($i != $halaman) {
				echo "<a href='?menu=galeri&halaman=$i'> $i | </a>";
			} else {
				echo "<b> $i | </b>";
			}
		}

		echo "<br><br><font size=2><b>Catatan: Sertakan Foto Berupa JPG/JPEG</b></font>";
	}

	if ($_GET['menu'] == 'edit_galeri' && $_SESSION['status_user'] !== 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from galeri where id_galeri='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_galeri' enctype='multipart/form-data'>
<input type=hidden name='id_galeri' value='$data[id_galeri]'>
<table width=100% border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Id Galeri</td><td><input type=text name='id_galeri' value='$data[id_galeri]' size=1 disabled></td></tr>";
		echo "<tr><td>Kategori</td><td><select name='id_kategori'>";
		$query = mysqli_query($koneksi, "select * from kategori_galeri");
		while ($rows = mysqli_fetch_array($query)) {
			if ($rows['id_kategori'] == $data['id_kategori']) {
				echo "<option value='$rows[id_kategori]' selected>$rows[judul]</option>";
			} else {
				echo "<option value='$rows[id_kategori]'>$rows[judul]</option>";
			}
		}
		echo "</td></tr>
<tr><td valign=top>Foto</td><td><img src='../galeri/small_$data[foto]' width=150></td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'> )* Foto Harus Berintensitas Jpg</td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td valign=top></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=javascript:history.go(-1)></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'tambah_galeri' && $_SESSION['status_user'] !== 'superadmin') {

		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_galeri' enctype='multipart/form-data'>
<table width=100% border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>";
		echo "<tr><td>Kategori</td><td><select name='id_kategori'>";
		$query = mysqli_query($koneksi, "select * from kategori_galeri where id_dekopin='". $_SESSION['id_dekopin']."'");
		while ($rows = mysqli_fetch_array($query)) {
			echo "<option value='$rows[id_kategori]'>$rows[judul]</option>";
		}
		echo "</td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'> )* Foto Harus Berintensitas Jpg </td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 id='loko'></textarea></td></tr>
<tr><td valign=top></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=javascript:history.go(-1)></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'kategori_galeri' && $_SESSION['status_user'] !== 'superadmin') {
		$batas = 20;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}

		$no = $posisi + 1;
		echo "<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> KATEGORI GALERI </b> </legend></fieldset>
<a href='?menu=tambah_kategori_galeri'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Kategori</td><td>Judul</td><td>Edit</td><td>Hapus</td></tr>";
		$sql = mysqli_query($koneksi, "select * from kategori_galeri where id_dekopin='". $_SESSION['id_dekopin']."' limit $posisi,$batas");
		while ($data = mysqli_fetch_array($sql)) {
			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}
			echo "<tr bgcolor=$warna><td>$no</td><td>$data[judul]</td><td><a href='?menu=edit_kategori_galeri&id=$data[id_kategori]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_kategori_galeri&id=$data[id_kategori]\" onclick=\"return confirm('Yakin Mau Hapus $data[judul] ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table>";

		echo "<br> Halaman : ";
		$query = mysqli_num_rows(mysqli_query($koneksi, "select * from kategori_galeri where id_dekopin='". $_SESSION['id_dekopin']."'"));
		$jumlah = ceil($query / $batas);

		for ($i = 1; $i <= $jumlah; $i++) {
			if ($i != $halaman) {
				echo "<a href='?menu=kategori_galeri&halaman=$i'> $i | </a>";
			} else {
				echo "<b> $i | </b>";
			}
		}
	}

	if ($_GET['menu'] == 'edit_kategori_galeri' && $_SESSION['status_user'] !== 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from kategori_galeri where id_kategori='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT KATEGORI GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_kategori_galeri'>
<input type=hidden name='id_kategori' value='$data[id_kategori]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>ID kategori galeri</td><td><input type=text name='id_kategori' value='$data[id_kategori]' size=1 disabled></td></tr>
<tr><td>Judul galeri</td><td><input type=text name='judul' value='$data[judul]'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'tambah_kategori_galeri' && $_SESSION['status_user'] !== 'superadmin') {

		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH KATEGORI GALERI </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_kategori_galeri'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Judul galeri</td><td><input type=text name='judul'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";
	}


	if ($_GET['menu'] == 'kategori_berita' && $_SESSION['status_user'] !== 'superadmin') {
		$batas = 10;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}

		$no = $posisi + 1;
		echo "<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> KATEGORI BERITA </b> </legend></fieldset>
<a href='?menu=tambah_kategori_berita'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Kategori</td><td>Nama Kategori</td><td>Edit</td><td>Hapus</td></tr>";
		$sql = mysqli_query($koneksi, "select * from kategori_berita where id_dekopin='". $_SESSION['id_dekopin']."' limit $posisi,$batas");
		while ($data = mysqli_fetch_array($sql)) {
			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}
			echo "<tr bgcolor=$warna><td>$no</td><td>$data[nama_kategori]</td><td><a href='?menu=edit_kategori_berita&id=$data[id_kategori]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_kategori_berita&id=$data[id_kategori]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_kategori] ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table>";

		echo "<br> Halaman : ";
		$query = mysqli_num_rows(mysqli_query($koneksi, "select * from kategori_berita where id_dekopin='". $_SESSION['id_dekopin']."'"));
		$jumlah = ceil($query / $batas);

		for ($i = 1; $i <= $jumlah; $i++) {
			if ($i != $halaman) {
				echo "<a href='?menu=kategori_berita&halaman=$i'> $i | </a>";
			} else {
				echo "<b> $i | </b>";
			}
		}
	}

	if ($_GET['menu'] == 'tambah_kategori_berita' && $_SESSION['status_user'] !== 'superadmin') {

		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH KATEGORI BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_kategori_berita'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>Nama Kategori</td><td><input type=text name='nama_kategori'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'edit_kategori_berita' && $_SESSION['status_user'] !== 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from kategori_berita where id_kategori='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT KATEGORI BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_kategori_berita'>
<input type=hidden name='id_kategori' value='$data[id_kategori]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>ID kategori</td><td><input type=text name='id_kategori' value='$data[id_kategori]' size=1 disabled></td></tr>
<tr><td>Nama Kategori</td><td><input type=text name='nama_kategori' value='$data[nama_kategori]'></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back();></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'agenda' && $_SESSION['status_user'] !== 'superadmin') {

		$batas = 20;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}

		$no = $posisi + 1;
		echo "<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN AGENDA </b> </legend></fieldset>
<a href='?menu=tambah_agenda'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>ID Agenda</td><td>Nama Agenda</td><td>Tanggal Agenda</td><td>Foto</td><td>Keterangan</td><td>Edit</td><td>Hapus</td></tr>";
		$sql = mysqli_query($koneksi, "select * from agenda where id_dekopin='". $_SESSION['id_dekopin']."' order by id_agenda DESC limit $posisi,$batas");
		while ($data = mysqli_fetch_array($sql)) {
			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}
			if (file_exists('../agenda/small_' . $data['foto'] . '')) {
				$agd = '../agenda/small_' . $data['foto'] . '';
			} else {
				$agd = '../agenda/default.jpg';
			}
			$isi = $data['keterangan'];
			$isian = substr($isi, 0, 250);
			$isian = substr($isi, 0, strrpos($isian, " "));
			echo "<tr bgcolor=$warna><td>$no</td><td>$data[nama_agenda]</td><td>$data[tanggal_agenda]</td><td><img src='$agd' width=100></td><td>$isian...</td><td><a href='?menu=edit_agenda&id=$data[id_agenda]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_agenda&id=$data[id_agenda]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama_agenda] ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table>";

		echo "<br> Halaman : ";
		$query = mysqli_num_rows(mysqli_query($koneksi, "select * from agenda where id_dekopin='". $_SESSION['id_dekopin']."'"));
		$jumlah = ceil($query / $batas);

		for ($i = 1; $i <= $jumlah; $i++) {
			if ($i != $halaman) {
				echo "<a href='?menu=agenda&halaman=$i'> $i | </a>";
			} else {
				echo "<b> $i | </b>";
			}
		}
	}

	if ($_GET['menu'] == 'tambah_agenda' && $_SESSION['status_user'] !== 'superadmin') {
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH AGENDA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_agenda' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 width=100% style='border-collapse:collapse;'>
<tr><td>Nama Agenda</td><td><input type=text name='nama_agenda'></td></tr>
<tr><td>Tanggal Agenda</td><td>

<select name='tanggal_agenda'>";
		$tgl = date("d");
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}
		echo "</select>

<select name='bulan_agenda'>";
		$nm_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$bln = date("m");
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln) {
				echo "<option value='$i' selected>$nm_bln[$i]</option>";
			} else {
				echo "<option value='$i'>$nm_bln[$i]</option>";
			}
		}

		echo "</select>

<select name='tahun_agenda'>";

		$thn = date("Y");
		for ($i = 2012; $i <= 2025; $i++) {
			if ($i == $thn) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}

		echo "</select>

</td></tr>

<tr><td>Tanggal Selesai</td><td>

<select name='tanggal_selesai'>";
		$tgl = date("d");
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}
		echo "</select>

<select name='bulan_selesai'>";
		$nm_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$bln = date("m");
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln) {
				echo "<option value='$i' selected>$nm_bln[$i]</option>";
			} else {
				echo "<option value='$i'>$nm_bln[$i]</option>";
			}
		}

		echo "</select>

<select name='tahun_selesai'>";

		$thn = date("Y");
		for ($i = 2012; $i <= 2025; $i++) {
			if ($i == $thn) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}

		echo "</select>

</td></tr>
<tr><td valign=top>Jam Agenda</td><td><input type=time name='jam'></td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=50 id='loko'></textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back()></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'edit_agenda' && $_SESSION['status_user'] !== 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from agenda where id_agenda='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT AGENDA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_agenda' enctype='multipart/form-data'>
<input type=hidden name='id_agenda' value='$data[id_agenda]'>
<table border=1 cellpadding=5 cellspacing=0 width=100% style='border-collapse:collapse;'>
<tr><td>Id Agenda</td><td><input type=text name='id_agenda' value='$data[id_agenda]' size=1 disabled></td></tr>
<tr><td>Nama Agenda</td><td><input type=text name='nama_agenda' value='$data[nama_agenda]'></td></tr>
<tr><td>Tanggal Agenda</td><td>

<select name='tanggal_agenda'>";
		$tgl = substr($data['tanggal_agenda'], 8, 2);
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}
		echo "</select>

<select name='bulan_agenda'>";
		$nm_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$bln = substr($data['tanggal_agenda'], 5, 2);
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln) {
				echo "<option value='$i' selected>$nm_bln[$i]</option>";
			} else {
				echo "<option value='$i'>$nm_bln[$i]</option>";
			}
		}

		echo "</select>

<select name='tahun_agenda'>";

		$thn = substr($data['tanggal_agenda'], 0, 4);
		for ($i = 2012; $i <= 2025; $i++) {
			if ($i == $thn) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}

		echo "</select>";


		echo "<tr><td>Tanggal Selesai</td><td>

<select name='tanggal_selesai'>";
		$tgl_sls = substr($data['tanggal_selesai'], 8, 2);
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl_sls) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}
		echo "</select>

<select name='bulan_selesai'>";
		$nm_bln_sls = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$bln_sls = substr($data['tanggal_selesai'], 5, 2);
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln_sls) {
				echo "<option value='$i' selected>$nm_bln_sls[$i]</option>";
			} else {
				echo "<option value='$i'>$nm_bln_sls[$i]</option>";
			}
		}


		echo "</select>

<select name='tahun_selesai'>";

		$thn_sls = substr($data['tanggal_selesai'], 0, 4);
		for ($i = 2012; $i <= 2025; $i++) {
			if ($i == $thn_sls) {
				echo "<option value='$i' selected>$i</option>";
			} else {
				echo "<option value='$i'>$i</option>";
			}
		}
		echo "</select>

</td></tr>
<tr><td valign=top>Jam Agenda</td><td><input type=time name='jam' value='$data[jam]'></td></tr>";

		echo "</td></tr>
<tr><td valign=top>Foto</td><td><img src='../agenda/small_$data[foto]' width=100></td></tr>
<tr><td valign=top>Foto</td><td><input type=file name='foto'></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=50 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td></td><td><input type=submit value='Simpan'> <input type=button value='Cancel' onclick=self.history.back()></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'user' && $_SESSION['status_user'] !== 'superadmin') {

		$batas = 20;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}

		$no = $posisi + 1;
		echo "<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN USER </b> </legend></fieldset>
<a href='?menu=tambah_user'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>No</td><td>Username</td><td>Email</td><td>Status User</td><td>Edit</td><td>Hapus</td></tr>";
		$sql = mysqli_query($koneksi, "select * from user where id_dekopin='$_SESSION[id_dekopin]' limit $posisi,$batas");
		while ($data = mysqli_fetch_array($sql)) {
			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}
			echo "<tr bgcolor=$warna><td>$no</td><td>$data[username]</td><td>$data[email]</td><td>$data[status_user]</td><td><a href='?menu=edit_user&id=$data[id_user]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_user&id=$data[id_user]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama] ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table>";

		echo "<br> Halaman : ";
		$query = mysqli_num_rows(mysqli_query($koneksi, "select * from user where id_dekopin='$_SESSION[id_dekopin]'"));
		$jumlah = ceil($query / $batas);

		for ($i = 1; $i <= $jumlah; $i++) {
			if ($i != $halaman) {
				echo "<a href='?menu=user&halaman=$i'> $i | </a>";
			} else {
				echo "<b> $i | </b>";
			}
		}
	}

	if ($_GET['menu'] == 'user' && $_SESSION['status_user'] == 'superadmin') {

		$batas = 20;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}

		$no = $posisi + 1;
		echo "<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN USER </b> </legend></fieldset>
<a href='?menu=tambah_user'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>No</td><td>Username</td><td>Email</td><td>Status User</td><td>Edit</td><td>Hapus</td></tr>";
		$sql = mysqli_query($koneksi, "select * from user limit $posisi,$batas");
		while ($data = mysqli_fetch_array($sql)) {
			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}
			echo "<tr bgcolor=$warna><td>$no</td><td>$data[username]</td><td>$data[email]</td><td>$data[status_user]</td><td><a href='?menu=edit_user&id=$data[id_user]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_user&id=$data[id_user]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama] ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table>";

		echo "<br> Halaman : ";
		$query = mysqli_num_rows(mysqli_query($koneksi, "select * from user where id_dekopin='$_SESSION[id_dekopin]'"));
		$jumlah = ceil($query / $batas);

		for ($i = 1; $i <= $jumlah; $i++) {
			if ($i != $halaman) {
				echo "<a href='?menu=user&halaman=$i'> $i | </a>";
			} else {
				echo "<b> $i | </b>";
			}
		}
	}
	if ($_GET['menu'] == 'dekopin' && $_SESSION['status_user'] == 'superadmin') {

		$batas = 20;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}

		$no = $posisi + 1;
		echo "<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN DEKOPIN </b> </legend></fieldset>
<a href='?menu=tambah_dekopin'><input type=button value='Tambah'></a><p></p>
<table width=100% cellpadding=5 cellspacing=0 style='border-collapse:collapse;' border=1>
<tr bgcolor=#006699 style='color:#fff;'><td>No</td><td>Nama Dekopin</td><td>Status Aktif</td><td>Edit</td><td>Hapus</td></tr>";
		$sql = mysqli_query($koneksi, "select * from dekopin limit $posisi,$batas");
		while ($data = mysqli_fetch_array($sql)) {
			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}
			echo "<tr bgcolor=$warna><td>$data[id_dekopin]</td><td>$data[nama_dekopin]</td><td>$data[status_active]</td><td><a href='?menu=edit_dekopin&id=$data[id_dekopin]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_dekopin&id=$data[id]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[nama] ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table>";

		echo "<br> Halaman : ";
		$query = mysqli_num_rows(mysqli_query($koneksi, "select * from user where id_dekopin='$_SESSION[id_dekopin]'"));
		$jumlah = ceil($query / $batas);

		for ($i = 1; $i <= $jumlah; $i++) {
			if ($i != $halaman) {
				echo "<a href='?menu=user&halaman=$i'> $i | </a>";
			} else {
				echo "<b> $i | </b>";
			}
		}
	}

	if ($_GET['menu'] == 'edit_user' && $_SESSION['status_user'] !== 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from user where id_user='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT USER </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_user' enctype='multipart/form-data'>
<input type=hidden name='id_user' value='$data[id_user]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Id User</td><td><input type=text name='id_user' value='$data[id_user]' size=1 disabled></td></tr>
<tr><td>Username</td><td><input type=text name='username' value='$data[username]'></td></tr>
<tr><td>Nama</td><td><input type=text name='nama' value='$data[nama]'></td></tr>
<tr><td>Password</td><td><input type=password name='password'></td></tr>
<tr><td>Email</td><td><input type=text name='email' value='$data[email]'></td></tr>
<tr><td>Alamat</td><td><textarea name='alamat' cols=50 id='loko'> $data[alamat]</textarea></td></tr>
<tr><td>Tanggal_lahir</td><td>

<select name='tanggal_lahir'>";
		$tgl = substr($data['tanggal_lahir'], 8, 2);
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select><select name='bulan_lahir'>";
		$nm_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$bln = substr($data['tanggal_lahir'], 5, 2);
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln) {
				echo "<option value='$i' selected>$nm_bln[$i]</option>'";
			} else {
				echo "<option value='$i'>$nm_bln[$i]</option>'";
			}
		}
		echo "</select><select name='tahun_lahir'>";

		$thn = substr($data['tanggal_lahir'], 0, 4);
		for ($i = 1930; $i <= 2025; $i++) {
			if ($i == $thn) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select></td></tr>
<tr><td valign=top>Foto</td><td><img src='akun/small_$data[foto]' width=150></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'></td></tr>";
		if ($data['status_user'] == 'admin') {
			echo "<tr><td>Status User</td><td><input type=radio name='status_user' value='admin' checked>admin<input type=radio name='status_user' value='user'>user</td></tr>";
		} else {
			echo "<tr><td>Status User</td><td><input type=radio name='status_user' value='admin'>admin<input type=radio name='status_user' value='user' checked>user</td></tr>";
		}
		echo "
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";
	}
	if ($_GET['menu'] == 'edit_user' && $_SESSION['status_user'] == 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from user where id_user='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT USER </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_user_admin' enctype='multipart/form-data'>
<input type=hidden name='id_user' value='$data[id_user]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Id User</td><td><input type=text name='id_user' value='$data[id_user]' size=1 disabled></td></tr>
<tr><td>Username</td><td><input type=text name='username' value='$data[username]'></td></tr>
<tr><td>Nama</td><td><input type=text name='nama' value='$data[nama]'></td></tr>
<tr><td>Password</td><td><input type=password name='password'></td></tr>
<tr><td>Email</td><td><input type=text name='email' value='$data[email]'></td></tr>
<tr><td>Alamat</td><td><textarea name='alamat' cols=50 id='loko'> $data[alamat]</textarea></td></tr>
<tr><td>Dekopin</td><td><select name='id_dekopin'><option value='0' hidden>Silahkan pilih dekopin</option>";
		$sql = mysqli_query($koneksi, "SELECT * from dekopin");
		while ($dekopin = mysqli_fetch_array($sql)) {
			echo "<option value='$dekopin[id_dekopin]'"; echo $dekopin["id_dekopin"] == $data["id_dekopin"] ? "selected" : ""; echo">$dekopin[nama_dekopin]</option>";
		}
echo "</select></td></tr><tr><td>Tanggal_lahir</td><td>

<select name='tanggal_lahir'>";
		$tgl = substr($data['tanggal_lahir'], 8, 2);
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select><select name='bulan_lahir'>";
		$nm_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$bln = substr($data['tanggal_lahir'], 5, 2);
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln) {
				echo "<option value='$i' selected>$nm_bln[$i]</option>'";
			} else {
				echo "<option value='$i'>$nm_bln[$i]</option>'";
			}
		}
		echo "</select><select name='tahun_lahir'>";

		$thn = substr($data['tanggal_lahir'], 0, 4);
		for ($i = 1930; $i <= 2025; $i++) {
			if ($i == $thn) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select></td></tr>
<tr><td valign=top>Foto</td><td><img src='akun/small_$data[foto]' width=150></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'></td></tr>
<tr><td>Status User</td><td><input type=radio name='status_user' value='admin'"; echo $data["status_user"] == "admin" ? 'checked': ''; echo ">Admin<input type=radio name='status_user' value='user'"; echo $data["status_user"] == "user" ? 'checked': ''; echo " >User<input type=radio name='status_user' value='superadmin'"; echo $data["status_user"] == "superadmin" ? 'checked' : ''; echo ">Super Admin</td></tr>";
		echo "
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";
	}
	if ($_GET['menu'] == 'edit_dekopin' && $_SESSION['status_user'] == 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from dekopin where id_dekopin='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT DEKOPIN </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_dekopin' enctype='multipart/form-data'>
<input type=hidden name='id_dekopin' value='$data[id_dekopin]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Id Dekopin</td><td><input type=text name='id_dekopin' value='$data[id_dekopin]' size=1 disabled></td></tr>
<tr><td>Nama Dekopin</td><td><input type=text name='nama_dekopin' value='$data[nama_dekopin]'></td></tr>
<tr><td>Status Dekopin</td><td><select type=text name='status_active' value='$data[status_active]'><option value=1"; echo $data["status_active"] == 1 ? "selected": ""; echo ">Aktif</option><option value=0 "; echo $data["status_active"] == 0? "selected": ""; echo ">Tidak Aktif</option></select></td></tr>";
		echo "
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";
	}

	if ($_GET['menu'] == 'tambah_user' && $_SESSION['status_user'] !== 'superadmin') {

		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH USER </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_user' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Username</td><td><input type=text name='username'></td></tr>
<tr><td>Nama</td><td><input type=text name='nama'></td></tr>
<tr><td>Password</td><td><input type=password name='password'></td></tr>
<tr><td>Email</td><td><input type=email name='email'></td></tr>
<tr><td>Alamat</td><td><textarea name='alamat' cols=50 id='loko'></textarea></td></tr>
<tr><td>Tanggal_lahir</td><td>

<select name='tanggal_lahir'>";
		$tgl = date("d");
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select><select name='bulan_lahir'>";
		$nm_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$bln = date("m");
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln) {
				echo "<option value='$i' selected>$nm_bln[$i]</option>'";
			} else {
				echo "<option value='$i'>$nm_bln[$i]</option>'";
			}
		}
		echo "</select><select name='tahun_lahir'>";

		$thn = date("Y");
		for ($i = 1930; $i <= 2025; $i++) {
			if ($i == $thn) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'></td></tr>";
		echo "<tr><td>Status User</td><td><input type=radio name='status_user' value='admin' checked>admin<input type=radio name='status_user' value='user'>user</td></tr>";
		echo "
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";
	}
	if ($_GET['menu'] == 'tambah_user' && $_SESSION['status_user'] == 'superadmin') {

		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH USER </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_user_admin' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Username</td><td><input type=text name='username'></td></tr>
<tr><td>Nama</td><td><input type=text name='nama'></td></tr>
<tr><td>Password</td><td><input type=password name='password'></td></tr>
<tr><td>Email</td><td><input type=email name='email'></td></tr>
<tr><td>Alamat</td><td><textarea name='alamat' cols=50 id='loko'></textarea></td></tr>
<tr><td>Dekopin</td><td><select name='id_dekopin'><option value='0' hidden>Silahkan pilih dekopin</option>";
		$sql = mysqli_query($koneksi, "SELECT * from dekopin");
		while ($data = mysqli_fetch_array($sql)) {
			echo "<option value='$data[id_dekopin]'>$data[nama_dekopin]</option>";
		}
echo "</select></td></tr><tr><td>Tanggal_lahir</td><td>

<select name='tanggal_lahir'>";
		$tgl = date("d");
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $tgl) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select><select name='bulan_lahir'>";
		$nm_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$bln = date("m");
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $bln) {
				echo "<option value='$i' selected>$nm_bln[$i]</option>'";
			} else {
				echo "<option value='$i'>$nm_bln[$i]</option>'";
			}
		}
		echo "</select><select name='tahun_lahir'>";

		$thn = date("Y");
		for ($i = 1930; $i <= 2025; $i++) {
			if ($i == $thn) {
				echo "<option value='$i' selected>$i</option>'";
			} else {
				echo "<option value='$i'>$i</option>'";
			}
		}
		echo "</select></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'></td></tr>";
		echo "<tr><td>Status User</td><td><input type=radio name='status_user' value='admin' checked>Admin<input type=radio name='status_user' value='user'>User<input type=radio name='status_user' value='superadmin'>Superadmin</td></tr>";
		echo "
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";
	}
	if ($_GET['menu'] == 'tambah_dekopin' && $_SESSION['status_user'] == 'superadmin') {

		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH DEKOPIN </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_dekopin' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Nama Dekopin</td><td><input type=text name='nama dekopin'></td></tr>
<tr><td>Status Aktif</td><td><select type=text name='status_active'><option value=1>Aktif</option><option value=0>Tidak Aktif</option></select></td></tr>";
		echo "
<tr><td></td><td><input type=submit value=simpan> <input type=button value=cencel onclick=self.history.back();></td></tr>
</table>
</form>
";
	}
	if ($_GET['menu'] == 'berita' && $_SESSION['status_user'] !== 'superadmin') {

		$batas = 10;
		$halaman = $_GET['halaman'];
		if (empty($halaman)) {
			$posisi = 0;
			$halaman = 1;
		} else {
			$posisi = ($halaman - 1) * $batas;
		}
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> MANAJEMEN BERITA </b> </legend></fieldset>
<a href='?menu=tambah_berita'><input type=button value=Tambah></a><br><br>
<table border=1 cellpadding=4 cellspacing=0 width=100% style='border-collapse:collapse;'>
<tr bgcolor=#006699 style='color:#fff;'><td>No</td><td>Judul</td><td>Foto</td><td>Tanggal</td><td>User</td><td>Edit</td><td>Hapus</td></tr>
";
		if ($_SESSION['status_user'] == 'admin') {

			$tampil = "select * from berita order by id_berita DESC limit $posisi,$batas";
		} else {
			$tampil = "select * from berita where id_user='$_SESSION[id_user]' and id_dekopin='". $_SESSION['id_dekopin']."' order by id_berita DESC limit $posisi,$batas";
		}

		$hasil = mysqli_query($koneksi, $tampil);

		$no = $posisi + 1;
		while ($data = mysqli_fetch_array($hasil)) {
			$isi = htmlentities($data['keterangan']);
			$isian = substr($isi, 0, 80);
			$isian = substr($isi, 0, strrpos($isian, " "));

			if (($no % 2) == 0) {
				$warna = "#dedede";
			} else {
				$warna = "#fff";
			}

			if (file_exists('../berita/small_' . $data['foto'] . '')) {
				$brt = '../berita/small_' . $data['foto'] . '';
			} else {
				$brt = '../berita/default.jpg';
			}

			echo "<tr bgcolor=$warna><td>$no</td><td>$data[judul]</td><td><img src='" . $brt . "' width=50></td><td>$data[tgl]</td><td>$data[username]</td><td><a href='?menu=edit_berita&id=$data[id_berita]'><input type=button value=Edit></a></td><td><a href=\"aksi.php?act=hapus_berita&id=$data[id_berita]&foto=$data[foto]\" onclick=\"return confirm('Yakin Mau Hapus $data[judul] ?');\"><input type=button value=Hapus></a></td></tr>";
			$no++;
		}
		echo "</table><br>";

		echo "Halaman : ";

		if ($_SESSION['status_user'] == 'admin') {
			$tampil2 = "select * from berita where id_dekopin='$_SESSION[id_dekopin]'";
		} else {
			$tampil2 = "select * from berita where id_user='$_SESSION[id_user]' and id_dekopin='$_SESSION[id_dekopin]'";
		}

		$hasil2 = mysqli_query($koneksi, $tampil2);
		$jmldata = mysqli_num_rows($hasil2);

		$jmlhalaman = ceil($jmldata / $batas);

		if ($halaman > 1) {
			$previous = $halaman - 1;
			echo "<A HREF=?menu=berita&halaman=1> awal </A>
        <A HREF=?menu=berita&halaman=$previous> sebelumnya </A>  ";
		} else {
			echo " Awal | Sebelumnya | ";
		}

		$angka = ($halaman > 3 ? " ... " : " ");
		for ($i = $halaman - 2; $i < $halaman; $i++) {
			if ($i < 1)
				continue;
			$angka .= "<a href=?menu=berita&halaman=$i> &nbsp; $i  &nbsp; </A> ";
		}

		$angka .= " <b style='background-color:#e4d135'>&nbsp; $halaman &nbsp;  </b> ";
		for ($i = $halaman + 1; $i < ($halaman + 3); $i++) {
			if ($i > $jmlhalaman)
				break;
			$angka .= "<a href=?menu=berita&halaman=$i> &nbsp; $i  &nbsp; </A> ";
		}

		$angka .= ($halaman + 2 < $jmlhalaman ? " ...
          <a href=?menu=berita&halaman=$jmlhalaman> &nbsp; $jmlhalaman </A> " : " ");

		echo " &nbsp; $angka &nbsp; ";
	}

	if ($_GET['menu'] == 'tambah_berita' && $_SESSION['status_user'] !== 'superadmin') {
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> TAMBAH BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=tambah_berita' enctype='multipart/form-data'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Kategori Informasi</td><td><select name='id_kategori'>";
		$sql = mysqli_query($koneksi, "select * from kategori_berita where id_dekopin='$_SESSION[id_dekopin]'");
		while ($data = mysqli_fetch_array($sql)) {
			echo "<option value='$data[id_kategori]'>$data[nama_kategori]</option>";
		}
		echo "</select></td></tr>";
		echo "
<tr><td>Judul</td><td><input type=text name='judul' size=40></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 rows=20 id='loko'></textarea></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'> )* sertakan dengan foto.</td></tr>
<tr><td></td><td><input type=submit value=Simpan> <input type=button value=Cancel onclick=self.history.back();></td></tr>
";



		echo "</table>
<br>
<i> <b>!</b> untuk menambahkan kategori informasi silahkan pilih menu <b> kategori informasi </b> dan pilih <b>tambah</b></i>
";
	}

	if ($_GET['menu'] == 'edit_berita' && $_SESSION['status_user'] !== 'superadmin') {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from berita where id_berita='$_GET[id]'"));
		echo "
<fieldset  style='border-bottom:0px;border-left:0px;border-right:0px;'><legend> <b> EDIT BERITA </b> </legend></fieldset>
<form method=POST action='aksi.php?act=edit_berita' enctype='multipart/form-data'>
<input type=hidden name='id_berita' value='$data[id_berita]'>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' width=100%>
<tr><td>Kategori Berita</td><td><select name='id_kategori'>";
		$query = mysqli_query($koneksi, "select * from kategori_berita");
		while ($rows = mysqli_fetch_array($query)) {
			if ($rows['id_kategori'] == $data['id_kategori']) {
				echo "<option value='$rows[id_kategori]' selected>$rows[nama_kategori]</option>";
			} else {
				echo "<option value='$rows[id_kategori]'>$rows[nama_kategori]</option>";
			}
		}
		echo "</select></td></tr>";
		echo "
<tr><td>Judul</td><td><input type=text name='judul' value='$data[judul]' size=40></td></tr>
<tr><td valign=top>Keterangan</td><td><textarea name='keterangan' cols=55 rows=20 id='loko'>$data[keterangan]</textarea></td></tr>
<tr><td valign=top>Foto</td><td><img src='../berita/small_$data[foto]'></td></tr>
<tr><td>Foto</td><td><input type=file name='foto'> )* jika foto tidak di ganti, kosongkan saja.</td></tr>
<tr><td></td><td><input type=submit value=Simpan> <input type=button value=Cancel onclick=self.history.back();></td></tr>
";



		echo "</table>
";
	}

	//--------------------------------------------------------------------------END OF CONTENT------------------------------------------------------
}
