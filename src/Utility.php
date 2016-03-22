<?php
namespace Keithquinndev;

class Utility
{
    /**
     * add namespace to the string, after exploding controller name from action
     *
     * examples:
     * input:   Keithquinndev, main/index
     * output:  Keithquinndev\MainController::indexAction
     *
     * input:   Keithquinndev\Samples, hello/name
     * output:  Keothquinndev\Samples\HelloController::nameAction
     *
     * @param $shortName controller and action name sepaerate by "/"
     * @return string namespace, controller class name plus :: plus action name
     */
    public static function controller($namespace, $shortName)
    {
        list($shortClass, $shortMethod) = explode('/', $shortName, 2);

        $shortClassCapitlise = ucfirst($shortClass);

        $namespaceClassAction = sprintf($namespace . '\\' . $shortClassCapitlise . 'Controller::' . $shortMethod . 'Action');

        return $namespaceClassAction;
    }
}


