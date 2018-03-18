<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{ app()->getLocale() }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{ app()->getLocale() }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>lalal</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="_token" content="{{ csrf_token() }}">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('vendor/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" >
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('themes/metronic/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('themes/metronic/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('themes/metronic/layouts/layout4/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('themes/metronic/layouts/layout4/css/themes/light.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('themes/metronic/layouts/layout4/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/common.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('vendor/layer/theme/default/layer.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .page-content-wrapper .page-content{padding-top: 0;}
            .page-header.navbar .page-logo{width: auto;min-width: 265px;}
            .page-header.navbar .page-logo a{text-decoration: none;}
            .page-header.navbar .page-logo h2{padding-right: 20px;}
        </style>
        @stack('css')
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
        <!-- BEGIN HEADER -->
        @include(getThemeTemplate('layout.partical.admin.header'))
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        @include(getThemeTemplate('layout.partical.admin.content'))
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        @include(getThemeTemplate('layout.partical.admin.footer'))
        <!-- END FOOTER -->
        <!-- BEGIN MODAL -->
        @include(getThemeTemplate('layout.partical.admin.modal'))
        <!-- END MODAL -->
        <!--[if lt IE 9]>
        <script src="{{ asset('vendor/respond.min.js') }}"></script>
        <script src="{{ asset('vendor/excanvas.min.js') }}"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('vendor/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('vendor/webuploader-0.1.5/webuploader.nolog.min.js') }}"></script>

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('libs/moment-with-locales.js')}}"></script>
        <script src="{{asset('themes/metronic/global/scripts/app.js')}}" type="text/javascript"></script>
        <script src="{{asset('backend/js/common.js')}}"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
         <script src="{{asset('themes/metronic/pages/scripts/dashboard.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('themes/metronic/layouts/layout4/scripts/layout.js')}}" type="text/javascript"></script>
        <script src="{{asset('themes/metronic/layouts/layout4/scripts/demo.js')}}" type="text/javascript"></script>
        <script src="{{asset('vendor/layer/layer.js')}}" type="text/javascript"></script>

        <!-- END THEME LAYOUT SCRIPTS -->
        @stack('js')
    </body>

</html>