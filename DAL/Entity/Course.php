<?php
/**
 * Created by PhpStorm.
 * User: user1
 * Date: 6/26/2015
 * Time: 4:50 AM
 */

namespace Entity;

class Course implements \JsonSerializable
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





    public function parseJsonObject($c)
    {
        $this->courseNumber= ($c->courseNumber)? $c->courseNumber:$this->courseNumber;
        $this->courseName= ($c->courseName)? $c->courseName:$this->courseName;
        $this->creditHour= ($c->creditHour)? $c->creditHour:$this->creditHour;
        $this->contactHour= ($c->contactHour)? $c->contactHour:$this->contactHour;


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
        return get_object_vars($this);
    }
}