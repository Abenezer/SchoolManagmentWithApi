<?php
/**
 * Created by PhpStorm.
 * User: DAVE
 * Date: 6/27/2015
 * Time: 5:15 AM
 */

namespace Entity;


class Student implements \JsonSerializable {
    private $student_id;
    Private $FirstName;
    Private $LastName;
    /**
     * @var \DateTime
     */
    Private $dob;
    Private $gender;
    Private $username;
    Private $password;
    /**
     * @var bool
     */
    Private $approved;


    /**
     * @var array (list of enrollments )
     */
    private $enrollments;

    /**
     * @return array
     */
    public function getEnrollments()
    {
        return $this->enrollments;
    }

    /**
     * @param array $enrollments
     */
    public function setEnrollments($enrollments)
    {
        $this->enrollments = $enrollments;
    }

    /**
     * @return boolean
     */
    public function isApproved()
    {
        return $this->approved;
    }

    /**
     * @param boolean $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }


    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->student_id;
    }

    /**
     * @param mixed $student_id
     */
    public function setStudentId($student_id)
    {
        $this->student_id = $student_id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param mixed $FirstName
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param mixed $LastName
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param mixed $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
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
        $this->password = $password;
    }






    public function parseJsonObject($s)
    {
        $this->student_id = ($s->student_id)?$s->student_id:$this->student_id ;
        $this->FirstName= ($s->FirstName)? $s->FirstName: $this->FirstName;
        $this->LastName = ($s->LastName)?$s->LastName :$this->LastName ;
        $this->dob = ($s->dob)? new \DateTime($s->dob):  $this->dob ;
        $this->gender = ($s->gender)?$s->gender: $this->gender;
        $this->username = ($s->username)?$s->username: $this->username;
        $this->password = ($s->password)?$s->password:$this->password;



    }


    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        $vars = clone $this;
        $vars->dob = $vars->dob->format("y/m/d");
        return get_object_vars($vars);
    }
}