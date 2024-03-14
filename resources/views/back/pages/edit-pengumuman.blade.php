@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit pengumuman')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit pengumuman</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.pengumuman') }}">All pengumuman</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit pengumuman
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection
@section('content')

<form action="{{ route('admin.update-pengumuman',['pengumuman_id'=>request('pengumuman_id')]) }}" method="POST"
    id="editFormPengumuman">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Pengumuman Title</label>
                        <input type="text" class="form-control " name="title" placeholder="Enter pengumuman title"
                            value="{{$pengumuman->title}}">
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Post Content</label>
                        <textarea class="ckeditor form-control" name="description" rows="6" placeholder="Content.."
                            id="description">{!!$pengumuman->description!!}</textarea>
                        <span class="text-danger error-text description_error"></span>
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
        .create( document.querySelector( '#description' ))
        .catch( error => {
            console.error( error );
        } );

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
            $('form#editFormPengumuman').on('submit',function(e){
                e.preventDefault();
                toastr.remove();
                var form = this;
                var fromdata = new FormData(form);
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:fromdata,
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(response){
                        toastr.remove();
                        if (response.code == 1) {
                            toastr.success(response.msg);
                            window.location.href = "{{ route('admin.pengumuman') }}";
                        } else {
                            toastr.error(response.msg)
                        }
                    },
                    error:function(response) {
                        toastr.remove();
                        $.each(response.responseJSON.errors, function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        })
                    }
                })
            })
</script>
@endpush
