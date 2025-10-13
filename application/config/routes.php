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
$route['admin/akun/dosen'] = 'admin/akun_dosen';
$route['admin/akun/dosen/tambah'] = 'admin/akun_dosen_tambah';
$route['admin/akun/dosen/edit/(:num)'] = 'admin/akun_dosen_edit/$1';
$route['admin/akun/dosen/hapus/(:num)'] = 'admin/akun_dosen_hapus/$1';
$route['admin/akun/mahasiswa'] = 'akun/mahasiswa';
$route['admin/akun/mahasiswa/tambah'] = 'akun/tambah_mahasiswa';
$route['admin/akun/mahasiswa/simpan'] = 'akun/simpan_mahasiswa';
$route['admin/akun/mahasiswa/edit/(:num)'] = 'akun/edit_mahasiswa/$1';
$route['admin/akun/mahasiswa/update/(:num)'] = 'akun/update_mahasiswa/$1';
$route['admin/akun/mahasiswa/hapus/(:num)'] = 'akun/hapus_mahasiswa/$1';

// Skripsi
$route['admin/skripsi'] = 'admin/skripsi/index';
$route['admin/skripsi/tambah'] = 'admin/skripsi/tambah';
$route['admin/skripsi/simpan'] = 'admin/skripsi/simpan';
$route['admin/skripsi/edit/(:num)'] = 'admin/skripsi/edit/$1';
$route['admin/skripsi/hapus/(:num)'] = 'admin/skripsi/hapus/$1';

// Validasi Berkas
$route['admin/validasi_berkas'] = 'admin/validasi_berkas/index';

// Jadwal Ujian Skripsi
$route['admin/jadwal_ujian'] = 'admin/jadwal_ujian/index';

$route['admin/validasi_ujian'] = 'validasi_ujian/index';
$route['admin/validasi_ujian/setujui/(:num)'] = 'validasi_ujian/setujui/$1';
$route['admin/validasi_ujian/revisi/(:num)'] = 'validasi_ujian/revisi/$1';

// login mahasiswa
$route['mahasiswa'] = 'mahasiswa/index';
$route['mahasiswa/(:any)'] = 'mahasiswa/$1';
$route['auth/mahasiswa'] = 'auth/mahasiswa';
$route['auth/dosen'] = 'auth/dosen';
$route['auth'] = 'auth/index';

