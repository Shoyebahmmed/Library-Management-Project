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


        function displayForm() {
        ?>
            <div class="form_section">
                <form action="Page 7_Change_status.php" method="post">

                    <input type="text" placeholder="ISBN" name="isbn">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_isbn"]; ?> 
                        </div>

                        <label for="status">Choose the Status:</label>
                        <select id="status" name="status" class="status">
                            <option value="Available">Available</option>
                            <option value="Borrowing">Borrowing</option>
                            <option value="Borrowed">Borrowed</option>
                            <option value="Extended">Extended</option>
                        </select>
                        
                        <br><br>
                    <input type="submit" name="submit">
                </form>
            </div>
        <?php            
        }

        function work_section() {
            $errorCount = 0;

            if (empty($_POST['isbn'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_isbn"] = "<p>ISBN is empty.</p>";
            }


            if ($errorCount == 0) {
                $book_isbn = $_POST['isbn'];
                $selection = $_POST['status'];
                change_status_by_isbn($book_isbn, $selection);
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