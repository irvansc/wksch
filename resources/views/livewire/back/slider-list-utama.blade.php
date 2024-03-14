<div>
    <div class="row mt-3">
        <div class="col-md-8 mb-3">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <div class="me-3 mb-3">
                                <div class="input-icon">
                                    <a href="#" class="btn  btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#slider_modal" type="button">
                                        Add Slider
                                    </a>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-box">
                <div class="card-header">
                    <h2 class="card-title">
                        Slider Utama
                    </h2>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>Slider</th>
                                    <th>Title</th>
                                    <th>Deskripsi</th>
                                    <th>Button Action</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody id="sortable_slider">
                                @forelse ($sliders as $slid)
                                <tr data-index="{{$slid->id}}" data-ordering="{{$slid->ordering}}">
                                    <td>
                                        <img src="storage/images/album/slider/{{ $slid->img }}" alt="" style="width: 200px">
                                    </td>
                                    <td>
                                        {{ $slid->title }}
                                    </td>
                                    <td>
                                        {{ $slid->desc }}
                                    </td>
                                    <td>
                                        <a href="{{ $slid->action }}">{{ $slid->action_title }}</a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" wire:click.prevent='editSlide({{$slid->id}})'
                                                class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                            <a href="#" wire:click.prevent='deleteSlide({{$slid->id}})'
                                                class="btn btn-sm btn-danger">Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3"><span class="text-danger">Slider Not Found!</span></td>
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
      <div wire:ignore.self class="modal fade" id="slider_modal" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myLargeModalLabel">
                      {{$updateSliderMode ? 'Updated Slider' : 'Add Slider'}}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form class="modal-content" method="POST" @if ($updateSliderMode)
                  wire:submit.prevent='updateSlider()' @else wire:submit.prevent='addSlider()' @endif>
                  <div class="modal-body">
                      @if ($updateSliderMode)
                      <input type="hidden" wire:model='selected_slider_id'>
                      @endif
                      <div class="mb-3">
                        <label class="form-label">IMG slider</label>
                        <input type="file" class="form-control" name="img"
                             wire:model='img'>
                        <span class="text-danger">@error('img')
                            {!!$message!!}
                            @enderror</span>
                            <div wire:loading wire:target="img" wire:key="img">
                                <h3 class="text-blue">Uploading<span class="animated-dots"></span></h3>

                            </div>

                      </div>
                      <div class="mb-3">
                        @if ($oldImg)
                        <div class="mb-3">
                            <label for="">Old Image :</label>
                            <img src="storage/images/album/slider/{{ $oldImg}}" alt="" style="width: 200px">
                        </div>
                        @endif
                        @if ($img)
                        <div class="mb-3">
                            <label for="">New Image</label>
                            <img src="{{ $img->temporaryUrl() }}" alt="" style="width: 200px">
                        </div>
                        @endif
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Title <small class="text-muted">Opsional</small></label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter title" wire:model='title'>
                        <span class="text-danger">@error('title')
                            {!!$message!!}
                            @enderror</span>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Deskripsi <small class="text-muted">Opsional</small></label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter desc" wire:model='desc'>
                        <span class="text-danger">@error('desc')
                            {!!$message!!}
                            @enderror</span>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Button action Title<small class="text-muted">Opsional</small></label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter action title" wire:model='action_title'>
                        <span class="text-danger">@error('action_title')
                            {!!$message!!}
                            @enderror</span>
                    </div>
                      <div class="mb-3">
                        <label class="form-label">Button action <small class="text-muted">Opsional (masukan url)</small></label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter action" wire:model='action'>
                        <span class="text-danger">@error('action')
                            {!!$message!!}
                            @enderror</span>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary w-50 mt-2">
                          {{$updateSliderMode ? 'Update':'Save'}}
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
