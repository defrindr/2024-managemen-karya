<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 footer-contact">
                    <h5>{{ $appName }}</h5>
                    <p>
                        Politeknik Negeri Malang<br>
                        Jl. Soekarno Hatta No. 9 <br>
                        Kota Malang - Jawa Timur <br>
                        Indonesia <br><br>
                        <strong>Phone:</strong> 0341 - 404424/404425<br>
                        <strong>Email:</strong> humas@polinema.ac.id<br>
                    </p>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Beranda</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang Kami</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Karya</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Berita</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Kontak Kami</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Berlangganan konten kami</h4>
                    <p>Langganan agar tidak ketinggalan dengan konten terbaru dari kami</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>{{ $appName }}</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            @foreach ($socialMedias as $name => $url)
                <a href="{{ $url }}" class="{{ $name }}"><i class="bx bxl-{{ $name }}"></i></a>
            @endforeach
        </div>
    </div>
</footer><!-- End Footer -->
