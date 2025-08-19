<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('argon') }}/img/brand/pemprovlogo.png" rel="icon" type="image/png">
    <title>
        Under Maintenance | AJAK-Bestie
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('dashboard') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('dashboard') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('dashboard') }}/assets/css/material-kit.css?v=3.0.3" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/main.css">

</head>
<style>
    a {
        color: #fff;
        font-weight: bold;
    }

    a:hover {
        text-decoration: none;
    }

    svg {
        width: 75px;
    }
</style>

<body class="presentation-page bg-gray-200">
    <!-- Navbar -->
    <div class="page-header min-vh-100" style="background-image: url(&#39;dashboard/assets/img/GEDUNG.jpg&#39;);"
        loading="lazy">
        <span class="mask bg-gradient-dark opacity-5"></span>
        <div class="container ">
            <div class="row">
                <div class="text-center mx-auto my-auto">
                    <h1 class="text-white mb-1">AJAK-Bestie</h1>
                    <p class="text-white  lead pb-2">Sistem Analisis Jabatan, Analisis Beban Kerja, Standar Kompetensi
                        dan Evaluasi Jabatan<br>Pemerintah Provinsi Bengkulu</p>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202.24 202.24">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #fff;
                                }
                            </style>
                        </defs>
                        <title>Warning</title>
                        <g id="Layer_2" data-name="Layer 2">
                            <g id="Capa_1" data-name="Capa 1">
                                <path class="cls-1"
                                    d="M101.12,0A101.12,101.12,0,1,0,202.24,101.12,101.12,101.12,0,0,0,101.12,0ZM159,148.76H43.28a11.57,11.57,0,0,1-10-17.34L91.09,31.16a11.57,11.57,0,0,1,20.06,0L169,131.43a11.57,11.57,0,0,1-10,17.34Z" />
                                <path class="cls-1"
                                    d="M101.12,36.93h0L43.27,137.21H159L101.13,36.94Zm0,88.7a7.71,7.71,0,1,1,7.71-7.71A7.71,7.71,0,0,1,101.12,125.63Zm7.71-50.13a7.56,7.56,0,0,1-.11,1.3l-3.8,22.49a3.86,3.86,0,0,1-7.61,0l-3.8-22.49a8,8,0,0,1-.11-1.3,7.71,7.71,0,1,1,15.43,0Z" />
                            </g>
                        </g>
                    </svg>
                    <h2 class="text-white ">We&rsquo;ll be back soon!</h2>
                    <div>
                        <p class="text-white ">Sorry for the inconvenience. We&rsquo;re performing some maintenance
                            at the moment.</p>

                    </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</body>
{{-- <footer class="footer mt-5">
    <div class="container">
        <div class=" row justify-content-center text-center">

            <a href="#">
                <img src="{{ asset('argon') }}/img/brand/pemprov.png" class="mb-3  footer-logo" alt="main_logo">
            </a>
            <div class="col-6">
                <h6 class="font-weight-bolder mb-0">Pemerintah Provinsi Bengkulu</h6>
            </div>

        </div>

        <div class="col-12">
            <div class="text-center">
                <p class="text-dark my-2 text-sm font-weight-normal pb-3">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> <a href="http://informatika.ft.unib.ac.id/" class="font-weight-bold ml-1"
                        target="_blank">Teknik
                        Informatika
                        Universitas Bengkulu</a>
                </p>
            </div>
        </div>
    </div>
    </div>
</footer> --}}

<!--   Core JS Files   -->
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script>
    var countDownDate = new Date("Jan 19, 2023 00:00:00").getTime();
    var x = setInterval(function () {
      var now = new Date().getTime();
      var distance = countDownDate - now;
      var dayss = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hourss = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutess = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var secondss = Math.floor((distance % (1000 * 60)) / 1000);
      var distance = countDownDate - now;
      document.getElementById("dayss").innerHTML = dayss;
      document.getElementById("hourss").innerHTML = hourss;
      document.getElementById("minutess").innerHTML = minutess;
      document.getElementById("secondss").innerHTML = secondss;

      if (distance < 0) {
        clearInterval(x);
        document.getElementById("dayss").innerHTML = "";
        document.getElementById("hourss").innerHTML = "";
        document.getElementById("minutess").innerHTML = "";
        document.getElementById("secondss").innerHTML = "";
      }
    }, 1000);
</script>
<!--===============================================================================================-->

</body>

</html>
