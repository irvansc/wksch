<div>
    <div class="row mt-3">
        <div class="col-md-8 mb-2">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <div class="me-3 mb-3">
                                <div class="input-icon">
                                    <a href="#" class="btn  btn-primary" data-bs-toggle="modal"
                                data-bs-target="#slideralumni_modal" type="button">
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
                    <div class="card-title">
                        Slider Alumni
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>Img</th>
                                    <th>Nama Alumni</th>
                                    <th>Deskripsi</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody id="sortable_slideralumni">
                                @forelse ($alumnis as $slid)
                                <tr data-index="{{$slid->id}}" data-ordering="{{$slid->ordering}}">
                                    <td>
                                        <img src="{{ $slid->img }}" alt="" style="width: 100px">
                                    </td>
                                    <td>
                                        {{ $slid->name }}
                                    </td>
                                    <td>
                                        {{ $slid->desc }}
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
                                    <td colspan="3"><span class="text-danger">Slider Alumni Not Found!</span></td>
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
      <div wire:ignore.self class="modal fade" id="slideralumni_modal" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myLargeModalLabel">
                      {{$updateSliderAlumniMode ? 'Updated Slider Alumni' : 'Add Slider Alumni'}}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form class="modal-content" method="POST" @if ($updateSliderAlumniMode)
                  wire:submit.prevent='updateSliderAlumni()' @else wire:submit.prevent='addSliderAlumni()' @endif>
                  <div class="modal-body">
                      @if ($updateSliderAlumniMode)
                      <input type="hidden" wire:model='selected_slideralumni_id'>
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
                            <img src="{{$oldImg}}" alt="" style="width: 200px">
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
                        <label class="form-label">Nama Alumni</label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter name" wire:model='name'>
                        <span class="text-danger">@error('name')
                            {!!$message!!}
                            @enderror</span>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Ucapan </label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Enter desc" wire:model='desc'>
                        <span class="text-danger">@error('desc')
                            {!!$message!!}
                            @enderror</span>
                      </div>
                  </div>
                  <div class="modal-footer">

                      <button type="submit" class="btn btn-primary w-50 mt-2">
                          {{$updateSliderAlumniMode ? 'Update':'Save'}}
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
