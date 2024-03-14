@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'All posts')

@section('pageHeader')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <div class="card card-stacked">
            <div class="card-status-top bg-primary">
                <h2 class="text-center">
                        All Posts
                </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
@livewire('back.all-posts')
@endsection
@push('scripts')
    <script>
        window.addEventListener('deletePost', function(event){
            swal.fire({
                 title:event.detail.title,
                imageWidth:48,
                imageHeight:48,
                html:event.detail.html,
                showCloseButton:true,
                showCancelButton:true,
                confirmButtonText:"Yes, Delete.",
                cancelButtonColor:'#d33',
                confirmButtonColor:'#3085d6',
                width:300,
                allowOutsideClick:false

            }).then(function(result){
                if (result.value) {
                    window.Livewire.emit('deletePostAction',event.detail.id)
                }
            });
        })
    </script>
@endpush
