@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit sarana')
@section('content')

@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit sarana</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.sarana') }}">sarana</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit sarana
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

<form action="{{ route('admin.update-sarana',['sarana_id'=>request('sarana_id')]) }}" method="POST"
    id="editFormSarana" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-box mb-2">
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $sarana->title }}">
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sarpras content</label>
                        <textarea class="ckeditor form-control" name="description" rows="6" placeholder="Content.."
                            id="description">{!!$sarana->description!!}</textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary ">Save</button>
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
    class MyUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            xhr.open( 'POST', "{{route('admin.posts.post-upload', ['_token' => csrf_token() ])}}", true );
            xhr.responseType = 'json';
        }

        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                resolve( response );
            } );

            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        _sendRequest( file ) {
            const data = new FormData();

            data.append( 'upload', file );

            this.xhr.send( data );
        }
    }

    function MyCustomUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new MyUploadAdapter( loader );
        };
    }

    ClassicEditor
        .create( document.querySelector( '#description' ), {
            extraPlugins: [ MyCustomUploadAdapterPlugin ],
        } )
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
    $('form#editFormSarana').on('submit', function(e) {
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
                    toastr.success(response.msg);
                    // Extract the URL and redirect
                    setTimeout(() => {
                    // Use a publicly accessible URL for testing
                    var redirectUrl = "{{ route('admin.sarana') }}";
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
