<?php

session_start();
include "../config/koneksi.php";
include "../config/fungsi_seo.php";
include "../config/fungsi_thumb.php";

if ($_GET['act'] == 'input_profil') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	// $path = '/profil/' . $nama_lain;
	if (empty($lokasi_file)) {
		mysqli_query($koneksi, "update profil set nama_dekopin='$_POST[nama_dekopin]',identitas_kami='$_POST[identitas_kami]',misi='$_POST[misi]',visi='$_POST[visi]',deskripsi_utama='$_POST[deskripsi_utama]',deskripsi_sec_1='$_POST[deskripsi_sec_1]',deskripsi_sec_2='$_POST[deskripsi_sec_2]' where id_profile='$_POST[id_profile]'");
	} else {

		// if ($tipe_file != "image/jpeg" and $tipe_file != "image/pjpeg") {
		// 	echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
		// window.location=('home.php?menu=profil')</script>";
		// } else {
		$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from profil where id_profile='$_POST[id_profile]'"));
		unlink("../profil/$data[foto]");
		unlink("../profil/small_$data[foto]");
		UploadImage($nama_lain);
		mysqli_query($koneksi, "update profil set foto='$nama_lain',identitas_kami='$_POST[identitas_kami]',misi='$_POST[misi]',visi='$_POST[visi]',deskripsi_utama='$_POST[deskripsi_utama]',deskripsi_sec_1='$_POST[deskripsi_sec_1]',deskripsi_sec_2='$_POST[deskripsi_sec_2]' where id_profile='$_POST[id_profile]'");
		// }
	}
	header('location:home.php?menu=profil');
}

if ($_GET['act'] == 'input_kontak') {
	mysqli_query($koneksi, "update kontak set lokasi='$_POST[lokasi]',nomor_telepon='$_POST[nomor_telepon]',email='$_POST[email]' where id_kontak='$_POST[id_kontak]'");
	header('location:home.php?menu=kontak');
}

if ($_GET['act'] == 'input_pengurus') {
	$id_dekopin = $_SESSION['id_dekopin'];
	$no = $_POST['no'];
	$jabatan = $_POST['jabatan'];
	$id_tabel = $_POST['id_tabel'];
	$nama = $_POST['nama'];

	foreach ($no as $index => $value) {
		$jabatan_value = $jabatan[$index];
		$id_tabel_value = $id_tabel[$index] ?? '';
		$nama_value = $nama[$index];
		// Check if id_tabel_value is not empty
		if (!empty($id_tabel_value)) {
			// Attempt to update the record
			$query_update = "UPDATE pengurus SET no='$value', jabatan='$jabatan_value', nama='$nama_value' WHERE id='$id_tabel_value'";
			$update = mysqli_query($koneksi, $query_update);
		} else {
			$query_insert = "INSERT INTO pengurus (id_dekopin, no, jabatan, nama) VALUES ('$id_dekopin', '$value', '$jabatan_value', '$nama_value')";
			$insert = mysqli_query($koneksi, $query_insert);
		}
	}

	// Redirect or show a success message
	header('location:home.php?menu=pengurus');
}
if ($_GET['act'] == 'input_notaris') {
	$id_dekopin = $_SESSION['id_dekopin'];
	$nama = $_POST['nama'];
	$no = $_POST['no'];
	$id_tabel = $_POST['id_tabel'];
	$alamat = $_POST['alamat'];

	foreach ($no as $index => $value) {
		$alamat_value = $alamat[$index];
		$nama_value = $nama[$index];
		$id_tabel_value = $id_tabel[$index] ?? '';
		// Check if id_tabel_value is not empty
		if (!empty($id_tabel_value)) {
			// Attempt to update the record
			$query_update = "UPDATE notaris SET no='$value',alamat='$alamat_value', nama='$nama_value' WHERE id='$id_tabel_value'";
			$update = mysqli_query($koneksi, $query_update);
		} else {
			$query_insert = "INSERT INTO notaris (id_dekopin, alamat, nama,no) VALUES ('$id_dekopin', '$alamat_value','$nama_value','$value')";
			$insert = mysqli_query($koneksi, $query_insert);
		}
	}
	// Redirect or show a success message
	header('location:home.php?menu=notaris');
}

if ($_GET['act'] == 'edit_galeri') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	if (empty($lokasi_file)) {
		mysqli_query($koneksi, "update galeri set id_kategori='$_POST[id_kategori]',keterangan='$_POST[keterangan]' where id_galeri='$_POST[id_galeri]'");
	} else {
		UploadGaleri($nama_lain);
		mysqli_query($koneksi, "update galeri set id_kategori='$_POST[id_kategori]',foto='$nama_lain',keterangan='$_POST[keterangan]' where id_galeri='$_POST[id_galeri]'");
	}
	header('location:home.php?menu=galeri');
}

