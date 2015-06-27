<?php
/**
 * Created by PhpStorm.
 * User: DAVE
 * Date: 6/27/2015
 * Time: 5:15 AM
 */

namespace DAO;
use Entity\Student;
use Database;

class StudentDAO
{
    /**
     * @var \PDO
     */
    private $db;

    public function __construct()
    {

        $this->db = Database::connect();
    }

    public function getAllStudent()
    {
        $sql = "SELECT * FROM Student";
        $res = array();

        foreach ($this->db->query($sql) as $row) {

            array_push($res, $this->create_Student($row));
        }
        return $res;


    }
    public function getStudentById($id)
    {
        $sql = "SELECT * FROM Student WHERE student_Id=?";
        $query = $this->db->prepare($sql);
        $query->execute(array($id));
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $this->create_Student($row);

    }


    public function insertStudent(Student $Student)
    {

        $sql = "INSERT INTO Student  VALUES (?,?,?,?,?,?,?,?)";
        $params = array($Student->getStudentId(),$Student->getFirstName(),$Student->getLastName(),$Student->getDob()->format("y/m/d"),$Student->getGender(),$Student->getUserName(),$Student->getPassword(),$Student->isApproved()) ;
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute($params);
        $Student->setStudentId($this->getLastId());

        return $res;

    }

    public function updateStudent(Student $student)
    {
        $sql = "UPDATE Student SET FirstName = ?, LastName=?, gender=? , dob= ?, username = ?, password = ?, approved = ?"
            . "WHERE student_Id = ?";

        $params = array($student->getFirstName(),$student->getLastName(), $student->getGender(), $student->getDob()->format("y/m/d"),$student->getUsername(), $student->getPassword(), $student->isApproved(), $student->getStudentId());

        $query= $this->db->prepare($sql);
        $res=   $query->execute($params);

        return $res;




    }

    public function  deleteStudent(Student $Student)
    {
        $sql = "DELETE FROM Student WHERE student_Id=?";
        $query = $this->db->prepare($sql);
        $res = $query->execute(array($Student->getstudentId()));
        return $res;

    }

    private function create_student($row)
    {
        $obj = new student();
        $obj->setstudentId($row["student_Id"]);
        $obj->setFirstName($row["FirstName"]);
        $obj->setLastName($row["LastName"]);
        $obj->setDob(new \DateTime($row["dob"]));
        $obj->setGender($row["gender"]);
        $obj->setUsername($row["UserName"]);
        $obj->setPassword($row["password"]);
        $obj->setapproved($row["approved"]);
        return $obj;
    }

    public function getLastId()
    {
        return $this->db->lastInsertId("student_Id") ;

    }

}
