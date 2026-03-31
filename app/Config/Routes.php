<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::index');

    // Kategori
    $routes->get('/kategori', 'KategoriController::index');
    $routes->post('/kategori/store', 'KategoriController::store');
    $routes->post('/kategori/update/(:num)', 'KategoriController::update/$1');
    $routes->get('/kategori/delete/(:num)', 'KategoriController::delete/$1');

    // Buku
    $routes->get('/buku', 'BukuController::index');
    $routes->get('/buku/create', 'BukuController::create');
    $routes->post('/buku/store', 'BukuController::store');
    $routes->get('/buku/edit/(:num)', 'BukuController::edit/$1');
    $routes->post('/buku/update/(:num)', 'BukuController::update/$1');
    $routes->get('/buku/delete/(:num)', 'BukuController::delete/$1');
    // Peminjaman
    $routes->get('/transaksi', 'PeminjamanController::index');
    $routes->get('/transaksi/pinjam', 'PeminjamanController::pinjam');
    $routes->post('/transaksi/store', 'PeminjamanController::store');
    $routes->get('/transaksi/kembali/(:num)', 'PeminjamanController::kembali/$1');
    // Member Features
    $routes->get('/katalog', 'KatalogController::index');
    $routes->get('/pinjaman-saya', 'PeminjamanController::pinjamanSaya');
    // User Management
    $routes->get('/users', 'UserController::index');
    $routes->post('/users/store', 'UserController::store');
    $routes->post('/users/update/(:num)', 'UserController::update/$1');
    $routes->get('/users/delete/(:num)', 'UserController::delete/$1');

    // Payment (Simulated)
    $routes->get('/payment/pay/(:num)', 'PaymentController::pay/$1');
    $routes->post('/payment/process/(:any)', 'PaymentController::process/$1');
    $routes->get('/payment/success/(:any)', 'PaymentController::success/$1');

    // Payment (Internal - Old Midtrans)
    // $routes->post('/payment/getToken', 'PaymentController::getToken');
});

// Payment (External/Webhook)
$routes->post('/payment/notification', 'PaymentController::notification');
