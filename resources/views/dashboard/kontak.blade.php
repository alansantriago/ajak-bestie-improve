@extends('dashboard.header', ['title' => __('Kontak')])

@section('content')
    <header class="header-2">
        <div class="page-header min-vh-75"
            style="background-image: url(&#39;{{ asset('dashboard') }}/assets/img/GEDUNG.jpg&#39;);" loading="lazy">
            <span class="mask bg-gradient-dark opacity-5"></span>
            <div class="container ">
                <div class="row">
                    <div class="text-center mx-auto my-auto">
                        <h1 class="text-white mb-2">Kontak</h1>
                        <p class="text-white opacity-8 lead ">Sistem Analisis Jabatan, Beban Kerja, Evaluasi Jabatan, Standar
                            Kompensi <br>Pemerintah Provinsi Bengkulu</p>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
        <!-- Section with four info areas left & one card right with image and waves -->

        <!-- -------- END Features w/ pattern background & stats & rocket -------- -->
        <section>
            <div class="container my-4">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h3>Informasi Kontak WhatsApp</h3>

                        <div class="table-responsive-md">
                            <div style="text-align: center;">
                                <table class="table table-bordered table-hover ">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Nomor Handphone</th>
                                            <th class="text-center">Aksi Whatsapp</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <tr>
                                            <td class="text-center text-dark">Mang Well</td>
                                            <td class="text-center text-dark">0811 7310 998</td>
                                            <td class="text-center"><a class="btn btn-sm btn-success"
                                                    href="https://wa.me/628117310998" target="_blank">Kirim Pesan</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-dark">Bang Yen</td>
                                            <td class="text-center text-dark">0821 7751 2332</td>
                                            <td class="text-center"><a class="btn btn-sm btn-success"
                                                    href="https://wa.me/6282177512332" target="_blank">Kirim Pesan</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-dark">Mbak Nia</td>
                                            <td class="text-center text-dark">0853 2456 7755</td>
                                            <td class="text-center"><a class="btn btn-sm btn-success"
                                                    href="https://wa.me/6285324567755" target="_blank">Kirim Pesan</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-dark">Andro</td>
                                            <td class="text-center text-dark">08133 8161 333</td>
                                            <td class="text-center"><a class="btn btn-sm btn-success"
                                                    href="https://wa.me/6281338161333" target="_blank">Kirim Pesan</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- -------- END PRE-FOOTER 1 w/ SUBSCRIBE BUTTON AND IMAGE ------- -->
    </div>
@endsection
