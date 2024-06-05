<?php
session_start();
if (isset($_SESSION['otp_generated']) && $_SESSION['otp_generated'] == true) {
    $_SESSION['otp'] = $_SESSION['otp']; // set the OTP session variable
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="responsive.css" />
<link rel="shortcut icon" href="gambar/buku.png"/>
<!--Font-->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"rel="stylesheet"/>
<script src="https://kit.fontawesome.com/yourcode.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<title>FinEduPro</title>
</head>

<body>
    <div class="container">
        <div class="card text-center">
            <div class="card-title">
                <h1 class="card-title">Silahkan Masukkan OTP</h1>
            </div>
            <div class="card-body">
                <form action="function.php" method="post">
                    <input type="hidden" name="act" value="verify_otp">
                    <input type="hidden" name="telepon" value="<?php echo $_SESSION['telepon']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="otp" name="otp" pattern="[0-9]{6}" maxlength="6" placeholder="OTP" required>
                    </div>
                    <?php
                    if (isset($_SESSION['otp_salah'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['otp_salah'] . '</div>';
                        unset($_SESSION['otp_salah']);
                    }else if (isset($_SESSION['otp_lama'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['otp_lama'] . '</div>';
                    }
                    ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Verify OTP</button>
                    </div>
                </form>
                <?php
                    if (isset($_SESSION['otp_lama'])) {
                        echo '<a href="login.php" class="btn btn-secondary">Kirim ulang OTP</a>';
                        unset($_SESSION['otp_lama']);
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>