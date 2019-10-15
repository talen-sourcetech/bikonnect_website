<!-- #CSS Links -->
<!-- Basic Styles -->
<link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('backend/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('backend/css/font-awesome.min.css') }}">

<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
<link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('backend/css/smartadmin-production-plugins.min.css') }}">
<link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('backend/css/smartadmin-production.min.css') }}">
<link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('backend/css/smartadmin-skins.min.css') }}">

<!-- We recommend you use "your_style.css" to override SmartAdmin
        specific styles this will also ensure you retrain your customization with each SmartAdmin update.
<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

<!-- #FAVICONS -->
<link rel="shortcut icon" href="{{ URL::asset('backend/img/favicon/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ URL::asset('backend/img/favicon/favicon.ico') }}" type="image/x-icon">

<!-- #GOOGLE FONT -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

<!-- #APP SCREEN / ICONS -->
<!-- Specifying a Webpage Icon for Web Clip 
        Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
<link rel="apple-touch-icon" href="{{ URL::asset('backend/img/splash/sptouch-icon-iphone.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('backend/img/splash/touch-icon-ipad.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('backend/img/splash/touch-icon-iphone-retina.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('backend/img/splash/touch-icon-ipad-retina.png') }}">

<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Startup image for web apps -->
<link rel="apple-touch-startup-image" href="{{ URL::asset('backend/img/splash/ipad-landscape.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
<link rel="apple-touch-startup-image" href="{{ URL::asset('backend/img/splash/ipad-portrait.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
<link rel="apple-touch-startup-image" href="{{ URL::asset('backend/img/splash/iphone.png') }}" media="screen and (max-device-width: 320px)">