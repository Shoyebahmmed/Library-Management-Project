<html>
    <style>
.output_box {
        border: 1px;
        border-radius: 5px;
        display: inline-block;
        max-width:250px;
        max-height: 440px;
        background-color: #FFF3CD ;
        padding: 10px;
        margin-bottom: 2%;
        margin-left: 5%;
    }
    .output_container {
        display: block;
        width: 85%;
        margin: auto;
        margin-top: 3%;
    }
    input[type=submit] {
        background-color: #42c9ff;
        border: none;
        color: white;
        padding: 12px 32px;
        text-decoration: none;
        cursor: pointer;
        border-radius: 30px;
        }  


    </style>

<?php

include "Book.php";

function insert_into_librarian_table($tablename, $value1, $value2, $value3, $value4, $value5) {
    include "Database Connection.php";

    $sql = "INSERT INTO $tablename (ID, Name, Surname, Phone, Email)
            VALUES ('$value1', '$value2', '$value3', '$value4', '$value5')";

    $conn->query($sql);
}

function insert_into_borrowed_table($value1, $value2) {
    include "Database Connection.php";
    $tablename = "borrowed";

    $sql = "INSERT INTO $tablename (Bor_ID, ISBN)
            VALUES ('$value1', '$value2')";

    $conn->query($sql);
}


function insert_into_borrower_table($tablename, $value1, $value2, $value3, $value4, $value5) {
    include "Database Connection.php";

    $sql = "INSERT INTO $tablename (ID, Name, Surname, Phone, Email)
            VALUES ('$value1', '$value2', '$value3', '$value4', '$value5')";
    
    $conn->query($sql);
}


function insert_into_book_table($tablename, $value1, $value2, $value3, $value4, $value5, $value6, $value7) {
    include "Database Connection.php";

    $sql = "INSERT INTO $tablename (ISBN, Title, Author, Publisher, Status, Regular_Cost, Extended_Cost)
            VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7')";
    
    $conn->query($sql);
}

function insert_into_login_table($tablename, $value1, $value2) {
    include "Database Connection.php";

    $sql = "INSERT INTO $tablename (ID, Password)
            VALUES ('$value1', '$value2')";
    
    $conn->query($sql);
}


function select_from_librarian_table($tablename) {
    include "Database Connection.php";
    include "Librarian.php";

    $librarian_list = array();

    $sql = "SELECT * FROM $tablename";
    $qRes = mysqli_query($conn, $sql);
    while (($Row = mysqli_fetch_assoc($qRes)) != FALSE) {
        $lib_id = $Row['ID'];
        $lib_name = $Row['Name'];
        $lib_surname = $Row['Surname'];
        $lib_phone = $Row['Phone'];
        $lib_email = $Row['Email'];

        $libraian = new Libraian($lib_id, $lib_name, $lib_surname, $lib_phone, $lib_email);
        $librarian_list[] = $libraian;
    }

    return $librarian_list;
}


function select_from_borrowed_table() {
    include "Database Connection.php";
    include "Borrowed.php";
    $tablename = "Borrowed";
    $borrowed_list = array();

    $sql = "SELECT * FROM $tablename";
    $qRes = mysqli_query($conn, $sql);
    while (($Row = mysqli_fetch_assoc($qRes)) != FALSE) {
        $bro_id = $Row['Bor_ID'];
        $bro_isbn = $Row['ISBN'];

        $bro_book = new Borrowed($bro_id, $bro_isbn);
        $borrowed_list[] = $bro_book;
    }

    return $borrowed_list;
}


function select_from_borrower_table($tablename) {
    include "Database Connection.php";
    include "Borrower.php";

    $borrower_list = array();

    $sql = "SELECT * FROM $tablename";
    $qRes = mysqli_query($conn, $sql);
    while (($Row = mysqli_fetch_assoc($qRes)) != FALSE) {
        $bor_id = $Row['ID'];
        $bor_name = $Row['Name'];
        $bor_surname = $Row['Surname'];
        $bor_phone = $Row['Phone'];
        $bor_email = $Row['Email'];

        $borrower = new Borrower($bor_id, $bor_name, $bor_surname, $bor_phone, $bor_email);
        $borrower_list[] = $borrower;
    }

    return $borrower_list;
}


