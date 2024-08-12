<head>
    <title>Fitness - Responsive HTML Template</title>
    <link rel="icon" type="image/png" href="{{$config->image->path ?? ''}}"/>
    @yield('title')
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{$config->image->path ?? ''}}" />

    <link rel="stylesheet" href="/site/css/bootstrap.min.css">
    <link rel="stylesheet" href="/site/css/animate.css">
    <link rel="stylesheet" href="/site/css/font-awesome.min.css">
    <link rel="stylesheet" href="/site/css/owl.theme.css">
    <link rel="stylesheet" href="/site/css/owl.carousel.css">

    <!-- Main css -->
    <link rel="stylesheet" href="/site/css/style.css">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora:700italic' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="{{ $config->favicon->path ?? '' }}">

</head>
