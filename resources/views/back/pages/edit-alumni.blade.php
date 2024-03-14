@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Alumni')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit alumni</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.alumni') }}">All Alumni</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit new alumni
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection
@section('content')

<form action="{{ route('admin.update-alumni',['alumni_id' =>request('alumni_id')]) }}" method="post" id="editFormAlumni" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input value="{{ $alumni->name }}" type="text" class="form-control" name="name" placeholder=" Nama Lengkap">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat " class="form-control" value="{{ $alumni->alamat }}">
                        <span class="text-danger error-text alamat_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="jenkel" id="jenkel">
                        <option value="">--Select--</option>
                        <option value="L" @if ($alumni->jenkel == 'L')
                            selected
                            @endif>Laki-laki</option>
                        <option value="P" @if ($alumni->jenkel == 'P')
                            selected
                            @endif>Perempuan</option>
                        </select>
                        <span class="text-danger error-text jenkel_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input value="{{ $alumni->tgl_lahir }}" type="text" class="form-control" name="tgl_lahir"  id="datepicker">
                        <span class="text-danger error-text tgl_lahir_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tahun Masuk</label>
                                <input value="{{ $alumni->thn_masuk }}" type="number" class="form-control" name="thn_masuk" placeholder=" Tahun lulus">
                                <span class="text-danger error-text thn_masuk_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tahun lulus</label>
                                <input value="{{ $alumni->thn_lulus }}" type="number" class="form-control" name="thn_lulus" placeholder=" Tahun lulus">
                                <span class="text-danger error-text thn_lulus_error"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-label">NIS</div>
                        <input value="{{ $alumni->nis }}" type="number" name="nis" id="nis" class="form-control">
                        <span class="text-danger error-text nis_error"></span>

                    </div>
                    <div class="mb-3">
                        <div class="form-label">E-mail</div>
                        <input value="{{ $alumni->email }}" type="email" name="email" id="email" class="form-control">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">WhatsAap</div>
                        <input value="{{ $alumni->telp }}" type="number" name="telp" id="telp" class="form-control">
                        <span class="text-danger error-text telp_error"></span>
                    </div>

                    <div class="mb-3">
                        <div class="form-label">Featured Image</div>
                        <input type="file" class="form-control" name="img">
                        <span class="text-danger error-text img_error"></span>

                    </div>
                    <div class="image_holder mb-2" style="max-width: 250px">
                        <img src="" alt="" class="img-thumbnail" id="image-previewer"
                        data-ijabo-default-img="{{$alumni->img}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('back/vendor/datepicker/jquery.datetimepicker.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('back/vendor/datepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script type="text/javascript">
    jQuery('#datepicker').datepicker({
            timepicker:false,
            format: 'yyyy-mm-dd'
        });
</script>
@endpush
@push('scripts')
<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#editFormAlumni').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    }
                    , success: function(response) {
                toastr.remove();
                if (response.code == 1) {
                    $(form)[0].reset();
                    toastr.success(response.msg);
                    window.location.href = "{{ route('admin.alumni') }}";
                } else {
                    $.each(response.error, function(prefix,val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                }
            }
            , error: function(response) {
                toastr.remove();
                $.each(response.responseJSON.errors, function(prefix, val) {
                    $(form).find('span.' + prefix + '_error').text(val[0]);
                })
            }
                });
            });
    $('input[type="file"][name="img"]').ijaboViewer({
        preview: '#image-previewer'
        , allowedExtensions: ['jpg', 'jpeg', 'png']
        , onSuccess: function(message, element) {

        }
    });

</script>
@endpush
