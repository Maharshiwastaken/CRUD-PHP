<?php 

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "php";

        $connection = new mysqli($servername, $username, $password, $database);

        $sn ="";

        if ( isset($_GET["id"])) {
            $sn = $_GET["id"];
            $sql = "DELETE FROM customer WHERE sn=$sn";
            $connection->query($sql);

             // Gets a return value if the connection is there bwteen the databasse and php
            $result = $connection->query($sql);
        }

        header("location: /PHP/index.php");
        exit;
?>