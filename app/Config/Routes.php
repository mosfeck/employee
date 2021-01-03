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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// $routes->get('/', 'SubjectsController::index');

// $routes->get('subjects/create', 'SubjectsController::create');
// $routes->post('subjects/store', 'SubjectsController::store');

// $routes->get('subjects/edit/(:num)', 'SubjectsController::edit/$1');
// $routes->post('subjects/update/(:num)', 'SubjectsController::update/$1');

// $routes->get('subjects/delete/(:num)', 'SubjectsController::delete/$1');

// Need to implement like these routes
// $routes->get('products', 'Product::feature');
// $routes->post('products', 'Product::feature');
// $routes->put('products/(:num)', 'Product::feature');
// $routes->delete('products/(:num)', 'Product::feature');

// routes for login form
$routes->get('/', 'LoginControl::index', ['filter' => 'noauth']);
$routes->get('login', 'LoginControl::index', ['filter' => 'noauth']);
$routes->get('signin', 'LoginControl::auth_employee', ['filter' => 'noauth']);
$routes->get('signout', 'LoginControl::signout');
$routes->get('dashboard', 'LoginControl::getUser',['filter' => 'auth']);

// routes for department form
$routes->get('Departs', 'DepartControl::index',['filter' => 'auth']);
$routes->get('Departs/create', 'DepartControl::create',['filter' => 'auth']);
$routes->get('Departs/export', 'DepartControl::export');
$routes->get('Departs/edit/(:num)', 'DepartControl::edit/$1');
$routes->get('Departs/delete/(:num)', 'DepartControl::delete/$1');
$routes->post('Departs/createOrUpdate', 'DepartControl::createOrUpdate');
// $routes->put('products/(:num)', 'Product::feature');
$routes->delete('Departs/(:num)', 'DepartControl::delete');
// $routes->match(['get','post'],'Departs/create', 'DepartControl::createOrUpdate', ['filter' => 'auth']);

// routes for Designation form
$routes->get('Desigs', 'DesigControl::index');
$routes->get('Desigs/create', 'DesigControl::create');
$routes->get('Desigs/export', 'DesigControl::export');
$routes->get('Desigs/edit/(:num)', 'DesigControl::edit/$1');
$routes->get('Desigs/delete/(:num)', 'DesigControl::delete/$1');
$routes->post('Desigs/createOrUpdate', 'DesigControl::createOrUpdate');
$routes->delete('Desigs/(:num)', 'DesigControl::delete');

// routes for Role form
$routes->get('Roles', 'RoleControl::index');
$routes->get('Roles/create', 'RoleControl::create');
$routes->get('Roles/export', 'RoleControl::export');
$routes->get('Roles/edit/(:num)', 'RoleControl::edit/$1');
$routes->get('Roles/delete/(:num)', 'RoleControl::delete/$1');
$routes->post('Roles/createOrUpdate', 'RoleControl::createOrUpdate');
$routes->delete('Roles/(:num)', 'RoleControl::delete');

// routes for Employee form
$routes->get('Employees', 'EmployeeControl::index');
$routes->get('Employees/create', 'EmployeeControl::create');
$routes->get('Employees/export', 'EmployeeControl::export');
$routes->get('Employees/edit/(:num)', 'EmployeeControl::edit/$1');
$routes->get('Employees/delete/(:num)', 'EmployeeControl::delete/$1');
$routes->post('Employees/createOrUpdate', 'EmployeeControl::createOrUpdate');
$routes->delete('Employees/(:num)', 'EmployeeControl::delete');

// routes for Offday form
$routes->get('Offdays', 'OffdayControl::index');
$routes->get('Offdays/create', 'OffdayControl::create');
$routes->get('Offdays/export', 'OffdayControl::export');
$routes->get('Offdays/edit/(:num)', 'OffdayControl::edit/$1');
$routes->get('Offdays/delete/(:num)', 'OffdayControl::delete/$1');
$routes->post('Offdays/createOrUpdate', 'OffdayControl::createOrUpdate');
$routes->delete('Offdays/(:num)', 'OffdayControl::delete');

// routes for Roster form
$routes->get('Rosters', 'RosterControl::index');
$routes->get('Rosters/create', 'RosterControl::create');
$routes->get('Rosters/export', 'RosterControl::export');
$routes->get('Rosters/edit/(:num)', 'RosterControl::edit/$1');
$routes->get('Rosters/delete/(:num)', 'RosterControl::delete/$1');
$routes->post('Rosters/createOrUpdate', 'RosterControl::createOrUpdate');
$routes->delete('Rosters/(:num)', 'RosterControl::delete');

// routes for Shift form
$routes->get('Shifts', 'ShiftControl::index');
$routes->get('Shifts/create', 'ShiftControl::create');
$routes->get('Shifts/export', 'ShiftControl::export');
$routes->get('Shifts/edit/(:num)', 'ShiftControl::edit/$1');
$routes->get('Shifts/delete/(:num)', 'ShiftControl::delete/$1');
$routes->post('Shifts/createOrUpdate', 'ShiftControl::createOrUpdate');
$routes->delete('Shifts/(:num)', 'ShiftControl::delete');

// routes for Employee Shift form
$routes->get('EmpShifts', 'EmpShiftControl::index');
$routes->get('EmpShifts/create', 'EmpShiftControl::create');
$routes->get('EmpShifts/export', 'EmpShiftControl::export');
$routes->get('EmpShifts/edit/(:num)', 'EmpShiftControl::edit/$1');
$routes->get('EmpShifts/delete/(:num)', 'EmpShiftControl::delete/$1');
$routes->post('EmpShifts/createOrUpdate', 'EmpShiftControl::createOrUpdate');
$routes->delete('EmpShifts/(:num)', 'EmpShiftControl::delete');

// routes for Leave form
$routes->get('Leaves', 'LeaveControl::index');
$routes->get('Leaves/create', 'LeaveControl::create');
$routes->get('Leaves/export', 'LeaveControl::export');
$routes->get('Leaves/edit/(:num)', 'LeaveControl::edit/$1');
$routes->get('Leaves/delete/(:num)', 'LeaveControl::delete/$1');
$routes->post('Leaves/createOrUpdate', 'LeaveControl::createOrUpdate');
$routes->delete('Leaves/(:num)', 'LeaveControl::delete');

// routes for Attend form
$routes->get('Attends', 'AttendControl::index');
$routes->get('Attends/login', 'AttendControl::loginForm');
$routes->get('Attends/logout', 'AttendControl::logoutForm');
$routes->post('Attends', 'AttendControl::store');
$routes->put('Attends/(:num)', 'AttendControl::update');

// routes for Attend form
$routes->get('AttendDetails', 'AttendDetailControl::index');


// $routes->get('subject', 'SubjectsController::index');
// $routes->get('DepartControl', 'DepartControl::index');
// $routes->get('DesigControl', 'DesigControl::index');
// $routes->get('RoleControl', 'RoleControl::index');
// $routes->get('EmployeeControl', 'EmployeeControl::index');
// $routes->get('OffdayControl', 'OffdayControl::index');
// $routes->get('ShiftControl', 'ShiftControl::index');
// $routes->get('EmpShiftControl', 'EmpShiftControl::index');
// $routes->get('RosterControl', 'RosterControl::index');
// $routes->get('LeaveControl', 'LeaveControl::index');
// $routes->get('AttendControl', 'AttendControl::index');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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
