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
$routes->get('/dataKaryawan', 'Page::dataKaryawan');
$routes->get('aktivitas', 'Page::aktivitas');
$routes->get('biodata', 'Page::biodata');
$routes->get('riwayat-pendidikan', 'Page::riwayatPendidikan');
$routes->get('/news', 'News::index');
$routes->get('/news/(:any)', 'News::viewNews/$1');

// Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/processLogin', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');

// Admin Routes
$routes->get('/admin/dashboard', 'Admin::dashboard');

$routes->group('admin', function($routes){
    // NewsAdmin Routes - pola: delete/(:segment)
    $routes->get('news', 'NewsAdmin::index');
    $routes->get('news/(:segment)/preview', 'NewsAdmin::preview/$1');
    $routes->add('news/new', 'NewsAdmin::create');
    $routes->add('news/(:segment)/edit', 'NewsAdmin::edit/$1');
    $routes->get('news/(:segment)/delete', 'NewsAdmin::delete/$1');
    
    // Routes untuk Biodata - mengikuti pola NewsAdmin
    $routes->get('biodata', 'Admin\Biodata::index');
    $routes->get('biodata/create', 'Admin\Biodata::create');
    $routes->post('biodata/store', 'Admin\Biodata::store');
    $routes->get('biodata/edit/(:num)', 'Admin\Biodata::edit/$1');      // Diubah
    $routes->post('biodata/update/(:num)', 'Admin\Biodata::update/$1');  // Diubah
    $routes->get('biodata/delete/(:num)', 'Admin\Biodata::delete/$1');   // Diubah
    
    // Routes untuk Aktivitas Harian - mengikuti pola NewsAdmin
    $routes->get('aktivitas-harian', 'Admin\AktivitasHarian::index');
    $routes->get('aktivitas-harian/create', 'Admin\AktivitasHarian::create');
    $routes->post('aktivitas-harian/store', 'Admin\AktivitasHarian::store');
    $routes->get('aktivitas-harian/edit/(:num)', 'Admin\AktivitasHarian::edit/$1');      // Diubah
    $routes->post('aktivitas-harian/update/(:num)', 'Admin\AktivitasHarian::update/$1');  // Diubah
    $routes->get('aktivitas-harian/delete/(:num)', 'Admin\AktivitasHarian::delete/$1');   // Diubah
    
    // Routes untuk Riwayat Pendidikan - mengikuti pola NewsAdmin
    $routes->get('riwayat-pendidikan', 'Admin\RiwayatPendidikan::index');
    $routes->get('riwayat-pendidikan/create', 'Admin\RiwayatPendidikan::create');
    $routes->post('riwayat-pendidikan/store', 'Admin\RiwayatPendidikan::store');
    $routes->get('riwayat-pendidikan/edit/(:num)', 'Admin\RiwayatPendidikan::edit/$1');      // Diubah
    $routes->post('riwayat-pendidikan/update/(:num)', 'Admin\RiwayatPendidikan::update/$1');  // Diubah
    $routes->get('riwayat-pendidikan/delete/(:num)', 'Admin\RiwayatPendidikan::delete/$1');   // Diubah
    
    // Routes untuk Pegawai - mengikuti pola NewsAdmin
    $routes->get('pegawai', 'Admin\Pegawai::index');
    $routes->get('pegawai/create', 'Admin\Pegawai::create');
    $routes->post('pegawai/store', 'Admin\Pegawai::store');
    $routes->get('pegawai/edit/(:num)', 'Admin\Pegawai::edit/$1');      // Diubah
    $routes->post('pegawai/update/(:num)', 'Admin\Pegawai::update/$1');  // Diubah
    $routes->get('pegawai/delete/(:num)', 'Admin\Pegawai::delete/$1');   // Diubah
});