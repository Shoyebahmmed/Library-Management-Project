<?php 
session_start();
include "Header_with_link_(Librarian).html";

?>
<html>
    <style> 
        .error {
        color: red;
        font-size: small;
        margin-left: 3%;
        }

        .form_section{
        margin-left: 22%;
        margin-top: 5%;
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
        input[type=text] {
        width: 70%;
        padding: 12px 20px;
        margin: 8px;
        box-sizing: border-box;
        border: 2px solid rgb(88, 236, 255);
        border-radius: 30px;
        }

    </style>

    <body>
        <?php
        if (isset($_SESSION['lID']))
            $lID = $_SESSION['lID'] ;
        else	
            $lID = -1;

        include "Database Function.php";
        

        if ($lID != -1) {

            $Global_error_message_title = "";
            $Global_error_message_isbn = "";
            $Global_error_message_auther = "";



            function displayForm() {
                ?>
                    <div class="form_section">
                        <form action="Page 10_Search.php" method="post">
                            <input type="text" placeholder="Auther Name" name="au_name"> 
                            <div class="error">
                                <?php echo $GLOBALS["Global_error_message_auther"]; ?> 
                            </div>  

                            <input type="text" placeholder="Title" name="title">
                            <div class="error">
                                <?php echo $GLOBALS["Global_error_message_title"]; ?> 
                            </div>

                            <input type="text" placeholder="ISBN" name="isbn">
                            <div class="error">
                                <?php echo $GLOBALS["Global_error_message_isbn"]; ?> 
                            </div> 

                            <br><br>
                            <input type="submit" name="submit">
                        </form>
                    </div>
                <?php            
                }
        
                function work_section() {
                    $errorCount = 0;

                    if (empty($_POST['au_name'])) {
                        $errorCount += 1;
                        $GLOBALS["Global_error_message_auther"] = "<p>Author Name is empty.</p>";
                    }
        
                    if (empty($_POST['title'])) {
                        $errorCount += 1;
                        $GLOBALS["Global_error_message_title"] = "<p>Title is empty.</p>";
                    }
        
                    if (empty($_POST['isbn'])) {
                        $errorCount += 1;
                        $GLOBALS["Global_error_message_isbn"] = "<p>ISBN is empty.</p>";
                    }
                    
                    
                    if ($errorCount == 0) {
                        include "Book.php";

                        $au_name = $_POST['au_name'];
                        $title = $_POST['title'];
                        $isbn = $_POST['isbn'];

                        $book_list = select_from_book_table();

                        foreach ($book_list as $list) {
                            if (strpos($list->getISBN(), $isbn) !== false || strpos($list->getTitle(), $title) !== false || strpos($list->getAuthor(), $au_name) !== false) {
                                ?>
                                <div class="output_box">
                                    <img src="bg.jpg" height="300" width="210"><br>
                                    <P style="font-size: 20px; font-family: 'Archivo', sans-serif; margin-top: 6%;">
                                        <?php 
                                            echo strlen($list->getTitle()) > 15 ? substr($list->getTitle(),0,15)."..." : $list->getTitle();;
                                        ?>
                                    </p>
                    
                                    <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                                        <?php 
                                            echo $list->getAuthor();
                                        ?>
                                    </p>
                    
                                    <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                                        <?php 
                                            echo "Rent Cost: $" . $list->getregularCost() . " per day.";
                                        ?>
                                    </p>
                    
                                    <P style="font-size: 15px; font-family: 'Archivo', sans-serif; margin-top: 0%; margin-bottom: 2%">
                                        <?php 
                                            echo "ISBN: " . $list->getISBN();
                                        ?>
                                    </p>
                                </div>
                            <?php
                            }
                        }
                        //header('location: Page 3_(Log in_Librarian).php');
                    }
                }
        
            if (isset($_POST['submit'])) {
                work_section();
            }
        
            displayForm();
        }
        else {
            ?>
            <div>
                <p style="font-size: 30px; color: red;">Error 707: Somthig Wrong...</p>
            </div>
            <?php
        }

        ?>
        
    </body>
</html>

