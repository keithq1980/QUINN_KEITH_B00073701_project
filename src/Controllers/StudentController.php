<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 06/04/2016
 * Time: 16:26
 */
namespace Keithquinndev;

use Keithquinndev\Model\Job;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../app/config_db.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Student.php';
require_once __DIR__ . '/../Model/Cv.php';

// ## below ## User not working this way, require above????? had them under and over requires ??
use Keithquinndev\User;
use Keithquinndev\Student;
use Keithquinndev\Model\Cv;

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

        date_default_timezone_set("Europe/Dublin");

        echo date_default_timezone_get();

        $date = date_create();

        $getUnixStamp = date_timestamp_get($date);
        $timeDisplay = date_format($date, 'd-m-Y H:i:s');

        $jobs = Job::getAll();
        $argsArray = [
            'name' => $username,
            'jobs' => $jobs,
            'id' => $id,
            'timeNow' => $getUnixStamp,
            'timeDisplay' => $timeDisplay,

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

        if ($student->getPhoto() == null) {
            // set default logo if none in db
            $student->setPhoto('/images/default.png');
        } elseif ($upPhoto == null) {
            // if none choosen keep what we have
            $student->setPhoto($student->getPhoto());
        } else {
            // change it to newly chosen
            $student->setPhoto('/images/' . $upPhoto);
        }

        // Update db
        Student::update($student);

        return $this->studentHomeAction($request, $app);
    }

    /**
     * post from student/ job application
     * when student hits apply btn create pdf
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function applicationFromStudentAction(Request $request, Application $app)
    {
        require __DIR__ . '/../../fpdf/fpdf.php';

        $applyButton = $request->get('applyBtn');
        $hiddenStudentID = $request->get('studentID');
        $hiddenEmpID = $request->get('empID');

        // get student by id
        $studentByID = Student::getOneById($hiddenStudentID);
        $studentNamePdf = $studentByID->getFirstname();
        // create a pdf from http://www.fpdf.org/
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 11);
        $pdf->Image('../public' . $studentByID->getPhoto());
        $pdf->Cell(40, 10, $studentByID->getFirstname() . ' ' . $studentByID->getSurname());
        $pdf->Ln();
        $pdf->MultiCell(60, 10, $studentByID->getSummary());
        $pdf->Ln();
        $pdf->MultiCell(60, 10, $studentByID->getskills());
        $pdf->Ln();
        // directory to C drive myPc
        $directoryName = "C:\\laragon\\www\\QUINN_KEITH_B00073701_project\\pdf\\" . $hiddenStudentID .  ".pdf";
        $pdf->Output($directoryName, 'F');
        // add new entry to db
        $cv = new Cv();
        $cv->setEmployerid($hiddenEmpID);
        $cv->setStudentid($hiddenStudentID);

        Cv::insert($cv);

        return $this->viewJobsList($request, $app);
    }
}