if ($_GET['act'] == 'tambah_galeri') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$tipe_file == $_FILES['foto']['type'];
	$acak = rand(00000, 99999);
	$id_dekopin = $_SESSION['id_dekopin'];
	$nama_lain = $acak . $nama_file;
	if (empty($lokasi_file)) {
		mysqli_query($koneksi, "insert into galeri(id_kategori,keterangan,id_dekopin)values('$_POST[id_kategori]','$_POST[keterangan]', '$id_dekopin')");
	} else {
		UploadGaleri($nama_lain);
		mysqli_query($koneksi, "insert into galeri(id_kategori,foto,keteranganid_dekopin)values('$_POST[id_kategori]','$nama_lain','$_POST[keterangan]', '$id_dekopin')");
	}
	header('location:home.php?menu=galeri');
}

if ($_GET['act'] == 'hapus_galeri') {
	mysqli_query($koneksi, "delete from galeri where id_galeri='$_GET[id]'");
	unlink("../galeri/$_GET[foto]");
	unlink("../galeri/small_$_GET[foto]");
	header('location:home.php?menu=galeri');
}

if ($_GET['act'] == 'tambah_menu') {
	$id_dekopin = $_SESSION['id_dekopin'];
	mysqli_query($koneksi, "insert into menu(nama_menu,link,aktif,publish,status_menu,id_dekopin)values('$_POST[nama_menu]','$_POST[link]','$_POST[aktif]','$_POST[publish]','$_POST[status_menu]', '$id_dekopin')");
	header('location:home.php?menu=menu');
}

if ($_GET['act'] == 'edit_menu') {
	mysqli_query($koneksi, "update menu set nama_menu='$_POST[nama_menu]',link='$_POST[link]',aktif='$_POST[aktif]',publish='$_POST[publish]',status_menu='$_POST[status_menu]' where id_menu='$_POST[id_menu]'");
	header('location:home.php?menu=menu');
}

if ($_GET['act'] == 'hapus_menu') {
	mysqli_query($koneksi, "delete from menu where id_menu='$_GET[id]'");
	header('location:home.php?menu=menu');
}

if ($_GET['act'] == 'edit_kategori_galeri') {
	mysqli_query($koneksi, "update kategori_galeri set judul='$_POST[judul]' where id_kategori='$_POST[id_kategori]'");
	header('location:home.php?menu=kategori_galeri');
}


if ($_GET['act'] == 'tambah_kategori_galeri') {
	$id_dekopin = $_SESSION['id_dekopin'];
	mysqli_query($koneksi, "insert into kategori_galeri(judul,id_dekopin)values('$_POST[judul]', '$id_dekopin')");
	header('location:home.php?menu=kategori_galeri');
}

if ($_GET['act'] == 'hapus_kategori_galeri') {
	mysqli_query($koneksi, "delete from kategori_galeri where id_kategori='$_GET[id]'");
	header('location:home.php?menu=kategori_galeri');
}

if ($_GET['act'] == 'tambah_kategori_berita') {
	$id_dekopin = $_SESSION['id_dekopin'];
	mysqli_query($koneksi, "insert into kategori_berita(nama_kategori,id_dekopin)values('$_POST[nama_kategori]','$id_dekopin')");
	header('location:home.php?menu=kategori_berita');
}

if ($_GET['act'] == 'edit_kategori_berita') {
	mysqli_query($koneksi, "update kategori_berita set nama_kategori='$_POST[nama_kategori]' where id_kategori='$_POST[id_kategori]'");
	header('location:home.php?menu=kategori_berita');
}

if ($_GET['act'] == 'hapus_kategori_berita') {
	mysqli_query($koneksi, "delete from kategori_berita where id_kategori='$_GET[id]'");
	header('location:home.php?menu=kategori_berita');
}

if ($_GET['act'] == 'tambah_agenda') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$tipe_file == $_FILES['foto']['type'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	$id_dekopin = $_SESSION['id_dekopin'];
	if (empty($lokasi_file)) {
		mysqli_query($koneksi, "insert into agenda(nama_agenda,tanggal_agenda,tanggal_selesai,jam,keterangan,id_dekopin)values('$_POST[nama_agenda]','$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]','$_POST[tahun_selesai]-$_POST[bulan_selesai]-$_POST[tanggal_selesai]','$_POST[jam]','$_POST[keterangan]','$id_dekopin')");
	} else {
		UploadAgenda($nama_lain);
		mysqli_query($koneksi, "insert into agenda(nama_agenda,tanggal_agenda,tanggal_selesai,jam,foto,keterangan,id_dekopin)values('$_POST[nama_agenda]','$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]','$_POST[tahun_selesai]-$_POST[bulan_selesai]-$_POST[tanggal_selesai]','$_POST[jam]','$nama_lain','$_POST[keterangan]','$id_dekopin')");
	}
	header('location:home.php?menu=agenda');
}

