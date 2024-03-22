    <div>
            <div class="col-md-6 mb-2">
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                    </div>
                </div>
                <div class="card card-box">
                    <div class="card-header">
                        <div class="card-title">
                            PPDB BANNER
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image 1</th>
                                        <th>Action</th>
                                        <th>STATUS</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="storage/images/album/slider/{{ $ppdb->img1 }}" alt=""
                                                style="width: 100px">
                                        </td>

                                        <td>
                                            <a href="{{ $ppdb->action }}">{{ $ppdb->action }}</a>
                                        </td>
                                        <td>
                                            @livewire('back.ppdb-status', ['model' => $ppdb, 'field' => 'isActive'],
                                            key($ppdb->id))
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" id="{{ $ppdb->id }}" class="btn btn-warning btn-sm editIcon1"
                                                    data-bs-toggle="modal" data-bs-target="#editPpdbModal">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div>
        <div class="col-md-6 mb-2">
            <div class="page-header">
                <div class="row align-items-center">
                </div>
            </div>
            <div class="card card-box">
                <div class="card-header">
                    <div class="card-title">
                        PPDB SECOND BANNER
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Action</th>
                                    <th>STATUS</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="storage/images/album/slider/{{ $ppdbSecond->img }}" alt=""
                                            style="width: 100px">
                                    </td>

                                    <td>
                                        <a href="{{ $ppdbSecond->action }}">{{ $ppdbSecond->action }}</a>
                                    </td>
                                    <td>
                                        @livewire('back.ppdb-status-second', ['model' => $ppdbSecond, 'field' =>
                                        'isActive'],
                                        key($ppdbSecond->id))
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" id="{{ $ppdbSecond->id }}" class="btn btn-warning btn-sm editIcon"
                                                data-bs-toggle="modal" data-bs-target="#editEmployeeModal">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modals --}}
    </div>


{{-- start --}}
<div>
    <div class="modal fade" id="editPpdbModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_ppdb_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ppdb_id" id="ppdb_id">
                    <input type="hidden" name="ppdb_img" id="ppdb_img">
                    <div class="modal-body">
                        <div class="row">

                            <div class="my-2">
                                <label for="img1">Image</label>
                                <input type="file" name="img1" class="form-control">
                            </div>
                            <div class="mt-2" id="img1">

                            </div>
                            <div class="col-lg">
                                <label for="action">Action</label>
                                <input type="text" name="action" id="action" class="form-control" placeholder="Action">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="edit_ppdb_btn" class="btn btn-success">Update Banner</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="hidden" name="emp_img" id="emp_img">
                    <div class="modal-body">
                        <div class="row">

                            <div class="my-2">
                                <label for="img">Image</label>
                                <input type="file" name="img" class="form-control">
                            </div>
                            <div class="mt-2" id="img">

                            </div>
                            <div class="col-lg">
                                <label for="action">Action</label>
                                <input type="text" name="action" id="action1" class="form-control" placeholder="Action">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Second
                                Banner</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // edit  ajax request
      $(document).on('click', '.editIcon1', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route("admin.edit-ppdb") }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#action").val(response.action);
            $("#img").html(
              `<img src="storage/images/album/slider/${response.img1}" width="100" class="img-fluid img-thumbnail">`);
            $("#ppdb_id").val(response.id);
            $("#ppdb_img").val(response.img);
          }
        });
      });

      // update employee ajax request
      $("#edit_ppdb_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_ppdb_btn").text('Updating...');
        $.ajax({
          url: '{{ route("admin.update-ppdb") }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {

              Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
              )
            }
            Livewire.emit('resetModalForm');
            $("#edit_ppdb_btn").text('Update  Banner');
            $("#edit_ppdb_form")[0].reset();
            $("#editPpdbModal").modal('hide');
          }
        });
      });
</script>

@endpush

@push('scripts')
<script>
    // edit  ajax request
  $(document).on('click', '.editIcon', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    $.ajax({
      url: '{{ route("admin.edit-banner") }}',
      method: 'get',
      data: {
        id: id,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        $("#action1").val(response.action);
        $("#img").html(
          `<img src="storage/images/album/slider/${response.img}" width="100" class="img-fluid img-thumbnail">`);
        $("#emp_id").val(response.id);
        $("#emp_img").val(response.img);
      }
    });
  });

  // update employee ajax request
  $("#edit_employee_form").submit(function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    $("#edit_employee_btn").text('Updating...');
    $.ajax({
      url: '{{ route("admin.update-banner") }}',
      method: 'post',
      data: fd,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response) {
        if (response.code == 1) {

            toastr.success(response.msg);
        }
        Livewire.emit('resetModalForm');
        $("#edit_employee_btn").text('Update Second Banner');
        $("#edit_employee_form")[0].reset();
        $("#editEmployeeModal").modal('hide');
      }
    });
  });
</script>
@endpush
