<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//  route pour la méthode testDatabaseConnection()
$routes->get('/testconnection', 'DatabaseController::index');


// Routes pour authentification et creation des compte utilisateurs
$routes->get('/login', 'AuthController::login');
$routes->post('/authenticate', 'AuthController::authenticate');
$routes->get('clients/register', 'AuthController::register');
$routes->post('clients/register', 'AuthController::register');
$routes->get('clients/logout', 'AuthController::logout');
$routes->get('clients/edit/(:num)', 'UserController::edit/$1');
$routes->post('clients/update/(:num)', 'UserController::update/$1');
$routes->get('clients/delete/(:num)', 'UserController::deleteUser/$1');
// Routes pour voir un utilisateurs
$routes->get('/clients/view/(:num)', 'UserController::view/$1');
// Route pour afficher la liste des clients
$routes->get('list', 'ClientController::index');
$routes->get('clients/list', 'UserController::index');
$routes->get('/clients/search', 'UserController::search');



// Routes items
$routes->get('items/list', 'ItemController::index');
$routes->get('items/view/(:any)', 'ItemController::view/$1');
$routes->post('items/update/(:any)', 'ItemController::update/$1');
$routes->get('items/update/(:any)', 'ItemController::update/$1');
$routes->get('items/delete/(:any)', 'ItemController::delete/$1');
$routes->get('items/edit/(:any)', 'ItemController::edit/$1');
$routes->get('items/create', 'ItemController::createForm');
$routes->post('items/create', 'ItemController::create');


// Routes devis
$routes->get('devis/list', 'DevisController::index');
$routes->get('devis/view/(:any)', 'DevisController::view/$1');
$routes->get('devis/create', 'DevisController::createForm');
$routes->post('devis/create', 'DevisController::create');
$routes->get('devis/edit/(:any)', 'DevisController::edit/$1');
$routes->get('devis/removeItem/(:num)/(:num)', 'DevisController::removeItem/$1/$2');
$routes->post('devis/update/(:num)', 'DevisController::update/$1');
$routes->post('devis/delete/(:any)', 'DevisController::delete/$1');