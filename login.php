<?php
session_start();
require "koneksi.php"; // Assuming this file contains your database connection code

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="main d-flex justify-content-center align-items-center login-page">
        
        <center>
            <div class="login-box p-5 shadow form lugin">
                <h2>Login</h2>
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
                        <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                    </div>
                    <div class="register-link">
                        <p>Don't have an account? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </center>

        <div class="mt-3">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($conn, "SELECT * FROM users2 WHERE username='$username'");

                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($countdata > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: index.php');
                    } else {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Password salah
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Akun tidak tersedia
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>