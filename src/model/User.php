<?php
include_once 'Password.php';
class User {

    private $userNickName;
    private $hashedPassword;

    public function __construct($userNickName, $password) {
        $this->userNickName = $userNickName;
        $this->hashedPassword = (new Password($password))->md5Hash();
    }

    public function name() {
        return $this->userNickName;
    }

    public function hashedPassword() {
        return $this->hashedPassword;
    }
}