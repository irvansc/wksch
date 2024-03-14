@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Slider utama')


@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Slider utama</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Slider utama
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection


@section('content')
@livewire('back.slider-list-utama')
@endsection

@push('scripts')
    <script>
        window.addEventListener('hideSliderModal', function(e) {
            $('#slider_modal').modal('hide');
        })
        window.addEventListener('showsliderModal', function(e) {
            $('#slider_modal').modal('show');
        })

        $('#slider_modal').on('hide.bs.modal', function(e) {
            Livewire.emit('resetModalForm')
        });
        window.addEventListener('deleteSlider', function(event) {
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
                    window.Livewire.emit('deleteSliderAction', event.detail.id)
                }
            });
        });

        $('table tbody#sortable_slider').sortable({
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
                window.Livewire.emit("updateSliderOrdering", positions);
            }
        })
    </script>
@endpush
