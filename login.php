<?php
if (!isset($_SESSION)) {
    session_start();
}

require 'function.php';

if (isset($_POST['telepon']) && isset($_POST['otp'])) {
    $telepon = $_POST['telepon'];
    $otp = $_POST['otp'];

    $login = login($koneksi, $telepon);

    if ($login['otp'] == $otp) {
        $_SESSION['telepon'] = $telepon;
        $_SESSION['password'] = $login['password'];
        $_SESSION['e'] = $login['e'];
        $_SESSION['n'] = $login['n'];
        $_SESSION['otp'] = $otp;
        header("Location: proses.php");
        exit;
    } else {
        header("Location: login.php?error=Invalid+OTP");
        exit;
    }
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
            <h1 class="card-title">Log In</h1>
        </div>
        <div class="card-body ">
        <form id="login-form" action="function.php?act=login" method="POST">
                        <div class="form-group">
                            <input type="tel" class="form-control" id="telepon" name="telepon" rows="3" placeholder="Nomor Telepon">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login_btn" id="login" class="btn btn-login" value="Kirim OTP">
                        </div>
                        <div class="container signin">
                            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
                            <!-- Modal -->
                        </div>
                    </form>
        </div>
    </div>
</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>

</html>