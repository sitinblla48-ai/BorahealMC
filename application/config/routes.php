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
$route['default_controller'] = 'auth/pasien_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Separate Logins
$route['admin/login'] = 'auth/admin_login';
$route['pasien/login'] = 'auth/pasien_login';

// Separate Logouts
$route['admin/logout'] = 'auth/admin_logout';
$route['pasien/logout'] = 'auth/pasien_logout';

// Dashboard & Pages
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/pasien'] = 'admin/pasien';
$route['admin/pasien_create'] = 'admin/pasien_create';
$route['admin/pasien_edit/(:num)'] = 'admin/pasien_edit/$1';
$route['admin/pasien_delete/(:num)'] = 'admin/pasien_delete/$1';
$route['admin/jadwal'] = 'admin/jadwal';
$route['admin/setujui_pendaftaran/(:num)'] = 'admin/setujui_pendaftaran/$1';
$route['admin/tolak_pendaftaran/(:num)'] = 'admin/tolak_pendaftaran/$1';

$route['admin/laporan'] = 'laporan/index';
$route['admin/ekspor_pdf'] = 'laporan/ekspor_pdf';
$route['admin/ekspor_csv'] = 'laporan/ekspor_csv';

$route['pasien/dashboard'] = 'pasien/dashboard';
$route['pasien/daftar'] = 'pasien/daftar';
