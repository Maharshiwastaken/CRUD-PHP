<?php 
        include '_dbconnect.php';
        $sn ="";

        if ( isset($_GET["id"])) {
            $sn = $_GET["id"];
            $sql = "DELETE FROM customer WHERE sn=$sn";
            $connection->query($sql);

             // Gets a return value if the connection is there between the databasse and php
            $result = $connection->query($sql);
        }
        // Routing
        header("location: /PHP/index.php");
        exit;
?>