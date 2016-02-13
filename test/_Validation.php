<?php
include_once(__DIR__ . '/../src/model/validation/UserNameValidation.php');

class _Validation extends PHPUnit_Framework_TestCase {
    public function test_validate_user_name() {
        $this->assertFalse((new UserNameValidation("asdfghjklasdfghj"))->check());
        $this->assertTrue((new UserNameValidation("asdfghjklasdfgh"))->check());
        $this->assertFalse((new UserNameValidation("asdf"))->check());
        $this->assertTrue((new UserNameValidation("asdfg"))->check());
        $this->assertFalse((new UserNameValidation(""))->check());
        $this->assertTrue((new UserNameValidation("123123"))->check());
        $this->assertTrue((new UserNameValidation("pepe33"))->check());
        $this->assertFalse((new UserNameValidation("            "))->check());
        $this->assertFalse((new UserNameValidation("; Select * from users;"))->check());
        $this->assertFalse((new UserNameValidation("; xcvý5♣ 5♠56"))->check());
        $this->assertFalse((new UserNameValidation("aa aa"))->check());
        $this->assertFalse((new UserNameValidation("aaaa "))->check());
        $this->assertFalse((new UserNameValidation("ñññññ"))->check());
        $this->assertTrue((new UserNameValidation("óooóó"))->check());
        $this->assertFalse((new UserNameValidation("_%%^_a12"))->check());
    }
}
