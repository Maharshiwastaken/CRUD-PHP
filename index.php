<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>CRUD</title>
</head>


<body>
        <div class="container">
        <h2>My Shop</h2>
        <h4>Clients</h4>
        <a class="btn btn-primary" href="/PHP/new.php">New Client</a>
        <br>
        <table class = "table table-striped">
            <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

                <?php
                    // Connecting to database
                    include '_dbconnect.php';

                    if($connection -> connect_error) {
                        die("Connection failed: ".$connection->connect_error);
                    }

                    // COde to read all rows from database
                    $sql = "SELECT * FROM customer";
                    $result = $connection->query($sql);

                    //Checking if $result has recieved data or not
                    if(!$result) {
                        die("Invalid query: ".$connection->error);
                    }

                    //read data of each row
                    while($row = $result -> fetch_assoc()) {
                        echo "
                            <tr>
                                <td>$row[sn]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[phone]</td>
                                <td>$row[address]</td>
                                <td>$row[created_at]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/PHP/edit.php?id=$row[sn]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/PHP/delete.php?id=$row[sn]'>Delete</a>
                            </td>
                        </tr>
                        ";  
                    }
                ?>


               
            </tbody>
        </table>
        </div>
</body>
</html>