<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 13/04/2016
 * Time: 14:34
 * This file creates a new student object from a post in a lecturer page
 */
require_once __DIR__ . '/../app/config_db.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Model/User.php';
require_once __DIR__ . '/../src/Model/Student.php';

use Keithquinndev\User;
use Keithquinndev\Student;

$username = $_REQUEST['username'];
print_r($username . ' username');

// new user
$user = new User();
$user->setUsername($username);
$user->setPassword($username);
$user->setRole(User::ROLE_STUDENT);
$user->setLoggedIn(false);

var_dump($user);

$hisID =  User::getOneById($user->getId());
print_r( $hisID . ' user id');

// add default data
$student = new Student();
$student->setId($user->getId());
$student->setFirstname('John');
$student->setSurname('Doe');
$student->setSummary('please fill in the summary area');
$student->setSkills('add skills here');
$student->setPhoto('/images/default.png');
$student->setGlobalComment('');
$student->setPrivateComment('');

User::insert($user);
Student::insert($student);
var_dump($student);