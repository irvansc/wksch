<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="{{ route('admin.documentation') }}"
                            class="link-secondary">Documentation</a></li>
                    <li class="list-inline-item"><a href="{{ route('admin.licensi') }}" class="link-secondary">License</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        <a href="/" class="link-secondary">{{ webInfo()->web_name }}</a>.
                        All rights reserved.
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="link-secondary" rel="noopener">
                            v1.0.0
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
