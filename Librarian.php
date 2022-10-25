<?php
class Libraian
{
    private $ID;
    private $Name;
    private $Surname;
    private $Phone;
    private $e_mail;

    function __construct($ID, $Name, $Surname, $Phone, $e_mail) {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Surname = $Surname;
        $this->Phone = $Phone;
        $this->e_mail = $e_mail;
    }

    public function getID() {
        return $this->ID;
    }

    public function getName() {
        return $this->Name;
    }

    public function getSurname() {
        return $this->Surname;
    }

    public function getPhone() {
        return $this->Phone;
    }

    public function getEmail() {
        return $this->e_mail;
    }

    public function setName($name) {
        $this->Name = $name;
    }

    public function setSurname($Surname) {
        $this->Surname = $Surname;
    }

    public function setPhone($phone) {
        $this->Phone = $phone;
    }

    public function setEmail($email) {
        $this->e_mail = $email;
    }


    public function hello() {
        return "I am a " . $this -> Name . "<br />"; 
    }
}


    // $l1 = new Libraian("123", "ABC", "XYZ", "01234567", "abcd@.com");
    // echo $l1->hello();

?>