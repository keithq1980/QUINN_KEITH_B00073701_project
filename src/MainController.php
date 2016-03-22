<?php
namespace Keithquinndev;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

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
     * @param             $message
     *
     * @return mixed
     */
    public static function error404(Application $app, $message)
    {
        $argsArray = [
            'name' => 'CDM',
        ];
        $templateName = '404';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * login page
     * @param \Silex\Application $app
     * @param $message
     * @return mixed
     */
    public static function loginAction(Request $request, Application $app)
    {
        $argsArray = [
            'name' => 'login'
        ];
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     *
     * if (!isset($blogPosts[$id])) {
     *  // generate a 404 error from within a controller...
     *  $app->abort(404, "Post $id does not exist.");
     * }
     */

}