<div>
    <div class="row mt-3">
        <div class="col-md-10 mb-2">
            <div class="card card-box">
                <div class="card-header">
                    <div class="clearfix">
                        <div class="pull-left">Identitas Sekolah</div>

                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" wire:submit.prevent='UpdateIdentitasSekolah()'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Nama Sekolah</label>
                                    <input type="text" class="form-control" placeholder="Nama Sekolah" wire:model='nama_sekolah'>
                                    <span class="text-danger">@error('nama_sekolah')
                                        {!!$message!!}
                                    @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">NSS/NDS/NPSN</label>
                                    <input type="text" class="form-control" placeholder="Nss" wire:model='nss'>
                                       <span class="text-danger">@error('nss')
                                        {!!$message!!}
                                    @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">AKREDITASI</label>
                                    <input type="text" class="form-control" placeholder="Akreditasi" wire:model='akreditasi'>
                                       <span class="text-danger">@error('akreditasi')
                                        {!!$message!!}
                                    @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <input type="text" class="form-control" placeholder="Status" wire:model='status'>
                                       <span class="text-danger">@error('status')
                                        {!!$message!!}
                                    @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Nokep</label>
                                    <textarea class="form-control" name="nokep" id="noke" cols="30" rows="10" wire:model='nokep'>

                                    </textarea>
                                    <span class="text-danger">@error('nokep')
                                        {!!$message!!}
                                    @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" wire:model="alamat" name="alamat" id="alamat" cols="30" rows="10"></textarea>
                                    <span class="text-danger">@error('alamat')
                                        {!!$message!!}
                                    @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Luas Area</label>
                                    <input type="text" class="form-control" placeholder="Luas Area" wire:model='luas_area'>
                                    <span class="text-danger">@error('luas_area')
                                        {!!$message!!}
                                    @enderror</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
