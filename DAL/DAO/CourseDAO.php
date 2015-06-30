<?php
/**
 * Created by PhpStorm.
 * User: Lidya
 * Date: 6/26/2015
 * Time: 7:06 AM
 */

namespace DAO;


use \Entity\Course;
use Database;

class CourseDAO {

    /**
     * @var \PDO
     */
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
    private function create_course($row)
    {
        $course = new Course();
        $course->setCourseNumber($row['courseNumber']);
        $course->setCourseName($row['courseName']);
        $course->setCreditHour($row['creditHour']);
        $course->setContactHour($row['contactHour']);
      return $course;
    }

    public  function getCourseById($id)
    {
        $sql = "SELECT * FROM course WHERE courseNumber=?";
        $param = array($id);
        $query = $this->db->prepare($sql);

         $query->execute($param);

        $row = $query->fetch(\PDO::FETCH_ASSOC);



        return $this->create_course($row);
    }

    /**
     * @return array
     */
    public function getAllCourses()
    {
        $sql = "SELECT * FROM Course";
        $res = array();

        foreach ($this->db->query($sql) as $row) {

            array_push($res, $this->create_course($row));
        }
        return $res;

    }

    public function insertCourse(Course $c)
    {

        $sql = "INSERT INTO course VALUES(?,?,?,?)";
        $params = array($c->getCourseNumber(),$c->getCourseName(),$c->getCreditHour(),$c->getContactHour());

       $query= $this->db->prepare($sql);
        return $query->execute($params);
    }
    public function deleteCourse(Course $course)
    {
        $sql = "DELETE FROM Course  WHERE courseNumber=?";
        $query = $this->db->prepare($sql);
        $res = $query->execute(array($course->getCourseNumber()));
        return $res;

    }
    public function updateCourse(Course $c)
    {
        $sql = "UPDATE course  SET courseName = ?, creditHour= ?, contactHour = ?  WHERE courseNumber=?";


        $params = array($c->getCourseName(), $c->getCreditHour(),$c->getContactHour(),$c->getCourseNumber());

        $query= $this->db->prepare($sql);
        $res=   $query->execute($params);

        return $res;


    }
}