<!DOCTYPE html>
<html lang="en">
<head>
<title>E-commerce Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('admin/css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('admin/css/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('admin/css/select2.css')}}" />
<link rel="stylesheet" href="{{asset('admin/css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('admin/css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('admin/css/matrix-media.css')}}" />
<link rel="stylesheet" href="{{ asset('admin/sweetalert.css') }}" />

<link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('admin/css/jquery.gritter.css')}}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>

@include('layouts.adminLayout.admin_header')

@include('layouts.adminLayout.admin_sidebar')
@yield('content')

<!--end-main-container-part-->
@include('layouts.adminLayout.admin_footer')


<!--end-Footer-part-->


<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<!-- <script src="{{asset('admin/js/jquery.ui.custom.js')}}"></script> -->
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.uniform.js')}}"></script>
<script src="{{asset('admin/js/select2.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.validate.js')}}"></script>
<script src="{{asset('admin/js/matrix.js')}}"></script>
<script src="{{asset('admin/js/matrix.form_validation.js')}}"></script>
<script src="{{asset('admin/js/matrix.tables.js')}}"></script>
<script src="{{asset('admin/js/matrix.popover.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
 $(function() {
   $("#expiry_date").datepicker({
     minDate:0,
     dateFormat:'yy-mm-dd'

   });
 });
 </script>
</body>
</html>
