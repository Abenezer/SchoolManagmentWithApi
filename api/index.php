<?php
require_once 'Slim/Slim.php';
require_once '../DAL/Entity/Employee.php';
require_once '../DAL/DAO/EmployeeDAO.php';
require_once '../DAL/Database.php';
use \Slim\Slim;
use \Entity\Employee;
use \DAO\EmployeeDAO;




Slim::registerAutoloader();



$app = new Slim();
$app->post('/add_emp', 'registerEmployee');
$app->get('/employees', 'getEmployees');
$app->put('/update_emp','updateEmployee');
$app->get('/delete_emp/:id','deleteEmployee');

$app->run();



function getEmployees()
{
    $dao = new EmployeeDAO();
   $emps=  $dao->getAllEmployees();


    echo json_encode($emps);



}


function registerEmployee()
{
    $request = Slim::getInstance()->request();
    $empJson = json_decode($request->getBody());

    $emp = new Employee();
    $emp->parseJsonObject($empJson);

    $dao = new EmployeeDAO();
   if( $dao->insertEmployee($emp))
       echo 'Success';
       else die();


}

function updateEmployee()
{
    $request = Slim::getInstance()->request();

    $empJson = json_decode($request->getBody());

    $emp = new Employee();
    $emp->parseJsonObject($empJson);

    $dao = new EmployeeDAO();
    if( $dao->updateEmployee($emp))
        echo 'Success updating '.$emp->getEmpId();
    else die();


}

function deleteEmployee($id)
{

    $dao = new EmployeeDAO();
    if( $dao->deleteEmployee($dao->getEmployeeById($id)))
        echo 'Success deleting '.$id;
    else die();


}