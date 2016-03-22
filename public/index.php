<?php
// do out basic setup
// ------------
require_once __DIR__ . '/../app/setup.php';

//-------------------------------------------
// map routes to controller class/method
//-------------------------------------------
/*
$app->get('/', 'Itb\\MainController::indexAction');
$app->get('/about', 'Itb\\MainController::aboutAction');
$app->get('/contact', 'Itb\\MainController::contactAction');
$app->get('/contact', 'Itb\\MainController::error404Action');
*/

// use our static controller() method...
$app->get('/',      \Keithquinndev\Utility::controller('Keithquinndev', 'main/index'));
$app->get('/login',      \Keithquinndev\Utility::controller('Keithquinndev', 'main/login'));

// 404 - Page not found
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            return \Keithquinndev\MainController::error404($app, $message);

        default:
            $message = 'We are sorry, but something went terribly wrong.';
            return \Keithquinndev\MainController::error404($app, $message);
    }
});

// run Silex front controller
// ------------
$app->run();