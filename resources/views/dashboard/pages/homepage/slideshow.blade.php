<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>!D - Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- endinject -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon_io/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon_io/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon_io/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('assets/favicon_io/site.webmanifest') }}">
    {{-- Toastify  --}}
    @toastifyCss
    {{-- TinyMCE head  --}}
    <x-head.tinymce-config/>
</head>
{{-- @if(count($errors) > 0)
@foreach($errors->all() as $error)
    {{ toastify()->error($error) }}
@endforeach
@endif --}}
@foreach ($errors->all() as $error)
    {{ toastify()->error($error) }}
@endforeach

@if(session('success'))
    {{ toastify()->success(session('success')) }}
@endif

@if(session('error'))
    {{ toastify()->error(session('error')) }}
@endif


<body>
  <div class="container-scroller">


    {{-- Navbar  --}}
    @include('dashboard.partials.navbar')
    {{-- End Navbar --}}


    <div class="container-fluid page-body-wrapper">


    {{-- Sidebar  --}}
    @include('dashboard.partials.sidebar')
    {{-- End Sidebar  --}}


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New Slideshow</h4>

                    <form class="forms-sample" method="POST"
                    action="{{ route('slideshow.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                        <div class="form-group">
                            <label>Slideshow Image</label>
                            <input type="file" name="slideshow_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Caption</label>
                            <x-forms.tinymce-editor-caption/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Body</label>
                            <x-forms.tinymce-editor-body/>
                        </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>

                  </div>
                </div>
              </div>

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Sliders</h4>
                    <p class="card-description">
                      All currently published sliders on the homepage
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Caption</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                          <tr>
                            <td>{{ $slider->id }}</td>
                            <td class="py-1">
                              <img src="{{ asset($slider->slideshow_image) }}" alt="image"/>
                            </td>
                            <td>{!! $slider->caption !!}</td>
                            <td>
                                <button type="button" class="btn btn-inverse-info btn-icon">
                                    <i class="mdi mdi-file-document-edit"></i>
                                </button>
                            </td>
                            <td>
                                <form method="POST" action="/slideshow/{{ $slider->id }}">
                                    @csrf
                                    @method('DELETE')
                                    {{-- <input type="text" name="id" value="{{ $slider->id }}" hidden> --}}
                                    <button type="submit" class="btn btn-inverse-danger btn-icon">
                                        <i class="icon-trash"></i>
                                    </button>
                                </form>
                            </td>
                          </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>


        <!-- content-wrapper ends -->

        {{-- Footer --}}
        @include('dashboard.partials.footer')
        {{-- End Footer  --}}


      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
    <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{ asset('vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{ asset('js/file-upload.js') }}"></script>
  <script src="{{ asset('js/typeahead.js') }}"></script>
  <script src="{{ asset('js/select2.js') }}"></script>
  <!-- End custom js for this page-->
      {{-- Toastify  --}}
      @toastifyJs
</body>

</html>
