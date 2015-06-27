<?php
/**
 * Created by PhpStorm.
 * User: DAVE
 * Date: 6/27/2015
 * Time: 6:49 AM
 */

namespace Entity;


class Enrollment {

    private $student_Id;
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
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->student_Id;
    }

    /**
     * @param mixed $student_Id
     */
    public function setStudentId($student_Id)
    {
        $this->student_Id = $student_Id;
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




}