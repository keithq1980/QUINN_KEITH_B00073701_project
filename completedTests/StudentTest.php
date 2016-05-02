<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 26/04/2016
 * Time: 22:39
 */
namespace KeithquinndevTest;
require_once __DIR__ . '/../src/Model/Student.php';
use Keithquinndev\Student;

/**
 * Class StudentTest
 * @package KeithquinndevTest
 */
class StudentTest extends \PHPUnit_Framework_TestCase
{
/*
     public function testCanCreateObject()
     {
         // Arrange
         $s = new Student();

         // Act

         // Assert
         $this->assertNotNull($s);
     }


     public function testgetIdZeroExpected()
     {
         // Arrange
         $s = new Student();
         $s->setId(0);
         $expectedResult = 0;

         // Act
         $result = $s->getId();

         // Assert
         $this->assertEquals($expectedResult, $result);
     }


     public function testsetgetFirstname()
     {
         // Arrange
         $s = new Student();
         $s->setFirstname('Keith');
         $expectedResult = 'Keith';

         // Act
         $result = $s->getFirstname();

         // Assert
         $this->assertEquals($expectedResult, $result);
     }

     public function testgetsetSurname()
     {
         // Arrange
         $s = new Student();
         $s->setSurname('quinn');
         $expectedResult = 'quinn';

         // Act
         $result = $s->getSurname();

         // Assert
         $this->assertEquals($expectedResult, $result);
     }

     public function testsetgetSummary()
     {
         // Arrange
         $s = new Student();
         $s->setSummary('i am a summary');
         $expectedResult = 'i am a summary';

         // Act
         $result = $s->getSummary();

         // Assert
         $this->assertEquals($expectedResult, $result);
     }

    public function testsetgetSkills()
    {
       // Arrange
         $s = new Student();
         $s->setSkills('i am a skill');
         $expectedResult = 'i am a skill';

         // Act
         $result = $s->getSkills();

         // Assert
         $this->assertEquals($expectedResult, $result);
    }


    public function testsetgetPhoto()
    {
        // Arrange
        $s = new Student();
        $s->setPhoto('images/img.png');
        $expectedResult = 'images/img.png';

        // Act
        $result = $s->getPhoto();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testsetgetPrivateComment()
    {
        // Arrange
        $s = new Student();
        $s->setPrivateComment('private comment');
        $expectedResult = 'private comment';

        // Act
        $result = $s->getPrivateComment();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
*/
    public function testsetgetGlobalComment()
    {
        // Arrange
        $s = new Student();
        $s->setGlobalComment('global comment');
        $expectedResult = 'global comment';

        // Act
        $result = $s->getGlobalComment();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}