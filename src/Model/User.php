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
     * const/defined variables for roles
     */
    const ROLE_STUDENT = 1;
    const ROLE_LECTURER = 2;
    const ROLE_EMPLOYER = 3;
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var integer
     */
    private $role;
    /**
     * @var boolean
     */
    private $logged_in;

    /**
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $this->logged_in;
    }

    /**
     * @param boolean $logged_in
     */
    public function setLoggedIn($logged_in)
    {
        $this->logged_in = $logged_in;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;

    }

}