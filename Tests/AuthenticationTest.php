<?php
/**
 * Created by PhpStorm.
 * User: AssefaDisgner
 * Date: 6/25/2015
 * Time: 1:06 AM
 */

require_once("../DALCode/Services/Authentication.php");
class AuthenticationTest extends PHPUnit_Framework_TestCase {


    private  $auth;

function __construct()
{
    $this->auth = new \Services\Authentication();
}
    public function testLogin()
    {
        assert($this->auth->login("admin","1234")==true);

    }
}
