
@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'prestasi sekolah')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>prestasi sekolah</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        prestasi sekolah
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
@livewire('back.prestasi-sekolah')
@endsection


@push('scripts')
<script>
    window.addEventListener('hidePrestasiModal', function(e) {
            $('#prestasi_modal').modal('hide');
        })
        window.addEventListener('showprestasiModal', function(e) {
            $('#prestasi_modal').modal('show');
        })
        $('#prestasi_modal,#subprestasi_modal').on('hide.bs.modal', function(e) {
            Livewire.emit('resetModalForm')
        });

        window.addEventListener('deletePrestasi', function(event) {
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
                    window.Livewire.emit('deletePrestasiAction', event.detail.id)
                }
            });
        })



        $('table tbody#sortable_prestasi').sortable({
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr("data-ordering") != (index + 1)) {
                        $(this).attr("data-ordering", (index + 1)).addClass("updated");
                    }
                });
                var positions = [];
                $(".updated").each(function() {
                    positions.push([$(this).attr("data-index"), $(this).attr("data-ordering")]);
                    $(this).removeClass("updated");
                });
                window.Livewire.emit("updatePrestasiOrdering", positions);
            }
        })
</script>
@endpush
