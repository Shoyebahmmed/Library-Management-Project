<?php
include "Database Function.php";
include "Book.php";

$book_list = select_from_book_table();
$book_name_list = array();
$book_isbn_list = array();
$book_author_list = array();

foreach ($book_list as $av_book) {
    echo "1";
    $book_name_list[] = $av_book->getTitle();
    $book_isbn_list[] = $av_book->getISBN();
    $book_author_list[] = $av_book->getAuthor();
}

$q = $_GET["q"];

$hint = "";
// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($book_name_list as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>
