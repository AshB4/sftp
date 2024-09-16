<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;
use Config\Services;  

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->get('/', 'Home::index');
$routes->get('admin/clients/all_leads/(:num)', 'Admin\Clients::all_leads/$1');
$routes->get('whatconvertsintegration/fetchleads', 'WhatConvertsIntegration::fetchLeads'); 
$routes->get('whatconvertsintegration/exampleCronOperations', 'Tests\ExampleCronOperations::exampleCronOperations');
$routes->get('whatconvertsintegration/testCronStatusModel', 'WhatConvertsIntegration::testCronStatusModel');
$routes->get('admin/users/toggle/(:num)', 'Admin\Users::toggle_user_is_active/$1');
$routes->get('check-environment', function() {
    echo ENVIRONMENT;
});




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * You can add additional routing configurations for specific environments.
 * Load additional route files here if necessary, based on your environment.
 * You have access to `$routes` within that file without needing to re-declare it.
 */

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
