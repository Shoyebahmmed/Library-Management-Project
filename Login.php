<?php
class Login
{
    private $ID;
    private $Password;

    function __construct($ID, $Password) {
        $this->ID = $ID;
        $this->Password = $Password;
    }

    public function getID() {
        return $this->ID;
    }

    public function getPassword() {
        return $this->Password;
    }

    

    public function setName($Password) {
        $this->Password = $Password;
    }

}


    // $l1 = new Libraian("123", "ABC", "XYZ", "01234567", "abcd@.com");
    // echo $l1->hello();

?>