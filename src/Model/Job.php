<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 26/04/2016
 * Time: 16:25
 */

namespace Keithquinndev\Model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Job
 * @package Keithquinndev
 */
class Job extends DatabaseTable
{
    /**
     * auto increment id for each job entry
     * @var int
     */
    private $id;
    /**
     * employer id of job sent
     * @var int
     */
    private $employer_id;
    /**
     * title of job
     * @var string
     */
    private $title;
    /**
     * job details
     * @var string
     */
    private $details;
    /**
     * deadline of job
     * @var int
     */
    private $deadline;

    /**
     * getter for id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setter for id
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getter for employer id
     * @return int
     */
    public function getEmployerId()
    {
        return $this->employer_id;
    }

    /**
     * setter for employer id
     * @param int $employer_id
     */
    public function setEmployerId($employer_id)
    {
        $this->employer_id = $employer_id;
    }

    /**
     * getter for job title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * setter for job title
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * getter for job details
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * setter for job details
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * getter for job deadline
     * @return int
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * setter for job deadline
     * @param int $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

}