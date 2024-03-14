@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kepsek')

@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Kepsek</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Kepsek
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection


@section('content')

@livewire('back.kepala-sekolah')

@endsection

@push('scripts')
<script>
    $('#changeKepsekProfilePicture').ijaboCropTool({
          preview : '',
        //   3/4
          setRatio: 3/4,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['CROP','QUIT'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl:'{{ route("admin.change-profile-picture-kepsek") }}',
          withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
            toastr.success(message);

          },
          onError:function(message, element, status){
                        toastr.error(message);

          }
       });
</script>
@endpush
