@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelas')
@section('content')

@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Kelas</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.siswa-list') }}">All Siswa</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Kelas
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection
@livewire('back.kelas-list')
@endsection
@push('scripts')
<script>
    window.addEventListener('hideKelasModal', function(e) {
            $('#kelas_modal').modal('hide');
        })
        window.addEventListener('showkelasModal', function(e) {
            $('#kelas_modal').modal('show');
        })

        $('#kelas_modal').on('hide.bs.modal', function(e) {
            Livewire.emit('resetModalForm')
        });

        window.addEventListener('deleteKelas', function(event) {
            swal.fire({
                title: event.detail.title,
                imageWidth: 48,
                imageHeight: 48,
                html: event.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes, Delete.",
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: 300,
                allowOutsideClick: false

            }).then(function(result) {
                if (result.value) {
                    window.Livewire.emit('deleteKelasAction', event.detail.id)
                }
            });
        })
</script>
@endpush
