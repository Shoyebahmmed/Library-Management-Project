<?php
class Borrowed
{
    private $Bor_ID;
    private $ISBN;

    function __construct($Bor_ID, $ISBN) {
        $this->Bor_ID = $Bor_ID;
        $this->ISBN = $ISBN;
    }

    public function getBorID() {
        return $this->Bor_ID;
    }

    public function getBroISBN() {
        return $this->ISBN;
    }

}


    // $l1 = new Libraian("123", "ABC", "XYZ", "01234567", "abcd@.com");
    // echo $l1->hello();

?>