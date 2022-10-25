    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "Assignment";
    $tcp = "1234";


    try {
        $conn = mysqli_connect($servername, $username, $password, $db);
    }
    catch (mysqli_sql_exception $e) {
        die("Connection failed:" . mysqli_connect_errno() . "=" . mysqli_connect_error());
    }
 ?>   
