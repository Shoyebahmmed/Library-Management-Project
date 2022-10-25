<?php 
session_start();
include "Header_with_link_(Librarian).html";

?>
<html>
    <style>
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

        function displayForm() {
        ?>
            <div class="form_section">
                <form action="Page 11_Search_by_status.php" method="post">
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
            $selection = $_POST['status'];
            if ($selection == "Available") {
                display_available_books();
            }

            if ($selection == "Borrowing") {
                display_borrowing_books();
            }

            if ($selection == "Borrowed") {
                display_borrowed_books();
            }

            if ($selection == "Extended") {
                display_extended_borrowed_books();
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