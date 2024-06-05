<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$koneksi = mysqli_connect('localhost', 'root', '', 'kcb07');

if (mysqli_connect_errno()) {
    echo "Koneksi Database Gagal : " . mysqli_connect_error();
}

if (isset($_GET["act"])) {
    $act = $_GET["act"];
    if ($act == "register") {
        register();
    } else if ($act == "login") {
        login($koneksi, $_POST['telepon']);
    } else if ($act == "registerPakar") {
        registerPakar();
    } else if ($act == "tambahGejala") {
        tambahGejala();
    } else if ($act == "tambahPenyakit") {
        tambahPenyakit();
    } else if ($act == "tambahSolusi") {
        tambahSolusi();
    } else if ($act == "hapusGejala") {
        $id_gejala = $_GET["id_gejala"];
        hapusGejala($id_gejala);
    } else if ($act == "hapusPenyakit") {
        $id_penyakit = $_GET["id_penyakit"];
        hapusPenyakit($id_penyakit);
    } else if ($act == "hapusPasien") {
        $id_user = $_GET["id_user"];
        hapusPasien($id_user);
    } else if ($act == "hapusPakar") {
        $id_user = $_GET["id_user"];
        hapusPakar($id_user);
    } else if ($act == "hapusSolusi") {
        $id_solusi = $_GET["id_solusi"];
        hapusSolusi($id_solusi);
    } else if ($act == "ubahGejala") {
        $id_gejala = $_GET["id_gejala"];
        ubahGejala($id_gejala);
    } else if ($act == "ubahPasien") {
        $id_user = $_GET["id_user"];
        ubahPasien($id_user);
    } else if ($act == "ubahPakar") {
        $id_user = $_GET["id_user"];
        ubahPakar($id_user);
    } else if ($act == "ubahPenyakit") {
        $id_penyakit = $_GET["id_penyakit"];
        ubahPenyakit($id_penyakit);
    } else if ($act == "ubahSolusi") {
        $id_solusi = $_GET["id_solusi"];
        ubahSolusi($id_solusi);
    } else if($act == "ulang"){
        ulang();
    }
}

function ulang(){
    session_unset();
    session_destroy();
    header("location: test.php");
}

function register()
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $password = htmlspecialchars($_POST['password']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $query_user = "INSERT INTO users VALUES ('','1','$nama', '$telepon', '$alamat', '$tgl_lahir','$password')";
    $exe = mysqli_query($koneksi, $query_user);

    if (!$exe) {
        die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        // echo "<script type='text/javascript'> success(); </script>";
echo "<script>
        alert('Berhasil Registrasi! Silahkan Login');
        document.location.href = 'index.php';
            </script>";
    }
}

function registerPakar()
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $query_pakar = "INSERT INTO users VALUES ('','2','$nama', '$telepon', '$alamat', '$tgl_lahir','$password')";
    $exe = mysqli_query($koneksi, $query_pakar);

    if (!$exe) {
        die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        // echo "<script type='text/javascript'> success(); </script>";
        echo "<script>
        alert('Berhasil Registrasi Pakar! Segera beritahu pakar Login');
        document.location.href = 'indexPakar.php';
            </script>";
    }
}

function check_phone_number($koneksi, $telepon) {
    $query = "SELECT * FROM users WHERE telepon = '$telepon'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function generate_rsa_key_pair($password) {
    // Bangkitkan bilangan prima acak (q)
    $q = rand(2, 999);
    while (!is_prime($q)) {
        $q = rand(2, 999);
    }
    // Hitung n = p*q
    do {
        $n = $password * $q;
        if ($n < 1000 || $n > 9999) {
            $q = rand(2, 999);
            while (!is_prime($q)) {
                $q = rand(2, 999);
            }
        }
    } while ($n < 1000 || $n > 9999);
    $_SESSION['q'] = $q;

    // Hitung pi = (password-1)*(q-1)
    $pi = ($password - 1) * ($q - 1);
    $_SESSION['pi'] = $pi;

    // Bangkitkan (e), dimana gcd(e, pi) = 1
    while (gcd($e, $pi) != 1) {
        $e = rand(10, 99);
    }

    // OTP = nnnn.ee
    $otp = strval($n) . strval($e);

    return array($otp, $n, $e);}

function gcd($a, $b) {
    if ($b == 0) {
        return $a;
    } else {
        return gcd($b, $a % $b);
    }
}

