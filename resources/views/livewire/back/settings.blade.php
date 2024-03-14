<div>
    <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            <li class="nav-item">
                <a href="#tab1" class="nav-link active" data-bs-toggle="tab">General Settings</a>
            </li>
            <li class="nav-item">
                <a href="#tab2" class="nav-link" data-bs-toggle="tab">Logo & Favicon</a>
            </li>
            <li class="nav-item">
                <a href="#tab3" class="nav-link" data-bs-toggle="tab">Sosial Media</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active show" id="tab1">
                @livewire('back.admin-general-setting')
            </div>
            <div class="tab-pane" id="tab2">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Set blog logo</h3>
                        <div class="mb-2" style="max-width: 200px">
                            <img src="" alt="" class="img-thumbnail" id="logo-image-preview"
                                data-ijabo-default-img="{{ webLogo()->logo_utama }}">
                        </div>
                        <form action="{{ route('admin.change-blog-logo') }}" method="post"
                            id="changeBlogLogoForm">
                            @csrf
                            <div class="mb-2">
                                <input type="file" name="logo_utama" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h3>Set Favicon logo</h3>
                        <div class="mb-2" style="max-width: 100px">
                            <img src="" alt="" class="img-thumbnail" id="favicon-image-preview"
                                data-ijabo-default-img="{{ webLogo()->logo_favicon }}">
                        </div>
                        <form action="{{ route('admin.change-blog-favicon') }}" method="post"
                            id="changeBlogFaviconForm">
                            @csrf
                            <div class="mb-2">
                                <input type="file" name="logo_favicon" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
                <div class="tab-pane" id="tab3">
                @livewire('back.admin-social-media-form')
            </div>
          </div>
        </div>
      </div>
</div>
