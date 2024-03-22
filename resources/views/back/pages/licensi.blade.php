@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Direktori Alumni')
@section('pageHeader')
<div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">
          Tabler License
        </h2>
      </div>
    </div>
  </div>
@endsection
@section('content')

<div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-lg-8">
          <div class="card card-lg">
            <div class="card-body">
              <div class="markdown">
                <p>Hallo...</p>
                <hr>
                <p>Sebelumnya terimakasih buat kalian yang sudah membeli sourcecode website ini.</p>
                <p>Namun website ini mempunyai hak cipta / licensi yang berlaku :</p>
                <h3 id="tabler-free-license">WKSCH Reguler License</h3>
                <p><b>WEBSITE WKSCH</b> ini mempunya reguler licensi yang kalian dapatkan.</p>
                <p>Reguler licensi adalah, kalian berhak atas sourcecode website ini sepenuhnya,
                    dalam artian kalian boleh merubah, menambah, mengurangi, fitur-fitur yang ada dalam website ini.
                    <i><b>(sekalipun digunakan untuk sekolah yang kalian kelola diperbolehkan)</b></i>
                    akan tetapi kalian tidak di perbolehkan untuk menjual ulang sourcecode website ini, tanpa izin dari pembuat..</p>
              </div>

            </div>
            <div class="card-footer">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            <a href="/" class="link-secondary">WKNG PROJECT</a>.
                            All rights reserved.
                        </li>
                    </ul>
                </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
