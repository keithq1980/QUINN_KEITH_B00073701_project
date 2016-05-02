<?php
/**
 * Created by PhpStorm.
 * User: keith_000
 * Date: 29/04/2016
 * Time: 16:33
*/

namespace Keithquinndev\Model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Detail
 * @package Keithquinndev\Model
 */

class Detail extends DatabaseTable
{
    /**
     * auto increment id for each entry
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
}
