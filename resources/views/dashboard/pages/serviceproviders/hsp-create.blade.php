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
                <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Add New Health Service Provider</h4>

                    <form method="POST" action="{{ route('hsp-store') }}" class="forms-sample">
                        @csrf

                        <div class="form-group">
                        <label for="hospital_name">Hospital Name</label>
                        <input type="text" name="hospital_name" class="form-control" id="hospital_name" placeholder="Enter hospital name" value="{{ old('hospital_name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <select id="country" name="country" class="form-control">
                                <option selected disabled>Choose Country</option>
                                <option value="Ghana">Ghana</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group" id="region-group">
                            <label for="region">Region</label>
                            <select id="region-select" name="region_name" class="form-control d-none">
                                <option selected disabled>Choose Region</option>
                                @foreach($ghanaRegions as $region)
                                    <option value="{{ $region->region_name }}">{{ $region->region_name }}</option>
                                @endforeach
                            </select>
                            <input type="text" id="region-text" name="region_name" class="form-control" placeholder="Enter Region" value="{{ old('region_name') }}">
                        </div> --}}

                        <div class="form-group" id="region-group">
                            <label for="region">Region</label>

                            <!-- Hidden field that will be submitted -->
                            <input type="hidden" name="region_name" id="region_name_final">

                            <!-- Ghana-specific select -->
                            <select id="region-select" class="form-control d-none">
                                <option selected disabled>Choose Region</option>
                                @foreach($ghanaRegions as $region)
                                    <option value="{{ $region->region_name }}">{{ $region->region_name }}</option>
                                @endforeach
                            </select>

                            <!-- Text input for non-Ghana -->
                            <input type="text" id="region-text" class="form-control" placeholder="Enter Region" value="">
                        </div>


                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" id="district" name="district" class="form-control" placeholder="Enter District" value="{{ old('district') }}">
                        </div>

                        <div class="form-group">
                        <label for="phone_number1">Phone Number 1</label>
                        <input type="text" name="phone_number1" class="form-control" id="phone_number1" placeholder="Enter phone number 1" value="{{ old('phone_number1') }}">
                        </div>

                        <div class="form-group">
                        <label for="phone_number2">Phone Number 2</label>
                        <input type="text" name="phone_number2" class="form-control" id="phone_number2" placeholder="Enter phone number 2" value="{{ old('phone_number2') }}">
                        </div>

                        <div class="form-group">
                        <label for="phone_number3">Phone Number 3</label>
                        <input type="text" name="phone_number3" class="form-control" id="phone_number3" placeholder="Enter phone number 3" value="{{ old('phone_number3') }}">
                        </div>

                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}">
                        </div>

                        {{-- <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Enter latitude" value="{{ old('latitude') }}">
                        </div>

                        <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Enter longitude" value="{{ old('longitude') }}">
                        </div> --}}

                        <div class="form-group">
                        <label for="location_address">Location Coodinates</label>
                        <input type="text" name="location_address" class="form-control" id="location_address" placeholder="" value="{{ old('location_address') }}">
                        <p style="color:red; font-style:italic;">Do not leave any spaces between the cordinate or degree sign eg. <span style="color: blue">5°36'44"N 0°10'56"W</span></p>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('hsp-list') }}" class="btn btn-light">Cancel</a>
                    </form>

                    </div>
                </div>
                </div>
            </div>

        {{-- Footer --}}
        @include('dashboard.partials.footer')
        {{-- End Footer  --}}
            </div>


        <!-- content-wrapper ends -->

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const countrySelect = document.getElementById('country');
        const regionSelect = document.getElementById('region-select');
        const regionText = document.getElementById('region-text');

        countrySelect.addEventListener('change', function () {
            if (this.value === 'Ghana') {
                regionSelect.classList.remove('d-none');
                regionText.classList.add('d-none');
                regionText.value = '';
            } else {
                regionSelect.classList.add('d-none');
                regionText.classList.remove('d-none');
                regionSelect.value = '';
            }
        });
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const countrySelect = document.getElementById('country');
        const regionSelect = document.getElementById('region-select');
        const regionText = document.getElementById('region-text');
        const regionNameFinal = document.getElementById('region_name_final');

        function updateFinalRegion() {
            if (countrySelect.value === 'Ghana') {
                regionNameFinal.value = regionSelect.value;
            } else {
                regionNameFinal.value = regionText.value;
            }
        }

        // Toggle fields on country change
        countrySelect.addEventListener('change', function () {
            if (this.value === 'Ghana') {
                regionSelect.classList.remove('d-none');
                regionText.classList.add('d-none');
                regionText.value = '';
                updateFinalRegion();
            } else {
                regionSelect.classList.add('d-none');
                regionText.classList.remove('d-none');
                regionSelect.value = '';
                updateFinalRegion();
            }
        });

        // Update hidden field on input/select change
        regionSelect.addEventListener('change', updateFinalRegion);
        regionText.addEventListener('input', updateFinalRegion);
    });
</script>



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
