<div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="">
                <div class="card card-box">
                    <div class="card-header">
                        <a href="#" class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#prestasi_modal"
                            type="button">
                            Add Prestasi
                        </a>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Kegiatan</th>
                                        <th>Tingkat</th>
                                        <th>Juara</th>
                                        <th>Link</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody id="sortable_prestasi">
                                    @forelse ($prestasis as $prestasi)
                                    <tr data-index="{{$prestasi->id}}">
                                        <td>{{$prestasi->bulan}}</td>
                                        <td>{{$prestasi->tahun}}</td>
                                        <td>{{$prestasi->kegiatan}}</td>
                                        <td>{{$prestasi->tingkat}}</td>
                                        <td>{{$prestasi->juara}}</td>
                                        <td>
                                            <a href="{{ $prestasi->link }}" target="_blank">Link</a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" wire:click.prevent='editPrestasi({{$prestasi->id}})'
                                                    class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                                <a href="#" wire:click.prevent='deletePrestasi({{$prestasi->id}})'
                                                    class="btn btn-sm btn-danger">Delete</a>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6"><span class="text-danger">Prestasi Not Found!</span></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-6 mb-2">
            <div class="card card-box">
                <div class="card-header">
                    <div class="clearfix">
                        <div class="pull-left">Prestasi Sekolah</div>

                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" wire:submit.prevent='UpdatePrestasiSekolah()'>
                        <div class="row">
                            <div class="mb-3">
                                <label for="">Title</label>
                                <input wire:model='title' type="text" class="form-control" placeholder="Judul...">
                                <span class="text-danger">@error('title')
                                    {!!$message!!}
                                    @enderror</span>
                            </div>
                            <div class="mb-3" wire:ignore>
                                <label for="">Deskripsi</label>
                                <textarea id="description" class="form-control" name="description"
                                    wire:model='description'>
                                        {{ $description  }}
                                        </textarea>
                                <span class="text-danger">@error('description')
                                    {!!$message!!}
                                    @enderror</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal modal-blur fade" id="prestasi_modal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myLargeModalLabel">
                {{$updatePrestasiMode ? 'Updated Prestasi' : 'Add Prestasi'}}
            </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-content" method="POST" @if ($updatePrestasiMode)
                      wire:submit.prevent='updatePrestasi()' @else wire:submit.prevent='addPrestasi()' @endif>
                      <div class="modal-body">
                          @if ($updatePrestasiMode)
                          <input type="hidden" wire:model='selected_prestasi_id'>
                          @endif
                          <div class="mb-3">
                              <label class="form-label">Bulan</label>
                              <input type="text" class="form-control" name="example-text-input" placeholder="Enter Bulan"
                                  wire:model='bulan'>
                              <span class="text-danger">@error('bulan')
                                  {!!$message!!}
                                  @enderror</span>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Tahun</label>
                              <input type="text" class="form-control" name="example-text-input" placeholder="Enter Tahun"
                                  wire:model='tahun'>
                              <span class="text-danger">@error('tahun')
                                  {!!$message!!}
                                  @enderror</span>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Kegiatan</label>
                              <input type="text" class="form-control" name="example-text-input"
                                  placeholder="Enter Kegiatan" wire:model='kegiatan'>
                              <span class="text-danger">@error('kegiatan')
                                  {!!$message!!}
                                  @enderror</span>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Tingkat</label>
                              <input type="text" class="form-control" name="example-text-input"
                                  placeholder="Enter Tingkat" wire:model='tingkat'>
                              <span class="text-danger">@error('tingkat')
                                  {!!$message!!}
                                  @enderror</span>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Juara</label>
                              <input type="text" class="form-control" name="example-text-input" placeholder="Enter Juara"
                                  wire:model='juara'>
                              <span class="text-danger">@error('juara')
                                  {!!$message!!}
                                  @enderror</span>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Link Posts</label>
                              <input type="text" class="form-control" name="example-text-input"
                                  placeholder="Enter Link Posts" wire:model='link'>
                              <span class="text-danger">@error('link')
                                  {!!$message!!}
                                  @enderror</span>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">{{$updatePrestasiMode ? 'Update':'Save'}}</button>
                      </div>
                  </form>
          </div>
        </div>
      </div>

</div>

@push('stylesheets')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@endpush

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
