<?php 
session_start();

include "Database Connection.php";
include "Database Function.php";
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
        include "Student_login_header.html";
        echo "<p style=\" font-size: 25px; margin-left: 3%; color: #001641\">Borrower   Log In...</p>";

        $Global_error_message_id = "";
        $Global_error_message_password = "";

        function displayForm() {
        ?>
            <div class="form_section">
                <form action="Page 1_(Log in_Student).php" method="post">

                    <input type="text" placeholder="Borrower ID" name="bor_id">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_id"]; ?> 
                        </div>
                        
                    <input type="text" placeholder="Password" name="password">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_password"]; ?> 
                        </div>
                        <br><br>
                    <input type="submit" name="submit">
                </form>

                <br><br>
                <p>Don't have account? <a href="Page 2_(Registering_Student).php">Create Account.</a></p>
            </div>
        <?php            
        }

        function work_section() {
            $errorCount = 0;

            if (empty($_POST['bor_id'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_name"] = "<p>Borrower ID is empty.</p>";
            }

            if (empty($_POST['password'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_password"] = "<p>Password is empty.</p>";
            }

            if (!check_login_pass($_POST['bor_id'], $_POST['password'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_password"] = "<p>Wrong password entered.</p>";
            }


            if ($errorCount == 0) {
                $bor_id = $_POST['bor_id'];
                $password = $_POST['password'];

                $_SESSION['bID'] = $bor_id;
                $_SESSION['cID'] = $bor_id;

                header('location: Page 6_(Borrower_Home).php?' . SID);
            }
        }

        if (isset($_POST['submit'])) {
            work_section();
        }

        displayForm();
        ?>
        
    </body>
</html>