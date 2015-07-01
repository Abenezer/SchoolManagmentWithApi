<?php
/**
 * Created by PhpStorm.
 * User: Lidya
 * Date: 6/30/2015
 * Time: 3:27 PM
 */

namespace DAO;


use Entity\User;
use Database;

class UserDAO {

    /**
     * @var \PDO
     */
    private $db;

    public function __construct()
    {

        $this->db = Database::connect();
    }


    function create_user($row)
    {
        $user = new User();
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setRole($row['role']);
        return $user;
    }


    /**
     * @return array (list of users)
     */
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $res = array();

        foreach ($this->db->query($sql) as $row) {

            array_push($res, $this->create_user($row));
        }
        return $res;


    }

    /**
     * @param $id
     * @return User
     */
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE username=?";
        $query = $this->db->prepare($sql);
        $query->execute(array($id));
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $this->create_user($row);

    }


    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function validateUser($username,$password){
        $sql = "SELECT * FROM users WHERE username=? and password=?";
        $query = $this->db->prepare($sql);

        $query->execute(array($username,$password));

        return $query->rowCount()>0;
    }


}