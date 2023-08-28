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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// ============================================================= LOGIN PAGE & PROCESS
$routes->get('/', 'Home::index'); // LOGIN PAGE
$routes->get('login', 'Home::login'); // LOGIN PROCESS
$routes->post('login', 'Home::prosesLogin'); // LOGIN PROCESS

// ============================================================= 2-FACTOR_AUTH
$routes->get('twoVerify', 'Home::twoFactorVerification'); // 2-FACTOR_AUTH PAGE
$routes->post('twoVerify', 'Home::twoFactorVerificationProcess'); // 2-FACTOR_AUTH PROCESS
$routes->get('reOtp', 'Home::regenerateOTPCode'); // GENERATE OTP CODE PROCESS

// ============================================================= DASHBOARD PAGE
$routes->get('main', 'Home::main'); // DASHBOARD PAGE

// ============================================================= SERVER & VIEW SERVER PAGE
$routes->get('server', 'serverControler::server'); // SERVER PAGE
$routes->get('viewserver', 'serverControler::viewServer'); // VIEW SERVER PAGE

// ============================================================= CART & ORDER PAGE
$routes->get('cart', 'CartController::cart'); // CART PAGE
$routes->get('order', 'CartController::order'); // ORDER PAGE
$routes->get('inv', 'CartController::invoice'); // INVOICE PAGE
// ============================================================= MERCHANT PAGE
$routes->get('merch','Home::merch'); // MERCHANT PAGE

// ============================================================= SETTING PAGE
$routes->get('setting', 'Home::setting'); // SETTING PAGE
// ============================================================= SETING THEMES
$routes->post('themes', 'Home::themesColor'); // PROCESS CHANGE THEMES COLOR

// ============================================================= HELP & TICKET PAGE
$routes->get('help', 'LiveChatController::help'); // HELP PAGE
$routes->get('liveChat', 'LiveChatController::ticket'); // TICKET PAGE
$routes->post('liveChat', 'LiveChatController::createNewChat'); // PROCESS CRETAE NEW TICKET

// ============================================================= NOTIF & LOG PAGE
$routes->get('log', 'Home::logActivity'); // NOTIF LOG PAGE


// ============================================================= ACCOUNT AND SECURITY PAGE
$routes->post('UpdateAccount', 'Home::prosesUpdateAccountSecurity'); // PROCESS UPDATE DATA ACCOUNT AND SECURITY
$routes->post('UpdatePhoto', 'Home::prosesUpdateFotoProfile'); // PROCESS UPDATE FOTO PROFILE ACCOUNT AND SECURITY
$routes->get('accScur', 'Home::accountSecurity'); // ACCOUNT AND SECURITY PAGE

// ============================================================= LOGOUT PROCESS
$routes->get('logout', 'Home::logout'); // LOGOUT PROCESS

// UNTUK TESTING QUERY
// $routes->get('test', 'LiveChatController::test');

// ============================================================= SEND MAIL PAGE & PROCESS
// $routes->get('sendMailPage', 'Home::sendMailPage'); // SEND MAIL PAGE
// $routes->match(['get', 'post'], 'SendMail/sendMail', 'Home::sendMail'); // SEND MAIL PROCESS


// MENCEGAH KESLAHAN HALAMAN TIDAK DITEMUKAN, PADA SAAT PENGGUNA MENGAKSES PATH ROUTES YANG TIDAK ADA ==================
// Fallback route untuk mengalihkan pengguna ke halaman beranda ("/" atau "/index")
// $routes->match(['get', 'post'], '(:any)', 'Home::index/$1'); 
// =====================================================================================================================


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
