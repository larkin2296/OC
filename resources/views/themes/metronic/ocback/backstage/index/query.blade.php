<!DOCTYPE html>
@include('themes.metronic.ocback.backstage.public.js.p_js')
@include('themes.metronic.ocback.backstage.public.css.p_css')

<body id="mimin" class="dashboard">
<!-- start: Header -->
<!-- end: Header -->

<!-- end: Left Menu -->

<!-- start: content -->
<div id="content">
    @yield('title')
    <div class="col-md-12 padding-0 form-element">
        <div class="col-md-12">
            @yield('query')
            @yield('panel')
        </div>
    </div>
</div>
<!-- end: content -->

</body>
</html>