<?php

include_once(__DIR__ . '/../src/model/User.php');
include_once(__DIR__ . '/../src/application/db/db.php');

class Test extends PHPUnit_Framework_TestCase{

    public function test_get_user_name(){
        $user = new User("DavidTest","1234");
        $this->assertEquals($user->name(),"DavidTest");
    }

    public function test_get_md5_hashed_password() {
        $user = new User("DavidTest","1234");
        $this->assertEquals($user->hashedPassword(),"81dc9bdb52d04dc20036dbd8313ed055");
    }

    public function test_get_mysql_db_connection() {
        $db = new db();
        $this->assertEquals($db->connect(),true);
        $this->assertEquals($db->disconnect(),true);
    }

    public function test_insert_and_delete_one_user() {
        $db = new db();
        $db->connect();
        $this->assertEquals($db->insertNewUserInTableUsers(new User("DavidTest","1234")),true);
        $this->assertEquals($db->deleteUserWithName("DavidTest"),true);
        $db->disconnect();
    }

    public function test_update_user_name_and_password() {
        $db = new db();
        $db->connect();
        $this->assertEquals($db->insertNewUserInTableUsers(new User("DavidTest","1234")),true);
        $this->assertEquals($db->updateUserNameWithId($db->idOfLastUserInserted(),"DavidTest2"),true);
        $this->assertEquals($db->updateUserPasswordWithId($db->idOfLastUserInserted(),"2252"),true);
        $this->assertEquals($db->deleteUserWithName("DavidTest2"),true);
        $db->disconnect();
    }

    public function test_successful_and_bad_login(){
        $db = new db();
        $db->connect();
        $this->assertEquals($db->insertNewUserInTableUsers(new User("DavidTest","1234")),true);
        $this->assertEquals($db->checkLogin(new User("DavidTest","1234")),true);
        $this->assertEquals($db->checkLogin(new User("fake","1234")),false);
        $this->assertEquals($db->checkLogin(new User("DavidTest","fake")),false);
        $this->assertEquals($db->checkLogin(new User("fake","fake")),false);
        $this->assertEquals($db->deleteUserWithName("DavidTest"),true);
        $db->disconnect();
    }


}
