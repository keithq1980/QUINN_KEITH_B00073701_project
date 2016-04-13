<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 03/04/2016
 * Time: 15:25
 * This seed file creates user objects and stores them in a db table using
 */
require_once __DIR__ . '/../app/config_db.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Model/User.php';
require_once __DIR__ . '/../src/Model/Student.php';

use Keithquinndev\User;
use Keithquinndev\Student;


$joe = new User();
$joe->setUsername('joe');
$joe->setPassword('bloggs');
$joe->setRole(User::ROLE_STUDENT);
$joe->setLoggedIn(false);

$keith = new User();
$keith->setUsername('keith');
$keith->setPassword('keith');
$keith->setRole(User::ROLE_STUDENT);
$keith->setLoggedIn(false);

// add some data about user keith into student table
$student = new Student();
$student->setId($joe->getId());
$student->setFirstname('John');
$student->setSurname('Doe');
$student->setSummary('please fill in the summary area');
$student->setSkills('add skills here');
$student->setPhoto('/images/default.png');
$student->setGlobalComment('');
$student->setPrivateComment('');

// add some data about user keith into student table
$student2 = new Student();
$student2->setId($keith->getId());
$student2->setFirstname('John');
$student2->setSurname('Doe');
$student2->setSummary('please fill in the summary area');
$student2->setSkills('add skills here');
$student2->setPhoto('/images/default.png');
$student2->setGlobalComment('');
$student2->setPrivateComment('');

$tony = new User();
$tony->setUsername('tony');
$tony->setPassword('keane');
$tony->setRole(User::ROLE_LECTURER);
$tony->setLoggedIn(false);

$matt = new User();
$matt->setUsername('matt');
$matt->setPassword('smith');
$matt->setRole(User::ROLE_LECTURER);
$matt->setLoggedIn(false);

$emp1 = new User();
$emp1->setUsername('ibm');
$emp1->setPassword('ibm');
$emp1->setRole(User::ROLE_EMPLOYER);
$emp1->setLoggedIn(false);

$emp2 = new User();
$emp2->setUsername('hp');
$emp2->setPassword('hp');
$emp2->setRole(User::ROLE_EMPLOYER);
$emp2->setLoggedIn(false);

User::insert($joe);
User::insert($keith);
User::insert($tony);
User::insert($matt);
User::insert($admin);
User::insert($emp1);
User::insert($emp2);

Student::insert($student);
Student::insert($student2);

$users = User::getAll();
$studentKeith = Student::getAll();


var_dump($users);
var_dump($studentKeith);