<?php
//---------------------------- basic setup
require_once __DIR__ . '/../app/setup.php';
require_once __DIR__ . '/../app/config_db.php';

// ------------------------------------------ Pre-login page -- map routes to controller class/functions
//-------------------------------------------
$app->get('/', 'Keithquinndev\\MainController::indexAction');
$app->get('/about', 'Keithquinndev\\MainController::aboutAction');
$app->get('/contact', 'Keithquinndev\\MainController::contactAction');
$app->get('/login', 'Keithquinndev\\MainController::loginAction');

//-------------------------------------------- post from submit login page & logout action -----
//-------------------------------------------
$app->post('/loginAction','Keithquinndev\\UserViewController::userViews');
$app->get('/logout', 'Keithquinndev\\MainController::destroySession');


//-------------------------------------------- gets from student view
//-------------------------------------------
$app->get('/student_from', 'Keithquinndev\\StudentController::studentHomeAction');
$app->get('/viewComments', 'Keithquinndev\\StudentController::viewStudentComments');
$app->get('/viewJobs', 'Keithquinndev\\StudentController::viewJobsList');

//-------------------------------------------- post from students -- CV ----
//-------------------------------------------
$app->post('/postFromStudent', 'Keithquinndev\\StudentController::studentPost');

// ------------------------------------------ gets links from lecturer view
//-------------------------------------------
$app->get('/lecturer_view', 'Keithquinndev\\LecturerController::lecturerHomeAction');
$app->get('/addDelete', 'Keithquinndev\\LecturerController::addDeleteAction');
$app->get('/jobCreate', 'Keithquinndev\\LecturerController::jobDescriptionAction');


//------------------------------------------- post from lecturers ----
//-------------------------------------------
$app->post('/sendGlobalComment', 'Keithquinndev\\LecturerController::sendGlobalComment');
$app->post('/sendPrivateComment', 'Keithquinndev\\LecturerController::sendPrivateComment');
$app->post('/addStudent', 'Keithquinndev\\LecturerController::addStudent');
$app->post('/deleteStudent', 'Keithquinndev\\LecturerController::deleteStudent');
$app->post('/jobPostAction', 'Keithquinndev\\LecturerController::postJobAction');



// display errors 404 etc  - Page not found messages - route them to template 404
//-------------------------------------------
$app->error(function (\Exception $e, $code) use ($app) {
    print_r($code . '  Code to catch  ? ');//error checking!!
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
           // return \Keithquinndev\MainController::error404($app, $message);
            break;
        case 403:
            $message = 'The request is for something forbidden. Authorization will not help.';
            break;
        case 500:
            $message = 'The server encountered an unexpected condition which prevented it from fulfilling the request.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
           // return \Keithquinndev\MainController::error404($app, $message);
    }
    return \Keithquinndev\MainController::error404($app, $message);
});

// run Silex front controller
//---------------------------
$app->run();