<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin'] = 'auth/login';
$route['admin/dashboard'] = 'dashboard';
$route['admin/parking/create'] = 'parking/create';
$route['admin/parking'] = 'parking';
$route['admin/parking/print_invoice/(:any)'] = 'parking/print_invoice/$1';
$route['admin/category/delete/(:any)'] = 'category/delete/$1';
$route['admin/rates/delete/(:any)'] = 'rates/delete/$1';
$route['admin/slots/delete/(:any)'] = 'slots/delete/$1';
$route['admin/parking/delete/(:any)'] = 'parking/delete/$1';
$route['admin/groups/delete/(:any)'] = 'groups/delete/$1';
$route['admin/users/delete/(:any)'] = 'users/delete/$1';
$route['admin/reports'] = 'reports';
$route['admin/users/create'] = 'users/create';
$route['admin/users'] = 'users';
$route['admin/users/edit/(:any)'] = 'users/edit/$1';
$route['admin/groups'] = 'groups';
$route['admin/groups/create'] = 'groups/create';
$route['admin/groups/edit/(:any)'] = 'groups/edit/$1';
$route['admin/category/create'] = 'category/create';
$route['admin/category'] = 'category';
$route['admin/category/edit/(:any)'] = 'category/edit/$1';
$route['admin/rates/create'] = 'rates/create';
$route['admin/rates'] = 'rates';
$route['admin/rates/edit/(:any)'] = 'rates/edit/$1';
$route['admin/slots/create'] = 'slots/create';
$route['admin/slots'] = 'slots';
$route['admin/slots/edit/(:any)'] = 'slots/edit/$1';
$route['admin/company'] = 'company';
$route['admin/users/profile'] = 'users/profile';
$route['admin/users/setting'] = 'users/setting';

$route['default_controller'] = 'welcome';
$route['contact'] = 'welcome/contact';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
