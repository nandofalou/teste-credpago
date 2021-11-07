<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('sync', 'Home::sync');

$routes->get('/', 'Home::index', ['filter' => 'authFilter']);

$routes->get('signin', 'User::signin');
$routes->post('signin', 'User::login');
$routes->get('signup', 'User::signup');
$routes->post('signup', 'User::register');
$routes->get('logout', 'User::logout');

$routes->get('passwordrecovery', 'User::passwordrecovery');
$routes->post('passwordrecovery', 'User::sendpasswordrecovery');
$routes->get('resetpassword/(:any)', 'User::resetpassword/$1');
$routes->post('resetpassword/(:any)', 'User::changepassword/$1');


$routes->group('/', ['filter' => 'authFilter'], function($routes) {
    $routes->get('site', 'Site::site');
    $routes->post('site', 'Site::addsite');
    $routes->get('site/track', 'Site::track');
    $routes->get('site/(:num)/delete', 'Site::remove/$1');
    $routes->get('site/(:num)', 'Site::view/$1');
    $routes->post('site/(:num)', 'Site::editsite/$1');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
