<?php
/**
 * Created by PhpStorm.
 * User: DAVE
 * Date: 6/27/2015
 * Time: 6:49 AM
 */

namespace Entity;


class Enrollment implements \JsonSerializable {

    private $student_id;
    private $courseNumber;

    /**
     * @var \DateTime
     */
    private $registrationDate;

    /**
     * @var int
     */
    private $semester;
    /**
     * @var int
     */
    private $year;


    /**
     * @var Student
     */
    private $Student;

    /**
     * @var Course
     */
    private $Course;


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
    public function getCourseNumber()
    {
        return $this->courseNumber;
    }

    /**
     * @param mixed $courseNumber
     */
    public function setCourseNumber($courseNumber)
    {
        $this->courseNumber = $courseNumber;
    }

    /**
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * @param \DateTime $registrationDate
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }

    /**
     * @return int
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * @param int $semester
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return Student
     */
    public function getStudent()
    {
        return $this->Student;
    }

    /**
     * @param Student $Student
     */
    public function setStudent($Student)
    {
        $this->Student = $Student;
        $this->student_id= $Student->getStudentId();
    }

    /**
     * @return Course
     */
    public function getCourse()
    {
        return $this->Course;
    }

    /**
     * @param Course $Course
     */
    public function setCourse($Course)
    {
        $this->Course = $Course;
        $this->courseNumber = $Course->getCourseNumber();
    }



    public function parseJsonObject($e)
    {
        $this->student_id =  $e->Student? $e->Student->student_id:$this->student_id ;
        $this->courseNumber = $e->courseNumber?   $e->courseNumber:   $this->courseNumber;
        $this->registrationDate = $e->registrationDate?   new \DateTime($e->registrationDate):  $this->registrationDate;
        $this->year = $e->year? $e->year: $this->year;
        $this->semester = $e->semester?$e->semester:$this->semester;
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
        $var = clone $this;
            $var->registrationDate = $this->registrationDate->format('m/d/Y');
        return get_object_vars($var);
    }
}