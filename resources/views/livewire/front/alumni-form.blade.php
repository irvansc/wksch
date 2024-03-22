<div>
    @livewire('front.ppdb-banner')
    <section class="form-alumni" id="form-alumni">
        <div class="container">
            <div class="section-title">
                <h2>PENDAFTARAN ALUMNI</h2>
            </div>
            <div>
            </div>
            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('message') }}
            </div>
        @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="card rounded-0 border border-secondary mb-3">
                        <div class="card-body">
                            <form method="POST" wire:submit.prevent='addAlumni()'>
                                @csrf
                                <div class="form-group row mb-2">
                                    <label for="name" class="col-sm-3 control-label">Nama Lengkap <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                            class="form-control form-control-sm @error('name')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="name" name="name" wire:model='name'>
                                            @error('name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="gender" class="col-sm-3 control-label">Jenis Kelamin <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="jenkel"
                                            class="custom-select custom-select-sm @error('jenkel')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="jenkel" wire:model='jenkel'>
                                            <option value="" selected="selected">Pilih :</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('jenkel')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="datepicker" class="col-sm-3 control-label">Tanggal Lahir <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="date"
                                                class="form-control form-control-sm @error('tgl_lahir')
                                                is-invalid
                                            @enderror rounded-0 border border-secondary date"
                                                 name="tgl_lahir" wire:model='tgl_lahir'>
                                            <div class="input-group-append">
                                                <span class="btn btn-sm btn-outline-secondary rounded-0"><i
                                                        class="fa fa-calendar text-dark"></i></span>
                                            </div>
                                        </div>
                                        @error('tgl_lahir')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="thn_masuk" class="col-sm-3 control-label">Tahun Masuk <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number"
                                            class="form-control form-control-sm @error('thn_masuk')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="thn_masuk" name="thn_masuk" wire:model='thn_masuk'>
                                            @error('thn_masuk')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="thn_lulus" class="col-sm-3 control-label">Tahun Lulus <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number"
                                            class="form-control form-control-sm @error('thn_lulus')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="thn_lulus" name="thn_lulus" wire:model='thn_lulus'>
                                            @error('thn_lulus')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="nis" class="col-sm-3 control-label">NIS</label>
                                    <div class="col-sm-9">
                                        <input type="number"
                                            class="form-control form-control-sm @error('nis')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="nis" name="nis" wire:model='nis'>
                                            @error('nis')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="alamat" class="col-sm-3 control-label">Alamat <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea rows="5"
                                            class="form-control form-control-sm @error('alamat')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="alamat" name="alamat" wire:model='alamat'></textarea>
                                            @error('alamat')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="email" class="col-sm-3 control-label">Email <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email"
                                            class="form-control form-control-sm @error('email')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="email" name="email" wire:model='email'>
                                            @error('email')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="telp" class="col-sm-3 control-label">Telepon/WhatsAap</label>
                                    <div class="col-sm-9">
                                        <input type="number"
                                            class="form-control form-control-sm @error('telp')
                                            is-invalid
                                        @enderror rounded-0 border border-secondary"
                                            id="telp" name="telp" wire:model='telp'>
                                            @error('telp')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="file" class="col-sm-3 control-label">Foto</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="img" name="img" wire:model='img'>
                                        <small class="form-text text-muted">Foto harus JPG dan ukuran file maksimal 2
                                            Mb</small>
                                            @error('img')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        @if ($img)
                                        <img src="{{ $img->temporaryUrl() }}"  class="img-thumbnails mt-2" style="width: 200px">
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" id="btn-form">
                                <div class="form-group row mb-0">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-alumni rounded-0"><i
                                            class="fa fa-paper-plane"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
