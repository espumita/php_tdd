<?php

class DB {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbName = "php_tdd";
    private $port = "3306";
    private $connection;

    public function connect() {
        $this->connection = new mysqli($this->host,$this->user,$this->pass,$this->dbName,$this->port);
        return $this->connection->connect_error ? false : true;
    }

    public function disconnect(){
        return $this->connection->close();
    }

    public function insertNewUserInTableUsers(User $newUser) {
        return $this->connection->query("INSERT INTO users (user,hashedPassword) VALUES ('".$newUser->name()."','".$newUser->hashedPassword()."')");
    }

    public function deleteUserWithName($userName) {
        return $this->connection->query("DELETE FROM users WHERE user = '".$userName."'");
    }

    public function updateUserNameWithId($id, $userNewName) {
        return $this->connection->query("UPDATE users SET user = '".$userNewName."' WHERE id = '".$id."'");
    }

    public function idOfLastUserInserted() {
        return mysqli_insert_id($this->connection);
    }

    public function updateUserPasswordWithId($id,Password $userNewPassword) {
        return $this->connection->query("UPDATE users SET hashedPassword = '".$userNewPassword->md5Hash()."' WHERE id = '".$id."'");
    }

    public function checkLogin(User $User) {
        if($select =  $this->connection->query("SELECT * FROM users WHERE user ='".$User->name()."' AND hashedPassword = '".$User->hashedPassword()."'")){
            if(mysqli_num_rows($select)) return true;
        }
        return false;
    }


}