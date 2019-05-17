<?php
include "navbar.php";
?>

<!doctype html>
<html lang="en">
<head>

    <?php
//      session_start();
    // initializing variables
    $username = "";
    $email = "";
    $errors = array();

    include 'connection.php';


    // REGISTER USER
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // receive all input values from the form
        $fullname     = @($_POST["full-name"]);
        $username     = @($_POST["username"]);
        $pass         = @($_POST["password"]);
        $Confirm_pass = @($_POST["confirm_password"]);
        $email        = @($_POST["email-address"]);
        $phone        = @($_POST["phone"]);
        $gender       = @($_POST["gender"]);

        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($fullname)) {
            array_push($errors, "fullname is required");
        }
        if (empty($username)) {
            array_push($errors, "user name is required");
        }
        if (empty($pass)) {
            array_push($errors, "Password is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($phone)) {
            array_push($errors, "Phone is required");
        }
        if (empty($gender)) {
            array_push($errors, "gender is required");
        }


        if ($pass != $Confirm_pass) {
            array_push($errors, "The two passwords do not match");
        }


        // first check the database to make sure
        // a user does not already exist with the same username and/or email
        $stmt = $conn->prepare("
    SELECT user_name, email
    FROM register
    WHERE user_name='$username' OR email='$email';
    ");


        $stmt->execute();
        $rows = $stmt->fetchAll();
        $count = count($rows);
        echo $count;


        foreach ($rows as $row) {
            if ($count > 0) {

                if ($row['user_name'] === $username) {
                    array_push($errors, "Username already exists");

                }

                if ($row['email'] === $email) {
                    array_push($errors, "email already exists");
                }

            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $pass = md5($pass);//encrypt the password before saving in the database

            $sql = "INSERT INTO register (full_name,user_name,password,email,phone,gender) VALUES
 ('$fullname', '$username', '$pass', '$email', '$phone','$gender')";
            $conn->exec($sql);

//                    $_SESSION['userName_session'] = $username;
//                    $_SESSION['success'] = " ..You are now logged in";
        header('location: index.php');
        }
    }

    ?>




</head>
<body>

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form method="POST" name="my-form" onsubmit="return validform()" action="#">

                            <div class="alert alert-danger" role="alert">
                                <?php
                                foreach ($errors as $error){
                                    echo "<ul>";
                                    echo "<li>";
                                    echo $error;
                                    echo "</li>";
                                    echo "</ul>";
                                }
                                ?>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="full_name" class="form-control" name="full-name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="user_name" class="form-control" name="username" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="email" id="email_address" class="form-control" name="email-address" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="user_name" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">Confirm Passord</label>
                                <div class="col-md-6">
                                    <input type="password" id="user_name" class="form-control" name="confirm_password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="phone_number" class="form-control" name="phone" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Gender</label>
                                <select name="gender" required>
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="femal">Female</option>
                                </select>
                            </div>

                            <p>
                                Already a member? <a href="login.php">Sign in</a>
                            </p>



                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="reg_user">
                                    Register
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    </div>

</main>


</body>
</html>