<?php
function UploadImage($fupload_name) {
  // Direktori gambar
  $vdir_upload = "../profil/";
  $vfile_upload = $vdir_upload . $fupload_name;

  // Simpan gambar dalam ukuran sebenarnya
  if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload)) {
    die("Failed to upload image.");
  }

  // Tentukan jenis file dan buat image resource sesuai dengan jenis file tersebut
  $image_info = getimagesize($vfile_upload);
  $image_type = $image_info[2];

  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $im_src = @imagecreatefromjpeg($vfile_upload);
      $output_function = 'imagejpeg';
      break;
    case IMAGETYPE_PNG:
      $im_src = @imagecreatefrompng($vfile_upload);
      $output_function = 'imagepng';
      break;
    case IMAGETYPE_GIF:
      $im_src = @imagecreatefromgif($vfile_upload);
      $output_function = 'imagegif';
      break;
    default:
      die("Unsupported image type.");
  }

  if (!$im_src) {
    die("Failed to create image from file.");
  }

  $src_width = imagesx($im_src);
  $src_height = imagesy($im_src);

  // Simpan dalam versi small 350 pixel
  $dst_width = 500;
  $dst_height = ($dst_width / $src_width) * $src_height;

  // Proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width, $dst_height);
  if (!imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height)) {
    die("Failed to resample the image.");
  }

  // Simpan gambar
  $output_path = $vdir_upload . "small_" . $fupload_name;
  $output_function($im, $output_path);

  // Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


function UploadGaleri($fupload_name) {
  // Direktori gambar
  $vdir_upload = "../galeri/";
  $vfile_upload = $vdir_upload . $fupload_name;

  // Simpan gambar dalam ukuran sebenarnya
  if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload)) {
    die("Failed to upload image.");
  }

  // Tentukan jenis file dan buat image resource sesuai dengan jenis file tersebut
  $image_info = getimagesize($vfile_upload);
  $image_type = $image_info[2];

  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $im_src = @imagecreatefromjpeg($vfile_upload);
      $output_function = 'imagejpeg';
      break;
    case IMAGETYPE_PNG:
      $im_src = @imagecreatefrompng($vfile_upload);
      $output_function = 'imagepng';
      break;
    case IMAGETYPE_GIF:
      $im_src = @imagecreatefromgif($vfile_upload);
      $output_function = 'imagegif';
      break;
    default:
      die("Unsupported image type.");
  }

  if (!$im_src) {
    die("Failed to create image from file.");
  }

  $src_width = imagesx($im_src);
  $src_height = imagesy($im_src);

  // Simpan dalam versi small 200 pixel
  $dst_width = 200;
  $dst_height = ($dst_width / $src_width) * $src_height;

  // Proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width, $dst_height);
  if (!imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height)) {
    die("Failed to resample the image.");
  }

  // Simpan gambar
  $output_path = $vdir_upload . "small_" . $fupload_name;
  $output_function($im, $output_path);

  // Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


function UploadFoto($fupload_name) {

  // Direktori gambar
  $vdir_upload = "akun/";
  $vfile_upload = $vdir_upload . $fupload_name;

  // Simpan gambar dalam ukuran sebenarnya
  if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload)) {
    die("Failed to upload image.");
  }

  // Tentukan jenis file dan buat image resource sesuai dengan jenis file tersebut
  $image_info = getimagesize($vfile_upload);
  $image_type = $image_info[2];

  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $im_src = imagecreatefromjpeg($vfile_upload);
      break;
    case IMAGETYPE_PNG:
      $im_src = imagecreatefrompng($vfile_upload);
      break;
    case IMAGETYPE_GIF:
      $im_src = imagecreatefromgif($vfile_upload);
      break;
    default:
      die("Unsupported image type.");
  }

  if (!$im_src) {
    die("Failed to create image from file.");
  }

  $src_width = imagesx($im_src);
  $src_height = imagesy($im_src);

  // Simpan dalam versi small 250 pixel
  $dst_width = 250;
  $dst_height = ($dst_width / $src_width) * $src_height;

  // Proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width, $dst_height);
  if (!imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height)) {
    die("Failed to resample the image.");
  }

  // Simpan gambar sesuai dengan format asli
  switch ($image_type) {
    case IMAGETYPE_JPEG:
      imagejpeg($im, $vdir_upload . "small_" . $fupload_name);
      break;
    case IMAGETYPE_PNG:
      imagepng($im, $vdir_upload . "small_" . $fupload_name);
      break;
    case IMAGETYPE_GIF:
      imagegif($im, $vdir_upload . "small_" . $fupload_name);
      break;
  }

  // Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


