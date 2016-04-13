<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 12/04/2016
 * Time: 21:33
 */

namespace Keithquinndev;


require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../app/config_db.php';
require __DIR__ . '/../Model/User.php';
require __DIR__. '/../Model/Student.php';

// ## below ## User not working this way, require above?????
use Keithquinndev\User;
use Keithquinndev\Student;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LecturerController
 * @package Keithquinndev
 */

class LecturerController
{
    public function lecturerHomeAction(Request $request, Application $app)
    {
        $students = Student::getAll();
        $argsArray = [
            'name' => 'username',
            'students' => $students,

        ];
        $templateName = 'lecturer_view';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function addDeleteAction(Request $request, Application $app)
    {
        $students = Student::getAll();
        $argsArray = [
            'form' => 'username',
            'students' => $students,
        ];
        $templateName = 'addDelete';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    public function jobDescriptionAction(Request $request, Application $app)
    {
        $students = Student::getAll();
        $argsArray = [
            'form' => 'username',
            'students' => $students,
        ];
        $templateName = 'jobCreate';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @param Request $request
     * @param Application $app
     */
    public function sendGlobalComment(Request $request, Application $app)
    {
        $globalComment = $request->get('textareaComment');
        $student = Student::getAll();
        foreach ($student as $value){
            $value->setGlobalComment($globalComment);
            // Update db
            Student::update($value);
         }
    }

    public function sendPrivateComment(Request $request, Application $app)
    {
        // get the id from check box to send comment to this id
        $getCheckedId = $request->get('check_id');
        $privateComment = $request->get('textareaPriavteComment');
        if($privateComment == null ){
            echo ' no message to send - blank comment area...';
        }

        foreach($getCheckedId as $selectedId){
            if($selectedId  == true ) {
                echo $selectedId ."</br>";
                $student = Student::getOneById($selectedId);
                $student->setPrivateComment($privateComment);
                Student::update($student);
            }
            else {
                echo 'You must check a student to message '."</br>";
            }
        }
/*
        // get perticular parts checked to send further comments
        $getCheckedSection = $request->get('check_list');

        foreach($getCheckedSection as $selected){
            if($selected == true )
                echo $selected ."</br>";

        }
*/
    }
    public function addStudent(Request $request, Application $app)
    {
        require_once __DIR__ . '/../../public/studentSeed.php';
        $students = Student::getAll();
        $argsArray = [
            'form' => 'username',
            'students' => $students,
        ];
        $templateName = 'addDelete';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

   public function deleteStudent(Request $request, Application $app)
   {
       // get the id from check box to send comment to this id
       $getId = $request->get('check_id');
        print_r($getId);
       foreach($getId as $selectedId){
           if($selectedId  == true ) {
               echo $selectedId ."</br>";
               User::delete($selectedId);
               Student::delete($selectedId);

           }
           else {
               echo 'You must check a student to Delete '."</br>";
           }
       }
       $students = Student::getAll();
       $argsArray = [
           'form' => 'username',
           'students' => $students,
       ];
       $templateName = 'addDelete';
       return $app['twig']->render($templateName . '.html.twig', $argsArray);
   }

}