<?php
include_once 'Password.php';
class User {

    private $userNickName;
    private $hashedPassword;

    public function __construct($userNickName, Password $password) {
        $this->userNickName = $userNickName;
        $this->hashedPassword = $password->md5Hash();
    }

    public function name() {
        return $this->userNickName;
    }

    public function hashedPassword() {
        return $this->hashedPassword;
    }
}