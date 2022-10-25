<?php 

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
        input[type=text],
        input[type=password] {
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
        echo "<p style=\" font-size: 25px; margin-left: 3%; color: #001641\">Borrower Details...</p>";

        $Global_error_message_name = "";
        $Global_error_message_surname = "";
        $Global_error_message_phone = "";
        $Global_error_message_email = "";
        $Global_error_message_password = "";

        function displayForm() {
        ?>
            <div class="form_section">
                <form action="Page 2_(Registering_Student).php" method="post">

                    <input type="text" placeholder="Name" name="bor_name">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_name"]; ?> 
                        </div>
                        
                    <input type="text" placeholder="Surname" name="surname">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_surname"]; ?> 
                        </div>

                    <input type="text" placeholder="Phone" name="bor_phone">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_phone"]; ?> 
                        </div>
                        
                    <input type="text" placeholder="Email" name="bor_email">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_email"]; ?> 
                        </div>

                    <input type="password" placeholder="Password" name="password">
                        <div class="error">
                            <?php echo $GLOBALS["Global_error_message_password"]; ?> 
                        </div>
                        <br><br>
                    <input type="submit" name="submit">
                </form>
            </div>
        <?php            
        }

        function work_section() {
            $errorCount = 0;
            $email_formate = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)*(\.[a-zA-Z]{2,})$/";
            $number_formate = "/^[0-9]{2}\s[0-9]{4}\s[0-9]{4}$/";

            if (empty($_POST['bor_name'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_name"] = "<p>Borrower Name is empty.</p>";
            }

            if (empty($_POST['surname'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_surname"] = "<p>Surname is empty.</p>";
            }

            if (empty($_POST['bor_phone'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_phone"] = "<p>Phone Number is empty.</p>";
            }
            elseif (!preg_match($number_formate, $_POST['bor_phone'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_phone"] = "<p>Phone Number should be (XX XXXX XXXX) formate.</p>";
            }

            if (empty($_POST['bor_email'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_email"] =  "<p>Email is empty.</p>";
            } 
            elseif (!preg_match($email_formate, $_POST['bor_email'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_email"] = "<p>Email is not valid.</p>";
            }

            if (empty($_POST['password'])) {
                $errorCount += 1;
                $GLOBALS["Global_error_message_password"] =  "<p>Email is empty.</p>";
            } 


            if ($errorCount == 0) {
                $bor_name = $_POST['bor_name'];
                $surname = $_POST['surname'];
                $bor_phone = $_POST['bor_phone'];
                $bor_email = $_POST['bor_email'];

                $temp_password = $_POST['password'];
                $password = md5($temp_password);
                
                $ThreeDigitRandomNumber = rand(100,999);
                $bor_id = $bor_name[0] . $bor_name[1] . strval($ThreeDigitRandomNumber);

                insert_into_borrower_table("Borrower", $bor_id, $bor_name, $surname, $bor_phone, $bor_email);
                insert_into_login_table("Login", $bor_id, $password);

                echo "<script type='text/javascript'>alert('Borrower ID = {$bor_id}');</script>";

                //header('location: Page 1_(Log in_Student).php');
            }
        }

        if (isset($_POST['submit'])) {
            work_section();
        }

        displayForm();
        ?>
        
    </body>
</html>