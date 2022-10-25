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

        .status {
        width: 40%;
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

        $Global_error_message_isbn = "";
        $Global_error_message_nssage_title = "";
        $Global_error_message_author = "";
        $Global_error_message_publisher = "";
        $Global_error_message_reg_price = "";
        $Global_error_message_ext_price = "";


        function displayForm() {
        ?>
            <div class="form_section">
                <form action="Page 12_Add_Book.php" method="post">

                    <input type="text" placeholder="ISBN" name="book_isbn">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_isbn"]; ?> 
                        </div>
                        
                    <input type="text" placeholder="Title" name="book_title">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_nssage_title"]; ?> 
                        </div>

                    <input type="text" placeholder="Author" name="book_author">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_author"]; ?> 
                        </div>
                        
                    <input type="text" placeholder="Publisher" name="book_publisher">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_publisher"]; ?> 
                        </div>

                    <label for="status">Choose the Status:</label>
                    <select id="status" name="status" class="status">
                        <option value="Available">Available</option>
                        <option value="Borrowing">Borrowing</option>
                        <option value="Borrowed">Borrowed</option>
                        <option value="Extended">Extended</option>
                    </select>

                    <input type="text" placeholder="Regular Rent Price" name="book_reg_price">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_reg_price"]; ?> 
                        </div>
                        
                    <input type="text" placeholder="Extended Rent Price" name="book_ext_price">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_ext_price"]; ?> 
                        </div>

                        <br><br>
                    <input type="submit" name="submit">
                </form>
            </div>
        <?php            
        }

        function work_section() {
            $errorCount = 0;

            if (empty($_POST['book_isbn'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_isbn"] = "<p>ISBN is empty.</p>";
            }

            if (empty($_POST['book_title'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_nssage_title"] = "<p>Title is empty.</p>";
            }

            if (empty($_POST['book_author'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_author"] = "<p>Author name is empty.</p>";
            }

            if (empty($_POST['book_publisher'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_publisher"] = "<p>Publisher name is empty.</p>";
            }

            if (empty($_POST['book_reg_price'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_reg_price"] =  "<p>Regular rent price is empty.</p>";
            } 

            if (empty($_POST['book_ext_price'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_ext_price"] =  "<p>Extended rent price is empty.</p>";
            } 


            if ($errorCount == 0) {
                $book_isbn = $_POST['book_isbn'];
                $book_title = $_POST['book_title'];
                $book_author = $_POST['book_author'];
                $book_publisher = $_POST['book_publisher'];
                $selection = $_POST['status'];
                $book_reg_price = $_POST['book_reg_price'];
                $book_ext_price = $_POST['book_ext_price'];

                insert_into_book_table("Book", $book_isbn, $book_title, $book_author, $book_publisher, $selection, $book_reg_price, $book_ext_price);
                header('location: Page 12_Add_Book.php?' . SID);
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