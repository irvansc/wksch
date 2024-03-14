<div>

    <div class="row mt-3">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <h4>Files</h4>
                        <li class="nav-item ms-auto">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.add-folder') }}" >
                                Add Files
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>Files name</th>
                                    <th>Files size</th>
                                    <th>Files Type</th>
                                    <th>Upload</th>

                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody id="sortable_folder">
                                @forelse ($folders as $fol)
                                <tr data-index="{{$fol->id}}" data-ordering="{{$fol->ordering}}">
                                    <td>{{$fol->title}}</td>
                                    <td >
                                        {{$fol->file_size}}
                                    </td>
                                    <td >
                                        {{$fol->file_ext}}
                                    </td>
                                    <td >
                                        {{$fol->created_at->diffForHumans()}}
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <a  href="{{ route('admin.edit-folder',['folder_id'=>$fol->id]) }}"
                                                class="btn btn-sm btn-primary " style="margin-left: 3px">Edit</a> &nbsp;
                                            <a href="#" wire:click.prevent='deleteFolder({{$fol->id}})'
                                                class="btn btn-sm btn-danger " style="margin-left: 3px">Delete</a>
                                            <a  href="{{ route('admin.folders.download', ['filename' => $fol['file_name']]) }}"
                                                class="btn btn-sm btn-info " style="margin-left: 3px">download</a>

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

    </div>

</div>
