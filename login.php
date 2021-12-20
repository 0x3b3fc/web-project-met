<?php
error_reporting(0);

session_start();

include('include/connection.php');
$admin_email = $_POST['email'];
$admin_password = $_POST['password'];
$login = $_POST['log'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تسجيل الدخول</title>
    <!-- Bootstrap css files start -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-rtl.css" />
    <!-- Bootstrap css files end -->
    <!-- css files start -->
    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
    <!--custom css files end -->

    <style>
        .login {
            width: 400px;
            margin: 100px auto;
            padding: 0 auto;
        }

        .login h5 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login button {
            margin-right: 120px;
        }
    </style>
</head>

<body>
    <!-- content section start -->

    <!-- content section end -->

    <!-- <div class="content"> -->
    <div class="container">
        <div class="row">
            <div class="login">
                <h5>تسجيل الدخول</h5>
                <?php
                if (isset($login)) {
                    if (empty($admin_email) || empty($admin_password)) {
                        echo "<div class='alert alert-danger'>" . "الرجاء إدخال البريد الإلكتروني و كلمة السر" . "</div>";
                    } else {
                        $query = "SELECT * FROM admin WHERE email = '$admin_email' AND password = '$admin_password'";
                        $res = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($res);

                        if (($admin_email == $row['email']) && ($admin_password == $row['password'])) {
                            echo "<div class='alert alert-success'>" . "مرحبا, سيتم تحويلك إلي لوحة التحكم" . "</div>";
                            $_SESSION['id'] = $row['id'];
                            header('REFRESH:2;URL=categories.php');
                        }else{
                            echo "<div class='alert alert-danger'>" . "البريد الإلكتروني و كلمة المرور خطأ" . "</div>";
                        }
                    }
                }
                if (isset($_SESSION['id'])) {
                    header('REFRESH:0;URL=categories.php');
                  }
                ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <label for="email">إسم المستخدم</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة السر</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button class="btn btn-custom" name="log">تسجيل الدخول</button>
                </form>
            </div>
        </div>
    </div>
    <!-- </div> -->



    <?php
    include('include/footer.php');
    ?>