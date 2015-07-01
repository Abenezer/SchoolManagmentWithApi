<?php
require_once 'Slim/Slim.php';
require_once '../DAL/Entity/Employee.php';
require_once '../DAL/DAO/EmployeeDAO.php';
require_once '../DAL/Entity/Student.php';
require_once '../DAL/DAO/StudentDAO.php';
require_once '../DAL/Entity/Course.php';
require_once '../DAL/DAO/CourseDAO.php';
require_once '../DAL/Database.php';
require_once '../DAL/DAO/EnrollmentDAO.php';
require_once '../DAL/Entity/Enrollment.php';
require_once '../DAL/DAO/UserDAO.php';
require_once '../DAL/Entity/User.php';
use \Slim\Slim;
use \Entity\Employee;
use \DAO\EmployeeDAO;




Slim::registerAutoloader();



$app = new Slim();
$app->post('/employee', 'registerEmployee');
$app->get('/employees', 'getEmployees');
$app->put('/employee','updateEmployee');
$app->delete('/employee/:id','deleteEmployee');


$app->post('/student','registerStudent');
$app->get('/students', 'getStudents');
$app->put('/student','updateStudent');
$app->delete('/student/:id','deleteStudent');


$app->get('/courses','getCourses');
$app->post('/course', 'addCourse');
$app->put('/course','updateCourse');
$app->delete('/course/:id','deleteCourse');


$app->get('/enrollments','getEnrollments');
$app->post('/enrollment', 'addEnrollment');

$app->post('/login', 'login');
$app->get('/login', 'getStatus');
$app->get('/logout', 'logout');

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

    $empJson->EmpId = 0;
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
    $dao = new EmployeeDAO();
    $emp = $dao->getEmployeeById($empJson ->EmpId);
    $emp->parseJsonObject($empJson);


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

function registerStudent()
{
    $request = Slim::getInstance()->request();

    $stdJson = json_decode($request->getBody());

    $stdJson->student_id = 0;// because student_id is autoincrement
    $std = new \Entity\Student();
    $std->parseJsonObject($stdJson);

    $std->setApproved(false);
    $dao = new \DAO\StudentDAO();


    if( $dao->insertStudent($std))
        echo 'Success';
    else die("Error");




}

function getStudents()
{
    $dao = new \DAO\StudentDAO();



    echo json_encode($dao->getAllStudents());

}

function updateStudent()
{
    $request = Slim::getInstance()->request();

    $stdJson = json_decode($request->getBody());

    $dao = new \DAO\StudentDAO();

    $std =$dao->getStudentById( $stdJson->student_id);
    $std->parseJsonObject($stdJson);




    if( $dao->updateStudent($std))
        echo 'Success updating Student '.$std->getStudentId();
    else die('Error');


}

function deleteStudent($id)
{

    $dao = new \DAO\StudentDAO();
    if( $dao->deleteStudent($dao->getStudentById($id)))
        echo 'Success deleting student'.$id;
    else die('Error');

}


function getCourses()
{
    $dao = new \DAO\CourseDAO();
    echo json_encode($dao->getAllCourses());

}

function addCourse()
{
    $request = Slim::getInstance()->request();

    $crsJson = json_decode($request->getBody());

    $crs= new \Entity\Course();
    $crs->parseJsonObject($crsJson);
    $dao = new \DAO\CourseDAO();


    if( $dao->insertCourse($crs))
        echo 'Success';
    else die("Error");


}

function updateCourse()
{
    $request = Slim::getInstance()->request();

    $crsJson = json_decode($request->getBody());
    $dao = new \DAO\CourseDAO();;
    $crs = $dao->getCourseById($crsJson->courseNumber);
    $crs->parseJsonObject($crsJson);

    if( $dao->updateCourse($crs))
        echo 'Success updating course'.$crs->getCourseNumber();
    else die("Error");




}

function deleteCourse($id)
{
    $dao = new \DAO\CourseDAO();
    if( $dao->deleteCourse($dao->getCourseById("021")))
        echo 'Success deleting course'.$id;
    else die('Error');



}


function getEnrollments()
{
    $dao = new \DAO\EnrollmentDAO();
    echo json_encode($dao->getAllEnrollments(true));

}

function addEnrollment()
{

    $request = Slim::getInstance()->request();

    $enrlJson = json_decode($request->getBody());

    $enrlJson->semester = 1;

    $enrl = new \Entity\Enrollment();
    $enrl->parseJsonObject($enrlJson);


    $dao = new \DAO\EnrollmentDAO();


    if( $dao->insertEnrollment($enrl))
    {
        $stddao = new \DAO\StudentDAO();
       $student= $stddao->getStudentById($enrl->getStudentId());
        $student->setApproved(true);
        $stddao->updateStudent($student);

    }
    else
   Slim::getInstance()->response->setStatus(404);



}

function login(){
    $request = Slim::getInstance()->request();

    $user = json_decode($request->getBody());

    $dao = new \DAO\UserDAO();
    session_start();
     if($dao->validateUser($user->username,$user->password)) {

         $u = $dao->getUserById($user->username);

         $_SESSION["loggedIn"] = true;
         $_SESSION["username"] = $u->getUsername();
         $_SESSION["role"] = $u->getRole();
     }
    else
    {

       session_destroy();
    }


}


function getStatus()
{


    $status = array("loggedIn"=>false,"username"=>"",'role'=>"");

    session_start();
    if(isset($_SESSION["loggedIn"])&&$_SESSION["loggedIn"])
    $status = array("loggedIn"=>true,'username'=>$_SESSION["username"],'role'=>$_SESSION["role"]);



    echo(json_encode($status));

}



function logout()
{
    session_start();
    session_destroy();


}