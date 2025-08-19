<footer class="footer mt-5">
    <div class="container">
        <div class=" row justify-content-center text-center">
            {{-- <div class="col-12 mb-0 mx-auto"> --}}

            <a href="#">
                <img src="{{ asset('argon') }}/img/brand/pemprov.png" class="mb-3  footer-logo" alt="main_logo">
            </a>
            <div class="col-6">
                <h6 class="font-weight-bolder mb-0">Pemerintah Daerah Provinsi Bengkulu</h6>
            </div>
            {{--
      </div> --}}

        </div>

        <div class="col-12">
            <div class="text-center">
                <p class="text-dark my-4 text-sm font-weight-normal">
                    Copyright &copy; 2023
                    {{-- <script>
                        document.write(new Date().getFullYear())
                    </script> --}}
                    <a href="/tentang" class="font-weight-bold ml-1" target="_blank">Executive Team</a> & <a
                        href="https://engineering.unib.ac.id/bi/" class="font-weight-bold ml-1" target="_blank">Teknik
                        Informatika
                        Universitas Bengkulu</a>
                </p>
            </div>
        </div>
    </div>
    </div>
</footer>
@stack('js')
<!--   Core JS Files   -->
<script src="{{ asset('dashboard') }}/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="{{ asset('dashboard') }}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('dashboard') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
<!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
<script src="{{ asset('dashboard') }}/assets/js/plugins/countup.min.js"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
<script src="{{ asset('dashboard') }}/assets/js/plugins/rellax.min.js"></script>
<!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
<script src="{{ asset('dashboard') }}/assets/js/plugins/tilt.min.js"></script>
<!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
<script src="{{ asset('dashboard') }}/assets/js/plugins/choices.min.js"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="{{ asset('dashboard') }}/assets/js/plugins/parallax.min.js"></script>
<!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="{{ asset('dashboard') }}/assets/js/material-kit.min.js?v=3.0.3" type="text/javascript"></script>
<script type="text/javascript">
    if (document.getElementById('state1')) {
        const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
        if (!countUp.error) {
            countUp.start();
        } else {
            console.error(countUp.error);
        }
    }
    if (document.getElementById('state2')) {
        const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
        if (!countUp1.error) {
            countUp1.start();
        } else {
            console.error(countUp1.error);
        }
    }
    if (document.getElementById('state3')) {
        const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
        if (!countUp2.error) {
            countUp2.start();
        } else {
            console.error(countUp2.error);
        };
    }
</script>
</body>

</html>
