<?php
/**
 * Created by PhpStorm.
 * User: DAVE
 * Date: 6/27/2015
 * Time: 7:15 AM
 */

require_once("../DAL/Entity/Enrollment.php");
require_once("../DAL/DAO/EnrollmentDAO.php");
require_once("../DAL/Database.php");

class EnrollmentTest extends PHPUnit_Framework_TestCase {

function testEnrollment()
{
    $enrl = new \Entity\Enrollment();
    $enrl->setCourseNumber("INSY");
    $enrl->setStudentId(3);
    $enrl->setRegistrationDate(new DateTime());
    $enrl->setSemester(1);
    $enrl->setYear(3);

    $dao = new \DAO\EnrollmentDAO();
    assert($dao->insertEnrollment($enrl),"inserting enrollment");

    $enrl->setYear(4);
    $dao->updateEnrollment($enrl);

    $enrl = $dao->getEnrollmentById(3,"INSY",false);
    assert($enrl->getYear()==4,"updating enrollment");
    //assert($dao->deleteEnrollment($enrl));
}
}