if ($_GET['act'] == 'hapus_agenda') {
	mysqli_query($koneksi, "delete from agenda where id_agenda='$_GET[id]'");
	unlink("../agenda/$_GET[foto]");
	unlink("../agenda/small_$_GET[foto]");
	header('location:home.php?menu=agenda');
}


if ($_GET['act'] == 'edit_agenda') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$tipe_file == $_FILES['foto']['type'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	if (empty($lokasi_file)) {
		mysqli_query($koneksi, "update agenda set nama_agenda='$_POST[nama_agenda]',tanggal_agenda='$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]',tanggal_selesai='$_POST[tahun_selesai]-$_POST[bulan_selesai]-$_POST[tanggal_selesai]', jam = '$_POST[jam]', keterangan='$_POST[keterangan]' where id_agenda='$_POST[id_agenda]'");
	} else {
		UploadAgenda($nama_lain);
		mysqli_query($koneksi, "update agenda set nama_agenda='$_POST[nama_agenda]',tanggal_agenda='$_POST[tahun_agenda]-$_POST[bulan_agenda]-$_POST[tanggal_agenda]',tanggal_selesai='$_POST[tahun_selesai]-$_POST[bulan_selesai]-$_POST[tanggal_selesai]', jam = '$_POST[jam]',foto='$nama_lain',keterangan='$_POST[keterangan]' where id_agenda='$_POST[id_agenda]'");
	}
	header('location:home.php?menu=agenda');
}

if ($_GET['act'] == 'edit_user') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	if (empty($lokasi_file) and empty($_POST['password'])) {
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
	} elseif (empty($_POST['password'])) {
		UploadFoto($nama_lain);
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',foto='$nama_lain',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
	} elseif (empty($lokasi_file)) {
		$password = md5($_POST['password']);
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',password='$password',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
	} else {
		$password = md5($_POST['password']);
		UploadFoto($nama_lain);
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',password='$password',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',foto='$nama_lain',status_user='$_POST[status_user]' where id_user='$_POST[id_user]'");
	}
	header('location:home.php?menu=user');
}

if ($_GET['act'] == 'edit_user_admin') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	$id_dekopin = $_POST['id_dekopin'];
	if (empty($lokasi_file) and empty($_POST['password'])) {
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',status_user='$_POST[status_user]',id_dekopin='$id_dekopin' where id_user='$_POST[id_user]'");
	} elseif (empty($_POST['password'])) {
		UploadFoto($nama_lain);
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',foto='$nama_lain',status_user='$_POST[status_user]',id_dekopin='$id_dekopin' where id_user='$_POST[id_user]'");
	} elseif (empty($lokasi_file)) {
		$password = md5($_POST['password']);
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',password='$password',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',status_user='$_POST[status_user]',id_dekopin='$id_dekopin' where id_user='$_POST[id_user]'");
	} else {
		$password = md5($_POST['password']);
		UploadFoto($nama_lain);
		mysqli_query($koneksi, "update user set username='$_POST[username]',nama='$_POST[nama]',password='$password',email='$_POST[email]',alamat='$_POST[alamat]',tanggal_lahir='$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]',foto='$nama_lain',status_user='$_POST[status_user]',id_dekopin='$id_dekopin' where id_user='$_POST[id_user]'");
	}
	header('location:home.php?menu=user');
}
if ($_GET['act'] == 'edit_dekopin') {
	mysqli_query($koneksi, "update dekopin set nama_dekopin='$_POST[nama_dekopin]',status_active='$_POST[status_active]' where id_dekopin='$_POST[id_dekopin]'");
	header('location:home.php?menu=dekopin');
}

