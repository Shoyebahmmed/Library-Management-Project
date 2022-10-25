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
        include "Librarian_login_header.html";
        echo "<p style=\" font-size: 25px; margin-left: 3%; color: #001641\">Librarian Log In...</p>";

        $Global_error_message_id = "";
        $Global_error_message_password = "";

        function displayForm() {
        ?>
            <div class="form_section">
                <form action="Page 3_(Log in_Librarian).php" method="post">

                    <input type="text" placeholder="Librarian ID" name="lib_id">
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
                <p>Don't have account? <a href="Page 4_(Registering_Librarian).php">Create Account.</a></p>
            </div>
        <?php            
        }

        function work_section() {
            $errorCount = 0;

            if (empty($_POST['lib_id'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_name"] = "<p>Borrower ID is empty.</p>";
            }

            if (empty($_POST['password'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_password"] = "<p>Password is empty.</p>";
            }

            if (!check_login_pass($_POST['lib_id'], $_POST['password'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_password"] = "<p>Wrong password entered.</p>";
            }


            if ($errorCount == 0) {
                $lib_id = $_POST['lib_id'];
                $password = $_POST['password'];

                $_SESSION['lID'] = $lib_id;

                header('location: Page 5_(Librarian_Home).php?' . SID);
            }
        }

        if (isset($_POST['submit'])) {
            work_section();
        }

        displayForm();
        ?>
        
    </body>
</html>