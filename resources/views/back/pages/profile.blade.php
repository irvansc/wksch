@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@section('content')

@livewire('back.admin-profile-header')
<hr>
    <div class="row">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                    <a href="#tabs-details" class="nav-link active" data-bs-toggle="tab">Personal Details</a>
                </li>
                <li class="nav-item">
                    <a href="#tabs-password" class="nav-link" data-bs-toggle="tab">Change Password</a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-details">
                        <div>
                            @livewire('back.admin-personal-detail')
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-password">
                        <div>
                            @livewire('back.admin-change-password')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $('#changeAdminProfilePicture').ijaboCropTool({
          preview : '',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['CROP','QUIT'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl:'{{ route("admin.change-profile-picture") }}',
          withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
            livewire.emit('updateAdminProfileHeader');
            livewire.emit('updateTopHeader');
            toastr.success(message);
          },
          onError:function(message, element, status){
                        toastr.error(message);

          }
       });
</script>
@endpush
