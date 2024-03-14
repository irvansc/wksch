<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="{{ webLogo()->logo_utama }}" alt="" />
                    </a>

                    <p>
                        <strong>Alamat:</strong> {{ webInfo()->web_alamat }} <br />
                        <strong>Phone:</strong> {{ webInfo()->web_telp }}<br />
                        <strong>Email:</strong> {{ webInfo()->web_email }}<br />
                    </p>

                    <div class="social-links mt-3">
                        <a href="{{ webSosmed()->bsm_twitter }}" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="{{ webSosmed()->bsm_facebook}}" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="{{ webSosmed()->bsm_instagram}}" class="instagram"><i
                                class="bi bi-instagram bx bxl-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Main Links</h4>
                    <ul>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="/">Home</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="">About</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="">Contact</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="">Visi-Misi</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="">Sejarah</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="">Galery</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="">Blog</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Akademik</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="">Guru</a></li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="">Siswa</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="">Pengumuman</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="">Agenda</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="">Download</a>
                        </li>

                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a onclick="">PPDB <span class="badge badge-success">DIBUKA!</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Maps</h4>
                    <iframe src="https://www.google.com/maps/embed?pb={{ webInfo()->web_maps }}" width="250"
                        height="150" style="border: 0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            Copyright &copy;
            <script>
                document.write(new Date().getFullYear());
            </script> <strong><span>{{ webInfo()->web_name }}</span></strong>. All Rights Reserved
        </div>
    </div>
</footer>
