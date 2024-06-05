<?php
session_start();

if (!isset($_SESSION['otp'])) {
    header("Location: login.php");
    exit;
}

$telepon = $_SESSION['telepon'];
$password = $_SESSION['password'];
$e = $_SESSION['e'];
$q = $_SESSION['q'];
$n = $_SESSION['n'];
$otp = $_SESSION['otp'];
$pi = $_SESSION['pi'];

$ascii_telepon = '';
for ($i = 0; $i < strlen($telepon); $i++) {
    $ascii_telepon.= ord($telepon[$i]). '';
}

$m = array();
for ($i = 0; $i < strlen($ascii_telepon); $i += 3) {
    $m[] = substr($ascii_telepon, $i, 3);
}

$_SESSION['m'] = $m;

for ($index = 0; $index < count($_SESSION['m']); $index++) {
    $c = bcpowmod($_SESSION['m'][$index], $e, $n);
    $_SESSION['c'][$index] = $c;
}

if (isset($_SESSION['otpp'])) {
    $otpp = $_SESSION['otpp'];
    $nn = substr($otpp, 0, 4); 
    $ee = substr($otpp, 4, 2); 

    $d = gmp_strval(gmp_invert($ee, $pi));
    $_SESSION['d'] = $d;

    $mm = array();
    foreach ($_SESSION['c'] as $index => $c) {
        $decrypted_value = bcpowmod($c, $d, $nn);
        $mm[$index] = str_pad((string) $decrypted_value, 3, '0', STR_PAD_LEFT);
    }
    $_SESSION['mm'] = $mm;

    $mf = '';
    foreach ($mm as $value) {
        $mf.= $value;
    }

    $original_string = '';
    for ($i = 0; $i < strlen($mf); $i += 2) {
        $ascii_code = substr($mf, $i, 2);
        $original_string.= chr(intval($ascii_code));
    }

    $_SESSION['mf'] = strval($original_string);
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

    <title>FinEduPro - Proses Enkripsi</title>
</head>

<body>
    <div class="container">
        <div class="card text-center">
            <div class="card-title">
                <h1 class="card-title">Proses Enkripsi Dekripsi</h1>
            </div>
            <div class="card-body ">
                <form>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="telepon">Plainteks</label>
                            <input type="text" class="form-control" id="telepon" value="<?php echo $telepon?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="password">Private Key (p)</label>
                            <input type="number" class="form-control" id="password" value="<?php echo $password?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="password">Private Key (q)</label>
                            <input type="number" class="form-control" id="q" value="<?php echo $q?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="e">Public Key (e)</label>
                            <input type="number" class="form-control" id="e" value="<?php echo $e?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="n">Public Key (n) = p x q</label>
                            <input type="number" class="form-control" id="n" value="<?php echo $n?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="otp">OTP</label>
                            <input type="text" class="form-control" id="otp" value="<?php echo $otp?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="ascii_telepon">Format ASCII</label>
                            <input type="text" class="form-control" id="ascii_telepon" value="<?php echo $ascii_telepon?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="m">Partisi ASCII</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="m1">m1</label>
                            <input type="text" class="form-control" id="m1" value="<?php echo isset($_SESSION['m'][0])? $_SESSION['m'][0] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m2">m2</label>
                            <input type="text" class="form-control" id="m2" value="<?php echo isset($_SESSION['m'][1])? $_SESSION['m'][1] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m3">m3</label>
                            <input type="text" class="form-control" id="m3" value="<?php echo isset($_SESSION['m'][2])? $_SESSION['m'][2] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m4">m4</label>
                            <input type="text" class="form-control" id="m4" value="<?php echo isset($_SESSION['m'][3])? $_SESSION['m'][3] : ""?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="m5">m5</label>
                            <input type="text" class="form-control" id="m5" value="<?php echo isset($_SESSION['m'][4])? $_SESSION['m'][4] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m6">m6</label>
                            <input type="text" class="form-control" id="m6" value="<?php echo isset($_SESSION['m'][5])? $_SESSION['m'][5] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m7">m7</label>
                            <input type="text" class="form-control" id="m7" value="<?php echo isset($_SESSION['m'][6])? $_SESSION['m'][6] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m8">m8</label>
                            <input type="text" class="form-control" id="m8" value="<?php echo isset($_SESSION['m'][7])? $_SESSION['m'][7] : ""?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="c">Enkripsi</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="c1">c1</label>
                            <input type="text" class="form-control" id="c1" value="<?php echo isset($_SESSION['c'][0])? $_SESSION['c'][0] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="c2">c2</label>
                            <input type="text" class="form-control" id="c2" value="<?php echo isset($_SESSION['c'][1])? $_SESSION['c'][1] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="c3">c3</label>
                            <input type="text" class="form-control" id="c3" value="<?php echo isset($_SESSION['c'][2])? $_SESSION['c'][2] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="c4">c4</label>
                            <input type="text" class="form-control" id="c4" value="<?php echo isset($_SESSION['c'][3])? $_SESSION['c'][3] : ""?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="c5">c5</label>
                            <input type="text" class="form-control" id="c5" value="<?php echo isset($_SESSION['c'][4])? $_SESSION['c'][4] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="c6">c6</label>
                            <input type="text" class="form-control" id="c6" value="<?php echo isset($_SESSION['c'][5])? $_SESSION['c'][5] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="c7">c7</label>
                            <input type="text" class="form-control" id="c7" value="<?php echo isset($_SESSION['c'][6])? $_SESSION['c'][6] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="c8">c8</label>
                            <input type="text" class="form-control" id="c8" value="<?php echo isset($_SESSION['c'][7])? $_SESSION['c'][7] : ""?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="d">Private Key (d)</label>
                            <input type="number" class="form-control" id="d" value="<?php echo isset($_SESSION['d'])? $_SESSION['d'] : ""?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="dekripsi">Dekripsi</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="m1">m1</label>
                            <input type="text" class="form-control" id="m1" value="<?php echo isset($_SESSION['mm'][0])? $_SESSION['mm'][0] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m2">m2</label>
                            <input type="text" class="form-control" id="m2" value="<?php echo isset($_SESSION['mm'][1])? $_SESSION['mm'][1] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m3">m3</label>
                            <input type="text" class="form-control" id="m3" value="<?php echo isset($_SESSION['mm'][2])? $_SESSION['mm'][2] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m4">m4</label>
                            <input type="text" class="form-control" id="m4" value="<?php echo isset($_SESSION['mm'][3])? $_SESSION['mm'][3] : ""?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="m5">m5</label>
                            <input type="text" class="form-control" id="m5" value="<?php echo isset($_SESSION['mm'][4])? $_SESSION['mm'][4] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m6">m6</label>
                            <input type="text" class="form-control" id="m6" value="<?php echo isset($_SESSION['mm'][5])? $_SESSION['mm'][5] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m7">m7</label>
                            <input type="text" class="form-control" id="m7" value="<?php echo isset($_SESSION['mm'][6])? $_SESSION['mm'][6] : ""?>" readonly>
                        </div>
                        <div class="col">
                            <label class="papan" for="m8">m8</label>
                            <input type="text" class="form-control" id="m8" value="<?php echo isset($_SESSION['mm'][7])? $_SESSION['mm'][7] : ""?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="papan" for="mf">Hasil Akhir</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" id="mf" value="<?= isset($_SESSION['mf'])? $_SESSION['mf'] : ""?>" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='logout.php'">Keluar</button>
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