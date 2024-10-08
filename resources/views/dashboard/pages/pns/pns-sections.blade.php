<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>!D - Admin</title>
    {{-- Favicon  --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">


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

@if(session('info'))
    {{ toastify()->info(session('info')) }}
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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="title-row" style="display: inline-flex; width: 100%;">
                        <h4 class="card-title">DOSH Products & Services</h4>
                    </div>
                    <div class="pns-row">
                        <a href="{{ route('pns-section') }}/?type=insurance"><button type="button" class="btn btn-primary btn-lg btn-active">Dosh Insurance</button></a>

                        <a href="{{ route('pns-section') }}/?type=financial"><button type="button" class="btn btn-primary btn-lg">Dosh Financial</button></a>

                        <a href="#"><button disabled type="button" class="btn btn-primary btn-lg">Dosh Ride</button></a>

                        <a href="#"><button disabled type="button" class="btn btn-primary btn-lg">Dosh ERP</button></a>

                        <a href="#"><button disabled type="button" class="btn btn-primary btn-lg">Dosh Commerce</button></a>

                        {{-- <form method="POST" action="{{ route('submit-pns-header') }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary btn-lg submit-btn">Submit Header</button>
                        </form> --}}
                    </div>
                  </div>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Insurance Types Sections</h4>
                      <p class="card-description">Click on a section to edit it on the right</p>
                      <div class="template-demo">
                        @if (request('type') == 'insurance' || !request('type'))
                            <a href="{{ route('pns-section', ['name' => 'insurance']) }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block btn-active">
                                Insurance Section
                                </button>
                            </a>

                            <a href="{{ route('pns-section', ['name' => '365'])  }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                DOSH 365
                                </button>
                            </a>
                            <a href="{{ route('pns-section', ['name' => '750']) }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                DOSH 750
                                </button>
                            </a>
                            <a href="{{ route('pns-section', ['name' => '1000']) }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                DOSH 1000
                                </button>
                            </a>
                            <a href="{{ route('pns-section', ['name' => '2500']) }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                DOSH 2500
                                </button>
                            </a>
                            <a href="{{ route('pns-section', ['name' => '5000']) }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                DOSH 5000
                                </button>
                            </a>
                            <a href="{{ route('pns-section', ['name' => '10000'])}}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                DOSH 10000
                                </button>
                            </a>

                        @elseif (request('type') == 'financial')

                            <a href="{{ route('pns-section', 'header') }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block btn-active">
                                Financial Section
                                </button>
                            </a>

                            <a href="{{ route('pns-section', 'header') }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                Personal
                                </button>
                            </a>
                            <a href="{{ route('pns-section', 'whoweare') }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                Family
                                </button>
                            </a>
                            <a href="{{ route('pns-section', 'mission') }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                SOHO
                                </button>
                            </a>
                            <a href="{{ route('pns-section', 'values') }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                SMB
                                </button>
                            </a>
                            <a href="{{ route('pns-section', 'expertise') }}">
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                Enterprise
                                </button>
                            </a>
                        @endif

                      </div>
                    </div>
                  </div>
              </div>

            <div class="col-md-9 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit  section</h4>




                    <form class="forms-sample" method="POST"
                    action=""
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (request('name') != 'insurance')

                    <div class="form-group" style="display: flex;">
                        <label>Section Image</label>
                        <input type="file" name="aboutus_section_image" class="file-upload-default">
                        <div class="input-group col-xs-12 col-md-8" style="height:3rem;">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                        </div>
                        <div class="col-xs-12 col-md-4 homesec-image-container">
                            <img src="{{ $pns_page[0]->image }}" alt="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Description</label>
                        <textarea class="form-control" id="myeditorinstance-caption" name="caption">{{ $pns_page[0]->desc }}</textarea>
                    </div>

                    @else

                    <div class="form-group">
                        <label for="exampleInputUsername1">Caption</label>
                        <textarea class="form-control" id="myeditorinstance-caption" name="caption">{{ $pns_page->home_caption }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Body</label>
                        <textarea class="form-control" id="myeditorinstance-body" name="body">{{ $pns_page->home_body }}</textarea>
                    </div>

                    @endif




                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>

                    {{-- @endforeach --}}
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
