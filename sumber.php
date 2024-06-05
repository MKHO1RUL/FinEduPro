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
    <nav class="navbar py-2 navbar-expand-lg navbar-light " >
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
              <a class="nav-link" href="index.php">Our Team <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item ">
              <!-- Button trigger modal -->
              <button type="button" class="btn px-4 btn-secondary ml-5 logintombol" data-toggle="modal" data-target="#exampleModal">Log In</button>
              </button>

              <!-- Login -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                      <form id="login-form" action="function.php?act=login" method="POST" >
                        <div class="form-group">
                          <div id="result"></div>
                            <label for="nama" class="col-form-label">Username :</label>
                              <input type="text" class="form-control" id="nama" name="nama" rows="3" placeholder="Username">
                              <label for="pass" class="col-form-label">Password :</label>
                              <input type="password" class="form-control" id="password" name="password" rows="3" placeholder="Password">
                          </div>
                        <div class="form-row">
                    </div>
                        <div class="modal-footer">
                          <input type="submit" name="login_btn" id="login" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                  </div>
                </div>
              </div>
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
        <div class="row d-flex justify-content-center">
          <div class="col-lg-4">
            <ul class="list-unstyled">
              <li><a href="http://www.freepik.com">Designed by macrovector / Freepik</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    

    <footer id="footer" class="bg-warning text-dark mt-5">
 <div class="container">
    <div class="row">
      <div class=" ending col-md-4">
        <h5>Contact</h5>
        <p>Jalan Sukarajin 202</p>
        <p>Phone: (021) 2909-1012</p>
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
</script>
</html>