function select_from_book_table() {
    include "Database Connection.php";
    

    $book_list = array();
    $tablename = "Book";

    $sql = "SELECT * FROM $tablename";
    $qRes = mysqli_query($conn, $sql);

    while (($Row = mysqli_fetch_assoc($qRes)) != FALSE) {
        $BookNo = $Row['Book_No'];
        $ISBN = $Row['ISBN'];
        $Title = $Row['Title'];
        $Author = $Row['Author'];
        $Publisher = $Row['Publisher'];
        $Status = $Row['Status'];
        $regular_cost_per_day = $Row['Regular_Cost'];
        $extended_cost_per_day = $Row['Extended_Cost'];

        $b = new Book($BookNo, $ISBN, $Title, $Author, $Publisher, $Status, $regular_cost_per_day, $extended_cost_per_day);
        $book_list[] = $b;
    }

    return $book_list;
}

function display_available_books() {
    include "Database Connection.php";
    //include "Book.php";

    $ava_book_list = select_from_book_table();

    // if (!$ava_book_list) {
    //     echo "Nooo";
    // } 
    // else {
    //     echo "Yesss";
    // }

    ?>
     <div class="output_container">
    <?php
    foreach ($ava_book_list as $av_book) {
        //echo $av_book->getStatus() . "<br>";
        if ($av_book->getStatus() == "Available") {
            ?>
            <div class="output_box">
                <img src="bg.jpg" height="300" width="210"><br>
                <P style="font-size: 20px; font-family: 'Archivo', sans-serif; margin-top: 6%;">
                    <?php 
                        echo strlen($av_book->getTitle()) > 15 ? substr($av_book->getTitle(),0,15)."..." : $av_book->getTitle();;
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo $av_book->getAuthor();
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "Rent Cost: $" . $av_book->getregularCost() . " per day.";
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "ISBN: " . $av_book->getISBN();
                    ?>
                </p>
            </div>
        <?php
        }
        // else
        //     echo "None...";
    }
    ?>
    </div>
    <?php
}

function get_details_by_ISBN($ISBN) {
    include "Database Connection.php";
    $ava_book_list = select_from_book_table();
    $output_error = 0;

    foreach ($ava_book_list as $av_book) {
        if ($av_book->getISBN() == $ISBN) {
            ?>
            <div style="text-align: center; width: 100%; position: relative;">
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Book Name: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getTitle();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">ISBN: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getISBN();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Author: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getAuthor();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Publisher: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getPublisher();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Status: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getStatus();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Regular Rent Price: </p>
                    <p style="padding: 10px;">
                        <?php echo "$" . $av_book->getregularCost() . "/day";?>
                    </p>
                    <?php 
                        $float_amount = floatval($av_book->getregularCost());
                        $total = $float_amount * 5;
                    ?>
                    <p style="padding: 10px;">For 5 days total cost will be = </p>
                    <p style="padding: 10px;">
                        <?php echo "$" . $total;?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                <p style="padding: 10px;">If you want to extend each day will cost above amount + extend rent.</p>
                    <p style="font-weight: bold; padding: 10px;">Extended Rent Price: </p>
                    <p style="padding: 10px;">
                        <?php echo "$" . $av_book->getextendedCostr() . "/day (extra)";?>
                    </p>
                </div>
            </div>
            <?php
            $output_error = 0;
            break;
        }
        else {
            $output_error ++;
        }
    }
    if ($output_error != 0) {
        ?>
        <div>
            <p style="font-size: 30px; color: red;">This Book is not available at the moment.</p>
        </div>
        <?php
    }


}


function add_to_borrowed($ISBN, $borr_id) {
    include "Database Connection.php";
    //include "Book.php";
    $ava_book_list = array();
    $ava_book_list = select_from_book_table();
    $output_error = 0;
    foreach ( $ava_book_list as $av_book) {
        if ($av_book->getISBN() == $ISBN && $av_book->getStatus() == "Available") {
            change_status_by_isbn($ISBN, "Borrowed");
            insert_into_borrowed_table($borr_id, $ISBN);
            get_details_by_ISBN($ISBN);
            $output_error = 0;
            break;
        }
        else {
            $output_error ++;
        }
    }

    if ($output_error != 0) {
        ?>
        <div>
            <p style="font-size: 30px; color: red;">This Book is not available at the moment.</p>
        </div>
        <?php
    }

}

