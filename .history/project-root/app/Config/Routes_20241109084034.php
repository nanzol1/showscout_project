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
$routes->post('/admin/createAdmin', 'Admin::index');
