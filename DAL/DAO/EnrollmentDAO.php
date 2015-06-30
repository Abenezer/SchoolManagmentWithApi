<?php
/**
 * Created by PhpStorm.
 * User: DAVE
 * Date: 6/27/2015
 * Time: 6:54 AM
 */

namespace DAO;


use Entity\Enrollment;
use \Database;

class EnrollmentDAO {

    private $db;

    public function __construct()
    {

        $this->db = Database::connect();
    }

    public function getAllEnrollments($isEager)
    {
        $sql = "SELECT * FROM enrollment";
        $res = array();

        foreach ($this->db->query($sql) as $row) {

            array_push($res, $this->create_enrollment($row,$isEager));
        }
        return $res;


    }
    public function getEnrollmentById($student_id,$courseNumber,$isEager)
    {
        $sql = "SELECT * FROM enrollment WHERE student_Id=? AND courseNumber=?" ;
        $query = $this->db->prepare($sql);
        $query->execute(array($student_id,$courseNumber));
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $this->create_enrollment($row,$isEager);

    }


    public function insertEnrollment(Enrollment $e)
    {

        $sql = "INSERT INTO enrollment  VALUES (?,?,?,?,?)";
        $params = array($e->getStudentId(),$e->getCourseNumber(),$e->getRegistrationDate()->format("y/m/d"),$e->getSemester(),$e->getYear()) ;
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute($params);


        return $res;

    }

    public function updateEnrollment(Enrollment $e)
    {
        $sql = "UPDATE enrollment set registrationDate=?,semester=?,year=? WHERE student_Id=? and courseNumber=?";

        $params = array($e->getRegistrationDate()->format("y/m/d"),$e->getSemester(),$e->getYear(),$e->getStudentId(),$e->getCourseNumber()) ;


        $query= $this->db->prepare($sql);
        $res=   $query->execute($params);

        return $res;




    }

    public function  deleteEnrollment(Enrollment $e)
    {
        $sql = "DELETE FROM enrollment WHERE student_Id=? and courseNumber=?";
        $query = $this->db->prepare($sql);
        $res = $query->execute(array($e->getstudentId(),$e->getCourseNumber()));
        return $res;

    }

    private function create_enrollment($row,$isEager)
    {
        $obj = new Enrollment();

        $obj->setStudentId($row["student_Id"]);
        $obj->setCourseNumber($row["courseNumber"]);
        $obj->setRegistrationDate(new \DateTime($row["registrationDate"]));
        $obj->setSemester($row["semester"]);
        $obj->setYear($row["year"]);

        if ($isEager) {
            $courseDao = new CourseDAO();
            $studentDap = new StudentDAO();
            $obj->setCourse($courseDao->getCourseById($row["courseNumber"]));
            $obj->setStudent($studentDap->getStudentById($row["student_Id"]));

        }



        return $obj;
    }

    public function getLastId()
    {
        return $this->db->lastInsertId("student_Id") ;

    }

}