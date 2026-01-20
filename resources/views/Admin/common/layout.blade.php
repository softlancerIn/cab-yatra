<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cab Yatra</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet"
    href="{{env('ASSET_ADMIN_URL')}}assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="{{env('ASSET_ADMIN_URL')}}assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{env('ASSET_ADMIN_URL')}}assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="https://cabyatra.com/public/admin/assets/images/admin_logo.jpeg" />

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js"
    integrity="sha512-RUZ2d69UiTI+LdjfDCxqJh5HfjmOcouct56utQNVRjr90Ea8uHQa+gCxvxDTC9fFvIGP+t4TDDJWNTRV48tBpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>
</head>

<body class="with-welcome-text">
  <div class="container-scroller">
    <!----------- Common header added here ----------------->
    @include('Admin.common.header')
    <!----------- Common header added here ----------------->
    <div class="container-fluid page-body-wrapper">

      <!----------- Common sidebar added here ----------------->
      @include('Admin.common.sidebar')
      <!----------- Common sidebar added here ----------------->

      <!----------- Dynamic Component Added added here ----------------->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>

        <!----------- Dynamic Component Added added here ----------------->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Design and Developed By CabYatra
              </span>
            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All rights
              reserved.</span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="{{env('ASSET_ADMIN_URL')}}assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/vendors/chart.js/chart.umd.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/off-canvas.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/template.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/settings.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/hoverable-collapse.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/todolist.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/dashboard.js"></script>
  <script src="{{env('ASSET_ADMIN_URL')}}assets/js/chart.js"></script>

</body>

</html>