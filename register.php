<?php
    session_start();
    require "koneksi.php"; // Assuming this file contains your database connection code

    if (isset($_SESSION['login'])) {
        header('location: index.php');
        exit();
    }

    if (isset($_POST['registerbtn'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

        // You can add additional validation here if needed

        // Check if the username is already taken
        $checkUsernameQuery = mysqli_query($conn, "SELECT * FROM users2 WHERE username='$username'");
        $countUsername = mysqli_num_rows($checkUsernameQuery);

        if ($countUsername > 0) {
            ?>
            <div class="alert alert-warning" role="alert">
                Username already taken. Choose a different one.
            </div>
            <?php
        } else {
            // Insert the new user into the database
            $insertUserQuery = mysqli_query($conn, "INSERT INTO users2 (username, password) VALUES ('$username', '$password')");

            if ($insertUserQuery) {
                ?>
                <div class="alert alert-success" role="alert" style="color: black;">
                    Registration successful! You can now <a href="login.php">login</a>.
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Registration failed. Please try again later.
                </div>
                <?php
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel='stylesheet' href="../bootstrap/bootstrap-5/css/bootstrap.min.css">

</head>

<style>
    .main {
        height: 100vh;
    }

    .login-box {
        width: 500px;
        border: solid 1px;
        box-sizing: border-box;
        border-radius: 10px;
    }

    .lugin {
        background-color: aquamarine;
    }
    .login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;

  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
    .form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: rgb(205,133,63);
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: rgb(221, 133, 26);
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.form .register-link {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .register-link a {
  color: rgb(221, 133, 26);
  text-decoration: none;
}


    @import url(css/logtif.css);
</style>

<body style="background-color: bisque;">
    <div class="main d-flex justify-content-start align-items-center login-page">
            <div class="login-box p-5 shadow form lugin">
                <h2>Register</h2>
                <form action="" method="post" class="login-form">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" autocomplete="off">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div>
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                    </div>
                    <div>
                        <button class="btn btn-success form-control mt-3" type="submit" name="registerbtn">Register</button>
                    </div> 
                    <div class="register-link">
                        <p>Have an account? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
