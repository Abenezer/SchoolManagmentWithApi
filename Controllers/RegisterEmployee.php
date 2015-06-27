<?php
/**
 * Created by PhpStorm.
 * User: Lidya
 * Date: 6/26/2015
 * Time: 12:51 PM
 */
require_once("../DAL/Entity/Employee.php");
require_once("../DAL/DAO/EmployeeDAO.php");
use \Entity\Employee;
use \DAO\EmployeeDAO;


$emp = new Employee();

$emp->setEmpName($_POST["empName"]);
$emp->setGender($_POST["gender"]);
$emp->setDob(new DateTime($_POST["dob"]));
$emp->setMobileNumber($_POST["mobileNumber"]);
$emp->setUsername($_POST["username"]);
$emp->setPassword($_POST["password"]);
$emp->setRole($_POST["role"]);

//@TODO Do validation

$dao = new EmployeeDAO();
$dao->insertEmployee($emp);