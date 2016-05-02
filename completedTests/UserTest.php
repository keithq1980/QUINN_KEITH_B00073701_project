<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 26/04/2016
 * Time: 22:39
 */
namespace KeithquinndevTest;
require_once __DIR__ . '/../src/Model/User.php';
use Keithquinndev\User;

/**
 * Class UserTest
 * @package KeithquinndevTest
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
/*
    public function testsetgetid()
    {
        // Arrange
        $s = new User();
        $s->setId(1);
        $expectedResult = 1;

        // Act
        $result = $s->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testsetgetUsername()
    {
        // Arrange
        $s = new User();
        $s->setUsername('keith');
        $expectedResult = 'keith';

        // Act
        $result = $s->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testsetgetPassword()
    {
        // Arrange
        $s = new User();
        $s->setPassword('keith');
        $expectedResult = password_verify('keith',$s->getPassword());

        // Act
        $result = true;

        // Assert
        $this->assertTrue($expectedResult, $result);
    }

    public function testsetgetRole()
    {
        // Arrange
        $s = new User();
        $s->setRole(1);
        $expectedResult = 1;

        // Act
        $result = $s->getRole();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
*/
    public function testisLoggedIn()
    {
        // Arrange
        $s = new User();
        $s->setLoggedIn(true);
        $expectedResult = true;

        // Act
        $result = $s->isLoggedIn();

        // Assert
        $this->assertTrue($expectedResult, $result);

    }
}