<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 31/03/2016
 * Time: 12:13
 */

namespace Keithquinndev;

use Mattsmithdev\PdoCrud\DatabaseTable;
use Symfony\Component\HttpFoundation\Tests\StringableObject;

/**
 * Class User
 * @package Keithquinndev
 */
class User extends DatabaseTable
{

    /**
     * constaint/defined variables for user roles
     * student = 1
     * lecturer = 2
     * employer = 3
     */
    const ROLE_STUDENT = 1;
    const ROLE_LECTURER = 2;
    const ROLE_EMPLOYER = 3;
    /**
     * auto increment id
     * @var integer
     */
    public $id;
    /**
     * username of user
     * @var string
     */
    private $username;
    /**
     * password of user
     * @var string
     */
    private $password;
    /**
     * role value 1,2,3
     * @var integer
     */
    private $role;
    /**
     * is logged in
     * true or false
     * @var boolean
     */
    private $logged_in;

    /**
     * getter for logged in
     * true if logged in
     * false if not
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $this->logged_in;
    }

    /**
     * setter for logged in
     * @param boolean $logged_in
     */
    public function setLoggedIn($logged_in)
    {
        $this->logged_in = $logged_in;
    }

    /**
     * getter for role of each user 1,2,3
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * setter for role
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * getter for id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setter for id
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getter for user name
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * setter for user name
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * getter for password
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * setter for password
     * hash encryption
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;
    }
}
