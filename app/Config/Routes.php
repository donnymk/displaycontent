<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// admin outlet
$routes->get('/', 'AO::index');
$routes->get('formlogin_ao', 'AOAuth::formlogin_adminoutlet');
$routes->post('login_ao', 'AOAuth::login_adminoutlet');
$routes->get('konten_ao', 'AO::konten_ao');
$routes->post('input_konten', 'AO::insert_konten');
$routes->get('delkonten_ao/(:num)', 'AO::delkonten/$1');
$routes->get('logout_ao', 'AO::logout_ao');
$routes->get('get_content_ao_ajax', 'AOAjax::get_content');
$routes->get('activate_content_ao/(:num)', 'AO::activate_content/$1');
$routes->get('deactivate_content_ao/(:num)', 'AO::deactivate_content/$1');
$routes->get('view_running_text/(:num)', 'AO::view_running_text/$1');

// client
$routes->get('formlogin_c', 'ClientAuth::formlogin_client');
$routes->post('login_c', 'ClientAuth::login_client');
$routes->get('home_c', 'Client::index');
$routes->get('get_content_active_ajax', 'AOAjax::get_content_active');
$routes->get('get_client_api/(:alphanum)', 'ClientAuth::get_client_api/$1');
$routes->get('get_videos_api/(:num)', 'Client::get_videos_api/$1');
$routes->get('get_images_api/(:num)', 'Client::get_images_api/$1');
$routes->get('logout_c', 'Client::logout_c');

// superadmin
$routes->get('home_sa', 'Superadmin::index');
$routes->get('formlogin_sa', 'SuperadminAuth::formlogin_superadmin');
$routes->post('login_sa', 'SuperadminAuth::login_superadmin');
$routes->post('input_outlet', 'Superadmin::insert_outlet');
$routes->get('del_outlet/(:num)', 'Superadmin::delete_outlet/$1');
$routes->get('logout_sa', 'Superadmin::logout_superadmin');
$routes->get('reset_passw_outlet/(:num)', 'Superadmin::resetpassw_outlet/$1');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