function UploadBerita($fupload_name){
  // Direktori gambar
  $vdir_upload = "../berita/";
  $vfile_upload = $vdir_upload . $fupload_name;

  // Simpan gambar dalam ukuran sebenarnya
  if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload)) {
    die("Failed to upload image.");
  }

  // Tentukan jenis file dan buat image resource sesuai dengan jenis file tersebut
  $image_info = getimagesize($vfile_upload);
  $image_type = $image_info[2];

  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $im_src = @imagecreatefromjpeg($vfile_upload);
      break;
    case IMAGETYPE_PNG:
      $im_src = @imagecreatefrompng($vfile_upload);
      break;
    case IMAGETYPE_GIF:
      $im_src = @imagecreatefromgif($vfile_upload);
      break;
    default:
      die("Unsupported image type.");
  }

  if (!$im_src) {
    die("Failed to create image from file.");
  }

  $src_width = imagesx($im_src);
  $src_height = imagesy($im_src);

  // Simpan dalam versi small 350 pixel
  $dst_width = 350;
  $dst_height = ($dst_width / $src_width) * $src_height;

  // Proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width, $dst_height);
  if (!imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height)) {
    die("Failed to resample the image.");
  }

  // Simpan gambar sesuai dengan format asli
  switch ($image_type) {
    case IMAGETYPE_JPEG:
      imagejpeg($im, $vdir_upload . "small_" . $fupload_name);
      break;
    case IMAGETYPE_PNG:
      imagepng($im, $vdir_upload . "small_" . $fupload_name);
      break;
    case IMAGETYPE_GIF:
      imagegif($im, $vdir_upload . "small_" . $fupload_name);
      break;
  }

  // Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


function UploadAgenda($fupload_name) {
  // Direktori gambar
  $vdir_upload = "../agenda/";
  $vfile_upload = $vdir_upload . $fupload_name;

  // Simpan gambar dalam ukuran sebenarnya
  if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $vfile_upload)) {
    die("Failed to upload image.");
  }

  // Tentukan jenis file dan buat image resource sesuai dengan jenis file tersebut
  $image_info = getimagesize($vfile_upload);
  $image_type = $image_info[2];

  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $im_src = @imagecreatefromjpeg($vfile_upload);
      $output_function = 'imagejpeg';
      break;
    case IMAGETYPE_PNG:
      $im_src = @imagecreatefrompng($vfile_upload);
      $output_function = 'imagepng';
      break;
    case IMAGETYPE_GIF:
      $im_src = @imagecreatefromgif($vfile_upload);
      $output_function = 'imagegif';
      break;
    default:
      die("Unsupported image type.");
  }

  if (!$im_src) {
    die("Failed to create image from file.");
  }

  $src_width = imagesx($im_src);
  $src_height = imagesy($im_src);

  // Simpan dalam versi small 200 pixel
  $dst_width = 200;
  $dst_height = ($dst_width / $src_width) * $src_height;

  // Proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width, $dst_height);
  if (!imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height)) {
    die("Failed to resample the image.");
  }

  // Simpan gambar dengan format yang sama seperti file asli
  $output_path = $vdir_upload . "small_" . $fupload_name;
  $output_function($im, $output_path);

  // Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


?>
