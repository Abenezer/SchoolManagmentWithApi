<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 6/26/2015
 * Time: 4:05 AM
 */

namespace Entity;


class Employee implements \JsonSerializable {

    private $EmpId;
    private $EmpName;
    /**
     * @var \DateTime
     */
    private $dob;

    /**
     * @var char
     */
    private $gender;
    private $username;
    private $password;
    private $role;
    private $mobileNumber;



    public function parseJsonObject($e)
    {
        $this->EmpId = ($e->EmpId)? $e->EmpId:$this->EmpId;
        $this->EmpName = ($e->EmpName)? $e->EmpName:$this->EmpName;
        $this->dob = ($e->dob)? new \DateTime($e->dob):  $this->dob ;
        $this->gender = ($e->gender)?$e->gender: $this->gender;
        $this->username = ($e->username)?$e->username: $this->username;
        $this->password = ($e->password)?$e->password:$this->password;
        $this->mobileNumber = ($e->mobileNumber)? $e->mobileNumber:$this->mobileNumber;
        $this->role = ($e->role)?$e->role:$this->role;

    }

    /**
     * @return mixed
     */
    public function getEmpId()
    {
        return $this->EmpId;
    }

    /**
     * @param mixed $EmpId
     */
    public function setEmpId($EmpId)
    {
        $this->EmpId = $EmpId;
    }

    /**
     * @return mixed
     */
    public function getEmpName()
    {
        return $this->EmpName;
    }

    /**
     * @param mixed $EmpName
     */
    public function setEmpName($EmpName)
    {
        $this->EmpName = $EmpName;
    }

    /**
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param \DateTime $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * @return char
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param char $gender
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
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @param mixed $mobileNumber
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
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