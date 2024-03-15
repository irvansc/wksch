@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'edit folder')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>edit folder</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.folders') }}">All folder</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        edit folder
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection
@section('content')

<form action="{{ route('admin.update-folder',['folder_id'=>request('folder_id')]) }}" method="post" id="editForm" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama File</label>
                        <input type="text" class="form-control " name="title" placeholder="Nama file" value="{{ $folder->title }}">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan File</label>
                        <input type="text" name="file_ket" id="file_ket" class="form-control " value="{{ $folder->file_ket }}">
                        <span class="text-danger error-text file_ket_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <input type="file" name="file_name" id="file_name" class="form-control " value="{{ $folder->file_name }}">
                        <span class="text-danger error-text file_name_error"></span>
                        <br>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>


                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $('form#editForm').on('submit', function(e) {
        e.preventDefault();
        toastr.remove();
        var form = this;
        var fromdata = new FormData(form);
        $.ajax({
            url: $(form).attr('action')
            , method: $(form).attr('method')
            , data: fromdata
            , processData: false
            , dataType: 'json'
            , contentType: false
            , beforeSend: function() {
                $(form).find('span.error-text').text('');
                var percentVal = '0%';
            },
            uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                    },
             success: function(response) {
                toastr.remove();
                if (response.code == 1) {
                    $(form)[0].reset();
                    $('div.image_holder').find('img').attr('src', '');

                    toastr.success(response.msg);
                    // Extract the URL and redirect
                    setTimeout(() => {
                    // Use a publicly accessible URL for testing
                    var redirectUrl = "{{ route('admin.folders') }}";
                    window.location.href = redirectUrl;
                    // redirect after 1 seconds
            }, 1000)
                } else {
                    toastr.error(response.msg)
                }
            }
            , error: function(response) {
                toastr.remove();
                $.each(response.responseJSON.errors, function(prefix, val) {
                    $(form).find('span.' + prefix + '_error').text(val[0]);
                })
            }
        })
    })
    </script>
@endpush
