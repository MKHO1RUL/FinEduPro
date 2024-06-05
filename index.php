<?php 
include 'function.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"/>
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
      rel="stylesheet"/>
    <link rel="shortcut icon" href="gambar/buku.png"/>
    <link rel="stylesheet" href="responsive.css?v=1.0" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>FinEduPro</title>
    
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light " >
      <div class="container">
        <a class="navbar-brand" href="#"
          ><img src="gambar/yyy.png" width="80" alt="logo"
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item align-self-center active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item align-self-center active">
              <a class="nav-link"  href="#alur">Alur Kerja <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item align-self-center active">
              <a class="nav-link" href="narsis.php">Our Team <span class="sr-only">(current)</span></a>
            </li>
        
            <li>
              <a class="btn px-4 btn-secondary ml-2 logintombol" href="login.php" role="button"
              >Login</a>
            </li>
            <li>
              <a class="btn px-4 btn-primary ml-2" href="register.php" role="button"
              >Register</a>
            </li>
            
          </ul>
        </div>
      </div>
</nav>

    <section class="heroBWA mt-5">
      <div class="container">
        <div class="row">
          <div class="col align-self-center">
            <h1 class="mb-4">FinEduPro</h1>
            <p class="mb-4">
            FinEduPro merupakan sistem pakar berbasis web yang diciptakan untuk menguji seberapa jauh pengetahuan anda tentang Literasi Keuangan. Sistem pakar ini juga memberikan solusi yang anda butuhkan untuk meningkatkan kondisi keuangan anda saat ini.
          </p>
            <a class="btn btn-primary" href="login.php" role="button">ayo mulai!</a>
          </div>
          <div class="col d-none d-sm-block">
            <img width="500" src="gambar/xxx.png" alt="hero" />
          </div>
        </div>
      </div>
    </section>

    <section id="alur">
      <!--Content2-->
      <div id="konten2" class="container konten" data-aos="fade-up" data-aos-duration="1000">
        <h2 style="font-weight: bold;text-align: center;">Alur Kerja Sistem Pakar Literasi Keuangan</h2>
        <div class="card-deck">
          <div class="card" data-aos="zoom-in-left" data-aos-duration="1300">
            <h5 class="card-title">Login</h5>
            <!--img src="gambar/login.png" class="card-img-top" alt="..."-->
            <div class="card-body" href="register.php" role="button">
              
              <p class="card-text">Pengguna harus melakukan login sebelum melangkah ke tahap selanjutnya, dan jika belum memiliki akun akan diarahkan ke menu registrasi.</p>
            </div>
          </div>
          <div class="card" data-aos="zoom-in-up" data-aos-duration="1300">
            <h5 class="card-title">Test Kondisi Finansial</h5>
            <!--img src="gambar/jawab.png" class="card-img-top" alt="..."-->
            <div class="card-body">
              <p class="card-text">Dalam tahap ini pengguna akan diberikan beberapa pertanyaan mengenai literasi keuangan.</p>
            </div>
          </div>
          <div class="card" data-aos="zoom-in-right" data-aos-duration="1300">
            <h5 class="card-title">Hasil dan Solusi</h5>
            <!--img src="gambar/hasil.png" class="card-img-top" alt="..."-->

            <div class="card-body">

              <p class="card-text">Tahap ini merupakan tahap akhir dimana setelah melaksanakan test, pengguna akan diberikan hasil test berupa indeks literasi keuangan dan solusi untuk meningkatkan kondisi keuangan.</p>
            </div>
          </div>
        </div>
      </div>
    </sect>

    <footer id="footer" class="bg-warning text-dark mt-5">
 <div class="container">
    <div class="row">
      <div class=" ending col-md-4">
        <h5>Contact</h5>
        <p>Jalan Konoha 666</p>
        <p>Phone: (082) 1112-3300</p>
        <p>Email: support@finedupro.com</p>
      </div>
      <div class="ending col-md-3">
        <h5>Support</h5>
        <ul class="list-unstyled">
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Contact us</a></li>
          <li><a href="#">Terms of service</a></li>
          <li><a href="#">Privacy policy</a></li>
        </ul>
      </div>
      <div class="ending col-md-2">
        <h5>Source</h5>
        <ul class="list-unstyled">
          <li><a href="sumber.php">Image</a></li>
          <li><a href="#">Content</a></li>
        </ul>
      </div>
      <div class="ending col-md-2">
        <img src="gambar/merek.png" width="300" alt="logo"/>
      </div>

    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p class="copyright">Copyright &copy; 2023 FinEduPro. All rights reserved.
        </p>
      </div>
    </div>
 </div>
</footer>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  </body>

  

  <script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"
  ></script>
  <script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"
  ></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  console.log('<?php $_SESSION['otp_timestamp']?>')
</script>



</html>
