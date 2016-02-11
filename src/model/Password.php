<?php

class password {

    private $password;

    public function __construct($password) {
        $this->password = $password;
    }

    public function md5Hash(){
        return md5($this->password);
    }


}