function display_borrowed_books_by_ID($borro_ID) {
    include "Database Connection.php";
    
    $borrowed_list_byID = array();
    $borrowed_list = select_from_borrowed_table();

    foreach ( $borrowed_list as $list) {
        if ($list->getBorID() == $borro_ID) {
            $borrowed_list_byID[] = $list->getBroISBN();
        }
    }


    $all_book_list = select_from_book_table();
    foreach ( $all_book_list as $a_book) {
        if(in_array($a_book->getISBN(), $borrowed_list_byID)) {
            ?>
            <div class="output_box">
                <img src="bg.jpg" height="300" width="210"><br>
                <P style="font-size: 20px; font-family: 'Archivo', sans-serif; margin-top: 6%;">
                    <?php 
                        echo strlen($a_book->getTitle()) > 15 ? substr($a_book->getTitle(),0,15)."..." : $a_book->getTitle();;
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo $a_book->getAuthor();
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "Rent Cost: $" . $a_book->getregularCost() . " per day.";
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "ISBN: " . $a_book->getISBN();
                    ?>
                </p>
            </div>
            <?php
        }
    }


}

function display_borrowed_books() {
    include "Database Connection.php";
    //include "Book.php";

    $ava_book_list = select_from_book_table();

    // if (!$ava_book_list) {
    //     echo "Nooo";
    // } 
    // else {
    //     echo "Yesss";
    // }

    ?>
     <div class="output_container">
    <?php
    foreach ($ava_book_list as $av_book) {
        //echo $av_book->getStatus() . "<br>";
        if ($av_book->getStatus() == "Borrowed") {
            ?>
            <div class="output_box">
                <img src="bg.jpg" height="300" width="210"><br>
                <P style="font-size: 20px; font-family: 'Archivo', sans-serif; margin-top: 6%;">
                    <?php 
                        echo strlen($av_book->getTitle()) > 15 ? substr($av_book->getTitle(),0,15)."..." : $av_book->getTitle();;
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo $av_book->getAuthor();
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "Rent Cost: $" . $av_book->getregularCost() . " per day.";
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "ISBN: " . $av_book->getISBN();
                    ?>
                </p>
            </div>
        <?php
        }
        // else
        //     echo "None...";
    }
    ?>
    </div>
    <?php
}

function display_extended_borrowed_books() {
    include "Database Connection.php";
    //include "Book.php";

    $ava_book_list = select_from_book_table();

    // if (!$ava_book_list) {
    //     echo "Nooo";
    // } 
    // else {
    //     echo "Yesss";
    // }

    ?>
     <div class="output_container">
    <?php
    foreach ($ava_book_list as $av_book) {
        if ($av_book->getStatus() == "Extended") {
            ?>
            <div class="output_box">
                <img src="bg.jpg" height="300" width="210"><br>
                <P style="font-size: 20px; font-family: 'Archivo', sans-serif; margin-top: 6%;">
                    <?php 
                        echo strlen($av_book->getTitle()) > 15 ? substr($av_book->getTitle(),0,15)."..." : $av_book->getTitle();;
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo $av_book->getAuthor();
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "Rent Cost: $" . $av_book->getregularCost() . " per day.";
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "ISBN: " . $av_book->getISBN();
                    ?>
                </p>
            </div>
        <?php
        }
        // else
        //     echo "None...";
    }
    ?>
    </div>
    <?php
}

function display_borrowing_books() {
    include "Database Connection.php";
    //include "Book.php";

    $ava_book_list = select_from_book_table();

    // if (!$ava_book_list) {
    //     echo "Nooo";
    // } 
    // else {
    //     echo "Yesss";
    // }

    ?>
     <div class="output_container">
    <?php
    foreach ($ava_book_list as $av_book) {
        //echo $av_book->getStatus() . "<br>";
        if ($av_book->getStatus() == "Borrowing") {
            ?>
            <div class="output_box">
                <img src="bg.jpg" height="300" width="210"><br>
                <P style="font-size: 20px; font-family: 'Archivo', sans-serif; margin-top: 6%;">
                    <?php 
                        echo strlen($av_book->getTitle()) > 15 ? substr($av_book->getTitle(),0,15)."..." : $av_book->getTitle();;
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo $av_book->getAuthor();
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "Rent Cost: $" . $av_book->getregularCost() . " per day.";
                    ?>
                </p>

                <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                    <?php 
                        echo "ISBN: " . $av_book->getISBN();
                    ?>
                </p>
            </div>
        <?php
        }
        // else
        //     echo "None...";
    }
    ?>
    </div>
    <?php
}

