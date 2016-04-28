<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 06/04/2016
 * Time: 16:26
 */

namespace Keithquinndev;

require_once __DIR__ . '/../Model/User.php';
//require_once __DIR__ . '/../Model/Student.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../app/config_db.php';
require __DIR__. '/../Model/Student.php';


// ## below ## User not working this way, require above?????
use Keithquinndev\User;
use Keithquinndev\Student;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserViewController
 * @package Keithquinndev
 */
class UserViewController
{
    /**
     * Post action - Displays the views on loggin success!
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function userViews(Request $request, Application $app)
    {
        // get all from db user table
        $user = User::getAll();
        // error hint for username & password
        if($request->get('username') == null && $request->get('password') == null) {
            $message = 'Please enter a valid username and password';
            print_r($message);
        }
        elseif($request->get('username') != null && $request->get('password') == null || $request->get('username') == null && $request->get('password') != null ) {
            $message = 'Please enter a valid username and password';
            print_r($message);
        }
        // grab request from post action
        $username = $request->get('username');
        $password = $request->get('password');

        foreach ($user as $value) {
            // pass password into method to verify it matches the hash in db
            $passwordverify = password_verify($password, $value->getPassword());
            // get all student entities
            $students = Student::getAll();

            // check username and verify hash password
            if ($value->getUsername() == $username && $passwordverify == true ) {
                // role 1 student
                //########
                 $id = $value->getId();
                if ($value->getRole()== 1) {
                    // set true to user table
                    $value->setLoggedIn(true);

                    $loggedIn = $value->isLoggedIn();
                    print_r($loggedIn . ' = logged in');
                    $this->sessionStart($username, $id);

                    $argsArray = [
                        'name' => $username,
                        'students' => $students,
                        'id' => $id,

                    ];
                    $templateName = 'student_from';
                    return $app['twig']->render($templateName . '.html.twig', $argsArray);
                }
                // role 2 lecturer
                else if ($value->getRole()== 2) {
                    $id = $value->getId();
                    $this->sessionStart($username, $id);

                    $argsArray = [
                        'name' => $username,
                        'students' => $students,
                        'id' => $id,

                    ];
                    $templateName = 'lecturer_view';
                    return $app['twig']->render($templateName . '.html.twig', $argsArray);

                }
                // role 3 employer
                else if ($value->getRole()== 3) {
                    $id = $value->getId();
                    $this->sessionStart($username, $id);

                    $argsArray = [
                        'name' => $username,
                        'id' => $id,
                    ];
                    $templateName = 'employer_view';
                    return $app['twig']->render($templateName . '.html.twig', $argsArray);
                }
            }//end-if
        }
    }

    /**
     * Start a session and print id & page hits
     * @param $username
     * @param $id
     */
    public function sessionStart($username, $id)
    {
        session_start();
        $_SESSION['id_loggedIn'] = $id;
        $_SESSION['username'] = $username;
        //$new_id  = session_id($id);
        //$new_username = session_name($username) ;

       // $_SESSION['login_user']= $username;
        print_r(' Username = ' . $username );
        print '<br>';

       // $seesionId = session_id();
        print_r('SessionID: ' . $id);
        print_r('actual sessID =  ' . $_SESSION['id_loggedIn']);
        $pageHits = 0;
        if (isset($_SESSION['counter'])){
            $pageHits = $_SESSION['counter'];
        }
        $pageHits++;
        $_SESSION['counter'] = $pageHits;
        print '<br>';
        print_r('Page hits: = ' . $pageHits);
    }
}