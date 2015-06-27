<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 6/26/2015
 * Time: 4:05 AM
 */

namespace Entity;


class Employee {

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




}