function update_book_database($book_list) {
    include "Database Connection.php";
    $tablename = "Book";

    $sql = "DELETE FROM $tablename";
    $conn->query($sql);

    foreach ($book_list as $av_book) {
        insert_into_book_table($tablename, $av_book->getISBN(), $av_book->getTitle(), $av_book->getAuthor(), $av_book->getPublisher(), $av_book->getStatus(), $av_book->getregularCost(), $av_book->getextendedCostr());
    }

    
}

function change_status_by_isbn($isbn, $selection) {
    include "Database Connection.php";

    $ava_book_list = select_from_book_table();
    foreach ($ava_book_list as $av_book) {
        if ($av_book->getISBN() == $isbn) {
            $av_book->setStatus($selection);
        }
    }

    update_book_database($ava_book_list);
}


function change_status_extend($isbn, $borrower_ID) {
    include "Database Connection.php";

    $borrowed_list_byID = array();
    $borrowed_list = select_from_borrowed_table();

    foreach ( $borrowed_list as $list) {
        if ($list->getBorID() == $borrower_ID) {
            $borrowed_list_byID[] = $list->getBroISBN();
        }
    }

    $error_out = 0;
    $ava_book_list = select_from_book_table();
    foreach ($ava_book_list as $av_book) {
        if ($av_book->getISBN() == $isbn && in_array($av_book->getISBN(), $borrowed_list_byID)) {
            
            $av_book->setStatus("Extended");

            //------------------------------------------------------------------------
            ?>
            <div style="text-align: center; width: 100%; position: relative;">
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Book Name: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getTitle();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">ISBN: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getISBN();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Author: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getAuthor();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Publisher: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getPublisher();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Status: </p>
                    <p style="padding: 10px;">
                        <?php echo $av_book->getStatus();?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="font-weight: bold; padding: 10px;">Regular Rent Price: </p>
                    <p style="padding: 10px;">
                        <?php echo "$" . $av_book->getregularCost() . "/day";?>
                    </p>
                    <?php 
                        $float_amount = floatval($av_book->getregularCost());
                        $total = $float_amount * 5;
                    ?>
                    <p style="padding: 10px;">For 5 days your total cost = </p>
                    <p style="padding: 10px;">
                        <?php echo "$" . $total;?>
                    </p>
                </div>
                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                
                    <p style="font-weight: bold; padding: 10px;">Extended Rent Price: </p>
                    <p style="padding: 10px;">
                        <?php echo "$" . $av_book->getextendedCostr() . "/day (extra)";?>
                    </p>
                </div>

                <?php 
                        $float_extra_amount = floatval($av_book->getextendedCostr());
                        $extra_total = $float_amount + $float_extra_amount;
                ?>

                <br><br>
                <div class="outputDetails" style="display: flex; position: absolute; left: 25%;">
                    <p style="padding: 10px;">As you have extend the time now every day will cost = </p>
                    <p style="padding: 10px;">
                            <?php echo "$" . $extra_total;?>
                    </p>
                </div>

                
            </div>
            <?php
            $error_out = 0;
            break;
            //------------------------------------------------------------------------
        }
        else {
            $error_out++;
        }
    }
    if ($error_out != 0) {
        ?>
        <div>
            <p style="font-size: 30px; color: red;">You can not change the state of this book.</p>
        </div>
        <?php
    }
    else {
        update_book_database($ava_book_list);
    }   
}


function check_login_pass($bid, $bpass) {
    include "Database Connection.php";
    include "Login.php";

    $tablename = "login";


    $sql = "SELECT * FROM $tablename";
    $qRes = mysqli_query($conn, $sql);
    while (($Row = mysqli_fetch_assoc($qRes)) != FALSE) {
        $id = $Row['ID'];
        $password = $Row['Password'];

        $pass = md5($bpass);

        if ($id == $bid && $password == $pass) {
            return true;
        }
    }

    return false;
}



?>

</html>