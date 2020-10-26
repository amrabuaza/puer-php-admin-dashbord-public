<?php
session_start();
$hasError = false;
require "header.php";
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
} else if (isset($_POST['email-address'])) {
    require "helper/DBHelper.php";
    $db = DBHelper::getInstance();
    $email = $_POST['email-address'];
    $pass = $_POST['password'];
    if (($user = $db->login($email, $pass)) != null) {
        $_SESSION['user']= $user;
        header("Location: home.php");
        exit();
    } else {
        $hasError = true;
    }
} ?>
    <br/>
<?php if ($hasError) { ?>
    <div class="alert alert-danger" role="alert">
        Email or Password Not Valid
    </div>
<?php } ?>
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="form-group row">
                                    <label for="email_address"
                                           class="col-md-4 col-form-label text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email_address" class="form-control" name="email-address"
                                               required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                </div>
                        </div>
                        </form>
                        <a href="register.php" class="btn btn-link">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>

<?php
require "footer.php";
