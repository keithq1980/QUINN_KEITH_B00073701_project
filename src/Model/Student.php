<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 07/04/2016
 * Time: 14:06
 */

namespace Keithquinndev;
use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Student
 * @package Keithquinndev
 */

class Student extends DatabaseTable
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $surname;
    /**
     * @var string
     */
    private $summary;
    /**
     * @var string
     */
    private $skills;
    /**
     * @var string
     */
    private $photo;
    /**
     * @var string
     */
    private $global_comment;
    /**
     * @var string
     */
    private $private_comment;

    /**
     * @return string
     */
    public function getGlobalComment()
    {
        return $this->global_comment;
    }

    /**
     * @param string $global_comment
     */
    public function setGlobalComment($global_comment)
    {
        $this->global_comment = $global_comment;
    }

    /**
     * @return string
     */
    public function getPrivateComment()
    {
        return $this->private_comment;
    }

    /**
     * @param string $private_comment
     */
    public function setPrivateComment($private_comment)
    {
        $this->private_comment = $private_comment;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

}