function is_prime($num) {
    if ($num <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

function login($koneksi, $telepon) {
    if (check_phone_number($koneksi, $telepon)) {
        // Ambil password dari database
        $query = "SELECT password FROM users WHERE telepon = '$telepon'";
        $result = mysqli_query($koneksi, $query);
        $password = mysqli_fetch_assoc($result)['password'];

        // Bangkitkan pasangan kunci RSA
        if (!isset($_SESSION['otp_generated']) || $_SESSION['otp_generated']!= true) {
            list($otp, $n, $e) = generate_rsa_key_pair($password);
            $_SESSION['n'] = $n;
            $_SESSION['e'] = $e;
            $_SESSION['otp_generated'] = true;
            $_SESSION['otp_timestamp'] = time(); 
            $_SESSION['otp'] = $otp; 
            $_SESSION['telepon'] = $telepon;
            $_SESSION['password'] = $password;

            // Kirim OTP ke nomor user menggunakan API
            $target = $telepon;
            $message = "Kode OTP FinEduPro Anda adalah *$otp*. Demi Keamanan, jangan bagikan kode ini.";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'message' => $message,
                    'url' => 'https://md.fonnte.com/images/wa-logo.png',
                    'typing' => false,
                    'delay' => '1',
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: K8LpZMM+bQFFDw7vvJ4i'
                ),
            ));
            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);

            if (isset($error_msg)) {
                echo $error_msg;
            }
            echo $response;

            header("Location: otp.php"); 
            exit;
        } else {
            $n = $_SESSION['n'];
            $e = $_SESSION['e'];
            $otp = $n;
        }
        return $otp;
    } else {
        header("Location: register.php");
        exit;
    }
}

ob_start();
// Cek apakah OTP sudah dimasukkan
if (isset($_POST['act']) && $_POST['act'] == 'verify_otp') {
    $otpp = $_POST['otp']; // Menyimpan nilai OTP 
    $_SESSION['otpp'] = $otpp;

    
    // Cek apakah OTP masih valid dalam 3 menit
    if (isset($_SESSION['otp_timestamp']) && time() - $_SESSION['otp_timestamp'] <= 180) {
        $stored_otp = $_SESSION['otp'];
        $telepon = $_SESSION['telepon'];
        
        // Mengambil value hasil dekripsi
        $last = function () {
            include 'proses.php';
            return (string) $_SESSION['mf'];
        };
        $last = $last();

        // Memastikan $telepon dan $last berupa strings dan trimmed
        $telepon = trim((string) $telepon);
        $last = trim((string) $last);

        if ($telepon === $last) {
            $_SESSION['login_success'] = true;
            header("Location: test.php");
            exit;
        } else {
            $_SESSION['otp_salah'] = "Masukkan OTP yang benar!! 🤬";
            header("Location: otp.php");
            exit;
        }
    } else {
        $_SESSION['otp_lama'] = "OTP kedaluwarsa, kirim ulang OTP 😔";

        unset($_SESSION['otp']);
        unset($_SESSION['otp_timestamp']);
        unset($_SESSION['otp_generated']);
        header("Location: otp.php");
        exit;
    }
    ob_end_flush();
} else {
    // OTP hasn't been generated, do nothing
}


// Function to add gejala
function tambahGejala()
{
    global $koneksi;
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $queryGejala = "INSERT INTO gejala VALUES ('','$gejala')";
    
    $exe = mysqli_query($koneksi, $queryGejala);
    
    if (!$exe) {
        die('Error pada database');
    }   
        $id_gejala = mysqli_insert_id($koneksi);
        $queryRelasi = "INSERT INTO relasi VALUES ('', '$id_gejala', '$id_penyakit')";
        $ex = mysqli_query($koneksi, $queryRelasi);

        if(!$ex){
            die('Error pada database');
        }
        echo "<script>
        alert('Gejala berhasil ditambahkan');
        document.location.href = 'indexGejala.php'</script>";
}


function tambahPenyakit()
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    // $penyakit = $_POST['id_penyakit'];
    $queryPenyakit = "INSERT INTO penyakit VALUES ('','$penyakit')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Penyakit berhasil ditambahkan');
            document.location.href = 'indexPenyakit.php'</script>";
}

function tambahSolusi()
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    // $penyakit = $_POST['id_penyakit'];
    $querySolusi = "INSERT INTO solusi VALUES ('', '$id_penyakit', '$solusi')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Solusi berhasil ditambahkan');
            document.location.href = 'indexSolusi.php'</script>";
}

function ubahGejala($id_gejala)
{
    global $koneksi;
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $queryGejala = "UPDATE gejala SET gejala = '$gejala' WHERE id_gejala = '$id_gejala'";
    $exe = mysqli_query($koneksi, $queryGejala);
    if (!$exe) {
        die('Error pada database');
    }
        $queryRelasi = "UPDATE relasi SET id_gejala = '$id_gejala', id_penyakit = '$id_penyakit' WHERE id_gejala = '$id_gejala'";
        $ex = mysqli_query($koneksi, $queryRelasi);
        if(!$ex){
            die('Error pada database');
        }    
        echo "<script>
        alert('Data Gejala berhasil diubah');
        document.location.href = 'indexGejala.php'</script>";
}

