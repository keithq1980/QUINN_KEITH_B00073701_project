<?php
// autoloader
// ------------
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config_db.php';

// my settings
// ------------
$myTemplatesPath = __DIR__ . '/../templates';

// setup Twig
// ------------
$loader = new Twig_Loader_Filesystem($myTemplatesPath);
$twig = new Twig_Environment($loader);

// setup Silex
// ------------
$app = new Silex\Application();

// register Twig with Silex
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $myTemplatesPath
));

