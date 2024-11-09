<?php 
  // Connecting to database
  include '_dbconnect.php';

  // Initializing our variables
  $sn = "";
  $name = "";
  $email = "";
  $phone = "";
  $address = "";

  $errorMessage = "";
  $successMessage = "";

  //Get method : Show the data of the client
  if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {


  //If SN doesnt exist, then we redirect the user back to the index
    if (!isset($_GET["id"])) {
      header("location : /PHP/index.php");
      exit;
    }

    //Reading the customer serial number from the link provided
    $sn = $_GET["id"];

    //read the row of the selected customer from the database table and display it on input fields
    $sql = "SELECT * FROM customer WHERE sn = $sn";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    // If we do not have data in row, i.e the user data doesnt exist, then we redirect to index
    if (!$row) {
      header("location: /PHP/index.php");
      exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];

  }
  else {
    //Post method : Update the data of the client
    $sn = $_POST["inputSn"];
    $name = $_POST["inputName"];
    $email = $_POST["inputEmail"];
    $phone = $_POST["inputPhone"];
    $address = $_POST["inputAddress"];


    //TO make sure that we do not have an empty field
    do {
      if( empty($name) || empty($email) || empty($phone) || empty($address)) {
        $errorMessage = "All the fields are required.";
        break;
      }
      
      //Update the database if we have data on the forms
      $sql = 'UPDATE customer '."SET name = '$name', email = '$email', phone = '$phone', address = '$address'". "WHERE sn = '$sn';";

      // Gets a return value if the connection is there between the database and php
      $result = $connection->query($sql);

      // If the result value is not true, we display error
      if (!$result) {
        $errorMessage = "Invalid query: ".$connection->error;
        break;
      }

      $successMessage = "Customer data updated successfully.";

      header("location: /PHP/index.php");
      exit;

    } while(false);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <h1>Edit User</h1>

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

    <form method="POST">
    <input type="hidden" name = "inputSn" value = "<?php echo $sn ?>">
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

  <!-- <?php
        if(!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                    <div class='alert alert-success fade show' role = 'alert'>
                    <strong>$successMessage</strong>
                    </div>
            </div>
            ";
        }
    ?> -->

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-danger" href="/PHP/index.php">Cancel</a>
</form>

    </div>
</body>
</html>