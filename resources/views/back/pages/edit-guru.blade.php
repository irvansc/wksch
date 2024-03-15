@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Guru')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit guru</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.guru') }}">All guru</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit guru
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div class="dropdown">
                <a class="btn btn-primary " href="{{ route('admin.home') }}">
                    Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<form action="{{ route('admin.update-guru',['guru_id' =>request('guru_id')]) }}" method="post" id="editFormGuru" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input value="{{ $guru->name }}" type="text" class="form-control" name="name" placeholder=" Nama Lengkap">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input value="{{ $guru->alamat }}" type="text" class="form-control" name="alamat" placeholder=" Alamat">
                        <span class="text-danger error-text alamat_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="jenkel" id="jenkel">
                        <option value="">--Select--</option>
                        <option value="L" @if ($guru->jenkel == 'L')
                            selected
                            @endif>Laki-laki</option>
                        <option value="P" @if ($guru->jenkel == 'P')
                            selected
                            @endif>Perempuan</option>
                        </select>
                        <span class="text-danger error-text jenkel_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input value="{{ $guru->tgl_lahir }}" type="text" class="form-control" name="tgl_lahir" placeholder=" Tanggal Lahir" id="datepicker">
                        <span class="text-danger error-text tgl_lahir_error"></span>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-label">NIP</div>
                        <input value="{{ $guru->nip }}" type="text" name="nip" id="nip" class="form-control">
                        <span class="text-danger error-text nip_error"></span>

                    </div>

                    <div class="mb-3">
                        <div class="form-label">GTK</div>
                        <input value="{{ $guru->gtk }}" type="text" name="gtk" id="gtk" class="form-control">
                        <span class="text-danger error-text gtk_error"></span>
                    </div>

                    <div class="mb-3">
                        <div class="form-label">Featured Image</div>
                        <input type="file" class="form-control" name="img">
                        <span class="text-danger error-text img_error"></span>

                    </div>
                    <div class="image_holder mb-2" style="max-width: 250px">
                        <img src="" alt="" class="img-thumbnail" id="image-previewer" data-ijabo-default-img="storage/images/guru_images/thumbnails/resized_{{$guru->img}}">
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
    $('#editFormGuru').on('submit', function(e){
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
                    window.location.href = "{{ route('admin.guru') }}";
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
