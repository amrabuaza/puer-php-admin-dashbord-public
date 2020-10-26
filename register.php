<?php
session_start();
$hasError = false;
require "header.php";
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
} else if (isset($_POST['email-address'])
    && isset($_POST['full_name'])
    && isset($_POST['birth_date'])
    && isset($_POST['password'])
) {
    require "helper/DBHelper.php";
    $db = DBHelper::getInstance();
    $email = $_POST['email-address'];
    $pass = $_POST['password'];
    $birth = $_POST['birth_date'];
    $fullName = $_POST['full_name'];
    if ($db->register($fullName, $birth, $email, $pass)) {
        $user = $db->login($email, $pass);
        $_SESSION['user'] = $user;
        header("Location: home.php");
        exit();
    }
} else { ?>
    <br/>
    <main class="register-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="form-group row">
                                    <label for="full_name"
                                           class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="full_name"
                                               required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_address"
                                           class="col-md-4 col-form-label text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email_address" class="form-control" name="email-address"
                                               required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="birth_date"
                                           class="col-md-4 col-form-label text-md-right">Birth Data</label>
                                    <div class="col-md-6">
                                        <input type="text" id="birth_date" class="form-control" name="birth_date"
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


    <?php
}
require "footer.php";
