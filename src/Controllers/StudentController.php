<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 06/04/2016
 * Time: 16:26
 */
namespace Keithquinndev;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

// ## below ## User not working this way, require above????? had them under and over requires ??
use Keithquinndev\User;
use Keithquinndev\Student;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../app/config_db.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Student.php';


/**
 * Class StudentController
 * @package Keithquinndev
 */
class StudentController
{
    /**
     * student home page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function studentHomeAction(Request $request, Application $app)
    {
        // retrieve the session info
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];

        $students = Student::getAll();
        $argsArray = [
            'name' => $username,
            'students' => $students,
            'id' => $id,

        ];
        $templateName = 'student_from';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * students, view comments page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function viewStudentComments(Request $request, Application $app)
    {
        // retrieve the session info
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];

        $students = Student::getAll();
        $argsArray = [
            'name' => $username,
            'students' => $students,
            'id' => $id,

        ];
        $templateName = 'viewComments';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * students, view jobs
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function viewJobsList(Request $request, Application $app)
    {
        // retrieve the session info
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];

        $students = Student::getAll();
        $argsArray = [
            'name' => $username,
            'students' => $students,
            'id' => $id,

        ];
        $templateName = 'studentJobList';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * posts from students
     * grab requests and store in database
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
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

        return $this->studentHomeAction($request, $app);
    }
}