<div>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <img src="{{ $img }}" alt="">
                </div>
                <div class="d-flex">
                    <a href="#" class="card-btn"
                        onclick="event.preventDefault();document.getElementById('changeKepsekProfilePicture').click()">
                        <!-- Download SVG icon from http://tabler-icons.io/i/pencil -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                        </svg>
                        Change Picture
                    </a>
                    <input type="file" name="img" id="changeKepsekProfilePicture" class="d-none mt-5"
                        onchange="this.dispatchEvent(new InputEvent('input'))">
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Personal Details</div>
                </div>
                <div class="card-status-start bg-primary"></div>
                <div class="card-body">
                    <form wire:submit.prevent='UpdateKepalaSekolah()' method="post" id="formKep">
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nama Lengkap</label>
                            <div class="col">
                                <input type="text" class="form-control" wire:model='name'>
                                {{-- <small class="form-hint">We'll never share your email with anyone else.</small>
                                --}}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">NIP</label>
                            <div class="col">
                                <input type="number" class="form-control" wire:model='nip'>

                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">AKREDITASI</label>
                            <div class="col">
                                <input type="text" class="form-control" wire:model='akreditasi'>

                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">SERTIFIKAT NASIONAL</label>
                            <div class="col">
                                <input type="text" class="form-control" wire:model='serint'>

                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">SAMBUTAN</label>
                            <div class="col" >
                                <div wire:ignore>
                                    <textarea class="form-control" id="desc"
                                    name="desc" wire:model="desc">
                                    {!! $desc !!}
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">VIDEO SAMBUTAN URL</label>
                            <div class="col">
                                <input type="text" class="form-control" wire:model='video_url'>

                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">
                             Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('stylesheets')
<link href="/back/vendor/summernote/summernote.min.css" rel="stylesheet">

@endpush
@push('scripts')
<script src="/back/vendor/summernote/summernote.min.js"></script>
@endpush
@push('scripts')
<script>
$('#desc').summernote({
    dialogsInBody: true,
      tabsize: 2,
      height: 200,
      toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link',  'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
      ],
      callbacks: {
          onChange: function(contents, $editable) {
          @this.set('desc', contents);
      }


  }


  });


</script>
@endpush
