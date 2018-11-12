<head>
    <meta charset="UTF-8">
    <title>{{ trans('globals.app_title') }} @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome Icons -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <link href = "{{ asset('/akkargroup-bower/components-font-awesome/css/font-awesome.min.css') }}" rel = "stylesheet" type = "text/css" />

    <!-- Ionicons -->
    <!--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    <link href = "{{ asset('/akkargroup-bower/ionicons/css/ionicons.min.css') }}" rel = "stylesheet" type = "text/css" />

    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-red-lightfor this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset('/css/skins/skin-red.css') }}" rel="stylesheet" type="text/css" />
    <link href = "{{ asset('/css/app.css') }}" rel = "stylesheet" type = "text/css" />

    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Datatables Jquery -->
    <link href = "{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel = "stylesheet" >
    <link href = "https://cdn.datatables.net/responsive/2.0.0/css/responsive.dataTables.min.css" rel = "stylesheet" type = "text/css" />

    <!-- Select2 for inputs type Select -->
    <!--<link href = "{{ asset('/plugins/select2/select2.min.css') }}" rel = "stylesheet" >-->
    <link href = "{{ asset('/css/select2.min.css') }}" rel = "stylesheet" >

    <!-- Date Selector type picker -->
    <link href = "{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel = "stylesheet" >
    
    <!-- Notifications system -->
    <link href = "{{ asset('/akkargroup-bower/pnotify/dist/pnotify.css') }}" rel = "stylesheet" type = "text/css" />
    <link href = "{{ asset('/akkargroup-bower/pnotify/dist/pnotify.buttons.css') }}" rel = "stylesheet" type="text/css" />

    <!-- loading bar system -->
    <link href = "{{ asset('/akkargroup-bower/pace/themes/silver/pace-theme-flash.css') }}" rel = "stylesheet" type="text/css" />
    @section('cssCustoms')

    @show
</head>
