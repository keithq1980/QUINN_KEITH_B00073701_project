<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 26/04/2016
 * Time: 22:38
 */
namespace KeithquinndevTest;

use Keithquinndev\Model\Job;

class JobTest extends \PHPUnit_Framework_TestCase
{

    /*
    public function testCanCreateObject()
    {
        // Arrange
        $job = new Job();

        // Act

        // Assert
        $this->assertNotNull($job);
    }
    public function testgetIdZeroExpected()
    {
        // Arrange
        $job = new Job();
        $job->setId(0);
        $expectedResult = 0;

        // Act
        $result = $job->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testgetEmployerId()
    {
        // Arrange
        $job = new Job();
        $job->setEmployerId(6);
        $expectedResult = 6;

        // Act
        $result = $job->getEmployerId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testgetTitle()
    {
        // Arrange
        $job = new Job();
        $job->setTitle('title');
        $expectedResult = 'title';

        // Act
        $result = $job->getTitle();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testgetDetails()
    {
        // Arrange
        $job = new Job();
        $job->setDetails('some detail');
        $expectedResult = 'some detail';

        // Act
        $result = $job->getDetails();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
*/
    public function testgetDeadline()
    {
        // Arrange
        $job = new Job();
        $job->setDeadline(123456789);
        $expectedResult = 123456789;

        // Act
        $result = $job->getDeadline();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

}