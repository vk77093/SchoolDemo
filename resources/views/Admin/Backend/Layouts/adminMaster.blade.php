<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('AdminAsset/images/favicon.ico')}}">

    <title>School Management | {{$title_page ?? ''}}</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('AdminAsset/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{asset('AdminAsset/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('AdminAsset/css/skin_color.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

  <!---Header Part --->
  @include('Admin.Backend.Layouts.header')
   <!---End Header Part --->
  
  <!-- Left side column. contains the logo and sidebar -->
 <!--sidebar start--->
 @include('Admin.Backend.Layouts.sidebar')
 <!--sidebar end--->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			@yield('main')
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  <!---footer Pary--->
  @include('Admin.Backend.Layouts.footer')
  <!--end of Footer Part---->

 <!--setting part--->
 @include('Admin.Backend.Layouts.settingSide')
 <!--end of setting part--->
  
</div>
<!-- ./wrapper -->
  	
	 
	<!-- Vendor JS -->
	<script src="{{asset('AdminAsset/js/vendors.min.js')}}"></script>
    <script src="{{asset('../assets/icons/feather-icons/feather.min.js')}}"></script>	
	<script src="{{asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script>
	<script src="{{asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script>
	<script src="{{asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>
	
  @yield('js')
	<!-- Sunny Admin App -->
	<script src="{{asset('AdminAsset/js/template.js')}}"></script>
	<script src="{{asset('AdminAsset/js/pages/dashboard.js')}}"></script>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>
</body>
</html>
