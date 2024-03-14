<div>
    <div class="row mt-3">

        <div class="col-md-8 mb-2">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Videos
                        </h2>
                        <div class="text-muted mt-1">{{ $videos->count() }} Videos</div>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <div class="me-3">
                                <div class="input-icon">
                                    <input type="search" class="form-control" placeholder="Search" wire:model='search'>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#video_modal" type="button">
                                Add Video
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-box">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table card-table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Video Title</th>
                                    <th>Video Url</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody id="sortable_video">
                                @forelse ($videos as $e=>$vid)
                                <tr data-index="{{$vid->id}}" data-ordering="{{$vid->ordering}}">
                                    <td>
                                        {{ $e+1 }}
                                    </td>
                                    <td>{{$vid->title}}</td>
                                    <td>
                                        <a target="_blank" href="{{ $vid->url_video }}">{{ $vid->url_video }}</a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" wire:click.prevent='editVideo({{$vid->id}})'
                                                class="btn  btn-primary">Edit</a> &nbsp;
                                            <a href="#" wire:click.prevent='deleteVideo({{$vid->id}})'
                                                class="btn  btn-danger">Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3"><span class="text-danger">Videos Not Found!</span></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- Modals --}}
    <div wire:ignore.self class="modal fade" id="video_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">
                        {{$updateVideoMode ? 'Updated Video' : 'Add Video'}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-content" method="POST" @if ($updateVideoMode) wire:submit.prevent='updateVideo()'
                    @else wire:submit.prevent='addVideo()' @endif>
                    <div class="modal-body">
                        @if ($updateVideoMode)
                        <input type="hidden" wire:model='selected_video_id'>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Video title</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter title video" wire:model='title'>
                            <span class="text-danger">@error('title')
                                {!!$message!!}
                                @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vide Url</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter url video" wire:model='url_video'>
                            <span class="text-danger">@error('url_video')
                                {!!$message!!}
                                @enderror</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning " data-dismiss="modal" aria-hidden="true">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">{{$updateVideoMode ? 'Update':'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
