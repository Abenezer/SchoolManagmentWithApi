<?php
/**
 * Created by PhpStorm.
 * User: DAVE
 * Date: 6/27/2015
 * Time: 5:57 AM
 */

require_once("../DAL/Entity/Student.php");
require_once("../DAL/DAO/StudentDAO.php");
require_once("../DAL/Database.php");
use \Entity\Student;
class StudentTest extends PHPUnit_Framework_TestCase {


private $dao ;

    function __construct()
    {
        $this->dao =  new \DAO\StudentDAO();
    }
    function testStudentInsert()
    {
        $std = new Student();
        $std->setFirstName("abebe");
        $std->setLastName("kebede");
        $std->setDob(new DateTime("12/10/2000"));
        $std->setGender("M");
        $std->setUserName("abe");
        $std->setPassword("kebe");
        $std->setApproved(true);


       assert( $this->dao->insertStudent($std));

    }

    function testStudentUpdate()
    {
       $std = $this->dao->getStudentById(1);
        $std->setFirstName("helen");
        $std->setGender("F");
        $this->dao->updateStudent($std);
        assert($this->dao->getStudentById(1)->getFirstName()=="helen");
    }

    function testStudnetDelete()
    {
        $std = $this->dao->getStudentById(1);
        assert($this->dao->deleteStudent($std));
    }

}
