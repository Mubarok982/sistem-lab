<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#AUTH
$route['auth'] = 'auth/index';
$route['auth/mahasiswa'] = 'auth/mahasiswa';
$route['auth/dosen'] = 'auth/dosen';

#ADMIN 
$route['admin'] = 'admin/dashboard';
$route['admin/akun'] = 'admin/akun';
$route['admin/akun/dosen'] = 'admin/akun/dosen';
$route['admin/akun/dosen/tambah'] = 'admin/akun/tambah_dosen';
$route['admin/akun/dosen/edit/(:num)'] = 'admin/akun/edit_dosen/$1';
$route['admin/akun/dosen/hapus/(:num)'] = 'admin/akun/hapus_dosen/$1';

$route['admin/akun/mahasiswa'] = 'admin/akun/mahasiswa';
$route['admin/akun/mahasiswa/tambah'] = 'admin/akun/tambah_mahasiswa';
$route['admin/akun/mahasiswa/edit/(:num)'] = 'admin/akun/edit_mahasiswa/$1';
$route['admin/akun/mahasiswa/hapus/(:num)'] = 'admin/akun/hapus_mahasiswa/$1';

$route['admin/skripsi'] = 'admin/skripsi/index';
$route['admin/skripsi/tambah'] = 'admin/skripsi/tambah';
$route['admin/skripsi/edit/(:num)'] = 'admin/skripsi/edit/$1';
$route['admin/skripsi/hapus/(:num)'] = 'admin/skripsi/hapus/$1';

$route['admin/validasi_berkas'] = 'admin/validasi_berkas/index';
$route['admin/validasi_ujian'] = 'admin/validasi_ujian/index';
$route['admin/validasi_ujian/setujui/(:num)'] = 'admin/validasi_ujian/setujui/$1';
$route['admin/validasi_ujian/revisi/(:num)'] = 'admin/validasi_ujian/revisi/$1';

$route['admin/jadwal_ujian'] = 'admin/jadwal_ujian_dosen/index';
$route['admin/rekap_nilai'] = 'admin/rekap_nilai/index';
$route['admin/penetapan_penguji'] = 'admin/penetapan_penguji/index';

#DOSEN 
$route['dosen'] = 'dosen/dashboard';
$route['dosen/dashboard'] = 'dosen/dashboard';
$route['dosen/jadwal_ujian'] = 'dosen/jadwal_ujian_dosen/index';
$route['dosen/mahasiswa_bimbingan'] = 'dosen/mahasiswa_bimbingan/index';
$route['dosen/penilaian_ujian'] = 'dosen/penilaian_ujian_dosen/index';
$route['dosen/penilaian_ujian/nilai/(:num)'] = 'dosen/penilaian_ujian_dosen/nilai/$1';
$route['dosen/penilaian_ujian/simpan'] = 'dosen/penilaian_ujian_dosen/simpan_nilai';

// Routing untuk Mahasiswa
$route['mahasiswa/dashboard']           = 'mahasiswa/mahasiswa/index';
$route['mahasiswa/profil']              = 'mahasiswa/profil/index';
$route['mahasiswa/pengajuan']           = 'mahasiswa/pengajuan/index';
$route['mahasiswa/pendaftaran_sempro'] = 'mahasiswa/ujian/sempro';
$route['mahasiswa/pendaftaran_ujian']  = 'mahasiswa/ujian/sidang';
$route['mahasiswa/validasi/sempro']     = 'mahasiswa/validasi/sempro';
$route['mahasiswa/validasi/pendadaran'] = 'mahasiswa/validasi/pendadaran';
$route['mahasiswa/logout']              = 'mahasiswa/auth/logout';


