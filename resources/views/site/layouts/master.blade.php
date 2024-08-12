<!DOCTYPE html>
<html lang="vi-vn" xml:lang="vi-vn">
<head>
    @include('site.partials.head')
</head>
<body ng-app="App" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<!-- Start Preloader Area -->
@include('site.partials.preloader')

@include('site.partials.header')

@yield('content')

@include('site.partials.footer')
<!-- Angular Js -->
<script src="{{ asset('libs/angularjs/angular.js?v=222222') }}"></script>
<script src="{{ asset('libs/angularjs/angular-resource.js') }}"></script>
<script src="{{ asset('libs/angularjs/sortable.js') }}"></script>
<script src="{{ asset('libs/dnd/dnd.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
<script src="{{ asset('libs/angularjs/select.js') }}"></script>
<script src="{{ asset('js/angular.js') }}?version={{ env('APP_VERSION', '1') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="/site/js/jquery.js"></script>
<script src="/site/js/bootstrap.min.js"></script>
<script src="/site/js/jquery.parallax.js"></script>
<script src="/site/js/jquery.nav.js"></script>
<script src="/site/js/jquery.backstretch.min.js"></script>
<script src="/site/js/owl.carousel.min.js"></script>
<script src="/site/js/smoothscroll.js"></script>
<script src="/site/js/wow.min.js"></script>
<script src="/site/js/custom.js"></script>


@stack('scripts')

</body>
</html>
