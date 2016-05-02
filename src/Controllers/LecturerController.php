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
require __DIR__. '/../Model/Job.php';
require __DIR__. '/../Model/Detail.php';

// ## below ## User not working this way, require above?????
use Keithquinndev\User;
use Keithquinndev\Student;
use Keithquinndev\Model\Job;
use Keithquinndev\Model\Detail;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LecturerController
 * @package Keithquinndev
 */

class LecturerController
{
    /**
     * returns lecturer view template when logged in
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function lecturerHomeAction(Request $request, Application $app)
    {
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];
        $students = Student::getAll();
        $argsArray = [
            'name' => $username,
            'students' => $students,
            'id' => $id,

        ];
        $templateName = 'lecturer_view';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * addDelete template page for lecturer
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function addDeleteAction(Request $request, Application $app)
    {
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];
        $students = Student::getAll();
        $argsArray = [
            'name' => $username,
            'students' => $students,
            'id' => $id,

        ];
        $templateName = 'addDelete';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Job create page from lecturer view
     * @param Request $request
     * @param Application $app
     * @return mixed create a job by lecturer
     */
    public function jobDescriptionAction(Request $request, Application $app)
    {
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];
        $detailsFromEmp = Detail::getAll();

        $argsArray = [
            'name' => $username,
            'empDetails' => $detailsFromEmp,
            'id' => $id,

        ];
        $templateName = 'jobCreate';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * send comments to all students
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function sendGlobalComment(Request $request, Application $app)
    {
        $globalComment = $request->get('textareaComment');
        $student = Student::getAll();
        foreach ($student as $value) {
            $value->setGlobalComment($globalComment);
            // Update db
            Student::update($value);
        }
        return $this->lecturerHomeAction($request, $app);
    }

    /**
     * send private comment page
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function sendPrivateComment(Request $request, Application $app)
    {
        // get the id from check box to send comment to this id
        $getCheckedId = $request->get('check_id');
        $privateComment = $request->get('textareaPriavteComment');
        if ($privateComment == null) {
            echo ' no message to send - blank comment area...';
        }
        //
        foreach ($getCheckedId as $selectedId) {
            if ($selectedId  == true) {
                echo $selectedId ."</br>";
                $student = Student::getOneById($selectedId);
                $student->setPrivateComment($privateComment);
                Student::update($student);
            } else {
                echo 'You must check a student to message '."</br>";
            }
            return $this->lecturerHomeAction($request, $app);
        }
    }

    /**
     * add new student entry
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function addStudent(Request $request, Application $app)
    {
        require_once __DIR__ . '/../../public/studentSeed.php';

        return $this->addDeleteAction($request, $app);
    }

    /**
     * delete existing students
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
   public function deleteStudent(Request $request, Application $app)
   {
       // get the id from check box to send comment to this id
       $getId = $request->get('check_id');
       print_r($getId);
       foreach ($getId as $selectedId) {
           if ($selectedId  == true) {
               echo $selectedId ."</br>";
               User::delete($selectedId);
               Student::delete($selectedId);
           } else {
               echo 'You must check a student to Delete '."</br>";
           }
       }
       return $this->addDeleteAction($request, $app);
   }

    /**
     * post job
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function postJobAction(Request $request, Application $app)
    {
        $jobTitle = $request->get('job_title');
        $dateTimePosted = $request->get('dateTime');
        $employerID = $request->get('emp_check_id');
        $jobDetails = $request->get('textareaJobDetails');
        $tableID = $request->get('table_id');

        // if false from isset print error
        if (!isset($employerID)) {
            print_r("You must check id box to post job");
            return $this->jobDescriptionAction($request, $app);
        }

        //########## TIMESTAMP #############
        // replace T with space  - '   ' 
        $dateTimePosted_OG =  str_replace("T", " ", $dateTimePosted);
        //print_r($dateTimePosted_OG . ' replace ');
        // print_r($dateTimePosted_OG2 . ' replace 2  ');
        // $timestamp = strtotime( $dateTimePosted_OG2 );
        date_default_timezone_set("Europe/Dublin");

        echo date_default_timezone_get();
        echo time();
        echo "\n";
        $date = date_create();
        echo date_format($date, 'U = d-m-Y H:i:s') . "\n";

        $getStamp = date_timestamp_get($date);

        $parArray = date_parse($dateTimePosted_OG);

        $makeTimeFromPosted = mktime($parArray['hour'], $parArray['minute'], $parArray['second'], $parArray['month'], $parArray['day'], $parArray['year']);
        //mktime(h,m,s,month,day,year);
        echo "madeee   " . $makeTimeFromPosted ;

        $endTime = mktime();
        echo "new stamp  end  " . $endTime . " made up =  " . $makeTimeFromPosted . " \n";

        // create a new Job in db ---------------
        $job = new Job();
        // loop the check box id
        foreach ($employerID as $empID) {
            $job->setEmployerId($empID);
        }

        $job->setTitle($jobTitle);
        $job->setDetails($jobDetails);
        $job->setDeadline($makeTimeFromPosted);

        Job::insert($job);
        // remove posted job from details db and table
        foreach ($tableID as $tabID) {
            Detail::delete($tabID);
        }

        return $this->jobDescriptionAction($request, $app);
    }
}
