<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Register::index');
$routes->post('/regUser', 'Register::index');
$routes->get('/regUser',"Register::index");
$routes->get('/profile', 'Profile::index');
$routes->get('/admin', 'Admin::index');
$routes->post('/admin/createAdmin', 'Admin::createAdmin');
$routes->post('/admin/createMedia', 'Admin::createMedia');
$routes->post('/admin/deleteUser/(:any)', 'Admin::deleteUser/$1');
$routes->post('/admin/deleteMedia/(:any)', 'Admin::deleteMedia/$1');
$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');
$routes->post('/profile/updateUser', 'Profile::updateUser');
$routes->get('/film/reszletek/(:num)', 'Home::reszletek/$1');
$routes->get('/home/filter', 'Home::filter');
$routes->post('/profile/updateUserPicture/(:num)', 'Profile::updateUserPicture/$1');
$routes->post('/login/adminAuthenticate', 'Login::adminAuthenticate');