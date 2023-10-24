<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Login and Logout
$routes->post('/login/login', 'Login::login');
$routes->get('/login/logout', 'Login::logout');
$routes->get('/login/recovery-password', 'Login::recovery_password');
$routes->post('/login/recovery-form', 'Login::recovery_form');
$routes->get('/login/new-password/(:any)', 'Login::new_password/$1');
$routes->post('/login/form-save-new-password', 'Login::form_save_new_password');

//Register
$routes->post('/register/register', 'Register::register');
$routes->get('/register/check-email', 'Register::check_email');
$routes->get('/register/email-activation/(:any)', 'Register::email_activation/$1');
$routes->get('/register/email-activated', 'Register::email_activated');

//About | Privacy
$routes->get('/about', 'About::index');
$routes->get('/privacy', 'Privacy::index');

//Words
$routes->get('/words', 'Words::index');
$routes->post('/words/save-word', 'Words::save_word');
$routes->post('/words/ajax-edit-word', 'Words::ajax_edit_word');
$routes->post('/words/ajax-delete-word', 'Words::ajax_delete_word');
$routes->post('/words/check-new-word', 'Words::check_new_word');

//Sentences
$routes->get('/sentences', 'Sentences::index');
$routes->post('/sentences/save-sentence', 'Sentences::save_sentence');
$routes->post('/sentences/ajax-edit-sentence', 'Sentences::ajax_edit_sentence');
$routes->post('/sentences/ajax-delete-sentence', 'Sentences::ajax_delete_sentence');

//Irregular Verbs
$routes->get('/irregular', 'Irregular::index');
$routes->get('/irregular/table', 'Irregular::table');

//Game
$routes->get('/game', 'Game::index');
$routes->post('/game/error-game', 'Game::error_game');
$routes->post('/game/success-game', 'Game::success_game');

//Mistakes
$routes->get('/mistakes', 'Mistakes::index');
$routes->get('/mistakes/reset-mistakes', 'Mistakes::reset_mistakes');

//History
$routes->get('/history', 'History::index');

//Profile
$routes->get('/profile', 'Profile::index');
$routes->post('/profile/change-info', 'Profile::change_info');
$routes->get('/profile/deleteuser', 'Profile::deleteuser');
$routes->post('/profile/confirmdeleteuser', 'Profile::confirmdeleteuser');
$routes->post('/profile/save-voice', 'Profile::save_voice');

//Export
$routes->get('/export', 'Export::index');
$routes->get('/export/sendemail', 'Export::sendemail');
