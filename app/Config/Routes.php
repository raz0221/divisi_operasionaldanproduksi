<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/dataKaryawan', 'Page::dataKaryawan'); // Update ini
$routes->get('/news', 'News::index');
$routes->get('/news/(:any)', 'News::viewNews/$1');

// Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/processLogin', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Admin Routes
$routes->get('/admin/dashboard', 'Admin::dashboard');

$routes->group('admin', function($routes){
    // NewsAdmin Routes
    $routes->get('news', 'NewsAdmin::index');
    $routes->get('news/(:segment)/preview', 'NewsAdmin::preview/$1');
    $routes->add('news/new', 'NewsAdmin::create');
    $routes->add('news/(:segment)/edit', 'NewsAdmin::edit/$1');
    $routes->get('news/(:segment)/delete', 'NewsAdmin::delete/$1');
    
    // Pegawai Routes - CRUD
    $routes->get('pegawai', 'Admin\Pegawai::index');
    $routes->get('pegawai/create', 'Admin\Pegawai::create');
    $routes->post('pegawai/store', 'Admin\Pegawai::store');
    $routes->get('pegawai/edit/(:num)', 'Admin\Pegawai::edit/$1');
    $routes->post('pegawai/update/(:num)', 'Admin\Pegawai::update/$1');
    $routes->get('pegawai/delete/(:num)', 'Admin\Pegawai::delete/$1');
});