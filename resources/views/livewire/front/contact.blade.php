<div>
    @livewire('front.ppdb-banner')
    <!-- content -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>HUBUNGI KAMI</h2>
            </div>
            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('message') }}
            </div>
        @endif
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card rounded-0 border border-secondary mb-3">
                       <form wire:submit.prevent='addContact()' method="post">
                        <div class="card-body">
                            <div class="form-group row mb-2">
                                <label for="comment_author" class="col-sm-3 control-label">Nama Lengkap <span
                                        style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror form-control-sm  rounded-0 border border-secondary"
                                        id="name" name="name" wire:model='name'>
                                        @error('name')
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
                                        class="form-control @error('email')
                                        is-invalid
                                    @enderror form-control-sm rounded-0 border border-secondary"
                                        id="email" name="email" wire:model='email'>
                                        @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="telp" class="col-sm-3 control-label">Telphon/WhatsAap <span
                                        style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number"
                                        class="form-control @error('telp')
                                        is-invalid
                                    @enderror form-control-sm rounded-0 border border-secondary"
                                        id="telp" name="telp" wire:model='telp'>
                                        @error('telp')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="url" class="col-sm-3 control-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control form-control-sm rounded-0 border border-secondary"
                                        id="url" name="url" placeholder="Laporkan Url ?">
                                        <small class="text-danger">Optional</small>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="pesan" class="col-sm-3 control-label">Pesan <span
                                        style="color: red">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control @error('pesan')
                                    is-invalid
                                @enderror form-control-sm rounded-0 border border-secondary"
                                        id="pesan" name="pesan" rows="4"
                                        style="height: 78px;" wire:model='pesan'></textarea>
                                        @error('pesan')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row mb-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-contact rounded-0">
                                        <i class="fa fa-paper-plane"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
                <!-- End blog entries list -->

                <!-- End blog sidebar -->
                @livewire('front.sidebar-content')
            </div>
        </div>
    </section>
    <!-- end content -->
</div>
