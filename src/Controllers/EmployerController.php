<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 28/04/2016
 * Time: 16:40
 */

namespace Keithquinndev;

// ## below ## User not working this way, require above?????
use Keithquinndev\Model\Cv;
use Keithquinndev\User;
use Keithquinndev\Model\Job;
use Keithquinndev\Model\Detail;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../app/config_db.php';
require __DIR__ . '/../Model/User.php';
require __DIR__. '/../Model/Student.php';
require __DIR__. '/../Model/Job.php';
require __DIR__ . '/../Model/Detail.php';



/**
 * Class EmployerController
 * @package Keithquinndev
 */
class EmployerController
{
    /**
     * Home page for employers
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function employerHomeAction(Request $request, Application $app)
    {
        // retrieve the session info & keep alive!
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];

        $argsArray = [
            'name' => $username,
            'id' => $id,

        ];

        $templateName = 'employer_view';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
    /**
     * post action about job to lecturer from employer
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function postJobDetailsToLecturer(Request $request, Application $app)
    {
        // grab the data posted
        $jobTitle = $request->get('jobTitle');
        $jobDetails = $request->get('textareaJobDetails');
        $empID = $request->get('empId');

        // apply to db and insert object
        $empPost = Detail::getOneById(1);
        $empPost->setEmployerId($empID);
        $empPost->setTitle($jobTitle);
        $empPost->setDetails($jobDetails);

        Detail::insert($empPost);

        return $this->employerHomeAction($request, $app);
    }

    /**
     * view student cv's
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function viewStudentCV(Request $request, Application $app)
    {
        // retrieve the session info & keep alive!
        session_start();
        $id = $_SESSION['id_loggedIn'];
        $username = $_SESSION['username'];
        $cvs = Cv::getAll();
        $jobs = Job::getAll();
        date_default_timezone_set("Europe/Dublin");

        echo date_default_timezone_get();

        $date = date_create();

        $getUnixStamp = date_timestamp_get($date);
        $argsArray = [
            'name' => $username,
            'id' => $id,
            'cvs' => $cvs,
            'jobs' => $jobs,
            'timeNow' => $getUnixStamp,

        ];

        $templateName = 'viewCVs';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * post button to view pdf
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function postBtnPDF(Request $request, Application $app)
    {
        require __DIR__ . '/../../fpdf/fpdf.php';

        $pdfName = $request->get('pdfBtn');

        $pdf = new \FPDF();
        // download the file
        $pdf->Output($pdfName, 'D');

        return $this->viewStudentCV($request, $app);
    }
}
