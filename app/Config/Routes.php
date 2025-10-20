<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman utama langsung ke dashboard
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard/getChartData/(:any)/(:any)', 'Dashboard::getChartData/$1/$2');
$routes->get('dashboard/grafikKeluar', 'Dashboard::grafikKeluar');



$routes->get('produk', 'Produk::index');
$routes->get('produk/create', 'Produk::create');
$routes->post('produk/store', 'Produk::store');
$routes->get('produk/edit/(:num)', 'Produk::edit/$1');
$routes->post('produk/update/(:num)', 'Produk::update/$1');
$routes->get('produk/delete/(:num)', 'Produk::delete/$1');


$routes->get('transaksi', 'Transaksi::index');
$routes->get('transaksi/create', 'Transaksi::create');
$routes->post('transaksi/store', 'Transaksi::store');
$routes->get('transaksi/delete/(:num)', 'Transaksi::delete/$1');


