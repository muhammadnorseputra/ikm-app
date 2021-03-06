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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';

// SKM
$route['skm'] = 'frontend/skm/skmIndex';
$route['laporan'] = 'frontend/skm/skmLaporan';
$route['cetak'] = 'frontend/skm/skmIndex/cetakFormulir/$1';
$route['ikm'] = 'frontend/skm/skmIndex/ikm';
$route['survei'] = 'frontend/skm/skmIndex/survei';
$route['finish/(:any)'] = 'frontend/skm/skmProses/selesai/$1';
$route['invalid/(:any)'] = 'frontend/skm/skmProses/invalid/$1';
$route['closed'] = 'frontend/skm/skmIndex/closed';

// BACKEND
$route['console'] = 'backend/login';
$route['logout'] = 'backend/login/sign_out';
$route['dashboard'] = 'backend/console';
$route['responden'] = 'backend/responden';
$route['periode'] = 'backend/periode';
$route['periode/edit/(:any)'] = 'backend/periode/edit/$1';
$route['pertanyaan'] = 'backend/pertanyaan';
$route['pertanyaan/baru'] = 'backend/pertanyaan/baru';
$route['pertanyaan/edit/(:any)'] = 'backend/pertanyaan/edit/$1';
$route['jawaban'] = 'backend/jawaban';
$route['jawaban/edit/(:any)'] = 'backend/jawaban/edit/$1';
$route['hapus/(:any)'] = 'backend/jawaban/hapus/$1';
$route['unsur'] = 'backend/unsur';
$route['unsur/edit/(:any)'] = 'backend/unsur/edit/$1';
$route['jenis_layanan'] = 'backend/jenis_layanan';
$route['jenis_layanan/baru'] = 'backend/jenis_layanan/baru';
$route['pendidikan'] = 'backend/pendidikan';
$route['pekerjaan'] = 'backend/pekerjaan';
$route['users'] = 'backend/users';
$route['users/baru'] = 'backend/users/baru';
$route['profile/(:any)'] = 'backend/users/profile/$1';
$route['preferensi/(:any)'] = 'backend/users/preferensi/$1';
$route['preferensi/(:any)/update'] = 'backend/users/preferensi/$1/update';
 

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

