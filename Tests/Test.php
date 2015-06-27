<?php
/**
 * Created by PhpStorm.
 * User: Lidya
 * Date: 6/26/2015
 * Time: 6:04 AM
 */

require_once("../DAL/Entity/Employee.php");
require_once("../DAL/Entity/Course.php");
require_once("../DAL/DAO/CourseDAO.php");
require_once("../DAL/Database.php");

use \Entity\Employee;
use \Entity\Course;
use \DAO\CourseDAO;

class Test extends PHPUnit_Framework_TestCase {




    public function testEmp()
    {

        $emp = new Employee();
        $emp->setEmpID("001");
        assert($emp->getEmpId()=="001","Emp set method test");
    }


    public function testIntertCourse()
    {
        $course = new Course();
        $course->setCourseNumber("091");
        $course->setCourseName("IS");
        $course->setCreditHour(4);
        $course->setContactHour(7);

        $dao = new CourseDAO();
        $dao->insertCourse($course);

       assert( $dao->getCourse("091")->getCourseName()=="IS");

    }


    public function testUpdate()
    {
        $dao = new CourseDAO();
        $crs = $dao->getCourse("091");
        $crs->setCourseName("IT");

        $dao->updateCourse($crs);

        assert($dao->getCourse("091")->getCourseName()=="IT");

    }

    public function testDelete()
    {
        $dao =new CourseDAO();
        $crs= $dao->getCourse("091");


        assert($dao->deleteCourse($crs));


    }


}


