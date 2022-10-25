<?php 
session_start();
include "Header_with_link_(Librarian).html";

?>
<html>
    <style>

    </style>

    <body>
        <?php
        if (isset($_SESSION['lID']))
            $lID = $_SESSION['lID'] ;
        else	
            $lID = -1;

        include "Database Function.php";

        if ($lID != -1) {
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

