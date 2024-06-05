<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
    } else if ($_SESSION['role'] == 1) {
        header("location: test.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
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
            <h1 class="card-title">Halaman Registrasi</h1>
        </div>
        <div class="card-body ">
            <form id="registrationForm" method="POST" action="function.php?act=register" class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="nama">Nama Pasien</label>
                        <input type="text" class="form-control validate-others" id="nama" name="nama" placeholder="Nama" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Nama tidak boleh kosong
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="telepon">Nomor Telepon</label>
                        <input type="tel" class="form-control validate-others" id="telepon" name="telepon" pattern="[0-9]{10,12}" placeholder="e.g. 08xxxxxxxxxx" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Nomor telepon kosong/tidak valid. Pastikan formatnya benar (contoh: 08xxxxxxxxxx).
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="password">
                            Private Key
                            <span class="tooltip" title="Pilih satu bilangan prima (maksimal: 999)">?</span>
                        </label>
                        <input type="number" class="form-control validate-password" id="password" name="password" max="999" maxlength="3" placeholder="Password" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Bukan bilangan prima
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="alamat">Alamat</label>
                        <input type="text" class="form-control validate-others" id="alamat" name="alamat" placeholder="Alamat" required>
                        <div class="valid-feedback">
                            Bagus!
                        </div>
                        <div class="invalid-feedback">
                            Alamat tidak boleh kosong
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label class="papan" for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control validate-others" id="tgl_lahir" name="tgl_lahir" required>
                        <div class="invalid-feedback">
                            Masukkan Tahun Lahir
                        </div>
                    </div>
                </div>
                <button type="submit" name="submitButton" id="submitButton" class="registerbtn btn btn-primary">Register</button>
                <br>
                <div class="container signin">
                    <p>Sudah punya akun? <a href="login.php">Log In</a></p>
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

<script type="text/javascript">
(function() {
    'use strict';

    // Validasi untuk input selain password
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Memeriksa validitas input password saat nilai diubah
    document.getElementById("password").addEventListener("input", function(event) {
        const passwordInput = event.target;
        const password = parseInt(passwordInput.value);
        if (!isPrime(password)) {
            passwordInput.classList.add("is-invalid");
            passwordInput.classList.remove("is-valid");
        } else {
            passwordInput.classList.remove("is-invalid");
            passwordInput.classList.add("is-valid");
        }
    });
})();

function isPrime(num) {
    if (num <= 1) return false;
    if (num <= 3) return true;
    if (num % 2 === 0 || num % 3 === 0) return false;
    let i = 5;
    while (i * i <= num) {
        if (num % i === 0 || num % (i + 2) === 0) return false;
        i += 6;
    }
    return true;
}

</script>

</body>

</html>