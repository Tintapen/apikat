<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['user/dashboard'] = 'admin/dashboard';
$route['user/perangkat'] = 'admin/perangkat';

$route['user/peminjaman'] = 'admin/peminjaman';
$route['user/peminjaman/kelola/(:num)'] = 'admin/peminjaman/kelola/$1';
$route['user/peminjaman/cetakdisetujui/(:num)'] = 'admin/peminjaman/cetakdisetujui/$1';
$route['user/peminjaman/delete/(:num)'] = 'admin/peminjaman/delete/$1';
$route['user/peminjaman/deletecart/(:num)'] = 'admin/peminjaman/deletecart/$1';
$route['user/peminjaman/respon/(:num)'] = 'admin/peminjaman/respon/$1';
$route['user/peminjaman/tambah'] = 'admin/peminjaman/kelola';
$route['user/peminjaman/insert'] = 'admin/peminjaman/insert';
$route['admin/peminjaman/tambah'] = 'admin/peminjaman/kelola';

$route['user/profil'] = 'admin/profil';
$route['user/profil/update/(:num)'] = 'admin/profil/update/$1';

$route['user/notifikasi/user'] = 'admin/notifikasi/user';
$route['user/notifikasi/dibaca'] = 'admin/notifikasi/dibaca';
