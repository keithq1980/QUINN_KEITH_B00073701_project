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
        elseif($request->get('username') != null && $request->get('password') == null ||$request->get('username') == null && $request->get('password') != null ) {
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
                    $this->sessionStart($username);

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
                    $this->sessionStart($username);

                    $argsArray = [
                        'name' => $username,
                        'students' => $students,

                    ];
                    $templateName = 'lecturer_view';
                    return $app['twig']->render($templateName . '.html.twig', $argsArray);

                }
                // role 3 employer
                else if ($value->getRole()== 3) {
                    $id = $value->getId();
                    $this->sessionStart();

                    $argsArray = [
                        'name' => $username,
                        'id' => $id,
                    ];
                    $templateName = 'employer_view';
                    return $app['twig']->render($templateName . '.html.twig', $argsArray);
                }
            }//if
        }
    }

    /**
     * Start a session and print id & page hits
     */
    public function sessionStart($username)
    {
        session_start();
        $_SESSION['login_user']= $username;
        print_r(' Username = ' . $username );
        print '<br>';

        $seesionId = session_id();
        print_r('SessionID: ' . $seesionId);
        $pageHits = 0;
        if (isset($_SESSION['counter'])){
            $pageHits = $_SESSION['counter'];
        }
        $pageHits++;
        $_SESSION['counter'] = $pageHits;
        print '<br>';
        print_r('Page hits: = ' . $pageHits);
    }

    public function studentPost(Request $request, Application $app)
    {
        // REQUESTS submitted
        $id = $request->get('id');
        $firstname = $request->get('firstname');
        $surname = $request->get('surname');
        $textareaSum = $request->get('textareaSum');
        $textareaSkill = $request->get('textareaSkill');
        $upPhoto = $request->get('upPhoto');

        // Setters
        $student = Student::getOneById($id);
        $student->setFirstname($firstname);
        $student->setSurname($surname);
        $student->setSummary($textareaSum);
        $student->setSkills($textareaSkill);

        if($student->getPhoto() == null ) {
            // set default logo if none in db
            $student->setPhoto('/images/default.png');
        }
        elseif($upPhoto == null ) {
            // if none choosen keep what we have
            $student->setPhoto($student->getPhoto());
        }
        else {
            // change it to newly chosen
            $student->setPhoto('/images/' . $upPhoto);
        }

        // Update db
        Student::update($student);






    }

}