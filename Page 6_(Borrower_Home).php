<?php 
session_start();
include "Header_with_link_(Borrower).html";

?>
<html>
    <style>

    </style>

    <body>
        <?php
        if (isset($_SESSION['bID']))
            $bID = $_SESSION['bID'] ;
        else	
            $bID = -1;

        include "Database Function.php";

        if ($bID != -1) {
            ?>
            <div>
                <p style="font-size: 30px; margin-left: 5%;">Available Books...</p>
            </div>
            <?php
            display_available_books();

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

