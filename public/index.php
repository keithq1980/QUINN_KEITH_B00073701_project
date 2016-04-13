<?php
// basic setup
//-------------------------------------------
require_once __DIR__ . '/../app/setup.php';
require_once __DIR__ . '/../app/config_db.php';

// map routes to controller class/method
//-------------------------------------------
$app->get('/', 'Keithquinndev\\MainController::indexAction');
$app->get('/about', 'Keithquinndev\\MainController::aboutAction');
$app->get('/contact', 'Keithquinndev\\MainController::contactAction');
$app->get('/login', 'Keithquinndev\\MainController::loginAction');

//---- post from submit login page -----
//-------------------------------------------
$app->post('/loginAction','Keithquinndev\\UserViewController::userViews');
$app->get('/logout', 'Keithquinndev\\MainController::destroySession');

//---- post from students ----
//-------------------------------------------
$app->post('/postFromStudent', 'Keithquinndev\\UserViewController::studentPost');

// ------------- gets links from lecturer
$app->get('/addDelete', 'Keithquinndev\\LecturerController::addDeleteAction');
$app->get('/lecturer_view', 'Keithquinndev\\LecturerController::lecturerHomeAction');
$app->get('/jobCreate', 'Keithquinndev\\LecturerController::jobDescriptionAction');


//---- post from lecturers ----
//-------------------------------------------
$app->post('/sendGlobalComment', 'Keithquinndev\\LecturerController::sendGlobalComment');

$app->post('/sendPrivateComment', 'Keithquinndev\\LecturerController::sendPrivateComment');

$app->post('/addStudent', 'Keithquinndev\\LecturerController::addStudent');
$app->post('/deleteStudent', 'Keithquinndev\\LecturerController::deleteStudent');



// display errors 404 etc  - Page not found messages - route them to template 404
//-------------------------------------------
$app->error(function (\Exception $e, $code) use ($app) {
    print_r($code . '  Code to catch  ? ');//error checking!!
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
           // return \Keithquinndev\MainController::error404($app, $message);
            break;
        case 500:
            $message = 'Please enter a valid username and password or page not available.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
           // return \Keithquinndev\MainController::error404($app, $message);
    }
    return \Keithquinndev\MainController::error404($app, $message);
});

// run Silex front controller
//-------------------------------------------
$app->run();