function ubahSolusi($id_solusi)
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    // $penyakit = $_POST['id_penyakit'];
    $querySolusi = "UPDATE solusi SET solusi = '$solusi', id_penyakit = '$id_penyakit' WHERE id_solusi = '$id_solusi'";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Solusi berhasil diubah!');
            document.location.href = 'indexSolusi.php'</script>";
}

function ubahPenyakit($id_penyakit)
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    // $penyakit = $_POST['id_penyakit'];
    $queryPenyakit = "UPDATE penyakit SET penyakit = '$penyakit' WHERE id_penyakit = '$id_penyakit'";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Penyakit berhasil diubah!');
            document.location.href = 'indexPenyakit.php'</script>";
}

function ubahPasien($id_user)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    // $penyakit = $_POST['id_penyakit'];
    $queryUser = "UPDATE user SET nama = '$nama', email = '$email', alamat = '$alamat', tgl_lahir = '$tgl_lahir' WHERE id_user = '$id_user'";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $exe = mysqli_query($koneksi, $queryUser);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Pasien berhasil diubah!');
            document.location.href = 'indexAdmin.php'</script>";
}

function ubahPakar($id_user)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    // $penyakit = $_POST['id_penyakit'];
    $queryUser = "UPDATE user SET nama = '$nama', email = '$email', alamat = '$alamat', tgl_lahir = '$tgl_lahir' WHERE id_user = '$id_user'";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $exe = mysqli_query($koneksi, $queryUser);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Pakar berhasil diubah!');
            document.location.href = 'indexPakar.php'</script>";
}

function hapusGejala($id_gejala)
{
    global $koneksi;
    $query = "DELETE FROM gejala WHERE id_gejala = '$id_gejala'";
    $exe = mysqli_query($koneksi, $query);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Gejala berhasil dihapus!');
            document.location.href = 'indexGejala.php'</script>";
}

function hapusSolusi($id_solusi)
{
    global $koneksi;
    $query = "DELETE FROM solusi WHERE id_solusi = '$id_solusi'";
    $exe = mysqli_query($koneksi, $query);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Solusi berhasil dihapus!');
            document.location.href = 'indexSolusi.php'</script>";
}

function hapusPenyakit($id_penyakit)
{
    global $koneksi;
    $query = "DELETE FROM penyakit WHERE id_penyakit = '$id_penyakit'";
    $exe = mysqli_query($koneksi, $query);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Penyakit berhasil dihapus!');
            document.location.href = 'indexPenyakit.php'</script>";
}

function hapusPasien($id_user)
{
    global $koneksi;
    $query = "DELETE FROM user WHERE id_user = '$id_user'";
    $exe = mysqli_query($koneksi, $query);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Pasien berhasil dihapus!');
            document.location.href = 'indexAdmin.php'</script>";
}

function hapusPakar($id_user)
{
    global $koneksi;
    $query = "DELETE FROM user WHERE id_user = '$id_user'";
    $exe = mysqli_query($koneksi, $query);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Pakar berhasil dihapus!');
            document.location.href = 'indexPakar.php'</script>";
}

function simpanRelasi($id_penyakit, $id_gejala)
{
    global $koneksi;
    $queryRelasi = "INSERT INTO relasi VALUES ('', '$id_penyakit', '$id_gejala')";
    $exe = mysqli_query($koneksi, $queryRelasi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Relasi Gejala dan Penyakit berhasil disimpan!');
            document.location.href = 'indexRelasi.php'</script>";
}

function ubahRelasi($id_relasi)
{
    global $koneksi;
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $id_gejala = htmlspecialchars($_POST['id_gejala']);
    $queryRelasi = "UPDATE relasi SET id_penyakit = '$id_penyakit', id_gejala = '$id_gejala' WHERE id_relasi = '$id_relasi'";
    $exe = mysqli_query($koneksi, $queryRelasi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Relasi Gejala dan Penyakit berhasil diubah!');
            document.location.href = 'indexRelasi.php'</script>";
}

function hapusRelasi($id_relasi)
{
    global $koneksi;
    $query = "DELETE FROM relasi WHERE id_relasi = '$id_relasi'";
    $exe = mysqli_query($koneksi, $query);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Relasi Gejala dan Penyakit berhasil dihapus!');
            document.location.href = 'indexRelasi.php'</script>";
}

function gejala($id_penyakit){
    global $koneksi;
    $query = "SELECT relasi.id_gejala as id_gejala FROM relasi INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala INNER JOIN penyakit ON relasi.id_penyakit = penyakit.id_penyakit WHERE relasi.id_penyakit = '$id_penyakit' ";
    $data = mysqli_query($koneksi, $query);
    // var_dump($data);
    $row = mysqli_fetch_assoc($data);
    
    return $row['id_gejala'];
    // echo "hasil". $row['id_gejala'];
}


?>