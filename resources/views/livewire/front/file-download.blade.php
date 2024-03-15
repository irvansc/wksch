<div >
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>FILE DOWNLOAD</h2>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card rounded-0 border border-secondary mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Files name</th>
                                            <th>size</th>
                                            <th>Type</th>
                                            <th>Keterangan</th>
                                            <th>Created</th>

                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @forelse ($folders as $fol)
                                        <tr>
                                            <td>{{$fol->title}}</td>
                                            <td >
                                                {{$fol->file_size}}
                                            </td>
                                            <td >
                                                {{$fol->file_ext}}
                                            </td>
                                            <td >
                                                {{$fol->file_ket}}
                                            </td>
                                            <td >
                                                {{$fol->created_at->diffForHumans()}}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a  href="{{ route('folders.downloads', ['filename' => $fol['file_name']]) }}"
                                                        class="btn btn-sm btn-warning ">download</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3"><span class="text-danger">Folder Not Found!</span></td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                        </div>
                        </div>
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
