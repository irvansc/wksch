@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit peta')
@section('content')

@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit peta</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.peta-sekolah') }}">peta</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit peta
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

<form action="{{ route('admin.update-peta',['peta_id'=>request('peta_id')]) }}" method="POST" id="editFormPeta"
    enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Title <small><strong style="color: red">(kosongkan jika tidak perlu)</strong></small></label>
                        <input type="text" name="title" class="form-control" value="{{ $peta->title }}">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <small><strong style="color: red">(kosongkan jika tidak perlu)</strong></small></label>
                        <textarea class="ckeditor form-control" name="desc" rows="6" placeholder="Content.."
                            id="desc">{!! $peta->desc !!}</textarea>
                        <span class="text-danger error-text desc_error"></span>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card card-box mb-2">
                <div class="card-body">

                    <div class="mb-3">
                        <div class="form-label">PETA SEKOLAH</div>
                        <input type="file" class="form-control" name="image">
                        <span class="text-danger error-text image_error"></span>

                    </div>
                    <div class="image_holder mb-2" style="max-width: 250px">
                        <img src="" alt="" class="img-thumbnail" id="image-previewer"
                            data-ijabo-default-img="storage/images/peta_images/thumbnails/resized_{{$peta->image}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('stylesheets')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@endpush

@push('scripts')

<script>
    ClassicEditor
        .create( document.querySelector( '#desc' ))
        .catch( error => {
            console.error( error );
        } );
    </script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('form#editFormPeta').on('submit', function(e) {
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
            }
            , success: function(response) {
                toastr.remove();
                if (response.code == 1) {
                    $(form)[0].reset();
                    $('div.image_holder').find('img').attr('src', '');
                    $('input[name="post_tags"]').amsifySuggestags({
                        type: 'amsify'
                    });
                    toastr.success(response.msg);
                    // Extract the URL and redirect
                    setTimeout(() => {
                    // Use a publicly accessible URL for testing
                    var redirectUrl = "{{ route('admin.peta-sekolah') }}";
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
    $('input[type="file"][name="image"]').ijaboViewer({
        preview: '#image-previewer'
        , imageShape: 'rectangular'
        , allowedExtensions: ['jpg', 'jpeg', 'png']
        , onErrorShape: function(message, element) {
            alert(message);
        }
        , onInvalidType: function(message, element) {
            alert(message);
        }
        , onSuccess: function(message, element) {

        }
    });

</script>
@endpush
