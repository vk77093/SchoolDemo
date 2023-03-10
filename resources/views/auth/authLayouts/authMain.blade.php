<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('AdminAsset/images/favicon.ico')}}">

    <title>School Management - {{$title_page ?? ''}} </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('AdminAsset/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{asset('AdminAsset/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('AdminAsset/css/skin_color.css')}}">	

</head>
<body class="hold-transition theme-primary bg-gradient-primary">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
@yield('main')
        </div>
    </div>
          
<!-- Vendor JS -->
<script src="{{asset('AdminAsset/js/vendors.min.js')}}"></script>
<script src="{{asset('../assets/icons/feather-icons/feather.min.js')}}"></script>	

</body>
</html>