if ($_GET['act'] == 'tambah_user') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	$id_dekopin = $_SESSION['id_dekopin'];
	if (empty($lokasi_file)) {
		$password = md5($_POST['password']);
		mysqli_query($koneksi, "insert into user(username,nama,password,email,alamat,tanggal_lahir,status_user,id_dekopin)values('$_POST[username]','$_POST[nama]','$password','$_POST[email]','$_POST[alamat]','$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]','$_POST[status_user]', '$id_dekopin')");
	} else {
		UploadFoto($nama_lain);
		$password = md5($_POST['password']);
		mysqli_query($koneksi, "insert into user(username,nama,password,email,alamat,tanggal_lahir,foto,status_user,id_dekopin)values('$_POST[username]','$_POST[nama]','$password','$_POST[email]','$_POST[alamat]','$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]','$nama_lain','$_POST[status_user]','$id_dekopin')");
	}
	header('location:home.php?menu=user');
}
if ($_GET['act'] == 'tambah_user_admin') {
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	$id_dekopin = $_POST['id_dekopin'];
	if (empty($lokasi_file)) {
		$password = md5($_POST['password']);
		mysqli_query($koneksi, "insert into user(username,nama,password,email,alamat,tanggal_lahir,status_user,id_dekopin)values('$_POST[username]','$_POST[nama]','$password','$_POST[email]','$_POST[alamat]','$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]','$_POST[status_user]', '$id_dekopin')");
	} else {
		UploadFoto($nama_lain);
		$password = md5($_POST['password']);
		mysqli_query($koneksi, "insert into user(username,nama,password,email,alamat,tanggal_lahir,foto,status_user,id_dekopin)values('$_POST[username]','$_POST[nama]','$password','$_POST[email]','$_POST[alamat]','$_POST[tahun_lahir]-$_POST[bulan_lahir]-$_POST[tanggal_lahir]','$nama_lain','$_POST[status_user]','$id_dekopin')");
	}
	header('location:home.php?menu=user');
}
if ($_GET['act'] == 'tambah_dekopin') {
	mysqli_query($koneksi, "insert into dekopin(nama_dekopin,status_active)values('$_POST[nama_dekopin]','$_POST[status_active]')");
	header('location:home.php?menu=dekopin');
}
if ($_GET['act'] == 'hapus_user') {
	$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from user where id_user='$_GET[id]'"));
	if ($data['foto'] == '') {
		mysqli_query($koneksi, "delete from user where id_user='$_GET[id]'");
	} else {
		mysqli_query($koneksi, "delete from user where id_user='$_GET[id]'");
		unlink("akun/$_GET[foto]");
		unlink("akun/small_$_GET[foto]");
	}
	header('location:home.php?menu=user');
}
if ($_GET['act'] == 'tambah_berita') {
	$tgl = date("Y-m-d");
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;
	$judul_seo      = seo_title($_POST['judul']);
	$id_dekopin = $_SESSION['id_dekopin'];
	if (empty($lokasi_file)) {
		mysqli_query($koneksi, "insert into berita(id_kategori,judul,judul_seo,keterangan,foto,tgl,id_user,username,hits,id_dekopin)values('" . $_POST['id_kategori'] . "','$_POST[judul]','$judul_seo','$_POST[keterangan]','','$tgl','$_SESSION[id_user]','$_SESSION[username]','0','$id_dekopin')");
	} else {
		// if ($tipe_file != "image/jpeg" and $tipe_file != "image/pjpeg") {
		// 	echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
		// window.location=('home.php?menu=tambah_berita')</script>";
		// } else {
		UploadBerita($nama_lain);
		mysqli_query($koneksi, "insert into berita(id_kategori,judul,judul_seo,keterangan,foto,tgl,id_user,username,hits,id_dekopin)values('" . $_POST['id_kategori'] . "','$_POST[judul]','$judul_seo','$_POST[keterangan]','$nama_lain','$tgl','$_SESSION[id_user]','$_SESSION[username]','0','$id_dekopin')");
		// }
	}
	header('location:home.php?menu=berita');
}

if ($_GET['act'] == 'edit_berita') {
	$tgl = date("Y-m-d");
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$acak = rand(00000, 99999);
	$nama_lain = $acak . $nama_file;

	$judul_seo      = seo_title($_POST['judul']);

	if (empty($lokasi_file)) {
		mysqli_query($koneksi, "update berita set id_kategori='$_POST[id_kategori]',judul='$_POST[judul]',judul_seo='$judul_seo',keterangan='$_POST[keterangan]',tgl='$tgl',id_user='$_SESSION[id_user]',username='$_SESSION[username]' where id_berita='$_POST[id_berita]'");
	} else {
		// if ($tipe_file != "image/jpeg" and $tipe_file != "image/pjpeg") {
		// 	echo "<script>alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
		// window.location=('home.php?menu=edit_berita')</script>";
		// } else {
		UploadBerita($nama_lain);
		mysqli_query($koneksi, "update berita set id_kategori='$_POST[id_kategori]',judul='$_POST[judul]',judul_seo='$judul_seo',keterangan='$_POST[keterangan]',foto='$nama_lain',tgl='$tgl',id_user='$_SESSION[id_user]',username='$_SESSION[username]' where id_berita='$_POST[id_berita]'");
		// }
	}
	header('location:home.php?menu=berita');
}

if ($_GET['act'] == 'hapus_berita') {
	$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from berita where id_berita='$_GET[id]'"));
	if ($data['foto'] == '') {
		mysqli_query($koneksi, "delete from berita where id_berita='$_GET[id]'");
	} else {
		mysqli_query($koneksi, "delete from berita where id_berita='$_GET[id]'");
		unlink("../berita/$_GET[foto]");
		unlink("../berita/small_$_GET[foto]");
	}
	header('location:home.php?menu=berita');
}
