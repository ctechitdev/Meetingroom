<?php
session_start();


if (isset($_POST["btnlogin"])) {



    include 'request_item.php';
    $requestItem = new requestItem();
    $user = $requestItem->loginUsers($_POST['username'], $_POST['password']);
    if (!empty($user)) {
        $_SESSION['user_ids'] = $user[0]['user_ids'];
        $_SESSION['full_name'] = $user[0]['full_name'];
        $_SESSION['staff_depart'] = $user[0]['staff_depart'];
        header("Location:request_meeting_room.php");
    } else {
        $message = "Invalid email or password!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title> ໂປຣແກຣມນຳໃຊ້ຫ້ອງປະຊຸມ </title>
    <link href="css/style.min.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative font"
            style="background:url(images/bgmr.png) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-6 col-md-6 modal-bg-img" style="background-image: url(imadges/Kp-Logo.png);">
                </div>
                <div class="col-lg-6 col-md-6 bg-white">
                    <div class="p-3">

                        <h2 class="mt-3 text-center">ເຂົ້າລະບົບ</h2>
                        <div class="form-group">
                            <div class="col-md-12">
                                <?php
                                if (isset($message)) {
                                ?>
                                    <div class="text-center">
                                        <strong><?php echo "<h4 style='color:#ff0000;'>" . $message . "</h4>"; ?></strong>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>
                        <form class="mt-4" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark " for="uname"> ອີເມວຜູ້ໃຊ້ </label>
                                        <input class="form-control" name="username" id="username" type="text" placeholder="ອີເມວຜູ້ໃຊ້">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd"> ລະຫັດຜ່ານ </label>
                                        <input class="form-control" name="password" id="password" type="password" placeholder="ອີເມວຜູ້ໃຊ້">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">

                                    <button type="submit" name="btnlogin" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light font">ເຂົ້າສູ່ລະບົບ</button>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="js/jquery.min.js "></script>
    <script src="js/popper.min.js "></script>
    <script src="js/bootstrap.min.js "></script>

    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>