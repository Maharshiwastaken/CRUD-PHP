<?php
    //Connecting to database
    include '_dbconnect.php';

    //Initilizing our variables
    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $successMessage = "";

    // Linking the input fields to the php

    if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST["inputName"];
        $email = $_POST["inputEmail"];
        $phone = $_POST["inputPhone"];
        $address = $_POST["inputAddress"];

        //Checking if all fields are filed
        do {
            if( empty($name) || empty($phone) || empty($email) || empty($address) ) {
                $errorMessage = "All fields are required.";
                break;
            }

            // Insert new customer to database
            //Writing into the database
            $sql = 'INSERT INTO customer (name, email, phone, address)'.
            "VALUES ('$name', '$email', '$phone', '$address')";
            $result = $connection -> query($sql);

            $name = "";
            $email = "";
            $phone = "";
            $address = "";

            $successMessage = "Customer added successfully";

        } while(false);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <h1>New User</h1>

    <!-- Magically appearing error message -->
    <?php
        if(!empty($errorMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='alert alert-danger fade show' role = 'alert'>
                <strong>$errorMessage</strong>
                </div>
            </div>
            ";
        }
    ?>

    <form method = "post">
    <div class="mb-3">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control"  name="inputName" value="<?php echo $name; ?>">
  </div>

    <div class="mb-3">
    <label for="inputEmail" class="form-label">Email address</label>
    <input type="email" class="form-control" name="inputEmail" value ="<?php echo $email; ?>">
  </div>

  <div class="mb-3">
    <label for="inputPhone" class="form-label">Phone number</label>
    <input type="number" class="form-control" name="inputPhone" value="<?php echo $phone; ?>">
  </div>

  <div class="mb-3">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" name="inputAddress" value="<?php echo $address; ?>">
  </div>

  <?php
        if(!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                    <div class='alert alert-success fade show' role = 'alert'>
                    <strong>$successMessage</strong>
                    </div>
            </div>
            ";
        }
    ?>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="/PHP/index.php">Cancel</a>
</form>

    </div>
</body>
</html>