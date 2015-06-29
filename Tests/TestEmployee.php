<?php
/**
 * Created by PhpStorm.
 * User: abeni
 * Date: 6/25/2015
 * Time: 12:21 AM
 */

require_once("../DAL/Entity/Employee.php");
require_once("../DAL/DAO/EmployeeDAO.php");
require_once("../DAL/Database.php");

use \Entity\Employee;
use \DAO\EmployeeDAO;

class TestEmployee extends PHPUnit_Framework_TestCase {

    /**
     * @var \DAO\EmployeeDAO
     */
    private $dao;
    function  __construct()
    {
       $this->dao =  new EmployeeDAO();
        $this->id = 1;
    }

    private $id;
    public function testEmployeeInsert()
    {
        $emp = new Employee();
        $emp->setEmpName("Emp1");
        $emp->setDob(new DateTime('now'));
        $emp->setGender('M');
        $emp->setUserName("user1");
        $emp->setPassword("1234");
        $emp->setRole("Admin");
        $emp->setMobileNumber("902321321");


        assert( $this->dao->insertEmployee($emp)==true,"Employee Insertion");


    }

    public function testEmployeeGet()
    {
       $emp = $this->dao->getEmployeeById($this->id);
        assert($emp->getEmpName()=="Emp1","Get Employee");

    }
    public function testUpdateEmployee()
    {
        $emp = $this->dao->getEmployeeById($this->id);
        $emp->setEmpName("newEmp");
        $this->dao->updateEmployee($emp);
        assert( $this->dao->getEmployeeById($this->id)->getEmpName()=="newEmp","Employee Update");
    }

    public function testEmployeeDelete()
    {
        assert($this->dao->deleteEmployee($this->dao->getEmployeeById($this->id))==true);

    }






}
