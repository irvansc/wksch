@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Import Alumni')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Import Alumni</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Import Alumni
                    </li>
                </ol>
            </nav>
        </div>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
</div>
@endsection
@section('content')

<div class="col-md-8">
    <div class="card card-box">
        <div class="card-header">
            <div class="clearfix">
                    <div class="pull-right ">
                        <a href="{{ route('admin.import.template')}}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                        Download Template
                    </a>
                    </div>

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.import-alumni') }}" method="POST" enctype="multipart/form-data" id="form-import" needs-validation
            novalidate accept-charset="UTF-8">
                @csrf
                @method("POST")
                <div class="form-group">
                    <label for="file">File</label>
                <input type="file" name="file" id="file" class="form-control ">
                <div class="form-control-feedback text-danger"  id="fileError">
                </div>
                <small class="form-text text-muted"><strong class="text-danger">Note*</strong> : Type file harus
                    xlsx/xls.</small>
                </div>
                <div class="mb-t">
                    <label class="form-label">Progress</label>
                    <div class="progress mb-2">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <span class="visually-hidden">38% Complete</span>
                      </div>
                    </div>
                  </div>
                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('admin.alumni') }}"  class="btn btn-warning"><i class="icon-copy bi bi-arrow-bar-left"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
  <script>
    $(function() {
      $('#form-import').on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var formData = new FormData(this);
        var formURL = $(this).attr("action");

		    $.ajax({
          url: formURL,
			    method: "POST",
			    data: formData,
          contentType: false,
          processData: false,
          beforeSend: function() {
            $("button").attr("disabled",true);
            var percentage = '0';

            const onlyInputs = document.querySelectorAll('#form-import input');
            for(var i = 0; i < onlyInputs.length; i++) {
                name = onlyInputs[i].id;
                if (name) {
                  document.getElementById(name).setCustomValidity('');
                }
            }
          },
          uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
          complete: function() {
            $("button").attr("disabled",false);
          },
          success:function(data) {
            $("button").attr("disabled",false);
            if (data.success) {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'save successful',
              }).then(function (result) {
                window.location.href = "{{ route('admin.alumni') }}";
              })
            }
          },
          error: function(jqXhr, json, errorThrown) {
            $("button").attr("disabled",false);
            var data = jqXhr.responseJSON;
            $.each(data.errors, function(index, value) {
              if (!isNaN(index)) {
                index = 'file';
              }
              $('#'+index+'Error').html(value[0]);
              document.getElementById(index).setCustomValidity(value[0]);
            });
            Swal.fire({
              icon: 'error',
              title: 'Error Validation',
              text: 'Please check your input',
            });
            $('#form-import').addClass('was-validated');
          }
        });
      });
    });
  </script>
  @endpush
