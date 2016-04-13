<?php

namespace Keithquinndev;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../app/config_db.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Student.php';


// ## below ## User not working this way, require above?????
use Keithquinndev\User;
use Keithquinndev\Student;

/**
 * Class MainController
 * @package Keithquinndev
 */
class MainController
{
    /**
     * render the About page template
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function aboutAction(Request $request, Application $app)
    {
        $argsArray = [];
        $templateName = 'about';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * render the Contact details page template
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function contactAction(Request $request, Application $app)
    {
        $argsArray = [];
        $templateName = 'contact';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * render indedx page
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Request $request, Application $app)
    {
        $argsArray = [
            'name' => ', Welcome to CDM  work placement',
        ];

        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * not found error page
     * @param \Silex\Application $app
     * @param  $message
     * @return mixed
     */
    public static function error404(Application $app, $message)
    {

        $argsArray = [
            'message' => $message,
        ];
        $templateName = '404';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * login page
     * @param \Silex\Application $app
     * @param $message
     * @return mixed
     *
     */
    public function loginAction(Request $request, Application $app)
    {
        $argsArray = [
            'form' => 'username',
        ];
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * Destroy session when user logs out!
     * @param Application $app
     */
    public function destroySession(Application $app)
    {
        $individuals = User::getAll();
        // loop each student and set logged in to  false
        foreach ($individuals as $individual) {
                $individual->setLoggedIn(false);
        }
        // (1) Unset all of the session variables.
        $_SESSION = [];

        // (2) If it is desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
            // return to login page
            $argsArray = [
                'form' => 'username',
            ];
            $templateName = 'login';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);

        }
        else {
            // (3) destroy the session.
            session_destroy();

        }
    }
}