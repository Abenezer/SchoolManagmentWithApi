<?php


namespace DAO;


use Entity\Employee;
use  Database;

class EmployeeDAO {


    /**
     * @var \PDO
     */
    private  $db;

    public function __construct()
    {

        $this->db = Database::connect();
    }




    public function getAllEmployees()
    {
        $sql = "SELECT * FROM employee";
        $res = array();

        foreach ($this->db->query($sql) as $row) {

            array_push($res, $this->create_employee($row));
        }
        return $res;



    }

    public function getEmployeeById($id)
    {
        $sql = "SELECT * FROM employee WHERE EmpId=?";
        $query = $this->db->prepare($sql);
        $query->execute(array($id));
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $this->create_employee($row);

    }


    public function insertEmployee(Employee $employee)
    {

          $sql = "INSERT INTO employee  VALUES (?,?,?,?,?,?,?,?)";
        $params = array($employee->getEMPID(),$employee->getEmpName(),$employee->getDob()->format("y/m/d"),$employee->getGender(),$employee->getUserName(),$employee->getPassword(),$employee->getRole(),$employee->getMobileNumber()) ;
       $stmt = $this->db->prepare($sql);
       $res = $stmt->execute($params);
        $employee->setEmpId($this->getLastId());

        return $res;

    }

    public function updateEmployee(Employee $e)
    {
        $sql = "UPDATE employee SET EmpName = ?, gender=? , dob= ?, username = ?, password = ?, role = ?, mobileNumber = ? "
            . "WHERE EmpId = ?";

        $params = array($e->getEmpName(), $e->getGender(), $e->getDob()->format("y/m/d"),$e->getUsername(), $e->getPassword(), $e->getRole(), $e->getMobileNumber(), $e->getEMPID());

       $query= $this->db->prepare($sql);
        $res=   $query->execute($params);

return $res;




    }

    public function  deleteEmployee(Employee $employee)
    {
        $sql = "DELETE FROM employee WHERE EmpId=?";
        $query = $this->db->prepare($sql);
        $res = $query->execute(array($employee->getEMPID()));
        return $res;

    }

    private function create_employee($row)
    {
        $obj = new Employee();
        $obj->setEMPID($row["EmpId"]);
        $obj->setEmpName($row["EmpName"]);
        $obj->setDob(new \DateTime($row["dob"]));
        $obj->setGender($row["gender"]);
        $obj->setUsername($row["userName"]);
        $obj->setPassword($row["password"]);
        $obj->setRole($row["role"]);
        $obj->setMobileNumber($row["mobileNumber"]);
        return $obj;
    }

    public function getLastId()
    {
       return $this->db->lastInsertId("EmpId") ;

    }

}