<title>Todrix @yield('title')</title>


<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://uideck.com/play/">
<meta property="og:title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
<meta property="og:description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">
<meta property="og:image" content="https://uideck.com/wp-content/uploads/2021/09/play-meta-bs.jpg">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://uideck.com/play/">
<meta property="twitter:title" content="Play - Free Open Source HTML Bootstrap Template by UIdeck">
<meta property="twitter:description" content="Play - Free Open Source HTML Bootstrap Template by UIdeck Team">
<meta property="twitter:image" content="https://uideck.com/wp-content/uploads/2021/09/play-meta-bs.jpg">

<!--====== Favicon Icon ======-->
<link rel="shortcut icon" href="{{ asset('src/images/favicon.svg') }}" type="image/svg" />

<!-- ===== All CSS files ===== -->
<link rel="stylesheet" href="{{ asset('src/plugins/bootstrap-4.3.1/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('src/css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('src/css/lineicons.css') }}" />
<link rel="stylesheet" href="{{ asset('src/css/ud-styles.css') }}" />
<link rel="stylesheet" href="{{ asset('src/css/login.css') }}" />

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>



@yield('head')
