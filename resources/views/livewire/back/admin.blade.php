<div>
    <div class="page-header d-print-none mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Authors
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"
                        wire:model='search'>
                    <a href="#" class="btn btn-primary" data-bs-target="#add_author_modal" data-bs-toggle="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        New author
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>isPublished ?</th>
                    <th class="w-1">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($authors as $e=>$author)
                <tr>
                    <td>{{ $e+1 }}</td>
                    <td>
                        <div class="d-flex py-1 align-items-center">
                            <span class="avatar me-2"
                                style="background-image: url( {{ $author->picture }})"></span>
                            <div class="flex-fill">
                                <div class="font-weight-medium">{{ $author->name }}</div>
                                <div class="text-muted">{{ $author->adminType->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $author->name }}
                    </td>
                    <td class="text-muted">
                        {{ $author->email }}
                    </td>
                    <td>
                        {{ $author->adminType->name }}
                    </td>
                    <td>
                        @if ($author->direct_publish == 1)

                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" checked="" readonly>
                          </label>
                        @else

                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" readonly>
                          </label>
                        @endif
                    </td>

                    <td>
                        <div class="d-flex py-1 align-items-center">
                            <a wire:click.prevent='editAuthor({{ $author }})' class="btn btn-sm btn-warning ">Edit</a>
                            <a wire:click.prevent='deleteAuthor({{ $author }})' class="btn btn-sm btn-danger" style="margin-left: 3px">Delete</a>
                        </div>
                    </td>
                    </tr>
                    @empty
                    <span class="text-danger">No Author Found!</span>
                    @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mt-4">
        {{ $authors->links('livewire::bootstrap') }}
    </div>

    {{-- modals --}}

    <div wire:ignore.self class="modal modal-blur fade" id="add_author_modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addAuthor()' method="post">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter name" wire:model='name'>
                            <span class="text-danger">
                                @error('name')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter email" wire:model='email'>
                            <span class="text-danger">
                                @error('email')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter username" wire:model='username'>
                            <span class="text-danger">
                                @error('username')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="form-label">Author Type</label>
                            <div>
                                <select class="form-select" wire:model='author_type'>
                                    <option>-- No Selected --</option>
                                    @foreach (\App\Models\Type::all() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('author_type')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Is direct publisher ?</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="direct_publisher"
                                        value="1" wire:model='direct_publisher'>
                                    <span class="form-check-label">Yes</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="direct_publisher"
                                        value="0" wire:model='direct_publisher'>
                                    <span class="form-check-label">No</span>
                                </label>
                            </div>
                            <span class="text-danger">
                                @error('direct_publisher')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- modals edit --}}

    <div wire:ignore.self class="modal modal-blur fade" id="edit_author_modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='updateAuthor()' method="post">
                        <input type="hidden" wire:model='selected_author_id'>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter name" wire:model='name'>
                            <span class="text-danger">
                                @error('name')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter email" wire:model='email'>
                            <span class="text-danger">
                                @error('email')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter username" wire:model='username'>
                            <span class="text-danger">
                                @error('username')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3 ">
                            <label class="form-label">Author Type</label>
                            <div>
                                <select class="form-select" wire:model='author_type'>
                                    @foreach (\App\Models\Type::all() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('author_type')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Is direct publisher ?</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="direct_publisher"
                                        value="1" wire:model='direct_publisher'>
                                    <span class="form-check-label">Yes</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="direct_publisher"
                                        value="0" wire:model='direct_publisher'>
                                    <span class="form-check-label">No</span>
                                </label>
                            </div>
                            <span class="text-danger">
                                @error('direct_publisher')
                                    {!! $message !!}
                                @enderror
                            </span>
                        </div>


                        <div class="mb-3">
                            <div class="form-label">Blocked Author ?</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked="" wire:model='blocked'>
                                <span class="form-check-label"></span>
                            </label>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
