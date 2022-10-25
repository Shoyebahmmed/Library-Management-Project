<?php
class Book
{
    private $BookNo;
    private $ISBN;
    private $Title;
    private $Author;
    private $Publisher;
    private $Status;
    private $regular_cost_per_day;
    private $extended_cost_per_day;

    function __construct($BookNo, $ISBN, $Title, $Author, $Publisher, $Status, $regular_cost_per_day, $extended_cost_per_day) {
        $this->BookNo = $BookNo;
        $this->ISBN = $ISBN;
        $this->Title = $Title;
        $this->Author = $Author;
        $this->Publisher = $Publisher;
        $this->Status = $Status;
        $this->regular_cost_per_day = $regular_cost_per_day;
        $this->extended_cost_per_day = $extended_cost_per_day;
    }

    public function getBookNo() {
        return $this->BookNo;
    }

    public function getISBN() {
        return $this->ISBN;
    }

    public function getTitle() {
        return $this->Title;
    }

    public function getAuthor() {
        return $this->Author;
    }

    public function getPublisher() {
        return $this->Publisher;
    }

    public function getStatus() {
        return $this->Status;
    }

    public function getregularCost() {
        return $this->regular_cost_per_day;
    }

    public function getextendedCostr() {
        return $this->extended_cost_per_day;
    }

    public function setTitle($Title) {
        $this->Title = $Title;
    }

    public function setAuthor($Author) {
        $this->Author = $Author;
    }

    public function setPublisher($Publisher) {
        $this->Publisher = $Publisher;
    }

    public function setStatus($Status) {
        $this->Status = $Status;
    }

    public function setRegularPrice($regular_cost_per_day) {
        $this->regular_cost_per_day = $regular_cost_per_day;
    }

    public function setExtendedPrice($extended_cost_per_day) {
        $this->extended_cost_per_day = $extended_cost_per_day;
    }


    public function hello() {
        return "I am a " . $this -> Name . "<br />"; 
    }
}


    // $l1 = new Libraian("123", "ABC", "XYZ", "01234567", "abcd@.com");
    // echo $l1->hello();

?>