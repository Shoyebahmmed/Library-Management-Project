<?php 
session_start();
include "Header_with_link_(Borrower).html";

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
        if (isset($_SESSION['bID']))
            $bID = $_SESSION['bID'] ;
        else	
            $bID = -1;

        include "Database Function.php";

        if ($bID != -1) {

            $Global_error_message_isbn = "";
            $Global_bID = $bID;

            function displayForm() {
            ?>
                <div class="form_section">
                    <form action="Page 17_Extend_Borrowing.php" method="post">
    
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
    
                if (empty($_POST['isbn'])) {
                    $errorCount += 1;
                    $GLOBALS["Global_error_message_isbn"] = "<p>ISBN is empty.</p>";
                }
    
    
                if ($errorCount == 0) {
                    $book_isbn = $_POST['isbn'];
                    change_status_extend($book_isbn, $GLOBALS["Global_bID"]);
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