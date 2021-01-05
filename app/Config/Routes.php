<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Web');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Web::index');
$routes->get('/login', 'Web::index');
$routes->get('/home', 'Web::home');
$routes->get("/logout", "Auth::logout");
$routes->get("/cadastro", "Web::cadastro");
$routes->get("/esqueci", "Web::forget");
$routes->get("/confirm-code", "Web::confirm");
$routes->get("/reset", "Web::reset");
$routes->get('/confirmar/(:alphanum)', 'Auth::confirm/$1');

$routes->post("/login", "Auth::login");
$routes->post("/register", "Auth::register");
$routes->post("/forget", "Auth::forget");
$routes->post("/reset", "Auth::reset");
$routes->post("/resetPasswd", "Auth::resetPasswd");
$routes->post("/addcart", "Cart::add");
$routes->post("/remove", "Cart::remove");
$routes->get("/cart", "Cart::show");
$routes->get("/done", "Cart::done");
$routes->post("/buy", "Cart::buy");





/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
