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
$routes->get('/', 'Home::index',['as' => 'home']);

$routes->get('lang/{locale}', 'Language::index');

$routes->get('/search/(:segment)', 'Search::index/$1');

// Route to Apply for new connexion
$routes->group('/connection',['namespace' => 'App\Controllers\Connection'], static function ($routes) {
    // View route for connection form
    $routes->get('', 'Connection::index', ['as' => 'connection']);
    // Post route for connection submit
    $routes->post('', 'Connection::save', ['as' => 'connection_save']);
    // Post route for connection search follow up
    $routes->post('follow', 'Connection::follow_middleware',  ['as' => 'follow']);
    // Get Route for connection follow up view
    $routes->get('follow/(:num)', 'Connection::follow/$1');

    $routes->match(['get', 'post'] ,'(:num)/(:alphanum)', 'Connection::show/$1/$2');
});


$routes->group('/attachments', ['namespace' => 'App\Controllers\Connection'], function($routes) {
    $routes->get('preview/(:num)', 'AttachmentController::preview/$1');
    $routes->get('download/(:num)', 'AttachmentController::download/$1');
});

// Route to Apply for Claims request
$routes->group('/claims',['namespace' => 'App\Controllers\claim'], static function ($routes) {
    $routes->get('', 'claim::index', ['as' => 'claims']);
    $routes->post('', 'claim::store', ['as' => 'claims_store']);
});


// Route to Apply for new e-bill subscription
$routes->group('/ebills',['namespace' => 'App\Controllers\Subscription'], static function ($routes) {
    $routes->get('/subscription', 'Subscription::index', ['as' => 'subscription']);
    $routes->post('/subscription', 'Subscription::store', ['as' => 'subscription_store']);
});

$routes->cli('tasks_full','Tasks::tasks_full');
$routes->cli('tasks_one','Tasks::tasks_one');
$routes->cli('tasks_index','Tasks::tasks_index');
$routes->cli('tasks_attach','Tasks::tasks_attach');
$routes->cli('tasks_open','Tasks::tasks_open');

//$routes->cli('index','Tasks::index');
//$routes->cli('attachment','Tasks::attachment');
//$routes->cli('open','Tasks::open');

//$routes->cli('update','Tasks::update');

//$routes->cli('test_attachment','Tasks::attachment_test');

//$routes->cli('tasks_notify','Tasks::notify');
//$routes->cli('tasks_update_user_information','Tasks::update_user_information');


// $routes->get('manual_tasks', 'Tasks::tasks');
// $routes->match(['get','post'],'manual_index', 'Tasks::index');
// $routes->match(['get','post'],'manual_attachment', 'Tasks::attachment');
// $routes->match(['get','post'],'manual_open', 'Tasks::open');
// $routes->match(['get','post'],'manual_error', 'Tasks::error');
// $routes->match(['get','post'],'manual_update', 'Tasks::update');
// $routes->match(['get','post'],'manual_notify', 'Tasks::notify');
// $routes->match(['get','post'],'manual', 'ManualExec::index');

//$routes->match(['get','post'],'test', 'Tasks::test');
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
