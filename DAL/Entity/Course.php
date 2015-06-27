<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 6/26/2015
 * Time: 4:50 AM
 */

namespace Entity;

class Course
{
    private $courseNumber;
    private $courseName;
    private $creditHour;
    private $contactHour;

    public function getCourseNumber()
    {
        return $this->courseNumber;
    }

    public function setCourseNumber($courseNumber)
    {
        $this->courseNumber = $courseNumber;
    }

    /**
     * @return mixed
     */
    public function getCourseName()
    {
        return $this->courseName;
    }

    /**
     * @param mixed $courseName
     */
    public function setCourseName($courseName)
    {
        $this->courseName = $courseName;
    }

    /**
     * @return mixed
     */
    public function getCreditHour()
    {
        return $this->creditHour;
    }

    /**
     * @param mixed $creditHour
     */
    public function setCreditHour($creditHour)
    {
        $this->creditHour = $creditHour;
    }

    /**
     * @return mixed
     */
    public function getContactHour()
    {
        return $this->contactHour;
    }

    /**
     * @param mixed $contactHour
     */
    public function setContactHour($contactHour)
    {
        $this->contactHour = $contactHour;
    }

    /**
     * @var \PDO
     */
//    private $db;
//    public function insert()
//    {
//
//       $this->db = Database::connect();
//        $sql = "INSERT INTO course VALUES($this->courseNumber,$this->courseName,$this->creditHour,$this->contactHour)";
//
//        $this->db->exec($sql);
//
//    }


}