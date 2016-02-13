<?php

include_once 'Validate.php';
class UserNameValidation implements Validate{

    private $userNam;

    public function __construct($userNam) {
        $this->userNam = $userNam;
    }

    public function check() {
        return $this->checkStringLength() ? false : $this->checkStringAlphaNumericContent();
    }

    public function checkStringLength() {
        return (strlen($this->userNam) > 15 || strlen($this->userNam) < 5);
    }

    private function checkStringAlphaNumericContent() {
        return ctype_alnum($this->userNam);
    }
}